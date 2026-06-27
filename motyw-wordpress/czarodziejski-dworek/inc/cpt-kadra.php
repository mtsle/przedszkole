<?php
/**
 * Typ treści „Kadra" — każdy nauczyciel/specjalista to osobny wpis,
 * który klient dodaje/edytuje/usuwa w panelu WordPress.
 *
 * Pola (ACF): rola, grupa, biogram, plik zdjęcia (migracja).
 * Zdjęcie docelowo: „Obraz wyróżniający". Bez zdjęcia — automatyczne inicjały.
 *
 * @package Czarodziejski_Dworek
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* Rejestracja typu treści. */
function dworek_register_kadra_cpt() {
	register_post_type(
		'kadra',
		array(
			'labels'        => array(
				'name'               => 'Kadra',
				'singular_name'      => 'Osoba z kadry',
				'add_new'            => 'Dodaj osobę',
				'add_new_item'       => 'Dodaj osobę z kadry',
				'edit_item'          => 'Edytuj osobę',
				'new_item'           => 'Nowa osoba',
				'view_item'          => 'Zobacz osobę',
				'search_items'       => 'Szukaj w kadrze',
				'not_found'          => 'Nie znaleziono osób',
				'all_items'          => 'Cała kadra',
				'menu_name'          => 'Kadra',
			),
			'public'        => true,
			'has_archive'   => false,
			'show_in_rest'  => true,
			'menu_icon'     => 'dashicons-groups',
			'menu_position' => 22,
			'supports'      => array( 'title', 'thumbnail', 'page-attributes' ),
			'rewrite'       => array( 'slug' => 'kadra-osoba' ),
		)
	);
}
add_action( 'init', 'dworek_register_kadra_cpt' );

/* Pola ACF dla Kadry (gdy wtyczka aktywna). */
add_action( 'acf/init', 'dworek_register_kadra_fields' );
function dworek_register_kadra_fields() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}
	acf_add_local_field_group(
		array(
			'key'    => 'group_dworek_kadra',
			'title'  => 'Dane osoby z kadry',
			'fields' => array(
				array(
					'key'   => 'field_kadra_rola',
					'label' => 'Rola / stanowisko',
					'name'  => 'rola',
					'type'  => 'text',
					'instructions' => 'Np. „Lektor języka angielskiego", „Psycholog".',
				),
				array(
					'key'           => 'field_kadra_grupa',
					'label'         => 'Grupa (sekcja na stronie)',
					'name'          => 'grupa',
					'type'          => 'select',
					'choices'       => array(
						'dyrekcja'    => 'Dyrekcja',
						'nauczyciele' => 'Nauczyciele i pedagodzy',
						'lektorzy'    => 'Lektorzy i muzyka',
						'specjalisci' => 'Zespół specjalistów',
					),
					'default_value' => 'nauczyciele',
				),
				array(
					'key'          => 'field_kadra_bio',
					'label'        => 'Biogram',
					'name'         => 'bio',
					'type'         => 'textarea',
					'rows'         => 8,
					'instructions' => 'Każdy akapit w osobnej linii (puste linie rozdzielają punkty w okienku).',
				),
				array(
					'key'          => 'field_kadra_foto',
					'label'        => 'Plik zdjęcia (opcjonalnie)',
					'name'         => 'zdjecie_plik',
					'type'         => 'text',
					'instructions' => 'Tylko dla zdjęć dostarczonych z motywem (np. „jurska.webp"). Dla nowych osób użyj „Obrazka wyróżniającego" po prawej.',
				),
			),
			'location' => array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'kadra',
					),
				),
			),
			'menu_order' => 0,
			'position'   => 'normal',
		)
	);
}

/**
 * Zwraca URL zdjęcia osoby: 1) Obraz wyróżniający, 2) plik z motywu, 3) puste.
 */
function dworek_kadra_photo( $post_id ) {
	if ( has_post_thumbnail( $post_id ) ) {
		return get_the_post_thumbnail_url( $post_id, 'medium' );
	}
	$file = get_post_meta( $post_id, 'zdjecie_plik', true );
	if ( $file ) {
		return get_template_directory_uri() . '/img/kadra/' . ltrim( $file, '/' );
	}
	return '';
}

/**
 * Inicjały z imienia i nazwiska (gdy brak zdjęcia).
 */
function dworek_kadra_initials( $name ) {
	$parts = preg_split( '/\s+/', trim( $name ) );
	$ini   = '';
	foreach ( $parts as $p ) {
		if ( $p !== '' ) {
			$ini .= mb_strtoupper( mb_substr( $p, 0, 1 ) );
		}
		if ( mb_strlen( $ini ) >= 2 ) {
			break;
		}
	}
	return $ini;
}
