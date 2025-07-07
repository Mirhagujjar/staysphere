@extends('layouts.admin')

@section('content')
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
                            <td>{{ $room->room_type }}</td>
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
