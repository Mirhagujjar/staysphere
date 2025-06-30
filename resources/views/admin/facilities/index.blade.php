@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h2 class="h5 mb-0">Facilities Management</h2>
                    <div>
                        <button class="btn btn-light btn-sm me-2" data-bs-toggle="modal" data-bs-target="#backgroundModal">
                            <i class="fas fa-image me-1"></i> Change Background
                        </button>
                        <a href="{{ route('admin.facilities.create') }}" class="btn btn-light btn-sm">
                            <i class="fas fa-plus me-1"></i> Add Facility
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if($background)
                    <div class="alert alert-info">
                        Current background image is set. It will be used on the frontend display.
                    </div>
                    @endif
                    
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Icon</th>
                                    <th>Order</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($facilities as $facility)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $facility->title }}</td>
                                    <td><i class="bi {{ $facility->icon }}"></i> {{ $facility->icon }}</td>
                                    <td>{{ $facility->sort_order }}</td>
                                    <td>
                                        <span class="badge bg-{{ $facility->is_active ? 'success' : 'danger' }}">
                                            {{ $facility->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.facilities.edit', $facility->id) }}" 
                                           class="btn btn-sm btn-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.facilities.destroy', $facility->id) }}" 
                                              method="POST" class="d-inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" 
                                                    onclick="return confirm('Are you sure?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Background Image Modal -->
<div class="modal fade" id="backgroundModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Facilities Background</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.facilities.background.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="background_image" class="form-label">Background Image</label>
                        <input type="file" class="form-control" id="background_image" name="background_image" required>
                        <div class="form-text">Recommended size: 1920x1080px, Max 2MB</div>
                    </div>
                    
                    @if($background)
                    <div class="current-image mb-3">
                        <p class="mb-1">Current Background:</p>
                        <img src="{{ asset('storage/' . $background->background_image) }}" 
                             class="img-fluid rounded" style="max-height: 150px;">
                    </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Background</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection