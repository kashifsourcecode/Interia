<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Interia Technologies — Managed IT for Las Vegas Businesses</title>
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@@300;400;500;600&family=DM+Mono:wght@@400;500&display=swap" rel="stylesheet" />

@verbatim
<style>
:root,
[data-theme="dark"] {
  --brand-primary:   #0257B9;
  --brand-dark:      #020B14;
  --brand-surface:   rgba(1, 20, 41, 0.10);

  --bg:              #020B14;
  --bg-2:            #040E1A;
  --surface:         #071527;
  --card:            #0A1C32;
  --card-hover:      #0D2140;
  --border:          rgba(2, 87, 185, 0.18);
  --border-strong:   rgba(2, 87, 185, 0.35);

  --text:            #E8EFF8;
  --text-muted:      #6B8099;
  --text-faint:      #3B4F65;

  --accent:          #0257B9;
  --accent-light:    #1A72E8;
  --accent-glow:     rgba(2, 87, 185, 0.25);
  --accent-soft:     rgba(2, 87, 185, 0.10);
  --accent2:         #0A7AFF;

  --nav-bg:          rgba(2, 11, 20, 0.88);
  --shadow-card:     0 4px 24px rgba(0,0,0,0.45);
  --shadow-glow:     0 0 40px rgba(2, 87, 185, 0.22);
  --overlay-bg:      rgba(1, 6, 14, 0.92);

  --scrollbar-thumb: #0257B9;
}

[data-theme="light"] {
  --bg:              #F0F6FF;
  --bg-2:            #E8F0FC;
  --surface:         #DDEAF8;
  --card:            #FFFFFF;
  --card-hover:      #F4F8FF;
  --border:          rgba(2, 87, 185, 0.15);
  --border-strong:   rgba(2, 87, 185, 0.35);

  --text:            #020B14;
  --text-muted:      #3D6080;
  --text-faint:      #8BA8C4;

  --accent:          #0257B9;
  --accent-light:    #0466D4;
  --accent-glow:     rgba(2, 87, 185, 0.15);
  --accent-soft:     rgba(2, 87, 185, 0.08);
  --accent2:         #0A4FA0;

  --nav-bg:          rgba(240, 246, 255, 0.92);
  --shadow-card:     0 4px 24px rgba(2, 87, 185, 0.10);
  --shadow-glow:     0 0 40px rgba(2, 87, 185, 0.12);
  --overlay-bg:      rgba(2, 11, 20, 0.85);

  --scrollbar-thumb: #0257B9;
}

*, *::before, *::after { margin:0; padding:0; box-sizing:border-box; }
html { scroll-behavior: smooth; }

body {
  background: var(--bg);
  color: var(--text);
  font-family: 'DM Sans', sans-serif;
  font-size: 16px;
  line-height: 1.7;
  overflow-x: hidden;
  transition: background 0.4s ease, color 0.4s ease;
}

::-webkit-scrollbar { width: 4px; }
::-webkit-scrollbar-track { background: var(--bg); }
::-webkit-scrollbar-thumb { background: var(--scrollbar-thumb); border-radius: 2px; }

body::before {
  content: '';
  position: fixed; inset: 0;
  background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.025'/%3E%3C/svg%3E");
  pointer-events: none;
  z-index: 9999;
  opacity: 0.3;
}

/* NAV */
nav {
  position: fixed; top: 0; left: 0; right: 0; z-index: 100;
  padding: 1.2rem 6%;
  display: flex; align-items: center; justify-content: space-between;
  background: var(--nav-bg);
  backdrop-filter: blur(20px);
  border-bottom: 1px solid var(--border);
  transition: all 0.3s ease;
}
nav.scrolled { padding: 0.8rem 6%; box-shadow: 0 4px 30px rgba(0,0,0,0.3); }

.nav-logo {
  display: inline-flex;
  align-items: center;
  flex-shrink: 0;
  text-decoration: none;
}
.nav-logo img {
  display: block;
  width: 150px;
  height: auto;
}

@media (min-width: 901px) {
  .nav-links {
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
  }
}

.nav-links {
  display: flex; gap: 2.5rem; list-style: none;
}
.nav-links a {
  font-size: 0.85rem; font-weight: 500;
  letter-spacing: 0.08em; text-transform: uppercase;
  color: var(--text-muted);
  text-decoration: none;
  transition: color 0.2s;
  position: relative;
}
.nav-links a::after {
  content: '';
  position: absolute; bottom: -4px; left: 0; right: 0;
  height: 1px; background: var(--accent);
  transform: scaleX(0); transition: transform 0.25s;
}
.nav-links a:hover { color: var(--text); }
.nav-links a:hover::after { transform: scaleX(1); }

.nav-right {
  display: flex; align-items: center; gap: 0.8rem; flex-shrink: 0;
}

.theme-toggle {
  width: 42px;
  height: 42px;
  background: linear-gradient(135deg, var(--card), var(--surface));
  border: 1px solid var(--border-strong);
  border-radius: 50%;
  cursor: pointer;
  position: relative;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  color: var(--accent);
  box-shadow: 0 8px 24px rgba(2, 87, 185, 0.12);
  transition: background 0.3s, border-color 0.3s, box-shadow 0.3s, transform 0.25s, color 0.3s;
  flex-shrink: 0;
}
.theme-toggle:hover {
  border-color: var(--accent);
  box-shadow: 0 12px 32px var(--accent-glow);
  transform: translateY(-1px);
}
.theme-toggle:focus-visible {
  outline: 2px solid var(--accent);
  outline-offset: 3px;
}
.theme-icon {
  position: absolute;
  width: 21px;
  height: 21px;
  transition: opacity 0.28s ease, transform 0.28s cubic-bezier(0.34,1.56,0.64,1);
}
.theme-icon-sun {
  opacity: 0;
  transform: rotate(-35deg) scale(0.65);
}
.theme-icon-moon {
  opacity: 1;
  transform: rotate(0deg) scale(1);
}
[data-theme="light"] .theme-toggle {
  background: rgba(255,255,255,0.72);
  color: #F59E0B;
}
[data-theme="light"] .theme-icon-sun {
  opacity: 1;
  transform: rotate(0deg) scale(1);
}
[data-theme="light"] .theme-icon-moon {
  opacity: 0;
  transform: rotate(35deg) scale(0.65);
}

.nav-cta {
  background: var(--accent);
  color: #fff !important;
  padding: 0.5rem 1.4rem;
  border-radius: 4px;
  font-weight: 600 !important;
  text-decoration: none;
  font-size: 0.85rem;
  letter-spacing: 0.08em;
  text-transform: uppercase;
  transition: background 0.2s, transform 0.2s;
  white-space: nowrap;
}
.nav-cta:hover { background: var(--accent-light); transform: translateY(-1px); }

.hamburger { display: none; flex-direction: column; gap: 5px; cursor: pointer; background: none; border: none; }
.hamburger span { width: 22px; height: 2px; background: var(--text); border-radius: 2px; transition: all 0.3s; display: block; }

/* CURSOR GLOW */
.cursor-glow {
  position: fixed;
  width: 350px; height: 350px;
  border-radius: 50%;
  background: radial-gradient(circle, var(--accent-glow) 0%, transparent 60%);
  pointer-events: none;
  z-index: 1;
  transform: translate(-50%,-50%);
  transition: left 0.12s, top 0.12s;
}

/* AUTH MODAL */
.auth-overlay {
  position: fixed; inset: 0; z-index: 9000;
  background: var(--overlay-bg);
  backdrop-filter: blur(16px);
  display: flex; align-items: center; justify-content: center;
  opacity: 0; pointer-events: none;
  transition: opacity 0.35s ease;
  padding: 1rem;
}
.auth-overlay.open { opacity: 1; pointer-events: all; }

.auth-modal {
  width: 100%; max-width: 480px;
  background: var(--card);
  border: 1px solid var(--border-strong);
  border-radius: 20px;
  overflow: hidden;
  position: relative;
  transform: translateY(40px) scale(0.97);
  transition: transform 0.4s cubic-bezier(0.34,1.56,0.64,1);
  box-shadow: 0 40px 100px rgba(0,0,0,0.5), var(--shadow-glow);
}
.auth-overlay.open .auth-modal { transform: translateY(0) scale(1); }

