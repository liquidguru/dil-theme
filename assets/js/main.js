/* global DIL */
'use strict';

(function () {

  /* ── Sticky nav ──────────────────────────────────────────── */

  const header = document.getElementById('site-header');

  if (header) {
    let ticking = false;

    const onScroll = () => {
      if (!ticking) {
        requestAnimationFrame(() => {
          header.classList.toggle('is-scrolled', window.scrollY > 80);
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
    },
    {
      id:    'mimic-octopus',
      name:  'Mimic Octopus',
      latin: 'Thaumoctopus mimicus',
      depth: '3 – 20 m',
      angle: 45,
    },
    {
      id:    'blue-ringed-octopus',
      name:  'Blue-Ringed Octopus',
      latin: 'Hapalochlaena lunulata',
      depth: '1 – 20 m',
      angle: 90,
    },
    {
      id:    'mandarin-fish',
      name:  'Mandarin Fish',
      latin: 'Synchiropus splendidus',
      depth: '1 – 18 m',
      angle: 135,
    },
    {
      id:    'orangutan-crab',
      name:  'Orangutan Crab',
      latin: 'Oncinopus sp.',
      depth: '5 – 25 m',
      angle: 180,
    },
    {
      id:    'mantis-shrimp',
      name:  'Mantis Shrimp',
      latin: 'Odontodactylus scyllarus',
      depth: '3 – 40 m',
      angle: 225,
    },
    {
      id:    'banded-sea-snake',
      name:  'Banded Sea Snake',
      latin: 'Laticauda colubrina',
      depth: '0 – 30 m',
      angle: 270,
    },
    {
      id:    'painted-frogfish',
      name:  'Painted Frogfish',
      latin: 'Antennarius pictus',
      depth: '5 – 35 m',
      angle: 315,
    },
  ];

  function buildCritterCompass(container) {
    if (!container) return;

    const svg     = container.querySelector('.critter-compass__svg');
    const infoBox = container.querySelector('.critter-compass__info');

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
      infoBox.innerHTML = `
        <div class="critter-card">
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

  /* ── Utility: escape HTML ────────────────────────────────── */

  function escHtml(str) {
    return String(str)
      .replace(/&/g, '&amp;')
      .replace(/</g, '&lt;')
      .replace(/>/g, '&gt;')
      .replace(/"/g, '&quot;');
  }

})();
