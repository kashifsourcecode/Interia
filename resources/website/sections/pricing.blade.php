<section id="pricing">
  <div class="pricing-header">
    <h2 class="section-title pricing-title reveal">Simple, Transparent Pricing</h2>
    <p class="pricing-subtitle reveal">
      Scale your IT infrastructure with confidence. We provide enterprise-grade
      managed services with no hidden fees, tailored for growth-oriented organizations.
    </p>
  </div>

  <div class="pricing-grid">
    {{-- CORE --}}
    <div class="pricing-card reveal">
      <div class="pricing-card-inner">
        <div class="pricing-card-head">
          <h3 class="pricing-name">Core</h3>
          <p class="pricing-tag">Basics for small teams</p>
        </div>

        <div class="pricing-price">
          <span class="pricing-currency">$</span>
          <span class="pricing-amount">499</span>
          <span class="pricing-period">/month</span>
        </div>

        <ul class="pricing-features">
          <li><span class="pricing-check" aria-hidden="true"></span>24/7 Monitoring</li>
          <li><span class="pricing-check" aria-hidden="true"></span>Standard Backup (Daily)</li>
          <li><span class="pricing-check" aria-hidden="true"></span>Up to 10 Endpoints</li>
          <li><span class="pricing-check" aria-hidden="true"></span>Next-Day On-Site Support</li>
        </ul>

        <a href="#contact" class="pricing-cta pricing-cta-outline">Select Core</a>
      </div>
    </div>

    {{-- SECURE (popular) --}}
    <div class="pricing-card pricing-card-popular reveal reveal-delay-1">
      <div class="pricing-popular-badge">Most Popular</div>
      <div class="pricing-card-inner">
        <div class="pricing-card-head">
          <h3 class="pricing-name">Secure</h3>
          <p class="pricing-tag">Enhanced protection &amp; support</p>
        </div>

        <div class="pricing-price">
          <span class="pricing-currency">$</span>
          <span class="pricing-amount">1,299</span>
          <span class="pricing-period">/month</span>
        </div>

        <ul class="pricing-features">
          <li><span class="pricing-check" aria-hidden="true"></span>Everything in Core</li>
          <li><span class="pricing-check" aria-hidden="true"></span>Advanced Threat Protection</li>
          <li><span class="pricing-check" aria-hidden="true"></span>Cloud Backup (Real-time)</li>
          <li><span class="pricing-check" aria-hidden="true"></span>4-Hour Response SLA</li>
          <li><span class="pricing-check" aria-hidden="true"></span>Dedicated Account Manager</li>
        </ul>

        <a href="#contact" class="pricing-cta pricing-cta-filled">Start with Secure</a>
      </div>
    </div>

    {{-- PREMIUM --}}
    <div class="pricing-card reveal reveal-delay-2">
      <div class="pricing-card-inner">
        <div class="pricing-card-head">
          <h3 class="pricing-name">Premium</h3>
          <p class="pricing-tag">Full-scale enterprise IT</p>
        </div>

        <div class="pricing-price">
          <span class="pricing-currency">$</span>
          <span class="pricing-amount">3,499</span>
          <span class="pricing-period">/month</span>
        </div>

        <ul class="pricing-features">
          <li><span class="pricing-check" aria-hidden="true"></span>Everything in Secure</li>
          <li><span class="pricing-check" aria-hidden="true"></span>Unlimited Endpoints</li>
          <li><span class="pricing-check" aria-hidden="true"></span>Full Disaster Recovery Plan</li>
          <li><span class="pricing-check" aria-hidden="true"></span>Compliance Management</li>
        </ul>

        <a href="#contact" class="pricing-cta pricing-cta-outline">Talk to Enterprise</a>
      </div>
    </div>
  </div>

  {{-- INFRASTRUCTURE ADD-ONS --}}
  <div class="pricing-addons reveal">
    <div class="pricing-addons-header">
      <h2 class="pricing-title pricing-addons-title">Infrastructure Add-Ons</h2>
      <p class="pricing-subtitle">Specific pricing for servers, cloud environments, and physical locations.</p>
    </div>

    <div class="addons-grid">
      {{-- Server Pricing --}}
      <div class="addon-card reveal">
        <div class="addon-head">
          <span class="addon-icon" aria-hidden="true">
            <img src="{{ asset('images/icon-server-pricing.svg') }}" alt="" />
          </span>
          <h3 class="addon-title">Server Pricing</h3>
        </div>

        <div class="addon-rows">
          <div class="addon-row">
            <span class="addon-row-label">Standard Server</span>
            <span class="addon-row-price">$150<span class="addon-row-unit">/mo</span></span>
          </div>
          <div class="addon-row">
            <span class="addon-row-label">Critical Server</span>
            <span class="addon-row-price">$350<span class="addon-row-unit">/mo</span></span>
          </div>
        </div>

        <p class="addon-desc">Includes patching, backup, and 24/7 uptime monitoring.</p>
      </div>

      {{-- Cloud Pricing --}}
      <div class="addon-card reveal reveal-delay-1">
        <div class="addon-head">
          <span class="addon-icon" aria-hidden="true">
            <img src="{{ asset('images/icon-cloud-pricing.svg') }}" alt="" />
          </span>
          <h3 class="addon-title">Cloud Pricing</h3>
        </div>

        <div class="addon-rows">
          <div class="addon-row">
            <span class="addon-row-label">Per Tenant</span>
            <span class="addon-row-price">$250<span class="addon-row-unit">/mo</span></span>
          </div>
          <div class="addon-row">
            <span class="addon-row-label">Cloud Management</span>
            <span class="addon-row-price">5&ndash;10%<span class="addon-row-unit">/spend</span></span>
          </div>
        </div>

        <p class="addon-desc">Comprehensive management for Azure, AWS, and GCP instances.</p>
      </div>

      {{-- Network/Site --}}
      <div class="addon-card reveal reveal-delay-2">
        <div class="addon-head">
          <span class="addon-icon" aria-hidden="true">
            <img src="{{ asset('images/icon-site.svg') }}" alt="" />
          </span>
          <h3 class="addon-title">Network/Site</h3>
        </div>

        <div class="addon-rows">
          <div class="addon-row">
            <span class="addon-row-label">Per Location</span>
            <span class="addon-row-price">$299<span class="addon-row-unit">/mo</span></span>
          </div>
        </div>

        <p class="addon-desc">Full site management including firewalls, switches, and APs.</p>
      </div>
    </div>
  </div>
</section>
