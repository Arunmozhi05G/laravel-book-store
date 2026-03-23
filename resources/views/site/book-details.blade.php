@extends('layout.app')

@section('content')
    <div class="container py-5">
        <div class="mb-4">
            <a href="{{ route('books.list') }}" class="text-decoration-none text-secondary small fw-medium">
                <i class="bi bi-arrow-left me-1"></i> Back to books
            </a>
        </div>

        <div class="row g-5">
            <div class="col-md-5 col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden position-sticky" style="top:100px;">
                    <div class="bg-light d-flex align-items-center justify-content-center" style="min-height:350px;">
                        @if ($book->image)
                            @if ($book->is_api)
                                <img src="{{ $book->image }}" alt="{{ $book->title }}" class="img-fluid w-100"
                                    style="object-fit:cover;min-height:350px;">
                            @else
                                <img src="{{ asset('assets/books/' . $book->image) }}" alt="{{ $book->title }}"
                                    class="img-fluid w-100" style="object-fit:cover;min-height:350px;">
                            @endif
                        @else
                            <i class="bi bi-book text-secondary opacity-25" style="font-size:6rem;"></i>
                        @endif
                    </div>
                </div>

                @if ($book->is_api)
                    <div class="text-center mt-3">
                        <span
                            class="badge bg-secondary bg-opacity-10 text-secondary rounded-pill px-3 py-2 small fw-medium">
                            <i class="bi bi-google me-1"></i> Data from Google Books API
                        </span>
                    </div>
                @endif
            </div>
            <div class="col-md-7 col-lg-8">
                <div class="mb-2">
                    <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-2 fw-semibold">
                        {{ $book->category_name }}
                    </span>
                </div>
                <h1 class="fw-bold mb-2 display-6" style="letter-spacing:-0.02em;">{{ $book->title }}</h1>
                <p class="fs-5 text-secondary mb-4">by {{ $book->author }}</p>

                <div class="d-flex align-items-center gap-4 mb-4 pb-4 border-bottom">
                    <div>
                        <div class="text-secondary small mb-1 fw-medium">Price</div>
                        <div class="fs-3 fw-bold text-dark">
                            ₹{{ is_numeric($book->price) ? number_format($book->price, 2) : 0 }}</div>
                    </div>
                    <div class="vr bg-secondary opacity-25"></div>
                    <div>
                        <div class="text-secondary small mb-1 fw-medium">Availability</div>
                        @if ($book->quantity > 0)
                            <div class="text-success fw-bold d-flex align-items-center gap-1">
                                <i class="bi bi-check-circle-fill"></i> In Stock
                                {{ !$book->is_api ? '(' . $book->quantity . ')' : '' }}
                            </div>
                        @else
                            <div class="text-danger fw-bold d-flex align-items-center gap-1">
                                <i class="bi bi-x-circle-fill"></i> Out of Stock
                            </div>
                        @endif
                    </div>
                </div>
                <h5 class="fw-bold mb-3">Description</h5>
                <div class="text-secondary lh-lg mb-5" style="font-size: 1.05rem;">
                    {!! $book->description !!}
                </div>

                <div class="d-flex gap-3 mt-auto">
                    <button
                        class="btn btn-primary btn-lg px-5 fw-semibold rounded-pill {{ $book->quantity <= 0 ? 'disabled' : '' }}">
                        <i class="bi bi-cart-plus me-2"></i> Add to Cart
                    </button>
                    <button class="btn btn-outline-secondary btn-lg px-4 rounded-pill">
                        <i class="bi bi-heart"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
