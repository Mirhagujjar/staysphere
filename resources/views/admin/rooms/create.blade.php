@extends('admin.dashboard')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h2 class="h5 mb-0">Add New Room</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.rooms.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row g-3">
                            <!-- Room Name -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Room Name</label>
                                <input type="text" name="room_name" class="form-control" required>
                            </div>
                            
                            <!-- Room Type -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Room Type</label>
                                <input type="text" name="room_type" class="form-control" required>
                            </div>
                            
                            <!-- Price -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Price</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rs.</span>
                                    <input type="number" name="price" class="form-control" required>
                                </div>
                            </div>
                            
                            <!-- Capacity -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Room Capacity</label>
                                <div class="input-group">
                                    <input type="number" name="room_capacity" class="form-control" required>
                                    <span class="input-group-text">Persons</span>
                                </div>
                            </div>
                            
                            <!-- Facilities -->
                            <div class="col-12">
                                <label class="form-label fw-bold">Facilities</label>
                                <textarea name="facilities" class="form-control" rows="2" required></textarea>
                                <small class="text-muted">Separate facilities with commas</small>
                            </div>
                            
                            <!-- Has View -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Has View</label>
                                <select name="has_view" class="form-select">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                            
                            <!-- Image Upload -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Room Image</label>
                                <input type="file" name="image" class="form-control" accept="image/*">
                                <small class="text-muted">Recommended size: 800x600px</small>
                            </div>
                            
                            <!-- Submit Button -->
                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-success px-4 py-2">
                                    <i class="fas fa-plus-circle me-2"></i> Add Room
                                </button>
                                <a href="{{ route('admin.rooms.index') }}" class="btn btn-outline-secondary ms-2">
                                    <i class="fas fa-times me-2"></i> Cancel
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection