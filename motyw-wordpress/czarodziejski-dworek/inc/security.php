<?php
/**
 * Bezpieczeństwo motywu „Czarodziejski Dworek".
 *
 * Wpina komplet nagłówków bezpieczeństwa HTTP (CSP, HSTS, X-Frame-Options,
 * X-Content-Type-Options, Referrer-Policy, Permissions-Policy) oraz rozsądne
 * utwardzenie WordPressa (ukrycie wersji, wyłączenie XML-RPC i edytora plików,
 * blokada enumeracji użytkowników). Wszystko działa na hostingu klienta —
 * w przeciwieństwie do GitHub Pages, gdzie nagłówków HTTP ustawić się nie da.
 *
 * Każdą politykę da się nadpisać filtrem (np. dworek_security_csp), więc
 * gdyby klient dołożył wtyczkę z innego źródła (np. mapę, czat), nie trzeba
 * grzebać w kodzie motywu — wystarczy mały snippet filtra.
 *
 * @package Czarodziejski_Dworek
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Brak bezpośredniego dostępu.
}

/* =========================================================================
 * 1. NAGŁÓWKI BEZPIECZEŃSTWA HTTP
 * ========================================================================= */

/**
 * Czy bieżące żądanie jest po HTTPS?
 *
 * Uwzględnia reverse-proxy / Cloudflare (nagłówek X-Forwarded-Proto), bo za
 * proxy `is_ssl()` potrafi zwracać false mimo że użytkownik łączy się po HTTPS.
 *
 * @return bool
 */
function dworek_is_https() {
	if ( is_ssl() ) {
		return true;
	}
	if ( isset( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) && 'https' === strtolower( sanitize_text_field( wp_unslash( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) ) ) ) {
		return true;
	}
	if ( isset( $_SERVER['HTTP_CF_VISITOR'] ) && false !== strpos( sanitize_text_field( wp_unslash( $_SERVER['HTTP_CF_VISITOR'] ) ), 'https' ) ) {
		return true;
	}
	return false;
}

/**
 * Buduje wartość Content-Security-Policy dopasowaną do motywu.
 *
 * Motyw używa: Google Fonts (CSS + pliki woff2), stylów i skryptów inline
 * (krytyczny CSS, JSON-LD, handlery onload/onfocus, bootstrap JS), map w
 * <iframe> (Google Maps + OpenStreetMap na stronie Kontakt). CSP musi to
 * przepuścić, nie łamiąc wyglądu — stąd 'unsafe-inline' dla style/script.
 *
 * @return string Treść nagłówka CSP.
 */
function dworek_security_csp() {
	$csp = array(
		"default-src 'self'",
		"base-uri 'self'",
		"object-src 'none'",
		"img-src 'self' data: https:",
		"style-src 'self' 'unsafe-inline' https://fonts.googleapis.com",
		"font-src 'self' https://fonts.gstatic.com data:",
		"script-src 'self' 'unsafe-inline'",
		"connect-src 'self'",
		"frame-src 'self' https://www.google.com https://maps.google.com https://www.openstreetmap.org https://www.youtube.com https://www.youtube-nocookie.com",
		"frame-ancestors 'self'",
		"form-action 'self'",
		"manifest-src 'self'",
		'upgrade-insecure-requests',
	);

	/**
	 * Pozwala nadpisać / rozszerzyć dyrektywy CSP bez edycji motywu.
	 *
	 * @param array $csp Tablica dyrektyw CSP.
	 */
	$csp = apply_filters( 'dworek_security_csp', $csp );

	return implode( '; ', array_filter( (array) $csp ) );
}

/**
 * Wysyła nagłówki bezpieczeństwa dla front-endu.
 *
 * Hook `send_headers` odpala się dla normalnych żądań strony. Nie ruszamy
 * panelu (wp-admin), bo niektóre ekrany WP wymagają luźniejszej CSP.
 */
