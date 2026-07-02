<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Default Title')</title>

    <meta name="description" content="@yield('meta_description', 'Default description')" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600;700&display=swap"
        rel="stylesheet" />

    <!-- Tailwind Play CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        background: 'var(--background)',
                        foreground: 'var(--foreground)',
                        surface: 'var(--surface)',
                        'surface-elevated': 'var(--surface-elevated)',
                        card: 'var(--card)',
                        primary: {
                            DEFAULT: 'var(--primary)',
                            foreground: 'var(--primary-foreground)',
                        },
                        border: 'var(--border)',
                        'muted-foreground': 'var(--muted-foreground)',
                        emerald: 'var(--emerald)',
                    },
                    fontFamily: {
                        sans: ['Inter', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                        mono: ['JetBrains Mono', 'ui-monospace', 'SFMono-Regular', 'monospace'],
                    },
                    borderRadius: { lg: '0.75rem', xl: '1rem', '2xl': '1.25rem' },
                },
            },
        };
    </script>

    <link rel="stylesheet" href="{{ asset('css/frontend/base.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/auth/login.css') }}" />

</head>

<body>

    {{-- This is Main Content --}}
    @yield('content')

    <script src="{{ asset('js/frontend/main.js') }}"></script>
    <script src="{{ asset('js/frontend/icons.js') }}"></script>
    <script src="{{ asset('js/auth/login.js') }}"></script>
</body>

</html>