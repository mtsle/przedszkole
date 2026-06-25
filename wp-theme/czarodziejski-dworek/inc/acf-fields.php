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
}
