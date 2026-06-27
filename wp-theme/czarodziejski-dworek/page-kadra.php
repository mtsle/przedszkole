<?php
/**
 * Szablon podstrony: Kadra (page-kadra.php).
 *
 * Nauczyciele i specjaliści pochodzą z typu treści „Kadra" (CPT) — klient
 * dodaje/edytuje/usuwa ich w panelu WordPress. Układ i wygląd 1:1 z projektu.
 * Modal z biogramem buduje js/main.js na podstawie window.DWOREK_PEOPLE.
 *
 * Wymaga strony WordPress o uchwycie (slug): "kadra".
 *
 * @package Czarodziejski_Dworek
 */

get_header();
$t = get_template_directory_uri();

/* Grupy: slug, nadtytuł, nagłówek, sec-warm?, styl siatki. */
$dw_groups = array(
	array( 'dyrekcja',    'Dyrekcja',                'Założycielka przedszkola',        false, ' style="grid-template-columns:minmax(240px,300px);justify-content:center"' ),
	array( 'nauczyciele', 'Nauczyciele i pedagodzy', 'Wychowawcy z sercem',             true,  '' ),
	array( 'lektorzy',    'Lektorzy i muzyka',       'Języki, rytm i melodia',          false, ' style="grid-template-columns:repeat(3,1fr)"' ),
	array( 'specjalisci', 'Zespół specjalistów',     'Wsparcie na najwyższym poziomie', true,  '' ),
);

$dw_people_js = array();
$dw_mono_i    = 0;
?>

<section class="page-hero">
	<div class="container reveal">
		<span class="eyebrow">Nasza kadra</span>
		<h1>Ludzie, którym możesz zaufać</h1>
		<p class="lead" style="margin:.6rem auto 0;max-width:64ch">Nasz zespół to wykwalifikowani nauczyciele i lektorzy oraz specjaliści na miejscu — logopeda, psycholog, terapeuta integracji sensorycznej i pedagog — których łączy pasja i wieloletnie doświadczenie w pracy z dziećmi.</p>
		<?php dworek_breadcrumbs(); ?>
	</div>
</section>

<?php
foreach ( $dw_groups as $g ) :
	list( $g_slug, $g_eyebrow, $g_title, $g_warm, $g_style ) = $g;

	$q = new WP_Query(
		array(
			'post_type'      => 'kadra',
			'posts_per_page' => -1,
			'orderby'        => 'menu_order title',
			'order'          => 'ASC',
			'no_found_rows'  => true,
			'meta_query'     => array(
				array(
					'key'   => 'grupa',
					'value' => $g_slug,
				),
			),
		)
	);

	if ( ! $q->have_posts() ) {
		wp_reset_postdata();
		continue;
	}
	?>
	<section class="section<?php echo $g_warm ? ' sec-warm' : ''; ?>">
		<div class="container">
			<div class="section-head reveal">
				<span class="eyebrow"><?php echo esc_html( $g_eyebrow ); ?></span>
				<h2><?php echo esc_html( $g_title ); ?></h2>
			</div>
			<div class="grid team-grid"<?php echo $g_style; // phpcs:ignore ?>>
				<?php
				$i = 0;
				while ( $q->have_posts() ) :
					$q->the_post();
					$id    = get_the_ID();
					$pslug = get_post_field( 'post_name', $id );
					$name  = get_the_title();
					$rola  = (string) get_post_meta( $id, 'rola', true );
					$bio   = (string) get_post_meta( $id, 'bio', true );
					$photo = dworek_kadra_photo( $id );
					$delay = $i ? ' data-delay="' . esc_attr( (string) min( $i, 3 ) ) . '"' : '';

					$bio_lines = array_values( array_filter( array_map( 'trim', preg_split( '/\r\n|\r|\n/', $bio ) ), 'strlen' ) );
					$dw_people_js[ $pslug ] = array( 'role' => $rola, 'bio' => $bio_lines );
					?>
					<article class="card team-card reveal"<?php echo $delay; // phpcs:ignore ?> data-person="<?php echo esc_attr( $pslug ); ?>">
						<?php if ( $photo ) : ?>
							<img loading="lazy" decoding="async" src="<?php echo esc_url( $photo ); ?>" alt="<?php echo esc_attr( $name ); ?>" width="130" height="130">
						<?php else : ?>
							<?php $dw_mono_i++; ?>
							<div class="mono mono--<?php echo (int) ( ( ( $dw_mono_i - 1 ) % 6 ) + 1 ); ?>" aria-hidden="true"><?php echo esc_html( dworek_kadra_initials( $name ) ); ?></div>
						<?php endif; ?>
						<h3><?php echo esc_html( $name ); ?></h3>
						<?php if ( $rola && 'nauczyciele' !== $g_slug ) : ?>
							<p class="role"><?php echo esc_html( $rola ); ?></p>
						<?php endif; ?>
					</article>
					<?php
					$i++;
				endwhile;
				?>
			</div>
		</div>
	</section>
	<?php
	wp_reset_postdata();
endforeach;
?>

<script>
window.DWOREK_PEOPLE = <?php echo wp_json_encode( $dw_people_js ); ?>;
</script>

<section class="section cta-band">
	<div class="container">
		<div class="card reveal">
			<h2>Chcesz poznać nas osobiście?</h2>
			<p style="margin-inline:auto">Zapraszamy na dzień otwarty — poznasz kadrę i zobaczysz, jak pracujemy z dziećmi.</p>
			<div class="btn-row"><a href="<?php echo esc_url( home_url( '/kontakt/' ) ); ?>" class="btn btn--primary btn--lg">Umów wizytę</a><a href="<?php echo esc_url( home_url( '/galeria/' ) ); ?>" class="btn btn--ghost btn--lg">Zobacz galerię</a></div>
		</div>
	</div>
</section>

<?php
get_footer();
