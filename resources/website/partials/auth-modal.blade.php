<!-- AUTH MODAL -->
<div class="auth-overlay" id="authOverlay" onclick="overlayClick(event)">
  <div class="auth-modal" id="authModal">
    <div class="auth-modal-bar"></div>
    <button class="auth-close" onclick="closeModal()" title="Close">✕</button>
    <div class="auth-modal-inner">

      <div class="auth-logo">INTERIA<span>.</span></div>
      <p class="auth-tagline">Secure Client Portal — Las Vegas IT Management</p>

      <div class="auth-tabs">
        <div class="auth-tab-slider" id="tabSlider"></div>
        <button class="auth-tab-btn active" id="tabLogin" onclick="switchTab('login')">Log In</button>
        <button class="auth-tab-btn" id="tabSignup" onclick="switchTab('signup')">Sign Up</button>
      </div>

      <!-- LOGIN -->
      <div class="auth-panel active" id="panelLogin">
        <div class="auth-socials">
          <a href="#" class="social-btn">
            <svg viewBox="0 0 24 24" fill="none"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z" fill="#FBBC05"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/></svg>
            Google
          </a>
          <a href="#" class="social-btn">
            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M20.317 4.37a19.791 19.791 0 0 0-4.885-1.515.074.074 0 0 0-.079.037c-.21.375-.444.864-.608 1.25a18.27 18.27 0 0 0-5.487 0 12.64 12.64 0 0 0-.617-1.25.077.077 0 0 0-.079-.037A19.736 19.736 0 0 0 3.677 4.37a.07.07 0 0 0-.032.027C.533 9.046-.32 13.58.099 18.057c.002.022.015.043.033.054a19.9 19.9 0 0 0 5.993 3.03.079.079 0 0 0 .085-.026c.462-.63.874-1.295 1.226-1.994a.076.076 0 0 0-.041-.106 13.107 13.107 0 0 1-1.872-.892.077.077 0 0 1-.008-.128 10.2 10.2 0 0 0 .372-.292.074.074 0 0 1 .077-.01c3.928 1.793 8.18 1.793 12.062 0a.074.074 0 0 1 .078.01c.12.098.246.198.373.292a.077.077 0 0 1-.006.127 12.299 12.299 0 0 1-1.873.892.077.077 0 0 0-.041.107c.36.698.772 1.362 1.225 1.993a.076.076 0 0 0 .084.028 19.839 19.839 0 0 0 6.002-3.03.077.077 0 0 0 .032-.054c.5-5.177-.838-9.674-3.549-13.66a.061.061 0 0 0-.031-.03z"/></svg>
            Microsoft
          </a>
        </div>
        <div class="auth-divider">or continue with email</div>
        <div class="auth-field">
          <label>Email Address</label>
          <div class="auth-input-wrap">
            <input type="email" id="loginEmail" placeholder="you@@company.com" autocomplete="email"/>
            <span class="auth-input-icon">✉️</span>
          </div>
        </div>
        <div class="auth-field">
          <label>Password</label>
          <div class="auth-input-wrap">
            <input type="password" id="loginPw" placeholder="••••••••" autocomplete="current-password"/>
            <span class="auth-input-icon">🔐</span>
            <button type="button" class="pw-toggle" onclick="togglePw('loginPw',this)">👁</button>
          </div>
        </div>
        <a href="#" class="auth-forgot">Forgot your password?</a>
        <button class="auth-submit" onclick="handleLogin()">Sign In to Portal →</button>
        <p class="auth-switch">Don't have an account? <a href="#" onclick="switchTab('signup');return false;">Create one free</a></p>
      </div>

      <!-- SIGNUP -->
      <div class="auth-panel" id="panelSignup">
        <div class="auth-socials">
          <a href="#" class="social-btn">
            <svg viewBox="0 0 24 24" fill="none"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z" fill="#FBBC05"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/></svg>
            Google
          </a>
          <a href="#" class="social-btn">
            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M20.317 4.37a19.791 19.791 0 0 0-4.885-1.515.074.074 0 0 0-.079.037c-.21.375-.444.864-.608 1.25a18.27 18.27 0 0 0-5.487 0 12.64 12.64 0 0 0-.617-1.25.077.077 0 0 0-.079-.037A19.736 19.736 0 0 0 3.677 4.37a.07.07 0 0 0-.032.027C.533 9.046-.32 13.58.099 18.057c.002.022.015.043.033.054a19.9 19.9 0 0 0 5.993 3.03.079.079 0 0 0 .085-.026c.462-.63.874-1.295 1.226-1.994a.076.076 0 0 0-.041-.106 13.107 13.107 0 0 1-1.872-.892.077.077 0 0 1-.008-.128 10.2 10.2 0 0 0 .372-.292.074.074 0 0 1 .077-.01c3.928 1.793 8.18 1.793 12.062 0a.074.074 0 0 1 .078.01c.12.098.246.198.373.292a.077.077 0 0 1-.006.127 12.299 12.299 0 0 1-1.873.892.077.077 0 0 0-.041.107c.36.698.772 1.362 1.225 1.993a.076.076 0 0 0 .084.028 19.839 19.839 0 0 0 6.002-3.03.077.077 0 0 0 .032-.054c.5-5.177-.838-9.674-3.549-13.66a.061.061 0 0 0-.031-.03z"/></svg>
            Microsoft
          </a>
        </div>
        <div class="auth-divider">or create with email</div>
        <div class="auth-name-row">
          <div class="auth-field">
            <label>First Name</label>
            <div class="auth-input-wrap">
              <input type="text" placeholder="John" autocomplete="given-name"/>
              <span class="auth-input-icon">👤</span>
            </div>
          </div>
          <div class="auth-field">
            <label>Last Name</label>
            <div class="auth-input-wrap">
              <input type="text" placeholder="Smith" autocomplete="family-name"/>
              <span class="auth-input-icon">👤</span>
            </div>
          </div>
        </div>
        <div class="auth-field">
          <label>Business Email</label>
          <div class="auth-input-wrap">
            <input type="email" placeholder="you@@company.com" autocomplete="email"/>
            <span class="auth-input-icon">✉️</span>
          </div>
        </div>
        <div class="auth-field">
          <label>Company Name</label>
          <div class="auth-input-wrap">
            <input type="text" placeholder="Your Company LLC" autocomplete="organization"/>
            <span class="auth-input-icon">🏢</span>
          </div>
        </div>
        <div class="auth-field">
          <label>Password</label>
          <div class="auth-input-wrap">
            <input type="password" id="signupPw" placeholder="Create a strong password" autocomplete="new-password" oninput="checkStrength(this)"/>
            <span class="auth-input-icon">🔐</span>
            <button type="button" class="pw-toggle" onclick="togglePw('signupPw',this)">👁</button>
          </div>
          <div class="pw-strength-wrap" id="strengthWrap">
            <div class="pw-strength-bar"><div class="pw-strength-fill" id="strengthFill"></div></div>
            <span class="pw-strength-text" id="strengthText">Enter a password</span>
          </div>
        </div>
        <label class="auth-check">
          <input type="checkbox" required/>
          I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>
        </label>
        <button class="auth-submit" onclick="handleSignup()">Create My Account →</button>
        <p class="auth-switch">Already have an account? <a href="#" onclick="switchTab('login');return false;">Sign in</a></p>
      </div>

    </div>
  </div>
</div>
