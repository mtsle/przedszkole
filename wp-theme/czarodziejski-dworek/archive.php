<?php
/**
 * Szablon archiwów (kategorie, tagi, daty, autor).
 * Lista wpisów w stylu projektu (karty .blog-card) z paginacją.
 *
 * @package Czarodziejski_Dworek
 */

get_header();
?>

<section class="page-hero">
	<div class="container reveal">
		<span class="eyebrow">Aktualności</span>
		<h1><?php the_archive_title(); ?></h1>
		<?php
		$desc = get_the_archive_description();
		if ( $desc ) :
			?>
			<p class="lead" style="margin:.6rem auto 0;max-width:60ch"><?php echo wp_kses_post( $desc ); ?></p>
		<?php endif; ?>
		<p class="breadcrumb"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Start</a> / <a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>">Blog</a> / <?php echo esc_html( wp_strip_all_tags( get_the_archive_title() ) ); ?></p>
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
				<p>W tej sekcji nie ma jeszcze wpisów.</p>
			</div>
		<?php endif; ?>
	</div>
</section>

<?php
get_footer();
