@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <!-- Header and Breadcrumb -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4 gap-3">
        <div>
            <h2 class="fw-semibold mb-0 text-primary">
                <i class="fas fa-user-shield me-2"></i> Admin Management
            </h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb small">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Admins</li>
                </ol>
            </nav>
        </div>

        <!-- Search & Filter Form -->
        <div class="d-flex flex-column flex-md-row gap-2 w-100 w-md-auto">
            <form method="GET" action="{{ route('admin.superadmin.list') }}" class="d-flex flex-column flex-md-row gap-2 w-100">
                <div class="input-group input-group-sm shadow-sm">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="fas fa-search text-muted"></i>
                    </span>
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control border-start-0" placeholder="Search admins...">
                </div>

                <select name="status" class="form-select form-select-sm shadow-sm" style="min-width: 120px;">
                    <option value="">All Status</option>
                    <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Active</option>
                    <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Banned</option>
                </select>

                <button type="submit" class="btn btn-sm btn-outline-primary px-3 shadow-sm">
                    <i class="fas fa-filter me-1"></i> Filter
                </button>
            </form>

            <a href="{{ route('admin.superadmin.create') }}" class="btn btn-sm btn-success px-3 shadow-sm">
                <i class="fas fa-plus me-1"></i> Add Admin
            </a>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show shadow-sm border-0">
        <div class="d-flex align-items-center">
            <i class="fas fa-check-circle me-2"></i>
            <span>{{ session('success') }}</span>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    @endif

    <!-- Admins Table -->
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4" style="width: 80px;">ID</th>
                            <th>Admin</th>
                            <th>Contact</th>
                            <th style="width: 140px;">Registered</th>
                            <th style="width: 120px;">Status</th>
                            <th class="text-end pe-4" style="width: 220px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($admins as $admin)
                        <tr class="{{ $admin->is_banned ? 'bg-light' : '' }}">
                            <td class="ps-4 fw-semibold text-muted">#{{ $admin->id }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-40px symbol-circle me-3">
                                        <span class="symbol-label bg-primary bg-opacity-10 text-primary fw-bold">
                                            {{ strtoupper(substr($admin->name, 0, 1)) }}
                                        </span>
                                    </div>
                                    <div>
                                        <span class="fw-semibold d-block">{{ $admin->name }}</span>
                                        <small class="text-muted">{{ $admin->created_at->format('d M Y') }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="small">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-envelope text-muted me-2" style="width: 16px;"></i>
                                        <span>{{ $admin->email }}</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="small text-muted" data-bs-toggle="tooltip" title="{{ $admin->created_at->format('j F Y, g:i a') }}">
                                    {{ $admin->created_at->diffForHumans() }}
                                </span>
                            </td>
                            <td>
                                <span class="badge rounded-pill py-2 px-3 fs-8 bg-{{ $admin->is_banned ? 'danger' : 'success' }}-subtle text-{{ $admin->is_banned ? 'danger' : 'success' }}">
                                    <i class="fas fa-circle me-1" style="font-size: 8px; vertical-align: middle;"></i>
                                    {{ $admin->is_banned ? 'Banned' : 'Active' }}
                                </span>
                            </td>
                            <td class="text-end pe-4">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('admin.superadmin.edit', $admin->id) }}" class="btn btn-sm btn-outline-primary px-3" data-bs-toggle="tooltip" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{ route('admin.superadmin.toggleBan', $admin->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button class="btn btn-sm px-3 {{ $admin->is_banned ? 'btn-outline-success' : 'btn-outline-danger' }}" type="submit" data-bs-toggle="tooltip" title="{{ $admin->is_banned ? 'Unban' : 'Ban' }}">
                                            <i class="fas {{ $admin->is_banned ? 'fa-unlock' : 'fa-ban' }}"></i>
                                        </button>
                                    </form>

                                    <form action="{{ route('admin.superadmin.destroy', $admin->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger px-3" onclick="return confirm('Permanently delete this admin?')" data-bs-toggle="tooltip" title="Delete">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <div class="py-4">
                                    <i class="fas fa-user-slash fa-3x text-muted mb-4"></i>
                                    <h5 class="text-muted">No admins found</h5>
                                    <p class="text-muted small mb-3">Try adjusting your search or filter criteria.</p>
                                    <a href="{{ route('admin.superadmin.create') }}" class="btn btn-primary">
                                        <i class="fas fa-plus me-2"></i> Create New Admin
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    @if(method_exists($admins, 'links') && $admins->total() > 0)
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-4 gap-2">
            <div class="text-muted small">
                Showing {{ $admins->firstItem() }} to {{ $admins->lastItem() }} of {{ $admins->total() }} entries
            </div>
            <div>
                {{ $admins->withQueryString()->links('pagination::bootstrap-5') }}
            </div>
        </div>
    @endif
</div>


@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize Bootstrap tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(el => new bootstrap.Tooltip(el));
    });
</script>
@endpush




<style>

.page-item .page-link {
    border-radius: 6px;
    color: #0d6efd;
}

.page-item.active .page-link {
    background-color: #0d6efd;
    border-color: #0d6efd;
}
</style>

<!-- Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- DataTables Bootstrap 5 integration -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">

<!-- Required JS -->
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>

@endsection
