<?php
/**
 * Szablon pojedynczego wpisu (single.php).
 * Układ artykułu 1:1 z projektu (.article), treść przez the_content().
 *
 * @package Czarodziejski_Dworek
 */

get_header();

while ( have_posts() ) :
	the_post();
	$cat_label = dworek_post_cat_label();
	?>

<section class="page-hero">
	<div class="container reveal">
		<span class="eyebrow"><?php echo esc_html( $cat_label ? $cat_label : 'Aktualności' ); ?></span>
		<h1><?php the_title(); ?></h1>
		<p class="breadcrumb"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Start</a> / <a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>">Blog</a> / <?php the_title(); ?></p>
	</div>
</section>

<section class="section">
	<div class="container">
		<article <?php post_class( 'article reveal' ); ?>>
			<a class="article-back" href="<?php echo esc_url( home_url( '/blog/' ) ); ?>"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 5l-7 7 7 7"/></svg>Wróć na blog</a>
			<div class="article-meta"><time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time> · <span>Zespół Czarodziejskiego Dworku</span></div>

			<?php if ( has_post_thumbnail() ) : ?>
				<?php the_post_thumbnail( 'large', array( 'class' => 'article-hero-img', 'decoding' => 'async' ) ); ?>
			<?php endif; ?>

			<div class="article-body">
				<?php the_content(); ?>
			</div>

			<?php
			wp_link_pages(
				array(
					'before' => '<div class="article-pages">' . esc_html__( 'Strony:', 'czarodziejski-dworek' ) . ' ',
					'after'  => '</div>',
				)
			);
			?>

			<div class="article-foot">
				<a class="article-back" href="<?php echo esc_url( home_url( '/blog/' ) ); ?>"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 5l-7 7 7 7"/></svg>Wróć na blog</a>
				<a class="btn btn--primary" href="<?php echo esc_url( home_url( '/kontakt/' ) ); ?>">Zapisz dziecko</a>
			</div>
		</article>
	</div>
</section>

	<?php
	// „Zobacz też" — najnowsze wpisy z tej samej kategorii (bez bieżącego).
	$cats     = wp_get_post_categories( get_the_ID() );
	$rel_args = array(
		'post_type'           => 'post',
		'posts_per_page'      => 3,
		'post__not_in'        => array( get_the_ID() ),
		'ignore_sticky_posts' => true,
		'no_found_rows'       => true,
	);
	if ( ! empty( $cats ) ) {
		$rel_args['category__in'] = $cats;
	}
	$related = new WP_Query( $rel_args );
	if ( $related->have_posts() ) :
		?>
	<section class="section section--tight sec-warm">
		<div class="container post-extra">
			<div class="related-head"><span class="eyebrow" style="margin-inline:auto">Czytaj dalej</span><h2>Zobacz też</h2></div>
			<div class="grid cols-3">
				<?php
				while ( $related->have_posts() ) :
					$related->the_post();
					dworek_post_card();
				endwhile;
				wp_reset_postdata();
				?>
			</div>
		</div>
	</section>
	<?php endif; ?>

<section class="section cta-band">
	<div class="container">
		<div class="card reveal">
			<h2>Zapraszamy do Czarodziejskiego Dworku</h2>
			<p style="margin-inline:auto">Umów wizytę albo zadzwoń — chętnie opowiemy o naszym przedszkolu i odpowiemy na pytania.</p>
			<div class="btn-row"><a href="<?php echo esc_url( home_url( '/kontakt/' ) ); ?>" class="btn btn--primary btn--lg">Skontaktuj się</a></div>
		</div>
	</div>
</section>

	<?php
endwhile;

get_footer();