.auth-modal-bar {
  height: 3px;
  background: linear-gradient(90deg, var(--accent), var(--accent2), #38BDF8, var(--accent));
  background-size: 300% 100%;
  animation: barShift 3s linear infinite;
}
@keyframes barShift { 0%{background-position:0%} 100%{background-position:300%} }

.auth-modal-inner { padding: 2.5rem 2.5rem 2.8rem; }

.auth-close {
  position: absolute; top: 1.2rem; right: 1.4rem;
  width: 32px; height: 32px;
  display: flex; align-items: center; justify-content: center;
  background: var(--surface);
  border: 1px solid var(--border);
  border-radius: 50%;
  cursor: pointer; font-size: 1rem; color: var(--text-muted);
  transition: all 0.2s; z-index: 2;
}
.auth-close:hover { background: var(--accent-soft); color: var(--text); transform: rotate(90deg); }

.auth-tabs {
  display: flex;
  background: var(--surface);
  border-radius: 10px;
  padding: 4px;
  margin-bottom: 2rem;
  position: relative;
}
.auth-tab-btn {
  flex: 1; padding: 0.6rem 1rem;
  border: none; background: transparent;
  font-family: 'DM Sans', sans-serif;
  font-size: 0.85rem; font-weight: 600;
  letter-spacing: 0.06em; text-transform: uppercase;
  color: var(--text-muted); cursor: pointer;
  border-radius: 7px; transition: color 0.2s;
  position: relative; z-index: 1;
}
.auth-tab-btn.active { color: #fff; }
.auth-tab-slider {
  position: absolute; top: 4px; bottom: 4px;
  width: calc(50% - 4px);
  background: var(--accent);
  border-radius: 7px;
  transition: left 0.3s cubic-bezier(0.34,1.56,0.64,1);
  left: 4px;
}
.auth-tab-slider.right { left: calc(50%); }

.auth-panel { display: none; animation: panelIn 0.35s ease; }
.auth-panel.active { display: block; }
@keyframes panelIn { from{opacity:0;transform:translateX(15px)} to{opacity:1;transform:translateX(0)} }

.auth-logo { text-align:center; margin-bottom:0.3rem; font-family:'Bebas Neue',sans-serif; font-size:1.8rem; letter-spacing:0.06em; color:var(--text); }
.auth-logo span { color:var(--accent); }
.auth-tagline { text-align:center; font-size:0.82rem; color:var(--text-muted); margin-bottom:1.8rem; }

.auth-field { display:flex; flex-direction:column; gap:0.45rem; margin-bottom:1.1rem; position:relative; }
.auth-field label { font-size:0.74rem; text-transform:uppercase; letter-spacing:0.1em; color:var(--text-muted); font-weight:500; }

.auth-input-wrap { position:relative; }
.auth-input-icon { position:absolute; left:0.9rem; top:50%; transform:translateY(-50%); font-size:1rem; opacity:0.5; pointer-events:none; transition:opacity 0.2s; }

.auth-field input {
  width:100%; background:var(--surface); border:1px solid var(--border);
  border-radius:9px; padding:0.82rem 1rem 0.82rem 2.6rem;
  font-family:'DM Sans',sans-serif; font-size:0.92rem;
  color:var(--text); outline:none;
  transition:border-color 0.25s,box-shadow 0.25s,background 0.2s;
}
.auth-field input:focus { border-color:var(--accent); box-shadow:0 0 0 3px var(--accent-soft); background:var(--accent-soft); }
.auth-field input:focus ~ .auth-input-icon,
.auth-input-wrap:focus-within .auth-input-icon { opacity:0.9; }

.pw-toggle { position:absolute; right:0.9rem; top:50%; transform:translateY(-50%); background:none; border:none; cursor:pointer; font-size:0.9rem; color:var(--text-muted); transition:color 0.2s; }
.pw-toggle:hover { color:var(--accent); }

.pw-strength-wrap { margin-top:0.4rem; display:none; }
.pw-strength-wrap.visible { display:block; }
.pw-strength-bar { height:3px; border-radius:3px; background:var(--border); overflow:hidden; margin-bottom:0.25rem; }
.pw-strength-fill { height:100%; width:0%; border-radius:3px; transition:width 0.4s ease,background 0.4s ease; }
.pw-strength-text { font-size:0.72rem; color:var(--text-muted); }

.auth-name-row { display:grid; grid-template-columns:1fr 1fr; gap:1rem; }

.auth-divider { display:flex; align-items:center; gap:0.8rem; margin:1.4rem 0; font-size:0.75rem; color:var(--text-muted); text-transform:uppercase; letter-spacing:0.08em; }
.auth-divider::before,.auth-divider::after { content:''; flex:1; height:1px; background:var(--border); }

.auth-socials { display:grid; grid-template-columns:1fr 1fr; gap:0.8rem; margin-bottom:1.4rem; }
.social-btn { display:flex; align-items:center; justify-content:center; gap:0.5rem; padding:0.7rem 1rem; background:var(--surface); border:1px solid var(--border); border-radius:9px; font-family:'DM Sans',sans-serif; font-size:0.82rem; font-weight:500; color:var(--text); cursor:pointer; text-decoration:none; transition:border-color 0.2s,background 0.2s,transform 0.2s; }
.social-btn:hover { border-color:var(--border-strong); background:var(--accent-soft); transform:translateY(-1px); }
.social-btn svg { width:16px; height:16px; }

.auth-check { display:flex; align-items:flex-start; gap:0.6rem; font-size:0.82rem; color:var(--text-muted); margin-bottom:1.2rem; cursor:pointer; }
.auth-check input[type=checkbox] { accent-color:var(--accent); margin-top:3px; flex-shrink:0; }
.auth-check a { color:var(--accent); text-decoration:none; }
.auth-check a:hover { text-decoration:underline; }

.auth-forgot { font-size:0.78rem; color:var(--text-muted); text-align:right; margin-top:-0.6rem; margin-bottom:1rem; display:block; text-decoration:none; transition:color 0.2s; }
.auth-forgot:hover { color:var(--accent); }

.auth-submit {
  width:100%; padding:0.9rem;
  background:var(--accent); color:#fff;
  font-family:'DM Sans',sans-serif; font-weight:700;
  font-size:0.92rem; letter-spacing:0.08em; text-transform:uppercase;
  border:none; border-radius:9px; cursor:pointer;
  transition:all 0.25s;
  box-shadow:0 4px 20px var(--accent-glow);
  position:relative; overflow:hidden;
}
.auth-submit::before { content:''; position:absolute; inset:0; background:linear-gradient(90deg,transparent,rgba(255,255,255,0.12),transparent); transform:translateX(-100%); transition:transform 0.5s; }
.auth-submit:hover { background:var(--accent-light); transform:translateY(-2px); box-shadow:0 8px 30px rgba(2,87,185,0.4); }
.auth-submit:hover::before { transform:translateX(100%); }

.auth-switch { text-align:center; margin-top:1.4rem; font-size:0.83rem; color:var(--text-muted); }
.auth-switch a { color:var(--accent); font-weight:600; text-decoration:none; transition:opacity 0.2s; }
.auth-switch a:hover { opacity:0.8; }

/* HERO */
#hero {
  min-height: 100vh;
  position: relative;
  display: flex; flex-direction: column;
  justify-content: center; align-items: flex-start;
  overflow: hidden;
  padding: 8rem 6% 4rem;
}

.hero-grid {
  position: absolute; inset: 0;
  background-image:
    linear-gradient(rgba(2,87,185,0.05) 1px, transparent 1px),
    linear-gradient(90deg, rgba(2,87,185,0.05) 1px, transparent 1px);
  background-size: 60px 60px;
  animation: gridDrift 20s linear infinite;
}
[data-theme="light"] .hero-grid {
  background-image:
    linear-gradient(rgba(2,87,185,0.06) 1px, transparent 1px),
    linear-gradient(90deg, rgba(2,87,185,0.06) 1px, transparent 1px);
}
@keyframes gridDrift { from{transform:translateY(0)} to{transform:translateY(60px)} }

.hero-glow {
  position: absolute;
  width: 700px; height: 700px;
  border-radius: 50%;
  background: radial-gradient(ellipse, rgba(2,87,185,0.15) 0%, transparent 70%);
  top: 50%; left: 50%;
  transform: translate(-50%,-50%);
  pointer-events: none;
  animation: pulsate 4s ease-in-out infinite;
}
@keyframes pulsate { 0%,100%{opacity:0.7;transform:translate(-50%,-50%) scale(1)} 50%{opacity:1;transform:translate(-50%,-50%) scale(1.08)} }

.orb {
  position: absolute; border-radius: 50%; pointer-events: none;
  animation: float 8s ease-in-out infinite;
}
.orb1 { width:300px;height:300px;background:radial-gradient(circle,rgba(2,87,185,0.10),transparent 70%);top:20%;left:5%;animation-delay:-2s; }
.orb2 { width:200px;height:200px;background:radial-gradient(circle,rgba(10,122,255,0.08),transparent 70%);top:60%;right:8%;animation-delay:-5s; }
@keyframes float { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-30px)} }

.hero-skyline {
  position: absolute; bottom: 0; left: 0; right: 0;
  height: 55%; opacity: 0.1; pointer-events: none;
}
[data-theme="light"] .hero-skyline { opacity: 0.06; }

/* HERO CONTENT — LEFT ALIGNED, matches Image 2 text */
.hero-content {
  position: relative; z-index: 2;
  max-width: 700px;
}

.hero-badge {
  display: inline-flex; align-items: center; gap: 0.5rem;
  background: var(--accent-soft);
  border: 1px solid var(--border-strong);
  border-radius: 100px;
  padding: 0.35rem 1rem;
  font-family: 'DM Mono', monospace;
  font-size: 0.75rem; color: var(--accent);
  letter-spacing: 0.1em; text-transform: uppercase;
  margin-bottom: 1.8rem;
  opacity: 0; animation: fadeUp 0.8s 0.2s forwards;
}
.hero-badge .dot { width:6px;height:6px;border-radius:50%;background:var(--accent);animation:blink 1.5s infinite; }
@keyframes blink { 0%,100%{opacity:1} 50%{opacity:0.3} }

/* MODIFIED HERO HEADLINE — matches Image 2 */
.hero-headline {
  font-family: 'DM Sans', sans-serif;
  font-size: clamp(2.6rem, 5.5vw, 4.2rem);
  line-height: 1.12;
  font-weight: 700;
  letter-spacing: -0.02em;
  color: var(--text);
  margin-bottom: 0.5rem;
  opacity: 0; animation: fadeUp 0.9s 0.4s forwards;
}
.hero-headline .accent { color: var(--accent); }

/* Vertical accent bar left (like Image 2) */
.hero-sub-block {
  display: flex;
  align-items: flex-start;
  gap: 1.2rem;
  margin: 1.8rem 0 2.5rem;
  opacity: 0; animation: fadeUp 0.9s 0.6s forwards;
}
.hero-sub-bar {
  width: 4px;
  min-height: 100%;
  background: var(--accent);
  border-radius: 2px;
  flex-shrink: 0;
  align-self: stretch;
}
.hero-sub {
  font-size: 1.05rem; color: var(--text-muted);
  line-height: 1.65;
  margin: 0;
}

.hero-trust {
  display: flex; flex-wrap: wrap; gap: 1rem;
  margin-bottom: 2.5rem;
  opacity: 0; animation: fadeUp 0.9s 0.8s forwards;
}
.trust-chip {
  display: flex; align-items: center; gap: 0.5rem;
  font-size: 0.82rem; font-weight: 500; color: var(--text);
  background: var(--card); border: 1px solid var(--border);
  border-radius: 6px; padding: 0.4rem 0.9rem;
  transition: border-color 0.2s, background 0.2s;
}
.trust-chip:hover { border-color: var(--border-strong); background: var(--accent-soft); }
.trust-chip .check { color: var(--accent); font-size: 0.9rem; }

.hero-ctas {
  display: flex; gap: 1rem; flex-wrap: wrap;
  opacity: 0; animation: fadeUp 0.9s 1s forwards;
}

@keyframes fadeUp { from{opacity:0;transform:translateY(30px)} to{opacity:1;transform:translateY(0)} }

/* BUTTONS */
.btn-primary {
  background: var(--accent); color: #fff;
  font-weight: 700; font-size: 0.9rem;
  letter-spacing: 0.05em; text-transform: uppercase;
  padding: 0.9rem 2rem; border-radius: 6px;
  text-decoration: none; border: none; cursor: pointer;
  transition: all 0.25s;
  display: inline-flex; align-items: center; gap: 0.5rem;
  box-shadow: 0 4px 20px var(--accent-glow);
}
.btn-primary:hover { background: var(--accent-light); transform: translateY(-2px); box-shadow: 0 8px 30px rgba(2,87,185,0.4); }

