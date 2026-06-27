<?php
/**
 * Szablon podstrony: WWR i terapia (page-wsparcie.php)
 *
 * Wygenerowano z wsparcie.html — wygląd odwzorowany 1:1. Układ stały;
 * teksty można w przyszłości wystawić na pola ACF (helper dworek_field()).
 *
 * Wymaga strony WordPress o uchwycie (slug): "wsparcie".
 *
 * @package Czarodziejski_Dworek
 */

get_header();
$t = get_template_directory_uri();
?>

<section class="page-hero">
  <div class="container reveal">
    <span class="eyebrow"><?php echo esc_html( dworek_field( 'page_eyebrow', 'WWR i terapia' ) ); ?></span>
    <h1><?php echo esc_html( dworek_field( 'page_hero_title', 'Wczesne wspomaganie rozwoju i terapia' ) ); ?></h1>
    <p class="lead" style="margin:.6rem auto 0;max-width:62ch"><?php echo esc_html( dworek_field( 'page_hero_lead', 'Pod jednym dachem zapewniamy diagnozę i terapię prowadzoną przez doświadczonych specjalistów — bez konieczności szukania pomocy poza przedszkolem.' ) ); ?></p>
    <?php dworek_breadcrumbs(); ?>
  </div>
</section>

<!-- ===== OPIS WWR ===== -->
<section class="section">
  <div class="container split">
    <div class="split__media reveal"><img loading="lazy" decoding="async" src="<?php echo $t; ?>/img/real/logopedia.webp" alt="Dziecko podczas indywidualnych zajęć logopedycznych z terapeutką" width="900" height="700"></div>
    <div class="split__content reveal" data-delay="1">
      <span class="eyebrow">Czym jest WWR · bezpłatnie</span>
      <h2>Wczesne wspomaganie rozwoju</h2>
      <p>Wczesne wspomaganie rozwoju (WWR) to <strong>bezpłatne, zindywidualizowane zajęcia</strong> dla dzieci, które posiadają <strong>opinię o potrzebie wczesnego wspomagania rozwoju</strong>. Ich celem jest jak najwcześniejsze, kompleksowe wspieranie rozwoju malucha — w mowie, ruchu, emocjach i kontaktach z rówieśnikami.</p>
      <p>Zajęcia prowadzi nasz zespół specjalistów na terenie przedszkola, w znanym i bezpiecznym dla dziecka otoczeniu, a ich zakres dobieramy do indywidualnych potrzeb.</p>
      <ul class="checklist">
        <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg> Całkowicie bezpłatne dla rodziców</li>
        <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg> Dla dzieci z opinią o potrzebie WWR</li>
        <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg> Prowadzone przez zespół specjalistów</li>
        <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg> Plan dopasowany do potrzeb dziecka</li>
      </ul>
      <a href="#kontakt" class="btn btn--accent">Zapytaj o WWR</a>
    </div>
  </div>
</section>

