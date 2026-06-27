<?php
/**
 * Szablon strony głównej (front-page.php).
 * Wygląd 1:1 z projektu HTML. Treść sekcji Hero edytowalna przez ACF
 * (z treścią domyślną = wygląd identyczny nawet bez ACF). Sekcja
 * „Aktualności" pobiera 3 najnowsze wpisy WordPress.
 *
 * @package Czarodziejski_Dworek
 */

get_header();

$t = get_template_directory_uri();
?>

<!-- ===== HERO ===== -->
<section class="hero">
	<div class="hero__bg" aria-hidden="true">
		<svg class="goo-defs" width="0" height="0" focusable="false"><defs>
			<filter id="heroGoo">
				<feGaussianBlur in="SourceGraphic" stdDeviation="12" result="blur"/>
				<feColorMatrix in="blur" type="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 20 -9" result="goo"/>
				<feBlend in="SourceGraphic" in2="goo"/>
			</filter>
		</defs></svg>
		<div class="goo" id="heroGooLayer">
			<span class="goo__b goo__b--1"></span>
			<span class="goo__b goo__b--2"></span>
			<span class="goo__b goo__b--3"></span>
			<span class="goo__b goo__b--4"></span>
			<span class="goo__b goo__b--5"></span>
			<span class="goo__b goo__b--pointer" id="heroGooPointer"></span>
		</div>
	</div>
	<div class="hero__floating" aria-hidden="true">
		<div class="hero__float" data-depth="1.2" style="top:1%;left:57%;--w:200px;--dur:9s;--delay:.6s"><img loading="lazy" decoding="async" src="<?php echo esc_url( $t ); ?>/img/real/hero/hero-muzyka.webp" alt="Dziecko gra na keyboardzie podczas zajęć muzycznych"></div>
		<div class="hero__float" data-depth="0.6" style="top:3%;left:76%;--w:185px;--dur:8s;--delay:0s"><img loading="lazy" decoding="async" src="<?php echo esc_url( $t ); ?>/img/real/hero/hero-malowanie.webp" alt="Dzieci podczas grupowych zajęć plastycznych w przedszkolu"></div>
		<div class="hero__float" data-depth="1.6" style="top:1%;left:92%;--w:155px;--dur:7.6s;--delay:1.2s"><img loading="lazy" decoding="async" src="<?php echo esc_url( $t ); ?>/img/real/hero/hero-radosc.webp" alt="Radosna dziewczynka w stroju baletowym w przedszkolu"></div>
		<div class="hero__float" data-depth="2.4" style="top:27%;left:46%;--w:160px;--dur:7.5s;--delay:.2s"><img loading="lazy" decoding="async" src="<?php echo esc_url( $t ); ?>/img/real/hero/hero-basen.webp" alt="Dzieci podczas nauki pływania na basenie w przedszkolu Czarodziejski Dworek"></div>
		<div class="hero__float" data-depth="1" style="top:25%;left:64%;--w:225px;--dur:8.5s;--delay:.9s"><img loading="lazy" decoding="async" src="<?php echo esc_url( $t ); ?>/img/real/hero/hero-klocki.webp" alt="Dzieci budują z dużych kolorowych klocków piankowych"></div>
		<div class="hero__float" data-depth="1.8" style="top:28%;left:86%;--w:170px;--dur:7.8s;--delay:.5s"><img loading="lazy" decoding="async" src="<?php echo esc_url( $t ); ?>/img/real/hero/hero-stolik.webp" alt="Dzieci oglądają książeczkę przy stoliku podczas zajęć"></div>
		<div class="hero__float" data-depth="3" style="top:51%;left:47%;--w:150px;--dur:6.5s;--delay:1.1s"><img loading="lazy" decoding="async" src="<?php echo esc_url( $t ); ?>/img/real/hero/hero-sensoryka.webp" alt="Dzieci podczas wspólnych zajęć sensorycznych przy stole"></div>
		<div class="hero__float" data-depth="1.3" style="top:50%;left:65%;--w:205px;--dur:8.2s;--delay:.3s"><img loading="lazy" decoding="async" src="<?php echo esc_url( $t ); ?>/img/real/hero/hero-grupa.webp" alt="Dzieci w papierowych koronach podczas zajęć grupowych w przedszkolu"></div>
		<div class="hero__float" data-depth="2" style="top:53%;left:87%;--w:170px;--dur:7.4s;--delay:.8s"><img loading="lazy" decoding="async" src="<?php echo esc_url( $t ); ?>/img/real/hero/hero-nauka.webp" alt="Kolorowe kredki i rysunki dzieci podczas zajęć plastycznych"></div>
		<div class="hero__float" data-depth="2.6" style="top:75%;left:49%;--w:165px;--dur:7s;--delay:.4s"><img loading="lazy" decoding="async" src="<?php echo esc_url( $t ); ?>/img/real/hero/hero-plener.webp" alt="Dzieci na spacerze wśród drzew w ogrodzie przedszkolnym"></div>
		<div class="hero__float" data-depth="0.6" style="top:76%;left:69%;--w:150px;--dur:9.5s;--delay:1s"><img loading="lazy" decoding="async" src="<?php echo esc_url( $t ); ?>/img/real/hero/hero-emocje.webp" alt="Dziewczynka w skupieniu w sali przedszkolnej"></div>
		<div class="hero__float" data-depth="1.5" style="top:73%;left:88%;--w:175px;--dur:8.3s;--delay:.15s"><img loading="lazy" decoding="async" src="<?php echo esc_url( $t ); ?>/img/real/hero/hero-kreda.webp" alt="Dzieci podczas kreatywnej zabawy kolorowymi materiałami"></div>
	</div>
	<div class="hero__scrim" aria-hidden="true"></div>
	<div class="container hero__grid">
		<div class="hero__content reveal">
			<span class="eyebrow"><?php echo esc_html( dworek_field( 'hero_eyebrow', 'Przedszkole językowo-muzyczne · Warszawa, Wola · od 2003' ) ); ?></span>
			<h1><?php echo dworek_accent( dworek_field( 'hero_title', 'Tu odkrywamy [mocne strony] Twojego dziecka' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></h1>
			<p class="lead"><?php echo esc_html( dworek_field( 'hero_lead', 'Kameralne, niepubliczne przedszkole na warszawskiej Woli, w którym Twoje dziecko jest naprawdę zauważone. Małe grupy, języki, basen i muzyka w czesnym oraz specjaliści na miejscu — od 2003 roku. Umów wizytę i zobacz nas od środka.' ) ); ?></p>
			<div class="hero__cta">
				<a href="<?php echo esc_url( home_url( '/kontakt/' ) ); ?>" class="btn btn--primary btn--lg"><?php echo esc_html( dworek_field( 'hero_cta_label', 'Zapisz dziecko' ) ); ?>
					<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
				</a>
				<a href="#oferta" class="btn btn--ghost btn--lg">Poznaj ofertę</a>
			</div>
			<div class="hero__proof">
				<div class="avatars" aria-hidden="true">
					<img loading="lazy" decoding="async" src="<?php echo esc_url( $t ); ?>/img/kadra/k1.svg" alt=""><img loading="lazy" decoding="async" src="<?php echo esc_url( $t ); ?>/img/kadra/k2.svg" alt=""><img loading="lazy" decoding="async" src="<?php echo esc_url( $t ); ?>/img/kadra/k3.svg" alt=""><img loading="lazy" decoding="async" src="<?php echo esc_url( $t ); ?>/img/kadra/k6.svg" alt="">
				</div>
				<div>
					<div class="stars" role="img" aria-label="Ocena 5 na 5">
						<svg viewBox="0 0 24 24"><path d="M12 2l3 6 7 .5-5 4.5 1.5 7L12 16l-6.5 4 1.5-7-5-4.5 7-.5z"/></svg><svg viewBox="0 0 24 24"><path d="M12 2l3 6 7 .5-5 4.5 1.5 7L12 16l-6.5 4 1.5-7-5-4.5 7-.5z"/></svg><svg viewBox="0 0 24 24"><path d="M12 2l3 6 7 .5-5 4.5 1.5 7L12 16l-6.5 4 1.5-7-5-4.5 7-.5z"/></svg><svg viewBox="0 0 24 24"><path d="M12 2l3 6 7 .5-5 4.5 1.5 7L12 16l-6.5 4 1.5-7-5-4.5 7-.5z"/></svg><svg viewBox="0 0 24 24"><path d="M12 2l3 6 7 .5-5 4.5 1.5 7L12 16l-6.5 4 1.5-7-5-4.5 7-.5z"/></svg>
					</div>
					<strong>Rodzice nas polecają</strong><small>opinie na Facebooku</small>
				</div>
			</div>
			<a href="<?php echo esc_url( $t ); ?>/img/certyfikat-nvc.png" target="_blank" rel="noopener" class="hero__badge reveal" title="Zobacz certyfikat NVC — Porozumienie Bez Przemocy">
				<span class="hero__badge-ico" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="6"/><path d="M8.21 13.89L7 22l5-3 5 3-1.21-8.11"/></svg></span>
				<span class="hero__badge-txt"><strong>Certyfikat NVC</strong><small>Porozumienie Bez Przemocy</small></span>
			</a>
			<div class="hero__stats">
				<div class="stat"><strong><span data-count="20" data-suffix="+">0</span></strong><span>lat doświadczenia</span></div>
				<div class="stat"><strong><span data-count="14">0</span></strong><span>dzieci maks. w grupie</span></div>
				<div class="stat"><strong><span data-count="2">0</span></strong><span>nauczycieli w grupie</span></div>
			</div>
		</div>
	</div>
	<div class="hero__wave" aria-hidden="true">
		<svg viewBox="0 0 1440 70" preserveAspectRatio="none"><path fill="#fff" d="M0 40c180-40 360-40 540-12s360 44 540 16 240-36 360-32v58H0z"/></svg>
	</div>
</section>

<!-- ===== DLACZEGO WARTO ===== -->
<section class="section features section-deco sec-warm">
	<div class="container">
		<div class="section-head reveal">
			<span class="eyebrow">Dlaczego warto</span>
			<h2>Dlaczego warto wybrać Czarodziejski Dworek?</h2>
			<p>Ponad 20 lat doświadczenia, małe grupy i specjaliści na miejscu — wszystko, czego potrzebuje Twoje dziecko, by rosło bezpieczne, radosne i ciekawe świata.</p>
		</div>
		<div class="grid features__grid feat-grid">
			<article class="card reveal">
				<div class="card__icon c-blue" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="8" r="3"/><circle cx="17" cy="9" r="2.5"/><path d="M3 20c0-3 2.7-5 6-5s6 2 6 5M15 20c0-2 1-3.5 3-4"/></svg></div>
				<h3>Małe grupy</h3>
				<p>Do 14 dzieci w grupie i 2 nauczycieli — każde dziecko jest naprawdę zauważone.</p>
			</article>
			<article class="card reveal" data-delay="1">
				<div class="card__icon c-sky" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21C5 14 3 11 3 8a5 5 0 019-3 5 5 0 019 3c0 3-2 6-9 13z"/></svg></div>
				<h3>Specjaliści na miejscu</h3>
				<p>Logopeda, psycholog, terapeuta SI i fizjoterapeuta — wszyscy w przedszkolu.</p>
			</article>
			<article class="card reveal" data-delay="2">
				<div class="card__icon c-pink" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 11h14l-1 9H6l-1-9z"/><path d="M9 11V7a3 3 0 016 0v4"/></svg></div>
				<h3>Zdrowe jedzenie</h3>
				<p>Smaczne, zdrowe posiłki — uwzględniamy wszystkie diety dzieci.</p>
			</article>
			<article class="card reveal" data-delay="3">
				<div class="card__icon c-green" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21V10l9-7 9 7v11h-6v-6H9v6z"/></svg></div>
				<h3>Bezpieczny teren</h3>
				<p>Duży, ogrodzony plac zabaw i własny parking dla rodziców.</p>
			</article>
		</div>
		<div class="adv-grid reveal" style="margin-top:var(--s-5)">
			<div class="adv-card">
				<span class="adv-card__icon c-sky" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="12" rx="2"/><path d="M3 9h18M8 20h8M12 16v4"/></svg></span>
				<p>Przestronne sale edukacyjne z zapleczem sanitarnym</p>
			</div>
			<div class="adv-card">
				<span class="adv-card__icon c-orange" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3l2.7 5.4 6 .9-4.35 4.2 1.05 6L12 17.7 6.6 20.5l1.05-6L3.3 9.3l6-.9z"/></svg></span>
				<p>Nieodpłatne zajęcia terapeutyczne, językowe, basen i warsztaty</p>
			</div>
			<div class="adv-card">
				<span class="adv-card__icon c-yellow" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg></span>
				<p>Wsparcie dla rodziców: konsultacje, warsztaty i szkolenia</p>
			</div>
			<div class="adv-card">
				<span class="adv-card__icon c-orange" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 14.5A8 8 0 1 1 9.5 4a6.2 6.2 0 0 0 10.5 10.5z"/><path d="M18 4.5l.7 1.8 1.8.7-1.8.7-.7 1.8-.7-1.8L15.5 7l1.8-.7z"/></svg></span>
				<p>„Zielone noce" i kilkudniowe wycieczki</p>
			</div>
		</div>
		<div class="photo-mosaic reveal" data-lightbox>
			<figure class="pm-big"><img loading="lazy" decoding="async" src="<?php echo esc_url( $t ); ?>/img/real/warto-basen.webp" alt="Dzieci podczas nauki pływania na basenie z instruktorem" width="1600" height="1062"><figcaption>Basen i bogata oferta w cenie czesnego</figcaption></figure>
			<figure class="pm-sm"><img loading="lazy" decoding="async" src="<?php echo esc_url( $t ); ?>/img/real/warto-sala.webp" alt="Przestronna, jasna sala przedszkolna z kolorowymi meblami" width="1600" height="1200"><figcaption>Przestronne, jasne sale</figcaption></figure>
			<figure class="pm-sm"><img loading="lazy" decoding="async" src="<?php echo esc_url( $t ); ?>/img/real/warto-plac.webp" alt="Duży, ogrodzony plac zabaw przedszkola wśród zieleni" width="1600" height="1200"><figcaption>Bezpieczny, ogrodzony teren</figcaption></figure>
		</div>
	</div>
</section>

<!-- ===== O NAS (krótkie przedstawienie) ===== -->
<section class="section">
	<div class="container">
		<div class="reveal" style="text-align:center;margin-bottom:var(--s-4)"><span class="eyebrow">O „Czarodziejskim Dworku"</span></div>
		<div class="split split--reverse">
			<div class="split__media reveal"><img loading="lazy" decoding="async" src="<?php echo esc_url( $t ); ?>/img/real/kroki.jpg" alt="Nauczycielka i dzieci podczas wspólnych zajęć przy stole w przedszkolu" width="900" height="600"></div>
			<div class="split__content reveal" data-delay="1">
				<h2>Wyjątkowe przedszkole z 20-letnią tradycją</h2>
				<p>Przedszkole założyliśmy we wrześniu 2003 roku. Jesteśmy wpisani do ewidencji szkół i placówek niepublicznych pod nr 111/PN. Naszym celem jest dbanie o wszechstronny rozwój dziecka — odkrywamy i doceniamy jego mocne strony, zaszczepiamy pasje twórcze i wspomagamy harmonijny rozwój.</p>
				<ul class="checklist">
					<li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg> Indywidualne podejście do każdego dziecka</li>
					<li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg> Rodzinna, ciepła atmosfera</li>
					<li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg> Wykwalifikowana kadra i specjaliści na miejscu</li>
				</ul>
				<a href="<?php echo esc_url( home_url( '/o-nas/' ) ); ?>" class="btn btn--accent">Więcej o nas</a>
			</div>
		</div>
	</div>
</section>

<!-- ===== ZAJĘCIA W RAMACH CZESNEGO ===== -->
<section class="section" id="oferta">
	<div class="container">
		<div class="section-head reveal">
			<span class="eyebrow">Zajęcia w czesnym</span>
			<h2>Bogata oferta bez dodatkowych opłat</h2>
			<p>Basen, języki i muzyka są w cenie czesnego — bez ukrytych kosztów.</p>
		</div>
		<div class="grid features__grid">
			<article class="card pic-card reveal">
				<img loading="lazy" decoding="async" src="<?php echo esc_url( $t ); ?>/img/real/basen.webp" alt="Dzieci uczą się pływać na basenie — zajęcia pływania w czesnym">
				<div class="pic-card__body"><span class="tag">W czesnym</span><h3>Basen</h3><p>Nauka pływania i oswajanie z wodą pod okiem instruktorów.</p></div>
			</article>
			<article class="card pic-card reveal" data-delay="1">
				<img loading="lazy" decoding="async" src="<?php echo esc_url( $t ); ?>/img/real/angielski.webp" alt="Flaga i mapa Wielkiej Brytanii — zajęcia z języka angielskiego w przedszkolu">
				<div class="pic-card__body"><span class="tag">W czesnym</span><h3>Język angielski</h3><p>Codzienny kontakt z językiem — nauka przez zabawę i piosenki.</p></div>
			</article>
			<article class="card pic-card reveal" data-delay="2">
				<img loading="lazy" decoding="async" src="<?php echo esc_url( $t ); ?>/img/real/francuski.webp" alt="Flaga i mapa Francji — zajęcia z języka francuskiego w przedszkolu">
				<div class="pic-card__body"><span class="tag">W czesnym</span><h3>Język francuski</h3><p>Drugi język obcy od najmłodszych lat, w naturalnej formie.</p></div>
			</article>
			<article class="card pic-card reveal" data-delay="3">
				<img loading="lazy" decoding="async" src="<?php echo esc_url( $t ); ?>/img/real/muzyka.webp" alt="Kolorowe instrumenty muzyczne dla dzieci — zajęcia umuzykalniające">
				<div class="pic-card__body"><span class="tag">W czesnym</span><h3>Muzyka</h3><p>Rytmika, śpiew i instrumenty — rozwój słuchu i poczucia rytmu.</p></div>
			</article>
		</div>
	</div>
</section>

<!-- ===== PROGRAM EDUKACYJNY ===== -->
<section class="section section-deco sec-warm">
	<div class="container">
		<div class="reveal" style="text-align:center;margin-bottom:var(--s-4)"><span class="eyebrow">Program</span></div>
		<div class="split">
			<div class="split__media reveal"><img loading="lazy" decoding="async" src="<?php echo esc_url( $t ); ?>/img/real/program2.jpg" alt="Dziecko podczas twórczej zabawy kolorowymi materiałami sensorycznymi" width="900" height="600"></div>
			<div class="split__content reveal" data-delay="1">
				<h2>Program, w którym każda zabawa jest nauką</h2>
				<p>„W «Czarodziejskim Dworku» każda zabawa jest nauką, a każda nauka jest zabawą." Przez radość i twórczość wspieramy wszechstronny rozwój każdego dziecka.</p>
				<ul class="checklist">
					<li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg> Rozbudzamy ciekawość poznawczą</li>
					<li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg> Rozwijamy zdolności artystyczne, muzyczne i językowe</li>
					<li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg> Wspieramy wyobraźnię i poczucie własnej wartości</li>
				</ul>
			</div>
		</div>

		<div class="section-head reveal" style="margin-top:var(--s-7)">
			<span class="eyebrow">Obszary programu</span>
			<h2>Wszystko, co rozwijamy u dzieci</h2>
			<p>15 zajęć i terapii w trzech obszarach — w cenie czesnego.</p>
		</div>
		<div class="grid cols-3 feat-grid">
			<article class="card reveal" style="--dot:var(--accent)">
				<div class="card__icon c-blue" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 016.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 014 19.5v-15A2.5 2.5 0 016.5 2z"/></svg></div>
				<h3>Edukacja i języki</h3>
				<ul class="prog-list">
					<li>Zajęcia edukacyjne</li>
					<li>Język angielski</li>
					<li>Język francuski</li>
				</ul>
			</article>
			<article class="card reveal" data-delay="1" style="--dot:var(--accent)">
				<div class="card__icon c-blue" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18V5l12-2v13"/><circle cx="6" cy="18" r="3"/><circle cx="18" cy="16" r="3"/></svg></div>
				<h3>Muzyka i ruch</h3>
				<ul class="prog-list">
					<li>Muzyka</li>
					<li>Gimnastyka</li>
					<li>Joga</li>
					<li>Zajęcia taneczne</li>
					<li>Basen</li>
				</ul>
			</article>
			<article class="card reveal" data-delay="2" style="--dot:var(--primary)">
				<div class="card__icon c-orange" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21C5 14 3 11 3 8a5 5 0 019-3 5 5 0 019 3c0 3-2 6-9 13z"/></svg></div>
				<h3>WWR i terapia</h3>
				<ul class="prog-list">
					<li>Logopedia</li>
					<li>Psycholog</li>
					<li>Integracja sensoryczna</li>
					<li>Trening umiejętności społecznych (TUS)</li>
					<li>WWR i terapia pedagogiczna</li>
					<li>Fizjoterapia</li>
				</ul>
			</article>
		</div>
	</div>
</section>

<!-- ===== SPECJALIŚCI ===== -->
<section class="section">
	<div class="container">
		<div class="section-head reveal">
			<span class="eyebrow">Kadra i specjaliści</span>
			<h2>Specjaliści, których znajdziesz na miejscu</h2>
			<p>Diagnoza i terapia bez konieczności szukania pomocy poza przedszkolem.</p>
		</div>
		<div class="grid cols-3 feat-grid">
			<article class="card reveal"><div class="card__icon c-blue" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="4"/><path d="M4 21c0-4 4-6 8-6s8 2 8 6"/></svg></div><h3>Nauczyciele</h3><p>Doświadczona kadra pedagogiczna — 2 nauczycieli w każdej grupie.</p></article>
			<article class="card reveal" data-delay="1"><div class="card__icon c-blue" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg></div><h3>Logopeda</h3><p>Diagnoza i terapia mowy, słuchu fonematycznego i komunikacji.</p></article>
			<article class="card reveal" data-delay="2"><div class="card__icon c-purple" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3a5 5 0 015 5c0 1.5-.6 2.5-1.5 3.5S14 14 14 16v1h-4v-1c0-2-.6-2.5-1.5-4.5S7 9.5 7 8a5 5 0 015-5z"/><path d="M10 21h4"/></svg></div><h3>Psycholog</h3><p>Wsparcie emocjonalne i społeczne dziecka oraz konsultacje dla rodziców.</p></article>
			<article class="card reveal"><div class="card__icon c-orange" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="4"/><path d="M12 3v3M12 18v3M3 12h3M18 12h3"/></svg></div><h3>Terapeuta SI</h3><p>Integracja sensoryczna wspierająca koncentrację i równowagę.</p></article>
			<article class="card reveal" data-delay="1"><div class="card__icon c-green" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="5" r="2"/><path d="M12 7v6m0 0l-3 6m3-6l3 6M7 11l5-1 5 1"/></svg></div><h3>Fizjoterapeuta</h3><p>Ćwiczenia wspierające prawidłową postawę i rozwój ruchowy.</p></article>
			<article class="card reveal" data-delay="2"><div class="card__icon c-orange" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 016.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 014 19.5v-15A2.5 2.5 0 016.5 2z"/></svg></div><h3>Pedagog</h3><p>Terapia pedagogiczna i wsparcie w rozwoju umiejętności szkolnych.</p></article>
		</div>
		<div class="center" style="margin-top:var(--s-4)"><a href="<?php echo esc_url( home_url( '/kadra/' ) ); ?>" class="btn btn--primary">Poznaj naszą kadrę</a></div>
	</div>
</section>

<!-- ===== WWR / WSPARCIE TERAPEUTYCZNE ===== -->
<section class="section" style="background:var(--surface)">
	<div class="container">
		<div class="reveal" style="text-align:center;margin-bottom:var(--s-4)"><span class="eyebrow">WWR i terapie</span></div>
		<div class="split split--reverse">
			<div class="split__media reveal"><img loading="lazy" decoding="async" src="<?php echo esc_url( $t ); ?>/img/real/logopedia.webp" alt="Dziecko podczas indywidualnych zajęć logopedycznych z terapeutką" width="900" height="700"></div>
			<div class="split__content reveal" data-delay="1">
				<h2>Bezpłatne wsparcie terapeutyczne</h2>
				<p>Dzieci z opinią o potrzebie wczesnego wspomagania rozwoju (WWR) obejmujemy bezpłatnymi, indywidualnymi zajęciami terapeutycznymi — prowadzonymi przez specjalistów na miejscu.</p>
				<ul class="checklist">
					<li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg> Terapia psychologiczna, logopedyczna i pedagogiczna</li>
					<li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg> Integracja sensoryczna oraz fizjoterapia</li>
					<li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg> Trening Umiejętności Społecznych (TUS)</li>
				</ul>
				<a href="<?php echo esc_url( home_url( '/wsparcie/' ) ); ?>" class="btn btn--accent">Poznaj nasze terapie</a>
			</div>
		</div>
	</div>
</section>

<!-- ===== ADAPTACJA ===== -->
<section class="section--tight">
	<div class="container">
		<div class="band reveal center">
			<span class="eyebrow" style="background:rgba(255,255,255,.2);border-color:rgba(255,255,255,.4);color:#fff">Adaptacja</span>
			<h2 style="margin:.6rem 0">Łagodna adaptacja — poznaj nas w soboty</h2>
			<p>Zapraszamy na bezpłatne sobotnie zajęcia adaptacyjne dla najmłodszych dzieci i ich rodziców. Wspólna zabawa pomaga dziecku spokojnie oswoić się z przedszkolem — aktualne terminy i zapisy ogłaszamy na Facebooku.</p>
			<a href="https://www.facebook.com/czarodziejskidworek/" target="_blank" rel="noopener" class="btn btn--ghost btn--lg">Zapisy przez Facebook</a>
		</div>
	</div>
</section>

<!-- ===== GALERIA ===== -->
<section class="section">
	<div class="container">
		<div class="section-head reveal">
			<span class="eyebrow">Galeria</span>
			<h2>Zajrzyj do naszego świata</h2>
		</div>
		<div class="gallery-grid reveal" data-lightbox style="max-width:940px;margin-inline:auto">
			<figure class="span-2"><img loading="lazy" decoding="async" src="<?php echo esc_url( $t ); ?>/img/real/galeria/zajecia/14352144_1127712087291481_6967720382886910998_o.webp" alt="Dzieci malują farbami podczas zajęć plastycznych"><figcaption>Zajęcia plastyczne</figcaption></figure>
			<figure><img loading="lazy" decoding="async" src="<?php echo esc_url( $t ); ?>/img/real/galeria/zajecia/26758074_1611870728875612_7814133923000920583_o.webp" alt="Dzieci budują z wielkich kolorowych klocków"><figcaption>Wielkie klocki</figcaption></figure>
			<figure><img loading="lazy" decoding="async" src="<?php echo esc_url( $t ); ?>/img/real/galeria/zajecia/14468445_1135412373188119_3550848999267885218_o.webp" alt="Dzieci na zajęciach nauki pływania na basenie"><figcaption>Basen</figcaption></figure>
			<figure><img loading="lazy" decoding="async" src="<?php echo esc_url( $t ); ?>/img/real/galeria/zycie/DSCN8677.webp" alt="Ogrodzony plac zabaw przedszkola"><figcaption>Plac zabaw</figcaption></figure>
			<figure><img loading="lazy" decoding="async" src="<?php echo esc_url( $t ); ?>/img/real/galeria/joga/94036311_676991443103064_7310551022357708800_n.webp" alt="Dzieci podczas zajęć relaksacyjnych na macie"><figcaption>Joga i relaks</figcaption></figure>
		</div>
		<div class="center" style="margin-top:var(--s-4)"><a href="<?php echo esc_url( home_url( '/galeria/' ) ); ?>" class="btn btn--primary">Zobacz pełną galerię</a></div>
	</div>
</section>

<!-- ===== OPINIE RODZICÓW ===== -->
<section class="section sec-warm">
	<div class="container">
		<div class="section-head reveal">
			<span class="eyebrow">Opinie rodziców</span>
			<h2>Co mówią o nas rodzice</h2>
			<p>Prawdziwe opinie z naszego profilu na Facebooku.</p>
		</div>
		<div class="grid cols-2">
			<article class="card quote-card reveal">
				<div class="stars" role="img" aria-label="Ocena 5 na 5"><svg viewBox="0 0 24 24"><path d="M12 2l3 6 7 .5-5 4.5 1.5 7L12 16l-6.5 4 1.5-7-5-4.5 7-.5z"/></svg><svg viewBox="0 0 24 24"><path d="M12 2l3 6 7 .5-5 4.5 1.5 7L12 16l-6.5 4 1.5-7-5-4.5 7-.5z"/></svg><svg viewBox="0 0 24 24"><path d="M12 2l3 6 7 .5-5 4.5 1.5 7L12 16l-6.5 4 1.5-7-5-4.5 7-.5z"/></svg><svg viewBox="0 0 24 24"><path d="M12 2l3 6 7 .5-5 4.5 1.5 7L12 16l-6.5 4 1.5-7-5-4.5 7-.5z"/></svg><svg viewBox="0 0 24 24"><path d="M12 2l3 6 7 .5-5 4.5 1.5 7L12 16l-6.5 4 1.5-7-5-4.5 7-.5z"/></svg></div>
				<blockquote>„Przedszkole ze wspaniałą kadrą, wręcz rodzinną atmosferą, które mogę polecić każdemu. Nie wyobrażam sobie nawet lepszego miejsca."</blockquote>
				<div class="who"><img loading="lazy" decoding="async" src="<?php echo esc_url( $t ); ?>/img/kadra/k2.svg" alt=""><div><strong>Mariusz Linkiewicz</strong><span>rodzic</span></div></div>
			</article>
			<article class="card quote-card reveal" data-delay="1">
				<div class="stars" role="img" aria-label="Ocena 5 na 5"><svg viewBox="0 0 24 24"><path d="M12 2l3 6 7 .5-5 4.5 1.5 7L12 16l-6.5 4 1.5-7-5-4.5 7-.5z"/></svg><svg viewBox="0 0 24 24"><path d="M12 2l3 6 7 .5-5 4.5 1.5 7L12 16l-6.5 4 1.5-7-5-4.5 7-.5z"/></svg><svg viewBox="0 0 24 24"><path d="M12 2l3 6 7 .5-5 4.5 1.5 7L12 16l-6.5 4 1.5-7-5-4.5 7-.5z"/></svg><svg viewBox="0 0 24 24"><path d="M12 2l3 6 7 .5-5 4.5 1.5 7L12 16l-6.5 4 1.5-7-5-4.5 7-.5z"/></svg><svg viewBox="0 0 24 24"><path d="M12 2l3 6 7 .5-5 4.5 1.5 7L12 16l-6.5 4 1.5-7-5-4.5 7-.5z"/></svg></div>
				<blockquote>„Super przedszkole z indywidualnym podejściem do każdego dziecka. Bardzo dużo rozwijających zajęć, nieodpłatne zajęcia logopedyczne i świetne warsztaty edukacyjne."</blockquote>
				<div class="who"><img loading="lazy" decoding="async" src="<?php echo esc_url( $t ); ?>/img/kadra/k1.svg" alt=""><div><strong>Agnieszka</strong><span>rodzic</span></div></div>
			</article>
			<article class="card quote-card reveal" data-delay="1">
				<div class="stars" role="img" aria-label="Ocena 5 na 5"><svg viewBox="0 0 24 24"><path d="M12 2l3 6 7 .5-5 4.5 1.5 7L12 16l-6.5 4 1.5-7-5-4.5 7-.5z"/></svg><svg viewBox="0 0 24 24"><path d="M12 2l3 6 7 .5-5 4.5 1.5 7L12 16l-6.5 4 1.5-7-5-4.5 7-.5z"/></svg><svg viewBox="0 0 24 24"><path d="M12 2l3 6 7 .5-5 4.5 1.5 7L12 16l-6.5 4 1.5-7-5-4.5 7-.5z"/></svg><svg viewBox="0 0 24 24"><path d="M12 2l3 6 7 .5-5 4.5 1.5 7L12 16l-6.5 4 1.5-7-5-4.5 7-.5z"/></svg><svg viewBox="0 0 24 24"><path d="M12 2l3 6 7 .5-5 4.5 1.5 7L12 16l-6.5 4 1.5-7-5-4.5 7-.5z"/></svg></div>
				<blockquote>„Moje obie córki chodzą do tego przedszkola. Jesteśmy z mężem bardzo zadowoleni i nie zamienilibyśmy tego miejsca na żadne inne!"</blockquote>
				<div class="who"><img loading="lazy" decoding="async" src="<?php echo esc_url( $t ); ?>/img/kadra/k3.svg" alt=""><div><strong>Anna Łucja</strong><span>rodzic</span></div></div>
			</article>
			<article class="card quote-card reveal" data-delay="2">
				<div class="stars" role="img" aria-label="Ocena 5 na 5"><svg viewBox="0 0 24 24"><path d="M12 2l3 6 7 .5-5 4.5 1.5 7L12 16l-6.5 4 1.5-7-5-4.5 7-.5z"/></svg><svg viewBox="0 0 24 24"><path d="M12 2l3 6 7 .5-5 4.5 1.5 7L12 16l-6.5 4 1.5-7-5-4.5 7-.5z"/></svg><svg viewBox="0 0 24 24"><path d="M12 2l3 6 7 .5-5 4.5 1.5 7L12 16l-6.5 4 1.5-7-5-4.5 7-.5z"/></svg><svg viewBox="0 0 24 24"><path d="M12 2l3 6 7 .5-5 4.5 1.5 7L12 16l-6.5 4 1.5-7-5-4.5 7-.5z"/></svg><svg viewBox="0 0 24 24"><path d="M12 2l3 6 7 .5-5 4.5 1.5 7L12 16l-6.5 4 1.5-7-5-4.5 7-.5z"/></svg></div>
				<blockquote>„Moje dziecko uczęszcza do tego przedszkola od kilku lat i widoczna jest bardzo duża poprawa zarówno w rozwoju emocjonalnym, jak i intelektualnym."</blockquote>
				<div class="who"><img loading="lazy" decoding="async" src="<?php echo esc_url( $t ); ?>/img/kadra/k6.svg" alt=""><div><strong>Agnieszka Zawadzka</strong><span>rodzic</span></div></div>
			</article>
		</div>
	</div>
</section>

<!-- ===== AKTUALNOŚCI / BLOG (najnowsze wpisy WordPress) ===== -->
<section class="section">
	<div class="container">
		<div class="section-head reveal">
			<span class="eyebrow">Aktualności</span>
			<h2>Co słychać w Dworku</h2>
		</div>
		<div class="grid cols-3">
			<?php
			$dworek_news = new WP_Query(
				array(
					'post_type'           => 'post',
					'posts_per_page'      => 3,
					'ignore_sticky_posts' => true,
					'no_found_rows'       => true,
				)
			);
			if ( $dworek_news->have_posts() ) :
				$i = 0;
				while ( $dworek_news->have_posts() ) :
					$dworek_news->the_post();
					$delay = $i ? ' data-delay="' . esc_attr( $i ) . '"' : '';
					?>
					<article class="card blog-card reveal"<?php echo $delay; // phpcs:ignore ?>>
						<span class="date"><?php echo esc_html( get_the_date() ); ?></span>
						<h3><?php the_title(); ?></h3>
						<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 20, '…' ) ); ?></p>
						<a class="more" href="<?php the_permalink(); ?>">Czytaj więcej →</a>
					</article>
					<?php
					$i++;
				endwhile;
				wp_reset_postdata();
			else :
				// Wariant awaryjny (zanim powstaną wpisy) — wygląd 1:1.
				?>
				<article class="card blog-card reveal">
					<span class="date">8 stycznia 2025</span>
					<h3>Dzień otwarty!</h3>
					<p>Szukasz dobrego przedszkola na warszawskiej Woli? Zapraszamy do Czarodziejskiego Dworku.</p>
					<a class="more" href="<?php echo esc_url( home_url( '/blog/' ) ); ?>">Czytaj więcej →</a>
				</article>
				<article class="card blog-card reveal" data-delay="1">
					<span class="date">26 września 2024</span>
					<h3>Szkoła Myślenia Pozytywnego</h3>
					<p>Bierzemy udział w programie — roczna przygoda pełna wrażeń, empatii i pracy nad otwartością.</p>
					<a class="more" href="<?php echo esc_url( home_url( '/blog/' ) ); ?>">Czytaj więcej →</a>
				</article>
				<article class="card blog-card reveal" data-delay="2">
					<span class="date">2 września 2024</span>
					<h3>Zajęcia z języka angielskiego</h3>
					<p>Materiały i podsumowanie zajęć językowych dla grup: Białej, Czerwonej, Fioletowej i Niebieskiej.</p>
					<a class="more" href="<?php echo esc_url( home_url( '/blog/' ) ); ?>">Czytaj więcej →</a>
				</article>
			<?php endif; ?>
		</div>
		<div class="center" style="margin-top:var(--s-4)"><a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>" class="btn btn--ghost">Zobacz blog</a></div>
	</div>
