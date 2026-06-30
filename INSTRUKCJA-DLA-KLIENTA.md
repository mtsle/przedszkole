# Czarodziejski Dworek — instrukcja krok po kroku (od zera do działającej strony)

Witaj! Ten dokument prowadzi Cię **za rękę**, od samego początku, aż Twoja nowa strona
będzie działać w internecie. Nie musisz znać się na komputerach. Wystarczy robić **po kolei**
to, co napisane. Każdy trudniejszy krok ma jedno zdanie „**Po co to:**", żebyś wiedział, dlaczego.

> **Najważniejsza zasada:** rób kroki **po kolei** i nie przeskakuj. Jeśli coś się nie zgadza
> z tym, co widzisz na ekranie — zatrzymaj się i napisz do nas (kontakt na końcu). Lepiej zapytać
> niż klikać na oślep.

Czas: jeśli masz już hosting i WordPressa — całość zajmie **ok. 30–45 minut**.
Jeśli zaczynasz zupełnie od zera (kupno hostingu) — dodatkowo **ok. 1 godzina**.

---

## Spis treści

1. [Co dostałeś w paczce](#1-co-dostałeś-w-paczce)
2. [Słowniczek na start (6 pojęć)](#2-słowniczek-na-start)
3. [Mapa drogi — co Cię czeka](#3-mapa-drogi)
4. [Wariant A — nie masz jeszcze hostingu ani WordPressa](#4-wariant-a--nie-masz-jeszcze-hostingu-ani-wordpressa)
5. [Wariant B — masz już hosting z WordPressem](#5-wariant-b--masz-już-hosting-z-wordpressem)
6. [Krok 1 — wgranie motywu (wyglądu strony)](#6-krok-1--wgranie-motywu)
7. [Krok 2 — wtyczka Advanced Custom Fields (wymagana)](#7-krok-2--wtyczka-advanced-custom-fields)
8. [Krok 3 — import treści (cała strona za jednym razem)](#8-krok-3--import-treści)
9. [Krok 4 — trzy ustawienia, które trzeba zrobić](#9-krok-4--trzy-ustawienia)
10. [Krok 5 — menu strony](#10-krok-5--menu)
11. [Krok 6 — e-mail z formularza kontaktowego](#11-krok-6--e-mail-z-formularza)
12. [Krok 7 — dane kontaktowe (raz → zmienia się wszędzie)](#12-krok-7--dane-kontaktowe)
13. [Jak na co dzień edytować treść strony](#13-jak-na-co-dzień-edytować-treść)
14. [Bezpieczeństwo — zrób to przed pokazaniem strony światu](#14-bezpieczeństwo)
15. [Podmiana starej strony na tej samej domenie (UWAGA!)](#15-podmiana-starej-strony)
16. [Najczęstsze pytania i problemy](#16-najczęstsze-pytania-i-problemy)
17. [Pomoc / kontakt](#17-pomoc--kontakt)

---

## 1. Co dostałeś w paczce

W folderze, który dostałeś, są **4 ważne rzeczy**:

| Plik / folder | Co to jest |
|---|---|
| **`czarodziejski-dworek.zip`** | To **Twoja strona** (tzw. motyw WordPress) — cały wygląd, układ, grafiki. Ten plik wgrasz do WordPressa. **Nie rozpakowuj go ręcznie** — WordPress sam to zrobi. |
| **`tresci-czarodziejski-dworek.xml`** | Gotowa **treść strony** (wszystkie podstrony, wpisy bloga, 18 osób kadry). Wgrasz ją jednym kliknięciem, żeby nie pisać wszystkiego od nowa. Leży w środku paczki, w folderze `_import`. |
| **`INSTRUKCJA-DLA-KLIENTA.md`** | Ten dokument, który właśnie czytasz. |
| **`ZABEZPIECZENIA.md`** | Osobny, bardziej szczegółowy poradnik o bezpieczeństwie (HTTPS, Cloudflare). Sięgniesz po niego w rozdziale 14, jeśli zechcesz iść dalej. |

> **Po co to:** najpierw wgrasz **wygląd** (ZIP), potem **treść** (XML). Dwa pliki, dwa kroki.

---

## 2. Słowniczek na start

Sześć słów, które wystarczą, żeby wszystko niżej było jasne:

- **Domena** — adres Twojej strony, np. `czarodziejski-dworek.pl`. To, co ludzie wpisują w przeglądarce.
- **Hosting** — „działka w internecie", komputer, na którym mieszka Twoja strona przez całą dobę.
  Płacisz za niego zwykle raz na rok.
- **WordPress** — darmowy program do prowadzenia stron. Twoja nowa strona jest na nim zbudowana.
  Po polsku czasem pisany „wordpress" — to to samo.
- **Motyw** — wygląd strony (kolory, układ, grafiki). Twój motyw to plik `czarodziejski-dworek.zip`.
- **Wtyczka** — mały dodatek, który dokłada WordPressowi funkcję. Potrzebujesz **jednej** (rozdział 7).
- **Panel / wp-admin** — Twój „kokpit do zarządzania stroną". Wchodzisz na `https://twoja-domena.pl/wp-admin/`
  i logujesz się loginem i hasłem. Stamtąd zmieniasz wszystko.

---

## 3. Mapa drogi

Przejdziesz dokładnie tę ścieżkę (rozdziały 4–15):

```
HOSTING + WORDPRESS  →  MOTYW (wygląd)  →  WTYCZKA  →  TREŚĆ  →  USTAWIENIA
       →  MENU  →  E-MAIL FORMULARZA  →  BEZPIECZEŃSTWO  →  PODMIANA STAREJ STRONY
```

Najpierw wybierz, od czego zaczynasz:

- **Nie masz jeszcze hostingu/WordPressa?** → zacznij od **Wariantu A** (rozdział 4).
- **Masz już hosting z gotowym, pustym WordPressem?** → przejdź od razu do **Wariantu B** (rozdział 5).

Potem dla obu wariantów dalej jest tak samo (rozdziały 6 i kolejne).

---

## 4. Wariant A — nie masz jeszcze hostingu ani WordPressa

Jeśli dotąd Twoja stara strona stała „gdzieś", a Ty nie wiesz gdzie — i tak warto przeczytać ten
rozdział, bo nową stronę najlepiej postawić na hostingu **pod WordPressa**.

### 4.1. Wybierz hosting

Praktycznie każdy polski hosting nadaje się pod WordPressa. Szukaj oferty, która ma:

- **PHP** (wersja 8.0 lub nowsza) i **bazę danych MySQL/MariaDB** — to standard, każdy hosting WordPress to ma,
- **darmowy certyfikat SSL** (czyli „kłódkę"/HTTPS) — dziś dają go wszyscy,
- **instalator WordPressa „jednym kliknięciem"** (czasem nazywany „Aplikacje", „Auto-instalator", „Softaculous").

> **Po co to:** WordPress potrzebuje PHP i bazy danych, żeby działać. Instalator „1 klik" oszczędza Ci
> ręcznej instalacji. Certyfikat SSL = zielona kłódka i brak ostrzeżeń „strona niezabezpieczona".

Popularne, sprawdzone hostingi w Polsce (przykładowo, kolejność dowolna): **dhosting, cyber_Folks /
home.pl, nazwa.pl, Zenbox, LH.pl, OVH**. Wystarczy najtańszy pakiet „pod WordPress".

### 4.2. Podepnij domenę

- Jeśli **kupujesz nową domenę** — zwykle dokładasz ją do koszyka przy zakupie hostingu, gotowe.
- Jeśli **masz już domenę starej strony** i chcesz ją zachować (to Twój przypadek — patrz rozdział 15)
  — na razie **nie przepinaj jej jeszcze**. Najpierw zbuduj nową stronę spokojnie (na adresie
  tymczasowym od hostingu), a domenę przełączysz na końcu. Tak jest bezpieczniej.

### 4.3. Zainstaluj WordPressa (jednym kliknięciem)

1. Zaloguj się do **panelu hostingu** (dane logowania dostajesz mailem po zakupie).
2. Znajdź sekcję **„Aplikacje" / „Instalator WordPress" / „Softaculous"** i kliknij **Zainstaluj WordPress**.
3. Wybierz adres (domenę albo adres tymczasowy), ustaw **login administratora i mocne hasło**.
4. **Zapisz sobie login i hasło** w bezpiecznym miejscu — będą Ci potrzebne za chwilę i później.
5. Poczekaj 1–2 minuty, aż instalator skończy.

> **Po co to:** to zakłada „pusty" WordPress — czystą stronę, na którą za chwilę wgrasz Twój wygląd i treść.

Po tym kroku masz **pusty WordPress**. Wejdź na `https://twój-adres/wp-admin/`, zaloguj się — powinieneś
zobaczyć **czarne menu po lewej stronie** (to panel). Jeśli tak — przejdź do **rozdziału 6**.

---

## 5. Wariant B — masz już hosting z WordPressem

1. Wejdź w przeglądarce na **`https://twoja-domena.pl/wp-admin/`** (zamień `twoja-domena.pl` na swój adres).
2. Zaloguj się **loginem i hasłem administratora** (te, które ustawiłeś/dostałeś przy zakładaniu WordPressa).
3. Po zalogowaniu widzisz **czarne menu po lewej** — to Twój panel. To znaczy, że WordPress działa.

> **Jak poznać, że to „czysty" WordPress?** Strona wygląda jak prosty, domyślny szablon (zwykle motyw
> typu „Twenty Twenty-…"), bez Twoich grafik. To normalne — zaraz wgrasz właściwy wygląd.

Przejdź do **rozdziału 6**.

---

## 6. Krok 1 — wgranie motywu

To wgranie **wyglądu** Twojej strony (plik `czarodziejski-dworek.zip`).

1. W panelu po lewej: **Wygląd → Motywy**.
2. U góry kliknij **Dodaj nowy**, potem **Wyślij motyw**.
3. Kliknij **Wybierz plik** i wskaż plik **`czarodziejski-dworek.zip`** z paczki.
4. Kliknij **Zainstaluj**, poczekaj chwilę, a następnie kliknij **Włącz**.

> **Po co to:** „Włącz" sprawia, że WordPress zaczyna używać Twojego wyglądu zamiast domyślnego.
> ⚠️ **Nie rozpakowuj pliku ZIP ręcznie** — wgrywasz go w całości, WordPress sam go rozpakuje.

Po włączeniu strona może jeszcze wyglądać „pusto" — bo nie ma w niej treści. Treść dodasz w rozdziale 8.

---

## 7. Krok 2 — wtyczka Advanced Custom Fields

To **jedyna wymagana wtyczka**. Jest **darmowa**.

1. W panelu po lewej: **Wtyczki → Dodaj nową**.
2. W polu wyszukiwania (prawy górny róg) wpisz: **Advanced Custom Fields**.
3. Znajdź wtyczkę o **dokładnie tej nazwie** (autor: **WP Engine**), kliknij **Zainstaluj**, potem **Włącz**.

> **Po co to:** ta wtyczka odblokowuje **pola do edycji treści** w niektórych miejscach (sekcja powitalna
> na stronie głównej, nagłówki podstron, opisy kadry). **Bez niej strona też działa i wygląda dobrze**
> (pokazuje treść domyślną), ale nie zobaczysz tych pól do edycji. Dlatego ją instalujemy.

---

## 8. Krok 3 — import treści

Teraz jednym ruchem wgrasz **całą gotową treść** (podstrony, blog, kadrę), żeby nie pisać jej od zera.

1. W panelu po lewej: **Narzędzia → Importuj**.
2. Przy pozycji **WordPress** kliknij **Zainstaluj** (jeśli się pojawi), a potem **Uruchom importer**.
3. Kliknij **Wybierz plik** i wskaż plik **`tresci-czarodziejski-dworek.xml`** (jest w paczce, w folderze `_import`).
4. Kliknij **Wyślij plik i zaimportuj**.
5. Na następnym ekranie: w polu autora możesz zostawić **istniejącego administratora** (czyli siebie).
   **Nie musisz** zaznaczać „Pobierz i zaimportuj załączone pliki".
6. Kliknij **Wyślij**.

> **Po co to:** to wgrywa gotowe **7 wpisów bloga**, **wszystkie podstrony** (O nas, Program, Kadra,
> WWR i terapia, Galeria, Blog, Kontakt, Polityka prywatności, Strona główna) i **18 osób kadry**
> (z rolą, grupą i biogramem). Grafiki są już w motywie, więc wszystko od razu się wyświetla.

---

## 9. Krok 4 — trzy ustawienia

Trzy szybkie ustawienia i strona zacznie wyglądać jak trzeba.

### 9.1. Strona główna i blog
**Ustawienia → Czytanie**:
- „Twoja strona główna wyświetla" = **Strona statyczna**,
- *Strona główna* = **Strona główna**,
- *Strona wpisów* = **Blog**,
- kliknij **Zapisz zmiany**.

> **Po co to:** mówisz WordPressowi, że pierwsza strona ma być Twoją zaprojektowaną „Stroną główną",
> a wpisy bloga mają trafiać na podstronę „Blog".

### 9.2. Ładne adresy (permalinki)
**Ustawienia → Bezpośrednie odnośniki** → zaznacz **Nazwa wpisu** → **Zapisz zmiany**.

> **Po co to:** adresy podstron będą czytelne (np. `/o-nas/` zamiast `/?p=123`). Ważne też dla Google.

### 9.3. Język
**Ustawienia → Ogólne** → „Język witryny" = **Polski** → **Zapisz zmiany**.

---

## 10. Krok 5 — menu

**Dobra wiadomość: menu działa od razu**, samo z siebie — nie musisz nic robić. Zawiera już wszystkie
pozycje (O nas, Program, Kadra, WWR, Galeria, Blog, Kontakt) oraz pozycję **„Zdalne"**, która prowadzi
do ekranu logowania do WordPressa.

Jeśli kiedyś zechcesz **ułożyć menu po swojemu** (to opcjonalne):
1. **Wygląd → Menu → Utwórz nowe menu**, nadaj nazwę, kliknij **Utwórz menu**.
2. Po lewej zaznacz strony i kliknij **Dodaj do menu**, potem ułóż je przeciąganiem.
3. Aby dodać „Zdalne": rozwiń **Łącza własne** → Adres URL: `/wp-login.php`, Tekst: `Zdalne` → **Dodaj do menu**.
4. Na dole zaznacz **Menu główne (nagłówek)** → **Zapisz menu**.

---

## 11. Krok 6 — e-mail z formularza

Na podstronie **Kontakt** jest formularz. Trzeba ustawić, **na jaki adres** mają przychodzić zgłoszenia.

1. **Wygląd → Dostosuj → „Formularz kontaktowy"**.
2. W polu **E-mail odbiorcy zgłoszeń** wpisz swój adres (np. `kontakt@czarodziejski-dworek.pl`).
3. Kliknij **Opublikuj**.

> **Po co to:** gdy ktoś wyśle formularz, wiadomość trafi na ten adres. Formularz ma już wbudowaną
> ochronę przed spamem — nic więcej nie musisz ustawiać.

**Sprawdź to:** wejdź na podstronę Kontakt na żywej stronie, wyślij testową wiadomość do siebie i sprawdź,
czy przyszła (zajrzyj też do folderu **SPAM**). Jeśli maile nie dochodzą lub lądują w spamie — patrz
rozdział 16 („Formularz nie wysyła maili").

---

## 12. Krok 7 — dane kontaktowe

Telefon, e-mail, adres i godziny są w **jednym miejscu** — zmieniasz raz, zmienia się na całej stronie.

1. **Wygląd → Dostosuj → „Dane kontaktowe"**.
2. Zmień, co trzeba (np. numer telefonu) → **Opublikuj**.
3. Zmiana pojawi się automatycznie w stopce i na kartach kontaktowych.

---

## 13. Jak na co dzień edytować treść

To robisz już zawsze, kiedy zechcesz coś zmienić. Jest proste i bezpieczne.

### A) Edycja podstrony — sposób identyczny dla KAŻDEJ strony
1. W panelu po lewej kliknij **Strony**.
2. Najedź na stronę (np. **O nas**) i kliknij **Edytuj**.
3. **Przewiń w dół, pod główny edytor** — zobaczysz panel z **zakładkami** po polsku
   (np. „Nasza historia", „Misja i wartości").
4. Wejdź w zakładkę, zmień tekst w polach.
5. Kliknij niebieski przycisk **Aktualizuj** (prawy górny róg).
6. Otwórz stronę na żywo i odśwież klawiszami **Ctrl+F5** — zmiana będzie widoczna.

> **Po co to:** dla każdej podstrony robisz **dokładnie to samo** — wchodzisz w nią przez **Strony →
> Edytuj** i zmieniasz pola w zakładkach na dole. Nie musisz uczyć się każdej strony osobno.

### B) Wszystkie podstrony, które możesz edytować
Wszystkie edytujesz tak samo (sposób A wyżej). Oto pełna lista i co na nich znajdziesz:

| Podstrona | Co edytujesz w zakładkach na dole |
|---|---|
| **Strona główna** | Sekcja powitalna (tzw. Hero): nadtytuł, duży nagłówek, tekst, napis na przycisku. Sekcja „Aktualności" pobiera 3 najnowsze wpisy bloga **automatycznie**. |
| **O nas** | Nagłówek strony (nadtytuł / nagłówek / tekst) oraz pola opisowe w zakładkach (np. historia, misja, atmosfera). |
| **Program** (oferta) | Nagłówek strony + opisy programu w zakładkach. |
| **Kadra** | Nagłówek strony. Same osoby dodajesz osobno — patrz punkt **D) Kadra** niżej. |
| **WWR i terapia** (wsparcie) | Nagłówek strony + pola opisowe w zakładkach. |
| **Galeria** | Nagłówek strony. Zdjęcia w galerii są częścią motywu (układ stały). |
| **Kontakt** | Nagłówek strony. Telefon/adres/godziny zmieniasz **w jednym miejscu** (rozdz. 12), a adres odbiorcy formularza w rozdz. 11. |
| **Blog** | To lista wpisów — same wpisy dodajesz przez **Wpisy** (punkt **C** niżej). |
| **Polityka prywatności** | Treść strony. |

> **Pole puste = tekst domyślny.** Jeśli zostawisz pole puste (lub wyczyścisz je do końca), na stronie
> pokaże się ładny tekst domyślny. Nie da się przez to „zepsuć" wyglądu.

**Dwa typy pól, które spotkasz w zakładkach:**
- **Pole tekstowe „jak w Wordzie":** zwykłe pisanie, można pogrubić itd.
- **Lista „każda linia = jeden punkt":** każdy **nowy wiersz** to osobny punkt (np. odhaczany „✓").
  Chcesz dodać punkt — dopisz linię. Usunąć — skasuj linię.

### C) Blog / aktualności — pełny opis
To tu dodajesz nowości (np. „Dzień Dziecka", „Zapisy na nowy rok"). Wpisy bloga **NIE** są w „Strony" —
masz je w osobnej zakładce **Wpisy**.

**Gdzie się pokazują:** każdy opublikowany wpis trafia na podstronę **Blog**, a **3 najnowsze**
pojawiają się też automatycznie na **stronie głównej** w sekcji „Aktualności".

**Dodanie nowego wpisu — krok po kroku:**
1. W panelu po lewej: **Wpisy → Dodaj nowy**.
2. U góry wpisz **tytuł** (np. „Pikink rodzinny 2026").
3. Pod tytułem wpisz **treść** — piszesz normalnie, jak w Wordzie. Możesz pogrubić tekst, zrobić listę,
   wstawić zdjęcie (przycisk **+** → „Obraz").
4. Po prawej stronie znajdź **„Obrazek wyróżniający"** → **Ustaw obrazek wyróżniający** → wybierz lub
   wgraj zdjęcie. **Po co to:** to zdjęcie pokazuje się na kafelku wpisu na liście i na stronie głównej.
   Bez niego kafelek będzie sam tekst.
5. Kliknij niebieski przycisk **Opublikuj** (prawy górny róg), a potem jeszcze raz **Opublikuj** dla
   potwierdzenia.
6. Wejdź na podstronę Blog i odśwież (**Ctrl+F5**) — nowy wpis jest na górze listy.

**Edycja istniejącego wpisu:**
1. **Wpisy** → najedź na wpis → **Edytuj**.
2. Zmień tytuł / treść / obrazek wyróżniający.
3. Kliknij **Aktualizuj**.

**Ukrycie lub usunięcie wpisu:**
- **Schować, ale zachować:** w edytorze wpisu, po prawej przy „Status", przełącz na **Szkic** → **Aktualizuj**.
  Wpis zniknie ze strony, ale zostanie u Ciebie do późniejszego użycia.
- **Usunąć na stałe:** **Wpisy** → najedź na wpis → **Kosz**. (Z kosza można jeszcze odzyskać.)

> **Wskazówka:** rób krótkie tytuły i dodawaj obrazek wyróżniający — wtedy lista bloga i strona główna
> wyglądają najładniej.

### D) Kadra (nauczyciele i specjaliści)
- W menu po lewej masz osobną zakładkę **Kadra**.
- Dodaj/edytuj osobę: tytuł = imię i nazwisko, pola **Rola**, **Grupa**, **Biogram**, oraz zdjęcie
  („Obrazek wyróżniający"). Bez zdjęcia pokażą się inicjały. Kolejność: pole *Atrybuty → Kolejność*.

> **Układ i wygląd są stałe** — edytujesz tylko treść, nie da się przypadkiem „rozbić" strony.
> Jeśli wyczyścisz pole do końca, wróci tekst domyślny.

---

## 14. Bezpieczeństwo

Zrób to **zanim pokażesz stronę światu** (lub tuż po podmianie domeny z rozdziału 15). Strona ma już
wbudowaną sporą część zabezpieczeń w kodzie — tu są rzeczy, które **musisz kliknąć Ty**.

### 14.1. HTTPS — „kłódka" (NAJWAŻNIEJSZE)
1. W **panelu hostingu** znajdź sekcję **SSL / Certyfikaty** i włącz **darmowy certyfikat Let's Encrypt**
   dla swojej domeny (zwykle jeden przycisk „Włącz SSL / Wygeneruj certyfikat").
2. W WordPressie sprawdź: **Ustawienia → Ogólne** — oba adresy („Adres WordPressa" i „Adres witryny")
   powinny zaczynać się od **`https://`**. Jeśli nie — popraw na `https://` i zapisz.
3. Wejdź na stronę i sprawdź, czy w pasku przeglądarki jest **kłódka**.

> **Po co to:** bez HTTPS przeglądarki pokazują „strona niezabezpieczona", a Google obniża pozycję.
> Strona ma w kodzie automatyczne wymuszenie HTTPS — włącza się samo, gdy certyfikat już działa.

### 14.2. Kopie zapasowe (backupy)
1. **Wtyczki → Dodaj nową** → wyszukaj **UpdraftPlus** → **Zainstaluj** → **Włącz**.
2. **Ustawienia → UpdraftPlus** → ustaw **automatyczny backup** (np. co tydzień) i podłącz miejsce
   na kopie (np. Dysk Google lub Dropbox).
3. Zrób od razu **jedną kopię ręcznie** („Utwórz kopię teraz”).

> **Po co to:** gdyby cokolwiek się zepsuło, przywracasz stronę w kilka minut. Zasada **3-2-1**:
> miej kopię w co najmniej **dwóch różnych miejscach** (np. hosting + Dysk Google).

### 14.3. Podstawowe nawyki (utwardzenie)
- Używaj **mocnego, unikalnego hasła** do panelu (nie „admin123").
- **Aktualizuj** WordPressa i wtyczki, gdy panel o tym przypomina (kropka przy „Aktualizacje”).
- **Nie instaluj przypadkowych wtyczek** „z internetu" — tylko z oficjalnego katalogu i tylko te, których naprawdę potrzebujesz.

### 14.4. Dla zaawansowanych / informatyka
Pełne, szczegółowe kroki (Cloudflare jako darmowa tarcza, HSTS, lista nagłówków bezpieczeństwa,
jak sprawdzić ocenę na securityheaders.com) są w osobnym pliku **`ZABEZPIECZENIA.md`** w paczce.
Jeśli masz informatyka — przekaż mu ten plik; jeśli nie — sama strona i tak ma już komplet zabezpieczeń
w kodzie, a punkty 14.1–14.3 wyżej w zupełności wystarczą na start.

---

## 15. Podmiana starej strony

To Twój przypadek: **nowa strona ma zastąpić starą pod tym samym adresem** (domeną). Zrób to **w tej
kolejności**, żeby niczego nie stracić i żeby odwiedzający nie zobaczyli „rozsypanej" strony.

> ⚠️ **NAJPIERW ZRÓB KOPIĘ STAREJ STRONY.** Zanim cokolwiek przełączysz:
> 1. W panelu starego hostingu zrób **pełną kopię zapasową** starej strony (jeśli się da — pobierz ją na swój komputer).
> 2. Jeśli stara strona to też WordPress — zainstaluj na niej UpdraftPlus i pobierz backup.
> Dzięki temu, gdyby coś poszło nie tak, **zawsze wrócisz do starej wersji**.

Bezpieczna kolejność:

1. **Zbuduj nową stronę na adresie tymczasowym** (rozdziały 4–14) — takim, jaki daje hosting,
   albo na poddomenie typu `nowa.twoja-domena.pl`. Stara strona przez ten czas dalej działa normalnie.
2. **Przetestuj nową stronę** na tym tymczasowym adresie: klikaj po wszystkich podstronach, sprawdź menu,
   wyślij testowy formularz, sprawdź na telefonie.
3. Dopiero gdy nowa strona jest gotowa — **przełącz domenę** na nowy WordPress. W zależności od sytuacji:
   - jeśli wszystko jest na **tym samym, nowym hostingu** — w panelu hostingu wskaż domenę na nowy WordPress
     (zmiana „domeny głównej” / „katalogu strony”), albo poproś o to wsparcie hostingu;
   - jeśli zmieniasz hosting — przepnij **domenę (DNS)** na nowy hosting (dane do tego daje nowy hosting;
     zmiana może „rozejść się” po internecie do ok. 24 godzin).
4. **Po podmianie sprawdź na żywej domenie:**
   - czy jest **kłódka / HTTPS** (rozdział 14.1),
   - czy **formularz** wysyła maila (wyślij testowy),
   - czy **menu** i wszystkie podstrony działają,
   - czy **telefon, adres i godziny** w stopce się zgadzają.

> **Po co ta kolejność:** odwiedzający i Google nigdy nie zobaczą niedokończonej strony — przełączasz
> dopiero gotowy efekt, a starą wersję masz zachowaną na wszelki wypadek.

---

## 16. Najczęstsze pytania i problemy

**Zmieniłem tekst, ale na stronie widać stary.**
Odśwież stronę z czyszczeniem pamięci: naciśnij **Ctrl+F5**. Jeśli nadal stary — sprawdź, czy na pewno
kliknąłeś **Aktualizuj / Opublikuj**.

**Nie widzę zakładek z polami pod stroną.**
Upewnij się, że wtyczka **Advanced Custom Fields** jest zainstalowana i **włączona**
(**Wtyczki** → sprawdź na liście). Patrz rozdział 7.

**Formularz nie wysyła maili (albo lądują w spamie).**
Najpierw sprawdź adres w **Wygląd → Dostosuj → „Formularz kontaktowy"**. Jeśli maile dalej nie dochodzą,
zainstaluj darmową wtyczkę **WP Mail SMTP** (Wtyczki → Dodaj nową) i podłącz skrzynkę pocztową z hostingu —
to standardowy sposób na poprawę doręczalności. W razie wątpliwości poproś o pomoc wsparcie hostingu.

**Nie mam pliku ZIP albo XML / nie wiem, gdzie są.**
Oba pliki są w paczce, którą dostałeś: motyw to `czarodziejski-dworek.zip`, treść to
`tresci-czarodziejski-dworek.xml` (w folderze `_import`). Jeśli ich nie znajdujesz — napisz do nas.

**Zgubiłem hasło do panelu (wp-admin).**
Na ekranie logowania kliknij **„Nie pamiętasz hasła?”** — przyjdzie link na Twój e-mail. Jeśli nie masz
dostępu do tego e-maila, hasło może zresetować wsparcie hostingu.

**Strona wygląda „pusto" zaraz po wgraniu motywu.**
To normalne — treść dochodzi dopiero po imporcie (rozdział 8) i po ustawieniu strony głównej (rozdział 9).

**Czy mogę coś zepsuć?**
Edycja treści jest **bezpieczna** — układ jest stały. Nie zmieniaj kodu motywu ani ustawień, których nie
rozumiesz. Gdy masz kopię zapasową (rozdział 14.2), zawsze można cofnąć.

---

## 17. Pomoc / kontakt

Jeśli na którymkolwiek kroku coś się nie zgadza albo masz wątpliwość — **nie klikaj na oślep**, napisz do nas:

- **E-mail:** m.perzyk@interia.pl

Najlepiej dołącz **zrzut ekranu** tego, co widzisz — wtedy najszybciej pomożemy.

---

*Strona zbudowana na autorskim, lekkim motywie WordPress „Czarodziejski Dworek" — bez page-buildera
i zbędnych wtyczek, w pełni edytowalna z panelu. Wymagana tylko jedna darmowa wtyczka (Advanced Custom Fields).*