<!-- ===== DLA KOGO ===== -->
<section class="section sec-warm">
  <div class="container">
    <div class="section-head reveal">
      <span class="eyebrow" style="display:flex;width:max-content;margin-inline:auto">Dla kogo</span>
      <h2>Komu pomagamy</h2>
      <p>Zapraszamy, jeśli chcesz wesprzeć rozwój dziecka lub obserwujesz u niego trudności w którymś z poniższych obszarów. Pierwszym krokiem zawsze jest spokojna rozmowa i obserwacja.</p>
    </div>
    <div class="grid cols-3 feat-grid">
      <article class="card reveal">
        <div class="card__icon c-blue" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><path d="M14 2v6h6"/><path d="M9 15l2 2 4-4"/></svg></div>
        <h3>Dzieci z opinią o potrzebie WWR</h3>
        <p>Realizujemy bezpłatne wczesne wspomaganie rozwoju dla dzieci posiadających opinię z poradni.</p>
      </article>
      <article class="card reveal" data-delay="1">
        <div class="card__icon c-blue" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg></div>
        <h3>Rozwój mowy i komunikacji</h3>
        <p>Opóźniona lub niewyraźna mowa, trudności z porozumiewaniem się i wymową.</p>
      </article>
      <article class="card reveal" data-delay="2">
        <div class="card__icon c-purple" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21C5 14 3 11 3 8a5 5 0 019-3 5 5 0 019 3c0 3-2 6-9 13z"/></svg></div>
        <h3>Emocje i relacje</h3>
        <p>Wsparcie w wyrażaniu emocji, budowaniu relacji z rówieśnikami i radzeniu sobie w grupie.</p>
      </article>
      <article class="card reveal">
        <div class="card__icon c-orange" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="4"/><path d="M12 3v3M12 18v3M3 12h3M18 12h3"/></svg></div>
        <h3>Przetwarzanie sensoryczne</h3>
        <p>Nadmierna lub obniżona wrażliwość na bodźce, trudności z koncentracją i równowagą.</p>
      </article>
      <article class="card reveal" data-delay="1">
        <div class="card__icon c-green" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="5" r="2"/><path d="M12 7v6m0 0l-3 6m3-6l3 6M7 11l5-1 5 1"/></svg></div>
        <h3>Rozwój ruchowy i postawa</h3>
        <p>Wsparcie prawidłowego rozwoju ruchowego, koordynacji oraz korekcja postawy.</p>
      </article>
      <article class="card reveal" data-delay="2">
        <div class="card__icon c-orange" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19V5a1 1 0 011-1h11l-2 3 2 3H5"/><path d="M9 4v16"/></svg></div>
        <h3>Koncentracja i gotowość szkolna</h3>
        <p>Wspieranie uwagi, samodzielności i pokonywania trudności w uczeniu się.</p>
      </article>
    </div>
    <div class="photo-mosaic reveal" data-lightbox>
      <figure class="pm-big"><img loading="lazy" decoding="async" src="<?php echo $t; ?>/img/real/wsparcie/komu-emocje.webp" alt="Dziewczynka w skupieniu podczas zajęć w przedszkolu" width="1600" height="1200"><figcaption>Uważność na emocje i potrzeby dziecka</figcaption></figure>
      <figure class="pm-sm"><img loading="lazy" decoding="async" src="<?php echo $t; ?>/img/real/wsparcie/komu-relacje.webp" alt="Dzieci wspólnie malują farbami podczas zajęć" width="1600" height="1186"><figcaption>Wspólna zabawa i budowanie relacji</figcaption></figure>
      <figure class="pm-sm"><img loading="lazy" decoding="async" src="<?php echo $t; ?>/img/real/wsparcie/komu-gotowosc.webp" alt="Dzieci podczas zajęć edukacyjnych przy stolikach" width="1600" height="1190"><figcaption>Koncentracja i gotowość szkolna</figcaption></figure>
    </div>
  </div>
</section>

