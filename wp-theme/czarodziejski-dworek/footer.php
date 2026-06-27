<?php
/**
 * Stopka motywu: zamknięcie <main>, sekcja <footer>, wp_footer().
 *
 * @package Czarodziejski_Dworek
 */
?>
</main>

<!-- ===== FOOTER ===== -->
<footer class="site-footer">
	<div class="container footer-grid">
		<div class="footer-brand">
			<span class="brand footer-brand__logo"><img loading="lazy" decoding="async" src="<?php echo esc_url( get_template_directory_uri() . '/img/logo.png' ); ?>" alt="Czarodziejski Dworek" width="150" height="100"></span>
			<p>Niepubliczne przedszkole językowo-muzyczne na warszawskiej Woli. Od 2003 roku wspieramy wszechstronny rozwój każdego dziecka.</p>
			<div class="social">
				<a href="https://www.facebook.com/czarodziejskidworek/" target="_blank" rel="noopener" aria-label="Facebook"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M14 9h3V6h-3c-1.7 0-3 1.3-3 3v2H9v3h2v7h3v-7h2.5l.5-3H14V9z"/></svg></a>
				<a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>" aria-label="Blog"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 016.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 014 19.5v-15A2.5 2.5 0 016.5 2z"/></svg></a>
			</div>
		</div>
		<div>
			<h2>Nawigacja</h2>
			<ul class="footer-links">
				<li><a href="<?php echo esc_url( home_url( '/o-nas/' ) ); ?>">O nas</a></li>
				<li><a href="<?php echo esc_url( home_url( '/oferta/' ) ); ?>">Program</a></li>
				<li><a href="<?php echo esc_url( home_url( '/kadra/' ) ); ?>">Kadra</a></li>
				<li><a href="<?php echo esc_url( home_url( '/wsparcie/' ) ); ?>">WWR i terapia</a></li>
				<li><a href="<?php echo esc_url( home_url( '/galeria/' ) ); ?>">Galeria</a></li>
				<li><a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>">Blog</a></li>
			</ul>
		</div>
		<div>
			<h2>Oferta</h2>
			<ul class="footer-links">
				<li><a href="<?php echo esc_url( home_url( '/oferta/' ) ); ?>">Basen</a></li>
				<li><a href="<?php echo esc_url( home_url( '/oferta/' ) ); ?>">Język angielski i francuski</a></li>
				<li><a href="<?php echo esc_url( home_url( '/oferta/' ) ); ?>">Muzyka</a></li>
				<li><a href="<?php echo esc_url( home_url( '/wsparcie/' ) ); ?>">Logopedia</a></li>
				<li><a href="<?php echo esc_url( home_url( '/wsparcie/' ) ); ?>">Integracja sensoryczna</a></li>
			</ul>
		</div>
		<div>
			<h2>Kontakt</h2>
			<ul class="footer-links">
				<li>ul. Górczewska 89, 01-401 Warszawa</li>
				<li><a href="tel:+48690629501">690 629 501</a></li>
				<li><a href="mailto:kontakt@czarodziejski-dworek.pl">kontakt@czarodziejski-dworek.pl</a></li>
				<li>NIP: 524-246-20-37</li>
			</ul>
		</div>
	</div>
	<div class="container footer-bottom">
		<span>© <span data-year><?php echo esc_html( gmdate( 'Y' ) ); ?></span> Integracyjne Przedszkole Niepubliczne Językowo-Muzyczne „Czarodziejski Dworek". Wszelkie prawa zastrzeżone.</span>
		<span>Ewidencja nr 111/PN</span>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
