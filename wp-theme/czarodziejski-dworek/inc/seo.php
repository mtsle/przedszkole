<?php
/**
 * SEO motywu Czarodziejski Dworek.
 *
 * Bez wtyczki (Yoast/RankMath) — lekki, własny moduł:
 *  - meta description (per kontekst, z fallbackami; opcjonalne pole ACF „seo_description”),
 *  - rel=canonical dla WSZYSTKICH typów stron (nie tylko singular),
 *  - Open Graph + Twitter Cards (summary_large_image),
 *  - wp_robots: max-image-preview:large (bogatsze wyniki w Google),
 *  - JSON-LD: WebSite (+SearchAction), BreadcrumbList, Article (wpisy).
 *
 * Schema „Preschool” (organizacja) jest w functions.php (dworek_jsonld()).
 *
 * @package Czarodziejski_Dworek
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// WordPress sam wstawia <link rel="canonical"> dla wpisów/stron (rel_canonical).
// My wypisujemy własny canonical dla WSZYSTKICH widoków — usuwamy rdzeniowy,
// żeby nie było dwóch znaczników canonical na tej samej stronie.
remove_action( 'wp_head', 'rel_canonical' );

/* =========================================================================
 * Pomocniki: opis, tytuł, obraz, URL bieżącego widoku
 * ========================================================================= */

/**
 * Domyślny, nasycony słowami kluczowymi „dopisek” tytułu strony głównej.
 *
 * Używany TYLKO gdy klient nie ustawił własnego sloganu witryny
 * (Ustawienia → Ogólne → Opis). Gdy ustawi — WordPress użyje jego wersji,
 * więc niczego nie blokujemy, a strona ma mocny tytuł SEO „od ręki”.
 *
 * @return string
 */
function dworek_seo_home_tagline() {
	$tagline = get_bloginfo( 'description' );
	if ( $tagline ) {
		return $tagline;
	}
	return 'Przedszkole językowo-muzyczne na Woli w Warszawie';
}

/**
 * Wstawia mocny dopisek do tytułu strony głównej, gdy slogan witryny jest pusty.
 *
 * @param array $parts Części tytułu (title, tagline, site).
 * @return array
 */
function dworek_seo_document_title_parts( $parts ) {
	if ( is_front_page() && empty( $parts['tagline'] ) ) {
		$parts['tagline'] = dworek_seo_home_tagline();
	}
	return $parts;
}
add_filter( 'document_title_parts', 'dworek_seo_document_title_parts' );

/**
 * Domyślny opis serwisu (gdy nic lepszego nie ma).
 *
 * @return string
 */
function dworek_seo_default_description() {
	return 'Integracyjne przedszkole językowo-muzyczne „Czarodziejski Dworek” na warszawskiej Woli (ul. Górczewska 89). Małe grupy do 14 dzieci, angielski i francuski w cenie, basen, muzyka oraz bezpłatne terapie. Zapisy trwają — umów wizytę.';
}

/**
 * Buduje meta description dla bieżącego widoku.
 *
 * Kolejność: pole ACF „seo_description” → zajawka/excerpt → początek treści →
 * opis kategorii → opis domyślny. Zawsze ucinane do ~160 znaków.
 *
 * @return string
 */
function dworek_seo_description() {
	$desc = '';

	if ( is_front_page() ) {
		$desc = dworek_field( 'seo_description', get_bloginfo( 'description' ) );
		if ( ! $desc ) {
			$desc = dworek_seo_default_description();
		}
	} elseif ( is_singular() ) {
		$desc = dworek_field( 'seo_description', '' );
		if ( ! $desc ) {
			$desc = has_excerpt() ? get_the_excerpt() : '';
		}
		if ( ! $desc ) {
			$content = get_post_field( 'post_content', get_queried_object_id() );
			$desc    = wp_strip_all_tags( strip_shortcodes( (string) $content ) );
		}
	} elseif ( is_category() || is_tag() || is_tax() ) {
		$desc = term_description();
		$desc = wp_strip_all_tags( (string) $desc );
	} elseif ( is_search() ) {
		$desc = 'Wyniki wyszukiwania w serwisie Czarodziejski Dworek.';
	}

	if ( ! $desc ) {
		$desc = dworek_seo_default_description();
	}

	$desc = trim( preg_replace( '/\s+/u', ' ', $desc ) );

	// Bezpieczne ucięcie do ~160 znaków na granicy słowa.
	if ( function_exists( 'mb_strlen' ) ? mb_strlen( $desc ) > 160 : strlen( $desc ) > 160 ) {
		$desc = function_exists( 'mb_substr' ) ? mb_substr( $desc, 0, 157 ) : substr( $desc, 0, 157 );
		$desc = preg_replace( '/\s+\S*$/u', '', $desc ) . '…';
	}

	return $desc;
}