<!-- ===== JAKIE TERAPIE ===== -->
<section class="section">
  <div class="container">
    <div class="section-head reveal">
      <span class="eyebrow" style="display:flex;width:max-content;margin-inline:auto">Specjaliści na miejscu</span>
      <h2>Jakie terapie są dostępne</h2>
      <p>Dzieci są pod opieką doświadczonych specjalistów bez wychodzenia z przedszkola — terapia odbywa się w znanym, bezpiecznym otoczeniu.</p>
    </div>
    <div class="grid cols-3 feat-grid">
      <article class="card reveal">
        <div class="card__icon c-blue" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg></div>
        <h3>Logopedia</h3>
        <p>Diagnoza i terapia mowy — wspieramy prawidłowy rozwój artykulacji, słuchu fonematycznego i komunikacji.</p>
      </article>
      <article class="card reveal" data-delay="1">
        <div class="card__icon c-purple" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3a5 5 0 015 5c0 1.5-.6 2.5-1.5 3.5S14 14 14 16v1h-4v-1c0-2-.6-2.5-1.5-4.5S7 9.5 7 8a5 5 0 015-5z"/><path d="M10 21h4"/></svg></div>
        <h3>Psycholog</h3>
        <p>Wsparcie emocjonalne i społeczne dziecka oraz konsultacje dla rodziców w codziennych wyzwaniach.</p>
      </article>
      <article class="card reveal" data-delay="2">
        <div class="card__icon c-sky" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="4"/><path d="M12 3v3M12 18v3M3 12h3M18 12h3"/></svg></div>
        <h3>Integracja sensoryczna (SI)</h3>
        <p>Terapia wspierająca przetwarzanie bodźców zmysłowych, koncentrację i równowagę.</p>
      </article>
      <article class="card reveal">
        <div class="card__icon c-green" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="5" r="2"/><path d="M12 7v6m0 0l-3 6m3-6l3 6M7 11l5-1 5 1"/></svg></div>
        <h3>Fizjoterapia</h3>
        <p>Ćwiczenia korygujące postawę i wspierające prawidłowy rozwój ruchowy malucha.</p>
      </article>
      <article class="card reveal" data-delay="1">
        <div class="card__icon c-orange" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19V5a1 1 0 011-1h11l-2 3 2 3H5"/><path d="M9 4v16"/></svg></div>
        <h3>Terapia pedagogiczna</h3>
        <p>Wspieranie koncentracji, gotowości szkolnej oraz pokonywania trudności w uczeniu się.</p>
      </article>
      <article class="card reveal" data-delay="2">
        <div class="card__icon c-orange" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="8" r="3"/><circle cx="17" cy="9" r="2.5"/><path d="M3 20c0-3 2.7-5 6-5s6 2 6 5M15 20c0-2 1-3.5 3-4"/></svg></div>
        <h3>TUS</h3>
        <p>Trening umiejętności społecznych — nauka współpracy, rozpoznawania emocji i budowania relacji.</p>
      </article>
    </div>
    <div class="photo-mosaic reveal" data-lightbox>
      <figure class="pm-big"><img loading="lazy" decoding="async" src="<?php echo $t; ?>/img/real/wsparcie/terapia-ruch.webp" alt="Dziecko podczas ćwiczeń ruchowych na macie" width="1411" height="1500"><figcaption>Wsparcie rozwoju ruchowego</figcaption></figure>
      <figure class="pm-sm"><img loading="lazy" decoding="async" src="<?php echo $t; ?>/img/real/wsparcie/terapia-si.webp" alt="Terapia integracji sensorycznej z dyskami sensorycznymi" width="900" height="500"><figcaption>Integracja sensoryczna</figcaption></figure>
      <figure class="pm-sm"><img loading="lazy" decoding="async" src="<?php echo $t; ?>/img/real/wsparcie/terapia-fizjo.webp" alt="Chłopiec ćwiczy z piłką podczas zajęć ruchowych" width="450" height="300"><figcaption>Fizjoterapia i koordynacja</figcaption></figure>
    </div>
  </div>
</section>

