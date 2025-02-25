@extends('layouts.app')

@section('content')

<style>
        *{
            font-family: "Montserrat", Helvetica, sans-serif;
        }
        /* .main{
            background-color:#D9D9D9;
        } */
    /* ----------------------------Section1------------------------ */
        .half-screen-image {
        position: relative;
        height: 70vh;
        background: url('{{ asset('build/assets/images/mr.jpg') }}')  center/cover no-repeat;
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
        font-size: 3rem;
        margin: 0;
    }

    .breadcrumb-container {
        margin-top: 10px;
        font-size: 18px;
        font-weight: 500;
        color: #F8F9FA;
    }

    .breadcrumb-container a {
        text-decoration: none;
        color: #F8F9FA;
    }

    .breadcrumb-container a:hover {
        color: #1ABC9C;
    }


    /* ------------------------------------Section2-------------------------------------- */


    /* Contact Section */
    .container {
        max-width: 1200px;
    }

    /* Heading */
    .contact-heading {
        font-size: 1.8rem;
        font-weight: bold;
        color: #2C3E50; /* Midnight Blue */
    }

    /* Image Styling */
    .contact-img {
        max-width: 80%;
        border-radius: 15px;
    }

    /* Form Container */
    .form-container {
        background: #2C3E50; /* Midnight Blue */
        color: #f7f9fa;
        border-radius: 10px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }

    /* Form Fields */
    .form-label {
        font-weight: bold;
    }

    .form-control {
        border-radius: 5px;
    }

    /* Submit Button */
    .btn-submit {
        background-color: #F1C40F; /* Soft Gold */
        color: #2C3E50;
        font-weight: bold;
        border: none;
        padding: 10px;
        border-radius: 5px;
        transition: all 0.3s ease-in-out;
    }

    .btn-submit:hover {
        background-color: #1ABC9C; /* Light Teal */
        color: #ffffff;
    }

    /* Responsive Adjustments */
    @media (max-width: 992px) {
        .contact-img {
            max-width: 100%;
        }
    }

    @media (max-width: 768px) {
        .row {
            flex-direction: column-reverse; /* Moves form above image on small screens */
        }

        .contact-heading {
            font-size: 1.5rem;
        }

        .form-container {
            padding: 20px;
        }
    }

    @media (max-width: 576px) {
        .contact-heading {
            font-size: 1.3rem;
        }

        .btn-submit {
            font-size: 0.9rem;
            padding: 8px;
        }
    }

    /* -----------------------------------Section3-------------------------------- */

  /* Contact Info Box */
    .info-box {
        width: 100%;
        max-width: 550px;  /* Keep size limited */
        background-color: #343A40;
        border-radius: 40px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        text-align: center;
        padding: 20px;
        position: relative; /* Fixes the overlapping issue */
    }

    /* Heading */
    .contact-heading {
        color: #F8F9FA;
        font-weight: bold;
    }

    /* Contact Info */
    .info-item {
        font-size: 1.2rem;
        color: #F8F9FA;
    }

    /* Icons */
    .contact-icon {
        font-size: 1.5rem;
        color: #ea3636;
        margin-right: 10px;
    }

    /* Fix Footer Overlapping */
    .overlay-on-img {
        position: relative; /* Instead of absolute */
        top: auto;
        left: auto;
        transform: none;
    }

    /* Responsive Adjustments */
    @media (max-width: 992px) {
        .info-box {
            max-width: 90%;
            border-radius: 20px;
            padding: 15px;
        }
    }

    @media (max-width: 768px) {
        .row {
            flex-direction: column-reverse; /* Ensures image appears below info box */
            text-align: center;
        }

        .info-box {
            width: 90%;
        }

        .contact-icon {
            font-size: 1.3rem;
        }

        .info-item {
            font-size: 1rem;
        }
    }

    @media (max-width: 576px) {
        .info-box {
            width: 95%;
            padding: 10px;
        }

        .contact-heading {
            font-size: 1.3rem;
        }

        .contact-icon {
            font-size: 1.2rem;
        }
    }


</style>
{{-- ------------------------Section1--------------------------- --}}
<div class="main">
    <div class="half-screen-image">
        <div class="half-screen-image">
            <div class="overlay-text">
                <h1>Contact Us</h1>
                <div class="breadcrumb-container">
                    <a href="/welcome">Home</a> > Contact Us
                </div>
            </div>
        </div>
    </div>
    {{-- ----------------------------------Section2-------------------------------- --}}
    <div class="container my-5">
        <div class="row align-items-center">
            <!-- Left Column: Text and Image -->
            <div class="col-lg-6 d-flex flex-column justify-content-center align-items-center text-center " >
                <h3 class="mb-3 contact-heading" style="color: midnightblue">Let's Start to Give Us a Message and Contact With Us</h3>
                <img src="{{asset('build/assets/images/mr1.jpg')}}" alt="Contact Image" class="img-fluid contact-img">
            </div>
    
            <!-- Right Column: Form -->
            <div class="col-lg-6">
                <div class="contact-page">
                    <div class="form-container p-4">
                        <h2 class="text-center">Contact Us</h2>
                        <form action="{{route('contact.store')}}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Your Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter your full name" required>
                            </div>
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
    </div>
    
    {{-- ----------------------------------Section3-------------------------------- --}}
    <div class="container my-5 position-relative">
        <div class="row justify-content-center align-items-center">
            <!-- Left Column: Contact Info Box -->
            <div class="col-lg-6 col-md-8 col-sm-10 d-flex justify-content-center">
                <div class="info-box p-4">
                    <h3 class="contact-heading mb-4">Contact Info</h3>
                    <div class="info-item d-flex align-items-center mb-3">
                        <i class="bi bi-geo-alt contact-icon"></i>
                        <span>Lahore, Pakistan</span>
                    </div>
                    <div class="info-item d-flex align-items-center mb-3">
                        <i class="bi bi-telephone contact-icon"></i>
                        <span>+92 123 456 7890</span>
                    </div>
                    <div class="info-item d-flex align-items-center mb-3">
                        <i class="bi bi-envelope contact-icon"></i>
                        <span>info@staysphere.com</span>
                    </div>
                </div>
            </div>
    
            <!-- Right Column: Image -->
            <div class="col-lg-6 col-md-8 col-sm-10 d-flex justify-content-center align-items-center">
                <img src="{{ asset('build/assets/images/mr3.jpg') }}" alt="Contact Image" class="contact-image img-fluid">
            </div>
        </div>
    </div>
    
</div>
@endsection
