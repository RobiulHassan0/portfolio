

<!-- ===================== CONTACT ===================== -->

<section id="contact" class="py-24 max-w-6xl mx-auto px-6 reveal-on-scroll">
    <div class="mb-12">
        <div class="font-mono text-sm text-primary mb-2"><span class="text-emerald">07.</span> contact</div>
        <h2 class="text-3xl md:text-4xl font-bold tracking-tight">Contact</h2>
        <div class="mt-4 h-px w-16 bg-gradient-to-r from-primary to-transparent"></div>
    </div>
    <div class="rounded-2xl border border-border bg-surface p-8 md:p-12 relative overflow-hidden">
        <div class="absolute -top-20 -right-20 w-72 h-72 rounded-full bg-primary/10 blur-3xl"></div>
        <div class="grid md:grid-cols-2 gap-8 items-start relative">

            {{-- Contact Information --}}
            @include('frontend.sections.contact.info')

            {{-- Contact Form --}}
            @include('frontend.sections.contact.form')
        </div>
    </div>

</section>

