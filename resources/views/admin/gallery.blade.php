@extends('admin.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-sm-6">
            <h1>Manage Blog Gallery</h1>
            <p class="text-muted">Add or remove gallery images displayed on the blog page.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.gallery.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label>Current Gallery Images</label>
                    <div class="row mb-3">
                        @foreach($settings['gallery_images'] ?? [] as $index => $image)
                            <div class="col-md-3 gallery-item position-relative mb-3">
                                <img src="{{ asset($image) }}" class="img-thumbnail" style="width: 100%; height: 150px; object-fit: cover;">
                                <button onclick="deleteImage(event, {{ $index }})"
                                        class="btn btn-sm btn-danger position-absolute top-0 end-0 m-1">
                                    Delete
                                </button>
                            </div>
                        @endforeach
                    </div>

                    <script>
                        function deleteImage(e, index) {
                            e.preventDefault();

                            if (confirm('Are you sure?')) {
                                fetch(`/admin/gallery/delete/${index}`, {
                                    method: 'DELETE',
                                    headers: {
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                        'Accept': 'application/json'
                                    }
                                })
                                .then(response => {
                                    if (response.ok) {
                                        window.location.reload();
                                    } else {
                                        alert('Failed to delete image.');
                                    }
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                    alert('Error occurred while deleting.');
                                });
                            }
                        }

                    </script>
                </div>

                <div class="form-group">
                    <label for="gallery_images">Add New Gallery Images</label>
                    <input type="file" name="gallery_images[]" multiple class="form-control-file" id="gallery_images">
                    <small class="text-muted">You can upload multiple images.</small>
                </div>

                <button type="submit" class="btn btn-primary mt-3">Update Gallery</button>
                <a href="{{ route('admin.blog.main') }}" class="btn btn-secondary mt-3">Back to Blog Main Page</a>
            </form>
        </div>
    </div>
</div>
@endsection
