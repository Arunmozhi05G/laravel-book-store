<nav class="navbar navbar-expand-lg bg-white border-bottom sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold text-primary fs-5" href="{{ route('home') }}">Laravel Book Store</a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="nav">
            <ul class="navbar-nav mx-auto gap-1">
                <li class="nav-item"><a class="nav-link px-3 fw-medium active" href="{{ route('home') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link px-3 fw-medium" href="{{ route('books.list') }}">Books</a></li>
            </ul>
            <div class="d-flex gap-2 mt-3 mt-lg-0">
                @auth
                    <a href="{{ route('logout') }}" class="btn btn-primary fw-semibold">Logout</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-secondary fw-semibold">Log in</a>
                    <a href="{{ route('register') }}" class="btn btn-primary fw-semibold">Get started</a>
                @endauth
            </div>
        </div>
    </div>
</nav>
