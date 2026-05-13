<div class="divider"></div>

<!-- FOOTER -->
<footer>
  <div class="footer-logo">
    <img src="{{ asset('images/interia-logo.png') }}" alt="Interia Technologies" />
  </div>
  <p>© {{ date('Y') }} Interia Technologies. Las Vegas, NV. All rights reserved.</p>
  <div class="footer-links">
    <a href="{{ url('/') }}">Home</a>
    @if ($homeSectionNav['services'] ?? false)
      <a href="{{ route('website.section.services') }}">Services</a>
    @endif
    @if ($homeSectionNav['industries'] ?? false)
      <a href="{{ route('website.section.industries') }}">Industries</a>
    @endif
    @if ($homeSectionNav['gallery'] ?? false)
      <a href="{{ route('website.section.gallery') }}">Gallery</a>
    @endif
    @if ($homeSectionNav['about'] ?? false)
      <a href="{{ route('website.section.about') }}">About</a>
    @endif
    @if ($homeSectionNav['contact'] ?? false)
      <a href="{{ route('website.section.contact') }}">Contact</a>
    @endif
    @if ($homeSectionNav['offers'] ?? false)
      <a href="{{ route('website.section.offers') }}">Free Assessments</a>
    @endif
  </div>
</footer>
