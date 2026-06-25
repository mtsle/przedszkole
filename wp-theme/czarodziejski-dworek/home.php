<?php
/**
 * Szablon strony wpisów (Blog) — home.php.
 *
 * Odtwarza oryginalny, „ładny" układ bloga: wyróżniony wpis, filtry kategorii
 * z licznikami, wyszukiwarka i kafelki ze zdjęciami. Układ buduje js/main.js
 * na podstawie danych window.BLOG / window.BLOG_CATS, które tworzymy tutaj
 * dynamicznie z PRAWDZIWYCH wpisów WordPress (tytuł, data, kategoria, link, zdjęcie).
 *
 * @package Czarodziejski_Dworek
 */

get_header();

$theme = get_template_directory_uri();

/* Domyślne zdjęcia kafelków (gdy wpis nie ma obrazka wyróżniającego) —
   odwzorowanie oryginalnego bloga. Klient może nadpisać, ustawiając
   „Obraz wyróżniający" w danym wpisie. */
$dw_img_map = array(
	'dzien-otwarty-2025'          => '/img/real/blog/dzien-otwarty-2025.webp',
	'szkola-myslenia-pozytywnego' => '/img/real/blog/szkola-myslenia.webp',
	'angielski-wrzesien-2024'     => '/img/real/angielski.webp',
	'piknik-jubileuszowy'         => '/img/real/blog/piknik.webp',
	'dzien-otwarty-2024'          => '/img/real/blog/dzien-otwarty-2024.webp',
	'francuski-grudzien-2023'     => '/img/real/francuski.webp',
	'dni-wolne-2023-2024'         => '/img/real/blog/dni-wolne.webp',
);

$dw_months = array( 1 => 'stycznia', 'lutego', 'marca', 'kwietnia', 'maja', 'czerwca', 'lipca', 'sierpnia', 'września', 'października', 'listopada', 'grudnia' );

$dw_blog      = array();
$dw_cats_used = array();

$dw_q = new WP_Query(
	array(
		'post_type'           => 'post',
		'posts_per_page'      => -1,
		'ignore_sticky_posts' => true,
		'no_found_rows'       => true,
	)
);
while ( $dw_q->have_posts() ) :
	$dw_q->the_post();
	$id    = get_the_ID();
	$slug  = get_post_field( 'post_name', $id );
	$terms = get_the_category();
	$cat   = ! empty( $terms ) ? $terms[0]->slug : 'aktualnosci';
	if ( ! empty( $terms ) ) {
		foreach ( $terms as $tt ) {
			$dw_cats_used[ $tt->slug ] = $tt->name;
		}
	}

	if ( has_post_thumbnail() ) {
		$img = get_the_post_thumbnail_url( $id, 'large' );
	} elseif ( isset( $dw_img_map[ $slug ] ) ) {
		$img = $theme . $dw_img_map[ $slug ];
	} else {
		$img = $theme . '/img/hero.webp';
	}

	$dw_blog[] = array(
		'slug'     => $slug,
		'title'    => html_entity_decode( get_the_title(), ENT_QUOTES, 'UTF-8' ),
		'date'     => get_the_date( 'Y-m-d' ),
		'dateText' => (int) get_the_date( 'j' ) . ' ' . $dw_months[ (int) get_the_date( 'n' ) ] . ' ' . get_the_date( 'Y' ),
		'cat'      => $cat,
		'img'      => $img,
		'url'      => get_permalink(),
		'excerpt'  => html_entity_decode( wp_strip_all_tags( get_the_excerpt() ), ENT_QUOTES, 'UTF-8' ),
	);
endwhile;
wp_reset_postdata();

/* Kolejność i etykiety filtrów — wg oryginału, tylko kategorie, które mają wpisy. */
$dw_cat_order = array( 'aktualnosci', 'wydarzenia', 'porady', 'adaptacja', 'rozwoj', 'jezykowe', 'wwr', 'zycie' );
$dw_blog_cats = array();
foreach ( $dw_cat_order as $cs ) {
	if ( isset( $dw_cats_used[ $cs ] ) ) {
		$dw_blog_cats[] = array( 'slug' => $cs, 'label' => $dw_cats_used[ $cs ] );
		unset( $dw_cats_used[ $cs ] );
	}
}
foreach ( $dw_cats_used as $cs => $label ) { // ewentualne pozostałe kategorie
	$dw_blog_cats[] = array( 'slug' => $cs, 'label' => $label );
}
?>

<section class="page-hero">
	<div class="container reveal">
		<span class="eyebrow">Blog</span>
		<h1>Co słychać w Dworku</h1>
		<p class="lead" style="margin:.6rem auto 0;max-width:60ch">Aktualności, wydarzenia i wskazówki dla rodziców — wszystko, czym żyje nasze przedszkole, w jednym miejscu.</p>
		<p class="breadcrumb"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Start</a> / Blog</p>
	</div>
</section>

<section class="section">
	<div class="container">
		<div id="blog-featured" class="reveal"></div>
		<div class="blog-toolbar reveal">
			<div class="blog-search">
				<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3"/></svg>
				<input id="blog-search" type="search" placeholder="Szukaj wpisu…" aria-label="Szukaj wpisu" autocomplete="off">
			</div>
			<span class="blog-count" id="blog-count" aria-live="polite"></span>
		</div>
		<div id="blog-filters" class="gallery-filters reveal" role="group" aria-label="Filtruj wpisy według kategorii"></div>
		<div id="blog-list" class="grid cols-3" aria-live="polite"></div>

		<?php if ( empty( $dw_blog ) ) : ?>
			<div class="blog-empty">
				<div class="ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3"/></svg></div>
				<h3>Brak wpisów</h3>
				<p>Już wkrótce pojawią się tu nasze aktualności.</p>
			</div>
		<?php endif; ?>
	</div>
</section>

<script>
window.BLOG_CATS = <?php echo wp_json_encode( $dw_blog_cats ); ?>;
window.BLOG = <?php echo wp_json_encode( $dw_blog ); ?>;
</script>

<section class="section section--tight sec-warm">
	<div class="container">
		<div class="card reveal" style="text-align:center;max-width:780px;margin-inline:auto">
			<span class="eyebrow" style="margin-inline:auto">Bądź na bieżąco</span>
			<h2>Najświeższe wieści znajdziesz u nas na Facebooku</h2>
			<p style="margin-inline:auto">Terminy zapisów, zdjęcia z zajęć i bieżące informacje publikujemy regularnie na naszym profilu. Dołącz i bądź blisko życia przedszkola.</p>
			<div class="btn-row" style="display:flex;gap:var(--s-2);justify-content:center;flex-wrap:wrap;margin-top:var(--s-3)">
				<a href="https://www.facebook.com/czarodziejskidworek/" target="_blank" rel="noopener" class="btn btn--primary">Obserwuj na Facebooku</a>
				<a href="<?php echo esc_url( home_url( '/kontakt/' ) ); ?>" class="btn btn--ghost">Napisz do nas</a>
			</div>
		</div>
	</div>
</section>

<section class="section cta-band">
	<div class="container">
		<div class="card reveal">
			<h2>Chcesz zobaczyć Dworek na żywo?</h2>
			<p style="margin-inline:auto">Zapraszamy na dzień otwarty albo umów indywidualną wizytę — pokażemy Wam nasze sale, ogród i zespół.</p>
			<div class="btn-row"><a href="<?php echo esc_url( home_url( '/kontakt/' ) ); ?>" class="btn btn--primary btn--lg">Umów wizytę</a></div>
		</div>
	</div>
</section>

<?php
get_footer();
