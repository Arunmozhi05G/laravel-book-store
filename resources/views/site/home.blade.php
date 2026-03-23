@extends('layout.app')

@section('content')
    <section class="py-5 bg-light border-bottom">
        <div class="container">
            <div class="row align-items-center g-4">
                <div class="col-lg-7">
                    <h1 class="fw-bold mb-3" style="letter-spacing:-0.03em;font-size:2.4rem;">
                        Discover Your Next<br><span class="text-primary">Favourite Book</span>
                    </h1>
                    <p class="text-secondary mb-4" style="max-width:480px;">
                        From our laravel book store
                    </p>
                    <div id="weather-widget"
                        class="align-items-center bg-white border rounded-pill px-3 py-2 shadow-sm mb-4 d-inline-flex"
                        style="max-width: 100%;">
                        <span id="weather-icon" class="fs-4 me-2 text-primary" style="line-height:1;"><i
                                class="bi bi-cloud-sun"></i></span>
                        <div class="me-2 text-nowrap">
                            <div class="fw-bold lh-1 text-dark" id="weather-temp">--°C</div>
                            <div class="text-secondary text-truncate" style="font-size: 0.75rem; max-width: 150px;"
                                id="weather-desc">Detecting...</div>
                        </div>
                        <div class="vr mx-2 bg-secondary opacity-25"></div>
                        <div class="d-flex align-items-center">
                            <input type="text" id="weather-location-input"
                                class="form-control form-control-sm border-0 shadow-none bg-transparent px-1"
                                placeholder="Enter city..." style="width: 110px; font-size: 0.85rem;">
                            <button id="weather-search-btn"
                                class="btn btn-sm btn-light rounded-circle p-1 ms-1 d-flex align-items-center justify-content-center text-secondary hover-primary"
                                style="width: 26px; height: 26px;">
                                <i class="bi bi-search" style="font-size: 0.75rem;"></i>
                            </button>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('books.list') }}" class="btn btn-primary fw-semibold px-4">Browse All Books</a>
                        @auth
                            <a href="{{ route('admin.dashboard') }}"
                                class="btn btn-outline-secondary fw-semibold px-4">Dashboard</a>
                        @else
                            <a href="{{ route('register') }}" class="btn btn-outline-secondary fw-semibold px-4">Sign Up
                                Free</a>
                        @endauth
                    </div>
                </div>
                <div class="col-lg-5 d-none d-lg-flex justify-content-center">
                    <div class="d-flex gap-3 flex-wrap justify-content-center">
                        @php $icons = ['bi-journal-bookmark','bi-book-half','bi-book','bi-journal-text']; @endphp
                        @foreach ($icons as $icon)
                            <div class="card border rounded-4 p-4 text-center"
                                style="width:110px;height:110px;display:flex;align-items:center;justify-content:center;">
                                <i class="bi {{ $icon }} text-primary" style="font-size:2.2rem;"></i>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if ($categories->isNotEmpty())
        <section class="py-5 border-bottom">
            <div class="container">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div>
                        <h2 class="fw-bold mb-1 h5" style="letter-spacing:-0.02em;">Browse by Category</h2>
                        <p class="text-secondary small mb-0">Find books in your favourite genre</p>
                    </div>
                    <a href="{{ route('books.list') }}" class="btn btn-sm btn-outline-primary fw-semibold">View All</a>
                </div>
                <div class="row g-3">
                    @foreach ($categories as $cat)
                        <div class="col-6 col-md-4 col-lg-3">
                            <a href="{{ route('books.list', ['category' => $cat->id]) }}" class="text-decoration-none">
                                <div class="card border rounded-4 p-3 h-100 text-center" style="transition:all 0.2s;"
                                    onmouseover="this.style.borderColor='#0d6efd';this.style.transform='translateY(-2px)'"
                                    onmouseout="this.style.borderColor='';this.style.transform=''">
                                    <div class="mb-2">
                                        <span
                                            class="bg-primary bg-opacity-10 rounded-3 d-inline-flex align-items-center justify-content-center"
                                            style="width:44px;height:44px;">
                                            <i class="bi bi-bookmark-fill text-primary"></i>
                                        </span>
                                    </div>
                                    <div class="fw-semibold small">{{ $cat->name }}</div>
                                    <div class="text-secondary" style="font-size:0.78rem;">{{ $cat->books_count }}
                                        {{ Str::plural('book', $cat->books_count) }}</div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if ($books->isNotEmpty())
        <section class="py-5">
            <div class="container">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div>
                        <h2 class="fw-bold mb-1 h5" style="letter-spacing:-0.02em;">Latest Books</h2>
                        <p class="text-secondary small mb-0">Newly added to our collection</p>
                    </div>
                    <a href="{{ route('books.list') }}" class="btn btn-sm btn-outline-primary fw-semibold">See All</a>
                </div>
                <div class="row g-4">
                    @foreach ($books as $book)
                        <div class="col-6 col-md-4 col-lg-3">
                            <div class="card border rounded-4 h-100 overflow-hidden" style="transition:box-shadow 0.2s;"
                                onmouseover="this.style.boxShadow='0 6px 24px rgba(13,110,253,.1)'"
                                onmouseout="this.style.boxShadow=''">
                                <div
                                    style="height:180px;background:#eff6ff;display:flex;align-items:center;justify-content:center;overflow:hidden;">
                                    @if ($book->image)
                                        <img src="{{ asset('assets/books/' . $book->image) }}" alt="{{ $book->title }}"
                                            style="width:100%;height:100%;object-fit:cover;">
                                    @else
                                        <i class="bi bi-book text-primary" style="font-size:3rem;"></i>
                                    @endif
                                </div>
                                <div class="card-body p-3">
                                    <p class="text-primary fw-bold text-uppercase mb-1"
                                        style="font-size:0.7rem;letter-spacing:0.08em;">
                                        {{ $book->category->name ?? '—' }}
                                    </p>
                                    <h6 class="fw-bold mb-1 lh-sm" style="letter-spacing:-0.01em;">{{ $book->title }}</h6>
                                    <p class="text-secondary mb-2" style="font-size:0.8rem;">by {{ $book->author }}</p>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <span class="fw-bold text-dark">₹{{ number_format($book->price, 2) }}</span>
                                        @if ($book->quantity > 0)
                                            <span class="badge bg-success bg-opacity-10 text-success rounded-pill"
                                                style="font-size:0.68rem;">In stock</span>
                                        @else
                                            <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill"
                                                style="font-size:0.68rem;">Out of stock</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="card-footer bg-white border-top p-3 pt-0">
                                    <a href="{{ route('books.show', $book->id) }}"
                                        class="btn btn-outline-primary btn-sm w-100 fw-semibold rounded-3">View Details</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const tempEl = document.getElementById('weather-temp');
            const descEl = document.getElementById('weather-desc');
            const iconEl = document.getElementById('weather-icon');
            const inputEl = document.getElementById('weather-location-input');
            const searchBtn = document.getElementById('weather-search-btn');

            const fetchWeather = async (lat, lon, locationName = 'Local') => {
                try {
                    tempEl.innerText = '...';
                    const url =
                        `https://api.open-meteo.com/v1/forecast?latitude=${lat}&longitude=${lon}&current=temperature_2m,weather_code`;
                    const res = await fetch(url);
                    const data = await res.json();

                    if (data && data.current) {
                        const temp = Math.round(data.current.temperature_2m);
                        const code = data.current.weather_code;

                        let icon = '<i class="bi bi-cloud-sun text-secondary"></i>';
                        let desc = 'Clear';

                        if (code === 0) {
                            desc = 'Clear Sky';
                            icon = '<i class="bi bi-sun text-warning"></i>';
                        } else if (code >= 1 && code <= 3) {
                            desc = 'Partly Cloudy';
                            icon = '<i class="bi bi-cloud-sun text-secondary"></i>';
                        } else if (code >= 45 && code <= 48) {
                            desc = 'Foggy';
                            icon = '<i class="bi bi-cloud-fog text-secondary"></i>';
                        } else if (code >= 51 && code <= 67) {
                            desc = 'Rain';
                            icon = '<i class="bi bi-cloud-rain text-primary"></i>';
                        } else if (code >= 71 && code <= 77) {
                            desc = 'Snow';
                            icon = '<i class="bi bi-cloud-snow text-info"></i>';
                        } else if (code >= 80 && code <= 82) {
                            desc = 'Showers';
                            icon = '<i class="bi bi-cloud-drizzle text-primary"></i>';
                        } else if (code >= 95) {
                            desc = 'Thunderstorm';
                            icon = '<i class="bi bi-cloud-lightning-rain text-dark"></i>';
                        }

                        tempEl.innerText = `${temp}°C`;
                        descEl.innerText = `${locationName} • ${desc}`;
                        iconEl.innerHTML = icon;
                        inputEl.value = '';
                    }
                } catch (err) {
                    descEl.innerText = 'Failed to load';
                    console.error("Weather fetch failed", err);
                }
            };

            const searchCity = async () => {
                const city = inputEl.value.trim();
                if (!city) return;

                try {
                    descEl.innerText = 'Searching...';
                    iconEl.innerHTML =
                        '<div class="spinner-border spinner-border-sm text-secondary" role="status"></div>';
                    const geoRes = await fetch(
                        `https://geocoding-api.open-meteo.com/v1/search?name=${encodeURIComponent(city)}&count=1&language=en&format=json`
                    );
                    const geoData = await geoRes.json();

                    if (geoData.results && geoData.results.length > 0) {
                        const location = geoData.results[0];
                        await fetchWeather(location.latitude, location.longitude, location.name);
                    } else {
                        descEl.innerText = 'City not found';
                        iconEl.innerHTML = '<i class="bi bi-question-circle text-secondary"></i>';
                    }
                } catch (err) {
                    descEl.innerText = 'Search failed';
                    iconEl.innerHTML = '<i class="bi bi-exclamation-circle text-danger"></i>';
                }
            };

            searchBtn.addEventListener('click', searchCity);
            inputEl.addEventListener('keypress', (e) => {
                if (e.key === 'Enter') searchCity();
            });
            if ("geolocation" in navigator) {
                navigator.geolocation.getCurrentPosition(
                    (position) => fetchWeather(position.coords.latitude, position.coords.longitude),
                    (error) => {
                        descEl.innerText = 'Enter city manually.';
                        iconEl.innerHTML = '<i class="bi bi-geo-alt text-secondary"></i>';
                    }
                );
            } else {
                descEl.innerText = 'Enter city manually.';
            }
        });
    </script>
@endpush
