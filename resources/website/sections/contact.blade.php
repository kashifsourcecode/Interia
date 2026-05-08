<section id="contact">
    <div class="section-label reveal">Get In Touch</div>
    <h2 class="section-title reveal">Let's Talk<br />About Your IT</h2>
    <p class="section-desc reveal">Ready to take IT off your plate? Fill out the form and one of our Las Vegas-based
        experts will reach out within one business day.</p>

    <div class="contact-layout">
        <div class="contact-info">
            <div class="contact-block reveal">
                <div class="cb-icon">
                    <img src="{{ asset('images/icon-location.svg') }}" alt="" aria-hidden="true" />
                </div>
                <div>
                    <h5>Location</h5>
                    <p>Las Vegas, Nevada</p>
                </div>
            </div>
            <div class="contact-block reveal reveal-delay-1">
                <div class="cb-icon">
                    <img src="{{ asset('images/icon-phone.svg') }}" alt="" aria-hidden="true" />
                </div>
                <div>
                    <h5>Phone</h5>
                    <p>(702) 279 - 6711</p>
                </div> 
            </div>
            <div class="contact-block reveal reveal-delay-2">
                <div class="cb-icon">
                    <img src="{{ asset('images/icon-email.svg') }}" alt="" aria-hidden="true" />
                </div>
                <div>
                    <h5>Email</h5>
                    <p>info@interiatechnologies.com</p>
                </div>
            </div>
            <div class="contact-block reveal reveal-delay-3">
                <div class="cb-icon">
                    <img src="{{ asset('images/icon-time.svg') }}" alt="" aria-hidden="true" />
                </div>
                <div>
                    <h5>Response Time</h5>
                    <p>Within 15 minutes during business hours</p>
                </div>
            </div>
            <div class="contact-block reveal reveal-delay-4">
                <div class="cb-icon">
                    <img src="{{ asset('images/icon-handshake.svg') }}" alt="" aria-hidden="true" />
                </div>
                <div>
                    <h5>Onsite Support</h5>
                    <p>Available across the greater Las Vegas Valley — included at no extra cost</p>
                </div>
            </div>
        </div>

        <form class="contact-form reveal" onsubmit="handleSubmit(event)">
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
