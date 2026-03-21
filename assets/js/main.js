/* ============================================================
   AFROBASS THEME — MAIN JS
   ============================================================ */

(function () {
  'use strict';

  /* ─── CURSOR ─── */
  const cursor     = document.getElementById('ab-cursor');
  const cursorRing = document.getElementById('ab-cursor-ring');
  if (cursor && cursorRing) {
    let mx = 0, my = 0, rx = 0, ry = 0;
    document.addEventListener('mousemove', e => { mx = e.clientX; my = e.clientY; });
    (function animCursor() {
      cursor.style.left = mx + 'px';
      cursor.style.top  = my + 'px';
      rx += (mx - rx) * 0.12;
      ry += (my - ry) * 0.12;
      cursorRing.style.left = rx + 'px';
      cursorRing.style.top  = ry + 'px';
      requestAnimationFrame(animCursor);
    })();
    document.querySelectorAll('a, button, .ab-event-card, .ab-recap-card, .ab-flyer-card, .ab-svc-card').forEach(el => {
      el.addEventListener('mouseenter', () => {
        cursor.style.transform     = 'translate(-50%,-50%) scale(2.2)';
        cursor.style.background    = 'rgba(255,69,0,0.5)';
        cursorRing.style.transform = 'translate(-50%,-50%) scale(1.5)';
      });
      el.addEventListener('mouseleave', () => {
        cursor.style.transform     = 'translate(-50%,-50%) scale(1)';
        cursor.style.background    = '#FF4500';
        cursorRing.style.transform = 'translate(-50%,-50%) scale(1)';
      });
    });
  }

  /* ─── LOADER ─── */
  const loader = document.getElementById('ab-loader');
  if (loader) {
    window.addEventListener('load', () => {
      setTimeout(() => {
        loader.classList.add('ab-hide');
        setTimeout(() => { loader.style.display = 'none'; }, 1200);
      }, 2400);
    });
  }

  /* ─── NAV SCROLL ─── */
  const nav = document.getElementById('ab-nav');
  if (nav) {
    window.addEventListener('scroll', () => {
      nav.classList.toggle('ab-scrolled', window.scrollY > 30);
    }, { passive: true });
  }

  /* ─── MOBILE NAV ─── */
  const hamburger  = document.querySelector('.ab-hamburger');
  const mobileNav  = document.getElementById('ab-mobile-nav');
  if (hamburger && mobileNav) {
    hamburger.addEventListener('click', () => {
      hamburger.classList.toggle('ab-open');
      mobileNav.classList.toggle('ab-open');
      document.body.style.overflow = mobileNav.classList.contains('ab-open') ? 'hidden' : '';
    });
    mobileNav.querySelectorAll('a').forEach(a => {
      a.addEventListener('click', () => {
        hamburger.classList.remove('ab-open');
        mobileNav.classList.remove('ab-open');
        document.body.style.overflow = '';
      });
    });
  }

  /* ─── PARALLAX HERO VIDEO ─── */
  const heroVideo = document.getElementById('ab-hero-video');
  window.addEventListener('scroll', () => {
    const sy = window.scrollY;
    if (heroVideo) {
      heroVideo.style.transform = `scale(1.08) translateY(${sy * 0.25}px)`;
    }
    document.querySelectorAll('.ab-parallax').forEach(el => {
      const speed = parseFloat(el.dataset.speed) || 0.1;
      el.style.transform = `translateY(${sy * speed}px)`;
    });
  }, { passive: true });

  /* ─── REVEAL ON SCROLL ─── */
  const revealEls = document.querySelectorAll('.ab-reveal');
  if (revealEls.length) {
    const revealObs = new IntersectionObserver((entries) => {
      entries.forEach(e => {
        if (e.isIntersecting) {
          e.target.classList.add('ab-visible');
          revealObs.unobserve(e.target);
        }
      });
    }, { threshold: 0.05, rootMargin: '0px 0px 0px 0px' });
    revealEls.forEach(el => revealObs.observe(el));
    // Also trigger any elements already in viewport on load
    setTimeout(() => {
      revealEls.forEach(el => {
        const rect = el.getBoundingClientRect();
        if (rect.top < window.innerHeight) {
          el.classList.add('ab-visible');
          revealObs.unobserve(el);
        }
      });
    }, 100);
  }

  /* ─── COUNT UP ─── */
  const counters = document.querySelectorAll('.ab-count-up');
  if (counters.length) {
    const countObs = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (!entry.isIntersecting) return;
        const el      = entry.target;
        const target  = parseInt(el.dataset.target, 10);
        const isK     = target >= 1000;
        const dur     = 1800;
        const start   = performance.now();
        (function tick(now) {
          const prog = Math.min((now - start) / dur, 1);
          const ease = 1 - Math.pow(1 - prog, 4);
          const val  = Math.floor(ease * target);
          el.textContent = isK ? (val / 1000).toFixed(1) + 'K' : val;
          if (prog < 1) { requestAnimationFrame(tick); }
          else { el.textContent = isK ? (target / 1000).toFixed(1) + 'K' : target; }
        })(start);
        countObs.unobserve(el);
      });
    }, { threshold: 0.5 });
    counters.forEach(c => countObs.observe(c));
  }

  /* ─── SMOOTH ANCHOR SCROLL ─── */
  document.querySelectorAll('a[href^="#"]').forEach(a => {
    a.addEventListener('click', e => {
      const target = document.querySelector(a.getAttribute('href'));
      if (target) {
        e.preventDefault();
        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }
    });
  });

  /* ─── BOOKING FORM AJAX ─── */
  const bookingForm = document.getElementById('ab-booking-form');
  if (bookingForm) {
    bookingForm.addEventListener('submit', async function (e) {
      e.preventDefault();
      const btn = bookingForm.querySelector('.ab-form-submit');
      const msg = bookingForm.querySelector('.ab-form-message');
      btn.textContent = 'Sending...';
      btn.disabled = true;

      const data = new FormData(bookingForm);
      data.append('action', 'ab_booking_form');
      data.append('nonce', abAjax.nonce);

      try {
        const res  = await fetch(abAjax.ajaxurl, { method: 'POST', body: data });
        const json = await res.json();
        msg.className = 'ab-form-message ' + (json.success ? 'ab-success' : 'ab-error');
        msg.textContent = json.data;
        if (json.success) bookingForm.reset();
      } catch {
        msg.className   = 'ab-form-message ab-error';
        msg.textContent = 'Something went wrong. Please email us directly at contact@afrobass.com';
      }
      btn.textContent = 'Submit Inquiry →';
      btn.disabled = false;
    });
  }

  /* ─── VIDEO LIGHTBOX (recap cards) ─── */
  document.querySelectorAll('.ab-recap-card[data-video]').forEach(card => {
    card.addEventListener('click', () => {
      const url = card.dataset.video;
      if (!url) return;
      const overlay = document.createElement('div');
      overlay.style.cssText = 'position:fixed;inset:0;background:rgba(0,0,0,0.92);z-index:9000;display:flex;align-items:center;justify-content:center;cursor:pointer;';
      const iframe = document.createElement('iframe');
      iframe.src   = url + '?autoplay=1';
      iframe.style.cssText = 'width:90vw;max-width:1100px;height:56.25vw;max-height:618px;border:none;border-radius:4px;';
      iframe.allow = 'autoplay; fullscreen';
      overlay.appendChild(iframe);
      overlay.addEventListener('click', e => { if (e.target === overlay) overlay.remove(); });
      document.body.appendChild(overlay);
    });
  });

})();
