{{-- Topbar --}}
<header id="topbar" class="bg-white border-bottom position-fixed top-0 end-0 d-flex align-items-center px-4 gap-3">
    <button class="btn btn-sm btn-outline-secondary d-lg-none border-0"
        onclick="document.getElementById('sidebar').classList.toggle('show')">
        <i class="bi bi-list fs-5"></i>
    </button>

    <div class="ms-auto d-flex align-items-center gap-2">
        <div class="dropdown">
            <div class="avatar" role="button" data-bs-toggle="dropdown" data-bs-offset="0,8">
                {{ auth()->check() ? strtoupper(substr(auth()->user()->name, 0, 2)) : 'AD' }}
            </div>
            <ul class="dropdown-menu dropdown-menu-end shadow-sm border rounded-3" style="min-width:200px;">
                <li class="px-3 py-2 border-bottom">
                    <div class="fw-semibold small">{{ auth()->user()->name ?? 'Admin User' }}</div>
                    <div class="text-secondary" style="font-size:0.775rem;">
                        {{ auth()->user()->email ?? 'admin@example.com' }}</div>
                </li>
                <li>
                    <a class="dropdown-item small py-2 d-flex align-items-center gap-2 text-danger"
                        heref="{{ route('logout') }}">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</header>
