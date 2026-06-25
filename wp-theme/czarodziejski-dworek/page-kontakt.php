<?php
/**
 * Szablon podstrony: Kontakt i zapisy (page-kontakt.php)
 *
 * Wygenerowano z kontakt.html — wygląd odwzorowany 1:1. Układ stały;
 * teksty można w przyszłości wystawić na pola ACF (helper dworek_field()).
 *
 * Wymaga strony WordPress o uchwycie (slug): "kontakt".
 *
 * @package Czarodziejski_Dworek
 */

get_header();
$t = get_template_directory_uri();
?>

<section class="page-hero">
  <div class="container reveal">
    <span class="eyebrow"><?php echo esc_html( dworek_field( 'page_eyebrow', 'Kontakt i zapisy' ) ); ?></span>
    <h1><?php echo esc_html( dworek_field( 'page_hero_title', 'Porozmawiajmy o Twoim dziecku' ) ); ?></h1>
    <p class="lead" style="margin:.6rem auto 0;max-width:60ch"><?php echo esc_html( dworek_field( 'page_hero_lead', 'Masz pytania lub chcesz zapisać dziecko? Wypełnij formularz albo zadzwoń — chętnie pomożemy.' ) ); ?></p>
    <p class="breadcrumb"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Start</a> / Kontakt</p>
  </div>
</section>