.btn-secondary {
  background: transparent; color: var(--text);
  font-weight: 600; font-size: 0.9rem;
  letter-spacing: 0.05em; text-transform: uppercase;
  padding: 0.9rem 2rem; border-radius: 6px;
  text-decoration: none; border: 1px solid var(--border-strong);
  cursor: pointer; transition: all 0.25s;
  display: inline-flex; align-items: center; gap: 0.5rem;
}
.btn-secondary:hover { border-color: var(--accent); color: var(--accent); background: var(--accent-soft); transform: translateY(-2px); }

.btn-icon {
  width: 18px;
  height: 18px;
  display: block;
  flex-shrink: 0;
}
.btn-primary .btn-icon {
  filter: brightness(0) invert(1);
}
.btn-secondary .btn-icon {
  filter: none;
}
[data-theme="dark"] .btn-secondary .btn-icon {
  filter: brightness(0) saturate(100%) invert(40%) sepia(94%) saturate(2207%) hue-rotate(199deg) brightness(103%) contrast(101%);
}

.skyline-svg { width: 100%; height: 100%; }

/* SECTION SHARED */
section { padding: 7rem 6%; position: relative; }

.section-label {
  font-family: 'DM Mono', monospace;
  font-size: 0.72rem; letter-spacing: 0.2em; text-transform: uppercase;
  color: var(--accent); margin-bottom: 1rem;
  display: flex; align-items: center; gap: 0.7rem;
}
.section-label::before { content:''; display:inline-block; width:30px; height:1px; background:var(--accent); }

.section-title {
  font-family: 'Bebas Neue', sans-serif;
  font-size: clamp(2.5rem, 5vw, 4.5rem);
  line-height: 1; letter-spacing: 0.03em; margin-bottom: 1.2rem;
  color: var(--text);
}
.section-desc { font-size: 1.05rem; color: var(--text-muted); max-width: 540px; margin-bottom: 3.5rem; }

/* REVEAL */
.reveal { opacity: 0; transform: translateY(40px); transition: opacity 0.7s ease, transform 0.7s ease; }
.reveal.visible { opacity: 1; transform: translateY(0); }
.reveal-delay-1 { transition-delay: 0.1s; }
.reveal-delay-2 { transition-delay: 0.2s; }
.reveal-delay-3 { transition-delay: 0.3s; }
.reveal-delay-4 { transition-delay: 0.4s; }

/* STATS BAND */
.stats-band {
  display: grid; grid-template-columns: repeat(4,1fr);
  gap: 1px; background: var(--border);
  border-top: 1px solid var(--border);
  border-bottom: 1px solid var(--border);
}
.stat-item { background: var(--surface); padding: 2.5rem 1.5rem; text-align: center; transition: background 0.4s; }
.stat-number { font-family: 'Bebas Neue', sans-serif; font-size: 3.5rem; line-height: 1; color: var(--accent); letter-spacing: 0.02em; }
.stat-label { font-size: 0.82rem; color: var(--text-muted); margin-top: 0.4rem; letter-spacing: 0.05em; text-transform: uppercase; }

/* SERVICES */
#services { background: var(--surface); transition: background 0.4s; }

.services-image-strip {
  overflow: hidden;
  border-radius: 14px;
  margin-bottom: 3.5rem;
  position: relative;
  height: 220px;
  border: 1px solid var(--border);
}
.services-image-strip::before,
.services-image-strip::after {
  content: '';
  position: absolute; top: 0; bottom: 0; z-index: 2; width: 100px;
  pointer-events: none;
}
.services-image-strip::before {
  left: 0;
  background: linear-gradient(to right, var(--surface), transparent);
}
.services-image-strip::after {
  right: 0;
  background: linear-gradient(to left, var(--surface), transparent);
}
.services-strip-track {
  display: flex;
  gap: 12px;
  animation: stripScroll 35s linear infinite;
  width: max-content;
  height: 100%;
}
.services-strip-track:hover { animation-play-state: paused; }
@keyframes stripScroll {
  0%   { transform: translateX(0); }
  100% { transform: translateX(-50%); }
}
.strip-img {
  width: 320px; height: 100%;
  flex-shrink: 0;
  border-radius: 10px;
  overflow: hidden;
  position: relative;
}
.strip-img img {
  width: 100%; height: 100%;
  object-fit: cover;
  display: block;
  transition: transform 0.4s ease;
}
.strip-img:hover img { transform: scale(1.05); }
.strip-img .strip-caption {
  position: absolute; bottom: 0; left: 0; right: 0;
  background: linear-gradient(to top, rgba(2,11,20,0.85), transparent);
  padding: 1rem 0.9rem 0.7rem;
  font-size: 0.75rem; font-weight: 600;
  letter-spacing: 0.06em; text-transform: uppercase;
  color: rgba(255,255,255,0.85);
}

.services-grid {
  display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
  gap: 1.5px; background: var(--border);
  border: 1px solid var(--border); border-radius: 16px; overflow: hidden;
}
.service-card {
  background: var(--card); padding: 2.5rem 2rem;
  position: relative; overflow: hidden; cursor: default;
  transition: background 0.3s;
}
.service-card::before {
  content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px;
  background: linear-gradient(90deg, var(--accent), var(--accent2));
  transform: scaleX(0); transform-origin: left; transition: transform 0.4s;
}
.service-card:hover { background: var(--card-hover); }
.service-card:hover::before { transform: scaleX(1); }

