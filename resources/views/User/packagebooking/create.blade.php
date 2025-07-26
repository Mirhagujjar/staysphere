@extends('user.layout.master')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Book a Package</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('user.book.package') }}" method="POST">
        @csrf
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="user_name" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="user_name" name="user_name" required>
            </div>
            <div class="col-md-6">
                <label for="user_email" class="form-label">Email</label>
                <input type="email" class="form-control" id="user_email" name="user_email" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="user_phone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="user_phone" name="user_phone" required>
        </div>

        <div class="mb-3">
            <label for="package_id" class="form-label">Select Package</label>
            <select name="package_id" id="package_id" class="form-select" required>
                <option value="" disabled selected>Select a package</option>
                @foreach($packages as $package)
                    <option value="{{ $package->id }}">{{ $package->name }} (PKR {{ $package->price }}/night)</option>
                @endforeach
            </select>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="check_in" class="form-label">Check-in Date</label>
                <input type="date" class="form-control" id="check_in" name="check_in" min="{{ \Carbon\Carbon::today()->toDateString() }}" required>
            </div>
            <div class="col-md-6">
                <label for="check_out" class="form-label">Check-out Date</label>
                <input type="date" class="form-control" id="check_out" name="check_out" min="{{ \Carbon\Carbon::today()->toDateString() }}" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="payment_method" class="form-label">Payment Method</label>
            <select name="payment_method" class="form-select" required>
                <option value="Pay at Arrival">Pay at Arrival</option>
                <option value="Online Payment">Online Payment</option>
                <option value="Partial Payment">Partial Payment</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="special_requests" class="form-label">Special Requests</label>
            <textarea name="special_requests" id="special_requests" class="form-control" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit Booking</button>
    </form>
</div>
@endsection
