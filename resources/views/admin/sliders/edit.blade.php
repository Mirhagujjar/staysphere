@extends('admin.dashboard')

@section('content')
<div class="container">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fas fa-edit"></i> Edit Slider</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.sliders.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Title *</label>
                    <input type="text" class="form-control" name="title" value="{{ $slider->title }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Subtitle</label>
                    <input type="text" class="form-control" name="subtitle" value="{{ $slider->subtitle }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Current Image</label>
                    <div class="mb-2">
                        <img src="{{ asset($slider->image) }}" width="200" class="img-thumbnail">
                    </div>
                    <label class="form-label">Change Image (Optional)</label>
                    <input type="file" class="form-control" name="image" accept="image/*">
                </div>

                <div class="mb-3">
                    <label class="form-label">Display Order</label>
                    <input type="number" class="form-control" name="order" value="{{ $slider->order }}">
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.sliders.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Slider
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