<section class="section">
  <div class="container split" style="align-items:start">
    <!-- Form -->
    <div class="split__content reveal">
      <div class="card">
        <h2 style="margin-bottom:.4rem">Formularz zapisu</h2>
        <p style="color:var(--muted);margin-bottom:var(--s-3)">Pola oznaczone <span style="color:var(--pink)">*</span> są wymagane.</p>
        <form data-validate novalidate method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" id="dworek-form">
          <?php dworek_form_hidden_fields(); ?>
          <div class="form-grid">
            <div class="field">
              <label for="parent">Imię i nazwisko rodzica <span class="req">*</span></label>
              <input id="parent" name="parent" type="text" autocomplete="name" required placeholder="np. Anna Kowalska">
              <span class="error-msg">To pole jest wymagane.</span>
            </div>
            <div class="field">
              <label for="child">Imię dziecka</label>
              <input id="child" name="child" type="text" placeholder="np. Zosia">
            </div>
            <div class="field">
              <label for="email">E-mail <span class="req">*</span></label>
              <input id="email" name="email" type="email" autocomplete="email" required placeholder="np. anna@example.com">
              <span class="error-msg">Podaj poprawny adres e-mail.</span>
            </div>
            <div class="field">
              <label for="phone">Telefon <span class="req">*</span></label>
              <input id="phone" name="phone" type="tel" autocomplete="tel" required placeholder="np. 600 700 800">
              <span class="error-msg">To pole jest wymagane.</span>
            </div>
            <div class="field full">
              <label for="age">Wiek dziecka</label>
              <select id="age" name="age">
                <option value="">Wybierz…</option>
                <option>2,5 – 3 lata</option>
                <option>3 – 4 lata</option>
                <option>4 – 5 lat</option>
                <option>5 – 6 lat</option>
              </select>
            </div>
            <div class="field full">
              <label for="msg">Wiadomość</label>
              <textarea id="msg" name="msg" placeholder="Napisz, w czym możemy pomóc lub o co chcesz zapytać…"></textarea>
              <span class="hint">Chętnie odpowiemy na pytania o ofertę, terapie i dostępne miejsca.</span>
            </div>
          </div>
          <button type="submit" class="btn btn--primary btn--lg" style="margin-top:var(--s-3);width:100%">Wyślij zgłoszenie</button>
          <?php echo dworek_form_status(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
          <p class="form-note" style="margin-top:var(--s-2)">Wysyłając formularz akceptujesz przetwarzanie danych w celu kontaktu.</p>
        </form>
      </div>
    </div>

    <!-- Info -->
    <div class="split__content reveal" data-delay="1">
      <span class="eyebrow">Dane kontaktowe</span>
      <h2>Jesteśmy do dyspozycji</h2>
      <p style="margin-bottom:var(--s-3)">Zapraszamy do kontaktu telefonicznego, mailowego lub osobistej wizyty w naszym przedszkolu na warszawskiej Woli.</p>

      <!-- Szybki kontakt -->
      <div class="btn-row" style="display:flex;gap:var(--s-2);flex-wrap:wrap;margin-bottom:var(--s-4)">
        <a href="tel:+48690629501" class="btn btn--primary" style="color:#fff">
          <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:-4px;margin-right:.4rem"><path d="M22 16.9v3a2 2 0 01-2.2 2 19.8 19.8 0 01-8.6-3 19.5 19.5 0 01-6-6 19.8 19.8 0 01-3-8.6A2 2 0 014.1 2h3a2 2 0 012 1.7c.1 1 .4 1.9.7 2.8a2 2 0 01-.5 2.1L8.1 9.9a16 16 0 006 6l1.3-1.3a2 2 0 012.1-.4c.9.3 1.8.6 2.8.7a2 2 0 011.8 2z"/></svg>Zadzwoń
        </a>
        <a href="mailto:kontakt@czarodziejski-dworek.pl" class="btn btn--ghost">
          <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:-4px;margin-right:.4rem"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 7l9 6 9-6"/></svg>Napisz e-mail
        </a>
        <a href="https://www.facebook.com/czarodziejskidworek/" target="_blank" rel="noopener" class="btn btn--ghost">
          <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor" style="vertical-align:-4px;margin-right:.4rem"><path d="M14 9h3V6h-3c-1.7 0-3 1.3-3 3v2H9v3h2v7h3v-7h2.5l.5-3H14V9z"/></svg>Facebook
        </a>
      </div>

      <div class="info-card">
        <span class="ic c-orange" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 12-9 12s-9-5-9-12a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg></span>
        <div><strong>Adres</strong>ul. Górczewska 89, 01-401 Warszawa (Wola)</div>
      </div>
      <div class="info-card">
        <span class="ic c-green" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.9v3a2 2 0 01-2.2 2 19.8 19.8 0 01-8.6-3 19.5 19.5 0 01-6-6 19.8 19.8 0 01-3-8.6A2 2 0 014.1 2h3a2 2 0 012 1.7c.1 1 .4 1.9.7 2.8a2 2 0 01-.5 2.1L8.1 9.9a16 16 0 006 6l1.3-1.3a2 2 0 012.1-.4c.9.3 1.8.6 2.8.7a2 2 0 011.8 2z"/></svg></span>
        <div><strong>Telefon</strong><a href="tel:+48690629501">690 629 501</a></div>
      </div>
      <div class="info-card">
        <span class="ic c-sky" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 7l9 6 9-6"/></svg></span>
        <div><strong>E-mail</strong><a href="mailto:kontakt@czarodziejski-dworek.pl">kontakt@czarodziejski-dworek.pl</a></div>
      </div>
      <div class="info-card">
        <span class="ic c-purple" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg></span>
        <div><strong>Godziny otwarcia</strong>Poniedziałek – Piątek: 7:00 – 18:00</div>
      </div>

      <div class="card" style="padding:0;overflow:hidden;margin-top:var(--s-3)">
        <iframe title="Mapa Google — Czarodziejski Dworek, ul. Górczewska 89, Warszawa" src="https://www.google.com/maps?q=ul.%20G%C3%B3rczewska%2089%2C%2001-401%20Warszawa&output=embed" style="width:100%;height:300px;border:0;display:block" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
    </div>
  </div>
</section>

<!-- Dojazd i parking -->
<section class="section sec-warm">
  <div class="container reveal">
    <span class="eyebrow" style="display:block;margin:0 auto var(--s-2);width:fit-content">Jak do nas trafić</span>
    <h2 style="text-align:center;margin-bottom:var(--s-2)">Dojazd i parking</h2>
    <p class="lead" style="text-align:center;max-width:64ch;margin:0 auto var(--s-5)">Znajdujemy się na warszawskiej Woli, przy ul. Górczewskiej 89 — jednej z głównych arterii dzielnicy z dogodnym dojazdem.</p>
    <div class="split" style="align-items:stretch;gap:var(--s-4)">
      <div class="card split__content" style="height:100%">
        <div class="info-card" style="margin-bottom:0">
          <span class="ic c-green" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="3" width="16" height="16" rx="3"/><path d="M4 11h16M8 19l-2 2M16 19l2 2"/><circle cx="8" cy="15" r="1"/><circle cx="16" cy="15" r="1"/></svg></span>
          <div>
            <strong>Komunikacją miejską</strong>
            Wzdłuż ul. Górczewskiej kursują tramwaje i autobusy, dzięki czemu dojazd z różnych części miasta jest wygodny. Najdogodniejsze połączenie najłatwiej sprawdzić w wyszukiwarce trasy (np. jakdojade.pl) dla adresu Górczewska 89.
          </div>
        </div>
      </div>
      <div class="card split__content" style="height:100%">
        <div class="info-card" style="margin-bottom:0">
          <span class="ic c-orange" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 13l1.5-4.5A2 2 0 018.4 7h7.2a2 2 0 011.9 1.5L19 13M5 13h14v5H5v-5z"/><circle cx="8" cy="16" r="1"/><circle cx="16" cy="16" r="1"/></svg></span>
          <div>
            <strong>Samochodem</strong>
            Do przedszkola dojadą Państwo bezpośrednio ul. Górczewską. W sprawie najdogodniejszego miejsca na podwiezienie i odebranie dziecka chętnie pomożemy — wystarczy zadzwonić: <a href="tel:+48690629501">690 629 501</a>.
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Dokumenty do pobrania -->
<section class="section">
  <div class="container reveal">
    <span class="eyebrow" style="display:block;margin:0 auto var(--s-2);width:fit-content">Do pobrania</span>
    <h2 style="text-align:center;margin-bottom:var(--s-2)">Dokumenty do pobrania</h2>
    <p class="lead" style="text-align:center;max-width:62ch;margin:0 auto var(--s-5)">Sprawdź aktualne informacje dotyczące naszego przedszkola!</p>
    <div class="docs-grid">

      <div class="doc-cat card">
        <h3>Karta zgłoszeniowa</h3>
        <ul class="doc-list">
          <li><a class="doc-link" href="<?php echo $t; ?>/dokumenty/karta-informacyjna-o-dziecku.pdf" target="_blank" rel="noopener" download><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><path d="M14 2v6h6"/><path d="M9 13h6M9 17h4"/></svg><span>Karta informacyjna o dziecku</span><span class="doc-ext">PDF</span></a></li>
        </ul>
      </div>

      <div class="doc-cat card">
        <h3>WWR</h3>
        <ul class="doc-list">
          <li><a class="doc-link" href="<?php echo $t; ?>/dokumenty/wniosek-oswiadczenie-wwr.pdf" target="_blank" rel="noopener" download><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><path d="M14 2v6h6"/><path d="M9 13h6M9 17h4"/></svg><span>Wniosek i oświadczenie – WWR</span><span class="doc-ext">PDF</span></a></li>
        </ul>
      </div>

      <div class="doc-cat card">
        <h3>Regulamin przedszkola</h3>
        <ul class="doc-list">
          <li><a class="doc-link" href="<?php echo $t; ?>/dokumenty/regulamin-przedszkola.pdf" target="_blank" rel="noopener" download><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><path d="M14 2v6h6"/><path d="M9 13h6M9 17h4"/></svg><span>Regulamin przedszkola</span><span class="doc-ext">PDF</span></a></li>
        </ul>
      </div>

      <div class="doc-cat card">
        <h3>Statut</h3>
        <ul class="doc-list">
          <li><a class="doc-link" href="<?php echo $t; ?>/dokumenty/statut-przedszkola.pdf" target="_blank" rel="noopener" download><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><path d="M14 2v6h6"/><path d="M9 13h6M9 17h4"/></svg><span>Statut Integracyjnego Przedszkola Niepublicznego „Czarodziejski Dworek"</span><span class="doc-ext">PDF</span></a></li>
        </ul>
      </div>

      <div class="doc-cat card" style="grid-column:1 / -1">
        <h3>RODO</h3>
        <ul class="doc-list">
          <li><a class="doc-link" href="<?php echo $t; ?>/dokumenty/klauzula-informacyjna-rodo.pdf" target="_blank" rel="noopener" download><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><path d="M14 2v6h6"/><path d="M9 13h6M9 17h4"/></svg><span>Klauzula informacyjna dla klientów Integracyjnego Przedszkola Niepublicznego „Czarodziejski Dworek"</span><span class="doc-ext">PDF</span></a></li>
          <li><a class="doc-link" href="<?php echo esc_url( home_url( '/polityka-prywatnosci/' ) ); ?>"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="16" rx="2"/><path d="M3 9h18M8 4v5"/></svg><span>Polityka prywatności – www.czarodziejski-dworek.pl</span><span class="doc-ext">Strona</span></a></li>
          <li><a class="doc-link" href="<?php echo $t; ?>/dokumenty/polityka-ochrony-dzieci-2024.pdf" target="_blank" rel="noopener" download><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><path d="M14 2v6h6"/><path d="M9 13h6M9 17h4"/></svg><span>Polityka oraz procedury ochrony dzieci przed krzywdzeniem (2024)</span><span class="doc-ext">PDF</span></a></li>
        </ul>
      </div>

    </div>
  </div>
</section>

<?php
get_footer();
