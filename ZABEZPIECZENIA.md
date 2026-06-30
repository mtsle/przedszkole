# 🔒 Zabezpieczenia strony „Czarodziejski Dworek"

Ten dokument opisuje **wszystkie zabezpieczenia** wbudowane w stronę oraz to, co
trzeba **kliknąć raz przy wdrożeniu** (Cloudflare, HTTPS). Jest pisany prosto —
tak, żeby dało się go wykonać bez wiedzy programistycznej.

> **W skrócie — co już jest gotowe w kodzie (działa od razu po wgraniu):**
> komplet nagłówków bezpieczeństwa (CSP, X-Frame-Options, X-Content-Type-Options,
> Referrer-Policy, Permissions-Policy), wymuszenie HTTPS, utwardzenie WordPressa,
> skrypt kopii zapasowych. **Co wymaga jednego kliknięcia przy wdrożeniu:**
> certyfikat HTTPS u hostingu, włączenie HSTS, podpięcie Cloudflare.

---

## 📋 Spis treści
1. [Czym jest każde zabezpieczenie (po ludzku)](#1-czym-jest-każde-zabezpieczenie)
2. [Co jest już zrobione w kodzie](#2-co-jest-już-zrobione-w-kodzie)
3. [HTTPS — certyfikat SSL (krok po kroku)](#3-https--certyfikat-ssl)
4. [Cloudflare — darmowa tarcza (krok po kroku)](#4-cloudflare--darmowa-tarcza)
5. [HSTS — wymuszenie HTTPS na stałe](#5-hsts)
6. [Kopie zapasowe (backupy)](#6-kopie-zapasowe-backupy)
7. [Jak sprawdzić ocenę zabezpieczeń](#7-jak-sprawdzić-ocenę-zabezpieczeń)
8. [Tabela nagłówków (dla informatyka)](#8-tabela-nagłówków)

---

## 1. Czym jest każde zabezpieczenie

| Nazwa | Po co to (prościej) |
|---|---|
| **HTTPS** | Kłódka w przeglądarce. Szyfruje połączenie — nikt po drodze nie podejrzy ani nie podmieni treści. Bez tego Google obniża pozycję i straszy „strona niezabezpieczona". |
| **HSTS** | Mówi przeglądarce: „tę stronę ZAWSZE otwieraj po HTTPS". Blokuje podstępne cofnięcie do niezaszyfrowanego http. |
| **CSP** (Content-Security-Policy) | Lista zaufanych źródeł. Nawet jeśli ktoś wstrzyknie złośliwy skrypt, przeglądarka go nie uruchomi, bo nie ma go na liście. Najsilniejsza ochrona przed atakami XSS. |
| **X-Frame-Options** | Nikt nie osadzi Twojej strony w niewidocznej ramce, żeby podstępem zbierać kliknięcia (clickjacking). |
| **X-Content-Type-Options** | Przeglądarka nie „zgaduje" typu pliku — nie da się przemycić skryptu udającego obrazek. |
| **Referrer-Policy** | Ogranicza, ile informacji o Twojej stronie wycieka, gdy ktoś przechodzi na inną witrynę (prywatność). |
| **Permissions-Policy** | Wyłącza dostęp do kamery, mikrofonu, lokalizacji itp. — strona przedszkola ich nie potrzebuje, więc są zablokowane. |
| **Cloudflare** | Darmowa „tarcza" przed stroną: filtruje boty i ataki, przyspiesza ładowanie (CDN), ukrywa prawdziwy adres serwera, daje darmowy certyfikat i pozwala dołożyć nagłówki bezpieczeństwa. |
| **Backupy** | Kopie zapasowe. Gdyby cokolwiek się zepsuło — przywracasz stronę w kilka minut. |

---

## 2. Co jest już zrobione w kodzie

### A) Wersja WordPress (to, co dostaje klient)
Plik **`inc/security.php`** w motywie automatycznie:
- wysyła **wszystkie nagłówki bezpieczeństwa** (CSP, HSTS, X-Frame-Options,
  X-Content-Type-Options, Referrer-Policy, Permissions-Policy, COOP);
- **wymusza HTTPS** (przekierowuje http → https, gdy jest certyfikat);
- **utwardza WordPressa:** ukrywa numer wersji, wyłącza XML-RPC, blokuje
  podglądanie listy użytkowników (`?author=`, REST API), wyłącza edytor plików
  w panelu, blokuje pingbacki.

> Działa od razu po włączeniu motywu — **nic nie trzeba konfigurować w kodzie.**
> HSTS włącza się sam dopiero, gdy strona realnie działa po HTTPS (bezpiecznik,
> żeby nie zablokować dostępu przed uzyskaniem certyfikatu).

**Dodatkowo** (opcjonalnie, dla hostingu Apache): plik
**`htaccess-bezpieczenstwo.txt`** w motywie — gotowe reguły do wklejenia w główny
`.htaccess` WordPressa. Dają te same nagłówki na poziomie serwera + blokują
wykonywanie PHP w katalogu przesłanych plików, chronią `wp-config.php` itd.

### B) Wersja statyczna (demo na GitHub Pages)
Każda podstrona ma w sekcji `<head>` **meta-nagłówek CSP** i **Referrer-Policy**.
GitHub Pages **nie pozwala** ustawiać prawdziwych nagłówków HTTP, więc resztę
(X-Frame-Options, HSTS, X-Content-Type-Options) dokłada **Cloudflare** —
patrz rozdział 4. Plik **`_headers`** jest gotowy na wypadek przeniesienia
strony na Cloudflare Pages lub Netlify (tam zadziała automatycznie).

---

## 3. HTTPS — certyfikat SSL

**Najpierw to — bez HTTPS reszta nie ma sensu.**

Prawie każdy hosting daje **darmowy certyfikat Let's Encrypt** jednym kliknięciem:

1. Zaloguj się do panelu hostingu (cyber_Folks / home.pl / nazwa.pl / LH.pl…).
2. Znajdź sekcję **„Certyfikaty SSL"** (czasem „Bezpieczeństwo" lub „SSL/TLS").
3. Wybierz domenę → **„Zainstaluj certyfikat Let's Encrypt"** (darmowy) → potwierdź.
4. Odczekaj kilka minut. Wejdź na `https://twoja-domena.pl` — powinna być **kłódka**.
5. W WordPressie: **Ustawienia → Ogólne** → zmień oba adresy
   („Adres WordPressa" i „Adres witryny") z `http://` na **`https://`** → Zapisz.

> Po tym kroku motyw sam zacznie przekierowywać http → https i wysyłać HSTS.

---

## 4. Cloudflare — darmowa tarcza

Cloudflare jest **darmowy** i daje: zaporę przed botami/atakami, szyfrowanie,
przyspieszenie (CDN), ukrycie IP serwera **oraz** możliwość dołożenia nagłówków
bezpieczeństwa (kluczowe dla wersji statycznej i wygodne dla WordPressa).

### Krok 1 — Załóż konto i dodaj domenę
1. Wejdź na **https://dash.cloudflare.com/sign-up**, załóż darmowe konto.
2. **Add a site** → wpisz swoją domenę (`czarodziejski-dworek.pl`) → plan **Free**.
3. Cloudflare pokaże **2 adresy serwerów nazw (nameservery)**, np. `xxx.ns.cloudflare.com`.

### Krok 2 — Przełącz nameservery (w miejscu, gdzie kupiłeś domenę)
4. Zaloguj się do **rejestratora domeny** (tam, gdzie płacisz za domenę).
5. Znajdź **„Serwery nazw / Nameservery / DNS"** → wpisz **dwa adresy od Cloudflare**
   (zamiast dotychczasowych) → Zapisz.
6. Cloudflare przyśle e-mail „Active", gdy zacznie działać (od kilku minut do 24 h).

### Krok 3 — Włącz szyfrowanie i przekierowanie na HTTPS
W panelu Cloudflare, w zakładce **SSL/TLS**:
7. Tryb szyfrowania → **Full (strict)** *(jeśli masz certyfikat u hostingu — zalecane)*
   lub **Full**. **Nie używaj „Flexible".**
8. **SSL/TLS → Edge Certificates:**
   - **Always Use HTTPS** → **ON** (wymusza https),
   - **Automatic HTTPS Rewrites** → **ON**,
   - **Minimum TLS Version** → **TLS 1.2**.

### Krok 4 — Dołóż nagłówki bezpieczeństwa (Transform Rules)
To dodaje X-Frame-Options, X-Content-Type-Options itd. **dla wersji statycznej**
(i jako dodatkowa warstwa dla WordPressa). W panelu Cloudflare:

**Rules → Transform Rules → Modify Response Header → Create rule**
- Nazwa: `Naglowki bezpieczenstwa`
- *If* → **All incoming requests**
- *Then* → **Set static** — dodaj kolejno (przycisk „+ Set static header"):

| Header name | Value |
|---|---|
| `X-Content-Type-Options` | `nosniff` |
| `X-Frame-Options` | `SAMEORIGIN` |
| `Referrer-Policy` | `strict-origin-when-cross-origin` |
| `Permissions-Policy` | `geolocation=(), microphone=(), camera=(), payment=(), usb=(), interest-cohort=()` |
| `Cross-Origin-Opener-Policy` | `same-origin-allow-popups` |
| `Content-Security-Policy` | `default-src 'self'; base-uri 'self'; object-src 'none'; img-src 'self' data: https:; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; font-src 'self' https://fonts.gstatic.com data:; script-src 'self' 'unsafe-inline'; connect-src 'self'; frame-src https://www.google.com https://maps.google.com https://www.openstreetmap.org; frame-ancestors 'self'; form-action 'self'; upgrade-insecure-requests` |

→ **Deploy**.

> ⚠️ Jeśli używasz wersji **WordPress**, nagłówki wysyła już `inc/security.php`.
> Dublowanie ich w Cloudflare nie szkodzi, ale jeśli wolisz mieć je tylko w jednym
> miejscu — możesz pominąć `Content-Security-Policy` w Cloudflare i zostawić resztę.

### Krok 5 — Podstawowa zapora (opcjonalnie, zalecane)
- **Security → Settings → Security Level** → **Medium**.
- **Security → Bots → Bot Fight Mode** → **ON** (darmowe odsiewanie botów).
- **Speed → Optimization** → włącz **Brotli** (szybsze ładowanie).

---

## 5. HSTS

HSTS każe przeglądarce **zawsze** używać HTTPS. Włącz **dopiero gdy HTTPS działa
stabilnie** (inaczej zablokujesz sobie stronę).

- **WordPress:** motyw wysyła HSTS automatycznie, gdy strona działa po HTTPS.
- **Cloudflare (zalecane, najmocniejsze):** **SSL/TLS → Edge Certificates → HTTP
  Strict Transport Security (HSTS) → Enable** i ustaw:
  - Max-Age: **12 months**,
  - Include subdomains: **ON**,
  - Preload: **ON**.

> 🔴 **Uwaga:** HSTS to zobowiązanie — przez ustawiony czas przeglądarki nie
> wpuszczą użytkowników na http. Włączaj, gdy masz pewność, że certyfikat działa.

---

## 6. Kopie zapasowe (backupy)

Zasada **3-2-1**: 3 kopie, na 2 nośnikach, 1 poza domem. Masz to pokryte:

| Kopia | Gdzie | Jak |
|---|---|---|
| **1. Lokalna** | Ten komputer | Dwuklik na **`narzedzia\ZROB-KOPIE-ZAPASOWA.bat`** — pakuje cały projekt do `_kopie-zapasowe\` z datą. Trzyma 7 ostatnich. |
| **2. Offsite (kod)** | GitHub | Repozytorium **mtsle/przedszkole** + Release **v4** = pełna kopia kodu w chmurze, z historią zmian. |
| **3. Strona na żywo** | Hosting klienta | Wtyczka **UpdraftPlus** (darmowa): kopiuje **bazę danych + pliki** do chmury (Google Drive / Dropbox), automatycznie co tydzień. |

### Jak ustawić UpdraftPlus u klienta (gdy strona już działa):
1. **Wtyczki → Dodaj nową** → wyszukaj **„UpdraftPlus"** → Zainstaluj → Włącz.
2. **Ustawienia → UpdraftPlus Backups → Settings.**
3. Harmonogram: pliki **co tydzień**, baza **co tydzień**, zachowaj **4** kopie.
4. „Remote storage" → wybierz **Google Drive** (lub Dropbox) → połącz konto.
5. **Save Changes** → kliknij **Backup Now** (pierwsza kopia od razu).

> Przywracanie: **UpdraftPlus → Existing backups → Restore** — kilka kliknięć.

---

## 7. Jak sprawdzić ocenę zabezpieczeń

Po wdrożeniu HTTPS + Cloudflare/nagłówków sprawdź stronę w darmowych skanerach:

1. **https://securityheaders.com** — wpisz adres. Cel: ocena **A** lub **A+**.
   Pokaże, których nagłówków brakuje (jeśli któryś — wróć do rozdziału 4).
2. **https://www.ssllabs.com/ssltest/** — test certyfikatu HTTPS. Cel: **A**.
3. **https://observatory.mozilla.org** — szersza analiza (CSP, ciasteczka).

> Wersja statyczna na `github.io` osiągnie maksymalnie ocenę średnią (GitHub Pages
> nie daje prawdziwych nagłówków). **Pełne A/A+ jest na hostingu klienta** (WordPress
> + nagłówki PHP) **lub po podpięciu Cloudflare.** To ograniczenie GitHub Pages, nie kodu.

---

## 8. Tabela nagłówków

Dla informatyka wdrażającego stronę — komplet wysyłanych nagłówków:

| Nagłówek | Wartość | Skąd |
|---|---|---|
| `Strict-Transport-Security` | `max-age=63072000; includeSubDomains; preload` | PHP / Cloudflare / .htaccess |
| `Content-Security-Policy` | patrz `inc/security.php` → `dworek_security_csp()` | PHP / meta (statyka) / Cloudflare |
| `X-Content-Type-Options` | `nosniff` | PHP / Cloudflare / .htaccess |
| `X-Frame-Options` | `SAMEORIGIN` | PHP / Cloudflare / .htaccess |
| `Referrer-Policy` | `strict-origin-when-cross-origin` | PHP / meta (statyka) / Cloudflare |
| `Permissions-Policy` | `geolocation=(), microphone=(), camera=()…` | PHP / Cloudflare / .htaccess |
| `Cross-Origin-Opener-Policy` | `same-origin-allow-popups` | PHP / Cloudflare / .htaccess |
| `X-XSS-Protection` | `0` (świadomie — CSP zastępuje) | PHP / .htaccess |

**Dostrajanie CSP:** gdyby klient dołożył usługę z innego źródła (np. czat, piksel
Facebooka, YouTube), trzeba dopisać jej adres do CSP. W WordPressie służy do tego
filtr — bez ruszania kodu motywu, np. w `functions.php` motywu potomnego lub we
wtyczce „Code Snippets":

```php
add_filter( 'dworek_security_csp', function ( $csp ) {
    $csp[] = "script-src 'self' 'unsafe-inline' https://connect.facebook.net";
    return $csp;
} );
```

---

*Dokument przygotowany dla projektu „Czarodziejski Dworek". Zabezpieczenia wbudowane
w kod działają od razu; HTTPS, HSTS i Cloudflare wymagają jednorazowej konfiguracji
przy wdrożeniu (rozdziały 3–5).*
