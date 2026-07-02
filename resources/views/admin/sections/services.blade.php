<!-- ============ SERVICES ============ -->
<section class="section-page" data-section="services">
    <div class="section-head">
        <div>
            <h2>Services</h2>
            <div class="sub">Offer cards rendered in the Services section.</div>
        </div>
        <button type="button" class="btn btn-primary" data-modal-open="modalService">+ New service</button>
    </div>

    @if($services->isEmpty())
        <div class="empty-state">No services yet — click “+ New service” to add one.</div>
    @else
        <div class="cards">

            @foreach ($services as $service)
            
                <article class="card {{ $service->category }} ">
                    <div class="glow"></div>

                    <div class="top">
                        <div class="icon">  
                            <span class="service-icon" data-icon="{{ $service->icon }}"></span>
                        </div>
                        <span class="cat-chip"><span class="dot"></span>{{ $service->category }}</span>
                    </div>

                    <div>
                        <h3 class="title">{{ $service->title }}</h3>
                        <p class="desc">{{ $service->description }}</p>
                    </div>

                    @php
                        $stacks = $service->service_items['stack'] ?? [];
                        $features = $service->service_items['features'] ?? [];
                        $setups = $service->service_items['setup'] ?? [];
                    @endphp

                    <div class="group">
                        <div class="label">Stack</div>
                        <div class="badges">
                            @foreach ($stacks as $stack)
                                <span>{{ $stack }}</span>
                                {{ !$loop->last ? '. ' : '' }}
                            @endforeach
                        </div>
                    </div> 

                    <div class="group highlight">
                        <div class="label">Features</div>
                        <div class="badges">
                            @foreach ($features as $feature)
                                <span>{{ $feature }}</span>
                                {{ !$loop->last ? '. ' : '' }}
                            @endforeach
                        </div>
                    </div>

                    <div class="group">
                        <div class="label">Setup</div>
                        <div class="badges">
                            @foreach ($setups as $setup)
                                <span>{{ $setup }}</span>
                                {{ !$loop->last ? '. ' : '' }}
                            @endforeach
                        </div>
                    </div>

                    <div class="foot">
                        <span class="status {{ $service->is_active ? 'active' : 'inactive'}} ">
                            <span class="pulse"></span>
                            {{ $service->is_active ? 'Active' : 'Inactive' }}
                        </span>
                        <small class="sort-order">#{{ $service->sort_order }}</small>
                        <div class="actions">
                            <button class="icon-btn edit-service-btn" title="Edit" data-modal-open="modalService"
                                data-id="{{ $service->id }}" data-title="{{ $service->title }}"
                                data-description="{{ $service->description }}" data-category="{{ $service->category }}"
                                data-icon="{{ $service->icon }}" data-active="{{ $service->is_active ? 1 : 0 }}"
                                data-sort-order="{{ $service->sort_order }}" data-stack="{{ implode(', ', $stacks) }}"
                                data-features="{{ implode(', ', $features) }}" data-setup="{{ implode(', ', $setups) }}">

                                <svg viewBox="0 0 24 24">
                                    <path d="M4 20h4l10-10-4-4L4 16v4z" />
                                </svg>
                            </button>

                            <button class="icon-btn danger delete-service-btn" title="Delete"
                                data-modal-open="modalConfirmDelete" data-id="{{ $service->id }}">
                                <svg viewBox="0 0 24 24">
                                    <path d="M4 7h16M9 7V4h6v3M6 7l1 13h10l1-13" />
                                </svg>
                            </button>
                        </div>

                    </div>

                </article>

            @endforeach

        </div>

    @endif

</section>

