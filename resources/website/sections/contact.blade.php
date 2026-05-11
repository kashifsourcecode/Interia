<section id="contact">
    @if ($contactSection)
        <div class="section-label reveal">{{ $contactSection->label }}</div>
        <h2 class="section-title reveal">{!! nl2br(e($contactSection->title)) !!}</h2>
        @if (filled($contactSection->subtitle))
            <p class="section-desc reveal">{{ $contactSection->subtitle }}</p>
        @endif
    @endif

    @php($hasInfoCards = $contactSection && $contactSection->infoCards->isNotEmpty())
    <div class="contact-layout{{ $hasInfoCards ? '' : ' contact-layout--single' }}">
        @if ($hasInfoCards)
            <div class="contact-info">
                @foreach ($contactSection->infoCards as $card)
                    @php($delaySuffix = $loop->index > 0 ? ' reveal-delay-'.min($loop->index, 4) : '')
                    <div class="contact-block reveal{{ $delaySuffix }}">
                        <div class="cb-icon">
                            @if ($iconUrl = $card->resolvedIconUrl())
                                <img src="{{ $iconUrl }}" alt="" aria-hidden="true" />
                            @endif
                        </div>
                        <div>
                            <h5>{{ $card->heading }}</h5>
                            <p>{{ $card->body }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <form class="contact-form reveal" method="POST" action="{{ route('contact.store') }}" onsubmit="handleSubmit(event)" novalidate>
            @csrf
            <div class="contact-form-feedback" role="status" aria-live="polite" hidden></div>
            <div class="form-row">
                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" name="first_name" placeholder="John" required />
                </div>
                <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" name="last_name" placeholder="Smith" required />
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Business Email</label>
                    <input type="email" name="email" placeholder="john@@company.com" required />
                </div>
                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="tel" name="phone" placeholder="(702) 555-0000" />
                </div>
            </div>
            <div class="form-group">
                <label>Company Name</label>
                <input type="text" name="company" placeholder="Your Business Name" />
            </div>
            <div class="form-group">
                <label>How Can We Help?</label>
                <select name="service">
                    <option value="">Select a service...</option>
                    <option>Free IT Assessment</option>
                    <option>Free AI Workshop</option>
                    <option>Managed IT Services</option>
                    <option>Cloud & Server Management</option>
                    <option>Cybersecurity</option>
                    <option>Onsite + Remote Support</option>
                    <option>General Inquiry</option>
                </select>
            </div>
            <div class="form-group">
                <label>Tell Us About Your Business</label>
                <textarea name="message"
                    placeholder="Briefly describe your current IT setup, biggest challenges, or what you'd like to improve..."></textarea>
            </div>
            <button type="submit" class="form-submit">Send Message →</button>
        </form>
    </div>
</section>
