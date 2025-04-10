{{-- @extends('admin.dashboard')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h2 class="h5 mb-0"><i class="fas fa-edit me-2"></i>Edit Booking Package</h2>
                </div>
                
                <div class="card-body">
                    <form action="{{ route('bookingspackages.update', $booking->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row g-3">
                            <!-- Package Name -->
                            <div class="col-12">
                                <label class="form-label fw-bold">Package Name</label>
                                <input type="text" name="package_name" class="form-control" 
                                       value="{{ old('package_name', $booking->package_name) }}" required>
                            </div>

                            <!-- Package Price -->
                            <div class="col-12 col-md-6">
                                <label class="form-label fw-bold">Package Price (PKR)</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rs.</span>
                                    <input type="number" name="price" class="form-control" 
                                           value="{{ old('price', $booking->price) }}" required>
                                </div>
                            </div>

                            <!-- Status -->
                            <div class="col-12 col-md-6">
                                <label class="form-label fw-bold">Status</label>
                                <select name="status" class="form-select">
                                    <option value="pending" {{ old('status', $booking->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="confirmed" {{ old('status', $booking->status) == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                    <option value="cancelled" {{ old('status', $booking->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                            </div>

                            <!-- Image Upload -->
                            <div class="col-12">
                                <label class="form-label fw-bold">Package Image</label>
                                <div class="d-flex flex-column flex-md-row gap-3 align-items-md-center">
                                    <div class="flex-grow-1">
                                        <input type="file" name="image" class="form-control" accept="image/*">
                                        <small class="text-muted">Leave blank to keep current image</small>
                                    </div>
                                    @if($booking->image)
                                    <div class="text-center">
                                        <p class="mb-1 fw-bold">Current Image:</p>
                                        <img src="{{ asset($booking->image) }}" 
                                             alt="{{ $booking->package_name }}" 
                                             class="img-thumbnail" 
                                             style="max-width: 150px; height: auto;">
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Buttons -->
                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-primary px-4 py-2">
                                    <i class="fas fa-save me-2"></i>Update Booking
                                </button>
                                <a href="{{ route('admin.bookingspackages.index') }}" class="btn btn-outline-secondary ms-2">
                                    <i class="fas fa-times me-2"></i>Cancel
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}