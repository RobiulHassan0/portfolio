<!DOCTYPE html>
<html lang="en">
<head>

  @include('frontend.partials.head')
  
</head>
<body>

  {{-- This is Navbar --}}
  @include('frontend.partials.nav')

  {{-- This is Main Content --}}
  @yield('content')

  {{-- This is Footer --}}
  @include('frontend.partials.footer')

  <script src="{{ asset('js/frontend/main.js') }}"></script>
  <script src="{{ asset('js/frontend/icons.js') }}"></script>
  <script src="{{ asset('js/frontend/nav.js') }}"></script>
  <script src="{{ asset('js/frontend/hero.js') }}"></script>
  <script src="{{ asset('js/frontend/projects.js') }}"></script>
  <script src="{{ asset('js/frontend/skills.js') }}"></script>
  <script src="{{ asset('js/frontend/about.js') }}"></script>
  <script src="{{ asset('js/frontend/services.js') }}"></script>
  <script src="{{ asset('js/frontend/contact.js') }}"></script>
  <script src="{{ asset('js/frontend/footer.js') }}"></script>
  
</body>
</html>