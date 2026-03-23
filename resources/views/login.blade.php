<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'MyApp') }} — Login</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style> * { font-family: 'Instrument Sans', sans-serif !important; } </style>
</head>
<body class="bg-light min-vh-100 d-flex flex-column">

<div class="flex-grow-1 d-flex align-items-center justify-content-center py-5 px-3">
    <div class="card border shadow-sm rounded-4 p-4 p-md-5 w-100" style="max-width:440px;">

        {{-- Brand --}}
        <a href="{{ route('home') }}" class="text-primary text-decoration-none fw-bold fs-5 d-inline-block mb-4">
            ⬡ MyApp
        </a>

        <h1 class="fw-bold mb-1 h4" style="letter-spacing:-0.02em;">Welcome back</h1>
        <p class="text-secondary small mb-4">Sign in to your account to continue.</p>

        {{-- Error alert --}}
        @if ($errors->any())
        <div class="alert alert-danger d-flex align-items-center gap-2 rounded-3 py-2 small" role="alert">
            <i class="bi bi-exclamation-circle-fill"></i>
            {{ $errors->first() }}
        </div>
        @endif

        {{-- Session status --}}
        @if (session('status'))
        <div class="alert alert-success rounded-3 py-2 small">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- Email --}}
            <div class="mb-3">
                <label class="form-label fw-semibold small" for="email">Email address</label>
                <input type="email" id="email" name="email"
                       class="form-control rounded-3 @error('email') is-invalid @enderror"
                       value="{{ old('email') }}" placeholder="you@example.com"
                       required autofocus autocomplete="email">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Password --}}
            <div class="mb-3">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <label class="form-label fw-semibold small mb-0" for="password">Password</label>
                    @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-primary small text-decoration-none fw-semibold">
                        Forgot password?
                    </a>
                    @endif
                </div>
                <div class="input-group">
                    <input type="password" id="password" name="password"
                           class="form-control rounded-start-3 @error('password') is-invalid @enderror"
                           placeholder="••••••••" required autocomplete="current-password">
                    <button type="button" class="btn btn-outline-secondary rounded-end-3"
                            onclick="togglePwd()" tabindex="-1">
                        <i class="bi bi-eye" id="pwd-icon"></i>
                    </button>
                </div>
                @error('password')
                    <div class="text-danger mt-1 small">{{ $message }}</div>
                @enderror
            </div>

            {{-- Remember --}}
            <div class="mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember" name="remember">
                    <label class="form-check-label small text-secondary" for="remember">Remember me</label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary fw-semibold w-100 rounded-3 py-2">
                Sign in <i class="bi bi-arrow-right ms-1"></i>
            </button>
        </form>

        {{-- Divider --}}
        <div class="d-flex align-items-center gap-2 my-4">
            <hr class="flex-grow-1 m-0">
            <span class="text-secondary small">or continue with</span>
            <hr class="flex-grow-1 m-0">
        </div>

        {{-- Social --}}
        <div class="d-flex gap-2">
            <button class="btn btn-outline-secondary fw-semibold flex-fill rounded-3 small">
                <svg width="16" height="16" viewBox="0 0 24 24" class="me-1" style="vertical-align:-2px">
                    <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                    <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                    <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                    <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                </svg>
                Google
            </button>
            <button class="btn btn-outline-secondary fw-semibold flex-fill rounded-3 small">
                <i class="bi bi-github me-1"></i> GitHub
            </button>
        </div>

        @if (Route::has('register'))
        <p class="text-center text-secondary small mt-4 mb-0">
            Don't have an account?
            <a href="{{ route('register') }}" class="text-primary fw-semibold text-decoration-none">Sign up free</a>
        </p>
        @endif

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
<script>
    function togglePwd() {
        const i = document.getElementById('password');
        const ic = document.getElementById('pwd-icon');
        i.type = i.type === 'password' ? 'text' : 'password';
        ic.className = i.type === 'password' ? 'bi bi-eye' : 'bi bi-eye-slash';
    }
</script>
</body>
</html>
