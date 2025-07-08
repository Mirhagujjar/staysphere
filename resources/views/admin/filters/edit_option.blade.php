<!-- resources/views/admin/filters/edit_option.blade.php -->
@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-6">
            <h2 class="h3">Edit Option: {{ $option->label }}</h2>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{ route('admin.filters.options', $option->filter) }}" 
               class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Options
            </a>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.filters.options.update', $option) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="label">Display Label*</label>
                    <input type="text" name="label" id="label"
                           class="form-control @error('label') is-invalid @enderror"
                           value="{{ old('label', $option->label) }}" required>
                    @error('label')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="value">Filter Value*</label>
                    <input type="text" name="value" id="value"
                           class="form-control @error('value') is-invalid @enderror"
                           value="{{ old('value', $option->value) }}" required>
                    @error('value')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <small class="text-muted">Used in URLs and backend processing</small>
                </div>

                <div class="form-group">
                    <label for="order">Display Order</label>
                    <input type="number" name="order" id="order"
                           class="form-control"
                           value="{{ old('order', $option->order) }}">
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update Option
                </button>
            </form>
        </div>
    </div>
</div>
@endsection