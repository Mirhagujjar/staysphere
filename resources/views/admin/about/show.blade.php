@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header bg-primary">
        <h3 class="card-title">About Us Page Preview</h3>
        <div class="card-tools">
            <a href="{{ route('admin.about.edit') }}" class="btn btn-light">
                <i class="fas fa-edit mr-1"></i> Edit Page
            </a>
        </div>
    </div>
    
    <div class="card-body">
        <!-- Banner Section -->
        <section class="mb-5">
            <div class="banner-preview" style="background-image: url('{{ $about->banner_image ? asset('storage/'.$about->banner_image) : asset('images/default-banner.jpg') }}'); height: 300px; background-size: cover; background-position: center; margin-bottom: 20px;">
                <div class="banner-overlay" style="background-color: rgba(0,0,0,0.5); height: 100%; display: flex; flex-direction: column; justify-content: center; align-items: center; color: white;">
                    <h1 style="font-size: 3rem;">{{ $about->banner_title }}</h1>
                    <p style="font-size: 1.2rem;">{{ $about->banner_subtitle }}</p>
                </div>
            </div>
        </section>

        <!-- History Section -->
        <section class="mb-5">
            <h2 class="section-title">{{ $about->history_title }}</h2>
            <h4 class="section-subtitle text-muted mb-4">{{ $about->history_subtitle }}</h4>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="position-relative mb-4">
                        <img src="{{ $about->main_image ? asset('storage/'.$about->main_image) : asset('images/default-history.jpg') }}" 
                             class="img-fluid rounded shadow" alt="Main Image">
                            <img src="{{ $about->overlay_image ? asset($about->overlay_image) : asset('assets/images/default-overlay.jpg') }}" alt="Overlay Image">
                             class="img-fluid rounded shadow position-absolute" 
                             style="width: 50%; bottom: -20px; right: -20px; border: 5px solid white;">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="history-content">
                        {!! nl2br(e($about->history_content)) !!}
                    </div>
                </div>
            </div>
        </section>

        <!-- Team Section -->
        <section class="mb-5">
            <h2 class="section-title">{{ $about->team_section_title }}</h2>
            <h4 class="section-subtitle text-muted mb-4">{{ $about->team_section_subtitle }}</h4>
            
            <div class="row">
                @foreach($teamMembers as $member)
                <div class="col-md-4 mb-4">
                    <div class="card team-member-card h-100">
                        <div class="card-body text-center">
                        <img src="{{ $member->image ? asset($member->image) : asset('assets/images/default-member.jpg') }}" alt="{{ $member->name }}"
                                 class="rounded-circle mb-3" width="150" height="150" style="object-fit: cover; border: 5px solid #17a2b8;">
                            <h4>{{ $member->name }}</h4>
                            <p class="text-primary">{{ $member->position }}</p>
                            <p>{{ $member->description }}</p>
                            <div class="social-links">
                                @if($member->facebook)
                                <a href="{{ $member->facebook }}" target="_blank" class="text-dark mx-1"><i class="fab fa-facebook-f"></i></a>
                                @endif
                                @if($member->twitter)
                                <a href="{{ $member->twitter }}" target="_blank" class="text-dark mx-1"><i class="fab fa-twitter"></i></a>
                                @endif
                                @if($member->linkedin)
                                <a href="{{ $member->linkedin }}" target="_blank" class="text-dark mx-1"><i class="fab fa-linkedin-in"></i></a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>

        <!-- FAQ Section -->
        <section class="mb-5">
            <h2 class="section-title">{{ $about->faq_section_title }}</h2>
            <h4 class="section-subtitle text-muted mb-4">{{ $about->faq_section_subtitle }}</h4>
            
            <div class="row">
                <div class="col-md-5">
                    <p class="lead">{{ $about->faq_contact_text }}</p>
                    <a href="{{ route('contact.index') }}" class="btn btn-warning">
                        <i class="fas fa-envelope mr-1"></i> Contact Us
                    </a>
                </div>
                <div class="col-md-7">
                    <div class="accordion" id="faqAccordion">
                        @foreach($faqs as $key => $faq)
                        <div class="card mb-2">
                            <div class="card-header" id="heading{{ $key }}">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" type="button" data-toggle="collapse" 
                                            data-target="#collapse{{ $key }}" aria-expanded="true" 
                                            aria-controls="collapse{{ $key }}">
                                        <i class="fas fa-question-circle mr-2 text-primary"></i>
                                        {{ $faq->question }}
                                    </button>
                                </h5>
                            </div>
                            <div id="collapse{{ $key }}" class="collapse" aria-labelledby="heading{{ $key }}" 
                                 data-parent="#faqAccordion">
                                <div class="card-body">
                                    {!! nl2br(e($faq->answer)) !!}
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </div>
    
    <div class="card-footer text-right">
        <a href="{{ route('admin.about.edit') }}" class="btn btn-primary">
            <i class="fas fa-edit mr-1"></i> Edit Page Content
        </a>
    </div>
</div>
@endsection

@section('css')
<style>
    .section-title {
        font-weight: 600;
        color: #343a40;
        margin-bottom: 0.5rem;
    }
    .section-subtitle {
        font-weight: 400;
    }
    .history-content {
        line-height: 1.8;
        font-size: 1.1rem;
    }
    .team-member-card {
        transition: all 0.3s ease;
        border: none;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    .team-member-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }
    .social-links a {
        font-size: 1.2rem;
        transition: all 0.3s ease;
    }
    .social-links a:hover {
        color: #17a2b8 !important;
        transform: translateY(-2px);
    }
    .accordion .card-header {
        background-color: #f8f9fa;
    }
    .accordion .btn-link {
        color: #343a40;
        text-decoration: none;
        width: 100%;
        text-align: left;
    }
</style>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        // Open first FAQ by default
        $('#collapse0').collapse('show');
    });
</script>
@endsection