<?php
/**
 * Globalne dane kontaktowe przedszkola — JEDNO miejsce edycji.
 *
 * Klient zmienia je w: Wygląd → Dostosuj → „Dane kontaktowe".
 * Używane w stopce oraz w kartach kontaktowych (Kontakt, WWR i terapia).
 * Uwaga: dane w strukturze SEO (JSON-LD) i dokumentach prawnych są celowo
 * niezależne — tam format ma znaczenie i nie zmieniamy go przez ten panel.
 *
 * @package Czarodziejski_Dworek
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Zwraca wartość danej kontaktowej z Dostosuj (theme_mod) lub wartość domyślną.
 *
 * @param string $key     Klucz bez prefiksu, np. 'phone', 'email', 'address'.
 * @param string $default Wartość domyślna (obecna treść = wygląd 1:1).
 * @return string
 */
function dworek_contact( $key, $default = '' ) {
	$value = get_theme_mod( 'dworek_' . $key, $default );
	return ( '' === $value || false === $value || null === $value ) ? $default : $value;
}

/* Domyślne dane (prawdziwe) — używane, gdy klient nic nie zmieni. */
function dworek_contact_defaults() {
	return array(
		'phone'      => '690 629 501',
		'phone_link' => '+48690629501',
		'email'      => 'kontakt@czarodziejski-dworek.pl',
		'address'    => 'ul. Górczewska 89, 01-401 Warszawa (Wola)',
		'hours'      => 'Poniedziałek – Piątek: 7.00 – 18.00',
		'facebook'   => 'https://www.facebook.com/czarodziejskidworek/',
		'nip'        => '524-246-20-37',
	);
}

/* Rejestracja sekcji i pól w Dostosuj. */
add_action( 'customize_register', 'dworek_contact_info_customizer' );
function dworek_contact_info_customizer( $wp_customize ) {
	$wp_customize->add_section(
		'dworek_contact_info',
		array(
			'title'    => 'Dane kontaktowe',
			'priority' => 159,
			'description' => 'Telefon, e-mail, adres i godziny — używane w stopce i na kartach kontaktowych. Zmień raz, zmieni się wszędzie.',
		)
	);

	$fields = array(
		'phone'      => array( 'Telefon (wyświetlany)', 'text', 'sanitize_text_field' ),
		'phone_link' => array( 'Telefon do linku (np. +48690629501)', 'text', 'sanitize_text_field' ),
		'email'      => array( 'E-mail', 'email', 'sanitize_email' ),
		'address'    => array( 'Adres', 'text', 'sanitize_text_field' ),
		'hours'      => array( 'Godziny otwarcia', 'text', 'sanitize_text_field' ),
		'facebook'   => array( 'Adres Facebooka (URL)', 'url', 'esc_url_raw' ),
		'nip'        => array( 'NIP', 'text', 'sanitize_text_field' ),
	);
	$defaults = dworek_contact_defaults();

	foreach ( $fields as $key => $cfg ) {
		$wp_customize->add_setting(
			'dworek_' . $key,
			array(
				'default'           => $defaults[ $key ],
				'sanitize_callback' => $cfg[2],
				'transport'         => 'refresh',
			)
		);
		$wp_customize->add_control(
			'dworek_' . $key,
			array(
				'label'   => $cfg[0],
				'section' => 'dworek_contact_info',
				'type'    => $cfg[1],
			)
		);
	}
}