.service-icon {
  width: 48px; height: 48px;
  display: flex; align-items: center; justify-content: center;
  background: var(--accent-soft); border: 1px solid var(--border-strong);
  border-radius: 10px; margin-bottom: 1.5rem;
  transition: background 0.3s;
}
.service-icon img {
  width: 28px;
  height: 28px;
  display: block;
}
.service-card:hover .service-icon { background: rgba(2,87,185,0.18); }
.service-card h3 { font-size: 1.15rem; font-weight: 600; margin-bottom: 0.7rem; color: var(--text); }
.service-card p { font-size: 0.9rem; color: var(--text-muted); line-height: 1.7; }

.service-link {
  display: inline-flex; align-items: center; gap: 0.4rem;
  margin-top: 1.2rem; font-size: 0.82rem; font-weight: 600;
  letter-spacing: 0.06em; text-transform: uppercase;
  color: var(--accent); text-decoration: none; opacity: 0; transition: opacity 0.3s;
}
.service-card:hover .service-link { opacity: 1; }

/* WHY INTERIA */
#why { background: var(--bg); overflow: hidden; transition: background 0.4s; }

.why-layout { display: grid; grid-template-columns: 1fr 1fr; gap: 5rem; align-items: stretch; }
.why-visual { position: relative; min-height: 480px; height: 100%; align-self: stretch; }

.city-card {
  position: absolute; inset: 0;
  border-radius: 16px; overflow: hidden;
  border: 1px solid var(--border);
  background: var(--surface);
}
.city-card img,
.city-card svg {
  width: 100%;
  height: 100%;
  display: block;
}
.city-card img { object-fit: cover; }

.why-list { list-style: none; display: flex; flex-direction: column; gap: 1.2rem; }
.why-item {
  display: flex; align-items: flex-start; gap: 1rem;
  padding: 1.2rem 1.5rem;
  background: var(--card); border: 1px solid var(--border);
  border-radius: 10px;
  transition: border-color 0.3s, transform 0.3s, background 0.4s;
}
.why-item:hover { border-color: var(--border-strong); transform: translateX(6px); }
.why-item .wi-icon { width:36px;height:36px;flex-shrink:0;display:flex;align-items:center;justify-content:center;background:var(--accent-soft);border-radius:8px;margin-top:2px; }
.why-item .wi-icon img { width:22px;height:22px;display:block; }
.why-item h4 { font-size: 0.95rem; font-weight: 600; margin-bottom: 0.2rem; color: var(--text); }
.why-item p { font-size: 0.85rem; color: var(--text-muted); }

/* ═══════════════════════════════════════════════
   GALLERY — PEOPLE COLLAGE
   ═══════════════════════════════════════════════ */
#gallery {
  background: var(--bg);
  overflow: hidden;
  padding: 0;
  transition: background 0.4s;
}

.gallery-mosaic-wrap {
  position: relative;
  width: 100%;
  padding: clamp(3rem, 6.5vw, 5.8rem) 1.5% clamp(3.5rem, 7.5vw, 6.3rem);
  background:
    radial-gradient(circle at 50% 84%, rgba(2, 87, 185, 0.08), transparent 35%),
    var(--bg);
  transition: background 0.4s;
}
[data-theme="light"] .gallery-mosaic-wrap {
  background:
    radial-gradient(circle at 50% 84%, rgba(2, 87, 185, 0.045), transparent 36%),
    var(--bg);
}

.gallery-mosaic {
  position: relative;
  z-index: 1;
  width: min(100%, 1360px);
  aspect-ratio: 1360 / 640;
  margin: 0 auto;
}

.gallery-bg-text {
  position: absolute;
  left: 50%;
  bottom: 8%;
  transform: translateX(-50%);
  z-index: 3;
  width: min(680px, 70vw);
  font-family: 'DM Sans', sans-serif;
  font-weight: 700;
  font-style: normal;
  color: var(--accent);
  opacity: 1;
  text-align: center;
  text-transform: none;
  white-space: normal;
  pointer-events: none;
  transition: color 0.4s, opacity 0.4s;
}
.gallery-bg-text span {
  display: block;
  font-family: 'DM Sans', sans-serif;
  font-style: normal;
  font-size: clamp(2rem, 3.2vw, 2.85rem);
  line-height: 1.12;
  letter-spacing: -0.05em;
  text-align: center;
  vertical-align: middle;
  -webkit-font-smoothing: antialiased;
  text-rendering: geometricPrecision;
}
.gallery-bg-text span:first-child {
  font-weight: 700;
  color: var(--accent);
}
.gallery-bg-text span:last-child {
  font-weight: 600;
  color: var(--text-muted);
}
.gallery-bg-text span + span {
  margin-top: 0.1rem;
}
[data-theme="light"] .gallery-bg-text {
  color: var(--accent);
  opacity: 1;
}

.mosaic-card {
  position: absolute;
  z-index: 2;
  overflow: hidden;
  border: 1px solid rgba(255,255,255,0.08);
  border-radius: 8px;
  background: var(--card);
  box-shadow: 0 18px 45px rgba(0,0,0,0.22);
  cursor: pointer;
  opacity: 0;
  transition: transform 0.45s cubic-bezier(0.34, 1.56, 0.64, 1),
              box-shadow 0.35s ease,
              border-color 0.3s ease;
}
[data-theme="light"] .mosaic-card {
  border-color: rgba(2, 11, 20, 0.04);
  box-shadow: 0 16px 35px rgba(2, 11, 20, 0.08);
}
.mosaic-card:hover {
  transform: translateY(-8px) scale(1.03);
  box-shadow: 0 24px 55px rgba(2, 87, 185, 0.28);
  border-color: var(--border-strong);
  z-index: 10;
}

