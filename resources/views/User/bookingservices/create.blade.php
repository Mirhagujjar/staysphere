@extends('user.layout.master')

@section('content')
<div class="container my-5">
    <h2 class="mb-4">Request a Service</h2>

    <form action="{{ route('services.submit') }}" method="POST">
        @csrf

        <!-- Name -->
        <div class="mb-3">
            <label class="form-label">Full Name</label>
            <input type="text" name="name" class="form-control" placeholder="Enter your full name" required>
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}" readonly required>
        </div>

        <!-- Phone -->
        <div class="mb-3">
            <label class="form-label">Phone Number</label>
            <input type="tel" name="phone" class="form-control" placeholder="e.g. 0300-1234567" required>
        </div>

        <!-- Room Number -->
        <div class="mb-3">
            <label class="form-label">Room Number</label>
            <input type="text" name="room_number" class="form-control" placeholder="Your room number" required>
        </div>

        <!-- Service Dropdown -->
        <div class="mb-3">
            <label class="form-label">Select Service</label>
            <select name="service_id" class="form-select" required>
                <option value="">-- Select a Service --</option>
                @foreach($services as $service)
                    <option value="{{ $service->id }}">{{ $service->title }}</option>
                @endforeach
            </select>
        </div>

        <!-- Notes -->
        <div class="mb-3">
            <label class="form-label">Additional Notes (Optional)</label>
            <textarea name="notes" class="form-control" rows="3" placeholder="Any special instructions?"></textarea>
        </div>

        <button type="submit" class="btn btn-warning">Submit Request</button>
    </form>
</div>
@endsection