function dworek_send_security_headers() {
	if ( is_admin() ) {
		return;
	}

	// HSTS — wymuszenie HTTPS na 2 lata + subdomeny + gotowość do preload.
	// Wysyłamy TYLKO gdy połączenie jest realnie po HTTPS (inaczej można
	// zablokować dostęp do strony, która jeszcze nie ma certyfikatu).
	if ( dworek_is_https() && apply_filters( 'dworek_enable_hsts', true ) ) {
		header( 'Strict-Transport-Security: max-age=63072000; includeSubDomains; preload' );
	}

	// Blokuje „MIME sniffing" — przeglądarka nie zgaduje typu pliku.
	header( 'X-Content-Type-Options: nosniff' );

	// Anty-clickjacking. CSP frame-ancestors to nowocześniejszy odpowiednik,
	// ale starsze przeglądarki rozumieją tylko ten nagłówek — wysyłamy oba.
	header( 'X-Frame-Options: SAMEORIGIN' );

	// Ile informacji o adresie wysyłać przy przejściach na inne strony.
	header( 'Referrer-Policy: strict-origin-when-cross-origin' );

	// Wyłącza dostęp do wrażliwych API przeglądarki (kamera, mikrofon, GPS…).
	header( 'Permissions-Policy: geolocation=(), microphone=(), camera=(), payment=(), usb=(), magnetometer=(), accelerometer=(), gyroscope=(), interest-cohort=()' );

	// Stary nagłówek anty-XSS — w nowych przeglądarkach lepiej wyłączony (0),
	// bo jego heurystyka bywała źródłem własnych podatności. CSP go zastępuje.
	header( 'X-XSS-Protection: 0' );

	// Izolacja okna otwierającego (ochrona przed tabnabbingiem dla _blank).
	header( 'Cross-Origin-Opener-Policy: same-origin-allow-popups' );

	// Content-Security-Policy.
	$csp = dworek_security_csp();
	if ( $csp ) {
		header( 'Content-Security-Policy: ' . $csp );
	}

	// Usuwa nagłówek zdradzający, że na zapleczu działa PHP (jeśli hosting go dodał).
	header_remove( 'X-Powered-By' );
}
add_action( 'send_headers', 'dworek_send_security_headers' );


/* =========================================================================
 * 2. WYMUSZENIE HTTPS
 * ========================================================================= */

/**
 * Przekierowuje ruch HTTP → HTTPS.
 *
 * Działa tylko, gdy adres strony w ustawieniach WP jest na https (czyli klient
 * ma już certyfikat). Inaczej nic nie robimy, żeby nie zapętlić przekierowań
 * na hostingu bez SSL. Najlepiej i tak robić to na poziomie serwera/Cloudflare,
 * ale ten bezpiecznik łapie przypadki, gdy ktoś wejdzie po http://.
 */
