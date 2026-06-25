<?php
/**
 * Obsługa formularzy kontaktowych (natywnie, bez wtyczek).
 *
 * - Wysyłka przez wp_mail() na adres odbiorcy ustawiany w panelu
 *   (Wygląd → Dostosuj → „Formularz kontaktowy"), domyślnie kontakt@czarodziejski-dworek.pl.
 *   Dzięki temu nowy właściciel strony łatwo ustawia własny e-mail.
 * - Zabezpieczenia: nonce + honeypot (anti-spam).
 * - Działa też bez JavaScriptu (zwykły POST → admin-post.php → powrót z komunikatem).
 *
 * @package Czarodziejski_Dworek
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* Adres odbiorcy zgłoszeń (edytowalny w Customizerze). */
function dworek_form_recipient() {
	$email = get_theme_mod( 'dworek_form_email', 'kontakt@czarodziejski-dworek.pl' );
	if ( ! is_email( $email ) ) {
		$email = get_option( 'admin_email' );
	}
	return $email;
}

/* Ustawienie w Dostosuj: e-mail odbiorcy. */
add_action( 'customize_register', 'dworek_contact_customizer' );
function dworek_contact_customizer( $wp_customize ) {
	$wp_customize->add_section(
		'dworek_contact',
		array(
			'title'    => 'Formularz kontaktowy',
			'priority' => 160,
		)
	);
	$wp_customize->add_setting(
		'dworek_form_email',
		array(
			'default'           => 'kontakt@czarodziejski-dworek.pl',
			'sanitize_callback' => 'sanitize_email',
			'transport'         => 'refresh',
		)
	);
	$wp_customize->add_control(
		'dworek_form_email',
		array(
			'label'       => 'E-mail odbiorcy zgłoszeń',
			'description' => 'Na ten adres trafiają wiadomości wysłane z formularzy na stronie.',
			'section'     => 'dworek_contact',
			'type'        => 'email',
		)
	);
}