/**
 * Tytuł dla OG/Twitter (czysty tekst, bez sufiksu witryny dla wpisów).
 *
 * @return string
 */
function dworek_seo_title() {
	if ( is_front_page() ) {
		$name    = get_bloginfo( 'name' );
		$tagline = dworek_seo_home_tagline();
		return $tagline ? $name . ' — ' . $tagline : $name;
	}
	if ( is_singular() ) {
		return wp_strip_all_tags( get_the_title( get_queried_object_id() ) );
	}
	return wp_get_document_title();
}

/**
 * Kanoniczny URL bieżącego widoku (wszystkie typy stron).
 *
 * @return string
 */
function dworek_seo_canonical_url() {
	if ( is_front_page() ) {
		return home_url( '/' );
	}
	if ( is_singular() ) {
		$url = get_permalink( get_queried_object_id() );
		return $url ? $url : home_url( '/' );
	}
	if ( is_category() || is_tag() || is_tax() ) {
		$url = get_term_link( get_queried_object() );
		return is_wp_error( $url ) ? home_url( '/' ) : $url;
	}
	if ( is_post_type_archive() ) {
		$url = get_post_type_archive_link( get_post_type() );
		return $url ? $url : home_url( '/' );
	}
	if ( is_home() ) {
		$blog_id = (int) get_option( 'page_for_posts' );
		if ( $blog_id ) {
			return get_permalink( $blog_id );
		}
	}
	// Fallback: bieżący URL bez parametrów śledzenia.
	global $wp;
	return home_url( add_query_arg( array(), $wp->request ) );
}

/**
 * Obraz reprezentujący widok (OG/Twitter): obraz wyróżniający → hero motywu.
 *
 * @return string Pełny URL obrazu.
 */
function dworek_seo_image() {
	$data = dworek_seo_image_data();
	return $data['url'];
}

/**
 * Pełne dane obrazu OG/Twitter: URL + wymiary + typ MIME.
 *
 * Google i serwisy społecznościowe budują pewniejsze (i większe) podglądy,
 * gdy znają wymiary obrazu z góry — bez doczytywania pliku po stronie odbiorcy.
 *
 * @return array{url:string,width:int,height:int,type:string}
 */
function dworek_seo_image_data() {
	// 1) Obraz wyróżniający wpisu/strony — znamy wymiary z metadanych WP.
	if ( is_singular() && has_post_thumbnail( get_queried_object_id() ) ) {
		$id  = get_post_thumbnail_id( get_queried_object_id() );
		$src = wp_get_attachment_image_src( $id, 'dworek-wide' );
		if ( $src && ! empty( $src[0] ) ) {
			$mime = get_post_mime_type( $id );
			return array(
				'url'    => $src[0],
				'width'  => (int) $src[1],
				'height' => (int) $src[2],
				'type'   => $mime ? $mime : 'image/jpeg',
			);
		}
	}

	// 2) Własny obraz domyślny z Dostosuj (jeśli ustawiony).
	$custom = get_theme_mod( 'dworek_default_og_image' );
	if ( $custom ) {
		return array(
			'url'    => $custom,
			'width'  => 0,
			'height' => 0,
			'type'   => 'image/jpeg',
		);
	}

	// 3) Hero motywu — wymiary czytamy raz z pliku (z cache statycznym).
	static $hero = null;
	if ( null === $hero ) {
		$path = get_template_directory() . '/img/hero.webp';
		$w    = 1200;
		$h    = 630;
		if ( is_readable( $path ) ) {
			$size = @getimagesize( $path ); // phpcs:ignore WordPress.PHP.NoSilencedErrors
			if ( $size && ! empty( $size[0] ) ) {
				$w = (int) $size[0];
				$h = (int) $size[1];
			}
		}
		$hero = array(
			'url'    => get_template_directory_uri() . '/img/hero.webp',
			'width'  => $w,
			'height' => $h,
			'type'   => 'image/webp',
		);
	}
	return $hero;
}

