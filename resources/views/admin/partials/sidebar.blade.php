<!-- ============ SIDEBAR ============ -->
<aside id="sidebar" class="sidebar">
    <div class="sidebar-brand">
        <div class="brand-mark">A</div>
        <div>
            <div class="brand-title">Admin Panel</div>
            <div class="brand-sub">Portfolio Control</div>
        </div>
    </div>

    <nav class="sidebar-nav" id="sidebarNav">
        <button type="button" class="nav-item active" data-section="overview">
            <span class="nav-ico">▦</span>
            <span>Overview</span>
        </button>

        <button type="button" class="nav-item" data-section="projects">
            <span class="nav-ico">◉</span>
            <span>Projects</span>
        </button>

        <button type="button" class="nav-item" data-section="services">
            <span class="nav-ico">✦</span>
            <span>Services</span>
        </button>

        <button type="button" class="nav-item" data-section="skills">
            <span class="nav-ico">▲</span>
            <span>Skills</span>
        </button>

        <button type="button" class="nav-item" data-section="settings">
            <span class="nav-ico">⚙</span>
            <span>Site Settings</span>
        </button>

    </nav>

    <div class="sidebar-foot">
        <a href="{{ route('home') }}" class="foot-link" target="_blank">↗ View site</a>
        <button type="button" id="logoutBtn" class="foot-link danger">⎋ Logout</button>
    </div>
</aside>