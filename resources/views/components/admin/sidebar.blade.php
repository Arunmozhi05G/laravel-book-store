@php
    $sidebars = [
        'user' => [
            'name' => 'Users',
            'icon' => 'bi-people',
            'url' => route('admin.users.index'),
            'count' => \App\Models\User::where('role', '!=', 1)->count() ?? 0,
        ],
        'category' => [
            'name' => 'Categories',
            'icon' => 'bi-grid',
            'url' => route('admin.categories.index'),
            'count' => \App\Models\Category::count() ?? 0,
        ],
        'book' => [
            'name' => 'Books',
            'icon' => 'bi-book',
            'url' => route('admin.books.index'),
            'count' => \App\Models\Book::count() ?? 0,
        ],
    ];
@endphp
<aside id="sidebar" class="bg-white border-end d-flex flex-column">
    <div class="d-flex align-items-center gap-2 px-3 border-bottom" style="height:64px;">
        <a href="{{ route('admin.dashboard') }}" class="text-primary text-decoration-none fw-bold fs-6">Laravel Book
            Store</a>
    </div>

    <nav class="flex-grow-1 overflow-auto p-2">
        @foreach ($sidebars as $key => $sidebar)
            <a href="{{ $sidebar['url'] ?? '#' }}" class="sidebar-link mb-1">
                <i class="bi {{ $sidebar['icon'] }}"></i> {{ $sidebar['name'] }}
                @if (!empty($sidebar['count']) && $sidebar['count'] > 0)
                    <span class="badge bg-primary ms-auto rounded-pill"
                        style="font-size:0.7rem;">{{ $sidebar['count'] }}</span>
                @endif
            </a>
        @endforeach
    </nav>
    <div class="border-top p-3">
        <div class="d-flex align-items-center gap-2">
            <div class="avatar">{{ auth()->check() ? strtoupper(substr(auth()->user()->name, 0, 2)) : 'AD' }}</div>
            <div class="overflow-hidden">
                <div class="fw-semibold small text-truncate">{{ auth()->user()->name ?? 'Admin User' }}</div>
            </div>
        </div>
    </div>
</aside>
