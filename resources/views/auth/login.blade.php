@extends('auth.auth')

@section('title', 'Admin Login Page | Robiul Hassan')
@section("meta_description", "Sign in to admin dashboard")


@section('content')
    <div class="login-page">
        <div class="bg-grid-full"></div>
        <div class="blob blob-a"></div>
        <div class="blob blob-b"></div>

        <div class="login-card reveal">
            <a href="{{ route('home') }}" class="brand">
                <span class="accent">~/</span>dev<span class="blink"></span>
            </a>
            <h1>Welcome back.</h1>
            <p class="subtitle">Sign in to continue to your dashboard.</p>

            <form id="login-form" class="login-form" novalidate>
                <div class="field">
                    <label for="email">// email</label>
                    <div class="input-wrap">
                        <span data-icon="mail"></span>
                        <input id="email" type="email" name="email" placeholder="you@example.com" autocomplete="email"
                            required />
                    </div>
                </div>

                <div class="field">
                    <label for="password">// password</label>
                    <div class="input-wrap">
                        <span data-icon="lock"></span>
                        <input id="password" type="password" name="password" placeholder="••••••••"
                            autocomplete="current-password" required />
                    </div>
                </div>

                <div class="login-row">
                    <label><input type="checkbox" name="remember" />Remember me</label>
                    <a href="#forgot-password">Forgot password?</a>
                </div>

                <button id="login-submit" type="submit" class="submit">Sign in </button>
                
                <div id="login-status" class="login-status" role="status" aria-live="polite"></div>
            </form>

            {{-- <div class="login-divider">or continue with</div>

            <div class="oauth-row">
                <a href="#" class="oauth-btn"><span data-icon="github"></span>GitHub</a>
                <a href="#" class="oauth-btn"><span data-icon="mail"></span>Email link</a>
            </div>

            <p class="login-footer">No account? <a href="#">Request access →</a></p> --}}
        </div>
    </div>
@endsection