@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-warning text-white">
                    <h4 class="mb-0">Your Profile</h4>
                </div>

                <div class="card-body">
                    <div class="mb-4">
                        <h5 class="text-primary mb-3">Basic Information</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label"><strong>Name:</strong></label>
                                <p>{{ auth()->user()->name }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label"><strong>Email:</strong></label>
                                <p>{{ auth()->user()->email }}</p>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><strong>Profile Image:</strong></label><br>
                            @if(auth()->user()->profile_image)
                                <img src="{{ asset('assets/profile_images/' . auth()->user()->profile_image) }}" 
                                     class="rounded-circle border" width="100" height="100">
                            @else
                                <p>No profile image uploaded.</p>
                            @endif
                        </div>
                    </div>









                <h4>Your Bookings</h4>

                @if($reservations->isEmpty())
                    <p>You have no bookings yet.</p>
                @else
                    <ul class="list-group">
                        @foreach ($reservations as $reservation)
                            <li class="list-group-item">
                                <strong>{{ $reservation->room->title ?? 'Room #' . $reservation->room_id }}</strong><br>
                                Check-in: {{ $reservation->check_in }} | Check-out: {{ $reservation->check_out }}<br>
                                Guests: {{ $reservation->guests }} | Status: {{ ucfirst($reservation->status) }}
                            </li>
                        @endforeach
                    </ul>
                @endif
          









                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('user.profile.edit') }}" class="btn btn-warning px-4">
                            <i class="fas fa-edit me-2"></i>Edit Profile
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
