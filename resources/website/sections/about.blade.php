@if ($aboutSection)
<section id="about">
  @php($heroUrl = $aboutSection->resolvedHeroImageUrl())
  <div class="about-layout{{ $heroUrl ? '' : ' about-layout--single' }}">
    @if ($heroUrl)
      <div class="about-visual reveal">
        <img src="{{ $heroUrl }}" alt="{{ $aboutSection->hero_image_alt ?? '' }}" loading="lazy" />
      </div>
    @endif

    <div>
      <div class="section-label reveal">{{ $aboutSection->label }}</div>
      <h2 class="section-title reveal">{!! nl2br(e($aboutSection->title)) !!}</h2>
      <p style="color:var(--text-muted);font-size:0.95rem;line-height:1.8;margin-bottom:1.5rem;" class="reveal">{{ $aboutSection->intro_paragraph_1 }}</p>
      @if (filled($aboutSection->intro_paragraph_2))
        <p style="color:var(--text-muted);font-size:0.95rem;line-height:1.8;margin-bottom:2rem;" class="reveal">{{ $aboutSection->intro_paragraph_2 }}</p>
      @endif

      <div class="mv-cards">
        <div class="mv-card reveal">
          <h4>{{ $aboutSection->mission_title }}</h4>
          <p>{{ $aboutSection->mission_body }}</p>
        </div>
        <div class="mv-card reveal reveal-delay-1">
          <h4>{{ $aboutSection->vision_title }}</h4>
          <p>{{ $aboutSection->vision_body }}</p>
        </div>
      </div>

      <div class="team-note reveal">
        <strong>
          @if ($footerIconUrl = $aboutSection->resolvedFooterIconUrl())
            <img src="{{ $footerIconUrl }}" alt="" aria-hidden="true" />
          @endif
          {{ $aboutSection->footer_emphasis }}
        </strong>
        @if (filled($aboutSection->footer_body))
          {{ ' '.$aboutSection->footer_body }}
        @endif
      </div>
    </div>
  </div>
</section>
@endif
