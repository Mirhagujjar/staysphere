@extends('admin.dashboard')

@section('content')
<div class="container mt-5">
    <h2>Edit Booking Package</h2>

    <form action="{{ route('bookingspackages.update', $booking->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Package Name</label>
            <input type="text" name="package_name" class="form-control" value="{{ $booking->package_name }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Package Price (PKR)</label>
            <input type="number" name="price" class="form-control" value="{{ $booking->price }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-control">
                <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Package Image</label>
            <input type="file" name="image" class="form-control">
            @if($booking->image)
                <img src="{{ asset('storage/room_images'. $booking->image) }}" width="100" class="mt-2">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Update Booking</button>
        <a href="{{ route('admin.bookingspackages.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
