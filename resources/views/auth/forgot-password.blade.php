    @extends('layout.auth')

    @section('content')
        <div class="login-card">

            <div class="text-center">
                <a href="/" class="brand-logo">Laravel Book Store</a>
                <h1>Foreget Password</h1>
            </div>
            
            @if (session('status'))
                <div class="alert alert-success rounded-3 mb-4" style="font-size:0.875rem;">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="">
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

                <button type="submit" class="btn btn-brand">
                    Sent Request<i class="bi bi-arrow-right ms-1"></i>
                </button>
            </form>
            @if (Route::has('register'))
                <p class="text-center mt-4 mb-0" style="font-size:0.875rem;color:var(--muted);">
                    Don't have an account? <a href="{{ route('register') }}" class="link-brand">Sign up free</a>
                </p>
            @endif

        </div>
    @endsection