/* =========================================================================
 * <meta name="description"> + canonical + Open Graph + Twitter
 * ========================================================================= */

/**
 * Wypisuje znaczniki SEO w <head>. Nie nadpisuje, gdy aktywna jest
 * wtyczka SEO (Yoast/RankMath/SEOPress/AIOSEO) — wtedy oddajemy jej stery.
 */
function dworek_seo_head() {
	if (
		defined( 'WPSEO_VERSION' )       // Yoast
		|| defined( 'RANK_MATH_VERSION' ) // Rank Math
		|| defined( 'SEOPRESS_VERSION' )  // SEOPress
		|| defined( 'AIOSEO_VERSION' )    // All in One SEO
	) {
		return;
	}

	$desc      = dworek_seo_description();
	$title     = dworek_seo_title();
	$canonical = dworek_seo_canonical_url();
	$img       = dworek_seo_image_data();
	$image     = $img['url'];
	$site_name = get_bloginfo( 'name' );
	$locale    = get_locale(); // np. pl_PL

	$type = is_singular( 'post' ) ? 'article' : 'website';

	echo "\n<!-- SEO: Czarodziejski Dworek -->\n";

	printf( '<meta name="description" content="%s">' . "\n", esc_attr( $desc ) );
	printf( '<link rel="canonical" href="%s">' . "\n", esc_url( $canonical ) );

	// --- Open Graph ---
	printf( '<meta property="og:locale" content="%s">' . "\n", esc_attr( $locale ) );
	printf( '<meta property="og:type" content="%s">' . "\n", esc_attr( $type ) );
	printf( '<meta property="og:site_name" content="%s">' . "\n", esc_attr( $site_name ) );
	printf( '<meta property="og:title" content="%s">' . "\n", esc_attr( $title ) );
	printf( '<meta property="og:description" content="%s">' . "\n", esc_attr( $desc ) );
	printf( '<meta property="og:url" content="%s">' . "\n", esc_url( $canonical ) );
	printf( '<meta property="og:image" content="%s">' . "\n", esc_url( $image ) );
	if ( 0 === strpos( $image, 'https://' ) ) {
		printf( '<meta property="og:image:secure_url" content="%s">' . "\n", esc_url( $image ) );
	}
	if ( ! empty( $img['type'] ) ) {
		printf( '<meta property="og:image:type" content="%s">' . "\n", esc_attr( $img['type'] ) );
	}
	if ( ! empty( $img['width'] ) && ! empty( $img['height'] ) ) {
		printf( '<meta property="og:image:width" content="%d">' . "\n", (int) $img['width'] );
		printf( '<meta property="og:image:height" content="%d">' . "\n", (int) $img['height'] );
	}
	printf( '<meta property="og:image:alt" content="%s">' . "\n", esc_attr( $title ) );

	// Dla wpisów: czas publikacji/aktualizacji + autor.
	if ( is_singular( 'post' ) ) {
		printf( '<meta property="article:published_time" content="%s">' . "\n", esc_attr( get_the_date( 'c', get_queried_object_id() ) ) );
		printf( '<meta property="article:modified_time" content="%s">' . "\n", esc_attr( get_the_modified_date( 'c', get_queried_object_id() ) ) );
		$cats = get_the_category( get_queried_object_id() );
		if ( ! empty( $cats ) ) {
			printf( '<meta property="article:section" content="%s">' . "\n", esc_attr( $cats[0]->name ) );
		}
	}

	// --- Twitter Cards ---
	printf( '<meta name="twitter:card" content="%s">' . "\n", 'summary_large_image' );
	printf( '<meta name="twitter:title" content="%s">' . "\n", esc_attr( $title ) );
	printf( '<meta name="twitter:description" content="%s">' . "\n", esc_attr( $desc ) );
	printf( '<meta name="twitter:image" content="%s">' . "\n", esc_url( $image ) );
	printf( '<meta name="twitter:image:alt" content="%s">' . "\n", esc_attr( $title ) );

	echo "<!-- /SEO -->\n";
}
add_action( 'wp_head', 'dworek_seo_head', 5 );

