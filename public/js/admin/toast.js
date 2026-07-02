/* Tiny toast helper. Usage: Toast.show('Saved', 'success'); */
(function () {
  window.Toast = {
    show(msg, type = 'info', timeout = 2400) {
      const root = document.getElementById('toastRoot');
      if (!root) return;
      const el = document.createElement('div');
      el.className = 'toast ' + type;
      el.textContent = msg;
      root.appendChild(el);
      setTimeout(() => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(6px)';
        setTimeout(() => el.remove(), 220);
      }, timeout);
    },
  };
})();