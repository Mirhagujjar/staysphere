@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>Edit Header</h2>
    <form action="{{ route('admin.review.header.update', $header->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Title:</label>
            <input type="text" name="title" value="{{ $header->title }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Description:</label>
            <textarea name="description" class="form-control" required>{{ $header->description }}</textarea>
        </div>
        <div class="mb-3">
            <label>Current Image:</label><br>
            <img src="{{ asset('images/'.$header->image) }}" width="150">
        </div>
        <div class="mb-3">
            <label>Change Image (Optional):</label>
            <input type="file" name="image" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Update Header</button>
    </form>
</div>
@endsection
