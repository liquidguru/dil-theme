/* global DIL */
'use strict';

(function () {

  /* ── Dark mode toggle ────────────────────────────────────── */

  const DARK_KEY = 'dil-theme';

  function applyTheme( theme ) {
    if ( theme === 'dark' ) {
      document.documentElement.setAttribute( 'data-theme', 'dark' );
    } else {
      document.documentElement.removeAttribute( 'data-theme' );
    }
    localStorage.setItem( DARK_KEY, theme );
  }

  document.querySelectorAll( '.dark-mode-toggle' ).forEach( btn => {
    btn.addEventListener( 'click', () => {
      const isDark = document.documentElement.getAttribute( 'data-theme' ) === 'dark';
      applyTheme( isDark ? 'light' : 'dark' );
    } );
  } );

  /* ── Sticky nav ──────────────────────────────────────────── */

  const header = document.getElementById('site-header');

  if (header) {
    let ticking = false;

    const onScroll = () => {
      if (!ticking) {
        requestAnimationFrame(() => {
          header.classList.toggle('is-scrolled', window.scrollY > 80);
          setHeaderHeight();
          ticking = false;
        });
        ticking = true;
      }
    };

    window.addEventListener('scroll', onScroll, { passive: true });
  }

  /* ── Mobile nav ──────────────────────────────────────────── */

  const hamburger        = document.getElementById('nav-hamburger');
  const hamburgerCompact = document.getElementById('nav-hamburger-compact');
  const mobileNav        = document.getElementById('mobile-nav');
  const mobileClose      = document.getElementById('mobile-nav-close');

  function openMobileNav() {
    mobileNav.classList.add('is-open');
    document.body.style.overflow = 'hidden';
    mobileClose.focus();
  }

  function closeMobileNav() {
    mobileNav.classList.remove('is-open');
    document.body.style.overflow = '';
    hamburger && hamburger.focus();
  }

  hamburger        && hamburger.addEventListener('click', openMobileNav);
  hamburgerCompact && hamburgerCompact.addEventListener('click', openMobileNav);
  mobileClose      && mobileClose.addEventListener('click', closeMobileNav);

  // Close on Escape
  document.addEventListener('keydown', e => {
    if (e.key === 'Escape' && mobileNav && mobileNav.classList.contains('is-open')) {
      closeMobileNav();
    }
  });

  /* ── Accordion ───────────────────────────────────────────── */

  function initAccordions(root) {
    root = root || document;
    const accordions = root.querySelectorAll('.accordion');

    accordions.forEach(accordion => {
      const items = accordion.querySelectorAll('.accordion__item');

      // Open first item by default
      if (items[0] && !items[0].classList.contains('is-open')) {
        items[0].classList.add('is-open');
        const body = items[0].querySelector('.accordion__body');
        const icon = items[0].querySelector('.accordion__icon');
        if (body) body.style.display = 'block';
        if (icon) icon.textContent = '−';
      }

      items.forEach(item => {
        const trigger = item.querySelector('.accordion__trigger');
        if (!trigger) return;

        trigger.addEventListener('click', () => {
          const isOpen = item.classList.contains('is-open');

          // Close all items in this accordion
          items.forEach(i => {
            i.classList.remove('is-open');
            const b = i.querySelector('.accordion__body');
            const ico = i.querySelector('.accordion__icon');
            if (b) b.style.display = 'none';
            if (ico) ico.textContent = '+';
          });

          // Open clicked item if it was closed
          if (!isOpen) {
            item.classList.add('is-open');
            const body = item.querySelector('.accordion__body');
            const icon = item.querySelector('.accordion__icon');
            if (body) body.style.display = 'block';
            if (icon) icon.textContent = '−';
          }
        });

        // ARIA
        trigger.setAttribute('aria-expanded', item.classList.contains('is-open') ? 'true' : 'false');
      });
    });
  }

  initAccordions();

  /* ── Critter Compass ─────────────────────────────────────── */

  const CRITTERS = [
    {
      id:    'hairy-frogfish',
      name:  'Hairy Frogfish',
      latin: 'Antennarius striatus',
      depth: '5 – 40 m',
      angle: 0,
      img:   'hairy-frogfish.jpg',
    },
    {
      id:    'mimic-octopus',
      name:  'Mimic Octopus',
      latin: 'Thaumoctopus mimicus',
      depth: '3 – 20 m',
      angle: 45,
      img:   'mimic-octopus.jpg',
    },
    {
      id:    'blue-ringed-octopus',
      name:  'Blue-Ringed Octopus',
      latin: 'Hapalochlaena lunulata',
      depth: '1 – 20 m',
      angle: 90,
      img:   'blue-ringed-octopus.jpg',
    },
    {
      id:    'mandarin-fish',
      name:  'Mandarin Fish',
      latin: 'Synchiropus splendidus',
      depth: '1 – 18 m',
      angle: 135,
      img:   'mandarin-fish.jpg',
    },
    {
      id:    'flamboyant-cuttlefish',
      name:  'Flamboyant Cuttlefish',
      latin: 'Metasepia pfefferi',
      depth: '3 – 30 m',
      angle: 180,
      img:   'flamboyant-cuttlefish.jpg',
    },
    {
      id:    'rhinopias',
      name:  'Rhinopias',
      latin: 'Rhinopias frondosa',
      depth: '10 – 30 m',
      angle: 225,
      img:   'rhinopias.jpg',
    },
    {
      id:    'melibe-colemani',
      name:  'Melibe Colemani',
      latin: 'Melibe colemani',
      depth: '5 – 25 m',
      angle: 270,
      img:   'melibe-colemani.jpg',
    },
    {
      id:    'pygmy-seahorse',
      name:  'Pygmy Seahorse',
      latin: 'Hippocampus bargibanti',
      depth: '10 – 40 m',
      angle: 315,
      img:   'pygmy-seahorse.jpg',
    },
  ];

  function buildCritterCompass(container) {
    if (!container) return;

    const svg        = container.querySelector('.critter-compass__svg');
    const infoBox    = container.querySelector('.critter-compass__info');
    const critterUrl = (container.dataset.crittersUrl || '').replace(/\/$/, '') + '/';

    if (!svg || !infoBox) return;

    const cx = 260, cy = 260, r = 220;
    const ns = 'http://www.w3.org/2000/svg';

    // Background ring
    const ring = document.createElementNS(ns, 'circle');
    ring.setAttribute('cx', cx); ring.setAttribute('cy', cy);
    ring.setAttribute('r', r); ring.setAttribute('fill', 'none');
    ring.setAttribute('stroke', 'rgba(110,31,34,0.14)');
    ring.setAttribute('stroke-width', '1');
    svg.appendChild(ring);

    // Center dot
    const dot = document.createElementNS(ns, 'circle');
    dot.setAttribute('cx', cx); dot.setAttribute('cy', cy);
    dot.setAttribute('r', '4');
    dot.setAttribute('fill', 'rgba(110,31,34,0.3)');
    svg.appendChild(dot);

    CRITTERS.forEach(critter => {
      const rad = (critter.angle - 90) * Math.PI / 180;
      const px  = cx + r * Math.cos(rad);
      const py  = cy + r * Math.sin(rad);

      const g = document.createElementNS(ns, 'g');
      g.setAttribute('class', 'critter-pin');
      g.setAttribute('tabindex', '0');
      g.setAttribute('role', 'button');
      g.setAttribute('aria-label', critter.name);

      // Radial line from center to pin
      const line = document.createElementNS(ns, 'line');
      line.setAttribute('x1', cx); line.setAttribute('y1', cy);
      line.setAttribute('x2', px); line.setAttribute('y2', py);
      line.setAttribute('stroke', 'rgba(110,31,34,0.18)');
      line.setAttribute('stroke-width', '0.6');
      g.appendChild(line);

      // Pin circle
      const circle = document.createElementNS(ns, 'circle');
      circle.setAttribute('cx', px); circle.setAttribute('cy', py);
      circle.setAttribute('r', '18');
      circle.setAttribute('fill', '#F5ECDC');
      circle.setAttribute('stroke', 'rgba(110,31,34,0.35)');
      circle.setAttribute('stroke-width', '1');
      g.appendChild(circle);

      // Label
      const text = document.createElementNS(ns, 'text');
      text.setAttribute('x', px); text.setAttribute('y', py + 4);
      text.setAttribute('text-anchor', 'middle');
      text.setAttribute('font-size', '8');
      text.setAttribute('font-family', 'var(--font-mono, monospace)');
      text.setAttribute('letter-spacing', '0');
      text.setAttribute('fill', '#6E1F22');
      text.setAttribute('pointer-events', 'none');
      const abbrev = critter.name.split(' ').map(w => w[0]).join('').substring(0, 3).toUpperCase();
      text.textContent = abbrev;
      g.appendChild(text);

      g.addEventListener('click',     () => activateCritter(critter, g));
      g.addEventListener('mouseenter',() => activateCritter(critter, g));
      g.addEventListener('keydown', e => {
        if (e.key === 'Enter' || e.key === ' ') {
          e.preventDefault();
          activateCritter(critter, g);
        }
      });

      svg.appendChild(g);
    });

    let activePin = null;

    function activateCritter(critter, pin) {
      // Reset all pins
      svg.querySelectorAll('.critter-pin').forEach(p => {
        p.classList.remove('is-active');
        const c = p.querySelector('circle');
        const l = p.querySelector('line');
        if (c) { c.setAttribute('r', '18'); c.setAttribute('fill', '#F5ECDC'); }
        if (l) { l.setAttribute('stroke', 'rgba(110,31,34,0.18)'); l.setAttribute('stroke-width', '0.6'); }
      });

      // Activate clicked pin
      pin.classList.add('is-active');
      const c = pin.querySelector('circle');
      const l = pin.querySelector('line');
      if (c) { c.setAttribute('r', '22'); c.setAttribute('fill', '#6E1F22'); }
      if (l) { l.setAttribute('stroke', '#6E1F22'); l.setAttribute('stroke-width', '1.5'); }

      // Update text color on active
      const t = pin.querySelector('text');
      if (t) t.setAttribute('fill', '#F5ECDC');

      // Show critter info
      const imgSrc = critter.img ? critterUrl + escHtml(critter.img) : '';
      infoBox.innerHTML = `
        <div class="critter-card">
          ${imgSrc ? `<div class="critter-card__photo grid-tile" data-full="${imgSrc}" data-alt="${escHtml(critter.name)}"><img src="${imgSrc}" alt="${escHtml(critter.name)}" loading="lazy"></div>` : ''}
          <div class="critter-card__name">${escHtml(critter.name)}</div>
          <div class="critter-card__latin">${escHtml(critter.latin)}</div>
          <div class="critter-card__depth">${escHtml(critter.depth)}</div>
        </div>
      `;

      activePin = pin;
    }
  }

  const compass = document.querySelector('.critter-compass');
  buildCritterCompass(compass);

  /* ── Cycling words ──────────────────────────────────────── */

  document.querySelectorAll('.cycle-words').forEach(container => {
    const words   = Array.from( container.querySelectorAll('.cycle-words__word') );
    if ( words.length < 2 ) return;

    let current = 0;

    // Set initial width to prevent layout jump during transitions
    const setWidth = () => {
      let maxWidth = 0;
      words.forEach(w => {
        w.style.position = 'relative';
        w.style.opacity  = '1';
        maxWidth = Math.max( maxWidth, w.offsetWidth );
        w.style.position = '';
        w.style.opacity  = '';
      });
      container.style.minWidth = maxWidth + 'px';
      container.style.display  = 'inline-block';
    };

    setWidth();

    if ( window.matchMedia('(prefers-reduced-motion: reduce)').matches ) return;

    setInterval(() => {
      words[current].classList.remove('is-active');
      current = ( current + 1 ) % words.length;
      words[current].classList.add('is-active');
    }, 2800);
  });

  /* ── Hero slideshow ─────────────────────────────────────── */

  const heroSlides = Array.from( document.querySelectorAll('.hero__slide') );

  if ( heroSlides.length > 1 && !window.matchMedia('(prefers-reduced-motion: reduce)').matches ) {
    let currentSlide = 0;

    setInterval(() => {
      heroSlides[currentSlide].classList.remove('is-active');
      currentSlide = ( currentSlide + 1 ) % heroSlides.length;
      heroSlides[currentSlide].classList.add('is-active');
    }, 5000);
  }

  /* ── Hero parallax ───────────────────────────────────────── */

  const heroBg = document.querySelector('.hero__bg');

  if (heroBg && !window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
    window.addEventListener('scroll', () => {
      const y = window.scrollY;
      if (y < window.innerHeight) {
        heroBg.style.transform = `translateY(${y * 0.35}px)`;
      }
    }, { passive: true });
  }

  /* ── Night-dive hero ─────────────────────────────────────────
     Torch follows the mouse (tap to aim on touch); a strobe flash changes the
     slide and the beam eases back from full frame to torch size; a hidden
     critter waits in the dark. Opens fully lit, then the first strobe drops
     it to torchlight. Reduced motion: plain slide change, no torch. */

  const ndHero = document.querySelector('.hero--nightdive');
  if (ndHero) initNightDive(ndHero);

  function initNightDive(hero) {
    const SLIDES = JSON.parse(hero.dataset.slides || '[]');
    const HIDERS = JSON.parse(hero.dataset.hidden || '[]');
    if (!SLIDES.length) return;

    const STROBE_EVERY = 7000;   // ms between auto strobes (= slide changes)
    const TARGET_DEPTH = 18.4;   // metres the descent counts to
    const INTRO_LIT    = 2200;   // opens fully lit for this long, then the first strobe
    const FLASH_HOLD   = 700, FLASH_FADE = 2600;
    const DWELL        = 650;    // ms the torch must rest on the hider to spot it

    const $ = sel => hero.querySelector(sel);
    const imgs    = hero.querySelectorAll('.nd-img');
    const strobe  = $('.nd-strobe'), caption = $('.nd-caption'), hint = $('.nd-hint');
    const hc      = $('.nd-hider'), ring = $('.nd-ring'), label = $('.nd-spot-label'), countEl = $('.nd-count');
    const reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const touch   = window.matchMedia('(hover: none)').matches;
    const pad2    = n => String(n).padStart(2, '0');
    const esc     = s => String(s).replace(/[&<>"']/g, c => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c]));

    hint.textContent = touch ? hero.dataset.hintTouch : hero.dataset.hintMouse;

    // Size the hero to the screen below the header (measured at load/resize only, not on scroll)
    const siteHeader = document.getElementById('site-header');
    const fitHero = () => { if (siteHeader && window.scrollY < 10) hero.style.setProperty('--nd-header', siteHeader.offsetHeight + 'px'); };
    fitHero();
    window.addEventListener('resize', fitHero);
    SLIDES.forEach(s => { const i = new Image(); i.src = s.src; });
    HIDERS.forEach(h => { const i = new Image(); i.src = h.src; });

    let idx = 0;
    function show(i) {
      const s = SLIDES[i];
      imgs.forEach(el => { el.classList.remove('is-drifting'); el.src = s.src; void el.offsetWidth; el.classList.add('is-drifting'); });
      $('.nd-frame').textContent = `${hero.dataset.frame} ${pad2(i + 1)}/${pad2(SLIDES.length)}`;
      $('.nd-name').textContent = s.name || '';
      caption.classList.remove('is-shown'); setTimeout(() => caption.classList.add('is-shown'), 400);
    }
    show(0);
    if (!reduced) hero.classList.add('is-live');

    const t0 = performance.now();

    // Strobe: next slide, beam pushed out to full frame, then eased back to torch size
    let flashAt = -1e9;
    function fireStrobe(advance = true) {
      if (advance) idx = (idx + 1) % SLIDES.length;
      if (reduced) { if (advance) show(idx); return; }
      strobe.classList.remove('is-firing'); void strobe.offsetWidth; strobe.classList.add('is-firing');
      flashAt = performance.now();
      if (advance) setTimeout(() => show(idx), 60);
      hideCritter();
      setTimeout(placeCritter, FLASH_HOLD + FLASH_FADE - 300);
    }
    const easeInOut = p => p < .5 ? 4 * p * p * p : 1 - Math.pow(-2 * p + 2, 3) / 2;
    function beamRadius(now, base, full) {
      if (flashAt < t0) return full;                     // opening: fully lit until the first strobe
      const since = now - flashAt;
      let boost = 0;
      if (since < 0) boost = 0;
      else if (since < 120) boost = since / 120;
      else if (since < FLASH_HOLD) boost = 1;
      else if (since < FLASH_HOLD + FLASH_FADE) boost = 1 - easeInOut((since - FLASH_HOLD) / FLASH_FADE);
      return base + (full - base) * boost;
    }

    // Torch position: follows the mouse, or wherever a finger tapped; wanders when left alone
    let tx = hero.clientWidth / 2, ty = hero.clientHeight * .45, cx = tx, cy = ty, curR = 0, lastMove = -1e9;

    // Auto strobe waits while someone is steering the torch, so it doesn't swap the hider mid-hunt
    const autoStrobe = () => { if (performance.now() - lastMove > 2500) fireStrobe(); };
    let autoTimer = null;
    function manualStrobe() {
      if (performance.now() - flashAt < 900) return;     // strobe recycle time
      fireStrobe();
      clearInterval(autoTimer); autoTimer = setInterval(autoStrobe, STROBE_EVERY);
    }
    setTimeout(() => {
      if (flashAt < t0) fireStrobe(false);                 // opening flash on the first photo
      if (!autoTimer) autoTimer = setInterval(autoStrobe, STROBE_EVERY);
    }, INTRO_LIT);

    let lastPointer = 'mouse';
    hero.addEventListener('pointerdown', e => { lastPointer = e.pointerType; });
    hero.addEventListener('pointermove', e => {
      if (e.pointerType !== 'mouse') return;
      const r = hero.getBoundingClientRect(); tx = e.clientX - r.left; ty = e.clientY - r.top;
      lastMove = performance.now(); hint.style.opacity = 0;
    });
    // Mouse: click fires the strobe. Touch: tap aims the torch; the shutter button fires it.
    hero.addEventListener('click', e => {
      if (e.target.closest('a, button')) return;
      const r = hero.getBoundingClientRect(), x = e.clientX - r.left, y = e.clientY - r.top;
      if (clickFindsCritter(x, y)) return;
      if (lastPointer === 'mouse') { manualStrobe(); return; }
      tx = x; ty = y; lastMove = performance.now(); hint.style.opacity = 0;
    });
    $('.nd-shutter').addEventListener('click', manualStrobe);
    setTimeout(() => { if (performance.now() - lastMove > 4000) hint.style.opacity = 0; }, INTRO_LIT + 4000);

    function torchTick(now) {
      const W = hero.clientWidth, H = hero.clientHeight;
      if (now - lastMove > (touch ? 6000 : 3500)) {
        const s = now / 1000;
        tx = W * (.5 + .32 * Math.sin(s * .37) * Math.cos(s * .13));
        ty = H * (.42 + .22 * Math.sin(s * .51 + 1.3));
      }
      cx += (tx - cx) * .12; cy += (ty - cy) * .12;
      curR = beamRadius(now, Math.max(170, Math.min(W, H) * .36), Math.hypot(W, H) * 1.15);
      hero.style.setProperty('--nd-x', cx + 'px');
      hero.style.setProperty('--nd-y', cy + 'px');
      hero.style.setProperty('--nd-r', curR + 'px');
      requestAnimationFrame(torchTick);
    }

    // Dive computer: depth counts down on arrival, then bobs; dive timer ticks
    const depthEl = $('.nd-depth'), timeEl = $('.nd-time');
    function hudTick(now) {
      const t = (now - t0) / 1000;
      const p = Math.min(t / 4, 1), ease = 1 - Math.pow(1 - p, 3);
      depthEl.textContent = (TARGET_DEPTH * ease + (p === 1 ? Math.sin(t * .6) * .15 : 0)).toFixed(1);
      timeEl.textContent = `${pad2(Math.floor(t / 60))}:${pad2(Math.floor(t % 60))}`;
      requestAnimationFrame(hudTick);
    }
    requestAnimationFrame(hudTick);

    // Hidden critter: only visible in the torch beam; rest the torch on it (or tap it) to spot it
    let hider = null, hx = 0, hy = 0, hsize = 90, found = true, dwellStart = 0, spotted = 0;
    let hiderIdx = Math.floor(Math.random() * Math.max(HIDERS.length, 1));
    const overlaps = (x, y, pad, el) => {
      const hr = hero.getBoundingClientRect(), b = el.getBoundingClientRect();
      if (!b.width) return false;
      return x > b.left - hr.left - pad && x < b.right - hr.left + pad && y > b.top - hr.top - pad && y < b.bottom - hr.top + pad;
    };
    function placeCritter() {
      if (reduced || !HIDERS.length) return;
      const W = hero.clientWidth, H = hero.clientHeight;
      hsize = Math.round(Math.max(64, Math.min(110, Math.min(W, H) * .11)));
      const avoid = [...hero.querySelectorAll('.hero__headline, .hero__ctas, .nd-hud, .nd-shutter')];
      for (let tries = 0; tries < 60; tries++) {
        const x = W * (.08 + Math.random() * .84), y = H * (.16 + Math.random() * .68);
        if (avoid.some(el => overlaps(x, y, hsize * .8, el))) continue;
        hx = x; hy = y; break;
      }
      hider = HIDERS[hiderIdx++ % HIDERS.length];
      hc.src = hider.src;
      hc.style.left = (hx - hsize / 2) + 'px'; hc.style.top = (hy - hsize / 2) + 'px';
      hc.style.setProperty('--nd-hs', hsize + 'px'); hc.style.setProperty('--nd-hr', (Math.random() * 50 - 25) + 'deg');
      found = false; dwellStart = 0; hc.classList.add('is-hiding');
    }
    function hideCritter() { hc.classList.remove('is-hiding'); label.classList.remove('is-shown'); found = true; }
    function markFound() {
      found = true; spotted++; countEl.textContent = spotted;
      ring.style.left = hx + 'px'; ring.style.top = hy + 'px';
      ring.classList.remove('is-pulsing'); void ring.offsetWidth; ring.classList.add('is-pulsing');
      label.innerHTML = `${esc(hero.dataset.spotted)} <b>${esc(hider.name)}</b>`;
      label.style.left = Math.min(hx + hsize * .6, hero.clientWidth - 260) + 'px'; label.style.top = (hy - 14) + 'px';
      label.classList.add('is-shown');
      setTimeout(() => label.classList.remove('is-shown'), 3200);
    }
    function clickFindsCritter(x, y) {
      if (found || !hider) return false;
      if (Math.hypot(hx - cx, hy - cy) > curR * .9) return false;   // must be lit — no blind lucky taps
      if (Math.hypot(x - hx, y - hy) > hsize * .75) return false;
      markFound(); return true;
    }
    function dwellTick(now) {
      if (!found && hider && now - lastMove < 3500 && Math.hypot(cx - hx, cy - hy) < Math.max(55, hsize * .6)) {
        if (!dwellStart) dwellStart = now;
        else if (now - dwellStart > DWELL) markFound();
      } else dwellStart = 0;
      requestAnimationFrame(dwellTick);
    }

    // Marine snow + the odd bubble stream; particles glint inside the beam
    const cv = $('.nd-snow'), ctx = cv.getContext('2d');
    let W, H, flakes = [], bubbles = [];
    function resize() {
      const DPR = Math.min(window.devicePixelRatio || 1, touch ? 1.5 : 2);
      W = hero.clientWidth; H = hero.clientHeight;
      cv.width = W * DPR; cv.height = H * DPR; ctx.setTransform(DPR, 0, 0, DPR, 0, 0);
      const n = Math.round(W * H / (W < 700 ? 9000 : 5200));
      flakes = Array.from({ length: n }, () => ({ x: Math.random() * W, y: Math.random() * H,
        r: Math.random() * 1.6 + .3, vy: Math.random() * .25 + .05, ph: Math.random() * 6.28, z: Math.random() }));
    }
    function spawnBubbles() {
      const x = W * (.15 + Math.random() * .7);
      for (let i = 0; i < 6 + Math.random() * 8; i++)
        bubbles.push({ x: x + (Math.random() - .5) * 20, y: H + i * 22, r: Math.random() * 4 + 1.5, vy: 1 + Math.random() * 1.2, ph: Math.random() * 6 });
    }
    function snowTick(now) {
      ctx.clearRect(0, 0, W, H);
      const s = now / 1000, R = Math.max(curR, 1);
      for (const f of flakes) {
        f.y += f.vy * (0.5 + f.z); f.x += Math.sin(s * .5 + f.ph) * .15;
        if (f.y > H + 4) { f.y = -4; f.x = Math.random() * W; }
        const lit = Math.max(0, 1 - Math.hypot(f.x - cx, f.y - cy) / R);
        ctx.fillStyle = `rgba(255,244,225,${.06 + lit * .75 * (0.4 + f.z * .6)})`;
        ctx.beginPath(); ctx.arc(f.x, f.y, f.r * (0.6 + f.z), 0, 6.283); ctx.fill();
      }
      bubbles = bubbles.filter(b => b.y > -20);
      for (const b of bubbles) {
        b.y -= b.vy; b.vy *= 1.004; b.x += Math.sin(s * 3 + b.ph) * .5;
        const lit = Math.max(0, 1 - Math.hypot(b.x - cx, b.y - cy) / R);
        ctx.strokeStyle = `rgba(230,245,255,${.18 + lit * .6})`; ctx.lineWidth = 1;
        ctx.beginPath(); ctx.arc(b.x, b.y, b.r, 0, 6.283); ctx.stroke();
        ctx.fillStyle = `rgba(255,255,255,${.1 + lit * .5})`;
        ctx.beginPath(); ctx.arc(b.x - b.r * .35, b.y - b.r * .35, b.r * .25, 0, 6.283); ctx.fill();
      }
      requestAnimationFrame(snowTick);
    }

    if (!reduced) {
      resize(); window.addEventListener('resize', resize);
      setInterval(() => { if (!document.hidden) spawnBubbles(); }, 5200);
      requestAnimationFrame(torchTick);
      requestAnimationFrame(dwellTick);
      requestAnimationFrame(snowTick);
    }
  }

  /* ── Gallery filter tabs ─────────────────────────────────── */

  const galleryFilters = document.querySelector('.gallery-filters');
  const galleryGrid    = document.querySelector('.gallery-grid');

  if (galleryFilters && galleryGrid) {
    galleryFilters.addEventListener('click', e => {
      const btn = e.target.closest('.filter-tab');
      if (!btn) return;

      // Update active tab
      galleryFilters.querySelectorAll('.filter-tab').forEach(t => t.classList.remove('is-active'));
      btn.classList.add('is-active');

      const filter = btn.dataset.filter || 'all';

      galleryGrid.querySelectorAll('.gallery-grid__item').forEach(item => {
        if (filter === 'all' || item.dataset.category === filter) {
          item.classList.remove('is-hidden');
        } else {
          item.classList.add('is-hidden');
        }
      });
    });
  }

  /* ── Lightbox (gallery grid + inner-page photo tiles) ───── */

  const lightbox  = document.getElementById('dil-lightbox');
  const lbImg     = document.getElementById('lightbox-img');
  const lbCaption = document.getElementById('lightbox-caption');
  const lbClose   = document.getElementById('lightbox-close');
  const lbPrev    = document.getElementById('lightbox-prev');
  const lbNext    = document.getElementById('lightbox-next');

  if (lightbox) {
    let items        = [];
    let currentIndex = 0;

    function openLightbox(itemList, index) {
      items        = itemList;
      currentIndex = index;
      showSlide(currentIndex);
      lightbox.hidden = false;
      document.body.style.overflow = 'hidden';
      lbClose.focus();
    }

    function closeLightbox() {
      lightbox.hidden = true;
      document.body.style.overflow = '';
      lbImg.classList.remove('is-loaded');
    }

    function showSlide(index) {
      const item = items[index];
      if (!item) return;
      const src = item.dataset.full || item.querySelector('img')?.src || '';
      const alt = item.dataset.alt  || item.querySelector('img')?.alt || '';
      lbImg.classList.remove('is-loaded');
      lbImg.src             = src;
      lbImg.alt             = alt;
      lbCaption.textContent = alt;
      lbImg.onload = () => lbImg.classList.add('is-loaded');
      if (lbImg.complete) lbImg.classList.add('is-loaded');
      lbPrev.disabled = index === 0;
      lbNext.disabled = index === items.length - 1;
    }

    // Gallery grid items
    if (galleryGrid) {
      galleryGrid.addEventListener('click', e => {
        const btn     = e.target.closest('.gallery-grid__item');
        if (!btn) return;
        const visible = Array.from(galleryGrid.querySelectorAll('.gallery-grid__item:not(.is-hidden)'));
        const idx     = visible.indexOf(btn);
        if (idx !== -1) openLightbox(visible, idx);
      });
    }

    // Inner-page grid tiles (resort, diving, etc.)
    document.addEventListener('click', e => {
      const tile = e.target.closest('.grid-tile[data-full]');
      if (!tile) return;
      // Collect siblings within the same image-grid for prev/next context
      const grid  = tile.closest('.image-grid');
      const scope = grid || document;
      const tiles = Array.from(scope.querySelectorAll('.grid-tile[data-full]'));
      const idx   = tiles.indexOf(tile);
      if (idx !== -1) openLightbox(tiles, idx);
    });

    lbClose.addEventListener('click', closeLightbox);

    lightbox.addEventListener('click', e => {
      if (e.target === lightbox) closeLightbox();
    });

    lbPrev.addEventListener('click', () => {
      if (currentIndex > 0) { currentIndex--; showSlide(currentIndex); }
    });

    lbNext.addEventListener('click', () => {
      if (currentIndex < items.length - 1) { currentIndex++; showSlide(currentIndex); }
    });

    document.addEventListener('keydown', e => {
      if (lightbox.hidden) return;
      if (e.key === 'Escape')      closeLightbox();
      if (e.key === 'ArrowLeft'  && currentIndex > 0)               { currentIndex--; showSlide(currentIndex); }
      if (e.key === 'ArrowRight' && currentIndex < items.length - 1) { currentIndex++; showSlide(currentIndex); }
    });
  }

  /* ── Info page sub-nav (active on scroll) ────────────────── */

  const infoSubnav = document.querySelector('.info-subnav');

  if (infoSubnav) {
    const links    = Array.from(infoSubnav.querySelectorAll('a[href^="#"]'));
    const sections = links.map(l => document.querySelector(l.getAttribute('href'))).filter(Boolean);

    if (sections.length) {
      const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            const id   = '#' + entry.target.id;
            const link = infoSubnav.querySelector(`a[href="${id}"]`);
            links.forEach(l => l.classList.remove('is-active'));
            if (link) link.classList.add('is-active');
          }
        });
      }, { rootMargin: '-40% 0px -50% 0px' });

      sections.forEach(s => observer.observe(s));
    }
  }

  /* ── Contact form ────────────────────────────────────────── */

  const contactForm    = document.getElementById('dil-contact-form');
  const formSuccess    = document.getElementById('form-success');

  if (contactForm && typeof DIL !== 'undefined') {
    const REQUIRED_FIELDS = ['name', 'email', 'message'];

    function validateField(name, value) {
      if (name === 'email') {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value) ? null : 'Please enter a valid email address.';
      }
      return value.trim() ? null : 'This field is required.';
    }

    function setFieldError(name, msg) {
      const row = contactForm.querySelector(`[data-field="${name}"]`);
      if (!row) return;
      const errorEl = row.querySelector('.form-error');
      if (msg) {
        row.classList.add('has-error');
        if (errorEl) errorEl.textContent = msg;
      } else {
        row.classList.remove('has-error');
        if (errorEl) errorEl.textContent = '';
      }
    }

    contactForm.addEventListener('submit', e => {
      e.preventDefault();

      const data = new FormData(contactForm);
      let valid  = true;

      REQUIRED_FIELDS.forEach(name => {
        const err = validateField(name, data.get(name) || '');
        setFieldError(name, err);
        if (err) valid = false;
      });

      if (!valid) return;

      const submitBtn = contactForm.querySelector('.contact-form__submit');
      submitBtn.disabled    = true;
      submitBtn.textContent = 'Sending…';

      data.append('action', 'dil_contact');
      data.append('nonce',  DIL.nonce);

      fetch(DIL.ajaxUrl, { method: 'POST', body: data })
        .then(r => r.json())
        .then(res => {
          if (res.success) {
            contactForm.style.display  = 'none';
            if (formSuccess) formSuccess.classList.add('is-visible');
          } else {
            if (res.data && res.data.errors) {
              Object.entries(res.data.errors).forEach(([name, msg]) => setFieldError(name, msg));
            }
            submitBtn.disabled    = false;
            submitBtn.textContent = 'Send Message →';
          }
        })
        .catch(() => {
          submitBtn.disabled    = false;
          submitBtn.textContent = 'Send Message →';
        });
    });

    // Live validation on blur
    contactForm.querySelectorAll('input, textarea').forEach(el => {
      el.addEventListener('blur', () => {
        if (REQUIRED_FIELDS.includes(el.name)) {
          setFieldError(el.name, validateField(el.name, el.value));
        }
      });
    });
  }

  /* ── Rates page tab switcher ────────────────────────────── */

  document.querySelectorAll('.rates-tab').forEach(tab => {
    tab.addEventListener('click', () => {
      const target = tab.dataset.target;
      document.querySelectorAll('.rates-tab').forEach(t => {
        t.classList.toggle('is-active', t === tab);
        t.setAttribute('aria-selected', t === tab ? 'true' : 'false');
      });
      document.querySelectorAll('.rates-table-wrap').forEach(wrap => {
        wrap.hidden = wrap.id !== target;
      });
    });
  });

  /* ── Header height CSS var (for sticky subnav) ──────────── */

  function setHeaderHeight() {
    const h = document.getElementById('site-header');
    if (h) {
      document.documentElement.style.setProperty('--header-h', h.offsetHeight + 'px');
    }
    const sub = document.querySelector('.info-subnav');
    document.documentElement.style.setProperty('--subnav-h', sub ? sub.offsetHeight + 'px' : '0px');
  }
  setHeaderHeight();
  window.addEventListener('resize', setHeaderHeight, { passive: true });

  /* ── Back to top ─────────────────────────────────────────── */

  const backToTop = document.getElementById('back-to-top');
  if (backToTop) {
    window.addEventListener('scroll', () => {
      backToTop.classList.toggle('is-visible', window.scrollY > 400);
    }, { passive: true });
    backToTop.addEventListener('click', () => {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  }


  /* ── Rates calculator ───────────────────────────────────── */

  const ratesCalc = document.getElementById('rates-calc');
  if (ratesCalc) {
    const prices = JSON.parse(ratesCalc.dataset.prices || '{}');
    const SINGLE_SUPP   = { longhouse: 45, garden: 60,  pool: 60,  suite: 60  };
    const NONDIVER_RATE = { longhouse: 90, garden: 135, pool: 140, suite: 165 };
    const ROOM_LABELS = {
      longhouse: 'Longhouse Room',
      garden:    'Garden / Seaview Bungalow',
      pool:      'Pool Front Bungalow',
      suite:     'Bungalow Suite',
    };

    // Set --ratesbar-h so sticky total panel clears the PDF bar
    const pdfBar = document.getElementById('rates-pdf-bar');
    if (pdfBar) {
      document.documentElement.style.setProperty('--ratesbar-h', pdfBar.offsetHeight + 'px');
    }

    function calcUpdate() {
      const roomEl   = ratesCalc.querySelector('input[name="calc_room"]:checked');
      const divesEl  = ratesCalc.querySelector('input[name="calc_dives"]:checked');
      const guestsEl = ratesCalc.querySelector('input[name="calc_guests"]:checked');
      const room   = roomEl   ? roomEl.value   : 'garden';
      const dives  = divesEl  ? divesEl.value  : '2';
      const guests = guestsEl ? parseInt(guestsEl.value, 10) : 2;
      const nights = parseInt(document.getElementById('calc_nights').value, 10) || 7;

      const idx      = nights - 3;
      const ppPrice  = prices[dives] && prices[dives][room] ? prices[dives][room][idx] : 0;
      const diveDays = nights - 1;

      // Check non-diver early — a non-diver replaces the 2nd diver in the room
      const nondiverEl      = ratesCalc.querySelector('input[name="addon_nondiver"]');
      const nondiverChecked = nondiverEl && nondiverEl.checked;

      // When a non-diver is present, only 1 diver pays the package rate (room is still shared)
      const effectiveDivers = nondiverChecked ? 1 : guests;

      const breakdown = [];

      // Base package
      const base = ppPrice * effectiveDivers;
      const shareLabel = nondiverChecked ? ' · sharing w/ non-diver'
                       : effectiveDivers === 2 ? ' pp · 2 sharing'
                       : ' · solo';
      breakdown.push([ROOM_LABELS[room] + ' · ' + nights + 'N', '$' + ppPrice.toLocaleString() + shareLabel]);

      // Single supplement only if truly alone (no non-diver sharing the room)
      const singleSupp = effectiveDivers === 1 && !nondiverChecked ? (SINGLE_SUPP[room] || 60) * nights : 0;
      if (singleSupp) {
        breakdown.push(['Single supplement · ' + nights + ' nights', '+$' + singleSupp.toLocaleString()]);
      }

      // Add-ons
      let addons = 0;

      const nitroxEl    = ratesCalc.querySelector('input[name="addon_nitrox"]');
      const nitroxDays  = ratesCalc.querySelector('input[name="addon_nitrox_days"]');
      if (nitroxEl && nitroxEl.checked) {
        const d    = nitroxDays ? (parseInt(nitroxDays.value, 10) || 1) : diveDays;
        const cost = 20 * d * effectiveDivers;
        addons += cost;
        breakdown.push(['Nitrox · ' + d + 'd' + (effectiveDivers > 1 ? ' × 2' : ''), '+$' + cost.toLocaleString()]);
      }

      const nightEl    = ratesCalc.querySelector('input[name="addon_night"]');
      const nightQtyEl = ratesCalc.querySelector('input[name="addon_night_qty"]');
      if (nightEl && nightEl.checked) {
        const qty  = nightQtyEl ? (parseInt(nightQtyEl.value, 10) || 1) : 1;
        const cost = 55 * qty * effectiveDivers;
        addons += cost;
        breakdown.push(['Night dives · ' + qty + (effectiveDivers > 1 ? ' × 2' : ''), '+$' + cost.toLocaleString()]);
      }

      const guideEl   = ratesCalc.querySelector('input[name="addon_guide"]');
      const guideDays = ratesCalc.querySelector('input[name="addon_guide_days"]');
      if (guideEl && guideEl.checked) {
        const d    = guideDays ? (parseInt(guideDays.value, 10) || 1) : diveDays;
        const cost = 100 * d;
        addons += cost;
        breakdown.push(['Private guide · ' + d + 'd', '+$' + cost.toLocaleString()]);
      }

      const gearEl   = ratesCalc.querySelector('input[name="addon_gear"]');
      const gearDays = ratesCalc.querySelector('input[name="addon_gear_days"]');
      if (gearEl && gearEl.checked) {
        const d    = gearDays ? (parseInt(gearDays.value, 10) || 1) : diveDays;
        const cost = 30 * d * effectiveDivers;
        addons += cost;
        breakdown.push(['Full gear · ' + d + 'd' + (effectiveDivers > 1 ? ' × 2' : ''), '+$' + cost.toLocaleString()]);
      }

      const nondiverRateEl = document.getElementById('calc-nondiver-rate');
      const ndRate = NONDIVER_RATE[room] || 135;
      if (nondiverRateEl) nondiverRateEl.textContent = '+$' + ndRate + ' / night';
      if (nondiverChecked) {
        const cost = ndRate * nights;
        addons += cost;
        breakdown.push(['Non-diver · ' + nights + 'N', '+$' + cost.toLocaleString()]);
      }

      const transferEl = ratesCalc.querySelector('input[name="addon_transfer"]');
      if (transferEl && transferEl.checked) {
        const allPeople = effectiveDivers + (nondiverChecked ? 1 : 0);
        const cost = 40 * allPeople;
        addons += cost;
        breakdown.push(['Airport transfer · ' + allPeople + (allPeople === 1 ? ' person' : ' persons'), '+$' + cost.toLocaleString()]);
      }

      const total     = base + singleSupp + addons;
      const allGuests = effectiveDivers + (nondiverChecked ? 1 : 0);
      const perPerson = Math.round(total / allGuests);

      document.getElementById('calc-room-label').textContent = ROOM_LABELS[room];

      const breakdownEl = document.getElementById('calc-breakdown');
      breakdownEl.innerHTML = breakdown.map(([l, r]) =>
        '<p><span class="bdl">' + l + '</span><span class="bdr">' + r + '</span></p>'
      ).join('');

      document.getElementById('calc-total').textContent = 'USD ' + total.toLocaleString();
      document.getElementById('calc-per').textContent   = allGuests > 1
        ? 'USD ' + perPerson.toLocaleString() + ' per person'
        : '';
    }

    // Show/hide qty inputs when their checkbox is toggled
    [
      ['addon_nitrox',  'addon_nitrox_days'],
      ['addon_night',   'addon_night_qty'],
      ['addon_guide',   'addon_guide_days'],
      ['addon_gear',    'addon_gear_days'],
    ].forEach(([cbName, qtyName]) => {
      const cb  = ratesCalc.querySelector('input[name="' + cbName + '"]');
      const qty = ratesCalc.querySelector('input[name="' + qtyName + '"]');
      if (cb && qty) {
        cb.addEventListener('change', () => { qty.style.display = cb.checked ? '' : 'none'; });
        qty.addEventListener('input', calcUpdate);
      }
    });

    ratesCalc.addEventListener('change', calcUpdate);
    calcUpdate();
  }

  /* ── Utility: escape HTML ────────────────────────────────── */

  function escHtml(str) {
    return String(str)
      .replace(/&/g, '&amp;')
      .replace(/</g, '&lt;')
      .replace(/>/g, '&gt;')
      .replace(/"/g, '&quot;');
  }

})();
