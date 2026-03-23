@extends('layout.admin')

@section('content')
    <div class="p-4">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-4">
            <div>
                <h1 class="fw-bold mb-1 h5" style="letter-spacing:-0.02em;">
                    Dashboard
                </h1>
            </div>
        </div>
        <div class="row g-3 mb-4">
            <div class="col-6 col-xl-3">
                <div class="card border rounded-4 p-3 h-100">
                    <div class="stat-icon bg-primary bg-opacity-10 mb-3">
                        <i class="bi bi-people text-primary"></i>
                    </div>
                    <div class="text-secondary small fw-medium mb-1">Users</div>
                    <div class="fw-bold fs-4" style="letter-spacing:-0.02em;">{{ $users->count() }}</div>
                </div>
            </div>
            <div class="col-6 col-xl-3">
                <div class="card border rounded-4 p-3 h-100">
                    <div class="stat-icon bg-success bg-opacity-10 mb-3">
                        <i class="bi bi-grid text-success"></i>
                    </div>
                    <div class="text-secondary small fw-medium mb-1">Categeories</div>
                    <div class="fw-bold fs-4" style="letter-spacing:-0.02em;">{{ $categories->count() }}</div>
                </div>
            </div>
            <div class="col-6 col-xl-3">
                <div class="card border rounded-4 p-3 h-100">
                    <div class="stat-icon bg-warning bg-opacity-10 mb-3">
                        <i class="bi bi-book text-warning"></i>
                    </div>
                    <div class="text-secondary small fw-medium mb-1">Books</div>
                    <div class="fw-bold fs-4" style="letter-spacing:-0.02em;">{{ $books->count() }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
