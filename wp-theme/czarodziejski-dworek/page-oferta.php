<?php
/**
 * Szablon podstrony: Program (page-oferta.php)
 *
 * Wygenerowano z oferta.html — wygląd odwzorowany 1:1. Układ stały;
 * teksty można w przyszłości wystawić na pola ACF (helper dworek_field()).
 *
 * Wymaga strony WordPress o uchwycie (slug): "oferta".
 *
 * @package Czarodziejski_Dworek
 */

get_header();
$t = get_template_directory_uri();
?>

<section class="page-hero">
  <div class="container reveal">
    <span class="eyebrow"><?php echo esc_html( dworek_field( 'page_eyebrow', 'Program' ) ); ?></span>
    <h1><?php echo esc_html( dworek_field( 'page_hero_title', 'Program, który rozwija i cieszy' ) ); ?></h1>
    <p class="lead" style="margin:.6rem auto 0;max-width:62ch"><?php echo esc_html( dworek_field( 'page_hero_lead', 'Języki, basen, muzyka, terapie i warsztaty — wszystko w cenie czesnego, bez ukrytych dopłat. Każdego dnia wspieramy rozwój poznawczy, społeczny i emocjonalny dziecka, realizując podstawę programową MEN.' ) ); ?></p>
    <?php dworek_breadcrumbs(); ?>
  </div>
</section>

<!-- PROGRAM EDUKACYJNY -->
<section class="section">
  <div class="container">
    <div class="reveal" style="text-align:center;margin-bottom:var(--s-4)"><span class="eyebrow">Program edukacyjny</span></div>
    <div class="split">
      <div class="split__media reveal"><img loading="lazy" decoding="async" src="<?php echo $t; ?>/img/real/program2.jpg" alt="Dziecko podczas twórczej zabawy kolorowymi materiałami sensorycznymi" width="900" height="600"></div>
      <div class="split__content reveal" data-delay="1">
        <h2>Uczymy wg programu „Zanim będę uczniem"</h2>
        <p>We wszystkich grupach realizujemy podstawę programową MEN w oparciu o program wychowania przedszkolnego „Zanim będę uczniem" — wspierający indywidualny rozwój dziecka zgodnie z jego możliwościami. Stawiamy na nowatorskie metody, podmiotowe traktowanie dziecka i działanie jako podstawę rozwoju.</p>
        <p>Nauczycielki odwołują się do dziecięcych przeżyć, doświadczeń i zainteresowań — dzięki temu dzieci są aktywne, twórcze i chętnie uczestniczą w zajęciach. Zajęcia plastyczne są integralną częścią dnia: dzieci poznają różnorodne techniki i mają nieograniczony dostęp do materiałów, co rozwija ich twórczość i wyobraźnię.</p>
      </div>
    </div>
    <div class="photo-row reveal">
      <img loading="lazy" decoding="async" src="<?php echo $t; ?>/img/real/program/edukacja-1.webp" alt="Dzieci podczas grupowych zajęć edukacyjnych" width="1600" height="1186">
      <img loading="lazy" decoding="async" src="<?php echo $t; ?>/img/real/program/edukacja-2.webp" alt="Wspólna zabawa edukacyjna w sali przedszkolnej" width="1600" height="1186">
      <img loading="lazy" decoding="async" src="<?php echo $t; ?>/img/real/program/edukacja-3.webp" alt="Twórcze zajęcia dzieci w przedszkolu" width="1600" height="1094">
    </div>
  </div>
</section>

