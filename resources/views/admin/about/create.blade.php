@extends('admin.dashboard')

@section('content')
<div class="container">
    <h1>Add About Us</h1>
    <form action="{{ route('admin.about.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label>Title</label>
        <input type="text" name="title" required>

        <label>Description</label>
        <textarea name="description" required></textarea>

        <label>Image</label>
        <input type="file" name="image">

        <button type="submit">Save</button>
    </form>
</div>
@endsection