function dworek_force_https() {
	if ( is_admin() || wp_doing_ajax() || ( defined( 'WP_CLI' ) && WP_CLI ) ) {
		return;
	}
	if ( ! apply_filters( 'dworek_force_https', true ) ) {
		return;
	}
	// Tylko jeśli witryna jest skonfigurowana na https.
	if ( 'https' !== wp_parse_url( home_url(), PHP_URL_SCHEME ) ) {
		return;
	}
	if ( dworek_is_https() ) {
		return;
	}
	$host = isset( $_SERVER['HTTP_HOST'] ) ? sanitize_text_field( wp_unslash( $_SERVER['HTTP_HOST'] ) ) : '';
	$uri  = isset( $_SERVER['REQUEST_URI'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REQUEST_URI'] ) ) : '';
	if ( $host ) {
		wp_safe_redirect( 'https://' . $host . $uri, 301 );
		exit;
	}
}
add_action( 'template_redirect', 'dworek_force_https', 1 );


/* =========================================================================
 * 3. UTWARDZENIE WORDPRESSA (rozsądne, bez psucia funkcji)
 * ========================================================================= */

// Ukryj numer wersji WordPressa (utrudnia dobranie exploita pod wersję).
remove_action( 'wp_head', 'wp_generator' );
add_filter( 'the_generator', '__return_empty_string' );

/**
 * Usuwa parametr ?ver= zdradzający wersję z adresów CSS/JS rdzenia WP.
 *
 * @param string $src Adres zasobu.
 * @return string
 */
function dworek_remove_core_version( $src ) {
	if ( $src && false !== strpos( $src, 'ver=' ) ) {
		// Zostaw wersje motywu (filemtime) — usuwamy tylko gołą wersję WP.
		global $wp_version;
		if ( $wp_version && false !== strpos( $src, 'ver=' . $wp_version ) ) {
			$src = remove_query_arg( 'ver', $src );
		}
	}
	return $src;
}
add_filter( 'style_loader_src', 'dworek_remove_core_version', 9999 );
add_filter( 'script_loader_src', 'dworek_remove_core_version', 9999 );

// Wyłącz XML-RPC — częsty cel ataków brute-force i wzmacniacz DDoS (pingback).
add_filter( 'xmlrpc_enabled', '__return_false' );

// Usuń nagłówek X-Pingback.
function dworek_remove_pingback_header( $headers ) {
	unset( $headers['X-Pingback'] );
	return $headers;
}
add_filter( 'wp_headers', 'dworek_remove_pingback_header' );

// Usuń odnośniki RSD / WLW / shortlink z <head> (zmniejsza powierzchnię ataku).
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'wp_shortlink_wp_head' );

/**
 * Nie zdradzaj, czy błędny był login czy hasło (utrudnia zgadywanie kont).
 *
 * @return string
 */
function dworek_generic_login_error() {
	return __( 'Nieprawidłowe dane logowania.', 'czarodziejski-dworek' );
}
add_filter( 'login_errors', 'dworek_generic_login_error' );

/**
 * Blokuje enumerację użytkowników przez ?author=N (przekierowanie do loginu).
 * Utrudnia poznanie nazw kont do ataku brute-force.
 */
function dworek_block_author_enum() {
	if ( is_admin() ) {
		return;
	}
	if ( isset( $_GET['author'] ) && preg_match( '/^\d+$/', (string) wp_unslash( $_GET['author'] ) ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		wp_safe_redirect( home_url( '/' ), 301 );
		exit;
	}
}
add_action( 'template_redirect', 'dworek_block_author_enum' );

/**
 * Wyłącza publiczną listę użytkowników w REST API (/wp-json/wp/v2/users)
 * dla niezalogowanych — kolejna droga enumeracji kont.
 *
 * @param mixed           $result  Wynik dotychczasowy.
 * @param WP_REST_Server  $server  Serwer REST.
 * @param WP_REST_Request $request Żądanie.
 * @return mixed
 */
function dworek_restrict_user_rest( $result, $server, $request ) {
	if ( ! is_user_logged_in() ) {
		$route = $request->get_route();
		if ( false !== strpos( $route, '/wp/v2/users' ) ) {
			return new WP_Error(
				'rest_user_cannot_view',
				__( 'Brak dostępu.', 'czarodziejski-dworek' ),
				array( 'status' => 401 )
			);
		}
	}
	return $result;
}
add_filter( 'rest_pre_dispatch', 'dworek_restrict_user_rest', 10, 3 );

/**
 * Wyłącza edytor plików motywu/wtyczek w panelu (Wygląd → Edytor plików).
 * Gdyby konto admina zostało przejęte, atakujący nie wstrzyknie kodu z panelu.
 * Definiujemy stałą, jeśli nie ustawiono jej w wp-config.php.
 */
if ( ! defined( 'DISALLOW_FILE_EDIT' ) ) {
	define( 'DISALLOW_FILE_EDIT', true );
}
