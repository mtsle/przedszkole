# Czarodziejski Dworek — strona przedszkola

Strona internetowa Integracyjnego Przedszkola Niepublicznego Językowo-Muzycznego
**„Czarodziejski Dworek"** (Warszawa, Wola). Repozytorium zawiera **dwa równoległe
warianty** tej samej strony — gotowy motyw WordPress dla klienta oraz statyczną wersję
publikowaną na GitHub Pages.

🔗 **Podgląd na żywo (wersja statyczna):** https://mtsle.github.io/przedszkole/

---

## Struktura repozytorium

```
.
├── motyw-wordpress/        # GŁÓWNY DELIVERABLE — motyw WordPress dla klienta
│   └── czarodziejski-dworek/   # właściwy motyw (PHP, CSS, JS, obrazy, import treści)
├── zrodlo-html/            # statyczna wersja strony (źródło GitHub Pages)
├── narzedzia/              # skrypty pomocnicze (optymalizacja grafik itp.)
├── .github/workflows/      # automatyczna publikacja zrodlo-html na GitHub Pages
└── README.md               # ten plik
```

---

## Dwa warianty — po co?

| Wariant | Folder | Do czego | Hosting |
|---|---|---|---|
| **Motyw WordPress** | `motyw-wordpress/` | Docelowa strona klienta — pełna edycja treści przez `wp-admin`, blog, formularz, logowanie | Hosting PHP + MySQL klienta |
| **Statyczna HTML** | `zrodlo-html/` | Szybki podgląd 1:1, demo, GitHub Pages | Dowolny serwer plików / GitHub Pages |

Obie wersje mają **identyczny wygląd** (ten sam CSS i układ). Różnica: motyw WordPress
pozwala klientowi edytować treści, statyczna jest tylko do podglądu.

---

## Szybki start

### Motyw WordPress (dla klienta)
1. Pobierz `czarodziejski-dworek.zip` z **[Releases](../../releases)** (lub spakuj folder `motyw-wordpress/czarodziejski-dworek/`).
2. `Wygląd → Motywy → Dodaj nowy → Wyślij motyw` → wgraj ZIP → aktywuj.
3. Zainstaluj darmową wtyczkę **Advanced Custom Fields (ACF)**.
4. Pełna instrukcja: [`motyw-wordpress/czarodziejski-dworek/README.md`](motyw-wordpress/czarodziejski-dworek/README.md) oraz prosta instrukcja krok-po-kroku w `INSTRUKCJA-DLA-KLIENTA.md` (w paczce).

### Wersja statyczna (podgląd)
Otwórz `zrodlo-html/index.html` w przeglądarce — działa od razu, bez serwera.
Publikacja na GitHub Pages następuje automatycznie po każdym `push` do `main`.

---

## Technologie
- **Motyw:** klasyczny WordPress (PHP 7.4+), własny motyw, ACF, bez build-stepa.
- **Statyka:** czysty HTML5 + CSS3 + vanilla JS, bez frameworków.
- **SEO:** kompletne meta tagi, Open Graph, Twitter Cards, JSON-LD (schema.org).
- **Dostępność i responsywność:** WCAG AA (kontrast), pełna obsługa mobile/tablet/desktop.

## Kontakt placówki
ul. Górczewska 89, 01-401 Warszawa · tel. 690 629 501 · kontakt@czarodziejski-dworek.pl
· [facebook.com/czarodziejskidworek](https://facebook.com/czarodziejskidworek)

---

> Projekt komercyjny przygotowany dla placówki. Treści, grafiki i dane kontaktowe
> należą do „Czarodziejski Dworek".
