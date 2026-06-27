<?php
/**
 * Szablon podstrony: Galeria (page-galeria.php)
 *
 * Wygenerowano z galeria.html — wygląd odwzorowany 1:1. Układ stały;
 * teksty można w przyszłości wystawić na pola ACF (helper dworek_field()).
 *
 * Wymaga strony WordPress o uchwycie (slug): "galeria".
 *
 * @package Czarodziejski_Dworek
 */

get_header();
$t = get_template_directory_uri();
?>

<section class="page-hero">
  <div class="container reveal">
    <span class="eyebrow"><?php echo esc_html( dworek_field( 'page_eyebrow', 'Galeria' ) ); ?></span>
    <h1><?php echo esc_html( dworek_field( 'page_hero_title', 'Chwile z życia Dworku' ) ); ?></h1>
    <p class="lead" style="margin:.6rem auto 0;max-width:58ch"><?php echo esc_html( dworek_field( 'page_hero_lead', 'Zajrzyj do naszego świata — zajęcia, zabawy i radosne momenty z codzienności przedszkola.' ) ); ?></p>
    <?php dworek_breadcrumbs(); ?>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="gallery-filters reveal" role="group" aria-label="Filtruj zdjęcia">
      <button type="button" data-filter="all" class="is-active" aria-pressed="true"><?php echo esc_html( dworek_field( 'ga_f_all', 'Wszystkie' ) ); ?></button>
      <button type="button" data-filter="sale" aria-pressed="false"><?php echo esc_html( dworek_field( 'ga_f_sale', 'Sale' ) ); ?></button>
      <button type="button" data-filter="zajecia" aria-pressed="false"><?php echo esc_html( dworek_field( 'ga_f_zajecia', 'Zajęcia' ) ); ?></button>
      <button type="button" data-filter="plac" aria-pressed="false"><?php echo esc_html( dworek_field( 'ga_f_plac', 'Plac zabaw' ) ); ?></button>
      <button type="button" data-filter="warsztaty" aria-pressed="false"><?php echo esc_html( dworek_field( 'ga_f_warsztaty', 'Warsztaty' ) ); ?></button>
      <button type="button" data-filter="wycieczki" aria-pressed="false"><?php echo esc_html( dworek_field( 'ga_f_wycieczki', 'Wycieczki' ) ); ?></button>
    </div>
    <div id="jgallery" class="jgallery" aria-live="polite"></div>
  </div>
</section>

<section class="section cta-band">
  <div class="container">
    <div class="card reveal">
      <h2><?php echo esc_html( dworek_field( 'ga_cta_title', 'Chcesz zobaczyć więcej?' ) ); ?></h2>
      <p style="margin-inline:auto"><?php echo esc_html( dworek_field( 'ga_cta_text', 'Najlepsze chwile dzieją się na żywo. Umów bezpłatne zwiedzanie i zobacz nasze przedszkole od środka.' ) ); ?></p>
      <div class="btn-row"><a href="<?php echo esc_url( home_url( '/kontakt/' ) ); ?>" class="btn btn--primary btn--lg"><?php echo esc_html( dworek_field( 'ga_cta_btn', 'Umów wizytę' ) ); ?></a></div>
    </div>
  </div>
</section>

<?php
get_footer();
