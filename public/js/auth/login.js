(function () {

  // Inject icons
  const slots = document.querySelectorAll('[data-icon]');
  slots.forEach((el) => {
    const name = el.getAttribute('data-icon');
    if (window.Icons[name]) el.insertAdjacentHTML('afterbegin', window.Icons[name]);
  });

  const submitBtn = document.getElementById('login-submit');
  if (submitBtn) submitBtn.insertAdjacentHTML('beforeend', window.Icons.arrowRight);

  const form = document.getElementById('login-form');
  const status = document.getElementById('login-status');
  if (!form) return;

  form.addEventListener('submit', async (e) => {
    e.preventDefault();
    status.textContent = '';
    status.className = 'login-status';

    const data = Object.fromEntries(new FormData(form).entries());
    const email = (data.email || '').trim();
    const password = (data.password || '').trim();

    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
       status.textContent = '✗ Enter a valid email address.';
      status.className = 'login-status error';
      return;
    }
    if (password.length < 5) {
      status.textContent = '✗ Password must be at least 5 characters.';
      status.className = 'login-status error';
      return;
    }

    status.textContent = '✓ Signing in…';
    status.className = 'login-status success';

    if(submitBtn) submitBtn.disabled = true;

    try{
      const response = await fetch('/admin/login', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json'
        },
        body: JSON.stringify({email, password})
      });

      const responseData = await response.json();

      if(response.ok && responseData.success){
        status.textContent = '✓ Login successful! Redirecting…';
        status.className = 'login-status success';

        localStorage.setItem('auth_token', responseData.token);
        localStorage.setItem('user_data', JSON.stringify(responseData.user_data));

        setTimeout(() => { window.location.href = '/dashboard'; }, 1000);

      }else{
        if(responseData.errors && responseData.errors.email){
          status.textContent = `✗ ${responseData.errors.email[0]}`;
        }else{
          status.textContent = `✗ ${responseData.message || 'Invalid email or password.'}`;
        }
        status.className = 'login-status error';
        if(submitBtn) submitBtn.disabled = false; 
      }
    }catch(error){
      console.error('API Error:', error);
      status.textContent = '✗ Something went wrong. Please try again later.';
      status.className = 'login-status error';
      if(submitBtn) submitBtn.disabled = false;
    }
  });
})();
