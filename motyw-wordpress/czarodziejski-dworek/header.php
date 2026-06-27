<?php
/**
 * Nagłówek motywu: <head>, pasek nawigacji, otwarcie <main>.
 *
 * @package Czarodziejski_Dworek
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link rel="icon" href="<?php echo esc_url( get_template_directory_uri() . '/img/logo.png' ); ?>" type="image/png">
	<meta name="theme-color" content="#F97316">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a href="#main" class="btn btn--primary" style="position:absolute;left:-999px;top:0;z-index:2000" onfocus="this.style.left='8px'" onblur="this.style.left='-999px'"><?php esc_html_e( 'Przejdź do treści', 'czarodziejski-dworek' ); ?></a>

<?php if ( is_front_page() ) : ?>
<!-- ===== INTRO: logo dokuje do nagłówka przy scrollu (tylko strona główna) ===== -->
<div class="intro" id="intro" aria-hidden="true">
	<div class="intro__bg" id="introBg">
		<span class="intro__blob intro__blob--1"></span>
		<span class="intro__blob intro__blob--2"></span>
		<span class="intro__blob intro__blob--3"></span>
		<div class="intro__spectrum">
			<span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span>
		</div>
	</div>
	<img src="<?php echo esc_url( get_template_directory_uri() . '/img/logo.png' ); ?>" alt="" class="intro__logo" id="introLogo" width="466" height="312">
	<div class="intro__hint" id="introHint">
		<span class="intro__hint-pill"><?php esc_html_e( 'Przewiń w dół', 'czarodziejski-dworek' ); ?>
			<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14M6 13l6 6 6-6"/></svg>
		</span>
	</div>
</div>
<?php endif; ?>

<!-- ===== HEADER ===== -->
<header class="site-header">
	<nav class="nav container" aria-label="<?php esc_attr_e( 'Główna nawigacja', 'czarodziejski-dworek' ); ?>">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="brand" aria-label="Czarodziejski Dworek — strona główna">
			<?php if ( has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php else : ?>
				<img src="<?php echo esc_url( get_template_directory_uri() . '/img/logo.png' ); ?>" alt="Czarodziejski Dworek — przedszkole językowo-muzyczne" class="brand__img" width="160" height="107">
			<?php endif; ?>
		</a>

		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'primary',
				'container'      => false,
				'menu_id'        => 'nav-links',
				'menu_class'     => 'nav__links',
				'depth'          => 2,
				'fallback_cb'    => 'dworek_primary_menu_fallback',
			)
		);
		?>

		<button class="nav__toggle" aria-label="<?php esc_attr_e( 'Menu', 'czarodziejski-dworek' ); ?>" aria-expanded="false" aria-controls="nav-links">
			<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"><path d="M4 7h16M4 12h16M4 17h16"/></svg>
		</button>
	</nav>
</header>

<main id="main">
