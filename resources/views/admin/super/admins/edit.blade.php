@extends('layouts.admin')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Edit Admin</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('admin.superadmin.update', $admin->id) }}" method="POST" class="shadow p-4 rounded bg-light">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" name="name" value="{{ old('name', $admin->name) }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" name="email" value="{{ old('email', $admin->email) }}" class="form-control" required>
            </div>

            {{-- Optional: Allow updating password --}}
            {{-- <div class="mb-3">
                <label for="password" class="form-label">New Password (optional):</label>
                <input type="password" name="password" class="form-control">
            </div> --}}

            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.superadmin.list') }}" class="btn btn-secondary">Back</a>
                <button type="submit" class="btn btn-primary">Update Admin</button>
            </div>
        </form>
    </div>
@endsection
