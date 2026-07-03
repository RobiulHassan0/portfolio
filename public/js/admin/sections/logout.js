
(function() {
    const token = localStorage.getItem('auth_token') || sessionStorage.getItem('auth_token');
    if (!token) {
        window.location.href = '/admin/login'; 
        return;
    }

    const logoutBtn = document.getElementById('logoutBtn');
    if (logoutBtn) {
        logoutBtn.addEventListener('click', async (e) => {
            e.preventDefault();
            
            if(!confirm('Are you sure you want to logout?')) return;

            try {
                logoutBtn.disabled = true;
                
                const response = await fetch('/api/logout', {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': `Bearer ${token}` 
                    }
                });

                localStorage.removeItem('auth_token');
                localStorage.removeItem('user_data');
                sessionStorage.removeItem('auth_token');
                sessionStorage.removeItem('user_data');

                window.location.href = '/admin/login';

            } catch (error) {
                console.error('Logout error:', error);
                alert('Failed to logout cleanly, forcing logout...');
                
                localStorage.clear();
                sessionStorage.clear();
                window.location.href = '/admin/login';
            }
        });
    }
})();