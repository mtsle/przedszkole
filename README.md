# Czarodziejski Dworek — strona przedszkola

Strona internetowa Integracyjnego Przedszkola Niepublicznego Językowo-Muzycznego
**„Czarodziejski Dworek"** (Warszawa, Wola). Repozytorium zawiera **produkcyjny motyw WordPress**
(do wdrożenia na hostingu klienta) oraz źródłową, statyczną wersję HTML jako referencję.

## 📂 Struktura repozytorium

```
.
├─ motyw-wordpress/                 ← GŁÓWNY PRODUKT (do wdrożenia)
│  ├─ czarodziejski-dworek/         ← motyw WordPress (kopiuje się do wp-content/themes/)
│  │  ├─ *.php, css/, js/, img/     ← szablony + zasoby (wygląd 1:1 z HTML)
│  │  ├─ inc/                       ← logika: ACF, CPT Kadra, formularz, SEO
│  │  ├─ _import/                   ← import treści (WXR): wpisy + strony + Kadra
│  │  └─ README.md                  ← INSTRUKCJA WDROŻENIA krok po kroku
│  └─ narzedzia/                    ← podgląd lokalny (WordPress Playground)
│     ├─ URUCHOM-WORDPRESS-LOKALNIE.bat
│     └─ blueprint.json
│
└─ zrodlo-html/                     ← źródłowa statyczna wersja HTML (referencja)
   └─ index.html, css/, js/, img/, dokumenty/ …
```

## 🚀 Wdrożenie (skrót)

Pełna instrukcja: **[motyw-wordpress/czarodziejski-dworek/README.md](motyw-wordpress/czarodziejski-dworek/README.md)**

1. Spakuj folder `motyw-wordpress/czarodziejski-dworek/` do ZIP (paczka motywu).
2. WordPress: `Wygląd → Motywy → Dodaj nowy → Wyślij motyw` → aktywuj.
3. Zainstaluj darmową wtyczkę **Advanced Custom Fields (ACF)**.
4. `Narzędzia → Importuj → WordPress` → wskaż `_import/tresci-czarodziejski-dworek.xml`
   (zaciągnie wpisy bloga, strony i kadrę).
5. `Ustawienia → Czytanie`: strona główna = „Strona główna", strona wpisów = „Blog".
   `Ustawienia → Bezpośrednie odnośniki` → „Nazwa wpisu".

Cały CMS to **natywny WordPress** (`wp-admin` / `wp-login.php`) — bez własnych paneli logowania.

## 🧩 Co potrafi motyw

- Wygląd **1:1** z projektu (styl claymorphism), w pełni responsywny (mobile-first).
- **Edytowalne z panelu:** wpisy bloga, **Kadra** (typ treści, 18 osób), nagłówki podstron i sekcja Hero (ACF).
- **Blog** z wyróżnionym wpisem, filtrami kategorii i wyszukiwarką (dane z WordPressa).
- **Formularz kontaktowy** z realną wysyłką e-mail (`wp_mail`, nonce + honeypot); adres odbiorcy w `Wygląd → Dostosuj`.
- **SEO:** meta description, Open Graph, Twitter Cards, dane strukturalne JSON-LD
  (Preschool/LocalBusiness, WebSite, BreadcrumbList, Article), breadcrumbs, canonical, sitemap.

## 🖥️ Podgląd lokalny (opcjonalnie, dla developera)

Wymaga Node.js. Dwuklik **`motyw-wordpress/narzedzia/URUCHOM-WORDPRESS-LOKALNIE.bat`**
uruchamia prawdziwy WordPress (WordPress Playground) na `http://127.0.0.1:8881`
(login `admin` / `password`). To wyłącznie środowisko testowe — na hostingu motyw działa na zwykłym PHP.

## 🏷️ Wersje

- **v1.0.0** — pierwsze produkcyjne wydanie motywu (patrz: *Releases / Tags*).

---

© Integracyjne Przedszkole Niepubliczne Językowo-Muzyczne „Czarodziejski Dworek". Ewidencja nr 111/PN.
