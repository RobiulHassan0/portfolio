<!-- ============ OVERVIEW ============ -->

<section class="section-page is-active" data-section="overview">
  <div class="panel mb-12" >
    <div class="panel-head">
      <h3>Welcome</h3>
    </div>
    <div class="panel-body">
      <p class="text-sm text-muted-foreground" style="margin:0">
        Manage your portfolio content from this dashboard. Each section's
        form posts to a Laravel route — replace <code>action="#"</code>
        with the matching <code></code> in your Blade view.
      </p>
    </div>
  </div>

  <div class="stats-grid grid md:grid-cols-2 lg:grid-cols-4 mb-12">
    <div class="stat-card">
      <div class="stat-label">Projects</div>
      <div class="stat-value" data-stat="projects">{{ $projects->count() ?? 0 }}</div>
    </div>
    <div class="stat-card">
      <div class="stat-label">Services</div>
      <div class="stat-value" data-stat="services">{{ $services->count() ?? 0 }}</div>
    </div>
    <div class="stat-card">
      <div class="stat-label">Skills</div>
      <div class="stat-value" data-stat="skills">{{ $stats['total'] ?? 0 }}</div>
    </div>
    <div class="stat-card">
      <div class="stat-label">Last saved</div>
      <div class="stat-value text-base">{{ $lastSaved?->diffForHumans() ?? 'Never' }}</div>
    </div>
  </div>

  <div class="mt-6 mb-12 grid gap-5 lg:grid-cols-2">
    <div class="panel">
      <div class="panel-head">
        <h3>Quick actions</h3>
      </div>
      <div class="panel-body flex flex-wrap gap-2">
        <button type="button" class="btn btn-primary" data-go="projects">+ New Project</button>
        <button type="button" class="btn btn-outline" data-go="services">+ New Service</button>
        <button type="button" class="btn btn-outline" data-go="skills">+ New Skill</button>
        <button type="button" class="btn btn-ghost" data-go="settings">Edit Hero / Contact</button>
      </div>
    </div>
  </div>
</section>