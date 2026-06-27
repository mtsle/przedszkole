<?php
/**
 * Szablon 404 — strona nie znaleziona.
 *
 * @package Czarodziejski_Dworek
 */

get_header();
?>

<section class="page-hero">
	<div class="container reveal">
		<span class="eyebrow">Błąd 404</span>
		<h1>Nie znaleziono strony</h1>
		<p class="lead" style="margin:.6rem auto 0;max-width:60ch">Wygląda na to, że ta strona zniknęła jak za dotknięciem czarodziejskiej różdżki. Sprawdź adres lub wróć na stronę główną.</p>
		<?php dworek_breadcrumbs(); ?>
	</div>
</section>

<section class="section">
	<div class="container center">
		<div class="card reveal" style="max-width:560px;margin-inline:auto">
			<h2>Czego szukasz?</h2>
			<p style="margin-inline:auto">Skorzystaj z wyszukiwarki albo przejdź do jednej z głównych sekcji.</p>
			<div style="max-width:420px;margin:var(--s-3) auto 0"><?php get_search_form(); ?></div>
			<div class="btn-row" style="margin-top:var(--s-3);justify-content:center">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn--primary btn--lg">Strona główna</a>
				<a href="<?php echo esc_url( home_url( '/kontakt/' ) ); ?>" class="btn btn--ghost btn--lg">Kontakt</a>
			</div>
		</div>
	</div>
</section>

<?php
get_footer();
