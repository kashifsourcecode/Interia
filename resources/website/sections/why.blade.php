@if ($whySection)
<section id="why">
  @php($heroUrl = $whySection->resolvedHeroImageUrl())
  <div class="why-layout{{ $heroUrl ? '' : ' why-layout--single' }}">
    <div>
      <div class="section-label reveal">{{ $whySection->label }}</div>
      <h2 class="section-title reveal">{!! nl2br(e($whySection->title)) !!}</h2>
      @if (filled($whySection->description))
        <p class="section-desc reveal" style="margin-bottom:2rem;">{{ $whySection->description }}</p>
      @endif

      @if ($whySection->features->isNotEmpty())
        <ul class="why-list">
          @foreach ($whySection->features as $feature)
            @php($delaySuffix = $loop->index > 0 ? ' reveal-delay-'.min($loop->index, 3) : '')
            <li class="why-item reveal{{ $delaySuffix }}">
              @if ($iconUrl = $feature->resolvedIconUrl())
                <div class="wi-icon">
                  <img src="{{ $iconUrl }}" alt="" aria-hidden="true" />
                </div>
              @endif
              <div>
                <h4>{{ $feature->title }}</h4>
                <p>{{ $feature->description }}</p>
              </div>
            </li>
          @endforeach
        </ul>
      @endif
    </div>

    @if ($heroUrl)
      <div class="why-visual reveal">
        <div class="city-card">
          <img src="{{ $heroUrl }}"
               alt="{{ $whySection->hero_image_alt ?? '' }}"
               loading="lazy" />
        </div>
      </div>
    @endif
  </div>
</section>
@endif
