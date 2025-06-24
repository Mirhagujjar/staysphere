@extends('admin.dashboard')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h2 class="h5 mb-0"><i class="fas fa-box-open me-2"></i>Create New Package</h2>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.package.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label fw-bold">Package Name</label>
                                <input type="text" name="name" class="form-control" required>
                                <small class="text-muted">Enter a descriptive name for the package</small>
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-bold">Description</label>
                                <textarea name="description" id="summernote" class="form-control" rows="4" required></textarea>
                                <small class="text-muted">Describe the package features and benefits</small>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Regular Price (PKR)</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rs.</span>
                                    <input type="number" name="regular_price" class="form-control" required>
                                </div>
                                <small class="text-muted">Standard price without discounts</small>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Package Price (PKR)</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rs.</span>
                                    <input type="number" name="price" class="form-control" required>
                                </div>
                                <small class="text-muted">Discounted price for the package</small>
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-bold">Package Image</label>
                                <input type="file" name="image" class="form-control" accept="image/*" >
                                <small class="text-muted">Recommended size: 800x600px (JPG/PNG)</small>
                            </div>

                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-success px-4 py-2">
                                    <i class="fas fa-save me-2"></i>Create Package
                                </button>
                                <a href="{{ route('admin.packages.index') }}" class="btn btn-outline-secondary ms-2">
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
@include("components.summernote")
@endsection
