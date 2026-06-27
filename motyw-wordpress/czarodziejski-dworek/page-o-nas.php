<?php
/**
 * Szablon podstrony: O nas (page-o-nas.php)
 *
 * Wygląd odwzorowany 1:1 z o-nas.html. Układ stały, ikony i obrazy w kodzie.
 * CAŁY TEKST jest edytowalny z panelu (pola ACF — grupa „O nas — treść strony").
 * Bez wtyczki ACF motyw nadal działa: dworek_field() zwraca treść domyślną.
 *
 * Wymaga strony WordPress o uchwycie (slug): "o-nas".
 *
 * @package Czarodziejski_Dworek
 */

get_header();
$t = get_template_directory_uri();
?>

<section class="page-hero">
  <div class="container reveal">
    <span class="eyebrow"><?php echo esc_html( dworek_field( 'page_eyebrow', 'O „Czarodziejskim Dworku"' ) ); ?></span>
    <h1><?php echo esc_html( dworek_field( 'page_hero_title', 'Magiczne miejsce, w którym dzieci rosną' ) ); ?></h1>
    <p class="lead" style="margin:.6rem auto 0;max-width:60ch"><?php echo esc_html( dworek_field( 'page_hero_lead', 'Jesteśmy kameralnym, niepublicznym przedszkolem łączącym edukację językową i muzyczną z troską o indywidualny rozwój każdego dziecka. Działamy na warszawskiej Woli od 2003 roku.' ) ); ?></p>
    <?php dworek_breadcrumbs(); ?>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="reveal" style="text-align:center;margin-bottom:var(--s-4)"><span class="eyebrow">Nasza historia</span></div>
    <div class="split">
      <div class="split__media reveal"><img loading="lazy" decoding="async" src="<?php echo $t; ?>/img/real/historia-zajecia.webp" alt="Dzieci podczas twórczych zajęć plastycznych w „Czarodziejskim Dworku”" width="900" height="700"></div>
      <div class="split__content reveal" data-delay="1">
        <h2><?php echo esc_html( dworek_field( 'on_history_title', 'Od 2003 roku odkrywamy mocne strony dzieci' ) ); ?></h2>
        <?php echo wp_kses_post( dworek_field( 'on_history_body', '<p>„Czarodziejski Dworek” to wyjątkowe przedszkole, w którym odkryte i docenione zostaną mocne strony Twojego dziecka. Działamy od września 2003 roku (ewidencja przedszkoli niepublicznych nr 111/PN).</p><p>Naszym celem jest dbanie o wszechstronny rozwój każdego dziecka i zaszczepienie w nim twórczych pasji — w kameralnych grupach, blisko każdego malucha. Godziny pracy dostosowujemy do potrzeb rodziców: pracujemy od 7.00 do 18.00.</p>' ) ); ?>
      </div>
    </div>
  </div>
</section>

<!-- MISJA + WARTOŚCI -->
<section class="section sec-warm">
  <div class="container">
    <div class="section-head reveal" style="max-width:62ch">
      <span class="eyebrow">Nasza misja</span>
      <h2><?php echo esc_html( dworek_field( 'on_mission_title', 'Każda zabawa jest nauką, a każda nauka — zabawą' ) ); ?></h2>
      <p><?php echo esc_html( dworek_field( 'on_mission_lead', 'Chcemy, by w „Czarodziejskim Dworku” odkryte i docenione zostały mocne strony Twojego dziecka. Dbamy o jego wszechstronny rozwój i zaszczepiamy w nim twórcze pasje — w atmosferze akceptacji, blisko każdego malucha.' ) ); ?></p>
    </div>
    <div class="grid features__grid feat-grid" style="margin-top:var(--s-6)">
      <article class="card reveal">
        <div class="card__icon c-blue" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21C5 14 3 11 3 8a5 5 0 019-3 5 5 0 019 3c0 3-2 6-9 13z"/></svg></div>
        <h3><?php echo esc_html( dworek_field( 'on_val1_t', 'Akceptacja' ) ); ?></h3>
        <p><?php echo esc_html( dworek_field( 'on_val1_d', 'Każde dziecko przyjmujemy takim, jakie jest — w cieple, życzliwości i poczuciu bezpieczeństwa.' ) ); ?></p>
      </article>
      <article class="card reveal" data-delay="1">
        <div class="card__icon c-sky" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3l9 4-9 4-9-4 9-4z"/><path d="M7 9v5c0 1.7 2.2 3 5 3s5-1.3 5-3V9"/></svg></div>
        <h3><?php echo esc_html( dworek_field( 'on_val2_t', 'Edukacja przez zabawę' ) ); ?></h3>
        <p><?php echo esc_html( dworek_field( 'on_val2_d', 'Język, muzyka i twórcze zajęcia dopasowane do wieku i możliwości każdego dziecka.' ) ); ?></p>
      </article>
      <article class="card reveal" data-delay="2">
        <div class="card__icon c-orange" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="4"/><path d="M4 21c0-4 4-6 8-6s8 2 8 6"/></svg></div>
        <h3><?php echo esc_html( dworek_field( 'on_val3_t', 'Twórcze pasje' ) ); ?></h3>
        <p><?php echo esc_html( dworek_field( 'on_val3_d', 'Zaszczepiamy ciekawość świata i rozwijamy mocne strony — tak, by dziecko wierzyło w siebie.' ) ); ?></p>
      </article>
      <article class="card reveal" data-delay="3">
        <div class="card__icon c-green" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"/></svg></div>
        <h3><?php echo esc_html( dworek_field( 'on_val4_t', 'Współpraca z rodzicami' ) ); ?></h3>
        <p><?php echo esc_html( dworek_field( 'on_val4_d', 'Bliski kontakt, konsultacje i szkolenia dla rodziców — działamy razem dla dobra dziecka.' ) ); ?></p>
      </article>
    </div>
  </div>
