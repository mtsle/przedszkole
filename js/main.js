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

  /* ---- Lightbox (wspólny: galeria + podglądy) ---- */
  function buildLightbox() {
    const lb = document.createElement('div');
    lb.className = 'lightbox';
    lb.setAttribute('role', 'dialog');
    lb.setAttribute('aria-modal', 'true');
    lb.setAttribute('aria-label', 'Powiększone zdjęcie');
    lb.innerHTML =
      '<button class="lightbox__close" aria-label="Zamknij"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"><path d="M6 6l12 12M18 6L6 18"/></svg></button>' +
      '<div class="lightbox__count" aria-live="polite"></div>' +
      '<button class="lightbox__nav lightbox__prev" aria-label="Poprzednie zdjęcie"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M15 5l-7 7 7 7"/></svg></button>' +
      '<div class="lightbox__spinner" aria-hidden="true"></div>' +
      '<figure class="lightbox__stage"><img alt=""><figcaption class="lightbox__cap"></figcaption></figure>' +
      '<button class="lightbox__nav lightbox__next" aria-label="Następne zdjęcie"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M9 5l7 7-7 7"/></svg></button>' +
      '<div class="lightbox__strip" hidden></div>';
    document.body.appendChild(lb);
    const stage = lb.querySelector('.lightbox__stage');
    const lbImg = lb.querySelector('.lightbox__stage img');
    const cap = lb.querySelector('.lightbox__cap');
    const count = lb.querySelector('.lightbox__count');
    const strip = lb.querySelector('.lightbox__strip');
    const closeBtn = lb.querySelector('.lightbox__close');
    const prevBtn = lb.querySelector('.lightbox__prev');
    const nextBtn = lb.querySelector('.lightbox__next');
    let items = [], idx = 0, lastFocus = null, token = 0;

    const preload = (i) => { const it = items[i]; if (it) { const im = new Image(); im.src = it.src; } };

    const buildStrip = () => {
      strip.innerHTML = '';
      if (items.length < 2 || !items.some((it) => it.thumb)) { strip.hidden = true; return; }
      strip.hidden = false;
      items.forEach((it, i) => {
        const b = document.createElement('button');
        b.className = 'lightbox__thumb'; b.type = 'button';
        b.setAttribute('aria-label', 'Zdjęcie ' + (i + 1));
        const im = document.createElement('img');
        im.src = it.thumb || it.src; im.alt = ''; im.loading = 'lazy';
        b.appendChild(im);
        b.addEventListener('click', (e) => { e.stopPropagation(); idx = i; render(); });
        strip.appendChild(b);
      });
    };
    const syncStrip = () => {
      if (strip.hidden) return;
      [...strip.children].forEach((b, i) => b.classList.toggle('is-active', i === idx));
      const active = strip.children[idx];
      if (active) active.scrollIntoView({ inline: 'center', block: 'nearest', behavior: 'smooth' });
    };

    const render = () => {
      const it = items[idx]; if (!it) return;
      const my = ++token;
      lb.classList.add('is-loading');
      const tmp = new Image();
      const done = () => { if (my !== token) return; lbImg.src = it.src; lbImg.alt = it.alt || ''; lb.classList.remove('is-loading'); };
      tmp.onload = done; tmp.onerror = done;
      tmp.src = it.src;
      if (it.cap) { cap.textContent = it.cap; cap.style.display = ''; }
      else { cap.textContent = ''; cap.style.display = 'none'; }
      const multi = items.length > 1;
      prevBtn.style.display = nextBtn.style.display = count.style.display = multi ? '' : 'none';
      if (multi) count.textContent = (idx + 1) + ' / ' + items.length;
      syncStrip();
      preload((idx + 1) % items.length);
      preload((idx - 1 + items.length) % items.length);
    };
    const go = (d) => { if (items.length) { idx = (idx + d + items.length) % items.length; render(); } };
    const close = () => {
      lb.classList.remove('is-open');
      document.body.style.overflow = '';
      if (lastFocus) lastFocus.focus();
    };
    const openGroup = (list, i) => {
      items = list; idx = i || 0;
      lastFocus = document.activeElement;
      buildStrip();
      render();
      lb.classList.add('is-open'); closeBtn.focus();
      document.body.style.overflow = 'hidden';
    };
    closeBtn.addEventListener('click', close);
    prevBtn.addEventListener('click', (e) => { e.stopPropagation(); go(-1); });
    nextBtn.addEventListener('click', (e) => { e.stopPropagation(); go(1); });
    lb.addEventListener('click', (e) => { if (e.target === lb || e.target === stage) close(); });
    document.addEventListener('keydown', (e) => {
      if (!lb.classList.contains('is-open')) return;
      if (e.key === 'Escape') close();
      else if (e.key === 'ArrowLeft') go(-1);
      else if (e.key === 'ArrowRight') go(1);
    });
    // swipe na telefonie
    let tsx = 0, tsy = 0;
    stage.addEventListener('touchstart', (e) => { const t = e.changedTouches[0]; tsx = t.clientX; tsy = t.clientY; }, { passive: true });
    stage.addEventListener('touchend', (e) => {
      const t = e.changedTouches[0], dx = t.clientX - tsx, dy = t.clientY - tsy;
      if (Math.abs(dx) > 45 && Math.abs(dx) > Math.abs(dy)) go(dx < 0 ? 1 : -1);
    }, { passive: true });
    return { openGroup };
  }

  /* ---- Podglądy statyczne [data-lightbox] (np. strona główna) ---- */
  const staticFigs = document.querySelectorAll('[data-lightbox] img');
  if (staticFigs.length) {
    const lb = buildLightbox();
    const items = [...staticFigs].map((img) => {
      const fc = img.parentElement.querySelector('figcaption');
      return { src: img.dataset.full || img.src, alt: img.alt, cap: fc ? fc.textContent : '' };
    });
    staticFigs.forEach((img, i) => {
      const fig = img.parentElement;
      fig.setAttribute('tabindex', '0');
      fig.setAttribute('role', 'button');
      const trigger = () => lb.openGroup(items, i);
      fig.addEventListener('click', trigger);
      fig.addEventListener('keydown', (e) => {
        if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); trigger(); }
      });
    });
  }

  /* ---- Galeria: render justified + filtry ---- */
  const gWrap = document.getElementById('jgallery');
  if (gWrap && Array.isArray(window.GALLERY) && window.GALLERY.length) {
    const DATA = window.GALLERY;
    const lb = buildLightbox();
    const GAP = 10;
    let current = DATA, entranceIO = null;
    const targetRow = () => (window.innerWidth <= 640 ? 150 : 240);

    const lbItems = () => current.map((d) => ({ src: d.src, thumb: d.thumb, alt: d.cap || '', cap: d.cap || '' }));

    const layout = () => {
      const W = gWrap.clientWidth;
      if (!W) return;
      const th = targetRow();
      const els = [...gWrap.children];
      let row = [], sumAR = 0;
      const flush = (last) => {
        if (!row.length) return;
        const gaps = GAP * (row.length - 1);
        let h = (W - gaps) / sumAR;
        if (last && h > th * 1.3) h = th; // ostatniego rzędu nie rozciągaj
        row.forEach((el) => {
          el.style.width = Math.floor(parseFloat(el.dataset.ar) * h) + 'px';
          el.style.height = Math.floor(h) + 'px';
        });
        row = []; sumAR = 0;
      };
      els.forEach((el) => {
        row.push(el); sumAR += parseFloat(el.dataset.ar);
        if (sumAR * th >= W - GAP * (row.length - 1)) flush(false);
      });
      flush(true);
      gWrap.classList.add('is-ready');
    };

    const setupEntrance = () => {
      const els = [...gWrap.children];
      if (prefersReduced || !('IntersectionObserver' in window)) { els.forEach((el) => el.classList.add('in')); return; }
      if (entranceIO) entranceIO.disconnect();
      entranceIO = new IntersectionObserver((entries) => {
        entries.forEach((e) => {
          if (!e.isIntersecting) return;
          const el = e.target;
          el.style.transitionDelay = Math.min(Math.round(el.offsetLeft / 130) * 35, 210) + 'ms';
          el.classList.add('in');
          entranceIO.unobserve(el);
        });
      }, { rootMargin: '0px 0px -8% 0px' });
      els.forEach((el) => entranceIO.observe(el));
    };

    const render = () => {
      gWrap.innerHTML = '';
      current.forEach((it, i) => {
        const fig = document.createElement('figure');
        fig.className = 'jg-item';
        fig.dataset.ar = (it.w / it.h).toFixed(4);
        fig.setAttribute('role', 'button');
        fig.setAttribute('tabindex', '0');
        fig.setAttribute('aria-label', it.cap ? ('Powiększ: ' + it.cap) : 'Powiększ zdjęcie');
        const im = document.createElement('img');
        im.loading = 'lazy'; im.decoding = 'async';
        im.src = it.thumb || it.src; im.alt = it.cap || '';
        im.width = it.w; im.height = it.h;
        fig.appendChild(im);
        if (it.cap) { const fc = document.createElement('figcaption'); fc.textContent = it.cap; fig.appendChild(fc); }
        const zoom = document.createElement('span');
        zoom.className = 'jg-item__zoom';
        zoom.innerHTML = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3"/></svg>';
        fig.appendChild(zoom);
        const trigger = () => lb.openGroup(lbItems(), i);
        fig.addEventListener('click', trigger);
        fig.addEventListener('keydown', (e) => { if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); trigger(); } });
        gWrap.appendChild(fig);
      });
      layout();
      setupEntrance();
    };

    const filterBar = document.querySelector('.gallery-filters');
    if (filterBar) {
      filterBar.addEventListener('click', (e) => {
        const btn = e.target.closest('[data-filter]');
        if (!btn) return;
        filterBar.querySelectorAll('[data-filter]').forEach((b) => {
          const on = b === btn;
          b.classList.toggle('is-active', on);
          b.setAttribute('aria-pressed', String(on));
        });
        const f = btn.dataset.filter;
        current = (f === 'all') ? DATA : DATA.filter((d) => d.cat === f);
        render();
      });
    }

    render();
    let rt;
    window.addEventListener('resize', () => { clearTimeout(rt); rt = setTimeout(layout, 120); });
    window.addEventListener('load', layout); // przelicz po pełnym załadowaniu (fonty/scrollbar)
  }

  /* ---- Blog: wyróżniony wpis + filtry z licznikami + wyszukiwarka ---- */
  const esc = (s) => String(s).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
  const blogLabels = {};
  (window.BLOG_CATS || []).forEach((c) => { blogLabels[c.slug] = c.label; });
  const plural = (n) => {
    const a = n % 10, b = n % 100;
    if (n === 1) return 'wpis';
    if (a >= 2 && a <= 4 && (b < 12 || b > 14)) return 'wpisy';
    return 'wpisów';
  };
  const blogMedia = (p) =>
    '<span class="blog-card__media">' +
      '<img src="' + p.img + '" alt="' + esc(p.title) + '" loading="lazy" decoding="async" width="800" height="500">' +
      '<span class="tag tag--over">' + esc(blogLabels[p.cat] || '') + '</span>' +
    '</span>';
  const blogCard = (p) => {
    const a = document.createElement('a');
    a.className = 'card pic-card blog-card';
    a.href = p.url;
    a.innerHTML = blogMedia(p) +
      '<div class="pic-card__body">' +
        '<time class="date" datetime="' + p.date + '">' + esc(p.dateText) + '</time>' +
        '<h3>' + esc(p.title) + '</h3>' +
        '<p class="excerpt">' + esc(p.excerpt) + '</p>' +
        '<span class="more">Czytaj więcej →</span>' +
      '</div>';
    return a;
  };

  const blogWrap = document.getElementById('blog-list');
  if (blogWrap && Array.isArray(window.BLOG)) {
    const DATA = window.BLOG.slice();
    const featuredWrap = document.getElementById('blog-featured');
    const filterBar = document.getElementById('blog-filters') || document.querySelector('.gallery-filters');
    const searchInput = document.getElementById('blog-search');
    const countEl = document.getElementById('blog-count');
    let current = 'all', query = '';

    const counts = {};
    DATA.forEach((p) => { counts[p.cat] = (counts[p.cat] || 0) + 1; });

    const featured = (p) => {
      const a = document.createElement('a');
      a.className = 'blog-featured';
      a.href = p.url;
      a.innerHTML =
        '<span class="blog-featured__media">' +
          '<img src="' + p.img + '" alt="' + esc(p.title) + '" decoding="async" width="800" height="500">' +
          '<span class="tag tag--over">' + esc(blogLabels[p.cat] || '') + '</span>' +
        '</span>' +
        '<div class="blog-featured__body">' +
          '<span class="feat-label">Najnowszy wpis</span>' +
          '<time class="date" datetime="' + p.date + '">' + esc(p.dateText) + '</time>' +
          '<h2>' + esc(p.title) + '</h2>' +
          '<p>' + esc(p.excerpt) + '</p>' +
          '<span class="more">Czytaj więcej →</span>' +
        '</div>';
      return a;
    };

    const emptyState = (msg) =>
      '<div class="blog-empty">' +
        '<div class="ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3"/></svg></div>' +
        '<h3>Brak wyników</h3>' +
        '<p>' + esc(msg) + '</p>' +
      '</div>';

    const buildFilters = () => {
      if (!filterBar) return;
      filterBar.innerHTML = '';
      const mk = (slug, label, n, empty) => {
        const b = document.createElement('button');
        b.type = 'button';
        b.dataset.filter = slug;
        b.setAttribute('aria-pressed', String(slug === current));
        if (slug === current) b.classList.add('is-active');
        if (empty) { b.classList.add('is-empty'); b.disabled = true; b.title = 'Wkrótce — brak wpisów'; }
        b.innerHTML = esc(label) + ' <span class="cnt">' + n + '</span>';
        return b;
      };
      filterBar.appendChild(mk('all', 'Wszystkie', DATA.length, false));
      (window.BLOG_CATS || []).forEach((c) => {
        const n = counts[c.slug] || 0;
        filterBar.appendChild(mk(c.slug, c.label, n, n === 0));
      });
    };

    const animateIn = () => {
      const els = [...blogWrap.querySelectorAll('.blog-card')];
      if (prefersReduced) { els.forEach((el) => el.classList.add('in')); return; }
      els.forEach((el, i) => {
        el.style.transitionDelay = Math.min(i * 55, 330) + 'ms';
        requestAnimationFrame(() => requestAnimationFrame(() => el.classList.add('in')));
      });
    };

    const matches = (p) => {
      if (current !== 'all' && p.cat !== current) return false;
      if (query) {
        const q = query.toLowerCase();
        if (!(p.title.toLowerCase().includes(q) || p.excerpt.toLowerCase().includes(q))) return false;
      }
      return true;
    };

    const updateCount = (total) => {
      if (!countEl) return;
      if (query) countEl.textContent = total ? ('Znaleziono ' + total + ' ' + plural(total)) : '';
      else if (current !== 'all') countEl.textContent = total + ' ' + plural(total) + ' w kategorii „' + (blogLabels[current] || '') + '”';
      else countEl.textContent = '';
    };

    const render = () => {
      const showFeatured = (current === 'all' && !query);
      let list = DATA.filter(matches);
      const total = list.length;
      if (featuredWrap) {
        featuredWrap.innerHTML = '';
        if (showFeatured && list.length) { featuredWrap.appendChild(featured(list[0])); list = list.slice(1); }
      }
      blogWrap.innerHTML = '';
      if (!list.length && !(showFeatured && total)) {
        blogWrap.classList.remove('grid', 'cols-3');
        blogWrap.insertAdjacentHTML('beforeend', emptyState(query ? ('Nie znaleźliśmy wpisów pasujących do „' + query + '”. Spróbuj innego słowa.') : 'W tej kategorii nie ma jeszcze wpisów.'));
      } else {
        blogWrap.classList.add('grid', 'cols-3');
        list.forEach((p) => blogWrap.appendChild(blogCard(p)));
        animateIn();
      }
      updateCount(total);
    };

    if (filterBar) {
      buildFilters();
      filterBar.addEventListener('click', (e) => {
        const btn = e.target.closest('button[data-filter]');
        if (!btn || btn.disabled) return;
        filterBar.querySelectorAll('button[data-filter]').forEach((b) => {
          const on = b === btn;
          b.classList.toggle('is-active', on);
          b.setAttribute('aria-pressed', String(on));
        });
        current = btn.dataset.filter;
        render();
      });
    }
    if (searchInput) {
      let t;
      searchInput.addEventListener('input', () => {
        clearTimeout(t);
        t = setTimeout(() => { query = searchInput.value.trim(); render(); }, 120);
      });
    }
    render();
  }

  /* ---- Blog: strona artykułu — powiązane wpisy + prev/next ---- */
  const postSlug = document.body.getAttribute('data-post');
  const relWrap = document.getElementById('post-related');
  const navWrap = document.getElementById('post-nav');
  if (postSlug && Array.isArray(window.BLOG) && (relWrap || navWrap)) {
    const DATA = window.BLOG;
    const idx = DATA.findIndex((p) => p.slug === postSlug);
    if (idx !== -1) {
      // DATA: od najnowszego. „Poprzedni" = starszy (idx+1), „Następny" = nowszy (idx-1).
      if (navWrap) {
        const older = DATA[idx + 1], newer = DATA[idx - 1];
        const tile = (p, dir) => {
          const lbl = dir === 'next' ? 'Następny →' : '← Poprzedni';
          if (!p) return '<span class="' + dir + ' is-disabled"><span class="lbl">' + lbl + '</span><span class="ttl">—</span></span>';
          return '<a class="' + dir + '" href="' + p.url + '"><span class="lbl">' + lbl + '</span><span class="ttl">' + esc(p.title) + '</span></a>';
        };
        navWrap.innerHTML = tile(older, 'prev') + tile(newer, 'next');
      }
      if (relWrap) {
        const self = DATA[idx];
        const sameCat = DATA.filter((p) => p.slug !== postSlug && p.cat === self.cat);
        const others = DATA.filter((p) => p.slug !== postSlug && p.cat !== self.cat);
        const rel = sameCat.concat(others).slice(0, 3);
        rel.forEach((p) => { const c = blogCard(p); c.classList.add('in'); relWrap.appendChild(c); });
        const section = relWrap.closest('.post-extra, section');
        if (!rel.length && section) section.style.display = 'none';
      }
    }
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

  /* ---- Hero: latające zdjęcia dzieci (wejście + parallax od myszki) ---- */
  (function () {
    const layer = document.querySelector('.hero__floating');
    if (!layer) return;
    const floats = Array.prototype.slice.call(layer.querySelectorAll('.hero__float'));
    if (!floats.length) return;
    const hero = layer.closest('.hero');

    // wejście — fade-in ze stagger
    const reveal = () => floats.forEach((el, i) => setTimeout(() => el.classList.add('is-in'), 120 + i * 80));
    if (document.readyState === 'complete') reveal();
    else window.addEventListener('load', reveal);

    // parallax tylko z myszką (desktop) i bez reduced-motion
    if (prefersReduced || !window.matchMedia('(pointer: fine)').matches) return;

    const items = floats.map((el) => ({ el, depth: parseFloat(el.dataset.depth) || 1, x: 0, y: 0 }));
    let tgX = 0, tgY = 0, raf = null;
    const tick = () => {
      let moving = false;
      items.forEach((it) => {
        const strength = (it.depth * 1.6) / 20;
        const nx = tgX * strength, ny = tgY * strength;
        it.x += (nx - it.x) * 0.06;
        it.y += (ny - it.y) * 0.06;
        it.el.style.transform = 'translate3d(' + it.x.toFixed(2) + 'px,' + it.y.toFixed(2) + 'px,0)';
        if (Math.abs(nx - it.x) > 0.1 || Math.abs(ny - it.y) > 0.1) moving = true;
      });
      raf = moving ? requestAnimationFrame(tick) : null;
    };
    hero.addEventListener('mousemove', (e) => {
      const r = hero.getBoundingClientRect();
      tgX = e.clientX - r.left - r.width / 2;
      tgY = e.clientY - r.top - r.height / 2;
      if (!raf) raf = requestAnimationFrame(tick);
    });
    hero.addEventListener('mouseleave', () => { tgX = 0; tgY = 0; if (!raf) raf = requestAnimationFrame(tick); });
  })();

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

  /* ---- Magiczna warstwa dekoracji (cała strona oprócz hero) ---- */
  (function () {
    if (document.querySelector('.magic-layer')) return;

    const ICONS = {
      wand: '<svg viewBox="0 0 24 24" fill="currentColor"><g transform="rotate(-45 12 12)"><rect x="4" y="11" width="13" height="2.4" rx="1.2"/></g><path d="M17.5 2l1 2 2 1-2 1-1 2-1-2-2-1 2-1z"/></svg>',
      star: '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3 6 7 .5-5 4.5 1.5 7L12 16l-6.5 4 1.5-7-5-4.5 7-.5z"/></svg>',
      sparkle: '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l1.6 7.4L21 12l-7.4 1.6L12 21l-1.6-7.4L3 12l7.4-1.6z"/></svg>',
      hat: '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.5L4 19h16L12 2.5z"/><rect x="2.5" y="18.6" width="19" height="2.8" rx="1.4"/><path d="M12 10.5l.7 1.5 1.6.2-1.2 1.1.3 1.6-1.4-.8-1.4.8.3-1.6-1.2-1.1 1.6-.2z" fill="#fff" fill-opacity=".75"/></svg>',
      moon: '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M20 14.3A8 8 0 1 1 10.8 4 6.3 6.3 0 0 0 20 14.3z"/></svg>',
      book: '<svg viewBox="0 0 24 24" fill="currentColor"><rect x="4.5" y="3.5" width="15" height="17" rx="2"/><rect x="4.5" y="3.5" width="3.4" height="17" rx="1.4" fill="#000" fill-opacity=".18"/><path d="M13.3 8l.8 1.7 1.9.2-1.4 1.3.4 1.9-1.7-1-1.7 1 .4-1.9-1.4-1.3 1.9-.2z" fill="#fff" fill-opacity=".85"/></svg>',
      potion: '<svg viewBox="0 0 24 24" fill="currentColor"><rect x="9" y="2.2" width="6" height="2.6" rx="1.3"/><path d="M10 4.5h4v4l4 7a3 3 0 0 1-2.6 4.5H8.6A3 3 0 0 1 6 15.5l4-7z"/><circle cx="11" cy="15.5" r="1" fill="#fff" fill-opacity=".8"/><circle cx="13.4" cy="13.6" r=".7" fill="#fff" fill-opacity=".7"/></svg>'
    };
    const PAL = ['var(--purple)', 'var(--pink)', 'var(--sky)', 'var(--amber)', 'var(--green)', 'var(--yellow)'];
    const ITEMS = [
      { t: 'wand',    top: 12, left: 5,  sz: 48, op: .24, dur: 11,   delay: -1.5, mx: 20,  my: -24, mr: 13 },
      { t: 'sparkle', top: 8,  left: 90, sz: 28, op: .22, dur: 8,    delay: -3.2, mx: -16, my: -18, mr: -12 },
      { t: 'star',    top: 20, left: 16, sz: 26, op: .20, dur: 7.5,  delay: -0.6, mx: 14,  my: -16, mr: 14 },
      { t: 'wand',    top: 28, left: 84, sz: 46, op: .22, dur: 12,   delay: -2.1, mx: -20, my: -26, mr: -11 },
      { t: 'hat',     top: 38, left: 6,  sz: 50, op: .22, dur: 13,   delay: -4.0, mx: 18,  my: -22, mr: 10 },
      { t: 'sparkle', top: 46, left: 91, sz: 30, op: .20, dur: 11.5, delay: -1.1, mx: -18, my: -24, mr: 12 },
      { t: 'wand',    top: 56, left: 12, sz: 44, op: .22, dur: 8.5,  delay: -2.7, mx: 20,  my: -22, mr: -14 },
      { t: 'star',    top: 64, left: 87, sz: 26, op: .20, dur: 7.8,  delay: -0.4, mx: -14, my: -24, mr: 12 },
      { t: 'potion',  top: 74, left: 5,  sz: 42, op: .22, dur: 12.5, delay: -3.6, mx: 16,  my: -26, mr: 10 },
      { t: 'hat',     top: 82, left: 82, sz: 48, op: .22, dur: 10.5, delay: -1.8, mx: -20, my: -24, mr: -12 },
      { t: 'sparkle', top: 90, left: 20, sz: 30, op: .20, dur: 9,    delay: -5.0, mx: 18,  my: -20, mr: 14 },
      { t: 'wand',    top: 88, left: 92, sz: 42, op: .20, dur: 8.2,  delay: -2.3, mx: -16, my: -22, mr: -12 },
      { t: 'moon',    top: 6,  left: 38, sz: 38, op: .18, dur: 11,   delay: -4.4, mx: 16,  my: -24, mr: 10 },
      { t: 'star',    top: 96, left: 55, sz: 28, op: .18, dur: 12,   delay: -0.9, mx: -16, my: -20, mr: -10 },
      { t: 'book',    top: 16, left: 72, sz: 40, op: .20, dur: 11,   delay: -1.2, mx: -16, my: -24, mr: 10 },
      { t: 'wand',    top: 34, left: 50, sz: 44, op: .16, dur: 12.5, delay: -3.0, mx: 20,  my: -28, mr: 13 },
      { t: 'sparkle', top: 52, left: 31, sz: 28, op: .17, dur: 9.5,  delay: -2.0, mx: 16,  my: -20, mr: -12 },
      { t: 'star',    top: 68, left: 60, sz: 26, op: .16, dur: 8.8,  delay: -4.6, mx: -14, my: -22, mr: 12 },
      { t: 'moon',    top: 78, left: 40, sz: 36, op: .17, dur: 13,   delay: -1.6, mx: 16,  my: -24, mr: -10 },
      { t: 'wand',    top: 22, left: 60, sz: 46, op: .18, dur: 10,   delay: -2.8, mx: -20, my: -26, mr: 12 },
      { t: 'hat',     top: 62, left: 23, sz: 46, op: .20, dur: 11.5, delay: -3.4, mx: 18,  my: -24, mr: -11 },
      { t: 'sparkle', top: 44, left: 70, sz: 30, op: .18, dur: 9.2,  delay: -0.7, mx: -16, my: -20, mr: 12 }
    ];

    const layer = document.createElement('div');
    layer.className = 'magic-layer';
    layer.setAttribute('aria-hidden', 'true');
    layer.innerHTML = ITEMS.map((it, i) => {
      const c = PAL[i % PAL.length];
      const style = 'top:' + it.top + '%;left:' + it.left + '%;'
        + '--sz:' + it.sz + 'px;--c:' + c + ';--op:' + it.op + ';'
        + '--dur:' + it.dur + 's;animation-delay:' + it.delay + 's;'
        + '--mx:' + it.mx + 'px;--my:' + it.my + 'px;--mr:' + it.mr + 'deg;';
      return '<span class="magic-item" style="' + style + '">' + (ICONS[it.t] || ICONS.star) + '</span>';
    }).join('');
    document.body.appendChild(layer);

    // Chowaj na hero (strona główna: .hero; podstrony: .page-hero)
    const hero = document.querySelector('.hero, .page-hero');
    if (hero && 'IntersectionObserver' in window) {
      const io = new IntersectionObserver((entries) => {
        entries.forEach((e) => layer.classList.toggle('is-hidden', e.isIntersecting));
      }, { threshold: 0 });
      io.observe(hero);
    }
  })();
})();
