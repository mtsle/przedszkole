<?php
/**
 * Domyślny szablon strony (page.php).
 * Używany dla stron, które nie mają własnego szablonu page-{slug}.php.
 * Nagłówek (eyebrow / tytuł / lead) edytowalny przez ACF; treść — edytor WordPress.
 *
 * @package Czarodziejski_Dworek
 */

get_header();

while ( have_posts() ) :
	the_post();

	$eyebrow = dworek_field( 'page_eyebrow', '' );
	$heading = dworek_field( 'page_hero_title', get_the_title() );
	$lead    = dworek_field( 'page_hero_lead', '' );
	?>

<section class="page-hero">
	<div class="container reveal">
		<?php if ( $eyebrow ) : ?><span class="eyebrow"><?php echo esc_html( $eyebrow ); ?></span><?php endif; ?>
		<h1><?php echo esc_html( $heading ); ?></h1>
		<?php if ( $lead ) : ?><p class="lead" style="margin:.6rem auto 0;max-width:60ch"><?php echo esc_html( $lead ); ?></p><?php endif; ?>
		<p class="breadcrumb"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Start</a> / <?php the_title(); ?></p>
	</div>
</section>

<section class="section">
	<div class="container">
		<article <?php post_class( 'article reveal' ); ?>>
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
		</article>
	</div>
</section>

	<?php
endwhile;

get_footer();
