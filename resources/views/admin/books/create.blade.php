@extends('layout.admin')

@section('content')
    <div class="p-4">

        {{-- Breadcrumb --}}
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb small mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"
                        class="text-primary text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#" class="text-primary text-decoration-none">Books</a>
                </li>
                <li class="breadcrumb-item active text-secondary">New Books
                </li>
            </ol>
        </nav>

        <form method="POST" action="{{ route('admin.books.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row g-4">
                <div class="col-lg-12">
                    <div class="card border rounded-4 p-4 mb-4">
                        <h6 class="fw-bold mb-3 pb-3 border-bottom" style="letter-spacing:-0.01em;">Book
                            Information</h6>

                        <div class="mb-3">
                            <label class="form-label fw-semibold small" for="title">
                                Title <span class="text-danger">*</span>
                            </label>
                            <input type="text" id="title" name="title"
                                class="form-control rounded-3 @error('title') is-invalid @enderror"
                                value="{{ old('title') }}" placeholder="e.g. Testing, Develop, Programming" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold small" for="category_id">
                                Category <span class="text-danger">*</span>
                            </label>
                            <select id="category_id" name="category_id"
                                class="form-select rounded-3 @error('category_id') is-invalid @enderror" required>
                                <option value="" disabled selected>Select a category</option>
                                @foreach ($categories ?? [] as $cat)
                                    <option value="{{ $cat->id }}"
                                        {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold small" for="description">
                                Description <span class="text-danger">*</span>
                            </label>
                            <textarea id="description" name="description" rows="5"
                                class="form-control rounded-3 @error('description') is-invalid @enderror"
                                placeholder="Describe the book in detail...">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold small" for="author">
                                Author<span class="text-danger">*</span>
                            </label>
                            <input type="text" id="author" name="author"
                                class="form-control rounded-3 @error('author') is-invalid @enderror"
                                value="{{ old('author') }}" placeholder="e.g. William Shakespeare, Charles Dickens" required>
                            @error('author')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-sm-6">
                                <label class="form-label fw-semibold small" for="price">
                                    Price (₹) <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white">₹</span>
                                    <input type="number" id="price" name="price" step="0.01" min="0"
                                        class="form-control rounded-end-3 @error('price') is-invalid @enderror"
                                        value="{{ old('price') }}" placeholder="0.00" required>
                                </div>
                                @error('price')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label fw-semibold small" for="quentity">
                                    Quentity
                                </label>
                                <div class="input-group">
                                    <input type="number" id="quantity" name="quantity" step="1" min="0"
                                        class="form-control rounded-end-3 @error('quantity') is-invalid @enderror"
                                        value="{{ old('quantity') }}" placeholder="1...">
                                </div>
                                @error('quantity')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <h6 class="fw-bold mb-3 pb-3 border-bottom" style="letter-spacing:-0.01em;">Book Image
                            </h6>
                            <div class="upload-area" id="upload-area" onclick="document.getElementById('image').click()">
                                <img id="preview"
                                    style="max-height:180px;object-fit:contain;border-radius:8px;display:none;"
                                    alt="Preview">
                                <div id="upload-placeholder">
                                    <i class="bi bi-cloud-upload fs-2 text-secondary d-block mb-2"></i>
                                    <div class="fw-semibold small">Click to upload or drag & drop</div>
                                    <div class="text-secondary small mt-1">PNG, JPG, WEBP up to 2MB</div>
                                </div>
                            </div>
                            <input type="file" id="image" name="image" accept="image/*"
                                class="d-none @error('image') is-invalid @enderror" onchange="previewImage(event)">
                            @error('image')
                                <div class="text-danger small mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@push('scripts')
    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = e => {
                const p = document.getElementById('preview');
                p.src = e.target.result;
                p.style.display = 'block';
                document.getElementById('upload-placeholder').style.display = 'none';
            };
            reader.readAsDataURL(file);
        }
        const area = document.getElementById('upload-area');
        area.addEventListener('dragover', e => {
            e.preventDefault();
            area.classList.add('dragover');
        });
        area.addEventListener('dragleave', () => area.classList.remove('dragover'));
        area.addEventListener('drop', e => {
            e.preventDefault();
            area.classList.remove('dragover');
            const file = e.dataTransfer.files[0];
            if (file) {
                const dt = new DataTransfer();
                dt.items.add(file);
                document.getElementById('image').files = dt.files;
                previewImage({
                    target: {
                        files: [file]
                    }
                });
            }
        });
    </script>
@endpush
