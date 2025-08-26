@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8">
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h2 class="h5 mb-0">Edit Room</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.rooms.update', $room->id) }}" method="POST" enctype="multipart/form-data" id="room-edit-form">
                        @csrf
                        @method('PUT')

                        <div id="form-error-msg" class="alert alert-danger d-none"></div>
                        <div id="form-success-msg" class="alert alert-success d-none"></div>

                        <div class="row g-3">
                            {{-- <div class="col-md-6">
                                <label class="form-label fw-bold">Room Name*</label>
                                <input type="text" name="room_name" class="form-control @error('room_name') is-invalid @enderror" 
                                       value="{{ old('room_name') }}" required>
                                @error('room_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div> --}}
                            <!-- Room Type with Validation -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Room Type*</label>
                                @if($roomTypes->count() > 0)
                                    <select name="room_type" class="form-select @error('room_type') is-invalid @enderror" required>
                                        <option value="">Select Room Type</option>
                                        @foreach($roomTypes as $option)
                                            <option value="{{ $option->value }}" {{ old('room_type', $room->room_type) == $option->value ? 'selected' : '' }}>
                                                {{ $option->label }}
                                            </option>
                                        @endforeach
                                    </select>
                                @else
                                    <div class="alert alert-warning">
                                        No room types found. Please <a href="{{ route('admin.filters.create') }}">create a Room Type filter</a> first.
                                    </div>
                                    <select name="room_type" class="form-select" disabled>
                                        <option value="">No room types available</option>
                                    </select>
                                @endif
                                @error('room_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Price and Capacity -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Price (Rs.)*</label>
                                <input type="number" name="price" class="form-control @error('price') is-invalid @enderror"
                                       value="{{ old('price', $room->price) }}" min="0" step="0.01" required>
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Room Capacity*</label>
                                <input type="number" name="room_capacity" class="form-control @error('room_capacity') is-invalid @enderror"
                                       value="{{ old('room_capacity', $room->room_capacity) }}" min="1" required>
                                @error('room_capacity')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Total and Available Units -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Total Units*</label>
                                <input type="number" name="total_quantity" class="form-control @error('total_quantity') is-invalid @enderror"
                                    value="{{ old('total_quantity', $room->total_quantity) }}" min="1" required>
                                @error('total_quantity')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Available Units*</label>
                                <input type="number" name="available_stock" class="form-control @error('available_stock') is-invalid @enderror"
                                    value="{{ old('available_stock', $room->total_quantity - $room->booked_quantity) }}" min="0" required>
                                @error('available_stock')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Room Names Section -->
                            <div class="col-12 mt-3">
                                <label class="form-label fw-bold">Room Names*</label>
                                <div id="room-names-container">
                                    <!-- Room name inputs will be generated here -->
                                </div>
                                @error('room_names')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Room Size -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Room Size (sq.ft)*</label>
                                <input type="number" name="size" class="form-control @error('size') is-invalid @enderror"
                                       value="{{ old('size', $room->size) }}" min="0" required>
                                @error('size')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- View Type with Validation -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">View Type*</label>
                                @if($viewTypes->count() > 0)
                                    <select name="view_type" class="form-select @error('view_type') is-invalid @enderror" required>
                                        <option value="">Select View Type</option>
                                        @foreach($viewTypes as $option)
                                            <option value="{{ $option->value }}" {{ old('view_type', $room->view_type) == $option->value ? 'selected' : '' }}>
                                                {{ $option->label }}
                                            </option>
                                        @endforeach
                                    </select>
                                @else
                                    <div class="alert alert-warning">
                                        No view types found. Please <a href="{{ route('admin.filters.create') }}">create a View Type filter</a> first.
                                    </div>
                                    <select name="view_type" class="form-select" disabled>
                                        <option value="">No view types available</option>
                                    </select>
                                @endif
                                @error('view_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Room Features Section -->
                            <div class="col-12">
                                <div class="card shadow-sm mt-3">
                                    <div class="card-header bg-primary text-white">
                                        <h4 class="h5 mb-0">Room Features & Facilities</h4>
                                    </div>
                                    <div class="card-body">
                                        @foreach($featureFilters as $filter)
                                            @if($filter->options->count() > 0)
                                                <div class="mb-4">
                                                    <h5 class="mb-2">{{ $filter->name }}</h5>
                                                    
                                                    @if($filter->type == 'checkbox')
                                                        <div class="row">
                                                            @foreach($filter->options as $option)
                                                                <div class="col-md-4 mb-2">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" 
                                                                            name="features[]" 
                                                                            value="{{ $option->id }}" 
                                                                            id="feature_{{ $filter->slug }}_{{ $option->id }}"
                                                                            {{ in_array($option->id, old('features', $room->filterOptions->pluck('id')->toArray() ?? [])) ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="feature_{{ $filter->slug }}_{{ $option->id }}">
                                                                            {{ $option->label }}
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @else
                                                        <!-- Bootstrap 5 Custom Dropdown Multiselect -->
                                                        <div class="dropdown">
                                                            @php
                                                                $roomFeatureIds = $room->filterOptions ? $room->filterOptions->pluck('id')->toArray() : [];
                                                                $selectedOptions = array_intersect(
                                                                    $roomFeatureIds,
                                                                    $filter->options->pluck('id')->toArray()
                                                                );
                                                                $selectedCount = count($selectedOptions);
                                                            @endphp
                                                            <button class="btn btn-outline-secondary dropdown-toggle w-100 text-start" type="button" 
                                                                    id="dropdownMenu-{{ $filter->slug }}" 
                                                                    data-bs-toggle="dropdown" 
                                                                    aria-expanded="false"
                                                                    data-bs-auto-close="outside">
                                                                {{ $selectedCount > 0 ? "$selectedCount selected" : 'Select options...' }}
                                                            </button>
                                                            <ul class="dropdown-menu w-100 p-3" aria-labelledby="dropdownMenu-{{ $filter->slug }}">
                                                                @foreach($filter->options as $option)
                                                                    <li class="mb-2">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" 
                                                                                name="features[]" 
                                                                                value="{{ $option->id }}" 
                                                                                id="dropdown_{{ $filter->slug }}_{{ $option->id }}"
                                                                                {{ in_array($option->id, old('features', $roomFeatureIds)) ? 'checked' : '' }}>
                                                                            <label class="form-check-label" for="dropdown_{{ $filter->slug }}_{{ $option->id }}">
                                                                                {{ $option->label }}
                                                                            </label>
                                                                        </div>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    @endif
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <!-- Room Image -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Room Image</label>
                                <img id="preview-image" src="#" alt="Image Preview" style="display:none; max-width: 100%; margin-top: 10px;" />

                                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" 
                                       accept="image/*">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                
                                @if($room->image)
                                    <div class="mt-2">
                                        <small class="text-muted">Current Image:</small><br>
                                        <img src="{{ asset($room->image) }}" alt="Current Room Image" 
                                             class="img-thumbnail" style="max-height: 150px;">
                                        <div class="form-check mt-2">
                                            <input type="checkbox" name="remove_image" value="1" class="form-check-input" id="remove_image">
                                            <label class="form-check-label" for="remove_image">Remove current image</label>
                                        </div>
                                    </div>
                                @endif
                                <small class="text-muted">Recommended size: 800x600px, Max 2MB</small>
                            </div>

                            <!-- Room Description -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Description*</label>
                                <textarea name="description" id="summernote" class="form-control @error('description') is-invalid @enderror" 
                                          rows="3" required>{{ old('description', $room->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Form Actions -->
                             <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-success px-4 py-2">
                                    <i class="fas fa-save me-2"></i> Update Room
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
    @include("components.summernote")
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const totalInput = document.querySelector('input[name="total_quantity"]');
    const container = document.getElementById('room-names-container');

    // Get existing room names if available
    const existingRoomNames = @json($room->room_names ?? []);

    function renderRoomInputs() {
        container.innerHTML = ''; // clear old inputs
        let total = parseInt(totalInput.value) || 0;

        for (let i = 1; i <= total; i++) {
            let div = document.createElement('div');
            div.classList.add('mb-2');
            
            // Use existing room name if available, otherwise empty
            let existingValue = existingRoomNames[i-1] || '';
            
            div.innerHTML = `
                <input type="text" 
                    name="room_names[]" 
                    class="form-control" 
                    placeholder="Enter Room ${i} Name" 
                    value="${existingValue}"
                    required>
            `;
            container.appendChild(div);
        }
    }

    // Render inputs when admin changes total_quantity
    totalInput.addEventListener('input', renderRoomInputs);

    // Initial render on page load
    if (totalInput.value) {
        renderRoomInputs();
    }

    // Update dropdown button text with selected count
    document.querySelectorAll('.dropdown-menu input[type="checkbox"]').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const dropdown = this.closest('.dropdown');
            const button = dropdown.querySelector('.dropdown-toggle');
            const checkedItems = dropdown.querySelectorAll('input[type="checkbox"]:checked');
            
            if (checkedItems.length > 0) {
                button.textContent = `${checkedItems.length} selected`;
            } else {
                button.textContent = 'Select options...';
            }
        });
    });

    // Form validation
    const form = document.getElementById('room-edit-form');
    const errorBox = document.getElementById('form-error-msg');
    const successBox = document.getElementById('form-success-msg');

    if (form) {
        form.addEventListener('submit', function(e) {
            let errors = [];

            // Check filters
            const roomTypeSelect = form.querySelector('select[name="room_type"]');
            if (roomTypeSelect && roomTypeSelect.disabled) {
                errors.push("Please create Room Type filters first.");
            }
            const viewTypeSelect = form.querySelector('select[name="view_type"]');
            if (viewTypeSelect && viewTypeSelect.disabled) {
                errors.push("Please create View Type filters first.");
            }

            if (errors.length > 0) {
                e.preventDefault();
                errorBox.classList.remove("d-none");
                errorBox.innerHTML = errors.join("<br>");
                window.scrollTo({ top: 0, behavior: 'smooth' });
                return false;
            }

            // If form looks fine, show loader msg
            successBox.classList.remove("d-none");
            successBox.innerHTML = "Updating room, please wait...";
        });
    }

    // Image preview functionality
    const imageInput = document.querySelector('input[name="image"]');
    const previewImage = document.getElementById('preview-image');

    if (imageInput) {
        imageInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewImage.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                previewImage.style.display = 'none';
            }
        });
    }
});
</script>
@endpush
@endsection