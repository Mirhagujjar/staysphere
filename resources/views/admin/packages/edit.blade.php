@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h2 class="h5 mb-0">Edit Package</h2>
                </div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger mb-4">
                            <h5 class="alert-heading">Please fix these errors:</h5>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.package.update', $package->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row g-3">

                            <div class="col-12">
                                <label class="form-label fw-bold">Package Name</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', $package->name) }}" required>
                            </div>

                        
                            <div class="col-12">
                                <label class="form-label fw-bold">Description</label>
                                <textarea name="description" id="summernote" class="form-control" rows="4" required>{{ old('description', $package->description) }}</textarea>
                            </div>

    
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Package Price (PKR)</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rs.</span>
                                    <input type="number" name="price" class="form-control" value="{{ old('price', $package->price) }}" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Regular Price (PKR)</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rs.</span>
                                    <input type="number" name="regular_price" class="form-control" value="{{ old('regular_price', $package->regular_price) }}" required>
                                </div>
                            </div>

                            
                            <div class="col-12">
                                <label class="form-label fw-bold">Package Image</label>
                                <div class="d-flex flex-column flex-md-row gap-3">
                                    <div class="flex-grow-1">
                                        <input type="file" name="image" class="form-control" accept="image/*">
                                        <small class="text-muted">Leave blank to keep current image</small>
                                    </div>
                                    <div class="text-center">
                                        <p class="mb-1 fw-bold">Current Image:</p>
                                        <img src="{{ asset('assets/images/packages/' . $package->image) }}"
                                             alt="Package Image"
                                             class="img-thumbnail"
                                             style="max-width: 150px; height: auto;">
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-success px-4 py-2">
                                    <i class="fas fa-save me-2"></i> Update Package
                                </button>
                                <a href="{{ route('admin.packages.index') }}" class="btn btn-outline-secondary ms-2">
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
@include("components.summernote")
@endsection
