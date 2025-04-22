@extends('admin.dashboard')
@section('content')
<div class="container">
    <h2>Create Header</h2>
    <form action="{{ route('admin.header.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label>Header Image</label>
            <input type="file" name="image" class="form-control" required>
        </div>
        <button class="btn btn-primary">Create</button>
    </form>
</div>
@endsection
