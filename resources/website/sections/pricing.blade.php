@if ($pricingSection)
<section id="pricing">
  <div class="pricing-header">
    <h2 class="section-title pricing-title reveal">{{ $pricingSection->title }}</h2>
    @if (filled($pricingSection->subtitle))
      <p class="pricing-subtitle reveal">{{ $pricingSection->subtitle }}</p>
    @endif
  </div>

  @if ($pricingSection->plans->isNotEmpty())
    <div class="pricing-grid">
      @foreach ($pricingSection->plans as $plan)
        @php($delaySuffix = $loop->index > 0 ? ' reveal-delay-'.min($loop->index, 2) : '')
        <div class="pricing-card{{ $plan->is_featured ? ' pricing-card-popular' : '' }} reveal{{ $delaySuffix }}">
          @if ($plan->is_featured)
            <div class="pricing-popular-badge">Most Popular</div>
          @endif
          <div class="pricing-card-inner">
            <div class="pricing-card-head">
              <h3 class="pricing-name">{{ $plan->name }}</h3>
              @if (filled($plan->tagline))
                <p class="pricing-tag">{{ $plan->tagline }}</p>
              @endif
            </div>

            <div class="pricing-price">
              <span class="pricing-currency">{{ $plan->currency_symbol }}</span>
              <span class="pricing-amount">{{ $plan->amount }}</span>
              <span class="pricing-period">{{ $plan->period }}</span>
            </div>

            <ul class="pricing-features">
              @foreach ($plan->featureLines() as $line)
                <li><span class="pricing-check" aria-hidden="true"></span>{{ $line }}</li>
              @endforeach
            </ul>

            <a href="{{ $plan->cta_url ?: '#contact' }}" class="pricing-cta {{ $plan->ctaClass() }}">{{ $plan->cta_label }}</a>
          </div>
        </div>
      @endforeach
    </div>
  @endif

  @if ($pricingSection->addonCards->isNotEmpty())
    <div class="pricing-addons reveal">
      <div class="pricing-addons-header">
        <h2 class="pricing-title pricing-addons-title">{{ $pricingSection->addons_title }}</h2>
        @if (filled($pricingSection->addons_subtitle))
          <p class="pricing-subtitle">{{ $pricingSection->addons_subtitle }}</p>
        @endif
      </div>

      <div class="addons-grid">
        @foreach ($pricingSection->addonCards as $addon)
          @php($aDelay = $loop->index > 0 ? ' reveal-delay-'.min($loop->index, 2) : '')
          <div class="addon-card reveal{{ $aDelay }}">
            <div class="addon-head">
              @if ($iconUrl = $addon->resolvedIconUrl())
                <span class="addon-icon" aria-hidden="true">
                  <img src="{{ $iconUrl }}" alt="" />
                </span>
              @endif
              <h3 class="addon-title">{{ $addon->title }}</h3>
            </div>

            <div class="addon-rows">
              @foreach ($addon->normalizedRows() as $row)
                <div class="addon-row">
                  <span class="addon-row-label">{{ $row['label'] }}</span>
                  <span class="addon-row-price">{{ $row['amount'] }}@if (filled($row['unit']))<span class="addon-row-unit">{{ $row['unit'] }}</span>@endif</span>
                </div>
              @endforeach
            </div>

            @if (filled($addon->footer_description))
              <p class="addon-desc">{{ $addon->footer_description }}</p>
            @endif
          </div>
        @endforeach
      </div>
    </div>
  @endif
</section>
@endif
