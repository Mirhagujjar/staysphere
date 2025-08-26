@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header d-flex flex-wrap justify-content-between align-items-center">
            <h4 class="mb-2 mb-md-0">
                <i class="fas fa-users me-2"></i> Group Reservation #{{ $group->id }}
            </h4>
            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>

        <div class="card-body">
            <h5>Group Information</h5>
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Name:</strong> {{ $group->name }}</p>
                    <p><strong>Email:</strong> {{ $group->email }}</p>
                    <p><strong>Phone:</strong> {{ $group->phone }}</p>
                    <p><strong>Total Guests:</strong> {{ $group->guests }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Room type:</strong> {{ $group->room_type }}</p>
                    <p><strong>Check-in:</strong> {{ $group->check_in->format('M d, Y') }}</p>
                    <p><strong>Check-out:</strong> {{ $group->check_out->format('M d, Y') }}</p>
                    <p><strong>Status:</strong> {{ ucfirst($group->status) }}</p>
                </div>
            </div>

            <hr>

            <h5>Rooms in this Group</h5>
            <div class="row">
                @foreach($group->children as $child)
                <div class="col-12 col-sm-6 col-lg-4 mb-3">
                    <div class="card h-100">
                        <div class="room-img-container mb-2 rounded">
                            <img src="{{ asset($child->room->image) }}" class="room-img img-fluid rounded" alt="Room">
                        </div>
                        <div class="card-body">
                            <h6>{{ $child->room_type }}</h6>
                            <p><strong>Guests:</strong> {{ $child->guests }}</p>
                            <p><strong>Price:</strong> {{ $child->room->price }}</p>

                            <p><strong>Check-in:</strong> {{ $child->check_in->format('M d, Y') }}</p>
                            <p><strong>Check-out:</strong> {{ $child->check_out->format('M d, Y') }}</p>
                            <p><strong>Status:</strong> {{ ucfirst($child->status) }}</p>
                            @if($child->room)
                                <p><strong>Assigned Room:</strong> {{ $child->room->room_name }}</p>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </div>
</div>
@endsection