</section>

<!-- PODEJŚCIE DO DZIECI -->
<section class="section">
  <div class="container">
    <div class="reveal" style="text-align:center;margin-bottom:var(--s-4)"><span class="eyebrow">Podejście do dzieci</span></div>
    <div class="split split--reverse">
      <div class="split__media reveal"><img loading="lazy" decoding="async" src="<?php echo $t; ?>/img/real/muzyka.webp" alt="Kolorowe instrumenty muzyczne dla dzieci — zajęcia umuzykalniające" width="900" height="700"></div>
      <div class="split__content reveal" data-delay="1">
        <h2><?php echo esc_html( dworek_field( 'on_approach_title', 'Uczymy przez zabawę, język i muzykę' ) ); ?></h2>
        <p><?php echo esc_html( dworek_field( 'on_approach_p', 'Dzień w przedszkolu to naturalny kontakt z językiem obcym i muzyką, twórcze zabawy i ruch. Nie pospieszamy — wspieramy dziecko w jego własnym tempie i budujemy w nim wiarę we własne możliwości.' ) ); ?></p>
        <ul class="checklist"><?php echo dworek_checklist( dworek_field( 'on_approach_list', "Codzienny kontakt z angielskim i francuskim w naturalnej formie\nMuzyka, rytmika i ruch jako część każdego dnia\nRozwijanie mocnych stron, ciekawości i samodzielności" ) ); ?></ul>
      </div>
    </div>
  </div>
</section>

<!-- INDYWIDUALNE PODEJŚCIE -->
<section class="section sec-warm">
  <div class="container">
    <div class="section-head reveal">
      <span class="eyebrow">Indywidualne podejście</span>
      <h2><?php echo esc_html( dworek_field( 'on_indiv_title', 'Każde dziecko widziane z osobna' ) ); ?></h2>
      <p><?php echo esc_html( dworek_field( 'on_indiv_lead', 'Kameralne grupy i specjaliści na miejscu pozwalają nam naprawdę poznać każde dziecko i dopasować wsparcie do jego potrzeb.' ) ); ?></p>
    </div>
    <div class="grid cols-3 feat-grid">
      <article class="card reveal">
        <div class="card__icon c-sky" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="8" r="3"/><circle cx="17" cy="9" r="2.5"/><path d="M3 20c0-3 2.7-5 6-5s6 2 6 5"/><path d="M15.5 20c.2-2 1.2-3.2 3-3.2"/></svg></div>
        <h3><?php echo esc_html( dworek_field( 'on_ind1_t', 'Małe grupy' ) ); ?></h3>
        <p><?php echo esc_html( dworek_field( 'on_ind1_d', 'Maksymalnie 14 dzieci i 2 nauczycieli w grupie — więcej uwagi i czasu dla każdego malucha.' ) ); ?></p>
      </article>
      <article class="card reveal" data-delay="1">
        <div class="card__icon c-purple" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3l9 4-9 4-9-4 9-4z"/><path d="M7 9v5c0 1.7 2.2 3 5 3s5-1.3 5-3V9"/></svg></div>
        <h3><?php echo esc_html( dworek_field( 'on_ind2_t', 'Specjaliści na miejscu' ) ); ?></h3>
        <p><?php echo esc_html( dworek_field( 'on_ind2_d', 'Logopeda, psycholog, terapeuci SI i pedagodzy w jednym miejscu — diagnoza i pomoc bez szukania jej poza przedszkolem.' ) ); ?></p>
      </article>
      <article class="card reveal" data-delay="2">
        <div class="card__icon c-blue" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21C5 14 3 11 3 8a5 5 0 019-3 5 5 0 019 3c0 3-2 6-9 13z"/></svg></div>
        <h3><?php echo esc_html( dworek_field( 'on_ind3_t', 'Wsparcie szyte na miarę' ) ); ?></h3>
        <p><?php echo esc_html( dworek_field( 'on_ind3_d', 'Dostosowujemy tempo i formę zajęć, a dzieci z opinią obejmujemy bezpłatnym wczesnym wspomaganiem rozwoju (WWR).' ) ); ?></p>
      </article>
    </div>
  </div>
