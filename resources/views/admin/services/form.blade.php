<!-- admin/services/form.blade.php -->

<style>
    .service-description {
        line-height: 1.8;
        color: #555;
    }
    
    .service-description p {
        margin-bottom: 1.2rem;
    }
    
    .service-description ul, 
    .service-description ol {
        padding-left: 1.5rem;
        margin-bottom: 1.2rem;
    }
    
    .service-description li {
        margin-bottom: 0.5rem;
    }
</style>
<div class="mb-3">
    <label>Title</label>
    <input type="text" name="title" class="form-control" 
           value="{{ old('title', $service->title ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Short Description</label>
    <input type="text" name="short_description" class="form-control" 
           value="{{ old('short_description', $service->short_description ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Long Description</label>
    <textarea name="long_description" id="summernote" class="form-control" rows="5" required>{{ old('long_description', $service->long_description ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label>Price</label>
    <input type="text" name="price" class="form-control" 
           value="{{ old('price', $service->price ?? '') }}" required>
</div>

<!-- For Edit Page - Show current images -->
@if(isset($service) && $service->thumbnail)
<div class="mb-3">
    <label>Current Thumbnail</label>
    <div>
        <img src="{{ asset('storage/' . $service->thumbnail) }}" class="img-thumbnail" style="max-height: 150px;">
    </div>
</div>
@endif

<div class="mb-3">
    <label>Thumbnail Image {{ isset($service) ? '(Leave blank to keep current)' : '' }}</label>
    <input type="file" name="thumbnail" class="form-control" {{ !isset($service) ? 'required' : '' }}>
</div>

@if(isset($service) && $service->detail_image)
<div class="mb-3">
    <label>Current Detail Image</label>
    <div>
        <img src="{{ asset('storage/' . $service->detail_image) }}" class="img-thumbnail" style="max-height: 150px;">
    </div>
</div>
@endif

<div class="mb-3">
    <label>Detail Image (Optional) {{ isset($service) ? '(Leave blank to keep current)' : '' }}</label>
    <input type="file" name="detail_image" class="form-control">
</div>

<div class="mb-3">
    <label>Facilities (comma separated)</label>
    <input type="text" name="facilities" class="form-control"
           value="{{ old('facilities', isset($service) ? (is_array($service->facilities) ? implode(',', $service->facilities) : $service->facilities) : '') }}">
</div>

<div class="mb-3">
    <label>Modal Button Text</label>
    <input type="text" name="modal_button_text" class="form-control" 
           value="{{ old('modal_button_text', $service->modal_button_text ?? 'Get Service Now') }}">
</div>

<div class="mb-3">
    <label>Modal Fields (JSON format)</label>
    <textarea name="modal_fields" class="form-control" rows="4" required>{{ old('modal_fields', isset($service) ? json_encode($service->modal_fields) : json_encode(['name', 'email', 'phone', 'room_number', 'service_type'])) }}</textarea>
</div>