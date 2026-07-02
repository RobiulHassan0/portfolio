<!-- ============ SKILLS ============ -->

<section class="section-page" data-section="skills">
    <div class="section-head">
        <div>
            <h2>Skills & Stack</h2>
            <div class="sub">Manage the skills shown in your portfolio's Skills section.</div>
        </div>
        <button type="button" class="btn btn-primary" data-modal-open="modalSkill">+ New skill</button>
    </div>

    <!-- Stats -->
    <section class="stats">
        <div class="stat">
            <div class="ico">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M4 6h16M4 12h16M4 18h10" />
                </svg>
            </div>
            <div>
                <div class="lbl">Total</div>
                <div class="val" id="sTotal">{{ $stats['total'] ?? 0 }}</div>
            </div>
        </div>
        <div class="stat">
            <div class="ico">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="16 18 22 12 16 6" />
                    <polyline points="8 6 2 12 8 18" />
                </svg>
            </div>
            <div>
                <div class="lbl">Frontend</div>
                <div class="val" id="sFe">{{ $stats['frontend'] ?? 0 }}</div>
            </div>
        </div>
        <div class="stat green">
            <div class="ico">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <ellipse cx="12" cy="5" rx="9" ry="3" />
                    <path d="M3 5v6c0 1.7 4 3 9 3s9-1.3 9-3V5" />
                    <path d="M3 11v6c0 1.7 4 3 9 3s9-1.3 9-3v-6" />
                </svg>
            </div>
            <div>
                <div class="lbl">Backend</div>
                <div class="val" id="sBe">{{ $stats['backend'] ?? 0 }}</div>
            </div>
        </div>
        <div class="stat amber">
            <div class="ico">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polygon points="12 2 15 9 22 9 17 14 19 21 12 17 5 21 7 14 2 9 9 9" />
                </svg>
            </div>
            <div>
                <div class="lbl">Featured</div>
                <div class="val" id="sFeat">{{ $stats['featured'] ?? 0 }}</div>
            </div>
        </div>

        {{-- Active Skills --}}
        <div class="stat active-green">
            <div class="ico">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#2ecc71" stroke-width="2.5"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                    <polyline points="22 4 12 14.01 9 11.01" />
                </svg>
            </div>
            <div>
                <div class="lbl">Active</div>
                <div class="val" >{{ $stats['active'] ?? 0 }}</div>
            </div>
        </div>

        {{-- Inactive Skills --}}
        <div class="stat inactive-red">
            <div class="ico">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#e74c3c" stroke-width="2.5"
                    stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10" />
                    <line x1="15" y1="9" x2="9" y2="15" />
                    <line x1="9" y1="9" x2="15" y2="15" />
                </svg>
            </div>
            <div>
                <div class="lbl">Inactive</div>
                <div class="val">{{ $stats['inactive'] ?? 0}}</div>
            </div>
        </div>

    </section>

    <!-- Toolbar -->
    <div class="toolbar">
        <div class="search">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="11" cy="11" r="7" />
                <path d="m21 21-4.3-4.3" />
            </svg>
            <input id="query" placeholder="Search skills by name, category, level or description…" />
        </div>
        <div class="tabs" id="tabs">
            <button class="tab active" data-category="all">
                All <span class="count" id="cAll">{{ $stats['total'] ?? 0 }}</span>
            </button>
            <button class="tab" data-category="frontend">
                Frontend <span class="count" id="cFe">{{ $stats['frontend'] ?? 0 }}</span>
            </button>
            <button class="tab" data-category="backend">
                Backend <span class="count" id="cBe">{{ $stats['backend'] ?? 0 }}</span>
            </button>
        </div>
    </div>

    <!-- Grid -->
    <section class="skill-grid" id="skillGrid">

    </section>

</section>


