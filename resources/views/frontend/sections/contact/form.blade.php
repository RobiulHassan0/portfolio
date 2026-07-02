
{{-- Contact Form --}}

        <form id="contact-form" class="contact-form" novalidate>
          <div class="field">
            <input type="text" name="name" placeholder="Your name" autocomplete="name" required />
            <span class="error-msg" data-error="name"></span>
          </div>
          <div class="field">
            <input type="email" name="email" placeholder="Email" autocomplete="email" required />
            <span class="error-msg" data-error="email"></span>
          </div>
          <div class="field">
            <input type="text" name="subject" placeholder="Subject" required />
            <span class="error-msg" data-error="subject"></span>
          </div>
          <div class="field">
            <textarea name="message" placeholder="Message" required></textarea>
            <span class="error-msg" data-error="message"></span>
          </div>
          <button id="contact-submit" type="submit" class="submit">Send message </button>
          <div id="form-status" class="form-status" role="status" aria-live="polite"></div>
        </form>