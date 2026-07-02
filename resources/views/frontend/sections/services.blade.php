<!-- ===================== SERVICES ===================== -->

<section id="services" class="section reveal-on-scroll">
  <div class="section-head">
    <div class="section-eyebrow"><span style="color:var(--emerald)">04.</span> services</div>
    <h2>Services</h2>
    <p>Ways we can work together.</p>
    <div class="section-rule"></div>
  </div>
  <div id="services-grid" class="services-grid">

    @foreach ($services as $category => $items)
      @foreach ($items as $service)

        <div class="service-card {{ $service?->category ?? '' }}">
          <div class="card-bg"></div>
          <div class="card-glow"></div>
          <div class="card-header">
            <div class="card-icon" data-icon="{{ $service?->icon ?? '' }}"></div>
            <div class="card-intro">
              <div class="card-meta-row">
                <span class="card-cat">{{ $service?->category ?? '' }}</span>
                <span class="card-num">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
              </div>
              <div class="card-title">{{ $service?->title ?? '' }}</div>
              <div class="card-desc">{{ $service?->description ?? '' }}
              </div>
            </div>
          </div>
          
          @php
            $stacks = $service?->service_items['stack'] ?? [];
            $features = $service?->service_items['features'] ?? [];
            $setups = $service?->service_items['setup'] ?? [];
          @endphp
          
          <div class="card-sections">
            <div class="sec">
              <div class="sec-label"><span class="sec-label-dot"></span>Stack</div>
              <div class="pill-col">
                @foreach ($stacks as $stack)
                  <span class="pill">{{ $stack ?? ''}}</span>
                @endforeach
              </div>
            </div>

            <div class="sec">
              <div class="sec-label"><span class="sec-label-dot"></span>Features</div>
              <div class="feat-list">
                
                @foreach ($features as $feature)
                  <div class="feat">
                    <div class="feat-box"><svg viewBox="0 0 10 10">
                        <polyline points="2,5 4,7 8,3" />
                      </svg></div>{{ $feature ?? '' }}
                  </div>
                @endforeach
              </div>
            </div>

            <div class="sec">
              <div class="sec-label"><span class="sec-label-dot"></span>Setup</div>
              <div class="pill-col">
                @foreach ($setups as $setup)
                  <span class="pill">{{ $setup ?? '' }}</span>
                @endforeach
              </div>
            </div>
          </div>
        </div>

      @endforeach
    @endforeach

  </div>
</section>