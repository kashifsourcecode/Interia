@if ($aiAdoptionSection)
<section id="ai-adoption">
  <div class="ai-header">
    <div class="section-label reveal">{{ $aiAdoptionSection->label }}</div>
    <h2 class="section-title ai-title reveal">{!! nl2br(e($aiAdoptionSection->title)) !!}</h2>
    @if (filled($aiAdoptionSection->subtitle))
      <p class="ai-subtitle reveal">{{ $aiAdoptionSection->subtitle }}</p>
    @endif
  </div>

  @if ($aiAdoptionSection->steps->isNotEmpty())
  <div class="ai-steps-grid">
    @foreach ($aiAdoptionSection->steps as $step)
      @php($delaySuffix = $loop->index > 0 ? ' reveal-delay-'.min($loop->index, 4) : '')
      <div class="ai-step {{ $step->layoutCssClass() }} reveal{{ $delaySuffix }}">
        <div class="ai-step-head">
          @if ($iconUrl = $step->resolvedIconUrl())
            <span class="ai-step-icon" aria-hidden="true">
              <img src="{{ $iconUrl }}" alt="" />
            </span>
          @endif
          <span class="ai-step-label">{{ $step->step_label }}</span>
        </div>
        <h3 class="ai-step-title" data-text="{{ $step->title }}"><span class="ai-step-title-inner">{{ $step->title }}</span></h3>
        <p class="ai-step-desc">{{ $step->description }}</p>
        @if (filled($step->stat_emphasis) || filled($step->stat_caption))
          <div class="ai-step-stat">
            @if (filled($step->stat_emphasis))
              <strong>{{ $step->stat_emphasis }}</strong>
            @endif
            @if (filled($step->stat_caption))
              <span>{{ $step->stat_caption }}</span>
            @endif
          </div>
        @endif
      </div>
    @endforeach
  </div>
  @endif

  @php($dashboardUrl = $aiAdoptionSection->resolvedDashboardImageUrl())
  <div class="ai-framework{{ $dashboardUrl ? '' : ' ai-framework--single' }}">
    @if ($dashboardUrl)
      <div class="ai-dashboard reveal">
        <img class="ai-dashboard-img"
             src="{{ $dashboardUrl }}"
             alt="{{ $aiAdoptionSection->dashboard_image_alt ?? '' }}"
             loading="lazy" />
      </div>
    @endif

    <div class="ai-framework-content">
      <div class="section-label reveal">{{ $aiAdoptionSection->framework_heading }}</div>
      <p class="ai-framework-desc reveal">{{ $aiAdoptionSection->framework_description }}</p>

      @if ($aiAdoptionSection->checklistItems->isNotEmpty())
        <ul class="ai-framework-list">
          @foreach ($aiAdoptionSection->checklistItems as $item)
            @php($liDelay = $loop->index > 0 ? ' reveal-delay-'.min($loop->index, 2) : '')
            <li class="reveal{{ $liDelay }}"><span class="ai-check" aria-hidden="true"></span>{{ $item->label }}</li>
          @endforeach
        </ul>
      @endif
    </div>
  </div>
</section>
@endif
