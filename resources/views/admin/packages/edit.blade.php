@extends('admin.dashboard')

@section('content')
<div class="container">
    <h2>Edit Package</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.package.update', $package->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Package Name</label>
            <input type="text" name="name" class="form-control" value="{{ $package->name }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" required>{{ $package->description }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Package Price (PKR)</label>
            <input type="number" name="price" class="form-control" value="{{ $package->price }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Regular Price (PKR)</label>
            <input type="number" name="regular_price" class="form-control" value="{{ $package->regular_price }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Package Image</label>
            <input type="file" name="image" class="form-control">
            <img src="{{ asset('storage/room_images'. $package->image) }}" width="150" class="mt-2">
        </div>

        <button type="submit" class="btn btn-success">Update Package</button>
    </form>
</div>
@endsection
