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
                    <form action="{{ route('admin.rooms.store') }}" method="POST" enctype="multipart/form-data" id="room-create-form">
                        @csrf

                        <!-- hero section -->
                        {{-- <div class="col-12">
                            <div class="card shadow-sm mt-3">
                                <div class="card-header bg-primary text-white">
                                    <h4 class="h5 mb-0">Hero Section Content</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold">Hero Title</label>
                                            <input type="text" name="hero_title" class="form-control" 
                                                value="{{ old('hero_title', $room->hero_title ?? '') }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold">Hero Subtitle</label>
                                            <input type="text" name="hero_description" class="form-control" 
                                                value="{{ old('hero_description', $room->hero_description ?? '') }}">
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label fw-bold">Hero Image</label>
                                            <input type="file" name="hero_image" class="form-control">
                                            @if(isset($room) && $room->hero_image)
                                                <div class="mt-2">
                                                    <img src="{{ asset($room->hero_image) }}" class="img-thumbnail" style="max-height: 150px;">
                                                    <label class="form-check-label ms-2">
                                                        <input type="checkbox" name="remove_hero_image" value="1"> Remove image
                                                    </label>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <div class="row g-3">
                            <!-- Basic Room Info -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Room Name*</label>
                                <input type="text" name="room_name" class="form-control @error('room_name') is-invalid @enderror" 
                                       value="{{ old('room_name') }}" required>
                                @error('room_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Room Type with Validation -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Room Type*</label>
                                @if($roomTypes->count() > 0)
                                    <select name="room_type" class="form-select @error('room_type') is-invalid @enderror" required>
                                        <option value="">Select Room Type</option>
                                        @foreach($roomTypes as $option)
                                            <option value="{{ $option->value }}" {{ old('room_type') == $option->value ? 'selected' : '' }}>
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
                                       value="{{ old('price') }}" min="0" step="0.01" required>
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Room Capacity*</label>
                                <input type="number" name="room_capacity" class="form-control @error('room_capacity') is-invalid @enderror"
                                       value="{{ old('room_capacity') }}" min="1" required>
                                @error('room_capacity')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Room Size -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Room Size (sq.ft)*</label>
                                <input type="number" name="size" class="form-control @error('size') is-invalid @enderror"
                                       value="{{ old('size') }}" min="0" required>
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
                                            <option value="{{ $option->value }}" {{ old('view_type') == $option->value ? 'selected' : '' }}>
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
                                                                            {{ is_array(old('features')) && in_array($option->id, old('features')) ? 'checked' : '' }}>
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
                                                            <button class="btn btn-outline-secondary dropdown-toggle w-100 text-start" type="button" 
                                                                    id="dropdownMenu-{{ $filter->slug }}" 
                                                                    data-bs-toggle="dropdown" 
                                                                    aria-expanded="false"
                                                                    data-bs-auto-close="outside">
                                                                Select options...
                                                            </button>
                                                            <ul class="dropdown-menu w-100 p-3" aria-labelledby="dropdownMenu-{{ $filter->slug }}">
                                                                @foreach($filter->options as $option)
                                                                    <li class="mb-2">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" 
                                                                                name="features[]" 
                                                                                value="{{ $option->id }}" 
                                                                                id="dropdown_{{ $filter->slug }}_{{ $option->id }}"
                                                                                {{ is_array(old('features')) && in_array($option->id, old('features')) ? 'checked' : '' }}>
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

                            <!-- Optional: JavaScript to update button text with selected items -->
                            <script>
                            document.addEventListener('DOMContentLoaded', function() {
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
                            });
                            </script>

                            <!-- Room Image -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Room Image*</label>
                                <img id="preview-image" src="#" alt="Image Preview" style="display:none; max-width: 100%; margin-top: 10px;" />

                                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" 
                                       accept="image/*" required>
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Recommended size: 800x600px, Max 2MB</small>
                            </div>

                            <!-- Room Description -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Description*</label>
                                <textarea name="description" id="summernote" class="form-control @error('description') is-invalid @enderror" 
                                          rows="3" required>{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Form Actions -->
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
    @include("components.summernote")
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Form submission handling
    const form = document.getElementById('room-create-form');
    if (form) {
        form.addEventListener('submit', function(e) {
            // Validate required filters exist
            const roomTypeSelect = form.querySelector('select[name="room_type"]');
            if (roomTypeSelect && roomTypeSelect.disabled) {
                e.preventDefault();
                alert('Please create Room Type filters first');
                return false;
            }

            const viewTypeSelect = form.querySelector('select[name="view_type"]');
            if (viewTypeSelect && viewTypeSelect.disabled) {
                e.preventDefault();
                alert('Please create View Type filters first');
                return false;
            }

            return true;
        });
    }

    // Image preview functionality
    const imageInput = document.querySelector('input[name="image"]');
    if (imageInput) {
        imageInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    // You could add image preview here if needed
                };
                reader.readAsDataURL(file);
            }
        });
    }
});
</script>
@endpush
@endsection