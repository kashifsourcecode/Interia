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

/* Form submit */
function handleSubmit(e) {
  e.preventDefault();
  const btn = e.target.querySelector('.form-submit');
  btn.textContent = '✅ Message Sent! We\'ll be in touch shortly.';
  btn.style.background = '#22c55e';
  btn.disabled = true;
  setTimeout(() => {
    btn.textContent = 'Send Message →';
    btn.style.background = '';
    btn.disabled = false;
    e.target.reset();
  }, 5000);
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
