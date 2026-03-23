    @extends('layout.auth')

    @section('content')
        <div class="login-card">

            <div class="text-center">
                <a href="/" class="brand-logo">Laravel Book Store</a>
                <h1>Sign In</h1>
            </div>

            {{-- Laravel error bag --}}
            {{-- @if ($errors->any())
                <div class="alert-error mb-4">
                    <i class="bi bi-exclamation-circle me-1"></i>
                    {{ $errors->first() }}
                </div>
            @endif --}}

            {{-- Session status --}}
            @if (session('status'))
                <div class="alert alert-success rounded-3 mb-4" style="font-size:0.875rem;">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login.submit') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label" for="email">Email address</label>
                    <input type="email" id="email" name="email"
                        class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                        placeholder="you@example.com" required autofocus autocomplete="email">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <label class="form-label mb-0" for="password">Password</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="link-brand" style="font-size:0.8rem;">Forgot
                                password?</a>
                        @endif
                    </div>
                    <div class="input-group">
                        <input type="password" id="password" name="password"
                            class="form-control @error('password') is-invalid @enderror" placeholder="••••••••" required
                            autocomplete="current-password">
                        <button type="button" class="btn-toggle" onclick="togglePwd('password', 'pwd-icon')"
                            tabindex="-1">
                            <i class="bi bi-eye" id="pwd-icon"></i>
                        </button>
                    </div>
                    @error('password')
                        <div class="text-danger mt-1" style="font-size:0.8rem;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember">Remember me</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-brand">
                    Sign in <i class="bi bi-arrow-right ms-1"></i>
                </button>
            </form>
            @if (Route::has('register'))
                <p class="text-center mt-4 mb-0" style="font-size:0.875rem;color:var(--muted);">
                    Don't have an account? <a href="{{ route('register') }}" class="link-brand">Sign up free</a>
                </p>
            @endif

        </div>
    @endsection
