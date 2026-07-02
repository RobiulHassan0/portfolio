<!-- ===================== SKILLS ===================== -->
<section id="skills" class="section reveal-on-scroll">
  <div class="section-head">
    <div class="section-eyebrow"><span style="color:var(--emerald)">02.</span> skills &amp; stack</div>
    <h2>Skills Stack</h2>
    <p>Tools I reach for daily — grouped by where they live in the stack.</p>
    <div class="section-rule"></div>
  </div>

  <div id="skills-grid" class="skills-grid">

    <!-- ===== FRONTEND ===== -->
    <div class="skill-group reveal-up" data-cat="frontend" data-num="01" style="transition-delay: 0.1s">
      <div class="group-head">
        <div class="group-title-wrap">
          <div class="group-dot-title">
            <div class="group-dot"></div>
            <span class="group-title">Frontend</span>
          </div>
          <div class="group-subtitle">// interfaces</div>
        </div>
        <span class="group-badge">{{ count($skills['frontend'] ?? []) }} Skills</span>
      </div>
      <div class="group-divider"></div>

      <div class="skill-cards">
      
        @foreach ($skills['frontend'] ?? [] as $frontend)
        
          <div class="skill-card">
            
            <div class="skill-card-top">
              <div class="skill-icon" data-icon="{{ $frontend->icon }}">
              </div>
              <div class="skill-meta">
                <div class="skill-name">{{ $frontend->name }}</div>
                <div class="skill-desc">{{ $frontend->description }}</div>
              </div>
              <div class="skill-right">
                <div class="skill-pct">{{ $frontend->proficiency }}%</div>
              </div>
            </div>
            <div class="skill-badges">

              <span class="badge badge-{{ strtolower($frontend->level) }}">{{ $frontend->level }}</span>

              @if ($frontend->featured)
                <span class="badge badge-featured">Featured</span>
              @endif

            </div>

            <div class="skill-bar">
              <div class="skill-bar-fill" data-width="{{ $frontend->proficiency }}"></div>
            </div>

          </div>
        @endforeach
      </div>
    </div>

    <!-- ===== BACKEND ===== -->
    <div class="skill-group reveal-up" data-cat="backend" data-num="02" style="transition-delay: 0.3s">
      <div class="group-head">
        <div class="group-title-wrap">
          <div class="group-dot-title">
            <div class="group-dot"></div>
            <span class="group-title">Backend</span>
          </div>
          <div class="group-subtitle">// core stack</div>
        </div>
        <span class="group-badge">{{ count($skills['backend'] ?? []) }} skills</span>
      </div>
      <div class="group-divider"></div>

      <div class="skill-cards">

        <!-- PHP / Laravel -->
        @foreach ($skills['backend'] ?? [] as $backend)
          <div class="skill-card">
            <div class="skill-card-top">
              <div class="skill-icon" data-icon="{{ $backend->icon }}">
              </div>
              <div class="skill-meta">
                <div class="skill-name">{{ $backend->name }}</div>
                <div class="skill-desc">{{ $backend->description }}</div>
              </div>
              <div class="skill-right">
                <div class="skill-pct">{{ $backend->proficiency }}%</div>
              </div>
            </div>
            <div class="skill-badges">
              <span class="badge badge-{{ strtolower($backend->level) }}">{{ $backend->level }}</span>
              @if ( $backend->featured)
                <span class="badge badge-featured">Featured</span>
              @endif
            </div>
            <div class="skill-bar">
              <div class="skill-bar-fill" data-width="{{ $backend->proficiency }}"></div>
            </div>
          </div>
        @endforeach

      </div>
    </div>
  </div>
</section>
