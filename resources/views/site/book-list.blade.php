@extends('layout.app')
@section('content')
    <div class="bg-light border-bottom py-5">
        <div class="container">
            <h1 class="fw-bold mt-1 mb-2" style="letter-spacing:-0.03em;">All Books</h1>
            <p class="text-secondary small mb-0">
                Showing {{ $books->firstItem() }}–{{ $books->lastItem() }} of {{ $books->total() }} books
            </p>
        </div>
    </div>

    <section class="py-4">
        <div class="container">
            <div class="card border rounded-3 p-3 mb-4">
                <form method="GET" action="{{ route('books.list') }}" class="row g-2 align-items-center">
                    <div class="col-12 col-md-5 col-lg-4">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0">
                                <i class="bi bi-search text-secondary small"></i>
                            </span>
                            <input type="text" name="search" class="form-control border-start-0"
                                placeholder="Search books..." value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="col-6 col-md-3 col-lg-2">
                        <select name="category" class="form-select">
                            <option value="">All Categories</option>
                            @foreach ($categories ?? [] as $cat)
                                <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6 col-md-3 col-lg-2">
                        <select name="sort" class="form-select">
                            <option value="">Sort by</option>
                            <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price:
                                Low–High</option>
                            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price:
                                High–Low</option>
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-auto d-flex gap-2">
                        <button type="submit" class="btn btn-primary fw-semibold px-4">Filter</button>
                        <a href="{{ route('books.list') }}" class="btn btn-outline-secondary fw-semibold px-3">Reset</a>
                    </div>
                </form>
            </div>
            @if ($books->isEmpty())
                <div class="text-center py-5">
                    <h5 class="fw-bold">No books found</h5>
                    <p class="text-secondary small">Try adjusting your search or filter criteria.</p>
                    <a href="{{ route('books.list') }}" class="btn btn-primary mt-2 fw-semibold">View all books</a>
                </div>
            @else
                <div class="row g-4">
                    {{-- Local Books --}}
                    @foreach ($books as $book)
                        <div class="col-6 col-md-4 col-lg-3">
                            <div class="card border rounded-4 book-card h-100 overflow-hidden d-flex flex-column"
                                style="transition:box-shadow 0.2s;"
                                onmouseover="this.style.boxShadow='0 6px 24px rgba(13,110,253,.1)'"
                                onmouseout="this.style.boxShadow=''">
                                <div class="book-img bg-light"
                                    style="display:flex;align-items:center;justify-content:center;height:220px;overflow:hidden;">
                                    @if ($book->image)
                                        <img src="{{ asset('assets/books/' . $book->image) }}" alt="{{ $book->title }}"
                                            style="width:100%;height:100%;object-fit:cover;">
                                    @else
                                        <i class="bi bi-book text-primary" style="font-size:3.5rem;"></i>
                                    @endif
                                </div>
                                <div class="card-body p-3 d-flex flex-column flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <span class="badge bg-light text-dark border px-2 py-1"
                                            style="font-size:0.75rem;">{{ $book->category->name ?? '—' }}</span>
                                        <span class="fw-bold fs-5"
                                            style="letter-spacing:-0.03em;">₹{{ number_format($book->price, 2) }}</span>
                                    </div>
                                    <h6 class="fw-bold mb-1 lh-sm" style="letter-spacing:-0.01em;">{{ $book->title }}</h6>
                                    <p class="text-secondary small mb-3">by {{ $book->author }}</p>
                                    @if ($book->quantity > 0)
                                        <div class="text-success small fw-medium mt-auto mb-2"><i
                                                class="bi bi-check-circle-fill me-1"></i> In stock</div>
                                    @else
                                        <div class="text-danger small fw-medium mt-auto mb-2"><i
                                                class="bi bi-x-circle-fill me-1"></i> Out of stock</div>
                                    @endif
                                </div>
                                <div class="card-footer bg-white border-top-0 p-3 pt-0 d-flex gap-2 mt-auto">
                                    <a href="{{ route('books.show', $book->id) }}"
                                        class="btn btn-outline-primary btn-sm fw-semibold flex-fill rounded-3">View
                                        Details</a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    {{-- Google API Books --}}
                    @if (isset($apiBooks) && $apiBooks->isNotEmpty())
                        <div class="col-12 mt-5 mb-2">
                            <h4 class="fw-bold h5 mb-0" style="letter-spacing:-0.02em;">From Google Books API</h4>
                        </div>
                        @foreach ($apiBooks as $apiBook)
                            <div class="col-6 col-md-4 col-lg-3">
                                <div class="card border rounded-4 book-card h-100 overflow-hidden d-flex flex-column"
                                    style="transition:box-shadow 0.2s;"
                                    onmouseover="this.style.boxShadow='0 6px 24px rgba(13,110,253,.1)'"
                                    onmouseout="this.style.boxShadow=''">
                                    <div class="book-img bg-light position-relative"
                                        style="display:flex;align-items:center;justify-content:center;height:220px;overflow:hidden;">
                                        <span
                                            class="badge bg-dark bg-opacity-75 text-white position-absolute top-0 start-0 m-2 rounded-2"
                                            style="font-size:0.65rem;backdrop-filter:blur(4px);"><i
                                                class="bi bi-google"></i> Web</span>
                                        <img src="{{ $apiBook->image }}" alt="{{ $apiBook->title }}"
                                            style="width:100%;height:100%;object-fit:cover;">
                                    </div>
                                    <div class="card-body p-3 d-flex flex-column flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            {{-- <span class="badge bg-light text-dark border px-2 py-1"
                                                style="font-size:0.75rem;">{{ $apiBook->category_name }}</span> --}}
                                            <span class="fw-bold fs-5"
                                                style="letter-spacing:-0.03em;">₹{{ number_format($apiBook->price, 2) }}</span>
                                        </div>
                                        <h6 class="fw-bold mb-1 lh-sm"
                                            style="letter-spacing:-0.01em;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;text-overflow:ellipsis;">
                                            {{ $apiBook->title }}</h6>
                                        <p class="text-secondary small mb-3 text-truncate">by {{ $apiBook->author }}</p>
                                        <div class="text-success small fw-medium mt-auto mb-2"><i
                                                class="bi bi-globe me-1"></i> Available Online</div>
                                    </div>
                                    <div class="card-footer bg-white border-top-0 p-3 pt-0 d-flex gap-2 mt-auto">
                                        <a href="{{ route('books.show', $apiBook->id) }}"
                                            class="btn btn-outline-primary btn-sm fw-semibold flex-fill rounded-3">View
                                            Details</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="d-flex justify-content-center mt-5">
                    {{ $books->withQueryString()->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    </section>
@endsection