<!-- ZAJĘCIA — AKORDEON „ROZWIŃ" -->
<section class="section prog-zajecia sec-warm">
  <div class="container">
    <div class="section-head reveal">
      <span class="eyebrow">Zajęcia w programie</span>
      <h2>Poznaj nasze zajęcia</h2>
      <p>Basen, język angielski i francuski oraz muzyka są w cenie czesnego.</p>
    </div>
    <div class="faq prog-acc">
      <details>
        <summary>
          <img class="acc-thumb" loading="lazy" decoding="async" src="<?php echo $t; ?>/img/real/angielski.webp" alt="Flaga i mapa Wielkiej Brytanii — zajęcia z języka angielskiego w przedszkolu">
          <span class="acc-head"><span>Język angielski</span><small>W czesnym · 4× w tygodniu</small></span>
          <span class="plus">+</span>
        </summary>
        <div class="faq__a">
          <p>Zajęcia odbywają się cztery razy w tygodniu dla każdej grupy wiekowej. Ich głównym celem jest zapewnienie dzieciom środowiska, w którym osłuchują się z modelowym językiem angielskim i przyswajają jak najwięcej mowy. Kluczowa jest wspólna zabawa prowadzona przez instruktora — dzięki niej dzieci wiążą naukę z przyjemnością.</p>
          <p>Materiały dobieramy indywidualnie, a zajęcia respektują autonomię dziecka i tzw. silent period. Maluchy poznają piosenki, rymowanki i gry, słuchają opowieści i bajek, a nowe słownictwo wspieramy materiałami wizualnymi. Dzieci angażują się w gry i dramy metodą Total Physical Response, co wspiera motorykę i koordynację — przy okazji zdobywają wiedzę z zakresu sztuki, matematyki i przyrody oraz uczą się otwartości i tolerancji wobec innych języków i kultur.</p>
          <div class="photo-row">
            <img loading="lazy" decoding="async" src="<?php echo $t; ?>/img/real/program/angielski-1.webp" alt="Dzieci na zajęciach języka angielskiego z kartami obrazkowymi" width="1600" height="1200">
            <img loading="lazy" decoding="async" src="<?php echo $t; ?>/img/real/program/angielski-2.webp" alt="Pomoce do nauki angielskiego w przedszkolu" width="1600" height="1200">
            <img loading="lazy" decoding="async" src="<?php echo $t; ?>/img/real/program/angielski-3.webp" alt="Dziecko podczas zabawy językowej po angielsku" width="1600" height="1200">
          </div>
        </div>
      </details>
      <details>
        <summary>
          <img class="acc-thumb" loading="lazy" decoding="async" src="<?php echo $t; ?>/img/real/francuski.webp" alt="Flaga i mapa Francji — zajęcia z języka francuskiego w przedszkolu">
          <span class="acc-head"><span>Język francuski</span><small>W czesnym · od 4 lat · 2× w tygodniu</small></span>
          <span class="plus">+</span>
        </summary>
        <div class="faq__a">
          <p>Poznawanie języka obcego od najmłodszych lat kształtuje u dziecka szerokie i świadome spojrzenie na świat. Dzieci przyswajają język naturalnie, zanim język ojczysty stanie się punktem odniesienia — a edukacja ma charakter zabawy.</p>
          <p>Zajęcia z francuskiego skierowane są do dzieci od 4. roku życia i odbywają się 2 razy w tygodniu. Wykorzystujemy metodę bezpośrednią: gry, melodyjki, ćwiczenia ruchowe oraz zajęcia plastyczne utrwalające przyswajane treści.</p>
          <div class="photo-row">
            <img loading="lazy" decoding="async" src="<?php echo $t; ?>/img/real/program/francuski-1.webp" alt="Nauczycielka prezentuje pomoce do nauki języka francuskiego w przedszkolu" width="1280" height="896">
            <img loading="lazy" decoding="async" src="<?php echo $t; ?>/img/real/program/francuski-2.webp" alt="Pomoce językowe z motywem Francji" width="1280" height="896">
            <img loading="lazy" decoding="async" src="<?php echo $t; ?>/img/real/program/francuski-3.webp" alt="Sala do zajęć z języka francuskiego" width="1280" height="896">
          </div>
        </div>
      </details>
      <details>
        <summary>
          <img class="acc-thumb" loading="lazy" decoding="async" src="<?php echo $t; ?>/img/real/muzyka.webp" alt="Kolorowe instrumenty muzyczne dla dzieci — zajęcia umuzykalniające">
          <span class="acc-head"><span>Zajęcia muzyczne</span><small>W czesnym · 3× w tygodniu</small></span>
          <span class="plus">+</span>
        </summary>
        <div class="faq__a">
          <p>Słuchanie muzyki, a zwłaszcza gra na instrumentach, uczy systematyczności, koncentracji i osiągania celu. Muzyka jest źródłem przyjemności — rozwija ekspresję dziecka, pozwala wyrażać emocje i wrażliwość, a przez to tworzyć, rozwijać wyobraźnię i kreatywność. Wiek przedszkolny to optymalny czas na edukację muzyczną: każde dziecko ma naturalną skłonność do muzyki, śpiewu, gry i tańca.</p>
          <p>W programie jest też taniec animacyjny (specjalność Stowarzyszenia KLANZA) — zabawy łączące rytm, muzykę i śpiew, które służą relaksacji i integracji grupy. Zajęcia muzyczne odbywają się trzy razy w tygodniu; dostępne są również sobotnie sesje dla dzieci i rodziców.</p>
          <div class="photo-row">
            <img loading="lazy" decoding="async" src="<?php echo $t; ?>/img/real/program/muzyka-1.webp" alt="Dziecko grające na keyboardzie podczas zajęć muzycznych" width="1600" height="1200">
            <img loading="lazy" decoding="async" src="<?php echo $t; ?>/img/real/program/muzyka-2.webp" alt="Kolorowe instrumenty muzyczne dla dzieci" width="1600" height="1200">
            <img loading="lazy" decoding="async" src="<?php echo $t; ?>/img/real/program/muzyka-3.webp" alt="Instrumenty perkusyjne wykorzystywane na zajęciach" width="1600" height="1200">
          </div>
        </div>
      </details>
      <details>
        <summary>
          <img class="acc-thumb" loading="lazy" decoding="async" src="<?php echo $t; ?>/img/real/basen.webp" alt="Dzieci uczą się pływać na basenie — zajęcia pływania w czesnym">
          <span class="acc-head"><span>Basen — nauka pływania</span><small>W czesnym · od 5 lat</small></span>
          <span class="plus">+</span>
        </summary>
        <div class="faq__a">
          <p>Co roku organizujemy zajęcia nauki pływania dla dzieci od 5. roku życia. Cieszą się ogromnym zainteresowaniem — dzieci uwielbiają wodę i z radością pluskają się w basenie. To jednak nie tylko zabawa: maluch hartuje się, oswaja z wodą, a nawet uczy pływać.</p>
          <p>Pływanie to znakomita gimnastyka — wzmacnia wszystkie mięśnie, zapobiega wadom postawy oraz zwiększa wydolność układu oddechowego i krążenia. Dzieci nabierają pewności siebie i lepiej radzą sobie w nietypowych sytuacjach.</p>
          <div class="photo-row">
            <img loading="lazy" decoding="async" src="<?php echo $t; ?>/img/real/program/basen-1.webp" alt="Dzieci podczas nauki pływania na basenie" width="1600" height="1200">
            <img loading="lazy" decoding="async" src="<?php echo $t; ?>/img/real/program/basen-2.webp" alt="Maluchy bawiące się w wodzie z deskami" width="1600" height="1062">
            <img loading="lazy" decoding="async" src="<?php echo $t; ?>/img/real/program/basen-3.webp" alt="Grupa dzieci na zajęciach pływania" width="1600" height="1062">
          </div>
        </div>
      </details>
      <details>
        <summary>
          <img class="acc-thumb" loading="lazy" decoding="async" src="<?php echo $t; ?>/img/real/galeria/DSCN8677-scaled.webp" alt="Kolorowy plac zabaw ze zjeżdżalniami w ogrodzie przedszkola">
          <span class="acc-head"><span>Gimnastyka korekcyjna</span><small>Wszystkie grupy wiekowe</small></span>
          <span class="plus">+</span>
        </summary>
        <div class="faq__a">
          <p>Sprawność fizyczna jest dla nas równie ważna co rozwój intelektualny, dlatego od najmłodszych lat zachęcamy dzieci do aktywności i tworzymy warunki do harmonijnego rozwoju. Prowadzimy gimnastykę korekcyjną dla wszystkich grup wiekowych.</p>
          <p>U najmłodszych (2,5–3 lata) skupiamy się na świadomości własnego ciała, wzmacnianiu mięśni i zachęcaniu do ruchu poprzez zabawy z przyborami (woreczki, laski gimnastyczne, piłki, tunel, walec, kołyska i inne). Starszym dzieciom proponujemy program profilaktyczny: kształtujemy nawyk prawidłowej postawy, wzmacniamy i rozciągamy mięśnie. W najstarszych grupach uczymy zasad fair play — przygotowujemy zarówno do wygrywania, jak i do radzenia sobie z porażką.</p>
          <img class="acc-single" loading="lazy" decoding="async" src="<?php echo $t; ?>/img/real/program/gimnastyka-1.webp" alt="Dziecko podczas ćwiczeń gimnastyki korekcyjnej" width="1411" height="1500">
        </div>
      </details>
      <details>
        <summary>
          <img class="acc-thumb" loading="lazy" decoding="async" src="<?php echo $t; ?>/img/real/galeria/DSCN2158.webp" alt="Przestronna sala przedszkolna z zabawkami i kącikami zabaw">
          <span class="acc-head"><span>Joga i zajęcia taneczne</span><small>Ruch, relaks i poczucie rytmu</small></span>
          <span class="plus">+</span>
        </summary>
        <div class="faq__a">
          <p>Joga to spokojne ćwiczenia wspierające koncentrację, równowagę i relaks — uczą dzieci wyciszenia i świadomości własnego ciała.</p>
          <p>Zajęcia taneczne prowadzi szkoła tańca PRO-DANCE. To radosna forma ruchu, która rozwija koordynację, poczucie rytmu i pewność siebie, a przy okazji świetnie integruje grupę.</p>
          <div class="photo-row">
            <img loading="lazy" decoding="async" src="<?php echo $t; ?>/img/real/program/joga-1.webp" alt="Dzieci podczas zajęć jogi na matach" width="1190" height="1600">
            <img loading="lazy" decoding="async" src="<?php echo $t; ?>/img/real/program/joga-2.webp" alt="Grupa dzieci ćwicząca jogę w przedszkolu" width="1600" height="900">
            <img loading="lazy" decoding="async" src="<?php echo $t; ?>/img/real/program/joga-3.webp" alt="Relaks i ćwiczenia jogi dla dzieci" width="1600" height="1200">
          </div>
        </div>
      </details>
      <details>
        <summary>
          <img class="acc-thumb" loading="lazy" decoding="async" src="<?php echo $t; ?>/img/real/galeria/DSCN2178.webp" alt="Sala przedszkolna z regałami pełnymi zabawek i pomocy">
          <span class="acc-head"><span>Warsztaty, wycieczki i „zielone noce"</span><small>Wydarzenia poza codziennymi zajęciami</small></span>
          <span class="plus">+</span>
        </summary>
        <div class="faq__a">
          <p>Poza codziennymi zajęciami organizujemy warsztaty edukacyjne, wycieczki oraz „zielone noce" — wyjątkowe wydarzenia, które integrują dzieci, rozbudzają ciekawość i poszerzają ich horyzonty. To chwile, które na długo zostają w pamięci najmłodszych.</p>
          <div class="photo-row">
            <img loading="lazy" decoding="async" src="<?php echo $t; ?>/img/real/program/warsztaty-1.webp" alt="Warsztaty plastyczne — malowanie farbami" width="1280" height="896">
            <img loading="lazy" decoding="async" src="<?php echo $t; ?>/img/real/program/warsztaty-2.webp" alt="Stół z materiałami na warsztatach twórczych" width="1280" height="896">
            <img loading="lazy" decoding="async" src="<?php echo $t; ?>/img/real/program/warsztaty-3.webp" alt="Wyjazd na łono natury — namioty i ognisko" width="1280" height="896">
          </div>
        </div>
      </details>
    </div>
  </div>
