@extends('layout.admin')

@push('styles')
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css" rel="stylesheet">
    <style>
        #categoryTable thead th {
            font-size: 0.72rem;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            color: #6c757d;
            font-weight: 600;
            border-bottom: 1px solid #dee2e6;
            padding: 12px 16px;
            white-space: nowrap;
        }

        #categoryTable tbody td {
            padding: 12px 16px;
            vertical-align: middle;
            font-size: 0.875rem;
        }

        #categoryTable tbody tr:hover {
            background-color: #f8f9fa;
        }

        .btn-action {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            border-radius: 8px;
            border: 1px solid #dee2e6;
            background: #fff;
            color: #495057;
            text-decoration: none;
            transition: all 0.15s;
            font-size: 0.85rem;
            cursor: pointer;
        }

        .btn-action:hover {
            background: #f1f3f5;
            border-color: #adb5bd;
            color: #212529;
        }

        .btn-action.del {
            color: #dc3545;
            border-color: #f5c2c7;
        }

        .btn-action.del:hover {
            background: #fff5f5;
            border-color: #dc3545;
        }

        /* DataTables custom styling */
        div.dataTables_wrapper div.dataTables_filter input {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 6px 12px;
            font-size: 0.875rem;
            outline: none;
            margin-left: 6px;
        }

        div.dataTables_wrapper div.dataTables_filter input:focus {
            border-color: #86b7fe;
            box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.1);
        }

        div.dataTables_wrapper div.dataTables_length select {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 5px 10px;
            font-size: 0.875rem;
            margin: 0 4px;
        }

        div.dataTables_wrapper div.dataTables_info {
            font-size: 0.8rem;
            color: #6c757d;
            padding-top: 8px;
        }

        div.dataTables_wrapper div.dataTables_paginate {
            padding-top: 4px;
        }

        div.dataTables_wrapper div.dataTables_paginate ul.pagination {
            margin: 0;
            gap: 4px;
        }

        div.dataTables_wrapper div.dataTables_paginate ul.pagination .page-link {
            border-radius: 8px !important;
            font-size: 0.8rem;
            padding: 5px 10px;
            border-color: #dee2e6;
            color: #495057;
        }

        div.dataTables_wrapper div.dataTables_paginate ul.pagination .page-item.active .page-link {
            background-color: #0d6efd;
            border-color: #0d6efd;
            color: #fff;
        }

        .dt-top-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
            padding: 16px 20px;
            border-bottom: 1px solid #dee2e6;
        }

        .dt-bottom-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
            padding: 12px 20px;
        }

        @media (max-width: 576px) {

            .dt-top-bar,
            .dt-bottom-bar {
                flex-direction: column;
                align-items: flex-start;
            }

            #categoryTable tbody td {
                font-size: 0.8rem;
                padding: 10px 12px;
            }
        }
    </style>
@endpush

@section('content')
    <div class="p-3 p-md-4">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-4">
            <div>
                <h1 class="fw-bold mb-0 h5" style="letter-spacing:-0.02em;">Categories</h1>
            </div>
            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary fw-semibold px-3">
                <i class="bi bi-plus-lg me-1"></i> Add Category
            </a>
        </div>
        @if (session('status'))
            <div class="alert alert-success d-flex align-items-center gap-2 rounded-3 small mb-4 border-0"
                style="background:#f0fdf4;color:#166534;">
                <i class="bi bi-check-circle-fill"></i> {{ session('status') }}
            </div>
        @endif
        <div class="card border rounded-4 overflow-hidden shadow-sm">
            <div class="dt-top-bar">
                <span class="fw-semibold small">All Categories</span>
                <div class="d-flex align-items-center gap-2 flex-wrap" id="dt-controls-top"></div>
            </div>
            <div class="table-responsive">
                <table id="categoryTable" class="table table-hover align-middle mb-0 w-100">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4" style="width:60px;">S No</th>
                            <th>Category Name</th>
                            <th style="width:120px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $key => $category)
                            <tr>
                                <td class="ps-4 text-secondary">{{ $key + 1 }}</td>
                                <td class="fw-medium">{{ $category->name }}</td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('admin.categories.edit', $category) }}" class="btn-action"
                                            title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href="{{ route('admin.categories.destroy', $category) }}" class="btn-action"
                                            title="Delete Category"
                                            onclick="return confirm('This will permanently delete the category. Continue?')">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="dt-bottom-bar">
                <div id="dt-info" class="text-secondary" style="font-size:0.8rem;"></div>
                <div id="dt-pagination"></div>
            </div>
        </div>
    </div>
    <form id="deleteForm" method="POST" style="display:none;">
        @csrf
        @method('DELETE')
    </form>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {

            const table = $('#categoryTable').DataTable({
                pageLength: 10,
                responsive: true,
                lengthChange: true,
                autoWidth: false,
                ordering: true,
                dom: 'rt', // only render table + pagination internally; we control rest
                language: {
                    search: "Search:",
                    lengthMenu: "Show _MENU_ entries",
                    info: "Showing _START_ to _END_ of _TOTAL_ categories",
                    paginate: {
                        previous: "Prev",
                        next: "Next"
                    }
                }
            });

            // Move search into our custom top bar
            const searchInput = $('<input>', {
                type: 'text',
                class: 'form-control form-control-sm',
                placeholder: 'Search categories...',
                style: 'width:220px; border-radius:8px; font-size:0.85rem;'
            });
            searchInput.on('keyup', function() {
                table.search(this.value).draw();
            });

            // Move length select into top bar
            const lengthSelect = $('<select>', {
                class: 'form-select form-select-sm',
                style: 'width:auto; border-radius:8px; font-size:0.85rem;'
            });
            [10, 25, 50, 100].forEach(val => {
                lengthSelect.append(`<option value="${val}">${val} per page</option>`);
            });
            lengthSelect.on('change', function() {
                table.page.len(+this.value).draw();
            });

            $('#dt-controls-top').append(lengthSelect).append(searchInput);

            // Render info and pagination into bottom bar
            function updateBottomBar() {
                const info = table.page.info();
                const start = info.recordsDisplay === 0 ? 0 : info.start + 1;
                $('#dt-info').text(
                    `Showing ${start}–${info.end} of ${info.recordsDisplay} categories`
                );

                const totalPages = info.pages;
                const currentPage = info.page;
                let paginationHtml = '<ul class="pagination pagination-sm mb-0" style="gap:4px;">';

                paginationHtml +=
                    `<li class="page-item ${currentPage === 0 ? 'disabled' : ''}">
                    <a class="page-link" href="#" data-page="${currentPage - 1}" style="border-radius:8px;">Prev</a></li>`;

                for (let i = 0; i < totalPages; i++) {
                    paginationHtml += `<li class="page-item ${i === currentPage ? 'active' : ''}">
                        <a class="page-link" href="#" data-page="${i}" style="border-radius:8px;">${i + 1}</a></li>`;
                }

                paginationHtml +=
                    `<li class="page-item ${currentPage === totalPages - 1 || totalPages === 0 ? 'disabled' : ''}">
                    <a class="page-link" href="#" data-page="${currentPage + 1}" style="border-radius:8px;">Next</a></li>`;

                paginationHtml += '</ul>';
                $('#dt-pagination').html(paginationHtml);
            }

            table.on('draw', updateBottomBar);
            updateBottomBar();

            // Pagination click
            $(document).on('click', '#dt-pagination .page-link', function(e) {
                e.preventDefault();
                const page = $(this).data('page');
                if (page >= 0 && page < table.page.info().pages) {
                    table.page(page).draw('page');
                }
            });
        });
    </script>
@endpush
