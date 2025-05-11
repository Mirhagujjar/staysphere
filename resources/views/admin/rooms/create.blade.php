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
                            <!-- Room Basic Info -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Room Name*</label>
                                <input type="text" name="room_name" class="form-control @error('room_name') is-invalid @enderror" 
                                       value="{{ old('room_name') }}" required>
                                @error('room_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Room Type*</label>
                                <input type="text" name="room_type" class="form-control @error('room_type') is-invalid @enderror"
                                       value="{{ old('room_type') }}" required>
                                @error('room_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Price and Capacity -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Price*</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rs.</span>
                                    <input type="number" name="price" class="form-control @error('price') is-invalid @enderror"
                                           value="{{ old('price') }}" required>
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Room Capacity*</label>
                                <div class="input-group">
                                    <input type="number" name="room_capacity" class="form-control @error('room_capacity') is-invalid @enderror"
                                           value="{{ old('room_capacity') }}" required>
                                    <span class="input-group-text">Persons</span>
                                    @error('room_capacity')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Facilities -->
                            <div class="col-12">
                                <label class="form-label fw-bold">Facilities*</label>
                                <textarea name="facilities" class="form-control @error('facilities') is-invalid @enderror" 
                                          rows="2" required>{{ old('facilities') }}</textarea>
                                <small class="text-muted">Separate facilities with commas</small>
                                @error('facilities')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- View and Image -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Has View</label>
                                <select name="has_view" class="form-select @error('has_view') is-invalid @enderror">
                                    <option value="1" {{ old('has_view', 1) == 1 ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ old('has_view') == 0 ? 'selected' : '' }}>No</option>
                                </select>
                                @error('has_view')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Room Image*</label>
                                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" 
                                       accept="image/*" required>
                                <small class="text-muted">Recommended size: 800x600px</small>
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Room Filters Section -->
                            {{-- <div class="col-12">
                                <div class="card shadow-sm mt-3">
                                    <div class="card-header bg-primary text-white">
                                        <h4 class="h5 mb-0">Room Features</h4>
                                    </div>
                                    <div class="card-body">
                                        @foreach($filters as $filter)
                                            @if($filter->options->count() > 0)
                                                <div class="mb-4">
                                                    <h5 class="mb-2">{{ $filter->name }}</h5>
                                                    
                                                    @if($filter->type == 'checkbox')
                                                        <div class="row">
                                                            @foreach($filter->options as $option)
                                                                <div class="col-md-4 mb-2">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" 
                                                                               name="filter_options[]" 
                                                                               value="{{ $option->id }}" 
                                                                               id="option_{{ $option->id }}"
                                                                               {{ in_array($option->id, (array)old('filter_options')) ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="option_{{ $option->id }}">
                                                                            {{ $option->label }}
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @else
                                                        <select name="filter_options[]" class="form-select" multiple>
                                                            @foreach($filter->options as $option)
                                                                <option value="{{ $option->id }}"
                                                                    {{ in_array($option->id, (array)old('filter_options')) ? 'selected' : '' }}>
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
                            </div> --}}

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
</div>
@endsection