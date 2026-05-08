<!-- HERO — Modified text to match Image 2 -->
<section id="hero">
  <div class="hero-video" aria-hidden="true">
    <video autoplay muted loop playsinline preload="metadata">
      <source src="{{ asset('videos/it-video.mp4') }}" type="video/mp4" />
    </video>
  </div>
  <div class="hero-grid"></div>
  <div class="hero-glow"></div>
  <div class="orb orb1"></div>
  <div class="orb orb2"></div>

  <div class="hero-skyline">
    <svg class="skyline-svg" viewBox="0 0 1400 400" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMax meet">
      <defs>
        <linearGradient id="skyGrad" x1="0" y1="0" x2="0" y2="1">
          <stop offset="0%" stop-color="#0257B9" stop-opacity="0.4"/>
          <stop offset="100%" stop-color="#0257B9" stop-opacity="0"/>
        </linearGradient>
        <linearGradient id="buildingGrad" x1="0" y1="0" x2="0" y2="1">
          <stop offset="0%" stop-color="#0257B9" stop-opacity="0.7"/>
          <stop offset="100%" stop-color="#0257B9" stop-opacity="0.15"/>
        </linearGradient>
      </defs>
      <rect x="0" y="370" width="1400" height="30" fill="url(#skyGrad)"/>
      <rect x="0" y="180" width="90" height="220" fill="url(#buildingGrad)"/>
      <rect x="5" y="140" width="18" height="40" fill="url(#buildingGrad)"/>
      <rect x="100" y="220" width="60" height="180" fill="url(#buildingGrad)"/>
      <rect x="170" y="100" width="80" height="300" fill="url(#buildingGrad)"/>
      <rect x="175" y="80" width="12" height="30" fill="url(#buildingGrad)"/>
      <rect x="260" y="160" width="50" height="240" fill="url(#buildingGrad)"/>
      <rect x="320" y="200" width="70" height="200" fill="url(#buildingGrad)"/>
      <polygon points="430,370 510,120 590,370" fill="url(#buildingGrad)"/>
      <rect x="505" y="80" width="10" height="45" fill="url(#buildingGrad)"/>
      <polygon points="640,370 660,200 680,370" fill="url(#buildingGrad)"/>
      <rect x="657" y="160" width="6" height="45" fill="url(#buildingGrad)"/>
      <rect x="635" y="290" width="50" height="6" fill="url(#buildingGrad)"/>
      <rect x="643" y="250" width="34" height="6" fill="url(#buildingGrad)"/>
      <rect x="700" y="130" width="65" height="240" fill="url(#buildingGrad)"/>
      <rect x="703" y="100" width="15" height="35" fill="url(#buildingGrad)"/>
      <rect x="775" y="170" width="55" height="200" fill="url(#buildingGrad)"/>
      <rect x="840" y="200" width="45" height="170" fill="url(#buildingGrad)"/>
      <rect x="900" y="250" width="20" height="120" fill="url(#buildingGrad)"/>
      <ellipse cx="910" cy="245" rx="32" ry="32" fill="url(#buildingGrad)"/>
      <rect x="950" y="150" width="55" height="220" fill="url(#buildingGrad)"/>
      <rect x="955" y="120" width="10" height="35" fill="url(#buildingGrad)"/>
      <rect x="1015" y="190" width="70" height="180" fill="url(#buildingGrad)"/>
      <rect x="1095" y="110" width="85" height="260" fill="url(#buildingGrad)"/>
      <rect x="1100" y="80" width="14" height="35" fill="url(#buildingGrad)"/>
      <rect x="1190" y="200" width="60" height="170" fill="url(#buildingGrad)"/>
      <rect x="1260" y="160" width="50" height="210" fill="url(#buildingGrad)"/>
      <rect x="1320" y="220" width="80" height="150" fill="url(#buildingGrad)"/>
    </svg>
  </div>

  <!-- MODIFIED HERO CONTENT — matches Image 2 layout -->
  <div class="hero-content">
    <div class="hero-badge">
      <span class="dot"></span>
      Las Vegas — Local IT Experts
    </div>

    <h1 class="hero-headline">
      Technology solutions<br/>
      that <span class="accent">power your business.</span>
    </h1>

    <div class="hero-sub-block">
      <div class="hero-sub-bar"></div>
      <p class="hero-sub">
        Enterprise-grade IT services with a local team and no extra cost for onsite support.
      </p>
    </div>

    <div class="hero-trust">
      <div class="trust-chip"><span class="check">✔</span> Fast Response Times</div>
      <div class="trust-chip"><span class="check">✔</span> Onsite Support Included</div>
      <div class="trust-chip"><span class="check">✔</span> Enterprise-Grade Security</div>
      <div class="trust-chip"><span class="check">✔</span> Local Las Vegas Team</div>
    </div>

    <div class="hero-ctas">
      <a href="#contact" class="btn-primary">
        <img class="btn-icon" src="{{ asset('images/icon-free-assessment.svg') }}" alt="" aria-hidden="true" />
        Free IT Assessment
      </a>
      <a href="#offers" class="btn-secondary">
        <img class="btn-icon" src="{{ asset('images/icon-ai-workshop.svg') }}" alt="" aria-hidden="true" />
        Free AI Workshops →
      </a>
    </div>
  </div>
</section>

<!-- STATS BAND -->
<div class="stats-band">
  <div class="stat-item reveal">
    <div class="stat-number" data-target="200">0</div>
    <div class="stat-label">Businesses Served</div>
  </div>
  <div class="stat-item reveal reveal-delay-1">
    <div class="stat-number" data-target="99.9" data-decimal>0</div>
    <div class="stat-label">Uptime SLA %</div>
  </div>
  <div class="stat-item reveal reveal-delay-2">
    <div class="stat-number"><span data-target="15" class="count-num">0</span>min</div>
    <div class="stat-label">Avg Response Time</div>
  </div>
  <div class="stat-item reveal reveal-delay-3">
    <div class="stat-number"><span data-target="10" class="count-num">0</span>+</div>
    <div class="stat-label">Years Experience</div>
  </div>
</div>
