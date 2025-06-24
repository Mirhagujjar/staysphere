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

                {{-- Hero Image --}}
                <div class="form-group">
                    <label>Current Hero Image</label><br>
                    @php
                        $heroImage = $settings['hero_image'] ?? 'assets/images/blog/blog.jpg';
                    @endphp
                    <img src="{{ asset($heroImage) }}"
                         style="max-height: 200px;"
                         class="mb-3 img-thumbnail"
                         onerror="this.src='{{ asset('assets/images/blog/blog.jpg') }}'">
                </div>

                <div class="form-group">
                    <label for="hero_image">Change Hero Image</label>
                    <input type="file" name="hero_image" id="hero_image" class="form-control-file">
                    <small class="text-muted">Recommended size: 1920x600px</small>
                </div>

                {{-- Title & Subtitle --}}
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

                {{-- Gallery --}}
                {{-- <div class="form-group">
                    <label>Gallery Images</label>
                    <div class="row mb-3">
                       @foreach($settings['gallery_images'] as $index => $image)
                            <div class="gallery-item">
                                <img src="{{ asset($image) }}" width="150">
                                <button onclick="deleteImage(event, {{ $index }})" class="btn btn-sm btn-danger">Delete</button>
                            </div>
                       @endforeach

                        <script>
                            function deleteImage(e, index) {
                                e.preventDefault();
                                
                                if (confirm('Are you sure?')) {
                                    fetch(`/admin/main/gallery/${index}`, {
                                        method: 'DELETE',
                                        headers: {
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                            'Content-Type': 'application/json',
                                            'Accept': 'application/json'
                                        }
                                    })
                                    .then(response => {
                                        if (response.ok) {
                                            window.location.reload();
                                        } else {
                                            alert('Error deleting image');
                                        }
                                    })
                                    .catch(error => console.error('Error:', error));
                                }
                            }
                        </script>
                    </div>
                    <input type="file" name="gallery_images[]" multiple class="form-control-file">
                    <small class="text-muted">Add more images to the gallery section</small>
                </div> --}}

                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="{{ url('/blog') }}" target="_blank" class="btn btn-success ml-2">
                    <i class="fas fa-eye"></i> Preview Page
                </a>
            </form>
        </div>
    </div>
</div>
@endsection
