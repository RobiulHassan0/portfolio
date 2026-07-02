<!-- ===================== HERO ===================== -->
<section id="top" class="hero">
  <div class="bg-grid" style="position:absolute;inset:0;pointer-events:none"></div>
  <div class="blob-1"></div>
  <div class="blob-2"></div>

  <div class="container">
    <div class="reveal" style="animation-delay:.05s">
      <div class="hero-badge"><span class="dot"></span>{{ $userInfo?->availability_text ?? 'will be added by user' }}</div>
      <h1 class="text-gradient">{{ $userInfo?->user->name }}.</h1>
        @php
          $parts = explode(' ', $userInfo?->designation)
        @endphp      
        <p class="subtitle">
        <span class="text-primary">&gt;</span> 
        {{ $parts[0] ?? '' }}
        {{ $parts[1] ?? '' }}
        <span class="text-foreground">{{ $parts[2] ?? '' }}</span>
        {{ $parts[3] ?? '' }}
      </p>
      <p class="desc">{{ $userInfo?->bio }}</p>
      <div class="cta-row">
        <a href="#projects" class="btn-primary">View Projects →</a>
        <a href="#contact" class="btn-ghost">✉ Contact Me</a>
      </div>
    </div>

    <div class="reveal" style="animation-delay:.2s">
      <div class="hero-portrait">
        <div class="overlay-grid bg-grid"></div>
        <div class="overlay-tint"></div>
        <img src="{{ $userInfo?->profile_photo ?? asset('assets/hero-portrait.jpg') }}" alt="{{ $userInfo?->user?->name }} portrait" />
        <div class="status-chip"><span class="dot"></span>online — building things</div>
      </div>

      <div class="code-card">
        <div class="bar">
          <div class="dots">
            <span style="background:rgba(239,68,68,.7)"></span>
            <span style="background:rgba(234,179,8,.7)"></span>
            <span style="background:rgba(34,197,94,.7)"></span>
          </div>
          <span class="name">developer.js</span>
          <span style="width:3rem"></span>
        </div>
        <pre><code class="whitespace-pre"><span style="color:var(--emerald)">const </span><span class="text-primary">developer</span><span class="text-foreground"> = {
  </span><span class="text-muted-foreground">name: </span><span style="color:#fcd34d">"{{ $userInfo?->user->name }}"</span><span class="text-muted-foreground">,
  role: </span><span style="color:#fcd34d">"{{ $userInfo?->designation }}"</span><span class="text-muted-foreground">,
  stack: </span><span style="color:#fcd34d">@json($userInfo?->stack)</span><span class="text-muted-foreground">,
  focus: </span><span style="color:#fcd34d">"{{ $userInfo?->focus }}"</span><span class="text-muted-foreground">,
  available: </span><span style="color:var(--emerald)">{{ $userInfo?->is_available ? 'true' : 'false' }}</span><span class="text-foreground">,
};</span></code></pre>
      </div>
    </div>
  </div>
</section>