<!-- ===== KTO PROWADZI ===== -->
<section class="section" style="background:var(--surface)">
  <div class="container">
    <div class="section-head reveal">
      <span class="eyebrow" style="display:flex;width:max-content;margin-inline:auto">Zespół specjalistów</span>
      <h2>Kto prowadzi zajęcia</h2>
      <p>Terapie prowadzą doświadczeni specjaliści „Czarodziejskiego Dworku". Poznaj osoby, które zajmą się rozwojem Twojego dziecka.</p>
    </div>
    <div class="grid team-grid">
      <article class="card team-card reveal" data-person="byszko"><div class="mono mono--4" aria-hidden="true">MB</div><h3>Marta Byszko</h3><p class="role">Neurologopeda</p></article>
      <article class="card team-card reveal" data-delay="1" data-person="kunat"><div class="mono mono--5" aria-hidden="true">MK</div><h3>Małgorzata Kunat</h3><p class="role">Neurologopeda</p></article>
      <article class="card team-card reveal" data-delay="2" data-person="golec"><img loading="lazy" decoding="async" src="<?php echo $t; ?>/img/kadra/golec.webp" alt="Joanna Golec" width="130" height="130"><h3>Joanna Golec</h3><p class="role">Psycholog</p></article>
      <article class="card team-card reveal" data-delay="3" data-person="kucharczyk"><div class="mono mono--1" aria-hidden="true">EK</div><h3>Elwira Kucharczyk</h3><p class="role">Psycholog, terapeuta</p></article>
      <article class="card team-card reveal" data-person="linowska"><div class="mono mono--3" aria-hidden="true">EL</div><h3>Ewa Linowska</h3><p class="role">Psycholog, psychoterapeuta</p></article>
      <article class="card team-card reveal" data-delay="1" data-person="mazur"><div class="mono mono--2" aria-hidden="true">AM</div><h3>Agnieszka Mazur</h3><p class="role">Pedagog specjalny, terapeuta SI</p></article>
      <article class="card team-card reveal" data-delay="2" data-person="jurska"><img loading="lazy" decoding="async" src="<?php echo $t; ?>/img/kadra/jurska.webp" alt="Anna Jurska" width="130" height="130"><h3>Anna Jurska</h3><p class="role">Pedagog, terapeuta SI</p></article>
      <article class="card team-card reveal" data-delay="3" data-person="slawikowska"><div class="mono mono--6" aria-hidden="true">AS</div><h3>Anna Sławikowska</h3><p class="role">Fizjoterapeuta, terapeuta SI</p></article>
      <article class="card team-card reveal" data-person="bartoszewska"><img loading="lazy" decoding="async" src="<?php echo $t; ?>/img/kadra/bartoszewska.webp" alt="Małgorzata Bartoszewska" width="130" height="130"><h3>Małgorzata Bartoszewska</h3><p class="role">Pedagog, terapeuta</p></article>
      <article class="card team-card reveal" data-delay="1" data-person="chlap"><img loading="lazy" decoding="async" src="<?php echo $t; ?>/img/kadra/chlap.webp" alt="Paulina Chłap" width="130" height="130"><h3>Paulina Chłap</h3><p class="role">Pedagog specjalny</p></article>
      <article class="card team-card reveal" data-delay="2" data-person="gomola"><img loading="lazy" decoding="async" src="<?php echo $t; ?>/img/kadra/gomola.webp" alt="Ewelina Gomoła-Bieniek" width="130" height="130"><h3>Ewelina Gomoła-Bieniek</h3><p class="role">Pedagog specjalny, terapeuta</p></article>
      <article class="card team-card reveal" data-delay="3" data-person="jakuc"><img loading="lazy" decoding="async" src="<?php echo $t; ?>/img/kadra/jakuc.webp" alt="Olga Jakuć" width="130" height="130"><h3>Olga Jakuć</h3><p class="role">Pedagog specjalny, terapeuta</p></article>
      <article class="card team-card reveal" data-person="lucka"><img loading="lazy" decoding="async" src="<?php echo $t; ?>/img/kadra/lucka.jpg" alt="Natalia Łucka" width="130" height="130"><h3>Natalia Łucka</h3><p class="role">Pedagog specjalny</p></article>
    </div>
    <div class="center" style="margin-top:var(--s-4)"><a href="<?php echo esc_url( home_url( '/kadra/' ) ); ?>" class="btn btn--primary">Poznaj cały zespół specjalistów</a></div>
  </div>
</section>

<!-- ===== PROCES KONTAKTU ===== -->
<section class="section">
  <div class="container">
    <div class="section-head reveal">
      <span class="eyebrow" style="display:flex;width:max-content;margin-inline:auto">Jak zacząć</span>
      <h2>Jak wygląda proces kontaktu</h2>
      <p>Od pierwszego telefonu do regularnych zajęć — krok po kroku, spokojnie i z myślą o dziecku.</p>
    </div>
    <div class="grid cols-2">
      <article class="card pic-card reveal">
        <img loading="lazy" decoding="async" src="<?php echo $t; ?>/img/real/proces/01-kontakt.jpg" alt="Smartfon i otwarty notes na biurku przy oknie — pierwszy kontakt">
        <div class="pic-card__body">
          <div class="card__icon c-blue" aria-hidden="true" style="font-family:'Baloo 2',cursive;font-weight:800;font-size:1.3rem;color:#fff">1</div>
          <h3>Kontakt</h3>
          <p>Zadzwoń pod <a href="tel:+48690629501">690 629 501</a> lub wyślij formularz poniżej. Opisz krótko, czego potrzebuje Twoje dziecko.</p>
        </div>
      </article>
      <article class="card pic-card reveal" data-delay="1">
        <img loading="lazy" decoding="async" src="<?php echo $t; ?>/img/real/proces/02-rozmowa.jpg" alt="Niski stolik z drewnianymi zabawkami i kredkami w jasnej sali — rozmowa i obserwacja">
        <div class="pic-card__body">
          <div class="card__icon c-blue" aria-hidden="true" style="font-family:'Baloo 2',cursive;font-weight:800;font-size:1.3rem;color:#fff">2</div>
          <h3>Rozmowa i obserwacja</h3>
          <p>Umawiamy spotkanie, poznajemy dziecko i jego potrzeby oraz rozmawiamy z rodzicami o oczekiwaniach.</p>
        </div>
      </article>
      <article class="card pic-card reveal" data-delay="1">
        <img loading="lazy" decoding="async" src="<?php echo $t; ?>/img/real/proces/03-plan.jpg" alt="Otwarty notatnik z planem i kolorowymi karteczkami — indywidualny plan">
        <div class="pic-card__body">
          <div class="card__icon c-orange" aria-hidden="true" style="font-family:'Baloo 2',cursive;font-weight:800;font-size:1.3rem;color:#fff">3</div>
          <h3>Indywidualny plan</h3>
          <p>Dobieramy odpowiednie terapie i specjalistów, tworząc plan dopasowany do możliwości dziecka.</p>
        </div>
      </article>
      <article class="card pic-card reveal" data-delay="2">
        <img loading="lazy" decoding="async" src="<?php echo $t; ?>/img/real/proces/04-zajecia.jpg" alt="Jasna sala terapeutyczna z matami i pomocami sensorycznymi — regularne zajęcia">
        <div class="pic-card__body">
          <div class="card__icon c-green" aria-hidden="true" style="font-family:'Baloo 2',cursive;font-weight:800;font-size:1.3rem;color:#fff">4</div>
          <h3>Regularne zajęcia</h3>
          <p>Prowadzimy terapię na miejscu, a postępy na bieżąco omawiamy z rodzicami podczas konsultacji.</p>
        </div>
      </article>
    </div>
  </div>
