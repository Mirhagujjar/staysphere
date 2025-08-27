@extends('layouts.app')

@section('content')
    <style>
        * {
            font-family: "Montserrat", Helvetica, sans-serif;
        }

        /* Section 1 - Banner */



        .half-screen-image {
            position: relative;
            height: 70vh;
            overflow: hidden;
        }

        .half-screen-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
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

        /* Section 2 - Contact Form */









        .contact-heading {
            font-size: 1.8rem;
            font-weight: bold;
            color: #2C3E50;

        }


        .contact-img {
            max-width: 100%;
            border-radius: 15px;
        }


        .form-container {
            background: #2C3E50;

            color: #f7f9fa;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            padding: 2rem;
        }


        .form-label {
            font-weight: bold;
        }






        .btn-submit {
            background-color: #F1C40F;

            color: #2C3E50;
            font-weight: bold;
            border: none;
            padding: 10px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .btn-submit:hover {
            background-color: #1ABC9C;

            color: #ffffff;
        }

        /* Section 3 - Contact Info */



































        .info-box {
            width: 100%;
            max-width: 550px;

            background-color: #343A40;
            border-radius: 40px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            padding: 20px;
            margin: 0 auto;

        }

        .info-box .contact-heading {

            color: #F8F9FA;

        }


        .info-item {
            font-size: 1.2rem;
            color: #F8F9FA;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
        }


        .contact-icon {
            font-size: 1.5rem;
            color: #ea3636;
            margin-right: 10px;
        }










        /* Responsive Adjustments */
        @media (max-width: 992px) {
            .overlay-text h1 {
                font-size: 2.5rem;
            }

            .info-box {
                max-width: 90%;
                border-radius: 30px;

            }
        }

        @media (max-width: 768px) {
            .half-screen-image {
                height: 50vh;


            }

            .overlay-text h1 {
                font-size: 2rem;
            }

            .breadcrumb-container {
                font-size: 16px;
            }

            .contact-heading {
                font-size: 1.5rem;
            }

            .form-container {
                padding: 1.5rem;
            }

            .info-box {
                border-radius: 25px;
                padding: 15px;
                margin-top: 2rem;
            }
        }

        @media (max-width: 576px) {
            .half-screen-image {
                height: 40vh;

            }

            .overlay-text h1 {
                font-size: 1.8rem;
            }

            .contact-heading {
                font-size: 1.3rem;
            }

            .info-box {
                border-radius: 20px;
                padding: 15px 10px;
            }

            .info-item {
                font-size: 1rem;
                justify-content: flex-start;
            }

            .contact-icon {
                font-size: 1.2rem;
            }
        }
    </style>













    {{-- Section 1 - Banner --}}
    <div class="half-screen-image">
        <img src="{{ asset($settings->half_page_image) }}" alt="Contact Banner">
        <div class="overlay-text">
            <h1>{{ $settings->banner_heading }}</h1>
            <div class="breadcrumb-container">
                <a href="/">Home</a> > {{ $settings->breadcrumb }}
            </div>







        </div>
    </div>



















    {{-- Section 2 - Contact Form --}}
    <div class="container my-5">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="text-center">
                    <h3 class="contact-heading mb-4">{{ $settings->left_section_text }}</h3>

























                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-container">
                    <h2 class="text-center mb-4">Contact Us</h2>
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}











                        </div>
                    @endif
                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Your Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter phone" required>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" id="message" name="message" rows="4" placeholder="Write your message here" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-submit w-100">Send Message</button>
                    </form>
                </div>
            </div>






        </div>
    </div>

    {{-- Section 3 - Contact Info --}}
    <div class="container my-5">
        <div class="row">
            <div class="col-lg-6 mb-4 mb-lg-0 d-flex justify-content-center align-items-center">
                <img src="{{ asset($settings->contact_section_image) }}" alt="Contact Image" class="img-fluid rounded">
            </div>

            <div class="col-lg-6 d-flex justify-content-center align-items-center">
                <div class="info-box">
                    <h3 class="contact-heading mb-4">{{ $settings->contact_info_heading }}</h3>
                    <div class="info-item">
                        <i class="bi bi-geo-alt contact-icon"></i>
                        <span>{{ $settings->right_section_address }}</span>
                    </div>
                    <div class="info-item">
                        <i class="bi bi-telephone contact-icon"></i>
                        <span>{{ $settings->right_section_phone }}</span>
                    </div>
                    <div class="info-item">
                        <i class="bi bi-envelope contact-icon"></i>
                        <span>{{ $settings->right_section_email }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection