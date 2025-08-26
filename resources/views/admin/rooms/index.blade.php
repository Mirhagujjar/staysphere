@extends('layouts.admin')

@section('content')

{{-- Success message --}}
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

{{-- General error message --}}
@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

{{-- Validation errors --}}
@if($errors->any())
    <div class="alert alert-danger">
        <strong>Please fix the following errors:</strong>
        <ul class="mb-0 mt-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-dark">Rooms Management</h1>
        <div class="btn-group">
            <a href="{{ route('admin.rooms.create') }}" class="btn btn-primary shadow-sm">
                <i class="fas fa-plus fa-sm"></i> Add New Room
            </a>
            <a href="{{ url('/rooms') }}" target="_blank" class="btn btn-outline-success shadow-sm">
                <i class="fas fa-eye fa-sm"></i> Preview Frontend
            </a>
        </div>
    </div>

    <!-- Hero Section Configuration -->
    <div class="card shadow mb-4">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold">Hero Section</h6>
            <i class="fas fa-image"></i>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.rooms.update-hero') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="font-weight-bold text-dark">Hero Title</label>
                        <input type="text" name="hero_title" class="form-control"
                            value="{{ $heroRoom->hero_title ?? old('hero_title') }}" required>
                        @error('hero_title')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="font-weight-bold text-dark">Hero Description</label>
                        <textarea name="hero_description" class="form-control" rows="2"
                            required>{{ $heroRoom->hero_description ?? old('hero_description') }}</textarea>
                        @error('hero_description')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="font-weight-bold text-dark">Hero Image</label>
                        <div class="custom-file">
                            <input type="file" name="hero_image" class="custom-file-input" id="heroImageUpload" accept="image/*">
                            <label class="custom-file-label" for="heroImageUpload">Choose file</label>
                        </div>
                        @error('hero_image')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror

                        @if(isset($heroRoom) && $heroRoom->hero_image)
                        <div class="mt-3 d-flex align-items-center">
                            <img src="{{ asset($heroRoom->hero_image) }}" class="img-thumbnail mr-3" style="max-height: 120px;">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remove_hero_image" id="removeHeroImage" value="1">
                                <label class="form-check-label text-dark" for="removeHeroImage">
                                    Remove current image
                                </label>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-save mr-2"></i> Save Settings
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Rooms List -->
    <div class="card shadow">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold">All Rooms</h6>
        </div>
        <div class="card-body">

            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span>&times;</span>
                </button>
            </div>
            @endif

            <!-- Filters & Search -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <form method="GET" action="{{ route('admin.rooms.index') }}">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Search rooms..." value="{{ request('search') }}">
                            <div class="input-group-append">
                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-6 text-md-right mt-2 mt-md-0">
                    <div class="btn-group">
                        <a href="{{ route('admin.rooms.index', ['status' => 'available']) }}" class="btn btn-sm {{ request('status') == 'available' ? 'btn-success' : 'btn-outline-success' }}">Available</a>
                        <a href="{{ route('admin.rooms.index', ['status' => 'booked']) }}" class="btn btn-sm {{ request('status') == 'booked' ? 'btn-danger' : 'btn-outline-danger' }}">Booked</a>
                        <a href="{{ route('admin.rooms.index') }}" class="btn btn-sm btn-outline-secondary">All</a>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-dark">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Room Name</th>
                            <th>Type</th>
                            <th>Price</th>
                            <th>Capacity</th>
                            <th>Availability</th>
                            <th>Features</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rooms as $room)
                        <tr>
                            <td>{{ $loop->iteration + ($rooms->currentPage() - 1) * $rooms->perPage() }}</td>
                            <td>
                                <img src="{{ asset($room->image) }}" alt="{{ $room->room_name }}" class="img-thumbnail" style="width: 80px; height: 60px; object-fit: cover;">
                            </td>
                            <td>
                                <strong>{{ $room->room_name }}</strong>
                                <small class="d-block text-muted">{{ $room->room_number }}</small>
                            </td>
                            <td>{{ $room->roomType->label }}</td>
                            <td><strong>Rs. {{ number_format($room->price) }}</strong><small class="d-block text-muted">/ night</small></td>
                            <td><span class="badge text-dark badge-info">{{ $room->room_capacity }} Persons</span></td>
                            <td>
                                @php
                                    $available = $room->total_quantity - $room->booked_quantity;
                                    $percentage = ($room->total_quantity > 0) ? ($available / $room->total_quantity) * 100 : 0;
                                @endphp

                                @if($available > 0)
                                    <div class="mb-1">
                                        <small><strong>{{ $available }}</strong> of {{ $room->total_quantity }} available</small>
                                    </div>
                                    {{-- <div class="progress" style="height: 18px;">
                                        <div class="progress-bar {{ $percentage < 30 ? 'bg-danger' : 'bg-success' }}" role="progressbar" style="width: {{ $percentage }}%">
                                            {{ round($percentage) }}%
                                        </div>
                                    </div> --}}
                                @else
                                    <span class="badge badge-danger text-dark">Fully Booked</span>
                                    <small class="d-block text-muted">0 of {{ $room->total_quantity }}</small>
                                @endif
                            </td>

                            <td>
                                @forelse($room->filterOptions->take(3) as $option)
                                <span class="badge text-dark badge-secondary mb-1">{{ $option->label }}</span>
                                @empty
                                <span class="text-muted text-dark">No features</span>
                                @endforelse
                                @if($room->filterOptions->count() > 3)
                                <span class="badge text-dark badge-info">+{{ $room->filterOptions->count() - 3 }} more</span>
                                @endif
                            </td>
                            <td>
                                @if($available > 0)
                                <span class="badge text-dark badge-success">Available</span>
                                @else
                                <span class="badge badge-danger text-dark">Fully Booked</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.rooms.details', $room->id) }}" class="btn btn-outline-primary"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('admin.rooms.edit', $room->id) }}" class="btn btn-outline-warning"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('admin.rooms.destroy', $room->id) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you sure?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="text-center py-4 text-muted">
                                <i class="fas fa-door-open fa-2x mb-3"></i>
                                <h5>No rooms found</h5>
                                <a href="{{ route('admin.rooms.create') }}" class="btn btn-primary mt-2"><i class="fas fa-plus mr-2"></i> Add Your First Room</a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($rooms->hasPages())
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div class="text-muted">
                    Showing {{ $rooms->firstItem() }} to {{ $rooms->lastItem() }} of {{ $rooms->total() }} entries
                </div>
                <div>
                    {{ $rooms->withQueryString()->links('pagination::bootstrap-4') }}
                </div>
            </div>
            @endif

        </div>
    </div>

    {{-- grouped room list --}}
     {{-- Grouped Room List --}}
