<!-- NAV — Added "Home" link -->
<nav id="navbar">
  <a href="#hero" class="nav-logo" aria-label="Interia Technologies home">
    <img src="{{ asset('images/interia-logo.png') }}" alt="Interia Technologies" />
  </a>
  <ul class="nav-links">
    <li><a href="#hero">Home</a></li>
    <li><a href="#services">Services</a></li>
    <li><a href="#why">Why Us</a></li>
    <li><a href="#gallery">Gallery</a></li>
    <li><a href="#offers">Free Offers</a></li>
    <li><a href="#about">About</a></li>
    <li><a href="#contact">Contact</a></li>
  </ul>
  <div class="nav-right">
    <button class="theme-toggle" id="themeToggle" onclick="toggleTheme()" title="Switch to light theme" aria-label="Switch to light theme">
      <svg class="theme-icon theme-icon-sun" viewBox="0 0 24 24" fill="none" aria-hidden="true">
        <circle cx="12" cy="12" r="4.2" stroke="currentColor" stroke-width="1.8"/>
        <path d="M12 2.5v2.2M12 19.3v2.2M4.58 4.58l1.56 1.56M17.86 17.86l1.56 1.56M2.5 12h2.2M19.3 12h2.2M4.58 19.42l1.56-1.56M17.86 6.14l1.56-1.56" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
      </svg>
      <svg class="theme-icon theme-icon-moon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
        <path d="M20.25 14.28A8.1 8.1 0 0 1 9.72 3.75 8.65 8.65 0 1 0 20.25 14.28Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M16.7 4.2l.42 1.18 1.18.42-1.18.42-.42 1.18-.42-1.18-1.18-.42 1.18-.42.42-1.18Z" fill="currentColor"/>
      </svg>
    </button>
    <a href="#contact" class="nav-cta">Get Started</a>
    <button class="hamburger" id="hamburger" aria-label="Menu">
      <span></span><span></span><span></span>
    </button>
  </div>
</nav>
