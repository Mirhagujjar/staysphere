@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>Add New Header</h2>
    <form action="{{ route('admin.review.header.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>Title:</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Description:</label>
            <textarea name="description" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label>Image:</label>
            <input type="file" name="image" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Header</button>
    </form>
</div>
@endsection