</section>

<!-- ATMOSFERA -->
<section class="section">
  <div class="container">
    <div class="reveal" style="text-align:center;margin-bottom:var(--s-4)"><span class="eyebrow">Atmosfera</span></div>
    <div class="split">
      <div class="split__media reveal"><img loading="lazy" decoding="async" src="<?php echo $t; ?>/img/real/malowanie.webp" alt="Dzieci w fartuszkach malują podczas warsztatów plastycznych w przedszkolu Czarodziejski Dworek" width="900" height="700"></div>
      <div class="split__content reveal" data-delay="1">
        <h2><?php echo esc_html( dworek_field( 'on_atmos_title', 'Ciepło domu, przestrzeń do rozwoju' ) ); ?></h2>
        <p><?php echo esc_html( dworek_field( 'on_atmos_p', 'Stawiamy na rodzinną, życzliwą atmosferę, w której dziecko czuje się akceptowane i bezpieczne. Przestronne, kolorowe sale i własny ogród dają miejsce do zabawy, odpoczynku i odkrywania świata.' ) ); ?></p>
        <ul class="checklist"><?php echo dworek_checklist( dworek_field( 'on_atmos_list', "Rodzinna, kameralna atmosfera\nPrzestronne, jasne i kolorowe sale\nZdrowe posiłki uwzględniające różne diety\nDuży, ogrodzony plac zabaw i ogród" ) ); ?></ul>
      </div>
    </div>
  </div>
</section>

<!-- BEZPIECZEŃSTWO -->
<section class="section sec-warm">
  <div class="container">
    <div class="section-head reveal">
      <span class="eyebrow">Bezpieczeństwo</span>
      <h2><?php echo esc_html( dworek_field( 'on_safety_title', 'Spokój rodzica, bezpieczeństwo dziecka' ) ); ?></h2>
      <p><?php echo esc_html( dworek_field( 'on_safety_lead', 'Dbamy o bezpieczeństwo na każdym kroku — od ogrodzonego terenu po stałą, uważną opiekę.' ) ); ?></p>
    </div>
    <div class="grid cols-3 feat-grid">
      <article class="card reveal">
        <div class="card__icon c-blue" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2l8 4v6c0 5-3.5 8-8 10-4.5-2-8-5-8-10V6l8-4z"/></svg></div>
        <h3><?php echo esc_html( dworek_field( 'on_saf1_t', 'Ogrodzony, bezpieczny teren' ) ); ?></h3>
        <p><?php echo esc_html( dworek_field( 'on_saf1_d', 'Zamknięty plac zabaw i własny parking — dzieci bawią się na bezpiecznym, dozorowanym terenie.' ) ); ?></p>
      </article>
      <article class="card reveal" data-delay="1">
        <div class="card__icon c-sky" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="4"/><path d="M4 21c0-4 4-6 8-6s8 2 8 6"/></svg></div>
        <h3><?php echo esc_html( dworek_field( 'on_saf2_t', 'Stała, uważna opieka' ) ); ?></h3>
        <p><?php echo esc_html( dworek_field( 'on_saf2_d', 'Dwóch nauczycieli w kameralnej grupie czuwa nad każdym dzieckiem przez cały dzień.' ) ); ?></p>
      </article>
      <article class="card reveal" data-delay="2">
        <div class="card__icon c-blue" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 11h16M6 11V8a6 6 0 0112 0v3M5 11l1.2 8.2a2 2 0 002 1.8h7.6a2 2 0 002-1.8L19 11"/></svg></div>
        <h3><?php echo esc_html( dworek_field( 'on_saf3_t', 'Zdrowe posiłki' ) ); ?></h3>
        <p><?php echo esc_html( dworek_field( 'on_saf3_d', 'Świeże, zbilansowane jedzenie uwzględniające diety i alergie naszych podopiecznych.' ) ); ?></p>
      </article>
    </div>
  </div>
