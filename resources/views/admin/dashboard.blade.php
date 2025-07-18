@extends('layouts.admin')

@section('content')
<style>
    .card {
        border-radius: 0.75rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        transition: transform 0.2s ease-in-out;
    }
    .card:hover {
        transform: translateY(-2px);
    }
    .card-title {
        font-weight: 600;
        color: #2d3748;
    }
    .btn {
        border-radius: 2rem;
        font-weight: 500;
        padding: 0.375rem 1.25rem;
    }
    .stat-value {
        font-size: 2.5rem;
        font-weight: 700;
        color: #4a5568;
    }
    .room-type-badge {
        border-radius: 0.5rem;
        background-color: #f7fafc;
        padding: 0.5rem;
        margin: 0.25rem 0;
    }
</style>

<div class="container-fluid py-4">
    <div class="row">

        <!-- Total Rooms Card -->
        <div class="col-12 col-xl-8 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="card-title mb-0">Room Inventory</h4>
                        <a href="{{ route('admin.rooms.index') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-cog mr-1"></i> Manage Rooms
                        </a>
                    </div>

                    <div class="d-flex align-items-center mb-4">
                        <div class="stat-value mr-3">{{ $totalRooms }}</div>
                        <div class="text-muted">Total Rooms Available</div>
                    </div>

                    <h5 class="mb-3">Room Type Distribution</h5>
                    <div class="row">
                        @foreach($typeWiseCounts as $type)
                            <div class="col-6 col-md-3 mb-2">
                                <div class="room-type-badge text-center">
                                    <div class="font-weight-bold text-primary">{{ ucfirst($type->roomType->label) }}</div>
                                    <div class="text-dark">{{ $type->total }} rooms</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Service Requests Card -->
        {{-- <div class="col-12 col-xl-4 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="card-title mb-0">Service Requests</h5>
                        <span class="badge badge-pill badge-{{ $totalServiceRequests > 0 ? 'warning' : 'success' }}">
                            {{ $totalServiceRequests }} pending
                        </span>
                    </div>

                    <div class="text-center py-4">
                        <div class="stat-value">{{ $totalServiceRequests }}</div>
                        <p class="text-muted mb-4">Total active requests</p>
                        <a href="{{ route('admin.service-requests.index') }}" class="btn btn-success">
                            <i class="fas fa-list mr-1"></i> View Requests
                        </a>
                    </div>

                    <div class="mt-auto pt-3 border-top">
                        <small class="text-muted">
                            <i class="fas fa-info-circle mr-1"></i> Includes all pending service requests
                        </small>
                    </div>
                </div>
            </div>
        </div> --}}

    </div>
</div>
@endsection
