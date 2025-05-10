@extends('admin.includes.super')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Registered Admins</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped shadow-sm">
            <thead class="table-dark">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @forelse($admins as $admin)
                    <tr>
                        <td>{{ $admin->name }}</td>
                        <td>{{ $admin->email }}</td>
                        <td>{{ $admin->created_at->diffForHumans() }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">No admins found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Optional Pagination --}}
    @if(method_exists($admins, 'links'))
        <div class="mt-3">
            {{ $admins->links() }}
        </div>
    @endif
</div>
@endsection
