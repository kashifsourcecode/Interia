<script>
/* Cursor glow */
const glow = document.getElementById('cursorGlow');
document.addEventListener('mousemove', e => {
  glow.style.left = e.clientX + 'px';
  glow.style.top  = e.clientY + 'px';
});

/* Theme Toggle */
const htmlEl = document.documentElement;
const themeToggle = document.getElementById('themeToggle');

function syncThemeToggle(theme) {
  if (!themeToggle) return;

  const nextTheme = theme === 'dark' ? 'light' : 'dark';
  themeToggle.setAttribute('aria-label', `Switch to ${nextTheme} theme`);
  themeToggle.setAttribute('title', `Switch to ${nextTheme} theme`);
}

(function() {
  const saved = localStorage.getItem('interia-theme') || 'light';
  htmlEl.setAttribute('data-theme', saved);
  syncThemeToggle(saved);
})();

function toggleTheme() {
  const current = htmlEl.getAttribute('data-theme');
  const next = current === 'dark' ? 'light' : 'dark';
  htmlEl.setAttribute('data-theme', next);
  localStorage.setItem('interia-theme', next);
  syncThemeToggle(next);
}

/* Navbar scroll */
const navbar = document.getElementById('navbar');
window.addEventListener('scroll', () => {
  navbar.classList.toggle('scrolled', window.scrollY > 60);
});

/* Scroll reveal */
const revealObserver = new IntersectionObserver(entries => {
  entries.forEach(e => {
    if (e.isIntersecting) { e.target.classList.add('visible'); revealObserver.unobserve(e.target); }
  });
}, { threshold: 0.12 });
document.querySelectorAll('.reveal').forEach(el => revealObserver.observe(el));

/* Counter animation */
function animateCounter(el) {
  const target = parseFloat(el.dataset.target);
  const decimal = el.dataset.decimal !== undefined;
  const duration = 1800;
  const start = performance.now();
  function step(now) {
    const t = Math.min((now - start) / duration, 1);
    const ease = 1 - Math.pow(1 - t, 3);
    const val = target * ease;
    el.textContent = decimal ? val.toFixed(1) : Math.floor(val);
    if (t < 1) requestAnimationFrame(step);
    else el.textContent = decimal ? target.toFixed(1) : target;
  }
  requestAnimationFrame(step);
}

const counterObserver = new IntersectionObserver(entries => {
  entries.forEach(e => {
    if (e.isIntersecting) {
      e.target.querySelectorAll('[data-target]').forEach(animateCounter);
      counterObserver.unobserve(e.target);
    }
  });
}, { threshold: 0.5 });
document.querySelectorAll('.stats-band').forEach(el => counterObserver.observe(el));

/* Contact form submit */
const CONTACT_SUCCESS_ICON = '<svg class="form-submit-icon" viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 6 9 17l-5-5"/></svg>';

async function handleSubmit(e) {
  e.preventDefault();
  const form = e.target;
  const btn = form.querySelector('.form-submit');
  const feedback = form.querySelector('.contact-form-feedback');
  const originalLabel = btn.innerHTML;
  const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') ?? '';

  if (feedback) {
    feedback.hidden = true;
    feedback.textContent = '';
    feedback.style.color = '';
  }

  btn.disabled = true;
  btn.textContent = 'Sending…';
  btn.classList.remove('is-success');

  try {
    const response = await fetch(form.action, {
      method: 'POST',
      headers: {
        'Accept': 'application/json',
        'X-Requested-With': 'XMLHttpRequest',
        'X-CSRF-TOKEN': csrf,
      },
      body: new FormData(form),
      credentials: 'same-origin',
    });

    if (response.status === 422) {
      const body = await response.json();
      const messages = Object.values(body.errors || {}).flat();
      throw new Error(messages[0] || 'Please review the form fields and try again.');
    }

    if (response.status === 429) {
      throw new Error('You are sending messages too quickly. Please try again in a minute.');
    }

    if (!response.ok) {
      throw new Error('Something went wrong. Please try again in a moment.');
    }

    const data = await response.json().catch(() => ({}));
    const successMessage = data.message || "Message sent! We'll be in touch shortly.";

    btn.innerHTML = CONTACT_SUCCESS_ICON + '<span>Message Sent!</span>';
    btn.classList.add('is-success');
    form.reset();

    if (feedback) {
      feedback.hidden = false;
      feedback.textContent = successMessage;
      feedback.style.color = '#15803d';
    }

    setTimeout(() => {
      btn.innerHTML = originalLabel;
      btn.classList.remove('is-success');
      btn.disabled = false;
    }, 5000);
  } catch (err) {
    btn.innerHTML = originalLabel;
    btn.classList.remove('is-success');
    btn.disabled = false;

    if (feedback) {
      feedback.hidden = false;
      feedback.textContent = err.message || 'Something went wrong. Please try again.';
      feedback.style.color = '#dc2626';
    }
  }
}