</section>

<!-- NAJWAŻNIEJSZE ATUTY -->
<section class="section">
  <div class="container">
    <div class="reveal" style="text-align:center;margin-bottom:var(--s-4)"><span class="eyebrow">Najważniejsze atuty</span></div>
    <div class="split split--reverse">
      <div class="split__media reveal"><img loading="lazy" decoding="async" src="<?php echo $t; ?>/img/real/galeria/DSCN8672-scaled.webp" alt="Duży, ogrodzony plac zabaw przedszkola wśród drzew" width="900" height="700"></div>
      <div class="split__content reveal" data-delay="1">
        <h2><?php echo esc_html( dworek_field( 'on_atuty_title', 'Co wyróżnia nasze przedszkole' ) ); ?></h2>
        <ul class="checklist"><?php echo dworek_checklist( dworek_field( 'on_atuty_list', "Kameralne grupy: maks. 14 dzieci i 2 nauczycieli\nBezpłatne zajęcia: terapie, języki, nauka pływania i warsztaty\nSpecjaliści i diagnoza na miejscu — bez szukania pomocy poza przedszkolem\nDuży, ogrodzony plac zabaw i własny parking\nZdrowe posiłki uwzględniające różne diety" ) ); ?></ul>
        <a href="<?php echo esc_url( home_url( '/oferta/' ) ); ?>" class="btn btn--primary"><?php echo esc_html( dworek_field( 'on_atuty_btn', 'Zobacz ofertę' ) ); ?></a>
      </div>
    </div>
  </div>
</section>

<section class="section--tight">
  <div class="container">
    <div class="band reveal">
      <div class="band__grid">
        <div class="stat"><strong><span data-count="<?php echo esc_attr( dworek_field( 'on_stat1_num', '20' ) ); ?>" data-suffix="<?php echo esc_attr( dworek_field( 'on_stat1_sfx', '+' ) ); ?>">0</span></strong><span><?php echo esc_html( dworek_field( 'on_stat1_lbl', 'lat doświadczenia (od 2003)' ) ); ?></span></div>
        <div class="stat"><strong><span data-count="<?php echo esc_attr( dworek_field( 'on_stat2_num', '14' ) ); ?>">0</span></strong><span><?php echo esc_html( dworek_field( 'on_stat2_lbl', 'dzieci maks. w grupie' ) ); ?></span></div>
        <div class="stat"><strong><span data-count="<?php echo esc_attr( dworek_field( 'on_stat3_num', '2' ) ); ?>">0</span></strong><span><?php echo esc_html( dworek_field( 'on_stat3_lbl', 'nauczycieli w grupie' ) ); ?></span></div>
        <div class="stat"><strong><?php echo esc_html( dworek_field( 'on_stat4_val', '7–18' ) ); ?></strong><span><?php echo esc_html( dworek_field( 'on_stat4_lbl', 'godziny pracy' ) ); ?></span></div>
      </div>
    </div>
  </div>
</section>

<section class="section cta-band">
  <div class="container">
    <div class="card reveal">
      <h2><?php echo esc_html( dworek_field( 'on_cta_title', 'Chcesz zobaczyć nas na żywo?' ) ); ?></h2>
      <p style="margin-inline:auto"><?php echo esc_html( dworek_field( 'on_cta_text', 'Zapraszamy na spotkanie i zwiedzanie przedszkola — bez zobowiązań. Pokażemy sale, ogród i opowiemy o naszym programie.' ) ); ?></p>
      <div class="btn-row"><a href="<?php echo esc_url( home_url( '/kontakt/' ) ); ?>" class="btn btn--primary btn--lg"><?php echo esc_html( dworek_field( 'on_cta_btn1', 'Umów spotkanie' ) ); ?></a><a href="<?php echo esc_url( home_url( '/kadra/' ) ); ?>" class="btn btn--ghost btn--lg"><?php echo esc_html( dworek_field( 'on_cta_btn2', 'Poznaj kadrę' ) ); ?></a></div>
    </div>
  </div>
</section>

<?php
get_footer();