/**
 * Bogatsze podglądy obrazów w Google (większe miniatury w wynikach).
 *
 * @param array $robots Reguły robots.
 * @return array
 */
function dworek_seo_robots( $robots ) {
	if ( is_singular() || is_front_page() ) {
		$robots['max-image-preview'] = 'large';
		$robots['max-snippet']       = '-1';
		$robots['max-video-preview'] = '-1';
	}

	// Cienkie / niewartościowe widoki — nie indeksować, ale podążać za linkami.
	// (Polityki spamu Google: unikać thin content i stron wyników wyszukiwania
	// w indeksie). Linki nadal przekazują wartość do realnych podstron.
	if ( is_search() || is_404() ) {
		$robots['noindex']           = true;
		$robots['follow']            = true;
		$robots['max-image-preview'] = 'large';
	}

	return $robots;
}
add_filter( 'wp_robots', 'dworek_seo_robots' );

/* =========================================================================
 * Breadcrumbs — wizualne (z mikrodanymi) + JSON-LD BreadcrumbList
 * ========================================================================= */

/**
 * Zwraca uporządkowaną listę okruchów [ ['name'=>, 'url'=>], ... ].
 * Ostatni element to bieżąca strona (url może być pusty).
 *
 * @return array
 */
function dworek_breadcrumb_items() {
	$items = array(
		array(
			'name' => 'Start',
			'url'  => home_url( '/' ),
		),
	);

	if ( is_front_page() ) {
		return array(); // Na stronie głównej okruchów nie pokazujemy.
	}

	if ( is_singular( 'post' ) ) {
		$blog_id = (int) get_option( 'page_for_posts' );
		$items[] = array(
			'name' => $blog_id ? get_the_title( $blog_id ) : 'Blog',
			'url'  => $blog_id ? get_permalink( $blog_id ) : home_url( '/blog/' ),
		);
		$items[] = array(
			'name' => wp_strip_all_tags( get_the_title() ),
			'url'  => '',
		);
	} elseif ( is_page() ) {
		// Przodkowie (strony nadrzędne) + bieżąca.
		$ancestors = array_reverse( get_post_ancestors( get_queried_object_id() ) );
		foreach ( $ancestors as $anc_id ) {
			$items[] = array(
				'name' => wp_strip_all_tags( get_the_title( $anc_id ) ),
				'url'  => get_permalink( $anc_id ),
			);
		}
		$items[] = array(
			'name' => wp_strip_all_tags( get_the_title() ),
			'url'  => '',
		);
	} elseif ( is_singular() ) {
		$items[] = array(
			'name' => wp_strip_all_tags( get_the_title() ),
			'url'  => '',
		);
	} elseif ( is_category() || is_tag() || is_tax() ) {
		$items[] = array(
			'name' => single_term_title( '', false ),
			'url'  => '',
		);
	} elseif ( is_home() ) {
		$items[] = array(
			'name' => 'Blog',
			'url'  => '',
		);
	} elseif ( is_search() ) {
		$items[] = array(
			'name' => 'Wyniki wyszukiwania',
			'url'  => '',
		);
	} elseif ( is_404() ) {
		$items[] = array(
			'name' => 'Nie znaleziono strony',
			'url'  => '',
		);
	} else {
		$items[] = array(
			'name' => wp_get_document_title(),
			'url'  => '',
		);
	}

	return $items;
}

/**
 * Renderuje wizualne okruszki z mikrodanymi schema.org (BreadcrumbList).
 * Wywoływać w szablonach zamiast ręcznego <p class="breadcrumb">.
 *
 * @param array $args Opcjonalne: 'class' (domyślnie 'breadcrumb').
 */
function dworek_breadcrumbs( $args = array() ) {
	$items = dworek_breadcrumb_items();
	if ( count( $items ) < 2 ) {
		return;
	}
	$class = isset( $args['class'] ) ? $args['class'] : 'breadcrumb';

	echo '<nav class="' . esc_attr( $class ) . '" aria-label="Okruszki" itemscope itemtype="https://schema.org/BreadcrumbList">';
	$position = 1;
	$last     = count( $items ) - 1;
	foreach ( $items as $i => $item ) {
		echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
		if ( ! empty( $item['url'] ) && $i !== $last ) {
			printf(
				'<a itemprop="item" href="%s"><span itemprop="name">%s</span></a>',
				esc_url( $item['url'] ),
				esc_html( $item['name'] )
			);
		} else {
			printf( '<span itemprop="name" aria-current="page">%s</span>', esc_html( $item['name'] ) );
		}
		printf( '<meta itemprop="position" content="%d">', (int) $position );
		echo '</span>';
		if ( $i !== $last ) {
			echo ' <span class="breadcrumb__sep" aria-hidden="true">/</span> ';
		}
		$position++;
	}
	echo '</nav>';
}

