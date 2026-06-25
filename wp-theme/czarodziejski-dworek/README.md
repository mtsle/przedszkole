# Czarodziejski Dworek — motyw WordPress

Klasyczny, produkcyjny motyw WordPress odwzorowujący stronę przedszkola **1:1** z projektu HTML/CSS/JS.
Cały CMS to **natywny WordPress** (`wp-admin` / `wp-login.php`) — bez własnych paneli i logowania.
Treści edytowalne; układ stały. Działa na zwykłym hostingu **PHP + MySQL**.

---

## 1. Wymagania

- WordPress 6.0+ (zalecany najnowszy)
- PHP 7.4+ (zalecany 8.1+)
- MySQL / MariaDB (standard każdego hostingu pod WordPress)
- **Advanced Custom Fields (ACF)** — darmowa wtyczka, **wymagana do edycji** sekcji Hero, nagłówków podstron oraz pól Kadry (rola, grupa, biogram). Instalacja: `Wtyczki → Dodaj nową → szukaj „Advanced Custom Fields" → Zainstaluj → Włącz`.

> Bez ACF motyw też działa i wygląda 1:1 (pola pokazują treść domyślną), ale klient nie może wtedy edytować tych pól. Blog i podstawowe treści (tytuły, obrazki) są edytowalne także bez ACF.

---

## 2. Instalacja motywu (5 minut)

1. Spakuj folder `czarodziejski-dworek` do pliku ZIP **albo** wgraj go przez FTP.
2. **Wgranie przez panel:** `Wygląd → Motywy → Dodaj nowy → Wyślij motyw` → wybierz ZIP → *Zainstaluj*.
   **Wgranie przez FTP:** skopiuj folder `czarodziejski-dworek` do `/wp-content/themes/`.
3. `Wygląd → Motywy →` aktywuj **Czarodziejski Dworek**.

---

## 3. Import treści (wpisy bloga + strony) — 2 minuty

W paczce jest gotowy plik importu: **`_import/tresci-czarodziejski-dworek.xml`**.

1. `Narzędzia → Importuj → WordPress` → *Zainstaluj/Uruchom importer*.
2. Wskaż plik `tresci-czarodziejski-dworek.xml` → *Wyślij plik i zaimportuj*.
3. Przypisz autora (może być istniejący admin). **Nie** musisz zaznaczać pobierania załączników.

Zaimportuje to **7 wpisów bloga**, **wszystkie strony** (O nas, Program, Kadra, WWR i terapia, Galeria,
Blog, Kontakt, Polityka prywatności, Strona główna) oraz **18 osób Kadry** (z rolą, grupą i biogramem) —
wszystko z poprawnymi uchwytami (slugami).

> Obrazy w treści wskazują na pliki motywu (ścieżki typu `/wp-content/themes/czarodziejski-dworek/img/...`),
> więc działają na każdej domenie bez przenoszenia plików do biblioteki mediów.

---

## 4. Ustawienia po imporcie (3 kliknięcia)

1. **Strona główna i blog:** `Ustawienia → Czytanie` →
   - *Strona główna wyświetla:* **stała strona**
   - *Strona główna:* **Strona główna**
   - *Strona wpisów:* **Blog**
2. **Permalinki (ładne adresy):** `Ustawienia → Bezpośrednie odnośniki` → **Nazwa wpisu** (`/%postname%/`) → *Zapisz*.

To wszystko — strona wygląda i działa jak projekt HTML.

---

## 5. Menu i podstrona „Zdalne" (logowanie do WordPress)

**Menu działa od razu** (wbudowane menu zapasowe) i zawiera pozycję **„Zdalne"** ustawioną
**przed „Kontakt"**, która prowadzi do **prawdziwego ekranu logowania WordPress** (`wp-login.php`).
Po zalogowaniu klient trafia do panelu `wp-admin` (kokpit + CMS) i edytuje stronę.

Aby zbudować **własne menu** (zalecane docelowo):

1. `Wygląd → Menu → Utwórz nowe menu`.
2. Dodaj strony w kolejności: Start (Strona główna), O nas, Program, Kadra, WWR i terapia, Galeria, Blog.
3. **Dodaj „Zdalne":** sekcja *Łącza własne* → **Adres URL:** `/wp-login.php` , **Tekst:** `Zdalne` → *Dodaj do menu*.
   Przeciągnij „Zdalne" **przed** Kontakt.
4. Dodaj Kontakt, a na końcu (opcjonalnie) „Zapisz dziecko" jako *Łącze własne* do `/kontakt/`
   i nadaj mu klasę CSS `nav__cta` (włącz *Opcje ekranu → Klasy CSS*), aby wyglądało jak przycisk.
5. *Położenie wyświetlania:* zaznacz **Menu główne (nagłówek)** → *Zapisz menu*.

---

## 6. Jak klient edytuje stronę (przez wp-admin)