/* Obsługa wysyłki (zalogowani i niezalogowani). */
add_action( 'admin_post_nopriv_dworek_contact', 'dworek_handle_contact' );
add_action( 'admin_post_dworek_contact', 'dworek_handle_contact' );
function dworek_handle_contact() {
	$back = wp_get_referer() ? wp_get_referer() : home_url( '/kontakt/' );
	$go   = function ( $state ) use ( $back ) {
		wp_safe_redirect( add_query_arg( 'dworek', $state, $back ) . '#dworek-form' );
		exit;
	};

	// Honeypot — bot wypełnił ukryte pole → udajemy sukces, nie wysyłamy.
	if ( ! empty( $_POST['dworek_hp'] ) ) {
		$go( 'ok' );
	}

	// Nonce.
	if ( ! isset( $_POST['dworek_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['dworek_nonce'] ) ), 'dworek_contact' ) ) {
		$go( 'err' );
	}

	// Pola (oba formularze: kontakt + szybki na stronie głównej).
	$name  = sanitize_text_field( wp_unslash( $_POST['parent'] ?? $_POST['qname'] ?? '' ) );
	$email = sanitize_email( wp_unslash( $_POST['email'] ?? $_POST['qemail'] ?? '' ) );
	$phone = sanitize_text_field( wp_unslash( $_POST['phone'] ?? $_POST['qphone'] ?? '' ) );
	$child = sanitize_text_field( wp_unslash( $_POST['child'] ?? '' ) );
	$age   = sanitize_text_field( wp_unslash( $_POST['age'] ?? '' ) );
	$msg   = sanitize_textarea_field( wp_unslash( $_POST['msg'] ?? $_POST['qmsg'] ?? '' ) );

	// Walidacja: wymagane imię + (telefon lub e-mail); e-mail jeśli podany musi być poprawny.
	if ( '' === $name || ( '' === $phone && '' === $email ) ) {
		$go( 'err' );
	}
	if ( ! empty( $_POST['email'] ?? $_POST['qemail'] ?? '' ) && ! is_email( $email ) ) {
		$go( 'err' );
	}

	// Treść maila.
	$lines   = array();
	$lines[] = 'Nowe zgłoszenie z formularza na stronie:';
	$lines[] = '';
	$lines[] = 'Imię i nazwisko: ' . $name;
	if ( $phone ) { $lines[] = 'Telefon: ' . $phone; }
	if ( $email ) { $lines[] = 'E-mail: ' . $email; }
	if ( $child ) { $lines[] = 'Imię dziecka: ' . $child; }
	if ( $age ) { $lines[] = 'Wiek dziecka: ' . $age; }
	if ( $msg ) {
		$lines[] = '';
		$lines[] = 'Wiadomość:';
		$lines[] = $msg;
	}
	$lines[] = '';
	$lines[] = '— wysłano ze strony ' . home_url( '/' );
	$body    = implode( "\n", $lines );

	$to      = dworek_form_recipient();
	$subject = 'Zgłoszenie ze strony — ' . $name;

	$host    = preg_replace( '#^www\.#', '', (string) wp_parse_url( home_url(), PHP_URL_HOST ) );
	$headers = array( 'Content-Type: text/plain; charset=UTF-8' );
	if ( $host ) {
		$headers[] = 'From: Strona Czarodziejski Dworek <no-reply@' . $host . '>';
	}
	if ( is_email( $email ) ) {
		$headers[] = 'Reply-To: ' . $name . ' <' . $email . '>';
	}

	$sent = wp_mail( $to, $subject, $body, $headers );
	$go( $sent ? 'ok' : 'fail' );
}

/**
 * Komunikat statusu nad/pod formularzem (po powrocie z wysyłki) + element dla JS.
 * Wstawiać w miejsce dawnego <p class="form-status">.
 */
function dworek_form_status() {
	$state = isset( $_GET['dworek'] ) ? sanitize_key( wp_unslash( $_GET['dworek'] ) ) : '';
	$base  = 'margin-top:var(--s-2);border-radius:var(--r-md);padding:.9rem 1rem;font-weight:600;';

	if ( 'ok' === $state ) {
		return '<p class="form-status" role="status" aria-live="polite" style="display:block;background:var(--cream-2);border:2px solid var(--primary-soft);color:var(--primary-dark);' . $base . '">Dziękujemy! Twoja wiadomość została wysłana — odezwiemy się najszybciej, jak to możliwe.</p>';
	}
	if ( 'err' === $state || 'fail' === $state ) {
		$txt = ( 'fail' === $state )
			? 'Nie udało się wysłać wiadomości. Spróbuj ponownie lub zadzwoń: 690 629 501.'
			: 'Uzupełnij wymagane pola (imię oraz telefon lub e-mail) i spróbuj ponownie.';
		return '<p class="form-status" role="status" aria-live="polite" style="display:block;background:#FDECEC;border:2px solid var(--pink);color:#9b2c2c;' . $base . '">' . esc_html( $txt ) . '</p>';
	}
	// Domyślnie ukryty (obsługiwany też przez JS).
	return '<p class="form-status" role="status" aria-live="polite" style="display:none;background:var(--cream-2);border:2px solid var(--primary-soft);color:var(--primary-dark);' . $base . '"></p>';
}

/*
 * Lokalny podgląd (Playground) nie ma serwera poczty — symulujemy sukces wysyłki,
 * żeby pokazać pełny przepływ formularza (zielony komunikat „wysłano").
 * NA HOSTINGU KLIENTA (prawdziwa domena) ten filtr jest NIEAKTYWNY — wtedy wp_mail()
 * wysyła e-mail naprawdę. Działa tylko dla 127.0.0.1 / localhost.
 */
add_filter( 'pre_wp_mail', 'dworek_local_mail_sim', 10, 2 );
function dworek_local_mail_sim( $short, $atts ) {
	$host = (string) wp_parse_url( home_url(), PHP_URL_HOST );
	if ( in_array( $host, array( '127.0.0.1', 'localhost', '::1' ), true ) ) {
		return true; // udajemy sukces tylko lokalnie
	}
	return $short;
}

/* Ukryte pola formularza: action + nonce + honeypot. */
function dworek_form_hidden_fields() {
	echo '<input type="hidden" name="action" value="dworek_contact">';
	wp_nonce_field( 'dworek_contact', 'dworek_nonce' );
	echo '<div aria-hidden="true" style="position:absolute;left:-9999px;width:1px;height:1px;overflow:hidden"><label>Nie wypełniaj <input type="text" name="dworek_hp" tabindex="-1" autocomplete="off"></label></div>';
}
