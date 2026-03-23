    @extends('layout.auth')

    @section('content')
        <div class="login-card">

            <div class="text-center">
                <a href="/" class="brand-logo">Laravel Book Store</a>
                <h1>Sign Up</h1>
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

            <form method="POST" action="{{ route('register.submit') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label" for="name">Name <span class="text-danger">*</span></label>
                    <input type="text" id="name" name="name"
                        class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Your name"
                        required autofocus autocomplete="name">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="email">Email address <span class="text-danger">*</span></label>
                    <input type="email" id="email" name="email"
                        class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                        placeholder="you@example.com" required autofocus autocomplete="email">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <label class="form-label mb-0" for="password">Create Password <span class="text-danger">*</span></label>
                    </div>
                    <div class="input-group">
                        <input type="password" id="new-password" name="create-password"
                            class="form-control @error('password') is-invalid @enderror" placeholder="••••••••" required
                            autocomplete="current-password">
                        <button type="button" class="btn-toggle" onclick="togglePwd('new-password', 'pwd-icon-new')"
                            tabindex="-1">
                            <i class="bi bi-eye" id="pwd-icon-new"></i>
                        </button>
                    </div>
                    @error('password')
                        <div class="text-danger mt-1" style="font-size:0.8rem;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <label class="form-label mb-0" for="password">Confirm Password <span class="text-danger">*</span></label>
                    </div>
                    <div class="input-group">
                        <input type="password" id="confirm-password" name="confirm-password"
                            class="form-control @error('password') is-invalid @enderror" placeholder="••••••••" required
                            autocomplete="current-password">
                        <button type="button" class="btn-toggle"
                            onclick="togglePwd('confirm-password', 'pwd-icon-confirm')" tabindex="-1">
                            <i class="bi bi-eye" id="pwd-icon-confirm"></i>
                        </button>
                    </div>
                    @error('password')
                        <div class="text-danger mt-1" style="font-size:0.8rem;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="phone">Phone Nubmer <span>(optional)</span></label>
                    <input type="phone" id="email" name="phone"
                        class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}"
                        placeholder="+91 0000000000" required autofocus autocomplete="phone">
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-brand">
                    Sign up <i class="bi bi-arrow-right ms-1"></i>
                </button>
            </form>

            @if (Route::has('login'))
                <p class="text-center mt-4 mb-0" style="font-size:0.875rem;color:var(--muted);">
                    Already have an account? <a href="{{ route('login') }}" class="link-brand">Sign in</a>
                </p>
            @endif

        </div>
    @endsection