</section>

<!-- ===== ADAPTACJA (rozbudowane) ===== -->
<section class="section sec-warm" id="adaptacja">
  <div class="container split">
    <div class="split__media reveal"><img loading="lazy" decoding="async" src="<?php echo $t; ?>/img/real/wsparcie/adapt-zabawa.webp" alt="Dzieci podczas wspólnej zabawy na kolorowej macie w przedszkolu" width="1600" height="1094"></div>
    <div class="split__content reveal" data-delay="1">
      <span class="eyebrow">Adaptacja · bezpłatnie</span>
      <h2>Łagodna adaptacja — spokojny start w przedszkolu</h2>
      <p>Dla przyszłych przedszkolaków organizujemy <strong>bezpłatne, sobotnie zajęcia adaptacyjne</strong>. To czas, by dziecko — razem z rodzicem — spokojnie poznało przedszkole, panie i nowych kolegów jeszcze przed rozpoczęciem roku.</p>
      <ul class="checklist">
        <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg> Bezpłatne spotkania w soboty</li>
        <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg> Dla najmłodszych, przyszłych przedszkolaków</li>
        <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg> Dziecko poznaje panie, salę i rówieśników</li>
        <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg> Łagodne, stopniowe oswajanie bez pośpiechu</li>
      </ul>
      <a href="#terminy" class="btn btn--accent">Sprawdź terminy i zapisy</a>
    </div>
  </div>
</section>

