@if ($gallerySection)
    <section id="gallery" aria-label="Our people make the difference">
        <div class="gallery-mosaic-wrap reveal" id="mosaicWrap">
            <div class="gallery-mosaic mosaic-hidden" id="galleryMosaic">
                @foreach ($gallerySection->orderedGalleryItems() as $item)
                    <div class="{{ $item->mosaicCssClasses() }}">
                        <img src="{{ $item->resolvedImageUrl() }}" alt="{{ $item->image_alt ?? '' }}" loading="lazy" />
                    </div>
                @endforeach

                @if (filled($gallerySection->headline_line_1) || filled($gallerySection->headline_line_2))
                    <div class="gallery-bg-text" aria-hidden="true">
                        @if (filled($gallerySection->headline_line_1))
                            <span>{{ $gallerySection->headline_line_1 }}</span>
                        @endif
                        @if (filled($gallerySection->headline_line_2))
                            <span>{{ $gallerySection->headline_line_2 }}</span>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </section>
@endif
