@extends('admin.dashboard')

@section('content')
<div class="container mt-4">
    <h2>Edit Header</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.header.update', $headers->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" value="{{ $headers->title }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="4" required>{{ $headers->description }}</textarea>
        </div>

        <div class="mb-3">
            <label>Current Image</label><br>
            @if($headers->image)
                <img src="{{ asset('assets/' . $headers->image) }}" width="200" class="mb-2">
            @endif
            <input type="file" name="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Update Header</button>
    </form>
</div>
@endsection
