@extends('layout.admin')

@section('content')
    <div class="p-4">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb small mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"
                        class="text-primary text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#" class="text-primary text-decoration-none">Categories</a>
                </li>
                <li class="breadcrumb-item active text-secondary">New Category
                </li>
            </ol>
        </nav>
        <form method="POST" action="{{ route('admin.categories.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row g-4">
                <div class="col-lg-12">
                    <div class="card border rounded-4 p-4 mb-4">
                        <h6 class="fw-bold mb-3 pb-3 border-bottom" style="letter-spacing:-0.01em;">Category
                        </h6>

                        <div class="mb-3">
                            <label class="form-label fw-semibold small" for="name">
                                Category Name <span class="text-danger">*</span>
                            </label>
                            <input type="text" id="name" name="name"
                                class="form-control rounded-3 @error('name') is-invalid @enderror"
                                value="{{ old('name') }}"
                                placeholder="e.g. Small Stories, Programming, Commics" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection