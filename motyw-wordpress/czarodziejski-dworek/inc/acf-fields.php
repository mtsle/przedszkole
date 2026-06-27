<?php
/**
 * Rejestracja pól ACF (Advanced Custom Fields).
 *
 * Pola są rejestrowane w kodzie (acf_add_local_field_group), więc klient
 * NIE musi ich ręcznie tworzyć — wystarczy, że zainstaluje i aktywuje
 * darmową wtyczkę „Advanced Custom Fields". Bez wtyczki motyw nadal działa
 * (szablony używają dworek_field() z treścią domyślną = wygląd 1:1).
 *
 * @package Czarodziejski_Dworek
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'acf/init', 'dworek_register_acf_fields' );
function dworek_register_acf_fields() {

	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	/* ---------------------------------------------------------------
	 * GRUPA 1: Strona główna — sekcja Hero (tytuł, tekst, przyciski)
	 * --------------------------------------------------------------- */
	acf_add_local_field_group(
		array(
			'key'    => 'group_dworek_front_hero',
			'title'  => 'Strona główna — Hero (sekcja powitalna)',
			'fields' => array(
				array(
					'key'           => 'field_hero_eyebrow',
					'label'         => 'Nadtytuł (mały tekst nad nagłówkiem)',
					'name'          => 'hero_eyebrow',
					'type'          => 'text',
					'placeholder'   => 'Przedszkole językowo-muzyczne · Warszawa, Wola · od 2003',
				),
				array(
					'key'          => 'field_hero_title',
					'label'        => 'Nagłówek główny (H1)',
					'name'         => 'hero_title',
					'type'         => 'text',
					'instructions' => 'Słowo do wyróżnienia kolorem otocz znacznikiem, np.: Tu odkrywamy [mocne strony] Twojego dziecka (nawiasy kwadratowe = akcent).',
				),
				array(
					'key'   => 'field_hero_lead',
					'label' => 'Tekst wprowadzający (lead)',
					'name'  => 'hero_lead',
					'type'  => 'textarea',
					'rows'  => 3,
				),
				array(
					'key'   => 'field_hero_cta_label',
					'label' => 'Przycisk główny — tekst',
					'name'  => 'hero_cta_label',
					'type'  => 'text',
					'placeholder' => 'Zapisz dziecko',
				),
			),
			'location' => array(
				array(
					array(
						'param'    => 'page_type',
						'operator' => '==',
						'value'    => 'front_page',
					),
				),
			),
			'menu_order' => 0,
			'position'   => 'acf_after_title',
		)
	);

	/* ---------------------------------------------------------------
	 * GRUPA 2: Nagłówek podstrony (page-hero) — dla zwykłych stron
	 * --------------------------------------------------------------- */
	acf_add_local_field_group(
		array(
			'key'    => 'group_dworek_page_hero',
			'title'  => 'Nagłówek podstrony',
			'fields' => array(
				array(
					'key'   => 'field_page_eyebrow',
					'label' => 'Nadtytuł (mały tekst)',
					'name'  => 'page_eyebrow',
					'type'  => 'text',
				),
				array(
					'key'          => 'field_page_hero_title',
					'label'        => 'Nagłówek (H1) — opcjonalnie',
					'name'         => 'page_hero_title',
					'type'         => 'text',
					'instructions' => 'Zostaw puste, aby użyć tytułu strony.',
				),
				array(
					'key'   => 'field_page_hero_lead',
					'label' => 'Tekst pod nagłówkiem',
					'name'  => 'page_hero_lead',
					'type'  => 'textarea',
					'rows'  => 2,
				),
			),
			'location' => array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'page',
					),
					array(
						'param'    => 'page_type',
						'operator' => '!=',
						'value'    => 'front_page',
					),
				),
			),
			'menu_order' => 0,
			'position'   => 'acf_after_title',
		)
	);

	/* ---------------------------------------------------------------
	 * GRUPA 3: „O nas" — pełna treść strony (edytowalna z panelu)
	 * Lokalizacja: strona o uchwycie (slug) „o-nas".
	 * --------------------------------------------------------------- */
	acf_add_local_field_group(
		array(
			'key'    => 'group_dworek_o_nas',
			'title'  => 'O nas — treść strony',
			'fields' => array(

				/* — Zakładka: Nasza historia — */
				array( 'key' => 'tab_on_history', 'label' => 'Nasza historia', 'type' => 'tab', 'placement' => 'top' ),
				array(
					'key' => 'field_on_history_title', 'label' => 'Nagłówek sekcji', 'name' => 'on_history_title', 'type' => 'text',
					'default_value' => 'Od 2003 roku odkrywamy mocne strony dzieci',
				),
				array(
					'key' => 'field_on_history_body', 'label' => 'Treść (akapity)', 'name' => 'on_history_body', 'type' => 'wysiwyg',
					'tabs' => 'visual', 'media_upload' => 0, 'toolbar' => 'basic',
					'default_value' => '<p>„Czarodziejski Dworek” to wyjątkowe przedszkole, w którym odkryte i docenione zostaną mocne strony Twojego dziecka. Działamy od września 2003 roku (ewidencja przedszkoli niepublicznych nr 111/PN).</p><p>Naszym celem jest dbanie o wszechstronny rozwój każdego dziecka i zaszczepienie w nim twórczych pasji — w kameralnych grupach, blisko każdego malucha. Godziny pracy dostosowujemy do potrzeb rodziców: pracujemy od 7.00 do 18.00.</p>',
				),

				/* — Zakładka: Misja i wartości — */
				array( 'key' => 'tab_on_mission', 'label' => 'Misja i wartości', 'type' => 'tab', 'placement' => 'top' ),
				array(
					'key' => 'field_on_mission_title', 'label' => 'Nagłówek', 'name' => 'on_mission_title', 'type' => 'text',
					'default_value' => 'Każda zabawa jest nauką, a każda nauka — zabawą',
				),
				array(
					'key' => 'field_on_mission_lead', 'label' => 'Tekst wprowadzający', 'name' => 'on_mission_lead', 'type' => 'textarea', 'rows' => 3,
					'default_value' => 'Chcemy, by w „Czarodziejskim Dworku” odkryte i docenione zostały mocne strony Twojego dziecka. Dbamy o jego wszechstronny rozwój i zaszczepiamy w nim twórcze pasje — w atmosferze akceptacji, blisko każdego malucha.',
				),
				array( 'key' => 'field_on_val1_t', 'label' => 'Karta 1 — tytuł', 'name' => 'on_val1_t', 'type' => 'text', 'default_value' => 'Akceptacja' ),
				array( 'key' => 'field_on_val1_d', 'label' => 'Karta 1 — opis', 'name' => 'on_val1_d', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Każde dziecko przyjmujemy takim, jakie jest — w cieple, życzliwości i poczuciu bezpieczeństwa.' ),
				array( 'key' => 'field_on_val2_t', 'label' => 'Karta 2 — tytuł', 'name' => 'on_val2_t', 'type' => 'text', 'default_value' => 'Edukacja przez zabawę' ),
				array( 'key' => 'field_on_val2_d', 'label' => 'Karta 2 — opis', 'name' => 'on_val2_d', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Język, muzyka i twórcze zajęcia dopasowane do wieku i możliwości każdego dziecka.' ),
				array( 'key' => 'field_on_val3_t', 'label' => 'Karta 3 — tytuł', 'name' => 'on_val3_t', 'type' => 'text', 'default_value' => 'Twórcze pasje' ),
				array( 'key' => 'field_on_val3_d', 'label' => 'Karta 3 — opis', 'name' => 'on_val3_d', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Zaszczepiamy ciekawość świata i rozwijamy mocne strony — tak, by dziecko wierzyło w siebie.' ),
				array( 'key' => 'field_on_val4_t', 'label' => 'Karta 4 — tytuł', 'name' => 'on_val4_t', 'type' => 'text', 'default_value' => 'Współpraca z rodzicami' ),
				array( 'key' => 'field_on_val4_d', 'label' => 'Karta 4 — opis', 'name' => 'on_val4_d', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Bliski kontakt, konsultacje i szkolenia dla rodziców — działamy razem dla dobra dziecka.' ),

				/* — Zakładka: Podejście do dzieci — */
				array( 'key' => 'tab_on_approach', 'label' => 'Podejście do dzieci', 'type' => 'tab', 'placement' => 'top' ),
				array( 'key' => 'field_on_approach_title', 'label' => 'Nagłówek', 'name' => 'on_approach_title', 'type' => 'text', 'default_value' => 'Uczymy przez zabawę, język i muzykę' ),
				array( 'key' => 'field_on_approach_p', 'label' => 'Akapit', 'name' => 'on_approach_p', 'type' => 'textarea', 'rows' => 3, 'default_value' => 'Dzień w przedszkolu to naturalny kontakt z językiem obcym i muzyką, twórcze zabawy i ruch. Nie pospieszamy — wspieramy dziecko w jego własnym tempie i budujemy w nim wiarę we własne możliwości.' ),
				array( 'key' => 'field_on_approach_list', 'label' => 'Lista punktów', 'name' => 'on_approach_list', 'type' => 'textarea', 'rows' => 4, 'instructions' => 'Każda linia = jeden punkt z „✓".', 'default_value' => "Codzienny kontakt z angielskim i francuskim w naturalnej formie\nMuzyka, rytmika i ruch jako część każdego dnia\nRozwijanie mocnych stron, ciekawości i samodzielności" ),

				/* — Zakładka: Indywidualne podejście — */
				array( 'key' => 'tab_on_indiv', 'label' => 'Indywidualne podejście', 'type' => 'tab', 'placement' => 'top' ),
				array( 'key' => 'field_on_indiv_title', 'label' => 'Nagłówek', 'name' => 'on_indiv_title', 'type' => 'text', 'default_value' => 'Każde dziecko widziane z osobna' ),
				array( 'key' => 'field_on_indiv_lead', 'label' => 'Tekst wprowadzający', 'name' => 'on_indiv_lead', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Kameralne grupy i specjaliści na miejscu pozwalają nam naprawdę poznać każde dziecko i dopasować wsparcie do jego potrzeb.' ),
				array( 'key' => 'field_on_ind1_t', 'label' => 'Karta 1 — tytuł', 'name' => 'on_ind1_t', 'type' => 'text', 'default_value' => 'Małe grupy' ),
				array( 'key' => 'field_on_ind1_d', 'label' => 'Karta 1 — opis', 'name' => 'on_ind1_d', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Maksymalnie 14 dzieci i 2 nauczycieli w grupie — więcej uwagi i czasu dla każdego malucha.' ),
				array( 'key' => 'field_on_ind2_t', 'label' => 'Karta 2 — tytuł', 'name' => 'on_ind2_t', 'type' => 'text', 'default_value' => 'Specjaliści na miejscu' ),
				array( 'key' => 'field_on_ind2_d', 'label' => 'Karta 2 — opis', 'name' => 'on_ind2_d', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Logopeda, psycholog, terapeuci SI i pedagodzy w jednym miejscu — diagnoza i pomoc bez szukania jej poza przedszkolem.' ),
				array( 'key' => 'field_on_ind3_t', 'label' => 'Karta 3 — tytuł', 'name' => 'on_ind3_t', 'type' => 'text', 'default_value' => 'Wsparcie szyte na miarę' ),
				array( 'key' => 'field_on_ind3_d', 'label' => 'Karta 3 — opis', 'name' => 'on_ind3_d', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Dostosowujemy tempo i formę zajęć, a dzieci z opinią obejmujemy bezpłatnym wczesnym wspomaganiem rozwoju (WWR).' ),

				/* — Zakładka: Atmosfera — */
				array( 'key' => 'tab_on_atmos', 'label' => 'Atmosfera', 'type' => 'tab', 'placement' => 'top' ),
				array( 'key' => 'field_on_atmos_title', 'label' => 'Nagłówek', 'name' => 'on_atmos_title', 'type' => 'text', 'default_value' => 'Ciepło domu, przestrzeń do rozwoju' ),
				array( 'key' => 'field_on_atmos_p', 'label' => 'Akapit', 'name' => 'on_atmos_p', 'type' => 'textarea', 'rows' => 3, 'default_value' => 'Stawiamy na rodzinną, życzliwą atmosferę, w której dziecko czuje się akceptowane i bezpieczne. Przestronne, kolorowe sale i własny ogród dają miejsce do zabawy, odpoczynku i odkrywania świata.' ),
				array( 'key' => 'field_on_atmos_list', 'label' => 'Lista punktów', 'name' => 'on_atmos_list', 'type' => 'textarea', 'rows' => 5, 'instructions' => 'Każda linia = jeden punkt z „✓".', 'default_value' => "Rodzinna, kameralna atmosfera\nPrzestronne, jasne i kolorowe sale\nZdrowe posiłki uwzględniające różne diety\nDuży, ogrodzony plac zabaw i ogród" ),

				/* — Zakładka: Bezpieczeństwo — */
				array( 'key' => 'tab_on_safety', 'label' => 'Bezpieczeństwo', 'type' => 'tab', 'placement' => 'top' ),
				array( 'key' => 'field_on_safety_title', 'label' => 'Nagłówek', 'name' => 'on_safety_title', 'type' => 'text', 'default_value' => 'Spokój rodzica, bezpieczeństwo dziecka' ),
				array( 'key' => 'field_on_safety_lead', 'label' => 'Tekst wprowadzający', 'name' => 'on_safety_lead', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Dbamy o bezpieczeństwo na każdym kroku — od ogrodzonego terenu po stałą, uważną opiekę.' ),
				array( 'key' => 'field_on_saf1_t', 'label' => 'Karta 1 — tytuł', 'name' => 'on_saf1_t', 'type' => 'text', 'default_value' => 'Ogrodzony, bezpieczny teren' ),
				array( 'key' => 'field_on_saf1_d', 'label' => 'Karta 1 — opis', 'name' => 'on_saf1_d', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Zamknięty plac zabaw i własny parking — dzieci bawią się na bezpiecznym, dozorowanym terenie.' ),
				array( 'key' => 'field_on_saf2_t', 'label' => 'Karta 2 — tytuł', 'name' => 'on_saf2_t', 'type' => 'text', 'default_value' => 'Stała, uważna opieka' ),
				array( 'key' => 'field_on_saf2_d', 'label' => 'Karta 2 — opis', 'name' => 'on_saf2_d', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Dwóch nauczycieli w kameralnej grupie czuwa nad każdym dzieckiem przez cały dzień.' ),
				array( 'key' => 'field_on_saf3_t', 'label' => 'Karta 3 — tytuł', 'name' => 'on_saf3_t', 'type' => 'text', 'default_value' => 'Zdrowe posiłki' ),
				array( 'key' => 'field_on_saf3_d', 'label' => 'Karta 3 — opis', 'name' => 'on_saf3_d', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Świeże, zbilansowane jedzenie uwzględniające diety i alergie naszych podopiecznych.' ),

				/* — Zakładka: Statystyki (pasek liczb) — */
				array( 'key' => 'tab_on_stats', 'label' => 'Statystyki', 'type' => 'tab', 'placement' => 'top' ),
				array( 'key' => 'field_on_stat1_num', 'label' => 'Liczba 1 — wartość', 'name' => 'on_stat1_num', 'type' => 'text', 'default_value' => '20', 'wrapper' => array( 'width' => '25' ) ),
				array( 'key' => 'field_on_stat1_sfx', 'label' => 'Liczba 1 — znak (np. +)', 'name' => 'on_stat1_sfx', 'type' => 'text', 'default_value' => '+', 'wrapper' => array( 'width' => '25' ) ),
				array( 'key' => 'field_on_stat1_lbl', 'label' => 'Liczba 1 — opis', 'name' => 'on_stat1_lbl', 'type' => 'text', 'default_value' => 'lat doświadczenia (od 2003)', 'wrapper' => array( 'width' => '50' ) ),
				array( 'key' => 'field_on_stat2_num', 'label' => 'Liczba 2 — wartość', 'name' => 'on_stat2_num', 'type' => 'text', 'default_value' => '14', 'wrapper' => array( 'width' => '50' ) ),
				array( 'key' => 'field_on_stat2_lbl', 'label' => 'Liczba 2 — opis', 'name' => 'on_stat2_lbl', 'type' => 'text', 'default_value' => 'dzieci maks. w grupie', 'wrapper' => array( 'width' => '50' ) ),
				array( 'key' => 'field_on_stat3_num', 'label' => 'Liczba 3 — wartość', 'name' => 'on_stat3_num', 'type' => 'text', 'default_value' => '2', 'wrapper' => array( 'width' => '50' ) ),
				array( 'key' => 'field_on_stat3_lbl', 'label' => 'Liczba 3 — opis', 'name' => 'on_stat3_lbl', 'type' => 'text', 'default_value' => 'nauczycieli w grupie', 'wrapper' => array( 'width' => '50' ) ),
				array( 'key' => 'field_on_stat4_val', 'label' => 'Liczba 4 — wartość (tekst)', 'name' => 'on_stat4_val', 'type' => 'text', 'default_value' => '7–18', 'wrapper' => array( 'width' => '50' ) ),
				array( 'key' => 'field_on_stat4_lbl', 'label' => 'Liczba 4 — opis', 'name' => 'on_stat4_lbl', 'type' => 'text', 'default_value' => 'godziny pracy', 'wrapper' => array( 'width' => '50' ) ),

				/* — Zakładka: Atuty + CTA — */
				array( 'key' => 'tab_on_atuty', 'label' => 'Atuty i zakończenie', 'type' => 'tab', 'placement' => 'top' ),
				array( 'key' => 'field_on_atuty_title', 'label' => 'Nagłówek „atuty"', 'name' => 'on_atuty_title', 'type' => 'text', 'default_value' => 'Co wyróżnia nasze przedszkole' ),
				array( 'key' => 'field_on_atuty_list', 'label' => 'Lista atutów', 'name' => 'on_atuty_list', 'type' => 'textarea', 'rows' => 6, 'instructions' => 'Każda linia = jeden punkt z „✓".', 'default_value' => "Kameralne grupy: maks. 14 dzieci i 2 nauczycieli\nBezpłatne zajęcia: terapie, języki, nauka pływania i warsztaty\nSpecjaliści i diagnoza na miejscu — bez szukania pomocy poza przedszkolem\nDuży, ogrodzony plac zabaw i własny parking\nZdrowe posiłki uwzględniające różne diety" ),
				array( 'key' => 'field_on_atuty_btn', 'label' => 'Przycisk (tekst)', 'name' => 'on_atuty_btn', 'type' => 'text', 'default_value' => 'Zobacz ofertę' ),
				array( 'key' => 'field_on_cta_title', 'label' => 'Sekcja końcowa — nagłówek', 'name' => 'on_cta_title', 'type' => 'text', 'default_value' => 'Chcesz zobaczyć nas na żywo?' ),
				array( 'key' => 'field_on_cta_text', 'label' => 'Sekcja końcowa — tekst', 'name' => 'on_cta_text', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Zapraszamy na spotkanie i zwiedzanie przedszkola — bez zobowiązań. Pokażemy sale, ogród i opowiemy o naszym programie.' ),
				array( 'key' => 'field_on_cta_btn1', 'label' => 'Przycisk 1 (tekst)', 'name' => 'on_cta_btn1', 'type' => 'text', 'default_value' => 'Umów spotkanie' ),
				array( 'key' => 'field_on_cta_btn2', 'label' => 'Przycisk 2 (tekst)', 'name' => 'on_cta_btn2', 'type' => 'text', 'default_value' => 'Poznaj kadrę' ),
			),
			'location' => array(
				array(
					array(
						'param'    => 'page_slug',
						'operator' => '==',
						'value'    => 'o-nas',
					),
				),
			),
			'menu_order' => 0,
			'position'   => 'normal',
			'style'      => 'default',
		)
	);

	/* ---------------------------------------------------------------
	 * GRUPA 4: „Program" (oferta) — pełna treść strony
	 * Lokalizacja: strona o uchwycie (slug) „oferta".
	 * --------------------------------------------------------------- */
	acf_add_local_field_group(
		array(
			'key'    => 'group_dworek_oferta',
			'title'  => 'Program — treść strony',
			'fields' => array(

				/* — Zakładka: Program edukacyjny — */
				array( 'key' => 'tab_pr_edu', 'label' => 'Program edukacyjny', 'type' => 'tab', 'placement' => 'top' ),
				array( 'key' => 'field_pr_edu_title', 'label' => 'Nagłówek', 'name' => 'pr_edu_title', 'type' => 'text', 'default_value' => 'Uczymy wg programu „Zanim będę uczniem”' ),
				array( 'key' => 'field_pr_edu_body', 'label' => 'Treść (akapity)', 'name' => 'pr_edu_body', 'type' => 'wysiwyg', 'tabs' => 'visual', 'media_upload' => 0, 'toolbar' => 'basic',
					'default_value' => '<p>We wszystkich grupach realizujemy podstawę programową MEN w oparciu o program wychowania przedszkolnego „Zanim będę uczniem” — wspierający indywidualny rozwój dziecka zgodnie z jego możliwościami. Stawiamy na nowatorskie metody, podmiotowe traktowanie dziecka i działanie jako podstawę rozwoju.</p><p>Nauczycielki odwołują się do dziecięcych przeżyć, doświadczeń i zainteresowań — dzięki temu dzieci są aktywne, twórcze i chętnie uczestniczą w zajęciach. Zajęcia plastyczne są integralną częścią dnia: dzieci poznają różnorodne techniki i mają nieograniczony dostęp do materiałów, co rozwija ich twórczość i wyobraźnię.</p>' ),

				/* — Zakładka: Zajęcia (akordeon) — */
				array( 'key' => 'tab_pr_zaj', 'label' => 'Zajęcia (akordeon)', 'type' => 'tab', 'placement' => 'top' ),
				array( 'key' => 'field_pr_zaj_title', 'label' => 'Nagłówek sekcji', 'name' => 'pr_zaj_title', 'type' => 'text', 'default_value' => 'Poznaj nasze zajęcia' ),
				array( 'key' => 'field_pr_zaj_lead', 'label' => 'Tekst pod nagłówkiem', 'name' => 'pr_zaj_lead', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Basen, język angielski i francuski oraz muzyka są w cenie czesnego.' ),

				array( 'key' => 'field_pr_acc1_t', 'label' => '1. Tytuł', 'name' => 'pr_acc1_t', 'type' => 'text', 'default_value' => 'Język angielski', 'wrapper' => array( 'width' => '50' ) ),
				array( 'key' => 'field_pr_acc1_m', 'label' => '1. Podpis (mały)', 'name' => 'pr_acc1_m', 'type' => 'text', 'default_value' => 'W czesnym · 4× w tygodniu', 'wrapper' => array( 'width' => '50' ) ),
				array( 'key' => 'field_pr_acc1_b', 'label' => '1. Treść', 'name' => 'pr_acc1_b', 'type' => 'wysiwyg', 'tabs' => 'visual', 'media_upload' => 0, 'toolbar' => 'basic',
					'default_value' => '<p>Zajęcia odbywają się cztery razy w tygodniu dla każdej grupy wiekowej. Ich głównym celem jest zapewnienie dzieciom środowiska, w którym osłuchują się z modelowym językiem angielskim i przyswajają jak najwięcej mowy. Kluczowa jest wspólna zabawa prowadzona przez instruktora — dzięki niej dzieci wiążą naukę z przyjemnością.</p><p>Materiały dobieramy indywidualnie, a zajęcia respektują autonomię dziecka i tzw. silent period. Maluchy poznają piosenki, rymowanki i gry, słuchają opowieści i bajek, a nowe słownictwo wspieramy materiałami wizualnymi. Dzieci angażują się w gry i dramy metodą Total Physical Response, co wspiera motorykę i koordynację — przy okazji zdobywają wiedzę z zakresu sztuki, matematyki i przyrody oraz uczą się otwartości i tolerancji wobec innych języków i kultur.</p>' ),

				array( 'key' => 'field_pr_acc2_t', 'label' => '2. Tytuł', 'name' => 'pr_acc2_t', 'type' => 'text', 'default_value' => 'Język francuski', 'wrapper' => array( 'width' => '50' ) ),
				array( 'key' => 'field_pr_acc2_m', 'label' => '2. Podpis (mały)', 'name' => 'pr_acc2_m', 'type' => 'text', 'default_value' => 'W czesnym · od 4 lat · 2× w tygodniu', 'wrapper' => array( 'width' => '50' ) ),
				array( 'key' => 'field_pr_acc2_b', 'label' => '2. Treść', 'name' => 'pr_acc2_b', 'type' => 'wysiwyg', 'tabs' => 'visual', 'media_upload' => 0, 'toolbar' => 'basic',
					'default_value' => '<p>Poznawanie języka obcego od najmłodszych lat kształtuje u dziecka szerokie i świadome spojrzenie na świat. Dzieci przyswajają język naturalnie, zanim język ojczysty stanie się punktem odniesienia — a edukacja ma charakter zabawy.</p><p>Zajęcia z francuskiego skierowane są do dzieci od 4. roku życia i odbywają się 2 razy w tygodniu. Wykorzystujemy metodę bezpośrednią: gry, melodyjki, ćwiczenia ruchowe oraz zajęcia plastyczne utrwalające przyswajane treści.</p>' ),

				array( 'key' => 'field_pr_acc3_t', 'label' => '3. Tytuł', 'name' => 'pr_acc3_t', 'type' => 'text', 'default_value' => 'Zajęcia muzyczne', 'wrapper' => array( 'width' => '50' ) ),
				array( 'key' => 'field_pr_acc3_m', 'label' => '3. Podpis (mały)', 'name' => 'pr_acc3_m', 'type' => 'text', 'default_value' => 'W czesnym · 3× w tygodniu', 'wrapper' => array( 'width' => '50' ) ),
				array( 'key' => 'field_pr_acc3_b', 'label' => '3. Treść', 'name' => 'pr_acc3_b', 'type' => 'wysiwyg', 'tabs' => 'visual', 'media_upload' => 0, 'toolbar' => 'basic',
					'default_value' => '<p>Słuchanie muzyki, a zwłaszcza gra na instrumentach, uczy systematyczności, koncentracji i osiągania celu. Muzyka jest źródłem przyjemności — rozwija ekspresję dziecka, pozwala wyrażać emocje i wrażliwość, a przez to tworzyć, rozwijać wyobraźnię i kreatywność. Wiek przedszkolny to optymalny czas na edukację muzyczną: każde dziecko ma naturalną skłonność do muzyki, śpiewu, gry i tańca.</p><p>W programie jest też taniec animacyjny (specjalność Stowarzyszenia KLANZA) — zabawy łączące rytm, muzykę i śpiew, które służą relaksacji i integracji grupy. Zajęcia muzyczne odbywają się trzy razy w tygodniu; dostępne są również sobotnie sesje dla dzieci i rodziców.</p>' ),

				array( 'key' => 'field_pr_acc4_t', 'label' => '4. Tytuł', 'name' => 'pr_acc4_t', 'type' => 'text', 'default_value' => 'Basen — nauka pływania', 'wrapper' => array( 'width' => '50' ) ),
				array( 'key' => 'field_pr_acc4_m', 'label' => '4. Podpis (mały)', 'name' => 'pr_acc4_m', 'type' => 'text', 'default_value' => 'W czesnym · od 5 lat', 'wrapper' => array( 'width' => '50' ) ),
				array( 'key' => 'field_pr_acc4_b', 'label' => '4. Treść', 'name' => 'pr_acc4_b', 'type' => 'wysiwyg', 'tabs' => 'visual', 'media_upload' => 0, 'toolbar' => 'basic',
					'default_value' => '<p>Co roku organizujemy zajęcia nauki pływania dla dzieci od 5. roku życia. Cieszą się ogromnym zainteresowaniem — dzieci uwielbiają wodę i z radością pluskają się w basenie. To jednak nie tylko zabawa: maluch hartuje się, oswaja z wodą, a nawet uczy pływać.</p><p>Pływanie to znakomita gimnastyka — wzmacnia wszystkie mięśnie, zapobiega wadom postawy oraz zwiększa wydolność układu oddechowego i krążenia. Dzieci nabierają pewności siebie i lepiej radzą sobie w nietypowych sytuacjach.</p>' ),

				array( 'key' => 'field_pr_acc5_t', 'label' => '5. Tytuł', 'name' => 'pr_acc5_t', 'type' => 'text', 'default_value' => 'Gimnastyka korekcyjna', 'wrapper' => array( 'width' => '50' ) ),
				array( 'key' => 'field_pr_acc5_m', 'label' => '5. Podpis (mały)', 'name' => 'pr_acc5_m', 'type' => 'text', 'default_value' => 'Wszystkie grupy wiekowe', 'wrapper' => array( 'width' => '50' ) ),
				array( 'key' => 'field_pr_acc5_b', 'label' => '5. Treść', 'name' => 'pr_acc5_b', 'type' => 'wysiwyg', 'tabs' => 'visual', 'media_upload' => 0, 'toolbar' => 'basic',
					'default_value' => '<p>Sprawność fizyczna jest dla nas równie ważna co rozwój intelektualny, dlatego od najmłodszych lat zachęcamy dzieci do aktywności i tworzymy warunki do harmonijnego rozwoju. Prowadzimy gimnastykę korekcyjną dla wszystkich grup wiekowych.</p><p>U najmłodszych (2,5–3 lata) skupiamy się na świadomości własnego ciała, wzmacnianiu mięśni i zachęcaniu do ruchu poprzez zabawy z przyborami (woreczki, laski gimnastyczne, piłki, tunel, walec, kołyska i inne). Starszym dzieciom proponujemy program profilaktyczny: kształtujemy nawyk prawidłowej postawy, wzmacniamy i rozciągamy mięśnie. W najstarszych grupach uczymy zasad fair play — przygotowujemy zarówno do wygrywania, jak i do radzenia sobie z porażką.</p>' ),

				array( 'key' => 'field_pr_acc6_t', 'label' => '6. Tytuł', 'name' => 'pr_acc6_t', 'type' => 'text', 'default_value' => 'Joga i zajęcia taneczne', 'wrapper' => array( 'width' => '50' ) ),
				array( 'key' => 'field_pr_acc6_m', 'label' => '6. Podpis (mały)', 'name' => 'pr_acc6_m', 'type' => 'text', 'default_value' => 'Ruch, relaks i poczucie rytmu', 'wrapper' => array( 'width' => '50' ) ),
				array( 'key' => 'field_pr_acc6_b', 'label' => '6. Treść', 'name' => 'pr_acc6_b', 'type' => 'wysiwyg', 'tabs' => 'visual', 'media_upload' => 0, 'toolbar' => 'basic',
					'default_value' => '<p>Joga to spokojne ćwiczenia wspierające koncentrację, równowagę i relaks — uczą dzieci wyciszenia i świadomości własnego ciała.</p><p>Zajęcia taneczne prowadzi szkoła tańca PRO-DANCE. To radosna forma ruchu, która rozwija koordynację, poczucie rytmu i pewność siebie, a przy okazji świetnie integruje grupę.</p>' ),

				array( 'key' => 'field_pr_acc7_t', 'label' => '7. Tytuł', 'name' => 'pr_acc7_t', 'type' => 'text', 'default_value' => 'Warsztaty, wycieczki i „zielone noce”', 'wrapper' => array( 'width' => '50' ) ),
				array( 'key' => 'field_pr_acc7_m', 'label' => '7. Podpis (mały)', 'name' => 'pr_acc7_m', 'type' => 'text', 'default_value' => 'Wydarzenia poza codziennymi zajęciami', 'wrapper' => array( 'width' => '50' ) ),
				array( 'key' => 'field_pr_acc7_b', 'label' => '7. Treść', 'name' => 'pr_acc7_b', 'type' => 'wysiwyg', 'tabs' => 'visual', 'media_upload' => 0, 'toolbar' => 'basic',
					'default_value' => '<p>Poza codziennymi zajęciami organizujemy warsztaty edukacyjne, wycieczki oraz „zielone noce” — wyjątkowe wydarzenia, które integrują dzieci, rozbudzają ciekawość i poszerzają ich horyzonty. To chwile, które na długo zostają w pamięci najmłodszych.</p>' ),

				/* — Zakładka: Rozwój społeczny — */
				array( 'key' => 'tab_pr_soc', 'label' => 'Rozwój społeczny', 'type' => 'tab', 'placement' => 'top' ),
				array( 'key' => 'field_pr_soc_title', 'label' => 'Nagłówek', 'name' => 'pr_soc_title', 'type' => 'text', 'default_value' => 'Uczymy emocji i bycia razem' ),
				array( 'key' => 'field_pr_soc_lead', 'label' => 'Tekst wprowadzający', 'name' => 'pr_soc_lead', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Program wspiera nie tylko wiedzę, ale też relacje, emocje i umiejętność współpracy.' ),
				array( 'key' => 'field_pr_soc1_t', 'label' => 'Karta 1 — tytuł', 'name' => 'pr_soc1_t', 'type' => 'text', 'default_value' => 'Wyrażanie emocji' ),
				array( 'key' => 'field_pr_soc1_d', 'label' => 'Karta 1 — opis', 'name' => 'pr_soc1_d', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Muzyka pozwala dzieciom wyrażać emocje i wrażliwość oraz rozwijać ekspresję — w bezpieczny, twórczy sposób.' ),
				array( 'key' => 'field_pr_soc2_t', 'label' => 'Karta 2 — tytuł', 'name' => 'pr_soc2_t', 'type' => 'text', 'default_value' => 'Integracja grupy' ),
				array( 'key' => 'field_pr_soc2_d', 'label' => 'Karta 2 — opis', 'name' => 'pr_soc2_d', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Taniec animacyjny (metoda KLANZA) łączy ruch, rytm i śpiew — służy relaksacji i integracji całej grupy.' ),
				array( 'key' => 'field_pr_soc3_t', 'label' => 'Karta 3 — tytuł', 'name' => 'pr_soc3_t', 'type' => 'text', 'default_value' => 'Współpraca i fair play' ),
				array( 'key' => 'field_pr_soc3_d', 'label' => 'Karta 3 — opis', 'name' => 'pr_soc3_d', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Na zajęciach ruchowych dzieci uczą się zasad fair play — zarówno cieszenia się z wygranej, jak i radzenia sobie z porażką.' ),

				/* — Zakładka: Samodzielność — */
				array( 'key' => 'tab_pr_sam', 'label' => 'Samodzielność', 'type' => 'tab', 'placement' => 'top' ),
				array( 'key' => 'field_pr_sam_title', 'label' => 'Nagłówek', 'name' => 'pr_sam_title', 'type' => 'text', 'default_value' => 'Wspieramy samodzielność i twórczy rozwój' ),
				array( 'key' => 'field_pr_sam_lead', 'label' => 'Tekst wprowadzający', 'name' => 'pr_sam_lead', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Dziecko jest aktywnym twórcą swojego rozwoju — my dajemy mu przestrzeń i narzędzia.' ),
				array( 'key' => 'field_pr_sam1_t', 'label' => 'Karta 1 — tytuł', 'name' => 'pr_sam1_t', 'type' => 'text', 'default_value' => 'Własne tempo' ),
				array( 'key' => 'field_pr_sam1_d', 'label' => 'Karta 1 — opis', 'name' => 'pr_sam1_d', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Podmiotowe traktowanie dziecka i program dostosowany do jego możliwości budują samodzielność i wiarę we własne siły.' ),
				array( 'key' => 'field_pr_sam2_t', 'label' => 'Karta 2 — tytuł', 'name' => 'pr_sam2_t', 'type' => 'text', 'default_value' => 'Twórczość i wyobraźnia' ),
				array( 'key' => 'field_pr_sam2_d', 'label' => 'Karta 2 — opis', 'name' => 'pr_sam2_d', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Nieograniczony dostęp do materiałów plastycznych oraz muzyka rozwijają twórczość, wyobraźnię i kreatywność.' ),
				array( 'key' => 'field_pr_sam3_t', 'label' => 'Karta 3 — tytuł', 'name' => 'pr_sam3_t', 'type' => 'text', 'default_value' => 'Ciekawość świata' ),
				array( 'key' => 'field_pr_sam3_d', 'label' => 'Karta 3 — opis', 'name' => 'pr_sam3_d', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Rozbudzamy ciekawość poznawczą — dzieci poznają sztukę, matematykę i przyrodę, także podczas zajęć językowych.' ),

				/* — Zakładka: Zakończenie (CTA) — */
				array( 'key' => 'tab_pr_cta', 'label' => 'Zakończenie', 'type' => 'tab', 'placement' => 'top' ),
				array( 'key' => 'field_pr_cta_title', 'label' => 'Nagłówek', 'name' => 'pr_cta_title', 'type' => 'text', 'default_value' => 'Chcesz poznać szczegóły i zapisać dziecko?' ),
				array( 'key' => 'field_pr_cta_text', 'label' => 'Tekst', 'name' => 'pr_cta_text', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Skontaktuj się z nami — opowiemy o programie, dostępnych grupach i warunkach zapisu, a także zaprosimy na zwiedzanie przedszkola. Wizyta jest bezpłatna i bez zobowiązań.' ),
				array( 'key' => 'field_pr_cta_btn1', 'label' => 'Przycisk 1 (tekst)', 'name' => 'pr_cta_btn1', 'type' => 'text', 'default_value' => 'Zapytaj o zapisy' ),
				array( 'key' => 'field_pr_cta_btn2', 'label' => 'Przycisk 2 (tekst)', 'name' => 'pr_cta_btn2', 'type' => 'text', 'default_value' => 'WWR i terapia' ),
			),
			'location' => array(
				array(
					array( 'param' => 'page_slug', 'operator' => '==', 'value' => 'oferta' ),
				),
			),
			'menu_order' => 0,
			'position'   => 'normal',
			'style'      => 'default',
		)
	);

	/* ---------------------------------------------------------------
	 * GRUPA 5: „WWR i terapia" (wsparcie) — pełna treść strony
	 * Lokalizacja: strona o uchwycie (slug) „wsparcie".
	 * --------------------------------------------------------------- */
	acf_add_local_field_group(
		array(
			'key'    => 'group_dworek_wsparcie',
			'title'  => 'WWR i terapia — treść strony',
			'fields' => array(

				/* — Zakładka: WWR (opis) — */
				array( 'key' => 'tab_ws_wwr', 'label' => 'WWR (opis)', 'type' => 'tab', 'placement' => 'top' ),
				array( 'key' => 'field_ws_wwr_title', 'label' => 'Nagłówek', 'name' => 'ws_wwr_title', 'type' => 'text', 'default_value' => 'Wczesne wspomaganie rozwoju' ),
				array( 'key' => 'field_ws_wwr_body', 'label' => 'Treść (akapity)', 'name' => 'ws_wwr_body', 'type' => 'wysiwyg', 'tabs' => 'visual', 'media_upload' => 0, 'toolbar' => 'basic',
					'default_value' => '<p>Wczesne wspomaganie rozwoju (WWR) to <strong>bezpłatne, zindywidualizowane zajęcia</strong> dla dzieci, które posiadają <strong>opinię o potrzebie wczesnego wspomagania rozwoju</strong>. Ich celem jest jak najwcześniejsze, kompleksowe wspieranie rozwoju malucha — w mowie, ruchu, emocjach i kontaktach z rówieśnikami.</p><p>Zajęcia prowadzi nasz zespół specjalistów na terenie przedszkola, w znanym i bezpiecznym dla dziecka otoczeniu, a ich zakres dobieramy do indywidualnych potrzeb.</p>' ),
				array( 'key' => 'field_ws_wwr_list', 'label' => 'Lista punktów', 'name' => 'ws_wwr_list', 'type' => 'textarea', 'rows' => 4, 'instructions' => 'Każda linia = jeden punkt z „✓".', 'default_value' => "Całkowicie bezpłatne dla rodziców\nDla dzieci z opinią o potrzebie WWR\nProwadzone przez zespół specjalistów\nPlan dopasowany do potrzeb dziecka" ),
				array( 'key' => 'field_ws_wwr_btn', 'label' => 'Przycisk (tekst)', 'name' => 'ws_wwr_btn', 'type' => 'text', 'default_value' => 'Zapytaj o WWR' ),

				/* — Zakładka: Komu pomagamy — */
				array( 'key' => 'tab_ws_komu', 'label' => 'Komu pomagamy', 'type' => 'tab', 'placement' => 'top' ),
				array( 'key' => 'field_ws_komu_title', 'label' => 'Nagłówek', 'name' => 'ws_komu_title', 'type' => 'text', 'default_value' => 'Komu pomagamy' ),
				array( 'key' => 'field_ws_komu_lead', 'label' => 'Tekst wprowadzający', 'name' => 'ws_komu_lead', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Zapraszamy, jeśli chcesz wesprzeć rozwój dziecka lub obserwujesz u niego trudności w którymś z poniższych obszarów. Pierwszym krokiem zawsze jest spokojna rozmowa i obserwacja.' ),
				array( 'key' => 'field_ws_komu1_t', 'label' => 'Karta 1 — tytuł', 'name' => 'ws_komu1_t', 'type' => 'text', 'default_value' => 'Dzieci z opinią o potrzebie WWR' ),
				array( 'key' => 'field_ws_komu1_d', 'label' => 'Karta 1 — opis', 'name' => 'ws_komu1_d', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Realizujemy bezpłatne wczesne wspomaganie rozwoju dla dzieci posiadających opinię z poradni.' ),
				array( 'key' => 'field_ws_komu2_t', 'label' => 'Karta 2 — tytuł', 'name' => 'ws_komu2_t', 'type' => 'text', 'default_value' => 'Rozwój mowy i komunikacji' ),
				array( 'key' => 'field_ws_komu2_d', 'label' => 'Karta 2 — opis', 'name' => 'ws_komu2_d', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Opóźniona lub niewyraźna mowa, trudności z porozumiewaniem się i wymową.' ),
				array( 'key' => 'field_ws_komu3_t', 'label' => 'Karta 3 — tytuł', 'name' => 'ws_komu3_t', 'type' => 'text', 'default_value' => 'Emocje i relacje' ),
				array( 'key' => 'field_ws_komu3_d', 'label' => 'Karta 3 — opis', 'name' => 'ws_komu3_d', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Wsparcie w wyrażaniu emocji, budowaniu relacji z rówieśnikami i radzeniu sobie w grupie.' ),
				array( 'key' => 'field_ws_komu4_t', 'label' => 'Karta 4 — tytuł', 'name' => 'ws_komu4_t', 'type' => 'text', 'default_value' => 'Przetwarzanie sensoryczne' ),
				array( 'key' => 'field_ws_komu4_d', 'label' => 'Karta 4 — opis', 'name' => 'ws_komu4_d', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Nadmierna lub obniżona wrażliwość na bodźce, trudności z koncentracją i równowagą.' ),
				array( 'key' => 'field_ws_komu5_t', 'label' => 'Karta 5 — tytuł', 'name' => 'ws_komu5_t', 'type' => 'text', 'default_value' => 'Rozwój ruchowy i postawa' ),
				array( 'key' => 'field_ws_komu5_d', 'label' => 'Karta 5 — opis', 'name' => 'ws_komu5_d', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Wsparcie prawidłowego rozwoju ruchowego, koordynacji oraz korekcja postawy.' ),
				array( 'key' => 'field_ws_komu6_t', 'label' => 'Karta 6 — tytuł', 'name' => 'ws_komu6_t', 'type' => 'text', 'default_value' => 'Koncentracja i gotowość szkolna' ),
				array( 'key' => 'field_ws_komu6_d', 'label' => 'Karta 6 — opis', 'name' => 'ws_komu6_d', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Wspieranie uwagi, samodzielności i pokonywania trudności w uczeniu się.' ),

				/* — Zakładka: Terapie — */
				array( 'key' => 'tab_ws_ter', 'label' => 'Terapie', 'type' => 'tab', 'placement' => 'top' ),
				array( 'key' => 'field_ws_ter_title', 'label' => 'Nagłówek', 'name' => 'ws_ter_title', 'type' => 'text', 'default_value' => 'Jakie terapie są dostępne' ),
				array( 'key' => 'field_ws_ter_lead', 'label' => 'Tekst wprowadzający', 'name' => 'ws_ter_lead', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Dzieci są pod opieką doświadczonych specjalistów bez wychodzenia z przedszkola — terapia odbywa się w znanym, bezpiecznym otoczeniu.' ),
				array( 'key' => 'field_ws_ter1_t', 'label' => 'Karta 1 — tytuł', 'name' => 'ws_ter1_t', 'type' => 'text', 'default_value' => 'Logopedia' ),
				array( 'key' => 'field_ws_ter1_d', 'label' => 'Karta 1 — opis', 'name' => 'ws_ter1_d', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Diagnoza i terapia mowy — wspieramy prawidłowy rozwój artykulacji, słuchu fonematycznego i komunikacji.' ),
				array( 'key' => 'field_ws_ter2_t', 'label' => 'Karta 2 — tytuł', 'name' => 'ws_ter2_t', 'type' => 'text', 'default_value' => 'Psycholog' ),
				array( 'key' => 'field_ws_ter2_d', 'label' => 'Karta 2 — opis', 'name' => 'ws_ter2_d', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Wsparcie emocjonalne i społeczne dziecka oraz konsultacje dla rodziców w codziennych wyzwaniach.' ),
				array( 'key' => 'field_ws_ter3_t', 'label' => 'Karta 3 — tytuł', 'name' => 'ws_ter3_t', 'type' => 'text', 'default_value' => 'Integracja sensoryczna (SI)' ),
				array( 'key' => 'field_ws_ter3_d', 'label' => 'Karta 3 — opis', 'name' => 'ws_ter3_d', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Terapia wspierająca przetwarzanie bodźców zmysłowych, koncentrację i równowagę.' ),
				array( 'key' => 'field_ws_ter4_t', 'label' => 'Karta 4 — tytuł', 'name' => 'ws_ter4_t', 'type' => 'text', 'default_value' => 'Fizjoterapia' ),
				array( 'key' => 'field_ws_ter4_d', 'label' => 'Karta 4 — opis', 'name' => 'ws_ter4_d', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Ćwiczenia korygujące postawę i wspierające prawidłowy rozwój ruchowy malucha.' ),
				array( 'key' => 'field_ws_ter5_t', 'label' => 'Karta 5 — tytuł', 'name' => 'ws_ter5_t', 'type' => 'text', 'default_value' => 'Terapia pedagogiczna' ),
				array( 'key' => 'field_ws_ter5_d', 'label' => 'Karta 5 — opis', 'name' => 'ws_ter5_d', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Wspieranie koncentracji, gotowości szkolnej oraz pokonywania trudności w uczeniu się.' ),
				array( 'key' => 'field_ws_ter6_t', 'label' => 'Karta 6 — tytuł', 'name' => 'ws_ter6_t', 'type' => 'text', 'default_value' => 'TUS' ),
				array( 'key' => 'field_ws_ter6_d', 'label' => 'Karta 6 — opis', 'name' => 'ws_ter6_d', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Trening umiejętności społecznych — nauka współpracy, rozpoznawania emocji i budowania relacji.' ),

				/* — Zakładka: Zespół i proces — */
				array( 'key' => 'tab_ws_proc', 'label' => 'Zespół i proces', 'type' => 'tab', 'placement' => 'top' ),
				array( 'key' => 'field_ws_team_title', 'label' => 'Zespół — nagłówek', 'name' => 'ws_team_title', 'type' => 'text', 'default_value' => 'Kto prowadzi zajęcia' ),
				array( 'key' => 'field_ws_team_lead', 'label' => 'Zespół — tekst', 'name' => 'ws_team_lead', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Terapie prowadzą doświadczeni specjaliści „Czarodziejskiego Dworku”. Poznaj osoby, które zajmą się rozwojem Twojego dziecka.' ),
				array( 'key' => 'field_ws_team_btn', 'label' => 'Zespół — przycisk', 'name' => 'ws_team_btn', 'type' => 'text', 'default_value' => 'Poznaj cały zespół specjalistów' ),
				array( 'key' => 'field_ws_proc_title', 'label' => 'Proces — nagłówek', 'name' => 'ws_proc_title', 'type' => 'text', 'default_value' => 'Jak wygląda proces kontaktu' ),
				array( 'key' => 'field_ws_proc_lead', 'label' => 'Proces — tekst', 'name' => 'ws_proc_lead', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Od pierwszego telefonu do regularnych zajęć — krok po kroku, spokojnie i z myślą o dziecku.' ),
				array( 'key' => 'field_ws_proc1_t', 'label' => 'Krok 1 — tytuł', 'name' => 'ws_proc1_t', 'type' => 'text', 'default_value' => 'Kontakt' ),
				array( 'key' => 'field_ws_proc1_d', 'label' => 'Krok 1 — opis', 'name' => 'ws_proc1_d', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Zadzwoń pod 690 629 501 lub wyślij formularz poniżej. Opisz krótko, czego potrzebuje Twoje dziecko.' ),
				array( 'key' => 'field_ws_proc2_t', 'label' => 'Krok 2 — tytuł', 'name' => 'ws_proc2_t', 'type' => 'text', 'default_value' => 'Rozmowa i obserwacja' ),
				array( 'key' => 'field_ws_proc2_d', 'label' => 'Krok 2 — opis', 'name' => 'ws_proc2_d', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Umawiamy spotkanie, poznajemy dziecko i jego potrzeby oraz rozmawiamy z rodzicami o oczekiwaniach.' ),
				array( 'key' => 'field_ws_proc3_t', 'label' => 'Krok 3 — tytuł', 'name' => 'ws_proc3_t', 'type' => 'text', 'default_value' => 'Indywidualny plan' ),
				array( 'key' => 'field_ws_proc3_d', 'label' => 'Krok 3 — opis', 'name' => 'ws_proc3_d', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Dobieramy odpowiednie terapie i specjalistów, tworząc plan dopasowany do możliwości dziecka.' ),
				array( 'key' => 'field_ws_proc4_t', 'label' => 'Krok 4 — tytuł', 'name' => 'ws_proc4_t', 'type' => 'text', 'default_value' => 'Regularne zajęcia' ),
				array( 'key' => 'field_ws_proc4_d', 'label' => 'Krok 4 — opis', 'name' => 'ws_proc4_d', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Prowadzimy terapię na miejscu, a postępy na bieżąco omawiamy z rodzicami podczas konsultacji.' ),

				/* — Zakładka: Adaptacja — */
				array( 'key' => 'tab_ws_adapt', 'label' => 'Adaptacja', 'type' => 'tab', 'placement' => 'top' ),
				array( 'key' => 'field_ws_adapt_title', 'label' => 'Adaptacja — nagłówek', 'name' => 'ws_adapt_title', 'type' => 'text', 'default_value' => 'Łagodna adaptacja — spokojny start w przedszkolu' ),
				array( 'key' => 'field_ws_adapt_body', 'label' => 'Adaptacja — treść', 'name' => 'ws_adapt_body', 'type' => 'wysiwyg', 'tabs' => 'visual', 'media_upload' => 0, 'toolbar' => 'basic',
					'default_value' => '<p>Dla przyszłych przedszkolaków organizujemy <strong>bezpłatne, sobotnie zajęcia adaptacyjne</strong>. To czas, by dziecko — razem z rodzicem — spokojnie poznało przedszkole, panie i nowych kolegów jeszcze przed rozpoczęciem roku.</p>' ),
				array( 'key' => 'field_ws_adapt_list', 'label' => 'Adaptacja — lista', 'name' => 'ws_adapt_list', 'type' => 'textarea', 'rows' => 4, 'instructions' => 'Każda linia = jeden punkt z „✓".', 'default_value' => "Bezpłatne spotkania w soboty\nDla najmłodszych, przyszłych przedszkolaków\nDziecko poznaje panie, salę i rówieśników\nŁagodne, stopniowe oswajanie bez pośpiechu" ),
				array( 'key' => 'field_ws_adapt_btn', 'label' => 'Adaptacja — przycisk', 'name' => 'ws_adapt_btn', 'type' => 'text', 'default_value' => 'Sprawdź terminy i zapisy' ),
				array( 'key' => 'field_ws_aj_title', 'label' => 'Jak wygląda — nagłówek', 'name' => 'ws_aj_title', 'type' => 'text', 'default_value' => 'Jak wygląda adaptacja' ),
				array( 'key' => 'field_ws_aj_lead', 'label' => 'Jak wygląda — tekst', 'name' => 'ws_aj_lead', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Bez pośpiechu i stresu — dziecko oswaja się z przedszkolem we własnym tempie, w obecności rodzica.' ),
				array( 'key' => 'field_ws_aj1_t', 'label' => 'Karta 1 — tytuł', 'name' => 'ws_aj1_t', 'type' => 'text', 'default_value' => 'Poznajemy przedszkole' ),
				array( 'key' => 'field_ws_aj1_d', 'label' => 'Karta 1 — opis', 'name' => 'ws_aj1_d', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Dziecko z rodzicem zwiedza sale i plac zabaw oraz poznaje panie — w przyjaznej, swobodnej atmosferze.' ),
				array( 'key' => 'field_ws_aj2_t', 'label' => 'Karta 2 — tytuł', 'name' => 'ws_aj2_t', 'type' => 'text', 'default_value' => 'Wspólna zabawa' ),
				array( 'key' => 'field_ws_aj2_d', 'label' => 'Karta 2 — opis', 'name' => 'ws_aj2_d', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Zabawy, piosenki i aktywności w małej grupie pomagają dziecku poczuć się pewnie wśród rówieśników.' ),
				array( 'key' => 'field_ws_aj3_t', 'label' => 'Karta 3 — tytuł', 'name' => 'ws_aj3_t', 'type' => 'text', 'default_value' => 'Stopniowe oswajanie' ),
				array( 'key' => 'field_ws_aj3_d', 'label' => 'Karta 3 — opis', 'name' => 'ws_aj3_d', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Krok po kroku, bez pośpiechu — pierwszy dzień w przedszkolu nie jest już dla dziecka niewiadomą.' ),

				/* — Zakładka: Razem z rodzicami — */
				array( 'key' => 'tab_ws_prep', 'label' => 'Razem z rodzicami', 'type' => 'tab', 'placement' => 'top' ),
				array( 'key' => 'field_ws_prep_title', 'label' => 'Nagłówek', 'name' => 'ws_prep_title', 'type' => 'text', 'default_value' => 'Przygotowanie i wsparcie' ),
				array( 'key' => 'field_ws_prep_lead', 'label' => 'Tekst wprowadzający', 'name' => 'ws_prep_lead', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Adaptacja to wspólna sprawa — podpowiadamy, jak przygotować dziecko, i jesteśmy obok rodziców na każdym kroku.' ),
				array( 'key' => 'field_ws_prep1_t', 'label' => 'Kolumna 1 — tytuł', 'name' => 'ws_prep1_t', 'type' => 'text', 'default_value' => 'Jak przygotować dziecko' ),
				array( 'key' => 'field_ws_prep1_list', 'label' => 'Kolumna 1 — lista', 'name' => 'ws_prep1_list', 'type' => 'textarea', 'rows' => 5, 'instructions' => 'Każda linia = jeden punkt z „✓".', 'default_value' => "Mów o przedszkolu pozytywnie — jako o miejscu zabawy i nowych przyjaciół.\nĆwiczcie samodzielność: jedzenie, ubieranie, korzystanie z toalety.\nTrzymajcie krótki, pogodny rytuał pożegnania.\nPozwól zabrać ulubioną przytulankę dla poczucia bezpieczeństwa.\nZadbaj o spokojny, wyspany poranek przed zajęciami." ),
				array( 'key' => 'field_ws_prep2_t', 'label' => 'Kolumna 2 — tytuł', 'name' => 'ws_prep2_t', 'type' => 'text', 'default_value' => 'Jak wspieramy rodziców' ),
				array( 'key' => 'field_ws_prep2_list', 'label' => 'Kolumna 2 — lista', 'name' => 'ws_prep2_list', 'type' => 'textarea', 'rows' => 4, 'instructions' => 'Każda linia = jeden punkt z „✓".', 'default_value' => "Konsultacje ze specjalistami (psycholog, logopeda, pedagog) na miejscu.\nWarsztaty i szkolenia dla rodziców.\nStały kontakt z wychowawcami i bieżące informacje o postępach.\nAktualności, terminy i zapisy na naszym Facebooku." ),

				/* — Zakładka: Terminy i FAQ — */
				array( 'key' => 'tab_ws_faq', 'label' => 'Terminy i FAQ', 'type' => 'tab', 'placement' => 'top' ),
				array( 'key' => 'field_ws_term_title', 'label' => 'Terminy — nagłówek', 'name' => 'ws_term_title', 'type' => 'text', 'default_value' => 'Terminy zajęć adaptacyjnych' ),
				array( 'key' => 'field_ws_term_text', 'label' => 'Terminy — tekst', 'name' => 'ws_term_text', 'type' => 'textarea', 'rows' => 3, 'default_value' => 'Sobotnie zajęcia adaptacyjne są bezpłatne i przeznaczone dla najmłodszych, przyszłych przedszkolaków. Konkretne terminy oraz zapisy ogłaszamy na bieżąco na naszym Facebooku — zajrzyj tam albo po prostu do nas zadzwoń, a wszystko podpowiemy.' ),
				array( 'key' => 'field_ws_term_btn1', 'label' => 'Terminy — przycisk 1', 'name' => 'ws_term_btn1', 'type' => 'text', 'default_value' => 'Zapisy przez Facebook' ),
				array( 'key' => 'field_ws_term_btn2', 'label' => 'Terminy — przycisk 2', 'name' => 'ws_term_btn2', 'type' => 'text', 'default_value' => 'Napisz do nas' ),
				array( 'key' => 'field_ws_faq_title', 'label' => 'FAQ — nagłówek', 'name' => 'ws_faq_title', 'type' => 'text', 'default_value' => 'Najczęstsze pytania rodziców' ),
				array( 'key' => 'field_ws_faq_lead', 'label' => 'FAQ — tekst', 'name' => 'ws_faq_lead', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Zebraliśmy odpowiedzi na pytania, które najczęściej zadają rodzice. Nie znalazłeś swojego? Napisz lub zadzwoń.' ),
				array( 'key' => 'field_ws_faq1_q', 'label' => 'Pytanie 1', 'name' => 'ws_faq1_q', 'type' => 'text', 'default_value' => 'Czym jest wczesne wspomaganie rozwoju (WWR)?' ),
				array( 'key' => 'field_ws_faq1_a', 'label' => 'Odpowiedź 1', 'name' => 'ws_faq1_a', 'type' => 'textarea', 'rows' => 3, 'default_value' => 'To bezpłatne, zindywidualizowane zajęcia, których celem jest jak najwcześniejsze wspieranie rozwoju dziecka. Prowadzi je zespół specjalistów, a zakres dobieramy do indywidualnych potrzeb malucha — w obszarze mowy, ruchu, emocji i relacji z rówieśnikami.' ),
				array( 'key' => 'field_ws_faq2_q', 'label' => 'Pytanie 2', 'name' => 'ws_faq2_q', 'type' => 'text', 'default_value' => 'Czy zajęcia WWR są płatne?' ),
				array( 'key' => 'field_ws_faq2_a', 'label' => 'Odpowiedź 2', 'name' => 'ws_faq2_a', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Nie. WWR jest całkowicie bezpłatne dla rodziców — realizujemy je dla dzieci posiadających opinię o potrzebie wczesnego wspomagania rozwoju.' ),
				array( 'key' => 'field_ws_faq3_q', 'label' => 'Pytanie 3', 'name' => 'ws_faq3_q', 'type' => 'text', 'default_value' => 'Jak uzyskać opinię o potrzebie WWR?' ),
				array( 'key' => 'field_ws_faq3_a', 'label' => 'Odpowiedź 3', 'name' => 'ws_faq3_a', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Opinię o potrzebie wczesnego wspomagania rozwoju wydaje publiczna poradnia psychologiczno-pedagogiczna na wniosek rodzica. Chętnie podpowiemy, jak się do tego przygotować — wystarczy się z nami skontaktować.' ),
				array( 'key' => 'field_ws_faq4_q', 'label' => 'Pytanie 4', 'name' => 'ws_faq4_q', 'type' => 'text', 'default_value' => 'Gdzie odbywają się terapie?' ),
				array( 'key' => 'field_ws_faq4_a', 'label' => 'Odpowiedź 4', 'name' => 'ws_faq4_a', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Wszystkie zajęcia prowadzimy na miejscu, w przedszkolu — w znanym dziecku, bezpiecznym otoczeniu, bez konieczności dojazdów do innych placówek.' ),
				array( 'key' => 'field_ws_faq5_q', 'label' => 'Pytanie 5', 'name' => 'ws_faq5_q', 'type' => 'text', 'default_value' => 'Jak zapisać dziecko na konsultację lub terapię?' ),
				array( 'key' => 'field_ws_faq5_a', 'label' => 'Odpowiedź 5', 'name' => 'ws_faq5_a', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Wystarczy zadzwonić pod 690 629 501 lub wypełnić formularz poniżej. Umówimy rozmowę i obserwację, a następnie zaproponujemy plan wsparcia dopasowany do dziecka.' ),
				array( 'key' => 'field_ws_faq6_q', 'label' => 'Pytanie 6', 'name' => 'ws_faq6_q', 'type' => 'text', 'default_value' => 'Czy rodzice są informowani o postępach dziecka?' ),
				array( 'key' => 'field_ws_faq6_a', 'label' => 'Odpowiedź 6', 'name' => 'ws_faq6_a', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Tak. Stały kontakt i konsultacje z rodzicami to podstawa naszej pracy — regularnie omawiamy postępy i wspólnie ustalamy kolejne kroki.' ),

				/* — Zakładka: Formularz i zakończenie — */
				array( 'key' => 'tab_ws_form', 'label' => 'Formularz i zakończenie', 'type' => 'tab', 'placement' => 'top' ),
				array( 'key' => 'field_ws_form_title', 'label' => 'Formularz — nagłówek', 'name' => 'ws_form_title', 'type' => 'text', 'default_value' => 'Zapytaj o wsparcie dla dziecka' ),
				array( 'key' => 'field_ws_form_lead', 'label' => 'Formularz — tekst', 'name' => 'ws_form_lead', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Zostaw zapytanie, a nasi specjaliści odezwą się i doradzą najlepsze rozwiązanie. Możesz też po prostu zadzwonić.' ),
				array( 'key' => 'field_ws_cta_title', 'label' => 'Zakończenie — nagłówek', 'name' => 'ws_cta_title', 'type' => 'text', 'default_value' => 'Masz pytania o wsparcie dla swojego dziecka?' ),
				array( 'key' => 'field_ws_cta_text', 'label' => 'Zakończenie — tekst', 'name' => 'ws_cta_text', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Nasi specjaliści chętnie odpowiedzą na pytania i doradzą najlepsze rozwiązania.' ),
				array( 'key' => 'field_ws_cta_btn1', 'label' => 'Zakończenie — przycisk 1', 'name' => 'ws_cta_btn1', 'type' => 'text', 'default_value' => 'Napisz do nas' ),
				array( 'key' => 'field_ws_cta_btn2', 'label' => 'Zakończenie — przycisk 2', 'name' => 'ws_cta_btn2', 'type' => 'text', 'default_value' => 'Poznaj specjalistów' ),
			),
			'location' => array(
				array(
					array( 'param' => 'page_slug', 'operator' => '==', 'value' => 'wsparcie' ),
				),
			),
			'menu_order' => 0,
			'position'   => 'normal',
			'style'      => 'default',
		)
	);

	/* ---------------------------------------------------------------
	 * GRUPA 6: „Kontakt" — teksty strony (formularz/dane kontaktowe zostają)
	 * Lokalizacja: strona o uchwycie (slug) „kontakt".
	 * --------------------------------------------------------------- */
	acf_add_local_field_group(
		array(
			'key'    => 'group_dworek_kontakt',
			'title'  => 'Kontakt — treść strony',
			'fields' => array(
				array( 'key' => 'tab_ko_main', 'label' => 'Nagłówki sekcji', 'type' => 'tab', 'placement' => 'top' ),
				array( 'key' => 'field_ko_form_title', 'label' => 'Formularz — nagłówek', 'name' => 'ko_form_title', 'type' => 'text', 'default_value' => 'Formularz zapisu' ),
				array( 'key' => 'field_ko_info_title', 'label' => 'Dane kontaktowe — nagłówek', 'name' => 'ko_info_title', 'type' => 'text', 'default_value' => 'Jesteśmy do dyspozycji' ),
				array( 'key' => 'field_ko_info_lead', 'label' => 'Dane kontaktowe — tekst', 'name' => 'ko_info_lead', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Zapraszamy do kontaktu telefonicznego, mailowego lub osobistej wizyty w naszym przedszkolu na warszawskiej Woli.' ),

				array( 'key' => 'tab_ko_doj', 'label' => 'Dojazd i parking', 'type' => 'tab', 'placement' => 'top' ),
				array( 'key' => 'field_ko_doj_title', 'label' => 'Nagłówek', 'name' => 'ko_doj_title', 'type' => 'text', 'default_value' => 'Dojazd i parking' ),
				array( 'key' => 'field_ko_doj_lead', 'label' => 'Tekst wprowadzający', 'name' => 'ko_doj_lead', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Znajdujemy się na warszawskiej Woli, przy ul. Górczewskiej 89 — jednej z głównych arterii dzielnicy z dogodnym dojazdem.' ),
				array( 'key' => 'field_ko_doj1_t', 'label' => 'Karta 1 — tytuł', 'name' => 'ko_doj1_t', 'type' => 'text', 'default_value' => 'Komunikacją miejską' ),
				array( 'key' => 'field_ko_doj1_d', 'label' => 'Karta 1 — opis', 'name' => 'ko_doj1_d', 'type' => 'textarea', 'rows' => 3, 'default_value' => 'Wzdłuż ul. Górczewskiej kursują tramwaje i autobusy, dzięki czemu dojazd z różnych części miasta jest wygodny. Najdogodniejsze połączenie najłatwiej sprawdzić w wyszukiwarce trasy (np. jakdojade.pl) dla adresu Górczewska 89.' ),
				array( 'key' => 'field_ko_doj2_t', 'label' => 'Karta 2 — tytuł', 'name' => 'ko_doj2_t', 'type' => 'text', 'default_value' => 'Samochodem' ),
				array( 'key' => 'field_ko_doj2_d', 'label' => 'Karta 2 — opis', 'name' => 'ko_doj2_d', 'type' => 'wysiwyg', 'tabs' => 'visual', 'media_upload' => 0, 'toolbar' => 'basic', 'default_value' => '<p>Do przedszkola dojadą Państwo bezpośrednio ul. Górczewską. W sprawie najdogodniejszego miejsca na podwiezienie i odebranie dziecka chętnie pomożemy — wystarczy zadzwonić: <a href="tel:+48690629501">690 629 501</a>.</p>' ),

				array( 'key' => 'tab_ko_docs', 'label' => 'Dokumenty', 'type' => 'tab', 'placement' => 'top' ),
				array( 'key' => 'field_ko_docs_title', 'label' => 'Nagłówek', 'name' => 'ko_docs_title', 'type' => 'text', 'default_value' => 'Dokumenty do pobrania' ),
				array( 'key' => 'field_ko_docs_lead', 'label' => 'Tekst wprowadzający', 'name' => 'ko_docs_lead', 'type' => 'text', 'default_value' => 'Sprawdź aktualne informacje dotyczące naszego przedszkola!' ),
			),
			'location' => array(
				array(
					array( 'param' => 'page_slug', 'operator' => '==', 'value' => 'kontakt' ),
				),
			),
			'menu_order' => 0,
			'position'   => 'normal',
			'style'      => 'default',
		)
	);

	/* ---------------------------------------------------------------
	 * GRUPA 7: „Galeria" — etykiety filtrów + sekcja końcowa
	 * Lokalizacja: strona o uchwycie (slug) „galeria".
	 * --------------------------------------------------------------- */
	acf_add_local_field_group(
		array(
			'key'    => 'group_dworek_galeria',
			'title'  => 'Galeria — treść strony',
			'fields' => array(
				array( 'key' => 'field_ga_f_all', 'label' => 'Filtr — „Wszystkie"', 'name' => 'ga_f_all', 'type' => 'text', 'default_value' => 'Wszystkie', 'wrapper' => array( 'width' => '33' ) ),
				array( 'key' => 'field_ga_f_sale', 'label' => 'Filtr — Sale', 'name' => 'ga_f_sale', 'type' => 'text', 'default_value' => 'Sale', 'wrapper' => array( 'width' => '33' ) ),
				array( 'key' => 'field_ga_f_zajecia', 'label' => 'Filtr — Zajęcia', 'name' => 'ga_f_zajecia', 'type' => 'text', 'default_value' => 'Zajęcia', 'wrapper' => array( 'width' => '33' ) ),
				array( 'key' => 'field_ga_f_plac', 'label' => 'Filtr — Plac zabaw', 'name' => 'ga_f_plac', 'type' => 'text', 'default_value' => 'Plac zabaw', 'wrapper' => array( 'width' => '33' ) ),
				array( 'key' => 'field_ga_f_warsztaty', 'label' => 'Filtr — Warsztaty', 'name' => 'ga_f_warsztaty', 'type' => 'text', 'default_value' => 'Warsztaty', 'wrapper' => array( 'width' => '33' ) ),
				array( 'key' => 'field_ga_f_wycieczki', 'label' => 'Filtr — Wycieczki', 'name' => 'ga_f_wycieczki', 'type' => 'text', 'default_value' => 'Wycieczki', 'wrapper' => array( 'width' => '33' ) ),
				array( 'key' => 'field_ga_cta_title', 'label' => 'Sekcja końcowa — nagłówek', 'name' => 'ga_cta_title', 'type' => 'text', 'default_value' => 'Chcesz zobaczyć więcej?' ),
				array( 'key' => 'field_ga_cta_text', 'label' => 'Sekcja końcowa — tekst', 'name' => 'ga_cta_text', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Najlepsze chwile dzieją się na żywo. Umów bezpłatne zwiedzanie i zobacz nasze przedszkole od środka.' ),
				array( 'key' => 'field_ga_cta_btn', 'label' => 'Sekcja końcowa — przycisk', 'name' => 'ga_cta_btn', 'type' => 'text', 'default_value' => 'Umów wizytę' ),
			),
			'location' => array(
				array(
					array( 'param' => 'page_slug', 'operator' => '==', 'value' => 'galeria' ),
				),
			),
			'menu_order' => 0,
			'position'   => 'normal',
			'style'      => 'default',
		)
	);

	/* ---------------------------------------------------------------
	 * GRUPA 8: „Strona główna — treść" (sekcje poza Hero)
	 * Lokalizacja: strona ustawiona jako strona główna.
	 * --------------------------------------------------------------- */
	acf_add_local_field_group(
		array(
			'key'    => 'group_dworek_front_body',
			'title'  => 'Strona główna — treść (sekcje poniżej Hero)',
			'fields' => array(

				/* — Zakładka: Dlaczego warto — */
				array( 'key' => 'tab_hp_warto', 'label' => 'Dlaczego warto', 'type' => 'tab', 'placement' => 'top' ),
				array( 'key' => 'field_hp_warto_title', 'label' => 'Nagłówek', 'name' => 'hp_warto_title', 'type' => 'text', 'default_value' => 'Dlaczego warto wybrać Czarodziejski Dworek?' ),
				array( 'key' => 'field_hp_warto_lead', 'label' => 'Tekst wprowadzający', 'name' => 'hp_warto_lead', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Ponad 20 lat doświadczenia, małe grupy i specjaliści na miejscu — wszystko, czego potrzebuje Twoje dziecko, by rosło bezpieczne, radosne i ciekawe świata.' ),
				array( 'key' => 'field_hp_warto1_t', 'label' => 'Karta 1 — tytuł', 'name' => 'hp_warto1_t', 'type' => 'text', 'default_value' => 'Małe grupy' ),
				array( 'key' => 'field_hp_warto1_d', 'label' => 'Karta 1 — opis', 'name' => 'hp_warto1_d', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Do 14 dzieci w grupie i 2 nauczycieli — każde dziecko jest naprawdę zauważone.' ),
				array( 'key' => 'field_hp_warto2_t', 'label' => 'Karta 2 — tytuł', 'name' => 'hp_warto2_t', 'type' => 'text', 'default_value' => 'Specjaliści na miejscu' ),
				array( 'key' => 'field_hp_warto2_d', 'label' => 'Karta 2 — opis', 'name' => 'hp_warto2_d', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Logopeda, psycholog, terapeuta SI i fizjoterapeuta — wszyscy w przedszkolu.' ),
				array( 'key' => 'field_hp_warto3_t', 'label' => 'Karta 3 — tytuł', 'name' => 'hp_warto3_t', 'type' => 'text', 'default_value' => 'Zdrowe jedzenie' ),
				array( 'key' => 'field_hp_warto3_d', 'label' => 'Karta 3 — opis', 'name' => 'hp_warto3_d', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Smaczne, zdrowe posiłki — uwzględniamy wszystkie diety dzieci.' ),
				array( 'key' => 'field_hp_warto4_t', 'label' => 'Karta 4 — tytuł', 'name' => 'hp_warto4_t', 'type' => 'text', 'default_value' => 'Bezpieczny teren' ),
				array( 'key' => 'field_hp_warto4_d', 'label' => 'Karta 4 — opis', 'name' => 'hp_warto4_d', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Duży, ogrodzony plac zabaw i własny parking dla rodziców.' ),
				array( 'key' => 'field_hp_adv', 'label' => 'Pasek atutów (4 linie)', 'name' => 'hp_adv', 'type' => 'textarea', 'rows' => 4, 'instructions' => 'Każda linia = jeden atut (dokładnie 4 linie).', 'default_value' => "Przestronne sale edukacyjne z zapleczem sanitarnym\nNieodpłatne zajęcia terapeutyczne, językowe, basen i warsztaty\nWsparcie dla rodziców: konsultacje, warsztaty i szkolenia\n„Zielone noce” i kilkudniowe wycieczki" ),

				/* — Zakładka: O nas (skrót) — */
				array( 'key' => 'tab_hp_onas', 'label' => 'O nas (skrót)', 'type' => 'tab', 'placement' => 'top' ),
				array( 'key' => 'field_hp_onas_title', 'label' => 'Nagłówek', 'name' => 'hp_onas_title', 'type' => 'text', 'default_value' => 'Wyjątkowe przedszkole z 20-letnią tradycją' ),
				array( 'key' => 'field_hp_onas_p', 'label' => 'Akapit', 'name' => 'hp_onas_p', 'type' => 'textarea', 'rows' => 3, 'default_value' => 'Przedszkole założyliśmy we wrześniu 2003 roku. Jesteśmy wpisani do ewidencji szkół i placówek niepublicznych pod nr 111/PN. Naszym celem jest dbanie o wszechstronny rozwój dziecka — odkrywamy i doceniamy jego mocne strony, zaszczepiamy pasje twórcze i wspomagamy harmonijny rozwój.' ),
				array( 'key' => 'field_hp_onas_list', 'label' => 'Lista punktów', 'name' => 'hp_onas_list', 'type' => 'textarea', 'rows' => 3, 'instructions' => 'Każda linia = jeden punkt z „✓".', 'default_value' => "Indywidualne podejście do każdego dziecka\nRodzinna, ciepła atmosfera\nWykwalifikowana kadra i specjaliści na miejscu" ),
				array( 'key' => 'field_hp_onas_btn', 'label' => 'Przycisk', 'name' => 'hp_onas_btn', 'type' => 'text', 'default_value' => 'Więcej o nas' ),

				/* — Zakładka: Zajęcia w czesnym — */
				array( 'key' => 'tab_hp_zaj', 'label' => 'Zajęcia w czesnym', 'type' => 'tab', 'placement' => 'top' ),
				array( 'key' => 'field_hp_zaj_title', 'label' => 'Nagłówek', 'name' => 'hp_zaj_title', 'type' => 'text', 'default_value' => 'Bogata oferta bez dodatkowych opłat' ),
				array( 'key' => 'field_hp_zaj_lead', 'label' => 'Tekst wprowadzający', 'name' => 'hp_zaj_lead', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Basen, języki i muzyka są w cenie czesnego — bez ukrytych kosztów.' ),
				array( 'key' => 'field_hp_zaj1_t', 'label' => 'Karta 1 — tytuł', 'name' => 'hp_zaj1_t', 'type' => 'text', 'default_value' => 'Basen' ),
				array( 'key' => 'field_hp_zaj1_d', 'label' => 'Karta 1 — opis', 'name' => 'hp_zaj1_d', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Nauka pływania i oswajanie z wodą pod okiem instruktorów.' ),
				array( 'key' => 'field_hp_zaj2_t', 'label' => 'Karta 2 — tytuł', 'name' => 'hp_zaj2_t', 'type' => 'text', 'default_value' => 'Język angielski' ),
				array( 'key' => 'field_hp_zaj2_d', 'label' => 'Karta 2 — opis', 'name' => 'hp_zaj2_d', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Codzienny kontakt z językiem — nauka przez zabawę i piosenki.' ),
				array( 'key' => 'field_hp_zaj3_t', 'label' => 'Karta 3 — tytuł', 'name' => 'hp_zaj3_t', 'type' => 'text', 'default_value' => 'Język francuski' ),
				array( 'key' => 'field_hp_zaj3_d', 'label' => 'Karta 3 — opis', 'name' => 'hp_zaj3_d', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Drugi język obcy od najmłodszych lat, w naturalnej formie.' ),
				array( 'key' => 'field_hp_zaj4_t', 'label' => 'Karta 4 — tytuł', 'name' => 'hp_zaj4_t', 'type' => 'text', 'default_value' => 'Muzyka' ),
				array( 'key' => 'field_hp_zaj4_d', 'label' => 'Karta 4 — opis', 'name' => 'hp_zaj4_d', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Rytmika, śpiew i instrumenty — rozwój słuchu i poczucia rytmu.' ),

				/* — Zakładka: Program — */
				array( 'key' => 'tab_hp_prog', 'label' => 'Program', 'type' => 'tab', 'placement' => 'top' ),
				array( 'key' => 'field_hp_prog_title', 'label' => 'Nagłówek 1', 'name' => 'hp_prog_title', 'type' => 'text', 'default_value' => 'Program, w którym każda zabawa jest nauką' ),
				array( 'key' => 'field_hp_prog_p', 'label' => 'Akapit', 'name' => 'hp_prog_p', 'type' => 'textarea', 'rows' => 3, 'default_value' => '„W «Czarodziejskim Dworku» każda zabawa jest nauką, a każda nauka jest zabawą.” Przez radość i twórczość wspieramy wszechstronny rozwój każdego dziecka.' ),
				array( 'key' => 'field_hp_prog_list', 'label' => 'Lista punktów', 'name' => 'hp_prog_list', 'type' => 'textarea', 'rows' => 3, 'instructions' => 'Każda linia = jeden punkt z „✓".', 'default_value' => "Rozbudzamy ciekawość poznawczą\nRozwijamy zdolności artystyczne, muzyczne i językowe\nWspieramy wyobraźnię i poczucie własnej wartości" ),
				array( 'key' => 'field_hp_prog2_title', 'label' => 'Nagłówek 2 (obszary)', 'name' => 'hp_prog2_title', 'type' => 'text', 'default_value' => 'Wszystko, co rozwijamy u dzieci' ),
				array( 'key' => 'field_hp_prog2_lead', 'label' => 'Tekst pod nagłówkiem 2', 'name' => 'hp_prog2_lead', 'type' => 'textarea', 'rows' => 2, 'default_value' => '15 zajęć i terapii w trzech obszarach — w cenie czesnego.' ),
				array( 'key' => 'field_hp_progc1_t', 'label' => 'Obszar 1 — tytuł', 'name' => 'hp_progc1_t', 'type' => 'text', 'default_value' => 'Edukacja i języki' ),
				array( 'key' => 'field_hp_progc1_l', 'label' => 'Obszar 1 — lista', 'name' => 'hp_progc1_l', 'type' => 'textarea', 'rows' => 4, 'instructions' => 'Każda linia = jedna pozycja listy.', 'default_value' => "Zajęcia edukacyjne\nJęzyk angielski\nJęzyk francuski" ),
				array( 'key' => 'field_hp_progc2_t', 'label' => 'Obszar 2 — tytuł', 'name' => 'hp_progc2_t', 'type' => 'text', 'default_value' => 'Muzyka i ruch' ),
				array( 'key' => 'field_hp_progc2_l', 'label' => 'Obszar 2 — lista', 'name' => 'hp_progc2_l', 'type' => 'textarea', 'rows' => 6, 'instructions' => 'Każda linia = jedna pozycja listy.', 'default_value' => "Muzyka\nGimnastyka\nJoga\nZajęcia taneczne\nBasen" ),
				array( 'key' => 'field_hp_progc3_t', 'label' => 'Obszar 3 — tytuł', 'name' => 'hp_progc3_t', 'type' => 'text', 'default_value' => 'WWR i terapia' ),
				array( 'key' => 'field_hp_progc3_l', 'label' => 'Obszar 3 — lista', 'name' => 'hp_progc3_l', 'type' => 'textarea', 'rows' => 7, 'instructions' => 'Każda linia = jedna pozycja listy.', 'default_value' => "Logopedia\nPsycholog\nIntegracja sensoryczna\nTrening umiejętności społecznych (TUS)\nWWR i terapia pedagogiczna\nFizjoterapia" ),

				/* — Zakładka: Specjaliści — */
				array( 'key' => 'tab_hp_spec', 'label' => 'Specjaliści', 'type' => 'tab', 'placement' => 'top' ),
				array( 'key' => 'field_hp_spec_title', 'label' => 'Nagłówek', 'name' => 'hp_spec_title', 'type' => 'text', 'default_value' => 'Specjaliści, których znajdziesz na miejscu' ),
				array( 'key' => 'field_hp_spec_lead', 'label' => 'Tekst wprowadzający', 'name' => 'hp_spec_lead', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Diagnoza i terapia bez konieczności szukania pomocy poza przedszkolem.' ),
				array( 'key' => 'field_hp_spec1_t', 'label' => 'Karta 1 — tytuł', 'name' => 'hp_spec1_t', 'type' => 'text', 'default_value' => 'Nauczyciele' ),
				array( 'key' => 'field_hp_spec1_d', 'label' => 'Karta 1 — opis', 'name' => 'hp_spec1_d', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Doświadczona kadra pedagogiczna — 2 nauczycieli w każdej grupie.' ),
				array( 'key' => 'field_hp_spec2_t', 'label' => 'Karta 2 — tytuł', 'name' => 'hp_spec2_t', 'type' => 'text', 'default_value' => 'Logopeda' ),
				array( 'key' => 'field_hp_spec2_d', 'label' => 'Karta 2 — opis', 'name' => 'hp_spec2_d', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Diagnoza i terapia mowy, słuchu fonematycznego i komunikacji.' ),
				array( 'key' => 'field_hp_spec3_t', 'label' => 'Karta 3 — tytuł', 'name' => 'hp_spec3_t', 'type' => 'text', 'default_value' => 'Psycholog' ),
				array( 'key' => 'field_hp_spec3_d', 'label' => 'Karta 3 — opis', 'name' => 'hp_spec3_d', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Wsparcie emocjonalne i społeczne dziecka oraz konsultacje dla rodziców.' ),
				array( 'key' => 'field_hp_spec4_t', 'label' => 'Karta 4 — tytuł', 'name' => 'hp_spec4_t', 'type' => 'text', 'default_value' => 'Terapeuta SI' ),
				array( 'key' => 'field_hp_spec4_d', 'label' => 'Karta 4 — opis', 'name' => 'hp_spec4_d', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Integracja sensoryczna wspierająca koncentrację i równowagę.' ),
				array( 'key' => 'field_hp_spec5_t', 'label' => 'Karta 5 — tytuł', 'name' => 'hp_spec5_t', 'type' => 'text', 'default_value' => 'Fizjoterapeuta' ),
				array( 'key' => 'field_hp_spec5_d', 'label' => 'Karta 5 — opis', 'name' => 'hp_spec5_d', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Ćwiczenia wspierające prawidłową postawę i rozwój ruchowy.' ),
				array( 'key' => 'field_hp_spec6_t', 'label' => 'Karta 6 — tytuł', 'name' => 'hp_spec6_t', 'type' => 'text', 'default_value' => 'Pedagog' ),
				array( 'key' => 'field_hp_spec6_d', 'label' => 'Karta 6 — opis', 'name' => 'hp_spec6_d', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Terapia pedagogiczna i wsparcie w rozwoju umiejętności szkolnych.' ),
				array( 'key' => 'field_hp_spec_btn', 'label' => 'Przycisk', 'name' => 'hp_spec_btn', 'type' => 'text', 'default_value' => 'Poznaj naszą kadrę' ),

				/* — Zakładka: WWR i adaptacja — */
				array( 'key' => 'tab_hp_wwr', 'label' => 'WWR i adaptacja', 'type' => 'tab', 'placement' => 'top' ),
				array( 'key' => 'field_hp_wwr_title', 'label' => 'WWR — nagłówek', 'name' => 'hp_wwr_title', 'type' => 'text', 'default_value' => 'Bezpłatne wsparcie terapeutyczne' ),
				array( 'key' => 'field_hp_wwr_p', 'label' => 'WWR — akapit', 'name' => 'hp_wwr_p', 'type' => 'textarea', 'rows' => 3, 'default_value' => 'Dzieci z opinią o potrzebie wczesnego wspomagania rozwoju (WWR) obejmujemy bezpłatnymi, indywidualnymi zajęciami terapeutycznymi — prowadzonymi przez specjalistów na miejscu.' ),
				array( 'key' => 'field_hp_wwr_list', 'label' => 'WWR — lista', 'name' => 'hp_wwr_list', 'type' => 'textarea', 'rows' => 3, 'instructions' => 'Każda linia = jeden punkt z „✓".', 'default_value' => "Terapia psychologiczna, logopedyczna i pedagogiczna\nIntegracja sensoryczna oraz fizjoterapia\nTrening Umiejętności Społecznych (TUS)" ),
				array( 'key' => 'field_hp_wwr_btn', 'label' => 'WWR — przycisk', 'name' => 'hp_wwr_btn', 'type' => 'text', 'default_value' => 'Poznaj nasze terapie' ),
				array( 'key' => 'field_hp_adapt_title', 'label' => 'Adaptacja — nagłówek', 'name' => 'hp_adapt_title', 'type' => 'text', 'default_value' => 'Łagodna adaptacja — poznaj nas w soboty' ),
				array( 'key' => 'field_hp_adapt_text', 'label' => 'Adaptacja — tekst', 'name' => 'hp_adapt_text', 'type' => 'textarea', 'rows' => 3, 'default_value' => 'Zapraszamy na bezpłatne sobotnie zajęcia adaptacyjne dla najmłodszych dzieci i ich rodziców. Wspólna zabawa pomaga dziecku spokojnie oswoić się z przedszkolem — aktualne terminy i zapisy ogłaszamy na Facebooku.' ),
				array( 'key' => 'field_hp_adapt_btn', 'label' => 'Adaptacja — przycisk', 'name' => 'hp_adapt_btn', 'type' => 'text', 'default_value' => 'Zapisy przez Facebook' ),

				/* — Zakładka: Galeria i opinie — */
				array( 'key' => 'tab_hp_op', 'label' => 'Galeria i opinie', 'type' => 'tab', 'placement' => 'top' ),
				array( 'key' => 'field_hp_gal_title', 'label' => 'Galeria — nagłówek', 'name' => 'hp_gal_title', 'type' => 'text', 'default_value' => 'Zajrzyj do naszego świata' ),
				array( 'key' => 'field_hp_gal_btn', 'label' => 'Galeria — przycisk', 'name' => 'hp_gal_btn', 'type' => 'text', 'default_value' => 'Zobacz pełną galerię' ),
				array( 'key' => 'field_hp_op_title', 'label' => 'Opinie — nagłówek', 'name' => 'hp_op_title', 'type' => 'text', 'default_value' => 'Co mówią o nas rodzice' ),
				array( 'key' => 'field_hp_op_lead', 'label' => 'Opinie — tekst', 'name' => 'hp_op_lead', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Prawdziwe opinie z naszego profilu na Facebooku.' ),
				array( 'key' => 'field_hp_op1_q', 'label' => 'Opinia 1 — treść', 'name' => 'hp_op1_q', 'type' => 'textarea', 'rows' => 3, 'default_value' => 'Przedszkole ze wspaniałą kadrą, wręcz rodzinną atmosferą, które mogę polecić każdemu. Nie wyobrażam sobie nawet lepszego miejsca.' ),
				array( 'key' => 'field_hp_op1_a', 'label' => 'Opinia 1 — autor', 'name' => 'hp_op1_a', 'type' => 'text', 'default_value' => 'Mariusz Linkiewicz' ),
				array( 'key' => 'field_hp_op2_q', 'label' => 'Opinia 2 — treść', 'name' => 'hp_op2_q', 'type' => 'textarea', 'rows' => 3, 'default_value' => 'Super przedszkole z indywidualnym podejściem do każdego dziecka. Bardzo dużo rozwijających zajęć, nieodpłatne zajęcia logopedyczne i świetne warsztaty edukacyjne.' ),
				array( 'key' => 'field_hp_op2_a', 'label' => 'Opinia 2 — autor', 'name' => 'hp_op2_a', 'type' => 'text', 'default_value' => 'Agnieszka' ),
				array( 'key' => 'field_hp_op3_q', 'label' => 'Opinia 3 — treść', 'name' => 'hp_op3_q', 'type' => 'textarea', 'rows' => 3, 'default_value' => 'Moje obie córki chodzą do tego przedszkola. Jesteśmy z mężem bardzo zadowoleni i nie zamienilibyśmy tego miejsca na żadne inne!' ),
				array( 'key' => 'field_hp_op3_a', 'label' => 'Opinia 3 — autor', 'name' => 'hp_op3_a', 'type' => 'text', 'default_value' => 'Anna Łucja' ),
				array( 'key' => 'field_hp_op4_q', 'label' => 'Opinia 4 — treść', 'name' => 'hp_op4_q', 'type' => 'textarea', 'rows' => 3, 'default_value' => 'Moje dziecko uczęszcza do tego przedszkola od kilku lat i widoczna jest bardzo duża poprawa zarówno w rozwoju emocjonalnym, jak i intelektualnym.' ),
				array( 'key' => 'field_hp_op4_a', 'label' => 'Opinia 4 — autor', 'name' => 'hp_op4_a', 'type' => 'text', 'default_value' => 'Agnieszka Zawadzka' ),

				/* — Zakładka: Aktualności i CTA — */
				array( 'key' => 'tab_hp_cta', 'label' => 'Aktualności i CTA', 'type' => 'tab', 'placement' => 'top' ),
				array( 'key' => 'field_hp_news_title', 'label' => 'Aktualności — nagłówek', 'name' => 'hp_news_title', 'type' => 'text', 'default_value' => 'Co słychać w Dworku' ),
				array( 'key' => 'field_hp_news_btn', 'label' => 'Aktualności — przycisk', 'name' => 'hp_news_btn', 'type' => 'text', 'default_value' => 'Zobacz blog' ),
				array( 'key' => 'field_hp_cta_title', 'label' => 'CTA — nagłówek', 'name' => 'hp_cta_title', 'type' => 'text', 'default_value' => 'Zapewnij dziecku wyjątkowy start' ),
				array( 'key' => 'field_hp_cta_text', 'label' => 'CTA — tekst', 'name' => 'hp_cta_text', 'type' => 'textarea', 'rows' => 3, 'default_value' => 'Umów bezpłatne spotkanie i zobacz „Czarodziejski Dworek” od środka — poznasz kadrę, sale i ogród. Zostaw kontakt, a oddzwonimy i odpowiemy na wszystkie pytania. Bez zobowiązań.' ),
				array( 'key' => 'field_hp_cta_btn1', 'label' => 'CTA — przycisk 1', 'name' => 'hp_cta_btn1', 'type' => 'text', 'default_value' => 'Zapisz dziecko' ),
				array( 'key' => 'field_hp_cta_btn2', 'label' => 'CTA — przycisk 2 (telefon)', 'name' => 'hp_cta_btn2', 'type' => 'text', 'default_value' => 'Zadzwoń: 690 629 501' ),
			),
			'location' => array(
				array(
					array( 'param' => 'page_type', 'operator' => '==', 'value' => 'front_page' ),
				),
			),
			'menu_order' => 1,
			'position'   => 'normal',
			'style'      => 'default',
		)
	);
}

/* -------------------------------------------------------------------
 * Własna reguła lokalizacji ACF: „Uchwyt strony (slug)".
 * Pozwala przypiąć grupę pól do strony po jej slugu (np. o-nas) —
 * przenośnie między instalacjami (u klienta slug jest taki sam).
 * ------------------------------------------------------------------- */
add_filter( 'acf/location/rule_types', function ( $choices ) {
	$choices['Strona']['page_slug'] = 'Uchwyt strony (slug)';
	return $choices;
} );

add_filter( 'acf/location/rule_values/page_slug', function ( $choices ) {
	foreach ( array( 'o-nas', 'oferta', 'kadra', 'wsparcie', 'galeria', 'kontakt', 'blog', 'polityka-prywatnosci' ) as $slug ) {
		$choices[ $slug ] = $slug;
	}
	return $choices;
} );

add_filter( 'acf/location/rule_match/page_slug', function ( $result, $rule, $options ) {
	$post_id = isset( $options['post_id'] ) ? $options['post_id'] : false;
	if ( ! $post_id ) {
		return false;
	}
	$slug = get_post_field( 'post_name', $post_id );
	if ( '==' === $rule['operator'] ) {
		return $slug === $rule['value'];
	}
	if ( '!=' === $rule['operator'] ) {
		return $slug !== $rule['value'];
	}
	return $result;
}, 10, 3 );