</section>

<!-- ROZWÓJ SPOŁECZNY I EMOCJONALNY -->
<section class="section">
  <div class="container">
    <div class="section-head reveal">
      <span class="eyebrow">Rozwój społeczny i emocjonalny</span>
      <h2>Uczymy emocji i bycia razem</h2>
      <p>Program wspiera nie tylko wiedzę, ale też relacje, emocje i umiejętność współpracy.</p>
    </div>
    <div class="grid cols-3 feat-grid">
      <article class="card reveal">
        <div class="card__icon c-blue" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21C5 14 3 11 3 8a5 5 0 019-3 5 5 0 019 3c0 3-2 6-9 13z"/></svg></div>
        <h3>Wyrażanie emocji</h3>
        <p>Muzyka pozwala dzieciom wyrażać emocje i wrażliwość oraz rozwijać ekspresję — w bezpieczny, twórczy sposób.</p>
      </article>
      <article class="card reveal" data-delay="1">
        <div class="card__icon c-blue" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="8" r="3"/><circle cx="17" cy="9" r="2.5"/><path d="M3 20c0-3 2.7-5 6-5s6 2 6 5"/><path d="M15.5 20c.2-2 1.2-3.2 3-3.2"/></svg></div>
        <h3>Integracja grupy</h3>
        <p>Taniec animacyjny (metoda KLANZA) łączy ruch, rytm i śpiew — służy relaksacji i integracji całej grupy.</p>
      </article>
      <article class="card reveal" data-delay="2">
        <div class="card__icon c-orange" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 13l4 4L19 7"/><circle cx="12" cy="12" r="10"/></svg></div>
        <h3>Współpraca i fair play</h3>
        <p>Na zajęciach ruchowych dzieci uczą się zasad fair play — zarówno cieszenia się z wygranej, jak i radzenia sobie z porażką.</p>
      </article>
    </div>
  </div>
</section>

<!-- SAMODZIELNOŚĆ, KREATYWNOŚĆ I ROZWÓJ -->
<section class="section sec-warm">
  <div class="container">
    <div class="section-head reveal">
      <span class="eyebrow">Samodzielność i kreatywność</span>
      <h2>Wspieramy samodzielność i twórczy rozwój</h2>
      <p>Dziecko jest aktywnym twórcą swojego rozwoju — my dajemy mu przestrzeń i narzędzia.</p>
    </div>
    <div class="grid cols-3 feat-grid">
      <article class="card reveal">
        <div class="card__icon c-purple" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="4"/><path d="M4 21c0-4 4-6 8-6s8 2 8 6"/></svg></div>
        <h3>Własne tempo</h3>
        <p>Podmiotowe traktowanie dziecka i program dostosowany do jego możliwości budują samodzielność i wiarę we własne siły.</p>
      </article>
      <article class="card reveal" data-delay="1">
        <div class="card__icon c-blue" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3l2.4 7.4H22l-6 4.4 2.3 7.2L12 17.8 5.7 22l2.3-7.2-6-4.4h7.6z"/></svg></div>
        <h3>Twórczość i wyobraźnia</h3>
        <p>Nieograniczony dostęp do materiałów plastycznych oraz muzyka rozwijają twórczość, wyobraźnię i kreatywność.</p>
      </article>
      <article class="card reveal" data-delay="2">
        <div class="card__icon c-green" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18h6M10 22h4M12 2a7 7 0 00-4 12.7c.6.5 1 1.3 1 2.1h6c0-.8.4-1.6 1-2.1A7 7 0 0012 2z"/></svg></div>
        <h3>Ciekawość świata</h3>
        <p>Rozbudzamy ciekawość poznawczą — dzieci poznają sztukę, matematykę i przyrodę, także podczas zajęć językowych.</p>
      </article>
    </div>
  </div>
</section>

<section class="section cta-band">
  <div class="container">
    <div class="card reveal">
      <h2>Chcesz poznać szczegóły i zapisać dziecko?</h2>
      <p style="margin-inline:auto">Skontaktuj się z nami — opowiemy o programie, dostępnych grupach i warunkach zapisu, a także zaprosimy na zwiedzanie przedszkola. Wizyta jest bezpłatna i bez zobowiązań.</p>
      <div class="btn-row"><a href="<?php echo esc_url( home_url( '/kontakt/' ) ); ?>" class="btn btn--primary btn--lg">Zapytaj o zapisy</a><a href="<?php echo esc_url( home_url( '/wsparcie/' ) ); ?>" class="btn btn--ghost btn--lg">WWR i terapia</a></div>
    </div>
  </div>
</section>

<?php
get_footer();
