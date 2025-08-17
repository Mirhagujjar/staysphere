@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Create New Admin</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Please fix the following errors:
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.superadmin.store') }}" method="POST" class="p-4 border rounded shadow-sm bg-light">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input 
                type="text" 
                name="name" 
                class="form-control" 
                id="name" 
                value="{{ old('name') }}" 
                required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input 
                type="email" 
                name="email" 
                class="form-control" 
                id="email" 
                value="{{ old('email') }}" 
                required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input 
                type="password" 
                name="password" 
                class="form-control" 
                id="password" 
                required>
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input 
                type="password" 
                name="password_confirmation" 
                class="form-control" 
                id="password_confirmation" 
                required>
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
@endsection

