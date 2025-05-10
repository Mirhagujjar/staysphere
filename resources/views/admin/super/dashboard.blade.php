@extends('admin.includes.super')

@section('content')
<div class="container mt-4">
    <h1 class="mb-3">Welcome, Super Admin</h1>
    <p class="text-muted">You have full control over admin users.</p>

    <div class="d-flex justify-content-between align-items-center mb-4">
        {{-- <div>
            <a href="{{ route('admin.superadmin.list') }}" class="btn btn-primary">Manage Admins</a>
        </div> --}}
        <form action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
    </div>

    <h2>Admin List</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-striped shadow-sm">
            <thead class="table-dark">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th> <!-- New column -->
                </tr>
            </thead>
            <tbody>
                @forelse($admins as $admin)
                    <tr>
                        <td>{{ $admin->name }}</td>
                        <td>{{ $admin->email }}</td>
                        <td>
                            <!-- Edit Button -->
                            <a href="{{ route('admin.superadmin.edit', $admin->id) }}" class="btn btn-sm btn-warning">Edit</a>
        
                            <!-- Delete Button -->
                            <form action="{{ route('admin.superadmin.destroy', $admin->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure to delete this admin?')" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">No admins found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        
    </div>
</div>
@endsection
