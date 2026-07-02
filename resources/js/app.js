
    document.getElementById('year').textContent = new Date().getFullYear();

    // Projects
    const projects = [
      { title:"LedgerOps", desc:"Multi-tenant accounting platform for SMBs with audit trails, role-based permissions and real-time reporting.", stack:["Laravel","Vue","MySQL","Redis"], glyph:"{ }", grad:"linear-gradient(135deg, rgba(59,130,246,.3), rgba(16,185,129,.2))" },
      { title:"API Gateway Kit", desc:"Open-source rate-limited API gateway with token introspection, caching layer and webhook fan-out.", stack:["PHP","Laravel","Docker","Redis"], glyph:"</>", grad:"linear-gradient(135deg, rgba(16,185,129,.3), rgba(59,130,246,.2))" },
      { title:"ShelfSync", desc:"Inventory & POS dashboard for boutique retailers — offline-first, barcode scanner ready.", stack:["Laravel","Livewire","Tailwind"], glyph:"▤", grad:"linear-gradient(135deg, rgba(251,191,36,.2), rgba(59,130,246,.2))" },
      { title:"DevPulse", desc:"Self-hosted observability dashboard surfacing app errors, slow queries, and queue health at a glance.", stack:["Laravel","TypeScript","PostgreSQL"], glyph:"▰▰▱", grad:"linear-gradient(135deg, rgba(59,130,246,.3), rgba(168,85,247,.2))" },
    ];
    document.getElementById('projects-grid').innerHTML = projects.map(p => `
      <article class="group relative rounded-xl border border-border bg-card/40 overflow-hidden hover:-translate-y-1 hover:border-primary/40 transition-all duration-300">
        <div class="relative h-44 overflow-hidden flex items-center justify-center" style="background:${p.grad}">
          <div class="absolute inset-0 bg-grid opacity-50"></div>
          <span class="relative font-mono text-6xl text-foreground/80 group-hover:scale-110 transition-transform duration-500">${p.glyph}</span>
        </div>
        <div class="p-6">
          <div class="flex items-start justify-between gap-4">
            <h3 class="text-xl font-semibold">${p.title}</h3>
            <div class="flex gap-2 text-muted-foreground">
              <a href="#" aria-label="GitHub" class="hover:text-foreground transition">⌥</a>
              <a href="#" aria-label="Live demo" class="hover:text-primary transition">↗</a>
            </div>
          </div>
          <p class="mt-2 text-sm text-muted-foreground leading-relaxed">${p.desc}</p>
          <div class="mt-4 flex flex-wrap gap-2">
            ${p.stack.map(s => `<span class="inline-flex items-center justify-center px-2.5 h-8 rounded-md border border-border bg-card/60 hover:border-primary/40 hover:bg-primary/5 transition font-mono text-xs text-muted-foreground">${s}</span>`).join('')}
          </div>
        </div>
      </article>
    `).join('');

    // Skills
    const skills = ["Laravel","PHP","MySQL","PostgreSQL","JavaScript","TypeScript","Tailwind CSS","Vue.js","React","REST API","GraphQL","Redis","Docker","Git","Linux","AWS"];
    document.getElementById('skills-grid').innerHTML = skills.map(s => `
      <span class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-border bg-card/50 font-mono text-sm text-muted-foreground hover:text-foreground hover:border-primary/50 hover:bg-primary/5 transition cursor-default">
        <span class="w-2 h-2 rounded-full bg-primary"></span>${s}
      </span>`).join('');

    // Services
    const services = [
      { icon:"⌘", title:"Web App Development", desc:"End-to-end Laravel applications — from spec and schema design to deployment and monitoring.", bullets:["Laravel · Livewire · Inertia","Auth, billing, multi-tenancy","CI/CD ready"] },
      { icon:"⚙", title:"Backend & APIs", desc:"REST and GraphQL APIs designed to scale, stay readable, and not wake you up at 3 AM.", bullets:["REST · GraphQL · Webhooks","Queues, jobs & schedulers","Versioned & documented"] },
      { icon:"▦", title:"Admin Dashboards", desc:"Internal tools that operations teams actually want to open — fast, focused, role-aware.", bullets:["Filament · custom panels","Reports & exports","Role & permission systems"] },
      { icon:"🔧", title:"Optimization & Fixes", desc:"Slow queries, leaky abstractions, gnarly legacy bugs — diagnosed and quietly fixed.", bullets:["DB & query tuning","Refactors & code audits","Performance profiling"] },
    ];
    document.getElementById('services-grid').innerHTML = services.map((s, i) => `
      <div class="group relative p-6 rounded-xl border border-border bg-card/40 hover:bg-card hover:border-primary/40 hover:-translate-y-1 transition-all duration-300 overflow-hidden">
        <div class="pointer-events-none absolute -top-16 -right-16 w-48 h-48 rounded-full blur-3xl opacity-60 group-hover:opacity-100 transition" style="background: linear-gradient(135deg, rgba(59,130,246,.3), rgba(59,130,246,.05))"></div>
        <div class="relative flex items-start justify-between mb-5">
          <div class="w-11 h-11 rounded-lg bg-primary/10 border border-primary/20 flex items-center justify-center group-hover:bg-primary/20 transition text-primary text-lg">${s.icon}</div>
          <span class="font-mono text-xs text-muted-foreground">0${i+1}</span>
        </div>
        <h3 class="relative font-semibold text-lg mb-2">${s.title}</h3>
        <p class="relative text-sm text-muted-foreground leading-relaxed">${s.desc}</p>
        <ul class="relative mt-4 space-y-1.5">
          ${s.bullets.map(b => `<li class="flex items-center gap-2 font-mono text-xs text-muted-foreground"><span style="color:var(--emerald)">▸</span>${b}</li>`).join('')}
        </ul>
      </div>
    `).join('');

    // Reveal on scroll
    const io = new IntersectionObserver((entries) => {
      entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('is-visible'); io.unobserve(e.target); } });
    }, { threshold: 0.1 });
    document.querySelectorAll('.reveal-on-scroll').forEach(el => io.observe(el));
 