.mosaic-card img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
  transition: transform 0.5s ease, filter 0.4s ease;
}
.mosaic-card:hover img { transform: scale(1.06); }
.mosaic-card.tone-muted img { filter: grayscale(1) contrast(0.96); }

.mosaic-card.shape-left-top { left: 0; top: 22.5%; width: 9.5%; height: 26.8%; }
.mosaic-card.shape-left-bottom { left: 0; top: 51.4%; width: 9.5%; height: 26.4%; }
.mosaic-card.shape-team { left: 11.1%; top: 19.3%; width: 12.2%; height: 20.7%; }
.mosaic-card.shape-desk { left: 11.1%; top: 42.5%; width: 12.2%; height: 21.1%; }
.mosaic-card.shape-office { left: 11.1%; top: 66.1%; width: 12.2%; height: 13.9%; }
.mosaic-card.shape-coffee { left: 24.9%; top: 10.7%; width: 12%; height: 56.8%; }
.mosaic-card.shape-window { left: 38.7%; top: 4.3%; width: 10.9%; height: 55.7%; }
.mosaic-card.shape-people { left: 51.7%; top: 5.7%; width: 11.8%; height: 51.1%; }
.mosaic-card.shape-meeting { left: 65.5%; top: 15%; width: 11.1%; height: 53.6%; }
.mosaic-card.shape-notes { left: 78.6%; top: 18.9%; width: 9.6%; height: 21.8%; }
.mosaic-card.shape-books { left: 78.6%; top: 43.2%; width: 9.6%; height: 22.9%; }
.mosaic-card.shape-laptop { left: 78.6%; top: 68.9%; width: 9.6%; height: 14.6%; }
.mosaic-card.shape-student { left: 90.4%; top: 21.1%; width: 9.6%; height: 25.4%; }
.mosaic-card.shape-culture { left: 90.4%; top: 52.1%; width: 9.6%; height: 24.3%; }

@keyframes mosaicReveal {
  from { opacity: 0; }
  to { opacity: 1; }
}

.mosaic-hidden .mosaic-card { opacity: 0; animation: none; }
.mosaic-visible .mosaic-card { animation: mosaicReveal 0.6s ease forwards; }

/* FREE OFFERS */
#offers { background: var(--bg); transition: background 0.4s; }

.offers-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; }
.offer-card {
  border-radius: 16px; overflow: hidden;
  position: relative; padding: 2.5rem;
  border: 1px solid var(--border);
  background: var(--card);
  display: flex; flex-direction: column; gap: 1.2rem;
  transition: transform 0.3s, box-shadow 0.3s, background 0.4s;
}
.offer-card:hover { transform: translateY(-4px); box-shadow: var(--shadow-card); }

.offer-card.gold { background: var(--card); border-color: var(--border-strong); }
.offer-card.gold::before {
  content: ''; position: absolute; inset: -1px;
  border-radius: 17px;
  background: linear-gradient(135deg, rgba(2,87,185,0.22), transparent 50%);
  z-index: -1;
}
.offer-card.blue { background: var(--card); border-color: rgba(10,122,255,0.25); }

.offer-tag {
  display: inline-flex; font-family: 'DM Mono', monospace;
  font-size: 0.7rem; letter-spacing: 0.15em; text-transform: uppercase;
  padding: 0.3rem 0.8rem; border-radius: 100px; width: fit-content;
}
.offer-tag.gold-tag { background: var(--accent-soft); color: var(--accent); border: 1px solid var(--border-strong); }
.offer-tag.blue-tag { background: rgba(10,122,255,0.10); color: #60A5FA; border: 1px solid rgba(10,122,255,0.25); }

.offer-card h3 { font-family: 'Bebas Neue', sans-serif; font-size: 2.2rem; line-height: 1.1; letter-spacing: 0.03em; color: var(--text); }
.offer-card p { font-size: 0.92rem; color: var(--text-muted); }
.offer-icon {
  width: 48px;
  height: 48px;
  margin-bottom: 0.5rem;
}
.offer-icon img {
  width: 100%;
  height: 100%;
  display: block;
}

/* ABOUT */
#about { background: var(--surface); transition: background 0.4s; }

.about-layout { display: grid; grid-template-columns: 1fr 1.2fr; gap: 5rem; align-items: stretch; }

.about-visual {
  position: relative; border-radius: 16px; overflow: hidden;
  background: var(--card); border: 1px solid var(--border); padding: 0;
  transition: background 0.4s;
  align-self: stretch;
}
.about-visual img,
.about-visual svg {
  width: 100%;
  height: 100%;
  display: block;
}
.about-visual img { object-fit: cover; }

.mv-cards { display: grid; gap: 1.5rem; margin-top: 2rem; }
.mv-card {
  background: var(--card); border: 1px solid var(--border);
  border-radius: 12px; padding: 1.8rem;
  position: relative; overflow: hidden;
  transition: background 0.4s;
}
.mv-card::after { content:''; position:absolute; left:0;top:0;bottom:0; width:3px; background:linear-gradient(180deg,var(--accent),var(--accent2)); }
.mv-card h4 { font-family:'Bebas Neue',sans-serif; font-size:1.4rem; letter-spacing:0.05em; color:var(--accent); margin-bottom:0.6rem; }
.mv-card p { font-size: 0.9rem; color: var(--text-muted); }

.team-note {
  background: var(--accent-soft); border: 1px solid var(--border-strong);
  border-radius: 10px; padding: 1.2rem 1.5rem;
  font-size: 0.88rem; color: var(--text-muted);
  margin-top: 1.5rem; line-height: 1.7;
}
.team-note strong { color: var(--text); display:inline-flex;align-items:center;gap:0.4rem; }
.team-note strong img { width:18px;height:18px;display:block;flex-shrink:0; }

/* CONTACT */
#contact { background: var(--bg); transition: background 0.4s; }

.contact-layout {
  display: grid;
  grid-template-columns: 1fr 1.3fr;
  gap: 5rem;
  align-items: start;
}

.contact-info { display: flex; flex-direction: column; gap: 1.5rem; }

.contact-block {
  display: flex; align-items: flex-start; gap: 1rem;
  padding: 1.2rem 1.4rem;
  background: var(--card); border: 1px solid var(--border);
  border-radius: 10px; transition: border-color 0.3s, background 0.4s;
}
.contact-block:hover { border-color: var(--border-strong); }
.contact-block .cb-icon { font-size:1.3rem;width:40px;height:40px;display:flex;align-items:center;justify-content:center;background:var(--accent-soft);border-radius:8px;flex-shrink:0; }
.contact-block .cb-icon img { width:24px;height:24px;display:block; }
.contact-block h5 { font-size:0.78rem;text-transform:uppercase;letter-spacing:0.1em;color:var(--text-muted);margin-bottom:0.25rem; }
.contact-block p { font-size:0.95rem;color:var(--text);font-weight:500; }

.contact-form { display: flex; flex-direction: column; gap: 1.2rem; }
.form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1.2rem; }

