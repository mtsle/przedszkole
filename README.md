# 🏰 Czarodziejski Dworek — strona przedszkola

Kompletna, produkcyjna strona internetowa **Integracyjnego Przedszkola Niepublicznego
Językowo-Muzycznego „Czarodziejski Dworek"** w Warszawie (dzielnica Wola, ul. Górczewska 89).
Placówka działa od **2003 roku** — małe grupy, nauka przez zabawę, języki, muzyka i basen
w czesnym oraz bezpłatne wczesne wspomaganie rozwoju (WWR) i terapie.

To repozytorium zawiera **dwa równoległe warianty** tej samej strony: gotowy **motyw WordPress**
do oddania klientowi oraz **statyczną wersję** publikowaną na GitHub Pages (podgląd 1:1).

🔗 **Podgląd na żywo:** **https://mtsle.github.io/przedszkole/**

---

## ✨ Co potrafi ta strona

Strona to nie wizytówka — to pełny, wielopodstronowy serwis przedszkola:

| Podstrona | Zawartość |
|---|---|
| **Start** | Hero ze zdjęciami, atuty, program w skrócie, opinie rodziców, wezwania do działania |
| **O nas** | Historia od 2003, wartości, misja, certyfikat NVC (Porozumienie Bez Przemocy) |
| **Program** | Pełna oferta: język angielski i francuski, umuzykalnienie, basen, zajęcia twórcze |
| **Kadra** | Sylwetki **18 osób** w 4 grupach, biogramy w oknie modalnym |
| **WWR i terapia** | Wczesne wspomaganie rozwoju, logopedia, integracja sensoryczna, terapie |
| **Galeria** | Zdjęcia z życia przedszkola z filtrami kategorii i powiększaniem (lightbox) |
| **Blog** | Wpis wyróżniony + filtrowanie po kategoriach + wyszukiwarka |
| **Kontakt** | Działający formularz (e-mail do właściciela), dane, mapa dojazdu |
| **Zdalne** | Logowanie do panelu (natywne `wp-login` w wersji WordPress) |

**Klient edytuje całą treść sam** przez panel WordPressa (`wp-admin`) — każdy nagłówek,
akapit, karta, lista, opinia i FAQ to pole z polskim opisem. Układ i wygląd pozostają stałe.

---

## 🏆 Jakość (mierzalna)

| Obszar | Stan |
|---|---|
| **Wydajność (PageSpeed mobile)** | Większość podstron **95–100**, galeria 67 → **100** |
| **Layout (CLS)** | Stabilny układ — brak „skakania" treści podczas ładowania |
| **SEO** | **100/100** — meta tagi, Open Graph, Twitter Cards, dane strukturalne JSON-LD (schema.org) |
| **Dostępność (A11y)** | WCAG AA — kontrast, etykiety, nawigacja klawiaturą, `prefers-reduced-motion` |
| **Bezpieczeństwo** | Nagłówki HTTP: CSP, HSTS, X-Frame-Options, Referrer-Policy i in.; utwardzony WordPress |
| **Responsywność** | Pełna obsługa telefon / tablet / desktop, mobilny pasek „Zadzwoń / Zapisz" |
| **PWA** | Manifest + ikony (instalowalna na telefonie) |

---

## 📦 Struktura repozytorium

```
.
├── motyw-wordpress/            # GŁÓWNY DELIVERABLE — motyw WordPress dla klienta
│   └── czarodziejski-dworek/   #   właściwy motyw (PHP, CSS, JS, obrazy, import treści)
├── zrodlo-html/                # statyczna wersja strony (źródło GitHub Pages)
├── narzedzia/                  # skrypty pomocnicze (optymalizacja grafik, backupy)
├── .github/workflows/          # automatyczna publikacja zrodlo-html na GitHub Pages
├── ZABEZPIECZENIA.md           # opis zabezpieczeń i konfiguracji (HTTPS, Cloudflare, backupy)
├── INSTRUKCJA-DLA-KLIENTA.md   # prosta instrukcja krok-po-kroku
└── README.md                   # ten plik
```

---

## 🔀 Dwa warianty — po co?

| Wariant | Folder | Do czego | Hosting |
|---|---|---|---|
| **Motyw WordPress** | `motyw-wordpress/` | Docelowa strona klienta — pełna edycja treści przez `wp-admin`, blog, formularz, logowanie | Hosting PHP + MySQL klienta |
| **Statyczna HTML** | `zrodlo-html/` | Szybki podgląd 1:1, demo, GitHub Pages | Dowolny serwer plików / GitHub Pages |

Obie wersje mają **identyczny wygląd** (ten sam CSS i układ). Motyw WordPress pozwala
klientowi edytować treści; statyczna służy do podglądu i jest publikowana automatycznie.

---

## 🚀 Szybki start

### Motyw WordPress (dla klienta)
1. Pobierz `czarodziejski-dworek.zip` z **[Releases](../../releases)**.
2. `Wygląd → Motywy → Dodaj nowy → Wyślij motyw` → wgraj ZIP → aktywuj.
3. Zainstaluj darmową wtyczkę **Advanced Custom Fields (ACF)** (`Wtyczki → Dodaj nowy`).
4. Ustawienia: język polski, strona główna = „Strona główna", wpisy = „Blog", permalinki = „Nazwa wpisu".
5. Pełna instrukcja: [`INSTRUKCJA-DLA-KLIENTA.md`](INSTRUKCJA-DLA-KLIENTA.md) oraz [`motyw-wordpress/czarodziejski-dworek/README.md`](motyw-wordpress/czarodziejski-dworek/README.md).

### Wersja statyczna (podgląd)
Otwórz `zrodlo-html/index.html` w przeglądarce — działa od razu, bez serwera.
Publikacja na GitHub Pages następuje automatycznie po każdym `push` do `main`.

---

## 🛠️ Technologie
- **Motyw:** klasyczny WordPress (PHP 7.4+), własny motyw bez build-stepa, pola treści przez **ACF**.
- **Statyka:** czysty **HTML5 + CSS3 + vanilla JS**, zero frameworków, zero zależności.
- **Wydajność:** krytyczny CSS inline, `font-display`, `fetchpriority` na obrazach LCP, lazy-loading, zoptymalizowane WebP.
- **SEO:** meta description, canonical, Open Graph, Twitter Cards, JSON-LD (Preschool / LocalBusiness + BreadcrumbList).
- **Formularz:** natywny `wp_mail` (nonce + honeypot), odbiorca ustawiany w panelu.

---

## 🧒 O placówce
**Integracyjne Przedszkole Niepubliczne Językowo-Muzyczne „Czarodziejski Dworek"**
- 📍 ul. Górczewska 89, 01-401 Warszawa (Wola) · ewidencja nr 111/PN, od 2003 r.
- 🕖 Czynne **7:00–18:00** · grupy maks. **14 dzieci** + 2 nauczycieli
- 🎶 W czesnym: **basen, język angielski i francuski, umuzykalnienie**
- ☎️ tel. **690 629 501** · ✉️ **kontakt@czarodziejski-dworek.pl**
- 🌐 [facebook.com/czarodziejskidworek](https://facebook.com/czarodziejskidworek)

---

## 📄 Wydania
Historia paczek motywu i zmian: zakładka **[Releases](../../releases)**.
Najnowsze wydanie zawiera motyw gotowy do wgrania wraz z zabezpieczeniami i optymalizacją wydajności.
