@extends('admin.dashboard')

@section('content')
<div class="container">
    <h1>About Us</h1>
    <a href="{{ route('admin.about.create') }}" class="btn btn-primary">Add New</a>
    <a href="{{ route('admin.about.edit') }}" class="btn btn-warning">Edit</a>
    <form action="{{ route('admin.about.delete') }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
    <h2>{{ $about->title }}</h2>
    <p>{{ $about->description }}</p>
    @if ($about->image)
        <img src="{{ asset('storage/' . $about->image) }}" alt="About Us" width="300">
    @endif
</div>
@endsection
