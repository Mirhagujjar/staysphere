
@extends('admin.dashboard')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Edit About Us Page</h3>
    </div>
    <form action="{{ route('admin.about.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <!-- Banner Section -->
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Banner Section</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Banner Title</label>
                        <input type="text" name="banner_title" class="form-control" value="{{ old('banner_title', $about->banner_title) }}" required>
                    </div>
                    <div class="form-group">
                        <label>Banner Subtitle</label>
                        <input type="text" name="banner_subtitle" class="form-control" value="{{ old('banner_subtitle', $about->banner_subtitle) }}" required>
                    </div>
                    <div class="form-group">
                        <label>Banner Image</label>
                        <input type="file" name="banner_image" class="form-control-file">
                        @if($about->banner_image)
                        <img src="{{ asset($about->banner_image) }}" width="200" class="mt-2">
                        @endif
                    </div>
                </div>
            </div>

            <!-- History Section -->
            <div class="card card-secondary mt-4">
                <div class="card-header">
                    <h3 class="card-title">History Section</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>History Title</label>
                        <input type="text" name="history_title" class="form-control" value="{{ old('history_title', $about->history_title) }}" required>
                    </div>
                    <div class="form-group">
                        <label>History Subtitle</label>
                        <input type="text" name="history_subtitle" class="form-control" value="{{ old('history_subtitle', $about->history_subtitle) }}" required>
                    </div>
                    <div class="form-group">
                        <label>History Content</label>
                        <textarea name="history_content" class="form-control" rows="5" required>{{ old('history_content', $about->history_content) }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Main Image</label>
                        <input type="file" name="main_image" class="form-control-file">
                        @if($about->main_image)
                        <img src="{{ asset($about->main_image) }}" width="200" class="mt-2">
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Overlay Image</label>
                        <input type="file" name="overlay_image" class="form-control-file">
                        @if($about->overlay_image)
                        <img src="{{ asset($about->overlay_image) }}" width="200" class="mt-2">
                        @endif
                    </div>
                </div>
            </div>

           <!-- Team Section -->
            <div class="card card-secondary mt-4">
                <div class="card-header">
                    <h3 class="card-title">Team Section</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Section Title</label>
                        <input type="text" name="team_section_title" class="form-control" value="{{ old('team_section_title', $about->team_section_title) }}" required>
                    </div>
                    <div class="form-group">
                        <label>Section Subtitle</label>
                        <input type="text" name="team_section_subtitle" class="form-control" value="{{ old('team_section_subtitle', $about->team_section_subtitle) }}" required>
                    </div>
                    <a href="{{ route('admin.team.index') }}" class="btn btn-success">Manage Team Members</a>
                </div>
            </div>

            <!-- FAQ Section -->
            <div class="card card-secondary mt-4">
                <div class="card-header">
                    <h3 class="card-title">FAQ Section</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Section Title</label>
                        <input type="text" name="faq_section_title" class="form-control" value="{{ old('faq_section_title', $about->faq_section_title) }}" required>
                    </div>
                    <div class="form-group">
                        <label>Section Subtitle</label>
                        <input type="text" name="faq_section_subtitle" class="form-control" value="{{ old('faq_section_subtitle', $about->faq_section_subtitle) }}" required>
                    </div>
                    <div class="form-group">
                        <label>Contact Text</label>
                        <input type="text" name="faq_contact_text" class="form-control" value="{{ old('faq_contact_text', $about->faq_contact_text) }}" required>
                    </div>
                    <a href="{{ route('admin.about.faq-index') }}" class="btn btn-success">Manage FAQs</a>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>
    </form>
</div>
@endsection


<script>
$(document).ready(function () {
    $('.summernote').summernote({
        height: 300,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert', ['link', 'picture', 'hr']],
            ['view', ['fullscreen', 'codeview']]
        ]
    });

    $('.select2').select2({
        theme: 'bootstrap4',
        placeholder: 'Select categories'
    });
});


</script>

