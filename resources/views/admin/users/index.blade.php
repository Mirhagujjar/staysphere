@extends('admin.dashboard')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-semibold mb-0">User Management</h2>
        <div class="d-flex">
            <form action="{{ route('admin.users.index') }}" method="GET" class="d-flex    align-items-center">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control form-control-sm me-2" placeholder="Search users..." style="width: 200px;">

                <select name="status" class="form-select form-select-sm me-2" style="width: 140px;">
                    <option value="">All Status</option>
                    <option value="banned" {{ request('status') == 'banned' ? 'selected' : '' }}>Banned</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Not Banned</option>
                </select>

                <button type="submit" class="btn btn-sm btn-secondary me-2">Search</button>

                
            </form>

        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">#</th>
                            <th>User</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td class="ps-4">{{ $user->id }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-40 symbol-circle me-3">
                                        <span class="symbol-label bg-light-primary text-primary fw-semibold">
                                            {{ substr($user->name, 0, 1) }}
                                        </span>
                                    </div>
                                    <div>
                                        <span class="fw-semibold d-block">{{ $user->name }}</span>
                                        <span class="text-muted small">
                                            Member since {{ $user->created_at ? $user->created_at->format('M Y') : 'N/A' }}
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <span class="badge rounded-pill py-1 px-3 fs-8 bg-{{ $user->is_banned ? 'danger' : 'success' }}-light text-{{ $user->is_banned ? 'danger' : 'success' }}">
                                    <i class="fas fa-circle me-1 fs-6"></i>
                                    {{ $user->is_banned ? 'Banned' : 'Active' }}
                                </span>
                            </td>
                            <td class="text-end pe-4">
                                <div class="d-flex justify-content-end">
                                    <form action="{{ route('admin.users.ban', $user->id) }}" method="POST" class="me-2">
                                        @csrf
                                        <button class="btn btn-sm {{ $user->is_banned ? 'btn-success' : 'btn-danger' }}" type="submit">
                                            <i class="fas {{ $user->is_banned ? 'fa-unlock' : 'fa-ban' }} me-1"></i>
                                            {{ $user->is_banned ? 'Unban' : 'Ban' }}
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.users.delete', $user->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Permanently delete this user?')">
                                            <i class="fas fa-trash-alt me-1"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection