<?php
/**
 * Główny szablon zapasowy + strona wpisów (Blog).
 * Lista wpisów w stylu projektu (karty .blog-card) z paginacją.
 *
 * @package Czarodziejski_Dworek
 */

get_header();

$blog_title = single_post_title( '', false );
if ( is_home() && ! is_front_page() ) {
	$page_for_posts = (int) get_option( 'page_for_posts' );
	$blog_title     = $page_for_posts ? get_the_title( $page_for_posts ) : 'Blog';
}
if ( ! $blog_title ) {
	$blog_title = 'Blog';
}
?>

<section class="page-hero">
	<div class="container reveal">
		<span class="eyebrow">Aktualności</span>
		<h1><?php echo esc_html( $blog_title ); ?></h1>
		<p class="lead" style="margin:.6rem auto 0;max-width:60ch">Co słychać w Czarodziejskim Dworku — wydarzenia, materiały i życie przedszkola.</p>
		<p class="breadcrumb"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Start</a> / <?php echo esc_html( $blog_title ); ?></p>
	</div>
</section>

<section class="section">
	<div class="container">
		<?php if ( have_posts() ) : ?>
			<div class="grid cols-3">
				<?php
				while ( have_posts() ) :
					the_post();
					dworek_post_card();
				endwhile;
				?>
			</div>

			<?php
			the_posts_pagination(
				array(
					'mid_size'  => 1,
					'prev_text' => '← Poprzednie',
					'next_text' => 'Następne →',
					'class'     => 'dworek-pagination',
				)
			);
			?>
		<?php else : ?>
			<div class="blog-empty">
				<div class="ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3"/></svg></div>
				<h3>Brak wpisów</h3>
				<p>Już wkrótce pojawią się tu nasze aktualności.</p>
			</div>
		<?php endif; ?>
	</div>
</section>

<?php
get_footer();
