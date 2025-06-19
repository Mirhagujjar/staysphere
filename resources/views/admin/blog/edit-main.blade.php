@extends('admin.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-sm-6">
            <h1>Edit Blog Main Page</h1>
            <p class="text-muted">This controls how your blog page appears to visitors</p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.blog.main.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label>Current Hero Image</label><br>
                    @php
                        $heroImage = $settings['hero_image'] ?? 'build/assets/images/blog/blog.jpg';
                        $heroImageUrl = str_contains($heroImage, 'storage/') 
                            ? asset($heroImage) 
                            : (str_contains($heroImage, 'build/') 
                                ? asset($heroImage) 
                                : asset('storage/'.$heroImage));
                    @endphp
                    <img src="{{ $heroImageUrl }}" 
                        style="max-height: 200px;" 
                        class="mb-3 img-thumbnail"
                        onerror="this.src='{{ asset('build/assets/images/blog/blog.jpg') }}'">
                </div>

                <div class="form-group">
                    <label for="hero_image">Change Hero Image</label>
                    <input type="file" name="hero_image" id="hero_image" class="form-control-file">
                    <small class="text-muted">Recommended size: 1920x600px</small>
                </div>

                <div class="form-group">
                    <label for="title">Main Title</label>
                    <input type="text" name="title" id="title" class="form-control" 
                           value="{{ old('title', $settings['title'] ?? '') }}" required>
                </div>

                <div class="form-group">
                    <label for="subtitle">Subtitle</label>
                    <input type="text" name="subtitle" id="subtitle" class="form-control" 
                           value="{{ old('subtitle', $settings['subtitle'] ?? '') }}" required>
                </div>

                <div class="form-group">
                    <label>Gallery Images</label>
                    <div class="row mb-3">
                        @foreach(($settings['gallery_images'] ?? []) as $index => $image)
                            @php
                                $imagePath = is_string($image) ? $image : ($image['path'] ?? '');
                            @endphp
                            @if($imagePath)
                                <div class="col-md-3 mb-3 position-relative">
                                    <img src="{{ asset('storage/'.$imagePath) }}" class="img-fluid rounded">
                                    <a href="{{ route('admin.blog.main.delete-image', $index) }}" 
                                       class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1"
                                       onclick="return confirm('Are you sure you want to delete this image?')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <input type="file" name="gallery_images[]" multiple class="form-control-file">
                    <small class="text-muted">Add more images to the gallery section</small>
                </div>

                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="{{ url('/blog') }}" target="_blank" class="btn btn-success ml-2">
                    <i class="fas fa-eye"></i> Preview Page
                </a>
            </form>
        </div>
    </div>
</div>
@endsection