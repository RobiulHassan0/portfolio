/* Admin UI interactions — no SPA routing, no template rendering.
   - Toggles sidebar on mobile
   - Switches visible <section class="section-page"> via sidebar buttons
     (URL hash is updated so reload keeps the section).
   - Wires range slider live value, image-path preview, and demo flash messages.
   This is browser-side polish only. All real CRUD will be handled by Blade
   forms posting to your Laravel routes.
*/



(function () {
    // ---------- Section switching (in-page, not SPA) ----------
    const titleMap = {
        overview: '<span class="eyebrow">Dashboard · Overview</span>',
        settings: '<span class="eyebrow">Configuration · Site Settings</span>',
        projects: '<span class="eyebrow">Portfolio · Projects</span>',
        services: '<span class="eyebrow">Business ·  Service Management</span>',
        skills: '<span class="eyebrow">Expertise · Control panel</span>',
    };

    function showSection(name) {
        if (!titleMap[name]) name = 'overview';
        
        // if (name === 'overview') {
        //     loadOverViewStats?.();
        // }

        if (name === 'settings') {
            loadContact?.();
        }

        document.querySelectorAll('.section-page').forEach(s => {
            s.classList.toggle('is-active', s.dataset.section === name);
        });
        document.querySelectorAll('.nav-item').forEach(b => {
            b.classList.toggle('active', b.dataset.section === name);
        });

        const title = document.getElementById('pageTitle');
        if (title) title.innerHTML = titleMap[name];
        
        if (location.hash !== '#' + name) history.replaceState(null, '', '#' + name);

        closeSidebar();
        window.scrollTo({
            top: 0
        });
    }

    document.getElementById('sidebarNav')?.addEventListener('click', (e) => {
        const b = e.target.closest('.nav-item');
        if (!b) return;
        showSection(b.dataset.section);
    });

    // Quick-action buttons on Overview ("+ New Project" etc.)
    document.querySelectorAll('[data-go]').forEach(b => {
        b.addEventListener('click', () => showSection(b.dataset.go));
    });

    // ---------- Mobile sidebar ----------
    const sidebar = document.getElementById('sidebar');
    const toggle = document.getElementById('toggleSidebar');
    let backdrop;

    function openSidebar() {
        if (!sidebar) return;
        sidebar.classList.add('open');
        backdrop = document.createElement('div');
        backdrop.className = 'sidebar-backdrop show';
        backdrop.addEventListener('click', closeSidebar);
        document.body.appendChild(backdrop);
    }

    function closeSidebar() {
        if (!sidebar) return;
        sidebar.classList.remove('open');
        if (backdrop) {
            backdrop.remove();
            backdrop = null;
        }
    }
    toggle?.addEventListener('click', () => {
        sidebar.classList.contains('open') ? closeSidebar() : openSidebar();
    });

    // ---------- Range slider live value ----------
    document.querySelectorAll('input[type=range][data-range]').forEach(input => {
        const out = input.parentElement.querySelector('.val');
        if (!out) return;
        const update = () => out.textContent = input.value + '%';
        input.addEventListener('input', update);
        update();
    });

    // ---------- Image path preview ----------
    document.querySelectorAll('input[data-preview-target]').forEach(input => {
        const target = document.getElementById(input.dataset.previewTarget);
        if (!target) return;
        const render = () => {
            const v = input.value.trim();
            if (!v) {
                target.innerHTML = '<span class="empty">No image — paste a path above</span>';
                return;
            }
            target.innerHTML =
                '<img src="' + v + '" alt="" onerror="this.replaceWith(Object.assign(document.createElement(\'span\'),{className:\'empty\',textContent:\'Image not found at this path\'}))" />' +
                '<div class="text-xs text-muted-foreground">' + v + '</div>';
        };
        let timer;

        input.addEventListener('input', () => {
            clearTimeout(timer);

            timer = setTimeout(() => {
                render();
            }, 400); 
        });

render();

        
    });

    // ---------- Initial section from URL hash ----------
    const initial = (location.hash || '#overview').slice(1);
    showSection(initial);

})();

// --------- Modal form input handling ----------
window.esc = function(str) {
    if (!str) return '';
    return (str + "").replace(/[&<>'"]/g, 
        tag => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', "'": '&#39;', '"': '&quot;' }[tag] || tag)
    );
}

