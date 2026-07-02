{{-- Contact Information --}}
<div>
  <p class="contact-eyebrow">// let's build something</p>
  <h3 class="contact-title">{{ $contact?->title }}</h3>
  <p class="contact-desc">{{ $contact?->description }}</p>

  <a id="contact-email-btn" href="mailto:{{ $contact?->primary_email }}" target="_blank" rel="noopener noreferrer"
    class="contact-email-btn">
    {{ $contact?->primary_email }}
  </a>

  <div class="contact-socials">
    <a href="mailto:{{ $contact?->primary_email }}" target="_blank" rel="noopener noreferrer" data-icon="mail">
      {{ $contact?->primary_email }}
    </a>

    <a href="{{ $contact?->social_links['github'] }}" target="_blank" rel="noopener noreferrer" data-icon="github">
      github.com/RobiulHassan0
    </a>

    <a href="{{ $contact?->social_links['linkedin'] }}" target="_blank" rel="noopener noreferrer" data-icon="linkedin">
      linkedin.com/in/RobiulHassan0
    </a>

    <a href="{{ $contact?->social_links['whatsapp'] }}" target="_blank" rel="noopener noreferrer"
      data-icon="whatsapp">
      WhatsApp
    </a>
  </div>
</div>