.form-group { display: flex; flex-direction: column; gap: 0.5rem; }
.form-group label { font-size:0.78rem;text-transform:uppercase;letter-spacing:0.1em;color:var(--text-muted);font-weight:500; }
.form-group input,
.form-group select,
.form-group textarea {
  background: var(--card); border: 1px solid var(--border);
  border-radius: 8px; padding: 0.85rem 1rem;
  font-family: 'DM Sans', sans-serif; font-size: 0.92rem;
  color: var(--text); outline: none;
  transition: border-color 0.25s, box-shadow 0.25s, background 0.4s;
}
.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus { border-color: var(--accent); box-shadow: 0 0 0 3px var(--accent-soft); }
.form-group textarea { resize: vertical; min-height: 120px; }
.form-group select option { background: var(--card); color: var(--text); }

.form-submit {
  width: 100%; background: var(--accent); color: #fff;
  font-family: 'DM Sans', sans-serif; font-weight: 700;
  font-size: 0.92rem; letter-spacing: 0.08em; text-transform: uppercase;
  padding: 1rem; border: none; border-radius: 8px;
  cursor: pointer; transition: all 0.25s;
  box-shadow: 0 4px 20px var(--accent-glow);
}
.form-submit:hover { background: var(--accent-light); transform: translateY(-2px); box-shadow: 0 8px 30px rgba(2,87,185,0.4); }

/* FOOTER */
footer {
  background: var(--surface);
  border-top: 1px solid var(--border);
  padding: 3rem 6%;
  display: flex; align-items: center;
  justify-content: space-between;
  flex-wrap: wrap; gap: 1.5rem;
  transition: background 0.4s;
}
.footer-logo { display: inline-flex; align-items: center; flex-shrink: 0; }
.footer-logo img { display: block; width: 170px; height: auto; }
footer p { font-size: 0.82rem; color: var(--text-muted); }
.footer-links { display: flex; gap: 1.5rem; }
.footer-links a { font-size:0.82rem;color:var(--text-muted);text-decoration:none;transition:color 0.2s; }
.footer-links a:hover { color: var(--accent); }

.divider { height:1px;background:linear-gradient(90deg,transparent,var(--border) 30%,var(--border) 70%,transparent);margin:0 6%; }

/* MOBILE */
@media (max-width: 900px) {
  .why-layout,.about-layout,.contact-layout { grid-template-columns:1fr;gap:2.5rem; }
  .why-visual,.about-visual { height:260px; }
  .offers-grid { grid-template-columns:1fr; }
  .stats-band { grid-template-columns:repeat(2,1fr); }
  .nav-links { display:none; }
  .hamburger { display:flex; }
  .form-row { grid-template-columns:1fr; }
  .why-visual { display:none; }
  .gallery-mosaic-wrap { padding-left: 1rem; padding-right: 1rem; }
  .gallery-bg-text {
    bottom: 8%;
    width: 82vw;
    transform: translateX(-50%);
  }
  .gallery-bg-text span {
    font-size: clamp(1.45rem, 5.8vw, 2.4rem);
    line-height: 1.12;
    letter-spacing: -0.04em;
  }
  .gallery-bg-text span + span { margin-top: 0.1rem; }
  .services-image-strip { height: 160px; }
  .strip-img { width: 220px; }
  #hero { align-items: center; text-align: center; }
  .hero-sub-block { justify-content: center; }
  .hero-trust { justify-content: center; }
  .hero-ctas { justify-content: center; }
}

@keyframes shake {
  0%,100%{transform:translateX(0)} 20%,60%{transform:translateX(-8px)} 40%,80%{transform:translateX(8px)}
}
</style>
@endverbatim
