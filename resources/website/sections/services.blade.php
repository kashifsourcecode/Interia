@if($serviceSection)
<section id="services">
  <div class="section-label reveal">{{ $serviceSection->label }}</div>
  <h2 class="section-title reveal">{!! nl2br(e($serviceSection->title)) !!}</h2>
  @if(filled($serviceSection->description))
    <p class="section-desc reveal">{{ $serviceSection->description }}</p>
  @endif

  @if($serviceSection->carouselItems->isNotEmpty())
  <div class="services-image-strip reveal">
    <div class="services-strip-track">
      @for($stripCopy = 0; $stripCopy < 2; $stripCopy++)
        @foreach($serviceSection->carouselItems as $item)
          <div class="strip-img">
            <img
              src="{{ $item->resolvedImageUrl() }}"
              alt="{{ $item->image_alt ?? $item->caption }}"
              loading="lazy"
            />
            <div class="strip-caption">{{ $item->caption }}</div>
          </div>
        @endforeach
      @endfor
    </div>
  </div>
  @endif

  @if($serviceSection->cards->isNotEmpty())
  <div class="services-grid">
    @foreach($serviceSection->cards as $card)
      @php($delaySuffix = $loop->index > 0 ? ' reveal-delay-'.min($loop->index, 3) : '')
      <div class="service-card reveal{{ $delaySuffix }}">
        @if($iconUrl = $card->resolvedIconUrl())
          <div class="service-icon">
            <img src="{{ $iconUrl }}" alt="" aria-hidden="true" />
          </div>
        @endif
        <h3>{{ $card->name }}</h3>
        <p>{{ $card->description }}</p>
        <a href="{{ $card->cta_url ?: '#contact' }}" class="service-link">{{ $card->cta_label ?: 'Learn more' }} →</a>
      </div>
    @endforeach
  </div>
  @endif
</section>
@endif
