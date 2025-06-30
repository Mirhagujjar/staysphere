@extends('layouts.admin')

@section('content')
<div class="container py-4">

    {{-- Hero Section Form --}}
    <div class="card shadow mb-5">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Hero Section Content</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.services.hero.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Hero Title --}}
                <div class="mb-3">
                    <label class="form-label">Hero Title</label>
                    <input type="text" name="hero_title" value="{{ old('hero_title', $hero->hero_title ?? '') }}" class="form-control">
                </div>

                {{-- Hero Subtitle --}}
                <div class="mb-3">
                    <label class="form-label">Hero Subtitle</label>
                    <input type="text" name="hero_subtitle" value="{{ old('hero_subtitle', $hero->hero_subtitle ?? '') }}" class="form-control">
                </div>

                {{-- Hero Background Image --}}
                <div class="mb-3">
                    <label class="form-label">Hero Background Image</label>
                    <input type="file" name="hero_background" class="form-control">
                    @if(!empty($hero->hero_background))
                        <img src="{{ asset('storage/' . $hero->hero_background) }}" class="mt-2" style="height: 120px; border-radius: 10px;">
                    @endif
                </div>

                <button class="btn btn-success">Update Hero Section</button>
            </form>
        </div>
    </div>

    {{-- Services Table --}}
    <div class="card shadow">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">All Services</h5>
            <a href="{{ route('admin.services.create') }}" class="btn btn-warning">+ Add New Service</a>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Thumbnail</th>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Slug</th>
                        <th>Order</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($services as $service)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if($service->thumbnail)
                                <img src="{{ asset('storage/' . $service->thumbnail) }}" style="height: 60px; width: 60px; object-fit: cover; border-radius: 5px;">
                            @endif
                        </td>
                        <td>{{ $service->title }}</td>
                        <td>{{ $service->price }}</td>
                        <td>{{ $service->slug }}</td>
                        <td>{{ $service->order }}</td>
                        <td>
                            <a href="{{ route('admin.services.edit', $service->id) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Are you sure you want to delete this service?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">No services found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