<!-- Jak wygląda adaptacja -->
<section class="section">
  <div class="container">
    <div class="section-head reveal">
      <span class="eyebrow" style="display:flex;width:max-content;margin-inline:auto">Krok po kroku</span>
      <h2>Jak wygląda adaptacja</h2>
      <p>Bez pośpiechu i stresu — dziecko oswaja się z przedszkolem we własnym tempie, w obecności rodzica.</p>
    </div>
    <div class="grid cols-3 feat-grid">
      <article class="card reveal">
        <div class="card__icon c-blue" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21V10l9-7 9 7v11h-6v-6H9v6z"/></svg></div>
        <h3>Poznajemy przedszkole</h3>
        <p>Dziecko z rodzicem zwiedza sale i plac zabaw oraz poznaje panie — w przyjaznej, swobodnej atmosferze.</p>
      </article>
      <article class="card reveal" data-delay="1">
        <div class="card__icon c-orange" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="8" r="3"/><circle cx="17" cy="9" r="2.5"/><path d="M3 20c0-3 2.7-5 6-5s6 2 6 5M15 20c0-2 1-3.5 3-4"/></svg></div>
        <h3>Wspólna zabawa</h3>
        <p>Zabawy, piosenki i aktywności w małej grupie pomagają dziecku poczuć się pewnie wśród rówieśników.</p>
      </article>
      <article class="card reveal" data-delay="2">
        <div class="card__icon c-sky" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg></div>
        <h3>Stopniowe oswajanie</h3>
        <p>Krok po kroku, bez pośpiechu — pierwszy dzień w przedszkolu nie jest już dla dziecka niewiadomą.</p>
      </article>
    </div>
    <div class="photo-mosaic reveal" data-lightbox>
      <figure class="pm-big"><img loading="lazy" decoding="async" src="<?php echo $t; ?>/img/real/wsparcie/adapt-duza.webp" alt="Nauczycielka podczas zajęć z grupą dzieci na dywanie" width="1200" height="1600"><figcaption>Blisko pań i nowych kolegów</figcaption></figure>
      <figure class="pm-sm"><img loading="lazy" decoding="async" src="<?php echo $t; ?>/img/real/wsparcie/adapt-ogrod.webp" alt="Drzewa i zieleń w ogrodzie przedszkolnym" width="888" height="533"><figcaption>Spacery i zabawa na świeżym powietrzu</figcaption></figure>
      <figure class="pm-sm"><img loading="lazy" decoding="async" src="<?php echo $t; ?>/img/real/wsparcie/adapt-zmysly.webp" alt="Dzieci podczas twórczej zabawy przy stoliku" width="1600" height="900"><figcaption>Zabawa, która rozwija</figcaption></figure>
    </div>
  </div>
</section>

<!-- Przygotowanie dziecka + wsparcie rodziców -->
<section class="section sec-warm">
  <div class="container">
    <div class="section-head reveal">
      <span class="eyebrow" style="display:flex;width:max-content;margin-inline:auto">Razem z rodzicami</span>
      <h2>Przygotowanie i wsparcie</h2>
      <p>Adaptacja to wspólna sprawa — podpowiadamy, jak przygotować dziecko, i jesteśmy obok rodziców na każdym kroku.</p>
    </div>
    <div class="grid cols-2 feat-grid">
      <article class="card reveal">
        <div class="card__icon c-orange" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="4"/><path d="M4 21c0-4 4-6 8-6s8 2 8 6"/></svg></div>
        <h3>Jak przygotować dziecko</h3>
        <ul class="checklist">
          <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg> Mów o przedszkolu pozytywnie — jako o miejscu zabawy i nowych przyjaciół.</li>
          <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg> Ćwiczcie samodzielność: jedzenie, ubieranie, korzystanie z toalety.</li>
          <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg> Trzymajcie krótki, pogodny rytuał pożegnania.</li>
          <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg> Pozwól zabrać ulubioną przytulankę dla poczucia bezpieczeństwa.</li>
          <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg> Zadbaj o spokojny, wyspany poranek przed zajęciami.</li>
        </ul>
      </article>
      <article class="card reveal" data-delay="1">
        <div class="card__icon c-blue" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21C5 14 3 11 3 8a5 5 0 019-3 5 5 0 019 3c0 3-2 6-9 13z"/></svg></div>
        <h3>Jak wspieramy rodziców</h3>
        <ul class="checklist">
          <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg> Konsultacje ze specjalistami (psycholog, logopeda, pedagog) na miejscu.</li>
          <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg> Warsztaty i szkolenia dla rodziców.</li>
          <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg> Stały kontakt z wychowawcami i bieżące informacje o postępach.</li>
          <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg> Aktualności, terminy i zapisy na naszym Facebooku.</li>
        </ul>
      </article>
    </div>
  </div>
</section>

<!-- Terminy + kontakt -->
<section class="section" id="terminy">
  <div class="container">
    <div class="band reveal center">
      <span class="eyebrow" style="background:rgba(255,255,255,.2);border-color:rgba(255,255,255,.45);color:#fff">Terminy</span>
      <h2 style="margin:.6rem 0">Terminy zajęć adaptacyjnych</h2>
      <p>Sobotnie zajęcia adaptacyjne są bezpłatne i przeznaczone dla najmłodszych, przyszłych przedszkolaków. Konkretne terminy oraz zapisy ogłaszamy na bieżąco na naszym Facebooku — zajrzyj tam albo po prostu do nas zadzwoń, a wszystko podpowiemy.</p>
      <div class="btn-row" style="justify-content:center;margin-top:var(--s-3)">
        <a href="https://www.facebook.com/czarodziejskidworek/" target="_blank" rel="noopener" class="btn btn--ghost btn--lg">Zapisy przez Facebook</a>
        <a href="#kontakt" class="btn btn--ghost btn--lg">Napisz do nas</a>
      </div>
      <p style="margin-top:var(--s-2)">lub zadzwoń: <a href="tel:+48690629501" style="color:#fff;text-decoration:underline">690 629 501</a></p>
    </div>
  </div>
</section>

<!-- ===== FAQ ===== -->
<section class="section">
  <div class="container">
    <div class="section-head reveal">
      <span class="eyebrow" style="display:flex;width:max-content;margin-inline:auto">FAQ</span>
      <h2>Najczęstsze pytania rodziców</h2>
      <p>Zebraliśmy odpowiedzi na pytania, które najczęściej zadają rodzice. Nie znalazłeś swojego? Napisz lub zadzwoń.</p>
    </div>
    <div class="faq reveal">
      <details>
        <summary><span>Czym jest wczesne wspomaganie rozwoju (WWR)?</span><span class="plus">+</span></summary>
        <div class="faq__a">
          <p>To bezpłatne, zindywidualizowane zajęcia, których celem jest jak najwcześniejsze wspieranie rozwoju dziecka. Prowadzi je zespół specjalistów, a zakres dobieramy do indywidualnych potrzeb malucha — w obszarze mowy, ruchu, emocji i relacji z rówieśnikami.</p>
        </div>
      </details>
      <details>
        <summary><span>Czy zajęcia WWR są płatne?</span><span class="plus">+</span></summary>
        <div class="faq__a">
          <p>Nie. WWR jest całkowicie bezpłatne dla rodziców — realizujemy je dla dzieci posiadających opinię o potrzebie wczesnego wspomagania rozwoju.</p>
        </div>
      </details>
      <details>
        <summary><span>Jak uzyskać opinię o potrzebie WWR?</span><span class="plus">+</span></summary>
        <div class="faq__a">
          <p>Opinię o potrzebie wczesnego wspomagania rozwoju wydaje publiczna poradnia psychologiczno-pedagogiczna na wniosek rodzica. Chętnie podpowiemy, jak się do tego przygotować — wystarczy się z nami skontaktować.</p>
        </div>
      </details>
      <details>
        <summary><span>Gdzie odbywają się terapie?</span><span class="plus">+</span></summary>
        <div class="faq__a">
          <p>Wszystkie zajęcia prowadzimy na miejscu, w przedszkolu — w znanym dziecku, bezpiecznym otoczeniu, bez konieczności dojazdów do innych placówek.</p>
        </div>
      </details>
      <details>
        <summary><span>Jak zapisać dziecko na konsultację lub terapię?</span><span class="plus">+</span></summary>
        <div class="faq__a">
          <p>Wystarczy zadzwonić pod 690 629 501 lub wypełnić formularz poniżej. Umówimy rozmowę i obserwację, a następnie zaproponujemy plan wsparcia dopasowany do dziecka.</p>
        </div>
      </details>
      <details>
        <summary><span>Czy rodzice są informowani o postępach dziecka?</span><span class="plus">+</span></summary>
        <div class="faq__a">
          <p>Tak. Stały kontakt i konsultacje z rodzicami to podstawa naszej pracy — regularnie omawiamy postępy i wspólnie ustalamy kolejne kroki.</p>
        </div>
      </details>
    </div>
  </div>
</section>

