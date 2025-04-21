@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>Edit Carousel Item</h2>
    <form action="{{ route('admin.review.carousel.update', $carousel->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Title:</label>
            <input type="text" name="title" value="{{ $carousel->title }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Description:</label>
            <textarea name="description" class="form-control" required>{{ $carousel->description }}</textarea>
        </div>
        <div class="mb-3">
            <label>Current Image:</label><br>
            <img src="{{ asset('images/'.$carousel->image) }}" width="150">
        </div>
        <div class="mb-3">
            <label>Change Image (Optional):</label>
            <input type="file" name="image" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Update Carousel Item</button>
    </form>
</div>
@endsection
