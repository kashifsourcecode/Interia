<!-- NAV — Added "Home" link -->
<nav id="navbar">
  <a href="{{ url('/') }}" class="nav-logo" aria-label="Interia Technologies home">
    <img src="{{ asset('images/interia-logo.png') }}" alt="Interia Technologies" />
  </a>
  <ul class="nav-links">
    <li><a href="{{ url('/') }}">Home</a></li>
    @if ($homeSectionNav['services'] ?? false)
      <li><a href="{{ route('website.section.services') }}">Services</a></li>
    @endif
    @if ($homeSectionNav['industries'] ?? false)
      <li><a href="{{ route('website.section.industries') }}">Industries</a></li>
    @endif
    @if ($homeSectionNav['why'] ?? false)
      <li><a href="{{ route('website.section.why') }}">Why Us</a></li>
    @endif
    @if ($homeSectionNav['gallery'] ?? false)
      <li><a href="{{ route('website.section.gallery') }}">Gallery</a></li>
    @endif
    @if ($homeSectionNav['offers'] ?? false)
      <li><a href="{{ route('website.section.offers') }}">Free Assessments</a></li>
    @endif
    @if ($homeSectionNav['about'] ?? false)
      <li><a href="{{ route('website.section.about') }}">About</a></li>
    @endif
    @if ($homeSectionNav['contact'] ?? false)
      <li><a href="{{ route('website.section.contact') }}">Contact</a></li>
    @endif
  </ul>
  <div class="nav-right">
    <a href="{{ route('website.section.pricing') }}" class="nav-cta nav-enterprise-cta">
      <svg class="nav-cta-icon" viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
        <path d="M3 21h18"/>
        <path d="M5 21V8l5-3 5 3v13"/>
        <path d="M15 21V11l4-2v12"/>
        <path d="M9 12h2M9 16h2"/>
      </svg>
      <span>Get Enterprise Quote</span>
    </a>
    <button class="theme-toggle" id="themeToggle" onclick="toggleTheme()" title="Switch to dark theme" aria-label="Switch to dark theme">
      <svg class="theme-icon theme-icon-sun" viewBox="0 0 24 24" fill="none" aria-hidden="true">
        <circle cx="12" cy="12" r="4.2" stroke="currentColor" stroke-width="1.8"/>
        <path d="M12 2.5v2.2M12 19.3v2.2M4.58 4.58l1.56 1.56M17.86 17.86l1.56 1.56M2.5 12h2.2M19.3 12h2.2M4.58 19.42l1.56-1.56M17.86 6.14l1.56-1.56" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
      </svg>
      <svg class="theme-icon theme-icon-moon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
        <path d="M20.25 14.28A8.1 8.1 0 0 1 9.72 3.75 8.65 8.65 0 1 0 20.25 14.28Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M16.7 4.2l.42 1.18 1.18.42-1.18.42-.42 1.18-.42-1.18-1.18-.42 1.18-.42.42-1.18Z" fill="currentColor"/>
      </svg>
    </button>
    <button class="hamburger" id="hamburger" aria-label="Menu">
      <span></span><span></span><span></span>
    </button>
  </div>
</nav>
