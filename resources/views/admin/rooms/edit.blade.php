@extends('admin.dashboard')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h2 class="h5 mb-0">Edit Room: {{ $room->room_name }}</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.rooms.update', $room->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row g-3">
                            <!-- Basic Room Info -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Room Name*</label>
                                <input type="text" name="room_name" class="form-control @error('room_name') is-invalid @enderror" 
                                       value="{{ old('room_name', $room->room_name) }}" required>
                                @error('room_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Room Type*</label>
                                <select name="room_type" class="form-select @error('room_type') is-invalid @enderror" required>
                                    <option value="">Select Room Type</option>
                                    @foreach($roomTypes as $type)
                                        <option value="{{ $type->value }}" {{ old('room_type', $room->room_type) == $type->value ? 'selected' : '' }}>
                                            {{ $type->label }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('room_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Price and Capacity -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Price (Rs.)*</label>
                                <input type="number" name="price" class="form-control @error('price') is-invalid @enderror"
                                       value="{{ old('price', $room->price) }}" required>
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Room Capacity*</label>
                                <input type="number" name="room_capacity" class="form-control @error('room_capacity') is-invalid @enderror"
                                       value="{{ old('room_capacity', $room->room_capacity) }}" required>
                                @error('room_capacity')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Room Size -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Room Size (sq.ft)*</label>
                                <input type="number" name="size" class="form-control @error('size') is-invalid @enderror"
                                       value="{{ old('size', $room->size) }}" required>
                                @error('size')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- View Type -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">View Type*</label>
                                <select name="view_type" class="form-select @error('view_type') is-invalid @enderror" required>
                                    <option value="">Select View Type</option>
                                    @foreach($viewTypes as $view)
                                        <option value="{{ $view->value }}" {{ old('view_type', $room->view_type) == $view->value ? 'selected' : '' }}>
                                            {{ $view->label }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('view_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Room Features (Dynamic Filters) -->
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
                                                                               id="feature_{{ $option->id }}"
                                                                               {{ in_array($option->id, old('features', $room->filterOptions->pluck('id')->toArray())) ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="feature_{{ $option->id }}">
                                                                            {{ $option->label }}
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @else
                                                        <select name="features[]" class="form-select" multiple>
                                                            @foreach($filter->options as $option)
                                                                <option value="{{ $option->id }}"
                                                                    {{ in_array($option->id, old('features', $room->filterOptions->pluck('id')->toArray())) ? 'selected' : '' }}>
                                                                    {{ $option->label }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    @endif
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <!-- Room Image -->
                            <!-- Room Image -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Room Image</label>
                                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" 
                                    accept="image/*">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @if($room->image)
                                    <small class="text-muted">Current: 
                                        <img src="{{ asset($room->image) }}" 
                                            alt="Current Room Image" 
                                            style="width: 100px; height: auto; display: block; margin-top: 5px;">
                                    </small>
                                @endif
                            </div>

                            <!-- Room Description -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Short Description*</label>
                                <textarea name="description" class="form-control @error('description') is-invalid @enderror" 
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
</div>
@endsection