<div class="card">
    <div class="card-header bg-primary text-white">
        <h5 class="card-title mb-0">
            <i class="fas fa-hotel me-2"></i>Room Inventory Summary
        </h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Room Type</th>
                        <th>Capacity</th>
                        <th>Price</th>
                        <th>Total Rooms</th>
                        <th>Booked</th>
                        <th>Available</th>
                        <th>Availability</th>
                        <th class="text-center pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rooms as $room)
                    <tr>
                        <td class="ps-4">
                            <div class="d-flex align-items-center">
                                <div class="room-type-icon me-3">
                                    <i class="fas fa-bed text-primary"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0">{{ $room->roomType->label ?? 'N/A' }}</h6>
                                    <small class="text-muted">{{ $room->room_type }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-secondary">{{ $room->room_capacity }} Guests</span>
                        </td>
                        <td>
                            <span class="fw-semibold">${{ number_format($room->price, 2) }}</span>
                            <small class="text-muted d-block">/night</small>
                        </td>
                        <td>
                            <span class="fw-semibold">{{ $room->total_quantity }}</span>
                        </td>
                        <td>
                            <span class="text-danger fw-semibold">{{ $room->booked_quantity }}</span>
                        </td>
                        <td>
                            @php
                                $available = $room->total_quantity - $room->booked_quantity;
                                $availabilityClass = $available > 3 ? 'bg-success' : ($available > 0 ? 'bg-warning' : 'bg-danger');
                            @endphp
                            <span class="badge {{ $availabilityClass }}">{{ $available }}</span>
                        </td>
                        <td>
                            <div class="progress" style="height: 8px; width: 80px;">
                                @php
                                    $percentage = $room->total_quantity > 0 ? ($room->booked_quantity / $room->total_quantity) * 100 : 0;
                                    $progressClass = $percentage < 70 ? 'bg-success' : ($percentage < 90 ? 'bg-warning' : 'bg-danger');
                                @endphp
                                <div class="progress-bar {{ $progressClass }}" 
                                     role="progressbar" 
                                     style="width: {{ $percentage }}%;" 
                                     aria-valuenow="{{ $percentage }}" 
                                     aria-valuemin="0" 
                                     aria-valuemax="100">
                                </div>
                            </div>
                            <small class="text-muted">{{ number_format($percentage, 1) }}% occupied</small>
                        </td>
                        <td class="text-center pe-4">
                            <div class="btn-group" role="group">
                                <a href="{{ route('admin.rooms.typeDetails', $room->room_type) }}" 
                                   class="btn btn-sm btn-outline-primary" 
                                   data-bs-toggle="tooltip" 
                                   title="View Details">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.rooms.edit', $room->id) }}" 
                                   class="btn btn-sm btn-outline-secondary" 
                                   data-bs-toggle="tooltip" 
                                   title="Edit Room">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" 
                                        class="btn btn-sm btn-outline-info" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#availabilityModal{{ $room->id }}"
                                        title="Check Availability">
                                    <i class="fas fa-calendar-check"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Availability Modal -->
                    <div class="modal fade" id="availabilityModal{{ $room->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Check Availability - {{ $room->roomType->label ?? $room->room_type }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="availabilityForm{{ $room->id }}">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="checkIn{{ $room->id }}" class="form-label">Check-in Date</label>
                                                    <input type="date" class="form-control" id="checkIn{{ $room->id }}" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="checkOut{{ $room->id }}" class="form-label">Check-out Date</label>
                                                    <input type="date" class="form-control" id="checkOut{{ $room->id }}" required>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <div id="availabilityResult{{ $room->id }}" class="mt-3" style="display: none;">
                                        <!-- Results will be displayed here -->
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" onclick="checkAvailability({{ $room->id }}, '{{ $room->room_type }}')">
                                        Check Availability
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-4">
                            <div class="text-muted">
                                <i class="fas fa-hotel fa-2x mb-3"></i>
                                <p class="mb-0">No rooms found</p>
                                <small>Add rooms to get started</small>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer bg-light">
        <div class="row align-items-center">
            <div class="col-md-6">
                <small class="text-muted">
                    Showing {{ $rooms->count() }} room types • Last updated: {{ now()->format('M j, Y g:i A') }}
                </small>
            </div>
            <div class="col-md-6 text-md-end">
                <a href="{{ route('admin.rooms.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus me-1"></i> Add New Room
                </a>
                <button class="btn btn-outline-secondary btn-sm ms-2" onclick="window.location.reload()">
                    <i class="fas fa-sync-alt me-1"></i> Refresh
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function checkAvailability(roomId, roomType) {
        const checkIn = document.getElementById('checkIn' + roomId).value;
        const checkOut = document.getElementById('checkOut' + roomId).value;
        const resultDiv = document.getElementById('availabilityResult' + roomId);

        if (!checkIn || !checkOut) {
            resultDiv.innerHTML = '<div class="alert alert-warning">Please select both check-in and check-out dates.</div>';
            resultDiv.style.display = 'block';
            return;
        }

        // Show loading state
        resultDiv.innerHTML = '<div class="text-center"><div class="spinner-border text-primary" role="status"></div><p class="mt-2">Checking availability...</p></div>';
        resultDiv.style.display = 'block';

        // Simulate API call (replace with actual API endpoint)
        setTimeout(() => {
            // This is a simulation - replace with actual API call
            const isAvailable = Math.random() > 0.3; // 70% chance of availability for demo
            const availableRooms = isAvailable ? Math.floor(Math.random() * 5) + 1 : 0;

            if (isAvailable) {
                resultDiv.innerHTML = `
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle me-2"></i>
                        <strong>Available!</strong><br>
                        ${availableRooms} room(s) available for ${roomType} from ${checkIn} to ${checkOut}
                    </div>
                `;
            } else {
                resultDiv.innerHTML = `
                    <div class="alert alert-danger">
                        <i class="fas fa-times-circle me-2"></i>
                        <strong>Not Available</strong><br>
                        No ${roomType} rooms available for the selected dates.
                    </div>
                `;
            }
        }, 1500);
    }

    // Initialize tooltips
    document.addEventListener('DOMContentLoaded', function() {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        const tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        // Set minimum date for date inputs to today
        const today = new Date().toISOString().split('T')[0];
        document.querySelectorAll('input[type="date"]').forEach(input => {
            input.min = today;
        });
    });
</script>

<style>
    .room-type-icon {
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f8f9fa;
        border-radius: 6px;
    }

    .table th {
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
    }

    .progress {
        background-color: #e9ecef;
        border-radius: 4px;
    }

    .card-header {
        border-bottom: 1px solid rgba(0,0,0,.125);
    }

    .btn-group .btn {
        border-radius: 4px;
        margin-right: 2px;
    }

    .btn-group .btn:last-child {
        margin-right: 0;
    }
</style>
@endpush

    {{-- facilities --}}
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h2 class="h5 mb-0">Facilities Management</h2>
                        <div>
                            <button class="btn btn-light btn-sm me-2" data-bs-toggle="modal" data-bs-target="#backgroundModal">
                                <i class="fas fa-image me-1"></i> Change Background
                            </button>
                            <a href="{{ route('admin.facilities.create') }}" class="btn btn-light btn-sm">
                                <i class="fas fa-plus me-1"></i> Add Facility
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if($background)
                        <div class="alert alert-info">
                            Current background image is set. It will be used on the frontend display.
                        </div>
                        @endif
                        
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Icon</th>
                                        <th>Order</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($facilities as $facility)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $facility->title }}</td>
                                        <td><i class="bi {{ $facility->icon }}"></i> {{ $facility->icon }}</td>
                                        <td>{{ $facility->sort_order }}</td>
                                        <td>
                                            <span class="badge bg-{{ $facility->is_active ? 'success' : 'danger' }}">
                                                {{ $facility->is_active ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.facilities.edit', $facility->id) }}" 
                                            class="btn btn-sm btn-primary">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.facilities.destroy', $facility->id) }}" 
                                                method="POST" class="d-inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" 
                                                        onclick="return confirm('Are you sure?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Background Image Modal -->
    <div class="modal fade" id="backgroundModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Facilities Background</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.facilities.background.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="background_image" class="form-label">Background Image</label>
                            <input type="file" class="form-control" id="background_image" name="background_image" required>
                            <div class="form-text">Recommended size: 1920x1080px, Max 2MB</div>
                        </div>
                        
                        @if($background)
                        <div class="current-image mb-3">
                            <p class="mb-1">Current Background:</p>
                            <img src="{{ asset('storage/' . $background->background_image) }}" 
                                class="img-fluid rounded" style="max-height: 150px;">
                        </div>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update Background</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

@push('scripts')
<script>
    document.querySelectorAll('.custom-file-input').forEach(input => {
        input.addEventListener('change', function (e) {
            let fileName = e.target.files[0] ? e.target.files[0].name : 'Choose file';
            e.target.nextElementSibling.innerText = fileName;
        });
    });
</script>
@endpush
@endsection
