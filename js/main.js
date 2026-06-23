/* Czarodziejski Dworek — interakcje */
(function () {
  'use strict';
  const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  /* ---- Mobile nav ---- */
  const toggle = document.querySelector('.nav__toggle');
  const links = document.querySelector('.nav__links');
  if (toggle && links) {
    toggle.addEventListener('click', () => {
      const open = links.classList.toggle('is-open');
      toggle.setAttribute('aria-expanded', String(open));
    });
    links.querySelectorAll('a').forEach((a) =>
      a.addEventListener('click', () => {
        links.classList.remove('is-open');
        toggle.setAttribute('aria-expanded', 'false');
      })
    );
  }

  /* ---- Intro: logo dokuje do nagłówka przy scrollu (strona główna) ---- */
  (function () {
    const intro = document.getElementById('intro');
    if (!intro) return;
    const logo = document.getElementById('introLogo');
    const hint = document.getElementById('introHint');
    const introBg = document.getElementById('introBg');
    const headerLogo = document.querySelector('.brand__img');
    if (prefersReduced || !headerLogo || !logo) { intro.remove(); return; }

    document.body.classList.add('js-intro', 'intro-active');
    let w0 = 1, done = false, idleTimer = null, idleRAF = 0;

    const measureSelf = () => {
      const prev = logo.style.transform; logo.style.transform = 'none';
      w0 = logo.offsetWidth || 1; logo.style.transform = prev;
    };
    const frame = (p) => {
      const t = headerLogo.getBoundingClientRect();
      const cx = window.innerWidth / 2, cy = window.innerHeight / 2;
      const s = t.width / w0;
      const dx = (t.left + t.width / 2) - cx, dy = (t.top + t.height / 2) - cy;
      logo.style.transform = 'translate(' + dx * p + 'px,' + dy * p + 'px) scale(' + (1 + (s - 1) * p) + ')';
      if (introBg) introBg.style.opacity = String(Math.max(0, 1 - p / 0.25));
      if (hint) hint.style.opacity = String(Math.max(0, 1 - p * 4));
      if (p >= 0.999 && !done) {
        done = true;
        document.body.classList.remove('intro-active');
        document.body.classList.add('intro-done');
        setTimeout(() => { intro.style.display = 'none'; }, 60);
      }
    };
    const progress = () => Math.min(window.scrollY / Math.max(window.innerHeight * 0.6, 1), 1);
    const cancelIdle = () => { if (idleTimer) { clearTimeout(idleTimer); idleTimer = null; } if (idleRAF) { cancelAnimationFrame(idleRAF); idleRAF = 0; } };
    const onScroll = () => { if (done) return; cancelIdle(); frame(progress()); };
    const easeOut = (x) => 1 - Math.pow(1 - x, 3);

    const begin = () => {
      measureSelf();
      // wejście logo (fade + scale), potem oddajemy kontrolę scrollowi
      logo.style.opacity = '0'; logo.style.transform = 'scale(.9)';
      requestAnimationFrame(() => {
        logo.style.transition = 'opacity .9s cubic-bezier(.22,1,.36,1), transform .9s cubic-bezier(.22,1,.36,1)';
        logo.style.opacity = '1'; logo.style.transform = 'translate(0,0) scale(1)';
      });
      setTimeout(() => {
        logo.style.transition = '';
        if (window.scrollY > 0) onScroll();
      }, 950);
      window.addEventListener('scroll', () => requestAnimationFrame(onScroll), { passive: true });
      window.addEventListener('resize', () => { if (!done) { measureSelf(); onScroll(); } });
      // jeśli użytkownik nie scrolluje — po chwili samo zadokuj
      idleTimer = setTimeout(() => {
        const t0 = performance.now();
        const step = (now) => { const e = Math.min((now - t0) / 1000, 1); frame(easeOut(e)); if (e < 1 && !done) idleRAF = requestAnimationFrame(step); };
        idleRAF = requestAnimationFrame(step);
      }, 3000);
    };
    if (document.readyState === 'complete') begin();
    else window.addEventListener('load', begin);
  })();

  /* ---- Baner rekrutacji (na górze) ---- */
  if (!document.querySelector('.topbar')) {
    const bar = document.createElement('div');
    bar.className = 'topbar';
    bar.innerHTML = 'Trwa rekrutacja na rok 2026/2027 — <a href="kontakt.html">zapisz dziecko już dziś →</a>';
    document.body.insertBefore(bar, document.body.firstChild);
  }

  /* ---- Pasek postępu przewijania ---- */
  if (!prefersReduced) {
    const prog = document.createElement('div');
    prog.className = 'scroll-progress';
    document.body.appendChild(prog);
    const updateProg = () => {
      const h = document.documentElement;
      const max = h.scrollHeight - h.clientHeight;
      prog.style.width = max > 0 ? (h.scrollTop / max) * 100 + '%' : '0';
    };
    updateProg();
    window.addEventListener('scroll', updateProg, { passive: true });
  }

  /* ---- Header shadow on scroll ---- */
  const header = document.querySelector('.site-header');
  if (header) {
    const onScroll = () => header.classList.toggle('is-scrolled', window.scrollY > 8);
    onScroll();
    window.addEventListener('scroll', onScroll, { passive: true });
  }

  /* ---- Scroll reveal ---- */
  const reveals = document.querySelectorAll('.reveal');
  if (reveals.length) {
    if (prefersReduced || !('IntersectionObserver' in window)) {
      reveals.forEach((el) => el.classList.add('is-visible'));
    } else {
      const io = new IntersectionObserver(
        (entries) => {
          entries.forEach((e) => {
            if (e.isIntersecting) {
              e.target.classList.add('is-visible');
              io.unobserve(e.target);
            }
          });
        },
        { threshold: 0, rootMargin: '0px 0px 0px 0px' }
      );
      reveals.forEach((el) => io.observe(el));

      // Bezpiecznik: od razu pokaż to, co jest w polu widzenia, a po chwili
      // wymuś pełne ujawnienie — żadna sekcja nie utknie niewidoczna.
      const revealInView = () => {
        reveals.forEach((el) => {
          const r = el.getBoundingClientRect();
          if (r.top < window.innerHeight && r.bottom > 0) el.classList.add('is-visible');
        });
      };
      requestAnimationFrame(revealInView);
      window.addEventListener('load', revealInView);
      setTimeout(() => reveals.forEach((el) => el.classList.add('is-visible')), 2500);
    }
  }

  /* ---- Animated counters ---- */
  const counters = document.querySelectorAll('[data-count]');
  if (counters.length && 'IntersectionObserver' in window) {
    const animate = (el) => {
      const target = parseFloat(el.dataset.count);
      const suffix = el.dataset.suffix || '';
      if (prefersReduced) { el.textContent = target + suffix; return; }
      const dur = 1400;
      const start = performance.now();
      const step = (now) => {
        const p = Math.min((now - start) / dur, 1);
        const eased = 1 - Math.pow(1 - p, 3);
        el.textContent = Math.round(target * eased) + suffix;
        if (p < 1) requestAnimationFrame(step);
      };
      requestAnimationFrame(step);
    };
    const io2 = new IntersectionObserver((entries) => {
      entries.forEach((e) => {
        if (e.isIntersecting) { animate(e.target); io2.unobserve(e.target); }
      });
    }, { threshold: 0.5 });
    counters.forEach((c) => io2.observe(c));
  }

  /* ---- Gallery lightbox ---- */
  const figs = document.querySelectorAll('[data-lightbox] img');
  if (figs.length) {
    const lb = document.createElement('div');
    lb.className = 'lightbox';
    lb.setAttribute('role', 'dialog');
    lb.setAttribute('aria-modal', 'true');
    lb.setAttribute('aria-label', 'Powiększone zdjęcie');
    lb.innerHTML =
      '<button class="lightbox__close" aria-label="Zamknij"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"><path d="M6 6l12 12M18 6L6 18"/></svg></button><img alt="">';
    document.body.appendChild(lb);
    const lbImg = lb.querySelector('img');
    const closeBtn = lb.querySelector('.lightbox__close');
    let lastFocus = null;
    const open = (src, alt) => {
      lastFocus = document.activeElement;
      lbImg.src = src; lbImg.alt = alt || '';
      lb.classList.add('is-open'); closeBtn.focus();
      document.body.style.overflow = 'hidden';
    };
    const close = () => {
      lb.classList.remove('is-open');
      document.body.style.overflow = '';
      if (lastFocus) lastFocus.focus();
    };
    figs.forEach((img) => {
      img.parentElement.setAttribute('tabindex', '0');
      img.parentElement.setAttribute('role', 'button');
      const trigger = () => open(img.dataset.full || img.src, img.alt);
      img.parentElement.addEventListener('click', trigger);
      img.parentElement.addEventListener('keydown', (e) => {
        if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); trigger(); }
      });
    });
    closeBtn.addEventListener('click', close);
    lb.addEventListener('click', (e) => { if (e.target === lb) close(); });
    document.addEventListener('keydown', (e) => { if (e.key === 'Escape' && lb.classList.contains('is-open')) close(); });
  }

  /* ---- Form validation (wizualna, bez wysyłki) ---- */
  const form = document.querySelector('form[data-validate]');
  if (form) {
    const showError = (field, msg) => {
      field.classList.add('has-error');
      const em = field.querySelector('.error-msg');
      if (em && msg) em.textContent = msg;
    };
    const clearError = (field) => field.classList.remove('has-error');

    form.querySelectorAll('input, textarea, select').forEach((input) => {
      input.addEventListener('blur', () => {
        const field = input.closest('.field');
        if (input.required && !input.value.trim()) showError(field, 'To pole jest wymagane.');
        else if (input.type === 'email' && input.value && !/^[^@\s]+@[^@\s]+\.[^@\s]+$/.test(input.value))
          showError(field, 'Podaj poprawny adres e-mail.');
        else clearError(field);
      });
      input.addEventListener('input', () => { if (input.value.trim()) clearError(input.closest('.field')); });
    });

    form.addEventListener('submit', (e) => {
      e.preventDefault();
      let firstInvalid = null;
      form.querySelectorAll('input, textarea, select').forEach((input) => {
        const field = input.closest('.field');
        let invalid = false;
        if (input.required && !input.value.trim()) { showError(field, 'To pole jest wymagane.'); invalid = true; }
        else if (input.type === 'email' && input.value && !/^[^@\s]+@[^@\s]+\.[^@\s]+$/.test(input.value)) { showError(field, 'Podaj poprawny adres e-mail.'); invalid = true; }
        else clearError(field);
        if (invalid && !firstInvalid) firstInvalid = input;
      });
      const status = form.querySelector('.form-status');
      if (firstInvalid) { firstInvalid.focus(); return; }
      if (status) {
        status.textContent = 'Dziękujemy! To wersja demonstracyjna — wiadomość nie została wysłana. Podłączenie formularza skonfigurujemy na życzenie.';
        status.style.display = 'block';
      }
      form.reset();
    });
  }

  /* ---- Active nav link ---- */
  const path = location.pathname.split('/').pop() || 'index.html';
  document.querySelectorAll('.nav__links a').forEach((a) => {
    const href = a.getAttribute('href');
    if (href === path) a.classList.add('is-active');
  });

  /* ---- Footer year ---- */
  const y = document.querySelector('[data-year]');
  if (y) y.textContent = new Date().getFullYear();

  /* ---- Hero: plama gradientu podążająca za myszą (delikatnie) ---- */
  const gooPointer = document.getElementById('heroGooPointer');
  const gooLayer = document.getElementById('heroGooLayer');
  const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  if (gooPointer && gooLayer && !reduceMotion && window.matchMedia('(pointer: fine)').matches) {
    let tgX = 0, tgY = 0, curX = 0, curY = 0, raf = null;
    const tick = () => {
      curX += (tgX - curX) / 20;
      curY += (tgY - curY) / 20;
      gooPointer.style.transform = `translate(${Math.round(curX)}px, ${Math.round(curY)}px)`;
      if (Math.abs(tgX - curX) > 0.4 || Math.abs(tgY - curY) > 0.4) {
        raf = requestAnimationFrame(tick);
      } else { raf = null; }
    };
    gooLayer.closest('.hero').addEventListener('mousemove', (e) => {
      const rect = gooLayer.getBoundingClientRect();
      tgX = e.clientX - rect.left - rect.width / 2;
      tgY = e.clientY - rect.top - rect.height / 2;
      if (!raf) raf = requestAnimationFrame(tick);
    });
  }

  /* ---- Kadra: modal z biogramem (prawdziwe dane ze strony /nauczyciele/) ---- */
  const teamCards = document.querySelectorAll('.team-card[data-person]');
  if (teamCards.length) {
    const people = {
      mering: { role: 'Dyrektor, pedagog, nauczyciel wychowania przedszkolnego', bio: [
        'Założycielka i dyrektorka Przedszkola „Czarodziejski Dworek" od 2003 r.',
        'Absolwentka Wydziału Pedagogicznego Uniwersytetu Warszawskiego — Edukacja Przedszkolna (2005) oraz Polityka i zarządzanie oświatą (2008).',
        'Absolwentka Wyższej Szkoły Humanistycznej w Pułtusku — Zintegrowana Edukacja Początkowa z terapią pedagogiczną (2003) oraz Doradztwo, Opieka i Pomoc Społeczna (2002).',
        'Absolwentka Wyższej Szkoły Nauk Społecznych w Warszawie — Edukacja dla bezpieczeństwa (2011).',
        'Prywatnie mama dwóch nastolatek, uwielbiająca taniec i podróże.'
      ] },
      bartoszewska: { role: 'Pedagog, terapeuta', bio: [
        'Ukończyła studia magisterskie z Pedagogiki Przedszkolnej z terapią pedagogiczną oraz podyplomowe Zarządzanie i Marketing w Oświacie.',
        'Uczestniczka wielu kursów i szkoleń, m.in. rocznego kursu Marii Montessori oraz kursu Dramy.',
        'Posiada wieloletnie doświadczenie w pracy z dziećmi w wieku szkolnym i przedszkolnym.',
        'Podąża za myślą Konfucjusza: „Powiedz mi a zapomnę! Pokaż mi a zapamiętam! Pozwól mi działać — a zrozumiem i rozwinę skrzydła".',
        'W wolnych chwilach jeździ na rowerze, spędza czas z przyjaciółmi i czyta literaturę kryminalną.'
      ] },
      chlap: { role: 'Pedagog specjalny, nauczyciel wychowania przedszkolnego', bio: [
        'Ukończyła studia o specjalności integracyjne wychowanie przedszkolne i wczesna interwencja na Akademii Pedagogiki Specjalnej.',
        'Pracowała z dziećmi z autyzmem w Fundacji Synapsis — prowadziła zajęcia indywidualne i grupowe.',
        'Uczestniczka szkoleń z komunikacji funkcjonalnej (PECS, Makaton) oraz wspierania rozwoju i radzenia sobie z zachowaniami trudnymi.',
        'W Czarodziejskim Dworku pracuje od 2013 r. jako nauczyciel wychowania przedszkolnego i pedagog specjalny.',
        'Prywatnie lubi czytanie, taniec i wycieczki rowerowe.'
      ] },
      gomola: { role: 'Nauczyciel wychowania przedszkolnego, pedagog specjalny', bio: [
        'Absolwentka APS w Warszawie i Uniwersytetu Śląskiego w Katowicach.',
        'Z przedszkolem „Czarodziejski Dworek" związana od 2013 roku jako nauczyciel i terapeuta.',
        'Prowadzi indywidualne zajęcia pedagogiczne, TUS-y oraz jogę dla dzieci.',
        'Ma bogate doświadczenie w pracy z dziećmi i młodzieżą, również z diagnozą ASD, oraz w warsztatach (współpraca z WSR w Warszawie i Fundacją Artonomia).',
        'Systematycznie podnosi kwalifikacje (m.in. Jogopedia, NVC, Kids’ Skills, regulacja emocji).',
        'Po pracy ćwiczy jogę, tańczy salsę kubańską i zwiedza świat.'
      ] },
      jakuc: { role: 'Pedagog specjalny, terapeuta', bio: [
        'Pedagog specjalny, wczesnoszkolny i przedszkolny; duże doświadczenie w pracy z dziećmi ze spektrum autyzmu.',
        'W przedszkolu prowadzi zajęcia integracji sensorycznej, terapię ręki, treningi umiejętności społecznych oraz zajęcia taneczne.',
        'Ukończyła m.in. szkolenia „Pozytywna dyscyplina" oraz „Jak mówić, żeby dzieci nas słuchały…".',
        'W pracy daleka od systemu kar i nagród — stawia na poczucie bezpieczeństwa, zaufanie i budowanie więzi z dzieckiem.',
        'Prywatnie mama Aleksa; lubi podróże, rower, tenis, książki i pieczenie ciast.'
      ] },
      jurska: { role: 'Pedagog, oligofrenopedagog, terapeuta SI', bio: [
        'Ukończyła kurs „Autyzm: małe dziecko — duża sprawa" (Fundacja Synapsis) oraz szkolenia PECS, Trening Umiejętności Społecznych i Weroniki Sherborne.',
        'Jest terapeutą integracji sensorycznej.',
        'Pracowała z dziećmi w przedszkolu terapeutycznym Fundacji Synapsis.',
        'Z Czarodziejskim Dworkiem związana od 2015 r.',
        'Prywatnie szczęśliwa mama małego Tadzia; lubi rower, gotowanie, książki, podróże i socjologię.'
      ] },
      kucharczyk: { role: 'Psycholog, terapeuta', bio: [
        'Psycholog z przygotowaniem pedagogicznym i terapeuta.',
        'Ukończyła magisterskie studia psychologiczne na Uniwersytecie SWPS.',
        'Od 2009 roku pracuje z dziećmi z zaburzeniami ze spektrum autyzmu.',
        'Doświadczenie zdobywała jako terapeuta indywidualny i grupowy w przedszkolu terapeutycznym.',
        'Uczestniczka licznych szkoleń i konferencji (m.in. zachowania trudne, PECS — I poziom, trening kompetencji społecznych).'
      ] },
      mazur: { role: 'Pedagog specjalny, nauczyciel, terapeuta SI', bio: [
        'Pedagog specjalny, nauczyciel wychowania przedszkolnego oraz terapeuta Integracji Sensorycznej.',
        'Ukończyła Pedagogikę Specjalną (APS im. M. Grzegorzewskiej), podyplomową Pedagogikę Korekcyjną oraz Pedagogikę Przedszkolną (WSP ZNP).',
        'Ukończyła kursy: Diagnoza i Terapia Integracji Sensorycznej, korektywa i kompensacja wad postawy, terapia ręki i stopy, Integracja Bilateralna.',
        'W „Czarodziejskim Dworku" pracuje od 2007 roku.',
        'W pracy kładzie nacisk na różnorodne formy aktywności ruchowej — uważa, że ruch to motor rozwoju dziecka.',
        'Jej pasja to ruch: taniec, rower, rolki, pływanie, spacery z psem; lubi też podróże i gry planszowe.'
      ] },
      sawczuk: { role: 'Nauczyciel wychowania przedszkolnego', bio: [
        'Absolwentka WSP ZNP w Warszawie — wychowanie wczesnoszkolne z językiem angielskim; ukończyła wiele szkoleń.',
        'Z przedszkolem „Czarodziejski Dworek" związana od 2015 roku.',
        'Najważniejsze jest dla niej, by każde dziecko czuło się przy niej bezpieczne i szczęśliwe.',
        'Zawód nauczyciela wybrała z zamiłowania do pracy z dziećmi — i nie zamieniłaby go na żaden inny.',
        'W wolnym czasie czyta, słucha muzyki, podróżuje i jeździ rowerem.'
      ] },
      lucka: { role: 'Pedagog specjalny', bio: [
        'Absolwentka studiów magisterskich na APS im. M. Grzegorzewskiej — pedagogika specjalna.',
        'Doświadczenie zdobywała w szkole podstawowej (klasy 1–3), wspierając dzieci ze spektrum autyzmu i ich rodziny.',
        'Ukończyła kursy m.in. terapii ręki z grafomotoryką, komunikacji AAC, pracy z dzieckiem z ADHD oraz terapii dziecka z autyzmem.',
        'Prowadzi zajęcia dydaktyczne w grupie oraz indywidualne zajęcia terapeutyczne w atmosferze spokoju i akceptacji.',
        'Uważa, że każde dziecko ma niepowtarzalny potencjał, który warto odkrywać i rozwijać.'
      ] },
      golec: { role: 'Psycholog', bio: [
        'Absolwentka Psychologii (UMCS w Lublinie), specjalność Psychologia Kliniczna.',
        'Od ponad 10 lat pracuje z dziećmi w spektrum autyzmu i ich rodzinami.',
        'Doświadczenie zdobywała m.in. w Przedszkolu Terapeutycznym Fundacji SYNAPSIS i w Centrum Terapii Simuli (terapia indywidualna, TUS).',
        'Odbyła dwuletni staż diagnostyczno-terapeutyczny w Fundacji SYNAPSIS.',
        'W pracy stawia na indywidualne podejście, empatię i otwartość wobec dziecka.',
        'Prywatnie mama, wielbicielka psów, małych podróży i gier planszowych.'
      ] },
      linowska: { role: 'Psycholog, psychoterapeuta', bio: [
        'Absolwentka Wydziału Psychologii Uniwersytetu Warszawskiego.',
        'Posiada certyfikat psychoterapeuty Instytutu Psychoanalizy i Psychoterapii w Warszawie.',
        'Studentka studiów podyplomowych Seksuologia kliniczna (Warszawski Uniwersytet Medyczny).',
        'Pracuje z dziećmi, młodzieżą, osobami dorosłymi, parami i rodzinami.',
        'Swoją pracę poddaje regularnej superwizji indywidualnej i grupowej.',
        'Posiada przygotowanie pedagogiczne.'
      ] },
      byszko: { role: 'Neurologopeda, pedagog specjalny', bio: [
        'Absolwentka Akademii Pedagogiki Specjalnej i SWPS w Warszawie.',
        'Od 2011 roku w przedszkolu „Czarodziejski Dworek" — kompleksowa diagnoza i indywidualna terapia logopedyczna dzieci.',
        'Konstruuje indywidualne programy terapeutyczne, wspiera komunikację dzieci ze spektrum autyzmu, konsultuje rodziców.',
        'Ma doświadczenie w szkoleniu kadry w zakresie komunikowania się osób z autyzmem.',
        'Szkolenia m.in.: PECS, diagnoza funkcjonalna PEP-R, zaburzenia połykania, metoda werbotonalna.',
        'Prywatnie mama Ady i miłośniczka fitnessu.'
      ] },
      kunat: { role: 'Neurologopeda, logopeda ogólny i kliniczny', bio: [
        'Absolwentka Uniwersytetu Warszawskiego — Logopedia Ogólna i Kliniczna (we współpracy z WUM).',
        'Ukończyła podyplomową Neurologopedię profilowaną ze specjalnością Wczesna Interwencja Neurologopedyczna.',
        'Odbyła staż na Oddziale Terapii i Rehabilitacji Neurologicznej oraz praktyki w Centrum Intensywnej Terapii Olinek.',
        'Prowadziła zajęcia logorytmiczne, profilaktykę logopedyczną oraz terapię dzieci z afazją, opóźnieniami mowy i ze spektrum autyzmu.',
        'Neurologopedia to jej pasja — stale doskonali warsztat i śledzi najnowsze badania.',
        'Prywatnie miłośniczka muzyki — śpiewała w jednym z warszawskich chórów.'
      ] },
      slawikowska: { role: 'Fizjoterapeuta, terapeuta SI', bio: [
        'Ukończyła Akademię Wychowania Fizycznego w Warszawie.',
        'Jest fizjoterapeutką i terapeutką Integracji Sensorycznej.',
        'Od wielu lat z pasją pracuje z dziećmi.',
        'Stale poszerza wiedzę na kursach i konferencjach dotyczących rozwoju ruchowego dzieci.'
      ] },
      szymanska: { role: 'Lektor języka angielskiego', bio: [
        'Absolwentka Wydziału Polonistyki oraz Instytutu Romanistyki Uniwersytetu Warszawskiego.',
        'Posiada certyfikat języka angielskiego na poziomie C1.',
        'Doświadczenie w pracy z dziećmi zdobywa od pierwszego roku studiów.',
        'Wyspecjalizowana w pracy z uczniami o specjalnych potrzebach edukacyjnych.',
        'Chętnie przełamuje stereotypowe podejście do nauczania języków.'
      ] },
      czarnecka: { role: 'Lektor języka francuskiego', bio: [
        'Nauczycielka języka francuskiego od 2004 roku.',
        'Absolwentka filologii romańskiej Uniwersytetu Warszawskiego.',
        'Język francuski zna od najmłodszych lat — jako dziecko chodziła do szkoły francuskiej.',
        'Egzaminatorka DELF; pracuje też w szkole podstawowej i Instytucie Francuskim.',
        'Uczy dzieci przez gry, zabawy ruchowe i piosenki.'
      ] },
      maliga: { role: 'Rytmika i muzyka', bio: [
        'Absolwentka (2003) Akademii Muzycznej im. F. Chopina w Warszawie — Edukacja Muzyczna, specjalność Rytmika.',
        'Ukończyła Studium Wychowania Muzycznego Carla Orffa oraz liczne kursy orffowskie w kraju i za granicą (Salzburg, Nitra, Pilzno).',
        'Członkini Polskiego Towarzystwa Carla Orffa.',
        'Od 1998 roku uczy rytmiki i umuzykalnienia w szkołach i przedszkolach.',
        'Łączy metody Orffa, Dalcroze’a i Gordona — gra na fortepianie, śpiewa, tańczy i komponuje piosenki.',
        'Miłośniczka Tai Chi, gry na djembe oraz psów rasy posokowiec bawarski.'
      ] }
    };

    const modal = document.createElement('div');
    modal.className = 'person-modal';
    modal.setAttribute('role', 'dialog');
    modal.setAttribute('aria-modal', 'true');
    modal.setAttribute('aria-labelledby', 'pm-name');
    modal.innerHTML =
      '<div class="person-modal__panel">' +
        '<button class="person-modal__close" aria-label="Zamknij"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"><path d="M6 6l12 12M18 6L6 18"/></svg></button>' +
        '<div class="person-modal__head"><div class="person-modal__avatar"></div><div><h3 id="pm-name"></h3><p class="role"></p></div></div>' +
        '<ul class="person-modal__bio"></ul>' +
      '</div>';
    document.body.appendChild(modal);
    const avatar = modal.querySelector('.person-modal__avatar');
    const nameEl = modal.querySelector('#pm-name');
    const roleEl = modal.querySelector('.role');
    const bioEl = modal.querySelector('.person-modal__bio');
    const closeBtn = modal.querySelector('.person-modal__close');
    let lastFocus = null;

    const open = (card) => {
      const data = people[card.dataset.person];
      if (!data) return;
      lastFocus = document.activeElement;
      nameEl.textContent = card.querySelector('h3').textContent;
      roleEl.textContent = data.role || '';
      avatar.innerHTML = '';
      const img = card.querySelector('img');
      const mono = card.querySelector('.mono');
      if (img) {
        const i = document.createElement('img');
        i.src = img.src; i.alt = '';
        avatar.appendChild(i);
      } else if (mono) {
        const d = document.createElement('div');
        d.className = mono.className;
        d.textContent = mono.textContent;
        avatar.appendChild(d);
      }
      bioEl.innerHTML = '';
      data.bio.forEach((t) => { const li = document.createElement('li'); li.textContent = t; bioEl.appendChild(li); });
      modal.classList.add('is-open');
      document.body.style.overflow = 'hidden';
      closeBtn.focus();
    };
    const close = () => {
      modal.classList.remove('is-open');
      document.body.style.overflow = '';
      if (lastFocus) lastFocus.focus();
    };

    teamCards.forEach((card) => {
      card.setAttribute('role', 'button');
      card.setAttribute('tabindex', '0');
      card.setAttribute('aria-haspopup', 'dialog');
      const cue = document.createElement('span');
      cue.className = 'team-card__more';
      cue.textContent = 'Poznaj mnie →';
      card.appendChild(cue);
      card.addEventListener('click', () => open(card));
      card.addEventListener('keydown', (e) => {
        if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); open(card); }
      });
    });
    closeBtn.addEventListener('click', close);
    modal.addEventListener('click', (e) => { if (e.target === modal) close(); });
    document.addEventListener('keydown', (e) => { if (e.key === 'Escape' && modal.classList.contains('is-open')) close(); });
  }
})();
