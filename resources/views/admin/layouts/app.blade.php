<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>@yield('title', 'Admin Dashboard') — Portfolio</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('css/admin/base.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/admin/sidebar.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/admin/topbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/admin/table.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/admin/modal.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/admin/forms.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/admin/service.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/admin/skills.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/admin/toast.css') }}" />
</head>

<body class="bg-background text-foreground">

    <div class="admin-shell">
        @include('admin.partials.sidebar')

        <main class="admin-main">
            @include('admin.partials.topbar')

            <div class="section-root">
                @yield('content')
            </div>
        </main>
    </div>

    @include('admin.partials.modals.delete')
    @include('admin.partials.modals.project')
    @include('admin.partials.modals.service')
    @include('admin.partials.modals.skill')


    <!-- Toast container -->
    <div id="toastRoot" class="toast-root"></div>

    <script src="{{ asset('js/admin/toast.js') }}"></script>
    <script src="{{ asset('js/admin/icons.js') }}"></script>
    <script src="{{ asset('js/admin/modal.js') }}"></script>

    <script src="{{ asset('js/admin/sections/overview.js') }}"></script>
    <script src="{{ asset('js/admin/sections/settings.js') }}"></script>
    <script src="{{ asset('js/admin/sections/projects.js') }}"></script>
    <script src="{{ asset('js/admin/sections/services.js') }}"></script>
    <script src="{{ asset('js/admin/sections/skills.js') }}"></script>

    <script src="{{ asset('js/admin/app.js') }}"></script>

    @stack('scripts')
</body>

</html>