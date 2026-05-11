@if ($offerSection)
<section id="offers">
  <div class="section-label reveal">{{ $offerSection->label }}</div>
  <h2 class="section-title reveal">{!! nl2br(e($offerSection->title)) !!}</h2>
  @if (filled($offerSection->description))
    <p class="section-desc reveal">{{ $offerSection->description }}</p>
  @endif

  @if ($offerSection->cards->isNotEmpty())
    <div class="offers-grid">
      @foreach ($offerSection->cards as $card)
        @php($delaySuffix = $loop->index > 0 ? ' reveal-delay-'.min($loop->index, 3) : '')
        <div class="offer-card {{ $card->cardCssClass() }} reveal{{ $delaySuffix }}">
          @if ($iconUrl = $card->resolvedIconUrl())
            <div class="offer-icon">
              <img src="{{ $iconUrl }}" alt="" aria-hidden="true" />
            </div>
          @endif
          <div class="offer-tag {{ $card->tagCssClass() }}">{{ $card->pill_label }}</div>
          <h3>{{ $card->title }}</h3>
          <p>{{ $card->description }}</p>
          <a href="{{ $card->cta_url ?: '#contact' }}" class="{{ $card->buttonCssClass() }}" style="width:fit-content;margin-top:0.5rem;">{{ $card->cta_label }}</a>
        </div>
      @endforeach
    </div>
  @endif
</section>
@endif