<!-- ===== FORMULARZ KONTAKTOWY ===== -->
<section class="section" style="background:var(--surface)" id="kontakt">
  <div class="container">
    <div class="section-head reveal">
      <span class="eyebrow" style="display:flex;width:max-content;margin-inline:auto">Kontakt</span>
      <h2>Zapytaj o wsparcie dla dziecka</h2>
      <p>Zostaw zapytanie, a nasi specjaliści odezwą się i doradzą najlepsze rozwiązanie. Możesz też po prostu zadzwonić.</p>
    </div>
    <div class="split" style="align-items:start">
      <div class="split__content reveal">
        <div class="card">
          <form data-validate novalidate>
            <div class="form-grid">
              <div class="field">
                <label for="qname">Imię i nazwisko <span class="req">*</span></label>
                <input id="qname" name="qname" type="text" autocomplete="name" required placeholder="np. Anna Kowalska">
                <span class="error-msg">To pole jest wymagane.</span>
              </div>
              <div class="field">
                <label for="qphone">Telefon <span class="req">*</span></label>
                <input id="qphone" name="qphone" type="tel" autocomplete="tel" required placeholder="np. 600 700 800">
                <span class="error-msg">To pole jest wymagane.</span>
              </div>
              <div class="field full">
                <label for="qemail">E-mail</label>
                <input id="qemail" name="qemail" type="email" autocomplete="email" placeholder="np. anna@example.com">
                <span class="error-msg">Podaj poprawny adres e-mail.</span>
              </div>
              <div class="field full">
                <label for="qtopic">Czego dotyczy zapytanie</label>
                <select id="qtopic" name="qtopic">
                  <option value="">Wybierz obszar (opcjonalnie)</option>
                  <option>Wczesne wspomaganie rozwoju (WWR)</option>
                  <option>Logopedia</option>
                  <option>Psycholog</option>
                  <option>Integracja sensoryczna (SI)</option>
                  <option>Fizjoterapia</option>
                  <option>Terapia pedagogiczna</option>
                  <option>TUS</option>
                  <option>Zajęcia adaptacyjne</option>
                  <option>Inne</option>
                </select>
              </div>
              <div class="field full">
                <label for="qmsg">Wiadomość</label>
                <textarea id="qmsg" name="qmsg" placeholder="W czym możemy pomóc?"></textarea>
              </div>
            </div>
            <button type="submit" class="btn btn--primary btn--lg" style="margin-top:var(--s-3);width:100%">Wyślij zapytanie</button>
            <p class="form-status" role="status" aria-live="polite" style="display:none;margin-top:var(--s-2);background:var(--cream-2);border:2px solid var(--primary-soft);border-radius:var(--r-md);padding:.9rem 1rem;color:var(--primary-dark);font-weight:600"></p>
          </form>
        </div>
      </div>
      <div class="split__content reveal" data-delay="1">
        <div class="info-card">
          <span class="ic c-orange" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 12-9 12s-9-5-9-12a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg></span>
          <div><strong>Adres</strong>ul. Górczewska 89, 01-401 Warszawa (Wola)</div>
        </div>
        <div class="info-card">
          <span class="ic c-green" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.9v3a2 2 0 01-2.2 2 19.8 19.8 0 01-8.6-3 19.5 19.5 0 01-6-6 19.8 19.8 0 01-3-8.6A2 2 0 014.1 2h3a2 2 0 012 1.7c.1 1 .4 1.9.7 2.8a2 2 0 01-.5 2.1L8.1 9.9a16 16 0 006 6l1.3-1.3a2 2 0 012.1-.4c.9.3 1.8.6 2.8.7a2 2 0 011.8 2z"/></svg></span>
          <div><strong>Telefon</strong><a href="tel:+48690629501">690 629 501</a></div>
        </div>
        <div class="info-card">
          <span class="ic c-sky" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 7l9 6 9-6"/></svg></span>
          <div><strong>E-mail</strong><a href="mailto:kontakt@czarodziejski-dworek.pl">kontakt@czarodziejski-dworek.pl</a></div>
        </div>
        <div class="info-card">
          <span class="ic c-purple" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg></span>
          <div><strong>Godziny</strong>Pon.–Pt. 7.00 – 18.00</div>
        </div>
        <p class="form-note">Wolisz porozmawiać? Zadzwoń — chętnie odpowiemy na pytania i umówimy spotkanie.</p>
      </div>
    </div>
  </div>
</section>

<section class="section cta-band">
  <div class="container">
    <div class="card reveal">
      <h2>Masz pytania o wsparcie dla swojego dziecka?</h2>
      <p style="margin-inline:auto">Nasi specjaliści chętnie odpowiedzą na pytania i doradzą najlepsze rozwiązania.</p>
      <div class="btn-row"><a href="#kontakt" class="btn btn--primary btn--lg">Napisz do nas</a><a href="<?php echo esc_url( home_url( '/kadra/' ) ); ?>" class="btn btn--ghost btn--lg">Poznaj specjalistów</a></div>
    </div>
  </div>
</section>

<?php
get_footer();