/* =========================================================================
 * JSON-LD: WebSite (+SearchAction), BreadcrumbList, Article
 * ========================================================================= */

/**
 * JSON-LD wspólne dla całego serwisu i bieżącego widoku.
 */
function dworek_seo_jsonld() {
	$graph = array();

	// WebSite (z akcją wyszukiwania) — na każdej stronie.
	$graph[] = array(
		'@type'           => 'WebSite',
		'@id'             => home_url( '/#website' ),
		'url'             => home_url( '/' ),
		'name'            => get_bloginfo( 'name' ),
		'description'     => get_bloginfo( 'description' ),
		'inLanguage'      => 'pl-PL',
		'publisher'       => array( '@id' => home_url( '/#organization' ) ),
		'potentialAction' => array(
			'@type'       => 'SearchAction',
			'target'      => array(
				'@type'       => 'EntryPoint',
				'urlTemplate' => home_url( '/?s={search_term_string}' ),
			),
			'query-input' => 'required name=search_term_string',
		),
	);

	// BreadcrumbList — gdy są okruchy.
	$crumbs = dworek_breadcrumb_items();
	if ( count( $crumbs ) >= 2 ) {
		$elements = array();
		$pos      = 1;
		foreach ( $crumbs as $c ) {
			$el = array(
				'@type'    => 'ListItem',
				'position' => $pos,
				'name'     => $c['name'],
			);
			if ( ! empty( $c['url'] ) ) {
				$el['item'] = $c['url'];
			}
			$elements[] = $el;
			$pos++;
		}
		$graph[] = array(
			'@type'           => 'BreadcrumbList',
			'itemListElement' => $elements,
		);
	}

	// Article — pojedynczy wpis bloga.
	if ( is_singular( 'post' ) ) {
		$id = get_queried_object_id();

		// Autor: realna osoba (E-E-A-T — Google zaleca jawną identyfikację autora),
		// z linkiem do archiwum autora. Gdy brak sensownego nazwiska (np. „admin”)
		// — bezpieczny fallback do organizacji jako autora.
		$author_id   = (int) get_post_field( 'post_author', $id );
		$author_name = $author_id ? get_the_author_meta( 'display_name', $author_id ) : '';
		if ( $author_name && 'admin' !== strtolower( $author_name ) ) {
			$author = array(
				'@type' => 'Person',
				'name'  => $author_name,
			);
			$author_url = $author_id ? get_author_posts_url( $author_id ) : '';
			if ( $author_url ) {
				$author['url'] = $author_url;
			}
		} else {
			$author = array(
				'@type' => 'Organization',
				'name'  => get_bloginfo( 'name' ),
				'@id'   => home_url( '/#organization' ),
			);
		}

		$article = array(
			'@type'            => 'Article',
			'mainEntityOfPage' => array(
				'@type' => 'WebPage',
				'@id'   => get_permalink( $id ),
			),
			'headline'         => wp_strip_all_tags( get_the_title( $id ) ),
			'description'      => dworek_seo_description(),
			'datePublished'    => get_the_date( 'c', $id ),
			'dateModified'     => get_the_modified_date( 'c', $id ),
			'inLanguage'       => 'pl-PL',
			'author'           => $author,
			'publisher'        => array( '@id' => home_url( '/#organization' ) ),
		);
		if ( has_post_thumbnail( $id ) ) {
			$article['image'] = get_the_post_thumbnail_url( $id, 'dworek-wide' );
		}
		$graph[] = $article;
	}

	if ( empty( $graph ) ) {
		return;
	}

	$payload = array(
		'@context' => 'https://schema.org',
		'@graph'   => $graph,
	);

	echo '<script type="application/ld+json">' . wp_json_encode( $payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
}
add_action( 'wp_head', 'dworek_seo_jsonld', 20 );
