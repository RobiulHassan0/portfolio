  <!-- ===================== PROJECTS ===================== -->
  <section id="projects" class="section reveal-on-scroll">

    <div class="section-head">

      <div class="section-eyebrow"><span style="color:var(--emerald)">01.</span> selected projects</div>
      
      <h2>Selected Projects</h2>

      <p>A few things I've shipped recently. More on request.</p>

      <div class="section-rule"></div>

    </div>

    <div id="projects-grid" class="projects-grid">

      @foreach ($projects as $project)
      
      <article class="project-card">
        <div class="cover" 
        style="background:{{ $project['grad'] }}">

          {{-- <div class="icon-wrap" data-icon="{{ $project['icon'] }}"></div> --}}
            <img src="{{ $project->thumbnail }}" alt="">
        </div>

        <div class="body">
          <div class="row">
            <h3>{{ $project->title }}</h3>
            
            <div class="links">
              <a href="{{ $project->github_url }}" aria-label="GitHub"><span class="github-icon"></span></a>
              <a href="{{ $project->live_url }}" aria-label="Live demo"><span class="live-demo"></span></a>
            </div>
          
          </div>

          <p class="desc">{{ $project->description }}</p>

          <div class="stack">

            @foreach ($project->tech_stack as $tech)
              <span>{{ $tech }}</span>
            @endforeach
            
          </div>

        </div>

      </article>
      @endforeach

    </div>
  </section>