</section>

<!-- ===== CTA ===== -->
<section class="section cta-band">
	<div class="container">
		<div class="card reveal">
			<span class="eyebrow">Rekrutacja</span>
			<h2>Zapewnij dziecku wyjątkowy start</h2>
			<p style="margin-inline:auto">Umów bezpłatne spotkanie i zobacz „Czarodziejski Dworek" od środka — poznasz kadrę, sale i ogród. Zostaw kontakt, a oddzwonimy i odpowiemy na wszystkie pytania. Bez zobowiązań.</p>
			<div class="btn-row">
				<a href="<?php echo esc_url( home_url( '/kontakt/' ) ); ?>" class="btn btn--primary btn--lg">Zapisz dziecko</a>
				<a href="tel:+48690629501" class="btn btn--ghost btn--lg">
					<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.9v3a2 2 0 01-2.2 2 19.8 19.8 0 01-8.6-3 19.5 19.5 0 01-6-6 19.8 19.8 0 01-3-8.6A2 2 0 014.1 2h3a2 2 0 012 1.7c.1 1 .4 1.9.7 2.8a2 2 0 01-.5 2.1L8.1 9.9a16 16 0 006 6l1.3-1.3a2 2 0 012.1-.4c.9.3 1.8.6 2.8.7a2 2 0 011.8 2z"/></svg>
					Zadzwoń: 690 629 501
				</a>
			</div>
		</div>
	</div>
</section>

<?php
get_footer();