- **Wpisy bloga / aktualności:** `Wpisy → Dodaj nowy`. Nowe wpisy automatycznie pojawiają się na stronie
  Blog oraz w sekcji „Aktualności" na stronie głównej (3 najnowsze).
- **Obraz wpisu:** w edytorze wpisu po prawej *Obraz wyróżniający* → ustaw zdjęcie (pojawi się na kafelku).
  Bez obrazu kafelek wygląda jak czysta kafelka tekstowa (jak na stronie głównej).
- **Sekcja Hero (strona główna):** z aktywną wtyczką **ACF** — edytuj stronę „Strona główna", pola:
  nadtytuł, nagłówek, tekst, etykieta przycisku. W nagłówku słowo w `[nawiasach]` zostanie podświetlone kolorem.
- **Nagłówki podstron (O nas, Program, WWR, Galeria, Kontakt…):** z ACF — na każdej stronie pola
  „Nadtytuł / Nagłówek / Tekst". Puste pole = tekst domyślny (wygląd 1:1).
- **Kadra (nauczyciele i specjaliści):** menu **Kadra** w panelu → `Dodaj osobę`. Pola: tytuł = imię i nazwisko,
  **Rola**, **Grupa** (Dyrekcja / Nauczyciele / Lektorzy / Specjaliści), **Biogram** (każdy akapit w osobnej linii),
  zdjęcie = *Obraz wyróżniający*. Osoba pojawi się automatycznie w odpowiedniej sekcji na stronie „Kadra",
  a klik na karcie otwiera okienko z biogramem. Kolejność: pole *Atrybuty → Kolejność*.
- **Pozostałe sekcje stron:** układ stały (zgodnie z ustaleniem) — treść wbudowana w motyw dla wierności 1:1.

---

## 7. Formularz kontaktowy — wysyłka e-mail

Formularz na stronie **Kontakt** **wysyła wiadomości e-mail** natywnie (bez wtyczek), przez `wp_mail()`.
Ma walidację (po stronie przeglądarki i serwera) oraz zabezpieczenia anti-spam (nonce + honeypot).

- **Adres odbiorcy:** `Wygląd → Dostosuj → „Formularz kontaktowy" → E-mail odbiorcy zgłoszeń`
  (domyślnie `kontakt@czarodziejski-dworek.pl`). **Nowy właściciel ustawia tu swój adres** — bez ruszania kodu.
- Po wysłaniu nadawca widzi komunikat „wiadomość została wysłana"; w mailu jest `Reply-To` na adres osoby piszącej.
- **Doręczalność:** zwykłe hostingi wysyłają `wp_mail()` poprawnie. Jeśli maile miałyby trafiać do spamu
  lub nie dochodzić, zainstaluj darmową wtyczkę **WP Mail SMTP** i podłącz skrzynkę (np. tę z hostingu) —
  to standardowy krok zwiększający doręczalność.

> Uwaga: w **lokalnym podglądzie** (Playground) e-maile nie wychodzą (brak serwera poczty) — formularz
> pokazuje sukces dla demonstracji. Realna wysyłka działa po wgraniu na hosting z prawdziwą domeną.

---

## 8. Struktura motywu

```
czarodziejski-dworek/
├── style.css              Nagłówek motywu (wymagany przez WP)
├── functions.php          Konfiguracja: enqueue CSS/JS, menu, ACF-helper, JSON-LD
├── header.php             Nagłówek + nawigacja (wp_nav_menu) + intro
├── footer.php             Stopka
├── front-page.php         Strona główna 1:1 (Hero z ACF + najnowsze wpisy)
├── page.php               Domyślny szablon strony
├── page-{slug}.php        Strony 1:1: o-nas, oferta, kadra, wsparcie, galeria, kontakt, polityka-prywatnosci
├── single.php             Pojedynczy wpis bloga
├── archive.php            Archiwa (kategorie/tagi/daty)
├── index.php              Lista wpisów (Blog) + zapas
├── 404.php                Strona „nie znaleziono"
├── inc/acf-fields.php     Definicje pól ACF (rejestrowane w kodzie)
├── css/ js/ img/          Zasoby (styl, skrypty, 258 obrazów) — z projektu HTML
├── dokumenty/             Pliki PDF do pobrania
└── _import/               Plik importu treści (WXR)
```

---

## 9. (Dla developera) Podgląd lokalny bez instalacji

Masz Node.js? Możesz odpalić motyw na prawdziwym WordPress lokalnie:

```bash
cd wp-theme
npx @wp-playground/cli@latest start \
  --mount=czarodziejski-dworek:/wordpress/wp-content/themes/czarodziejski-dworek \
  --blueprint=blueprint.json
```

Otwórz adres z konsoli (np. http://127.0.0.1:8881). To **prawdziwy WordPress** (PHP-wasm) — wyłącznie do
podglądu/testów. Na hostingu klienta motyw działa na zwykłym PHP, **bez Node**.

---

© Integracyjne Przedszkole Niepubliczne Językowo-Muzyczne „Czarodziejski Dworek". Ewidencja nr 111/PN.
