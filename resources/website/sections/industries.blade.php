@if ($industrySection)
    <section id="industries" aria-labelledby="industries-heading">
        <header class="industries-top reveal">
            @if (filled($industrySection->label))
                <div class="section-label">{{ $industrySection->label }}</div>
            @endif
            <h2 id="industries-heading" class="section-title">{!! nl2br(e($industrySection->title)) !!}</h2>
            @if (filled($industrySection->description))
                <p class="section-desc">{{ $industrySection->description }}</p>
            @endif
        </header>

        <div class="industries-mosaic">
            <div class="industries-col industries-col--left">
                @foreach ($industrySection->cardsInColumn('left') as $card)
                    @include('website::sections.partials.industry-card', ['card' => $card, 'index' => $loop->index])
                @endforeach
            </div>

            <div class="industries-col industries-col--center">
                <div class="industries-sub reveal reveal-delay-1">
                    <p id="industries-sub-focus" class="industries-sub-title">{{ $industrySection->sub_heading }}</p>
                    @if (filled($industrySection->sub_lead))
                        <p class="industries-sub-lead">{{ $industrySection->sub_lead }}</p>
                    @endif
                </div>

                @foreach ($industrySection->cardsInColumn('center') as $card)
                    @include('website::sections.partials.industry-card', [
                        'card' => $card,
                        'index' => $loop->index + 2,
                    ])
                @endforeach
            </div>

            <div class="industries-col industries-col--right">
                @foreach ($industrySection->cardsInColumn('right') as $card)
                    @include('website::sections.partials.industry-card', ['card' => $card, 'index' => $loop->index])
                @endforeach
            </div>
        </div>
    </section>
@endif
