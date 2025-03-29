@extends('admin.dashboard')



@section('content')
<div class="container">
    <h1>Add New About Us</h1>

    <form action="{{ route('admin.about.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="5" required></textarea>
        </div>

        <button type="submit" class="btn btn-success">Save</button>
    </form>
</div>
@endsection


