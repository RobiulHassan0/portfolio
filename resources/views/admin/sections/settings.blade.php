<!-- ============ SETTINGS ============ -->


<section class="section-page" data-section="settings">
    <div class="section-head">
        <div>
            <h2>Site Settings</h2>
            <div class="sub">Manage the Hero section and Contact (left side) content.</div>
        </div>
    </div>

    <div class="grid gap-5">
        <!-- HERO FORM -->
        <form class="panel" action="#" method="POST" data-demo="Hero saved">

            <div class="panel-head">
                <h3>Hero section</h3>
                <span class="text-xs text-muted-foreground">Landing</span>
            </div>

            <div class="panel-body space-y-4">

                <div class="hero-top-grid">

                    <div class="left-inputs">
                        <div class="field">
                            <label>Name</label>
                            <input name="name" value="{{ $userInfo?->user?->name ?? 'your name' }}" required />
                        </div>

                        <div class="field">
                            <label>Role / Designation</label>
                            <input name="role" value="{{ $userInfo?->designation ?? '' }}" required />
                        </div>
                    </div>

                    <div class="field right-bio-field">
                        <label>Bio / Short Description</label>
                        <textarea name="bio" required>{{ $userInfo?->bio ?? '' }}</textarea>
                    </div>

                </div>


                <div class="field-row cols-4">

                    <div class="field">
                        <label>Primary CTA text</label>
                        <input name="ctaPrimaryText" value="View Projects" />
                    </div>

                    <div class="field">
                        <label>Primary CTA link</label>
                        <input name="ctaPrimaryLink" value="#projects" />
                    </div>

                    <div class="field">
                        <label>Secondary CTA text</label>
                        <input name="ctaSecondaryText" value="Contact Me" />
                    </div>

                    <div class="field">
                        <label>Secondary CTA link</label>
                        <input name="ctaSecondaryLink" value="#contact" />
                    </div>

                </div>

                {{-- Image Field --}}
                <div class="field">
                    <label>Image path</label>
                    <input name="image" value="{{ $userInfo?->profile_photo ?? '' }}"
                        placeholder="assets/hero-portrait.jpg" data-preview-target="heroPreview" />
                    <span class="hint">Relative or absolute URL — e.g. assets/photo.jpg</span>
                    <div class="image-preview" id="heroPreview"></div>
                </div>

                <div class="field-row cols-2">
                    <div class="field">
                        <label>Availability badge</label>
                        <input name="status" value="{{ $userInfo?->availability_text ?? '' }}" />
                    </div>

                    <div class="field">
                        <label>Resume URL</label>
                        <input name="resume" value="{{ $userInfo?->resume_url ?? '' }}" />
                    </div>

                    <div class="field">
                        <label>Focus</label>
                        <input name="focus" value="{{ $userInfo?->focus ?? '' }}" />
                    </div>

                    <div class="field">
                        <label>Stack (Comma separated)</label>
                        <input name="stack" value="{{ $userInfo?->stack ? implode(', ', $userInfo->stack ?? []) : '' }}" placeholder="e.g. Laravel, PHP, JS, MySQL" />
                    </div>
                </div>

                <div class="field">
                    <label>Availale ?</label>
                    <select name="is_available" id="">
                        <option value="1" @selected($userInfo?->is_available == 1)>true</option>
                        <option value="0" @selected($userInfo?->is_available == 0)>false</option>
                    </select>
                </div>


                <div class="flex justify-end gap-2 pt-2">
                    <button type="reset" class="btn btn-ghost">Reset</button>
                    <button type="submit" class="btn btn-primary">Save hero</button>
                </div>
            </div>
        </form>

        <!-- CONTACT FORM -->
        <form class="panel" data-contact-form action="#" method="POST" data-demo="Contact saved">

            <div class="panel-head">
                <h3>Contact — left side</h3>
                <span class="text-xs text-muted-foreground">Info column</span>
            </div>

            <div class="panel-body space-y-4">

                <div class="field">
                    <label>Heading</label>
                    <input name="heading" value="Let's build something great" required />
                </div>

                <div class="field"><label>Intro paragraph</label>
                    <textarea name="description" required>

                    </textarea>
                </div>

                <div class="field-row cols-2">

                    <div class="field">
                        <label>Email</label>
                        <input type="email" name="email" value="" required />
                    </div>

                    <div class="field">
                        <label>GitHub URL</label>
                        <input name="github" value="" />
                    </div>

                </div>
                {{-- <div class="field">
                    <label>Location</label>
                    <input name="location" value="Remote · Worldwide" />
                </div> --}}

                <div class="field-row cols-2">

                    <div class="field">
                        <label>LinkedIn URL</label>
                        <input name="linkedin" value="" />
                    </div>

                    <div class="field">
                        <label>WhatsApp URL</label>
                        <input name="whatsapp" value="https://wa.me/1234567890" />
                    </div>

                </div>


                <div class="flex justify-end gap-2 pt-2">
                    <button type="reset" class="btn btn-ghost">Reset</button>
                    <button type="submit" class="btn btn-primary">Save contact</button>
                </div>

            </div>

        </form>

    </div>

</section>