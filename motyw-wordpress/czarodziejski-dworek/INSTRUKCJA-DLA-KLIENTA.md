# Czarodziejski Dworek — instrukcja obsługi strony

Witaj! Twoja strona działa na **WordPressie** — najpopularniejszym systemie do prowadzenia stron.
Cała treść jest edytowalna samodzielnie, bez programisty. Poniżej krok po kroku, jak to robić.

> **Logowanie do panelu:** wejdź na `https://twoja-domena.pl/wp-admin/` i zaloguj się swoim
> loginem i hasłem. Po zalogowaniu widzisz czarne menu po lewej stronie — to Twój panel.

---

## 1. Pierwsze uruchomienie (robi się RAZ — zwykle przy wdrożeniu)

Jeśli stronę wgrywa firma/informatyk, ten rozdział jest dla niej. Jeśli robisz to sam:

1. **Motyw:** Wygląd → Motywy → Dodaj nowy → Wyślij motyw → wybierz plik
   `czarodziejski-dworek.zip` → Zainstaluj → **Włącz**.
2. **WAŻNE — wtyczka do edycji treści:** Wtyczki → Dodaj nową → w wyszukiwarce wpisz
   **Advanced Custom Fields** → przy wtyczce o tej nazwie (autor: WP Engine) kliknij
   **Zainstaluj**, potem **Włącz**. Bez niej strona działa, ale nie zobaczysz pól do edycji treści.
3. **Strona główna i blog:** Ustawienia → Czytanie → „Strona główna wyświetla" = **Strona statyczna**;
   *Strona główna* = **Strona główna**, *Strona wpisów* = **Blog** → Zapisz.
4. **Ładne adresy:** Ustawienia → Bezpośrednie odnośniki → zaznacz **Nazwa wpisu** → Zapisz.
5. **Język:** Ustawienia → Ogólne → Język witryny = **Polski** → Zapisz.
6. **E-mail z formularzy:** Wygląd → Dostosuj → „Formularz kontaktowy" → wpisz adres e-mail,
   na który mają przychodzić zgłoszenia ze strony.

---

## 2. Jak edytować treść podstron (O nas, Program, WWR, Kontakt, Galeria)

To jest serce strony. Działa identycznie dla każdej podstrony:

1. W panelu kliknij **Strony** (po lewej).
2. Najedź na stronę, np. **O nas**, i kliknij **Edytuj**.
3. **Przewiń w dół, pod główny edytor.** Zobaczysz panel z **zakładkami** —
   np. „Nasza historia", „Misja i wartości", „Atmosfera"…
4. Wejdź w zakładkę, zmień tekst w polach (są opisane po polsku).
5. Kliknij niebieski przycisk **Aktualizuj** (prawy górny róg).
6. Otwórz stronę na żywo i odśwież (Ctrl+F5) — zmiana jest widoczna.

### Dwa typy pól, które spotkasz
- **Pole tekstowe / „jak w Wordzie" (WYSIWYG):** zwykłe pisanie. Możesz pogrubić tekst itp.
- **Lista — „każda linia = jeden punkt":** w takim polu **każdy nowy wiersz** to osobny punkt
  na liście (np. odhaczany „✓"). Chcesz dodać punkt? Dopisz nową linię. Usunąć? Skasuj linię.

> **Układ i wygląd są stałe** — edytujesz tylko treść. Nie da się przypadkiem „rozbić" strony.
> Jeśli wyczyścisz pole do końca, wróci tekst domyślny.

---

## 3. Dane kontaktowe — zmieniasz RAZ, zmienia się wszędzie

Telefon, e-mail, adres i godziny są w jednym miejscu:

1. **Wygląd → Dostosuj → „Dane kontaktowe"**.
2. Zmień, co trzeba (np. numer telefonu) → **Opublikuj**.
3. Zmiana pojawi się automatycznie w stopce i na kartach kontaktowych.

---

## 4. Blog / Aktualności

- **Nowy wpis:** Wpisy → Dodaj nowy → wpisz tytuł i treść → **Opublikuj**.
- Najnowsze 3 wpisy pokazują się automatycznie na stronie głównej w sekcji „Aktualności".
- Zdjęcie wpisu: po prawej „Obrazek wyróżniający" → ustaw obrazek.

---

## 5. Kadra (nauczyciele i specjaliści)

- W menu po lewej masz osobną zakładkę **Kadra**.
- Dodaj/edytuj osobę: imię i nazwisko (tytuł), pola **Rola**, **Grupa**, **Biogram**,
  oraz zdjęcie (Obrazek wyróżniający). Bez zdjęcia pokażą się inicjały.

---

## 6. Najczęstsze pytania

**Zmieniłem tekst, ale na stronie stary.** Odśwież stronę z czyszczeniem pamięci: **Ctrl+F5**.

**Nie widzę zakładek z polami pod stroną.** Upewnij się, że wtyczka **Advanced Custom Fields**
jest zainstalowana i włączona (Wtyczki). Patrz rozdział 1, punkt 2.

**Formularz nie wysyła maili.** Sprawdź adres w „Dostosuj → Formularz kontaktowy". Jeśli maile
trafiają do spamu, poproś hosting/informatyka o wtyczkę „WP Mail SMTP" (poprawia doręczalność).

**Czy mogę zepsuć stronę?** Edycja treści jest bezpieczna. Nie zmieniaj kodu motywu ani ustawień,
których nie rozumiesz. W razie wątpliwości pytaj osoby, która wdrażała stronę.

---

*Strona zbudowana na autorskim, lekkim motywie WordPress „Czarodziejski Dworek" —
bez page-buildera i zbędnych wtyczek, w pełni edytowalna z panelu.*
