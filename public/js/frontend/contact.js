// Contact form (vanilla validation + mailto fallback)
(function () {
  // Inject icons into buttons / socials
  const emailBtn = document.getElementById('contact-email-btn');
  if (emailBtn) emailBtn.insertAdjacentHTML('afterbegin', window.Icons.mail);

  const socials = document.querySelectorAll('[data-icon]');
  socials.forEach((el) => {
    const name = el.getAttribute('data-icon');
    if (window.Icons[name]) el.insertAdjacentHTML('afterbegin', window.Icons[name]);
  });

  const submitBtn = document.getElementById('contact-submit');
  if (submitBtn) submitBtn.insertAdjacentHTML('beforeend', window.Icons.send);

  const form = document.getElementById('contact-form');
  if (!form) return;

  const status = document.getElementById('form-status');
  const fields = ['name', 'email', 'subject', 'message'];

  function setError(name, msg) {
    const el = form.querySelector(`[data-error="${name}"]`);
    if (el) el.textContent = msg || '';
  }
  function clearErrors() { fields.forEach((f) => setError(f, '')); }

  function validate(data) {
    const errors = {};
    if (!data.name || data.name.trim().length < 2) errors.name = 'Please enter your name';
    if (!data.email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(data.email)) errors.email = 'Enter a valid email';
    if (!data.subject || data.subject.trim().length < 2) errors.subject = 'Subject is required';
    if (!data.message || data.message.trim().length < 10) errors.message = 'Message must be at least 10 characters';
    return errors;
  }

  form.addEventListener('submit', (e) => {
    e.preventDefault();
    clearErrors();
    status.textContent = '';
    status.className = 'form-status';

    const data = Object.fromEntries(new FormData(form).entries());
    const errors = validate(data);

    if (Object.keys(errors).length) {
      Object.entries(errors).forEach(([k, v]) => setError(k, v));
      status.textContent = '✗ Please fix the errors above.';
      status.className = 'form-status error';
      return;
    }

    // Open user's email client with prefilled content (purely static — no backend)
    const to = 'hello@alexcarter.dev';
    const subject = encodeURIComponent(`[Portfolio] ${data.subject}`);
    const body = encodeURIComponent(`${data.message}\n\n— ${data.name}\n${data.email}`);
    window.location.href = `mailto:${to}?subject=${subject}&body=${body}`;

    status.textContent = '✓ Opening your email client…';
    status.className = 'form-status success';
    form.reset();
  });
})();