/* Nav active link — highlight Home when at top */
const sections = document.querySelectorAll('section[id]');
const navLinks = document.querySelectorAll('.nav-links a');
window.addEventListener('scroll', () => {
  let current = 'hero'; // default to hero (home)
  sections.forEach(s => { if (window.scrollY >= s.offsetTop - 200) current = s.id; });
  navLinks.forEach(a => {
    const href = a.getAttribute('href');
    a.style.color = (href === '#' + current) ? 'var(--accent)' : '';
  });
});

/* Auth Modal */
function openModal(tab) {
  document.getElementById('authOverlay').classList.add('open');
  document.body.style.overflow = 'hidden';
  switchTab(tab || 'login');
}
function closeModal() {
  document.getElementById('authOverlay').classList.remove('open');
  document.body.style.overflow = '';
}
function overlayClick(e) {
  if (e.target === document.getElementById('authOverlay')) closeModal();
}
document.addEventListener('keydown', e => { if (e.key === 'Escape') closeModal(); });

function switchTab(tab) {
  const isLogin = tab === 'login';
  document.getElementById('tabLogin').classList.toggle('active', isLogin);
  document.getElementById('tabSignup').classList.toggle('active', !isLogin);
  document.getElementById('tabSlider').classList.toggle('right', !isLogin);
  document.getElementById('panelLogin').classList.toggle('active', isLogin);
  document.getElementById('panelSignup').classList.toggle('active', !isLogin);
}

function togglePw(id, btn) {
  const input = document.getElementById(id);
  const isText = input.type === 'text';
  input.type = isText ? 'password' : 'text';
  btn.textContent = isText ? '👁' : '🙈';
}

function checkStrength(input) {
  const val = input.value;
  const wrap = document.getElementById('strengthWrap');
  const fill = document.getElementById('strengthFill');
  const text = document.getElementById('strengthText');
  wrap.classList.toggle('visible', val.length > 0);
  let score = 0;
  if (val.length >= 8) score++;
  if (/[A-Z]/.test(val)) score++;
  if (/[0-9]/.test(val)) score++;
  if (/[^A-Za-z0-9]/.test(val)) score++;
  const levels = [
    { w:'20%', bg:'#ef4444', label:'Weak' },
    { w:'45%', bg:'#f97316', label:'Fair' },
    { w:'70%', bg:'#eab308', label:'Good' },
    { w:'100%', bg:'#22c55e', label:'Strong' },
  ];
  const lvl = levels[Math.max(0, score - 1)];
  fill.style.width = lvl.w;
  fill.style.background = lvl.bg;
  text.textContent = lvl.label;
  text.style.color = lvl.bg;
}

function handleLogin() {
  const btn = document.querySelector('#panelLogin .auth-submit');
  const email = document.getElementById('loginEmail').value;
  if (!email) { shakeModal(); return; }
  btn.textContent = '⏳ Signing in...'; btn.disabled = true;
  setTimeout(() => {
    btn.textContent = '✅ Welcome back!'; btn.style.background = '#22c55e';
    setTimeout(() => { closeModal(); btn.textContent = 'Sign In to Portal →'; btn.style.background = ''; btn.disabled = false; }, 1800);
  }, 1400);
}

function handleSignup() {
  const btn = document.querySelector('#panelSignup .auth-submit');
  btn.textContent = '⏳ Creating account...'; btn.disabled = true;
  setTimeout(() => {
    btn.textContent = '✅ Account Created!'; btn.style.background = '#22c55e';
    setTimeout(() => { closeModal(); btn.textContent = 'Create My Account →'; btn.style.background = ''; btn.disabled = false; }, 1800);
  }, 1600);
}

function shakeModal() {
  const m = document.getElementById('authModal');
  m.style.animation = 'shake 0.4s ease';
  setTimeout(() => m.style.animation = '', 400);
}

/* AI Adoption — animate ascending arrow line on scroll */
(function() {
  const grid = document.querySelector('.ai-steps-grid');
  if (!grid) return;

  const aiLineObserver = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        grid.classList.add('in-view');
        aiLineObserver.unobserve(entry.target);
      }
    });
  }, { threshold: 0.2 });

  aiLineObserver.observe(grid);
})();

/* ═══════════════════════════════════════════════
   GALLERY MOSAIC — Scroll-triggered reveal
   ═══════════════════════════════════════════════ */
(function() {
  const mosaic = document.getElementById('galleryMosaic');
  if (!mosaic) return;

  const cards = mosaic.querySelectorAll('.mosaic-card');

  const mosaicObserver = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        mosaic.classList.remove('mosaic-hidden');
        mosaic.classList.add('mosaic-visible');

        cards.forEach((card, i) => {
          card.style.animationDelay = `${i * 55}ms`;
        });

        mosaicObserver.unobserve(entry.target);
      }
    });
  }, { threshold: 0.15 });

  mosaicObserver.observe(mosaic);
})();

/* Ensure page loads at top — no auto-scroll to gallery */
if (window.location.hash === '') {
  window.scrollTo(0, 0);
}
history.scrollRestoration = 'manual';
window.addEventListener('load', () => {
  if (!window.location.hash) {
    window.scrollTo(0, 0);
  }
});
</script>
