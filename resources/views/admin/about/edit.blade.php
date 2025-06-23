
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

{{-- @push('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Team Members
        let teamMemberCounter = {{ count($teamMembers) }};
        let deletedTeamMembers = [];
        
        // Add Team Member - Fixed event binding
        $(document).on('click', '#add-team-member', function() {
            const tempId = 'new_' + Date.now();
            const html = `
                <div class="card card-primary mb-3 team-member" data-temp-id="${tempId}">
                    <div class="card-header">
                        <h3 class="card-title">New Team Member</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool remove-team-member">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <input type="hidden" name="team_members[${tempId}][temp_id]" value="${tempId}">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="team_members[${tempId}][name]" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Position</label>
                            <input type="text" name="team_members[${tempId}][position]" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="team_members[${tempId}][description]" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" name="team_member_image[${tempId}]" class="form-control-file">
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Facebook URL</label>
                                    <input type="url" name="team_members[${tempId}][facebook]" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Twitter URL</label>
                                    <input type="url" name="team_members[${tempId}][twitter]" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>LinkedIn URL</label>
                                    <input type="url" name="team_members[${tempId}][linkedin]" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Order</label>
                            <input type="number" name="team_members[${tempId}][order]" class="form-control" value="0">
                        </div>
                    </div>
                </div>
            `;
            $('#team-members-container').append(html);
            teamMemberCounter++;
        });

        // Remove Team Member - Fixed event binding
        $(document).on('click', '.remove-team-member', function() {
            const card = $(this).closest('.team-member');
            const id = card.data('id');
            if (id) {
                if (!deletedTeamMembers.includes(id)) {
                    deletedTeamMembers.push(id);
                    $('#deleted-team-members').val(deletedTeamMembers.join(','));
                }
            }
            card.remove();
        });

        // FAQs
        let faqCounter = {{ count($faqs) }};
        let deletedFaqs = [];
        
        // Add FAQ - Fixed event binding
        $(document).on('click', '#add-faq', function() {
            const tempId = 'new_' + Date.now();
            const html = `
                <div class="card card-primary mb-3 faq-item" data-temp-id="${tempId}">
                    <div class="card-header">
                        <h3 class="card-title">New FAQ</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool remove-faq">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <input type="hidden" name="faqs[${tempId}][temp_id]" value="${tempId}">
                        <div class="form-group">
                            <label>Question</label>
                            <input type="text" name="faqs[${tempId}][question]" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Answer</label>
                            <textarea name="faqs[${tempId}][answer]" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label>Order</label>
                            <input type="number" name="faqs[${tempId}][order]" class="form-control" value="0">
                        </div>
                    </div>
                </div>
            `;
            $('#faqs-container').append(html);
            faqCounter++;
        });

        // Remove FAQ - Fixed event binding
        $(document).on('click', '.remove-faq', function() {
            const card = $(this).closest('.faq-item');
            const id = card.data('id');
            if (id) {
                if (!deletedFaqs.includes(id)) {
                    deletedFaqs.push(id);
                    $('#deleted-faqs').val(deletedFaqs.join(','));
                }
            }
            card.remove();
        });
    });
</script>
@endpush --}}