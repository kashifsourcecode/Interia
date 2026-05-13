@php
    /** @var \App\Models\IndustryCard $card */
    $imgUrl = $card->resolvedImageUrl();
@endphp
<article class="{{ $card->cardCssClasses() }}{{ $card->revealDelayClass($index) }}">
    @if ($card->imageFirst())
        @if ($imgUrl !== '')
            <div class="{{ $card->mediaWrapperClasses() }}">
                <img src="{{ $imgUrl }}" alt="{{ $card->image_alt }}" loading="lazy" width="560" height="360" />
            </div>
        @endif
        <div class="industry-card-body">
            <h3 class="industry-card-title">{{ $card->title }}</h3>
            <p class="industry-card-desc">{{ $card->description }}</p>
        </div>
    @else
        <div class="industry-card-body">
            <h3 class="industry-card-title">{{ $card->title }}</h3>
            <p class="industry-card-desc">{{ $card->description }}</p>
        </div>
        @if ($imgUrl !== '')
            <div class="{{ $card->mediaWrapperClasses() }}">
                <img src="{{ $imgUrl }}" alt="{{ $card->image_alt }}" loading="lazy" width="560" height="360" />
            </div>
        @endif
    @endif
</article>
