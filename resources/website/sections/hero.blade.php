@php
  $bgMode = $heroSection?->background_mode ?? 'video';
  $videoSrc = ($heroSection && filled($heroSection->background_video_path))
    ? $heroSection->backgroundVideoSrc()
    : asset('videos/it-video.mp4');
  $bgImageUrl = $heroSection?->resolvedBackgroundImageUrl() ?? '';

  $badgeText = $heroSection?->badge_text;
  $headlineLine1 = $heroSection?->headline_line_1 ?? 'Technology solutions';
  $headlineLine2Lead = $heroSection?->headline_line_2_lead ?? 'that ';
  $headlineLine2Accent = $heroSection?->headline_line_2_accent ?? 'power your business.';
  $subheadline = $heroSection?->subheadline ?? 'Enterprise-grade IT services with a local team and no extra cost for onsite support.';

  $primaryLabel = $heroSection?->primary_cta_label ?? 'Free IT Assessment';
  $primaryUrl = $heroSection ? $heroSection->resolvedCtaUrl((string) $heroSection->primary_cta_url) : route('website.section.contact');
  $primaryIcon = filled($heroSection?->resolvedPrimaryCtaIconUrl())
    ? $heroSection->resolvedPrimaryCtaIconUrl()
    : asset('images/icon-free-assessment.svg');

  $secondaryLabel = $heroSection?->secondary_cta_label ?? 'Free AI Workshops';
  $secondaryUrl = $heroSection ? $heroSection->resolvedCtaUrl((string) $heroSection->secondary_cta_url) : route('website.section.offers');
  $secondaryIcon = filled($heroSection?->resolvedSecondaryCtaIconUrl())
    ? $heroSection->resolvedSecondaryCtaIconUrl()
    : asset('images/icon-ai-workshop.svg');
  $secondaryShowArrow = $heroSection?->secondary_cta_show_arrow ?? true;

  $defaultChips = collect([
    'Fast Response Times',
    'Onsite Support Included',
    'Enterprise-Grade Security',
    'Local Las Vegas Team',
  ])->map(fn (string $label): object => (object) ['label' => $label]);

  $trustChips = ($heroSection && $heroSection->trustChips->isNotEmpty())
    ? $heroSection->trustChips
    : $defaultChips;

  $defaultStats = collect([
    (object) ['label' => 'Businesses Served', 'static_display' => null, 'count_target' => 200, 'count_as_decimal' => false, 'suffix_after_count' => null],
    (object) ['label' => 'Uptime SLA %', 'static_display' => null, 'count_target' => 99.9, 'count_as_decimal' => true, 'suffix_after_count' => null],
    (object) ['label' => 'Avg Response Time', 'static_display' => null, 'count_target' => 15, 'count_as_decimal' => false, 'suffix_after_count' => 'min'],
    (object) ['label' => 'Years Experience', 'static_display' => null, 'count_target' => 10, 'count_as_decimal' => false, 'suffix_after_count' => '+'],
  ]);

  $statItems = ($heroSection && $heroSection->statItems->isNotEmpty())
    ? $heroSection->statItems
    : $defaultStats;
@endphp

<!-- HERO — content from admin (Homepage Hero) -->
<section id="hero">
  <div class="hero-video" aria-hidden="true">
    @if ($bgMode === 'image' && filled($bgImageUrl))
      <div class="hero-bg-image" style="background-image: url({{ json_encode($bgImageUrl) }});"></div>
    @else
      <video autoplay muted loop playsinline preload="metadata">
        <source src="{{ $videoSrc }}" type="video/mp4" />
      </video>
    @endif
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

  <div class="hero-content">
    @if (filled($badgeText))
      <div class="hero-badge">
        <span class="dot"></span>
        {{ $badgeText }}
      </div>
    @endif

    <h1 class="hero-headline">
      {!! nl2br(e($headlineLine1)) !!}<br/>
      {{ $headlineLine2Lead }}<span class="accent">{{ $headlineLine2Accent }}</span>
    </h1>

    <div class="hero-sub-block">
      <div class="hero-sub-bar"></div>
      <p class="hero-sub">{{ $subheadline }}</p>
    </div>

    <div class="hero-trust">
      @foreach ($trustChips as $chip)
        <div class="trust-chip"><span class="check">✔</span> {{ $chip->label }}</div>
      @endforeach
    </div>

    <div class="hero-ctas">
      <a href="{{ $primaryUrl }}" class="btn-primary">
        <img class="btn-icon" src="{{ $primaryIcon }}" alt="" aria-hidden="true" />
        {{ $primaryLabel }}
      </a>
      <a href="{{ $secondaryUrl }}" class="btn-secondary">
        <img class="btn-icon" src="{{ $secondaryIcon }}" alt="" aria-hidden="true" />
        {{ $secondaryLabel }}@if ($secondaryShowArrow)<span aria-hidden="true"> →</span>@endif
      </a>
    </div>
  </div>
</section>

<!-- STATS BAND -->
<div class="stats-band">
  @foreach ($statItems as $stat)
    @php
      $delayClass = $loop->index > 0 ? ' reveal-delay-'.min($loop->index, 3) : '';
      $static = isset($stat->static_display) ? trim((string) $stat->static_display) : '';
      $target = $stat->count_target ?? null;
      $suffix = isset($stat->suffix_after_count) ? trim((string) $stat->suffix_after_count) : '';
      $asDecimal = (bool) ($stat->count_as_decimal ?? false);
    @endphp
    <div class="stat-item reveal{{ $delayClass }}">
      @if ($static !== '')
        <div class="stat-number">{{ $static }}</div>
      @elseif ($suffix !== '' && $target !== null)
        <div class="stat-number">
          <span
            class="count-num"
            data-target="{{ $target }}"
            @if ($asDecimal) data-decimal @endif
          >0</span>{{ $suffix }}
        </div>
      @elseif ($target !== null)
        <div
          class="stat-number"
          data-target="{{ $target }}"
          @if ($asDecimal) data-decimal @endif
        >0</div>
      @else
        <div class="stat-number">—</div>
      @endif
      <div class="stat-label">{{ $stat->label }}</div>
    </div>
  @endforeach
</div>
