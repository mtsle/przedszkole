# Czarodziejski Dworek — strona przedszkola

Strona WWW niepublicznego przedszkola językowo-muzycznego **„Czarodziejski Dworek"**
(Warszawa, Wola). Repozytorium zawiera **dwie wersje** projektu:

1. **Statyczna strona HTML** (w korzeniu repo) — pierwotny projekt w czystym HTML + CSS + JS, wielostronicowy.
2. **Motyw WordPress** (`wp-theme/czarodziejski-dworek/`) — produkcyjny, klasyczny motyw PHP odwzorowujący
   stronę **1:1**, w pełni edytowalny przez natywny panel `wp-admin`. To aktualny deliverable do wdrożenia u klienta.

---

## 1. Statyczna strona HTML (korzeń repo)

Podstrony: `index.html` (główna), `o-nas.html`, `oferta.html`, `wsparcie.html`, `kadra.html`,
`galeria.html`, `kontakt.html`, `polityka-prywatnosci.html` oraz wpisy bloga `blog-*.html`.

```
css/style.css   — wspólne style
js/main.js      — wspólny skrypt (modale kadry, galeria, filtry bloga itp.)
img/            — zdjęcia i grafiki
dokumenty/      — pliki PDF do pobrania
```

**Uruchomienie:** otwórz `index.html` w przeglądarce — nie wymaga serwera ani budowania.

---

## 2. Motyw WordPress (`wp-theme/czarodziejski-dworek/`)

Klasyczny motyw PHP (bez Node/build). Cały CMS to natywny WordPress — bez własnych paneli i logowania.
Treści edytowalne (wpisy, Kadra jako typ treści, sekcje Hero i nagłówki przez ACF), układ stały.
Formularz kontaktowy wysyła e-mail natywnie przez `wp_mail()`.

Pełna instrukcja wdrożenia dla klienta: **`wp-theme/czarodziejski-dworek/README.md`**.

Podgląd lokalny (wymaga Node.js, bez instalacji WordPressa):
```bash
cd wp-theme
npx @wp-playground/cli@latest start \
  --mount=czarodziejski-dworek:/wordpress/wp-content/themes/czarodziejski-dworek \
  --blueprint=blueprint.json
```

> Uwaga: gotowy ZIP motywu (`wp-theme/czarodziejski-dworek.zip`) to artefakt budowania i **nie jest
> wersjonowany** (patrz `.gitignore`) — generuje się przez spakowanie folderu `czarodziejski-dworek`.

---

## Dane kontaktowe placówki
ul. Górczewska 89, 01-401 Warszawa (Wola) · tel. 690 629 501 · kontakt@czarodziejski-dworek.pl
