# Czarodziejski Dworek — wersja statyczna (HTML)

Statyczna wersja strony przedszkola — czysty HTML5 + CSS3 + vanilla JS, bez frameworków
i bez build-stepa. To **źródło publikowane na GitHub Pages**.

🔗 Na żywo: https://mtsle.github.io/przedszkole/

## Uruchomienie lokalne
Otwórz `index.html` w przeglądarce — działa od razu, bez serwera.

## Zawartość
- `index.html` + podstrony: `o-nas`, `oferta` (Program), `kadra`, `wsparcie` (WWR i terapia),
  `galeria`, `blog` (+ 7 wpisów `blog-*.html`), `kontakt`, `polityka-prywatnosci`, `zdalne`.
- `css/style.css` — pełny styl (claymorphism, responsywny, kontrast WCAG AA).
- `js/` — `main.js` (interakcje), `gallery-data.js`, `blog-data.js` (dane galerii/bloga).
- `img/` — grafiki (zoptymalizowane WebP/PNG/SVG), `dokumenty/` — PDF-y do pobrania.
- `manifest.json` + ikony — podstawy PWA. `robots.txt` + `sitemap.xml` — SEO.
- `googlecb*.html` — plik weryfikacyjny Google Search Console (nie edytować).

## Publikacja
Workflow `.github/workflows/pages.yml` publikuje ten folder na GitHub Pages
automatycznie po każdym `push` do gałęzi `main`.

> Wygląd jest identyczny z motywem WordPress (`../motyw-wordpress/`). Ta wersja służy
> do szybkiego podglądu i dema; pełna edycja treści jest w wariancie WordPress.
