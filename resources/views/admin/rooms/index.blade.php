@extends('admin.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-6">
            <h2 class="h3">Manage Rooms</h2>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{ route('admin.rooms.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add New Room
            </a>
        </div>
    </div>

    <!-- Hero Section Configuration Form -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h4 class="h5 mb-0">Website Hero Section Configuration</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.rooms.update-hero') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Hero Title</label>
                        <input type="text" name="hero_title" class="form-control" 
                               value="{{ $heroRoom->hero_title ?? '' }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Hero Subtitle</label>
                        <input type="text" name="hero_description" class="form-control" 
                               value="{{ $heroRoom->hero_description ?? '' }}" required>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label fw-bold">Hero Image</label>
                        <input type="file" name="hero_image" class="form-control">
                        @if(isset($heroRoom) && $heroRoom->hero_image)
                            <div class="mt-2">
                                <img src="{{ asset($heroRoom->hero_image) }}" class="img-thumbnail" style="max-height: 150px;">
                                <label class="form-check-label ms-2">
                                    <input type="checkbox" name="remove_hero_image" value="1"> Remove image
                                </label>
                            </div>
                        @endif
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Save Hero Settings
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Rooms List Table -->
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Room Name</th>
                            <th>Type</th>
                            <th>Price</th>
                            <th>Capacity</th>
                            <th>Features</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rooms as $room)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <img src="{{ asset($room->image) }}" 
                                    alt="{{ $room->room_name }}" 
                                    style="width: 80px; height: 60px; object-fit: cover;">
                            </td>
                            <td>{{ $room->room_name }}</td>
                            <td>{{ $room->room_type }}</td>
                            <td>Rs. {{ number_format($room->price) }}</td>
                            <td>{{ $room->room_capacity }} Persons</td>
                            <td>
                                @foreach($room->filterOptions->take(3) as $option)
                                    <span class="badge bg-light text-dark mb-1">{{ $option->label }}</span>
                                @endforeach
                                @if($room->filterOptions->count() > 3)
                                    <span class="badge bg-info">+{{ $room->filterOptions->count() - 3 }} more</span>
                                @endif
                            </td>
                            <td>
                                @if($room->isBooked())
                                    <span class="badge bg-danger">Booked</span>
                                @else
                                    <span class="badge bg-success">Available</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.rooms.edit', $room->id) }}" 
                                   class="btn btn-sm btn-primary" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.rooms.destroy', $room->id) }}" 
                                      method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" 
                                            onclick="return confirm('Are you sure?')" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4">
                {{ $rooms->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
@endsection