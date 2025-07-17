@extends('layouts.app')

@section('content')
    <style>
        * {
            box-sizing: border-box;
        }

        html,
        body {
            overflow-x: hidden;
            margin: 0;
            padding: 0;
        }

        /* ------------------------------- Top Banner ------------------------ */
        .half-screen-image {
            background: url('{{ $about->banner_image ? asset($about->banner_image) : asset('build/assets/images/about1.jpg') }}') center/cover no-repeat;
            position: relative;
            height: 75vh;
        }

        .overlay-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: #F8F9FA;
        }

        .overlay-text h1 {
            font-size: 4rem;
            margin: 0;
        }

        p.lead {
            font-size: 18px;
            line-height: 32px;
            margin-top: 0;
            font-weight: 300;
        }

        .breadcrumb-container {
            margin-top: 10px;
            font-size: 20px;
            font-weight: 500;
            color: #F8F9FA;
        }

        .breadcrumb-container a {
            text-decoration: none;
            color: #F1C40F;
        }

        .breadcrumb-container a:hover {
            color: #1ABC9C;
        }

        /* -------------------------2------------------------ */
        .section-container {
            padding: 120px 0 95px;
        }

        .rounded-img {
            border-radius: 10px;
            max-width: 100%;
            height: auto;
        }

        .position-relative .overlay-img {
            position: absolute;
            width: 50%;
            top: 50%;
            right: -115px;
            transform: translateY(-50%);
            border: 5px solid white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .margin {
            margin-right: 1em;
            margin-left: 1em;
        }

        .history-title {
            font-family: "Montserrat", Helvetica, sans-serif;
        }

        .history-title small {
            color: #000000;
            font-weight: bold;
            text-transform: uppercase;
        }

        .history-title h2 {
            margin-top: 10px;
            margin-left: 5px;
            font-size: 2rem;
            font-weight: bold;
        }

        .history-text {
            line-height: 1.8;
            color: #000000;
        }

        .row.align-items-center {
            gap: 150px;
        }

        /* Responsiveness*/
        @media (max-width: 1200px) {
            .row.align-items-center {
                gap: 100px;
            }

            .position-relative .overlay-img {
                right: -90px;
            }
        }

        @media (max-width: 760px) {
            .position-relative .overlay-img {
                position: relative;
                width: 70%;
                margin-top: 15px;
                right: 0;
                transform: translateY(0);
            }

            .row.align-items-center {
                gap: 100px;
                margin-left: 3px;
                margin-right: 3px;
            }
        }
        /* ----------------------------4------------------------ */
        .our-team-section {
            background-color: #f8f9fa;
            color: #ffffff;
        }

        .section-title {
            font-size: 2rem;
            font-weight: bold;
            color: #050505;
        }

        .section-subtitle {
            font-size: 1.2rem;
            color: #000000;
            margin-top: 10px;
        }

        .team-card {
            background-color: #343A40;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid #ddd;
            height: 100%;
        }

        .team-card:hover {
            transform: scale(1.05);
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.15);
        }

        .team-image img {
            width: 120px;
            height: 120px;
            border: 5px solid #1ABC9C;
            padding: 5px;
        }

        .team-description {
            font-size: 0.9rem;
            color: #ffffff;
        }

        .social-links a {
            color: #ffffff;
            font-size: 1.2rem;
            transition: color 0.3s ease;
        }

        .social-links a:hover {
            color: #1ABC9C;
        }

        /* ------------------------------------5---------------------------- */
        .faq-section {
            margin-top: 50px;
            background-color: #343A40;
            padding: 50px 0;
        }

        .title small {
            color: #ffffff;
            font-size: 0.9rem;
        }

        .title h3 {
            font-size: 1.8rem;
            font-weight: bold;
            color: #ffffff;
        }

        .title p {
            color: #ffffff;
        }

        .accordion .card {
            border: none;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .accordion .card-header {
            background-color: #fff;
            border-bottom: none;
            padding: 15px 20px;
        }

        .accordion .btn-link {
            text-decoration: none;
            font-size: 1rem;
            font-weight: 500;
            color: #2c3e50;
            display: flex;
            align-items: center;
        }

        .accordion .btn-link i {
            transition: transform 0.3s ease;
        }

        .accordion .btn-link.collapsed i {
            transform: rotate(0deg);
        }

        .accordion .btn-link:not(.collapsed) i {
            transform: rotate(45deg);
        }

        .accordion .card-body {
            background-color: #fff;
            color: #6c757d;
            padding: 20px;
            font-size: 0.95rem;
        }
    </style>

    {{-- Top Banner --}}
    <div class="half-screen-image">
        <div class="overlay-text">
            <p class="mt-3 lead">{{ $about->banner_subtitle }}</p>
            <h1>{{ $about->banner_title }}</h1>
            <div class="breadcrumb-container">
                <a href="/">Home</a> > AboutUs
            </div>
        </div>
    </div>

    {{-- History Section --}}
    <div class="container section-container">
        <div class="row align-items-center">
            {{-- Left --}}
            <div class="col-lg-5 col-md-6 position-relative text-center">
                <img src="{{ $about->main_image ? asset($about->main_image) : asset('assets/images/aboutus/about3.jpg') }}"
                    alt="Main Image" class="img-fluid rounded-img main-img">

                <img src="{{ $about->overlay_image ? asset($about->overlay_image) : asset('assets/images/aboutus/about2.jpg') }}"
                    alt="Overlay Image" class="img-fluid rounded-img overlay-img">
            </div>
            {{-- Right --}}
            <div class="col-lg-5 col-md-6 margin">
                <div class="history-title">
                    <small>{{ $about->history_subtitle }}</small>
                    <h2>{{ $about->history_title }}</h2>
                </div>
                <p class="history-text">{!! nl2br(e($about->history_content)) !!}</p>
            </div>
        </div>
    </div>

    {{-- Team Section --}}
    <div class="our-team-section py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">{{ $about->team_section_title }}</h2>
                <p class="section-subtitle">{{ $about->team_section_subtitle }}</p>
            </div>
            <div class="row gy-4">
                @foreach($teamMembers as $member)
                <div class="col-md-4">
                    <div class="team-card text-center p-4 shadow rounded">
                        <div class="team-image">
                            <img src="{{ $member->image ? asset($member->image) : asset('assets/images/team1.jpg') }}"
                                alt="{{ $member->name }}" class="img-fluid rounded-circle">
                        </div>

                        <h5 class="mt-3">{{ $member->name }}</h5>
                        <p>{{ $member->position }}</p>
                        <p class="team-description">{{ $member->description }}</p>
                        <div class="social-links mt-3">
                            @if($member->facebook)
                            <a href="{{ $member->facebook }}" class="me-3"><i class="bi bi-facebook"></i></a>
                            @endif
                            @if($member->twitter)
                            <a href="{{ $member->twitter }}" class="me-3"><i class="bi bi-twitter"></i></a>
                            @endif
                            @if($member->linkedin)
                            <a href="{{ $member->linkedin }}"><i class="bi bi-linkedin"></i></a>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- FAQ Section --}}
    <div class="faq-section py-5">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-4">
                    <div class="title mb-4">
                        <small>{{ $about->faq_section_subtitle }}</small>
                        <h3 class="mb-3">{{ $about->faq_section_title }}</h3>
                        <p>{{ $about->faq_contact_text }}</p>
                        <a href="{{ route('user.contact') }}" class="btn btn-warning mt-3">Contact Us</a>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="accordion" id="faqAccordion">
                        @foreach($faqs as $key => $faq)
                        <div class="card mb-3">
                            <div class="card-header" id="heading{{ $key }}">
                                <h5 class="mb-0">
                                    <button class="btn btn-link text-dark collapsed" data-bs-toggle="collapse"
                                            data-bs-target="#collapse{{ $key }}" aria-expanded="false"
                                            aria-controls="collapse{{ $key }}">
                                        <i class="bi bi-plus-circle me-2"></i> {{ $faq->question }}
                                    </button>
                                </h5>
                            </div>
                            <div id="collapse{{ $key }}" class="collapse" aria-labelledby="heading{{ $key }}"
                                 data-bs-parent="#faqAccordion">
                                <div class="card-body">
                                    {!! nl2br(e($faq->answer)) !!}
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
