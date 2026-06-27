<?php
/**
 * Czarodziejski Dworek — functions.php
 *
 * Klasyczny motyw WordPress. Rdzeń: rejestracja wsparcia motywu, menu,
 * podpięcie CSS/JS (wp_enqueue_scripts), pomocnicze funkcje ACF z fallbackiem.
 *
 * @package Czarodziejski_Dworek
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Brak bezpośredniego dostępu.
}

define( 'DWOREK_VERSION', '1.0.0' );

/* =========================================================================
 * 1. USTAWIENIA MOTYWU
 * ========================================================================= */
function dworek_setup() {
	// Tytuł strony zarządzany przez WordPress (<title>).
	add_theme_support( 'title-tag' );

	// Miniatury / obrazy wyróżniające (the_post_thumbnail()).
	add_theme_support( 'post-thumbnails' );

	// Logo motywu (opcjonalnie, do użycia w przyszłości).
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 107,
			'width'       => 160,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	// Nowoczesny, semantyczny HTML5 dla elementów generowanych przez WP.
	add_theme_support(
		'html5',
		array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' )
	);

	// Automatyczne linki RSS w <head>.
	add_theme_support( 'automatic-feed-links' );

	// Rozmiary obrazów używane w motywie.
	add_image_size( 'dworek-card', 800, 500, true );   // karty wpisów / oferta
	add_image_size( 'dworek-wide', 1600, 1062, true );  // szerokie zdjęcia

	// Lokalizacje menu.
	register_nav_menus(
		array(
			'primary'     => __( 'Menu główne (nagłówek)', 'czarodziejski-dworek' ),
			'footer_nav'  => __( 'Stopka — Nawigacja', 'czarodziejski-dworek' ),
			'footer_offer' => __( 'Stopka — Oferta', 'czarodziejski-dworek' ),
		)
	);

	// Tłumaczenia.
	load_theme_textdomain( 'czarodziejski-dworek', get_template_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'dworek_setup' );


/* =========================================================================
 * 2. PODPIĘCIE STYLÓW I SKRYPTÓW (bez hardcoded linków)
 * ========================================================================= */
function dworek_assets() {
	$theme_uri = get_template_directory_uri();
	$theme_dir = get_template_directory();

	// --- Google Fonts (Baloo 2 + Nunito) ---
	wp_enqueue_style(
		'dworek-fonts',
		'https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;500;600;700;800&family=Nunito:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400&display=swap',
		array(),
		null
	);

	// --- Główny arkusz stylów (właściwy CSS projektu) ---
	$css_path = $theme_dir . '/css/style.css';
	$css_ver  = file_exists( $css_path ) ? filemtime( $css_path ) : DWOREK_VERSION;
	wp_enqueue_style( 'dworek-main', $theme_uri . '/css/style.css', array( 'dworek-fonts' ), $css_ver );

	// --- Główny skrypt (w stopce, z defer — niższy Total Blocking Time w PSI) ---
	$js_path = $theme_dir . '/js/main.js';
	$js_ver  = file_exists( $js_path ) ? filemtime( $js_path ) : DWOREK_VERSION;
	// Tablica jako 5. argument: WP 6.3+ rozumie 'strategy'=>'defer'; starsze WP
	// potraktują niepustą tablicę jako „w stopce” (bezpieczny fallback).
	wp_enqueue_script(
		'dworek-main-js',
		$theme_uri . '/js/main.js',
		array(),
		$js_ver,
		array(
			'in_footer' => true,
			'strategy'  => 'defer',
		)
	);

	// --- Most między PHP a JS: adresy bazowe (zamiast twardych ścieżek) ---
	$contact_page = get_page_by_path( 'kontakt' );
	$contact_url  = $contact_page ? get_permalink( $contact_page ) : home_url( '/kontakt/' );

	$bootstrap = 'window.DWOREK = ' . wp_json_encode(
		array(
			'themeUri'   => $theme_uri,
			'homeUrl'    => home_url( '/' ),
			'contactUrl' => $contact_url,
			'loginUrl'   => wp_login_url( home_url( '/' ) ),
		)
	) . ';';
	wp_add_inline_script( 'dworek-main-js', $bootstrap, 'before' );

	// --- Dane galerii (tylko na stronie Galerii) z poprawką ścieżek na adres motywu ---
	if ( is_page_template( 'page-galeria.php' ) || is_page( 'galeria' ) ) {
		$gallery_file = $theme_dir . '/js/gallery-data.js';
		if ( file_exists( $gallery_file ) ) {
			$gallery_js = file_get_contents( $gallery_file ); // phpcs:ignore
			// Zamiana ścieżek względnych "img/..." na pełny adres motywu.
			$gallery_js = str_replace( '"img/', '"' . trailingslashit( $theme_uri ) . 'img/', $gallery_js );
			wp_add_inline_script( 'dworek-main-js', $gallery_js, 'before' );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'dworek_assets' );

/**
 * Ładuje arkusz Google Fonts BEZ blokowania renderu (PSI: „Eliminate
 * render-blocking resources”). Technika media=print → onload przełącza na all.
 * Tekst i tak jest widoczny od razu dzięki &display=swap. Fallback <noscript>
 * dla wyłączonego JavaScriptu, by fonty zadziałały bez skryptów.
 *
 * @param string $html   Znacznik <link> stylu.
 * @param string $handle Uchwyt stylu.
 * @return string
 */
function dworek_async_font_css( $html, $handle ) {
	if ( 'dworek-fonts' !== $handle ) {
		return $html;
	}
	$async = str_replace(
		"media='all'",
		"media='print' onload=\"this.media='all'\"",
		$html
	);
	// Gdy z jakiegoś powodu nie podmieniono media (inny format znacznika) —
	// zostaw oryginał (blokujący, ale działający), żeby nic nie zepsuć.
	if ( $async === $html ) {
		return $html;
	}
	$noscript = '<noscript>' . $html . '</noscript>';
	return $async . $noscript;
}
add_filter( 'style_loader_tag', 'dworek_async_font_css', 10, 2 );


/* =========================================================================
 * 3. MENU — aktywny link (.is-active) + przycisk CTA (.nav__cta)
 * ========================================================================= */

/**
 * Dodaje klasę .is-active do bieżącej pozycji oraz klasy przycisku
 * do pozycji oznaczonej w panelu klasą CSS "nav__cta".
 */
function dworek_nav_link_atts( $atts, $item, $args ) {
	if ( empty( $args->theme_location ) || 'primary' !== $args->theme_location ) {
		return $atts;
	}

	$classes = array();

	if ( ! empty( $item->current ) || in_array( 'current-menu-item', (array) $item->classes, true ) ) {
		$classes[] = 'is-active';
	}

	if ( in_array( 'nav__cta', (array) $item->classes, true ) ) {
		$classes[]            = 'btn';
		$classes[]            = 'btn--primary';
		$atts['style']        = 'color:#fff';
	}

	if ( $classes ) {
		$atts['class'] = trim( ( isset( $atts['class'] ) ? $atts['class'] . ' ' : '' ) . implode( ' ', $classes ) );
	}

	return $atts;
}
add_filter( 'nav_menu_link_attributes', 'dworek_nav_link_atts', 10, 3 );

/**
 * Awaryjne menu główne — używane, dopóki klient nie zbuduje własnego
 * menu w Wygląd → Menu i nie przypisze go do lokalizacji „Menu główne".
 * Zawiera pozycję „Zdalne" (logowanie do WordPress) przed „Kontakt".
 */
function dworek_primary_menu_fallback() {
	$login_url = wp_login_url( home_url( '/' ) );
	$items     = array(
		array( 'url' => home_url( '/' ),            'label' => 'Start',         'slug' => '' ),
		array( 'url' => home_url( '/o-nas/' ),      'label' => 'O nas',         'slug' => 'o-nas' ),
		array( 'url' => home_url( '/oferta/' ),     'label' => 'Program',       'slug' => 'oferta' ),
		array( 'url' => home_url( '/kadra/' ),      'label' => 'Kadra',         'slug' => 'kadra' ),
		array( 'url' => home_url( '/wsparcie/' ),   'label' => 'WWR i terapia', 'slug' => 'wsparcie' ),
		array( 'url' => home_url( '/galeria/' ),    'label' => 'Galeria',       'slug' => 'galeria' ),
		array( 'url' => home_url( '/blog/' ),       'label' => 'Blog',          'slug' => 'blog' ),
		array( 'url' => $login_url,                 'label' => 'Zdalne',        'slug' => '__login' ),
		array( 'url' => home_url( '/kontakt/' ),    'label' => 'Kontakt',       'slug' => 'kontakt' ),
	);

	echo '<ul id="nav-links" class="nav__links">';
	foreach ( $items as $it ) {
		$active = '';
		if ( '' === $it['slug'] && is_front_page() ) {
			$active = ' class="is-active"';
		} elseif ( $it['slug'] && '__login' !== $it['slug'] && is_page( $it['slug'] ) ) {
			$active = ' class="is-active"';
		}
		printf(
			'<li><a href="%s"%s>%s</a></li>',
			esc_url( $it['url'] ),
			$active,
			esc_html( $it['label'] )
		);
	}
	// CTA „Zapisz dziecko".
	printf(
		'<li class="nav__cta"><a class="btn btn--primary" style="color:#fff" href="%s">%s</a></li>',
		esc_url( home_url( '/kontakt/' ) ),
		esc_html__( 'Zapisz dziecko', 'czarodziejski-dworek' )
	);
	echo '</ul>';
}


/* =========================================================================
 * 4. POLA ACF — pomocnik z fallbackiem (gdy wtyczka nieaktywna)
 * ========================================================================= */

/**
 * Bezpieczne pobranie pola ACF. Gdy ACF nie jest zainstalowane
 * lub pole jest puste — zwraca wartość domyślną (treść z projektu),
 * dzięki czemu strona wygląda 1:1 nawet bez ACF.
 *
 * @param string $name    Nazwa pola ACF.
 * @param mixed  $default Wartość domyślna (oryginalna treść).
 * @param int|null $post_id ID wpisu/strony lub null = bieżący.
 * @return mixed
 */
function dworek_field( $name, $default = '', $post_id = null ) {
	if ( function_exists( 'get_field' ) ) {
		$value = get_field( $name, $post_id );
		if ( null !== $value && '' !== $value && false !== $value ) {
			return $value;
		}
	}
	return $default;
}

/**
 * Echo wersja dworek_field() dla prostych tekstów.
 */
function dworek_the_field( $name, $default = '', $post_id = null ) {
	echo wp_kses_post( dworek_field( $name, $default, $post_id ) );
}

/**
 * Renderuje tekst nagłówka z akcentem: fragment w [nawiasach kwadratowych]
 * zostaje opakowany w <span class="accent"> (kolorowe wyróżnienie).
 * Reszta tekstu jest bezpiecznie escapowana.
 *
 * @param string $text Tekst, np. „Tu odkrywamy [mocne strony] Twojego dziecka".
 * @return string Bezpieczny HTML.
 */
function dworek_accent( $text ) {
	$safe = esc_html( $text );
	return preg_replace( '/\[(.+?)\]/', '<span class="accent">$1</span>', $safe );
}

/**
 * Renderuje pozycje listy „odhaczanej" (checklist) z tekstu, w którym
 * każda niepusta linia = jeden punkt. Każdy punkt dostaje ikonę „✓".
 * Dzięki temu klient edytuje listę zwykłym polem tekstowym (1 linia = 1 punkt),
 * bez potrzeby płatnych pól powtarzalnych ACF.
 *
 * @param string $text Tekst wieloliniowy z pola ACF (lub treść domyślna).
 * @return string Bezpieczny HTML: kolejne <li> … </li>.
 */
function dworek_checklist( $text ) {
	$lines = preg_split( '/\r\n|\r|\n/', (string) $text );
	$svg   = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>';
	$out   = '';
	foreach ( $lines as $line ) {
		$line = trim( $line );
		if ( '' === $line ) {
			continue;
		}
		$out .= '<li>' . $svg . ' ' . esc_html( $line ) . '</li>';
	}
	return $out;
}

/**
 * Renderuje pozycje zwykłej listy (bez ikony „✓") z tekstu wieloliniowego —
 * każda niepusta linia = jeden punkt <li>. Używane np. w „obszarach programu".
 *
 * @param string $text Tekst wieloliniowy z pola ACF (lub treść domyślna).
 * @return string Bezpieczny HTML: kolejne <li> … </li>.
 */
function dworek_lines( $text ) {
	$lines = preg_split( '/\r\n|\r|\n/', (string) $text );
	$out   = '';
	foreach ( $lines as $line ) {
		$line = trim( $line );
		if ( '' === $line ) {
			continue;
		}
		$out .= '<li>' . esc_html( $line ) . '</li>';
	}
	return $out;
}

// Rejestracja grup pól ACF (jeśli wtyczka aktywna).
require get_template_directory() . '/inc/acf-fields.php';

// Typ treści „Kadra" (nauczyciele/specjaliści edytowalni z panelu).
require get_template_directory() . '/inc/cpt-kadra.php';

// Globalne dane kontaktowe (Dostosuj → „Dane kontaktowe") + helper dworek_contact().
require get_template_directory() . '/inc/site-contact.php';

// Obsługa formularzy kontaktowych (wysyłka e-mail przez wp_mail).
require get_template_directory() . '/inc/contact-form.php';

// SEO: meta description, canonical, Open Graph, Twitter Cards, robots,
// breadcrumbs (mikrodane) + JSON-LD (WebSite, BreadcrumbList, Article).
require get_template_directory() . '/inc/seo.php';


/* =========================================================================
 * 5. DROBNE USPRAWNIENIA
 * ========================================================================= */

// Długość zajawki (excerpt) wpisów.
function dworek_excerpt_length() {
	return 26;
}
add_filter( 'excerpt_length', 'dworek_excerpt_length' );

/**
 * Etykieta pierwszej kategorii bieżącego wpisu (do plakietki na karcie).
 *
 * @return string
 */
function dworek_post_cat_label() {
	$cats = get_the_category();
	if ( ! empty( $cats ) ) {
		return $cats[0]->name;
	}
	return '';
}

/**
 * Renderuje kartę wpisu w stylu projektu.
 * - Gdy wpis MA obraz wyróżniający → karta ze zdjęciem (.card.pic-card.blog-card),
 *   identyczna jak na stronie Bloga.
 * - Gdy NIE ma → czysta kafelka tekstowa (.card.blog-card), jak „Aktualności"
 *   na stronie głównej (bez zastępczych obrazków).
 * Wywoływać wewnątrz pętli (the_post()).
 */
function dworek_post_card() {
	$cat     = dworek_post_cat_label();
	$excerpt = wp_trim_words( get_the_excerpt(), 22, '…' );

	if ( has_post_thumbnail() ) :
		?>
		<a class="card pic-card blog-card" href="<?php the_permalink(); ?>">
			<span class="blog-card__media">
				<?php the_post_thumbnail( 'dworek-card', array( 'loading' => 'lazy', 'decoding' => 'async' ) ); ?>
				<?php if ( $cat ) : ?><span class="tag tag--over"><?php echo esc_html( $cat ); ?></span><?php endif; ?>
			</span>
			<div class="pic-card__body">
				<time class="date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
				<h3><?php the_title(); ?></h3>
				<p class="excerpt"><?php echo esc_html( $excerpt ); ?></p>
				<span class="more">Czytaj więcej →</span>
			</div>
		</a>
		<?php
	else :
		?>
		<article class="card blog-card reveal">
			<time class="date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
			<h3><?php the_title(); ?></h3>
			<p><?php echo esc_html( $excerpt ); ?></p>
			<a class="more" href="<?php the_permalink(); ?>">Czytaj więcej →</a>
		</article>
		<?php
	endif;
}

// „Czytaj więcej" zamiast [...].
function dworek_excerpt_more() {
	return '…';
}
add_filter( 'excerpt_more', 'dworek_excerpt_more' );

/**
 * JSON-LD (Schema.org Preschool) — tożsamość organizacji.
 *
 * Wypisywane na KAŻDEJ stronie z trwałym @id „#organization”, dzięki czemu
 * odwołania `publisher` z modułu SEO (WebSite, Article) zawsze się rozwiązują.
 * Dane wyłącznie prawdziwe — bez fabrykowanych ocen/opinii.
 */
function dworek_jsonld() {
	$data = array(
		'@context'      => 'https://schema.org',
		// Typy: Preschool (semantyka przedszkola) + LocalBusiness (pola
		// priceRange/openingHours, lokalne SEO) + EducationalOrganization +
		// Organization (jawnie — część walidatorów szuka tych nazw dosłownie).
		'@type'         => array( 'Preschool', 'LocalBusiness', 'EducationalOrganization', 'Organization' ),
		'@id'           => home_url( '/#organization' ),
		'name'          => 'Integracyjne Przedszkole Niepubliczne Językowo-Muzyczne „Czarodziejski Dworek”',
		'alternateName' => 'Czarodziejski Dworek',
		'url'           => home_url( '/' ),
		'logo'          => array(
			'@type' => 'ImageObject',
			'url'   => get_template_directory_uri() . '/img/logo.png',
		),
		'image'         => get_template_directory_uri() . '/img/hero.webp',
		'description'   => 'Niepubliczne przedszkole językowo-muzyczne na warszawskiej Woli — małe grupy do 14 dzieci, języki, basen, muzyka i bezpłatne terapie.',
		'telephone'     => '+48690629501',
		'email'         => 'kontakt@czarodziejski-dworek.pl',
		'foundingDate'  => '2003',
		'taxID'         => '524-246-20-37',
		'priceRange'    => '$$',
		'currenciesAccepted' => 'PLN',
		'areaServed'    => array(
			'@type' => 'City',
			'name'  => 'Warszawa',
		),
		'address'       => array(
			'@type'           => 'PostalAddress',
			'streetAddress'   => 'ul. Górczewska 89',
			'postalCode'      => '01-401',
			'addressLocality' => 'Warszawa',
			'addressRegion'   => 'mazowieckie',
			'addressCountry'  => 'PL',
		),
		'hasMap'        => 'https://www.google.com/maps?q=ul.+G%C3%B3rczewska+89,+01-401+Warszawa',
		'openingHoursSpecification' => array(
			'@type'     => 'OpeningHoursSpecification',
			'dayOfWeek' => array( 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday' ),
			'opens'     => '07:00',
			'closes'    => '18:00',
		),
		'knowsLanguage' => array( 'pl', 'en', 'fr' ),
		'sameAs'        => array( 'https://www.facebook.com/czarodziejskidworek/' ),
	);

	// UWAGA: NIE dodajemy tu review/aggregateRating. Google nie honoruje
	// „self-serving reviews" (opinii o firmie publikowanych przez samą firmę)
	// dla LocalBusiness/Organization — wywołałyby ostrzeżenie w Rich Results.
	// Opinie rodziców zostają widoczne na stronie (sekcja „Opinie") dla CRO.

	echo '<script type="application/ld+json">' . wp_json_encode( $data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
}
add_action( 'wp_head', 'dworek_jsonld' );
