<section id="enterprise-quote">
  <div class="eq-bg" aria-hidden="true">
    <div class="eq-orb eq-orb-1"></div>
    <div class="eq-orb eq-orb-2"></div>
    <div class="eq-grid"></div>
  </div>

  <div class="eq-header reveal">
    <div class="section-label">Enterprise</div>
    <h2 class="section-title">Get Your Enterprise<br />IT Quote</h2>
    <p class="section-desc">
      For organizations that need custom pricing — multi-site networks, unlimited endpoints,
      compliance, and dedicated SLAs. Tell us about your business and a senior engineer will
      reach out within one business day with a tailored proposal.
    </p>
  </div>

  <div class="eq-layout">
    <form class="eq-form reveal reveal-delay-1"
          method="POST"
          action="{{ route('enterprise-quote.store') }}"
          onsubmit="handleEnterpriseQuoteSubmit(event)"
          novalidate>
      @csrf

      <div class="eq-form-feedback" role="status" aria-live="polite" hidden></div>

      <div class="eq-fieldset">
        <div class="eq-fieldset-head">
          <span class="eq-fieldset-num">01</span>
          <h4>Your contact</h4>
        </div>
        <div class="form-row eq-form-row-4">
          <div class="form-group">
            <label>First Name *</label>
            <input type="text" name="first_name" placeholder="Jane" required />
          </div>
          <div class="form-group">
            <label>Last Name *</label>
            <input type="text" name="last_name" placeholder="Doe" required />
          </div>
          <div class="form-group">
            <label>Business Email *</label>
            <input type="email" name="email" placeholder="jane@@company.com" required />
          </div>
          <div class="form-group">
            <label>Phone Number</label>
            <input type="tel" name="phone" placeholder="(702) 555-0000" />
          </div>
        </div>
        <div class="form-group">
          <label>Job Title</label>
          <input type="text" name="job_title" placeholder="CIO, IT Director, Operations Manager…" />
        </div>
      </div>

      <div class="eq-fieldset">
        <div class="eq-fieldset-head">
          <span class="eq-fieldset-num">02</span>
          <h4>Your company</h4>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label>Company Name *</label>
            <input type="text" name="company" placeholder="Acme Hospitality Group" required />
          </div>
          <div class="form-group">
            <label>Website</label>
            <input type="text" name="website" placeholder="https://acme.com" />
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label>Industry</label>
            <select name="industry">
              <option value="">Select industry…</option>
              <option>Healthcare</option>
              <option>Hospitality / Casino</option>
              <option>Legal &amp; Professional Services</option>
              <option>Finance / Insurance</option>
              <option>Retail / E-commerce</option>
              <option>Construction / Real Estate</option>
              <option>Manufacturing / Logistics</option>
              <option>Education</option>
              <option>Non-profit / Government</option>
              <option>Technology / SaaS</option>
              <option>Other</option>
            </select>
          </div>
          <div class="form-group">
            <label>Current IT Setup</label>
            <select name="current_it_setup">
              <option value="">Select…</option>
              <option>In-house IT team</option>
              <option>Existing MSP / IT partner</option>
              <option>Hybrid (in-house + outsourced)</option>
              <option>No formal IT (looking to start)</option>
            </select>
          </div>
        </div>
        <div class="form-row eq-form-row-3">
          <div class="form-group">
            <label>Employees</label>
            <select name="employee_count">
              <option value="">Size…</option>
              <option>1–25</option>
              <option>26–100</option>
              <option>101–250</option>
              <option>251–500</option>
              <option>501–1,000</option>
              <option>1,000+</option>
            </select>
          </div>
          <div class="form-group">
            <label>Endpoints / Devices</label>
            <select name="endpoint_count">
              <option value="">Count…</option>
              <option>Under 25</option>
              <option>25–100</option>
              <option>100–250</option>
              <option>250–500</option>
              <option>500–1,000</option>
              <option>1,000+</option>
            </select>
          </div>
          <div class="form-group">
            <label>Locations / Sites</label>
            <select name="location_count">
              <option value="">Sites…</option>
              <option>1</option>
              <option>2–3</option>
              <option>4–10</option>
              <option>10+</option>
            </select>
          </div>
        </div>
      </div>

      <div class="eq-fieldset">
        <div class="eq-fieldset-head">
          <span class="eq-fieldset-num">03</span>
          <h4>What you need</h4>
        </div>

        <div class="form-group">
          <label>Services Needed <span class="eq-label-hint">(select all that apply)</span></label>
          <div class="eq-chip-grid">
            @foreach ([
              'Managed IT (24/7)',
              'Cybersecurity / SOC',
              'Cloud &amp; Server Management',
              'Onsite + Remote Support',
              'Disaster Recovery / BCDR',
              'Compliance Management',
              'AI Adoption / Automation',
              'Network &amp; Infrastructure',
              'VoIP / Communications',
              'IT Strategy / vCIO',
            ] as $service)
              <label class="eq-chip">
                <input type="checkbox" name="services_needed[]" value="{!! $service !!}" />
                <span>{!! $service !!}</span>
              </label>
            @endforeach
          </div>
        </div>

        <div class="form-group">
          <label>Cloud Platforms in Use <span class="eq-label-hint">(optional)</span></label>
          <div class="eq-chip-grid eq-chip-grid-compact">
            @foreach ([
              'Microsoft 365',
              'Google Workspace',
              'Azure',
              'AWS',
              'Google Cloud (GCP)',
              'On-Prem Servers',
            ] as $platform)
              <label class="eq-chip">
                <input type="checkbox" name="cloud_platforms[]" value="{{ $platform }}" />
                <span>{{ $platform }}</span>
              </label>
            @endforeach
          </div>
        </div>

        <div class="form-group">
          <label>Compliance Requirements <span class="eq-label-hint">(optional)</span></label>
          <div class="eq-chip-grid eq-chip-grid-compact">
            @foreach ([
              'HIPAA',
              'PCI-DSS',
              'SOC 2',
              'CMMC / DFARS',
              'GDPR',
              'NIST 800-171',
              'None / Not sure',
            ] as $compliance)
              <label class="eq-chip">
                <input type="checkbox" name="compliance_needs[]" value="{{ $compliance }}" />
                <span>{{ $compliance }}</span>
              </label>
            @endforeach
          </div>
        </div>
      </div>

      <div class="eq-fieldset">
        <div class="eq-fieldset-head">
          <span class="eq-fieldset-num">04</span>
          <h4>Budget &amp; timeline</h4>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label>Monthly Budget Range</label>
            <select name="budget_range">
              <option value="">Select range…</option>
              <option>Under $2,500 / mo</option>
              <option>$2,500 – $5,000 / mo</option>
              <option>$5,000 – $10,000 / mo</option>
              <option>$10,000 – $25,000 / mo</option>
              <option>$25,000+ / mo</option>
              <option>Need help estimating</option>
            </select>
          </div>
          <div class="form-group">
            <label>When do you need to start?</label>
            <select name="timeline">
              <option value="">Select timeline…</option>
              <option>ASAP — within 2 weeks</option>
              <option>Within 1 month</option>
              <option>1–3 months</option>
              <option>3–6 months</option>
              <option>Just exploring</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label>Preferred Contact Method</label>
          <div class="eq-radio-row">
            <label class="eq-radio">
              <input type="radio" name="preferred_contact" value="Email" checked />
              <span>Email</span>
            </label>
            <label class="eq-radio">
              <input type="radio" name="preferred_contact" value="Phone" />
              <span>Phone call</span>
            </label>
            <label class="eq-radio">
              <input type="radio" name="preferred_contact" value="Video" />
              <span>Video meeting</span>
            </label>
          </div>
        </div>
        <div class="form-group">
          <label>Anything else we should know?</label>
          <textarea name="details" placeholder="Tell us about current challenges, key projects, pain points, or specific requirements…"></textarea>
        </div>
      </div>

      <div class="eq-form-footer">
        <p class="eq-form-fineprint">
          <span class="eq-lock" aria-hidden="true">
            <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <rect x="4" y="11" width="16" height="10" rx="2"/>
              <path d="M8 11V7a4 4 0 1 1 8 0v4"/>
            </svg>
          </span>
          Your information is private. We never share details outside the Interia team.
        </p>
        <button type="submit" class="form-submit eq-submit">
          Get My Enterprise Quote →
        </button>
      </div>
    </form>
  </div>
</section>
