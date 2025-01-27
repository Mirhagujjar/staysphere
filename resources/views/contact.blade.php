@extends('layouts.master')

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


h3 {
    color: #2C3E50;
    font-size: 2.5rem;
}

.img-fluid {
    border-radius: 50px;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    margin-top: 20px;
    max-width: 100%;

}


.contact-page {
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .form-container {
        background-color: #343A40;
        height: 88%;
        padding: 30px;
        border-radius: 15px;
        width: 100%;
        max-width: 600px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }

    .form-label {
        color: #2C3E50;
    }

    .btn-submit {

        background-color: #F1C40F;
        color: #2C3E50;
        border-radius: 5px;
        padding: 10px;
        width: 100%;



    }

    .btn-submit:hover {
        background-color: #1ABC9C;
        color: #F8F9FA;
    }
/* -----------------------------------Section3-------------------------------- */

.info-box {

    width: 550px;
    background-color:  #343A40;
    border-radius: 40px;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    text-align: center;
}

.contact-heading {

    color: #F8F9FA;
    font-weight: bold;
}

.info-item {
    font-size: 1.2rem;
    color: #F8F9FA;
}

.contact-icon {
    font-size: 1.5rem;
    color: #ea3636;
    margin-right: 10px;
}
.overlay-on-img {
    top: 50%;
    left: 8%;
    transform: translate(0, -50%);
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
    <div class="row">
        <!-- Left Column: Text and Image ----->
        <div class="col-md-6 d-flex flex-column justify-content-center align-items-center text-center">
            <h3 class="mb-2">Let's Start to Give Us a Message and Contact With Us</h3>
            <img src="{{asset('build/assets/images/mr1.jpg')}}" alt="Contact Image" class="img-fluid" style="max-width: 80%; border-radius: 15px;">
        </div>

        <!-- Right Column: Form------>
        <div class="col-md-6">
            <div class="contact-page">
                <div class="form-container">
                    <h2 class="text-center" style="color: #f7f9fa;">Contact Us</h2>
                    <form action="{{route('contact.store')}}" method="POST">
                        @csrf
                        <div class="mb-2">
                            <label for="name" class="form-label">Your Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter your full name" required>
                        </div>
                        <div class="mb-2">
                            <label for="email" class="form-label">Your Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                        </div>
                        <div class="mb-2">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter phone" required>
                        </div>
                        <div class="mb-2">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" id="message" name="message" rows="4" placeholder="Write your message here" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-submit">Send Message</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>


{{-- ----------------------------------Section3-------------------------------- --}}
<div class="container my-5 position-relative">
    <div class="row justify-content-center align-items-center" style="height: 100%">
        <div class="col-md-6 ">
            <div class="info-box p-4 position-absolute overlay-on-img ">
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
        <div class="col-md-6 d-flex justify-content-center align-items-center">
            <img src="{{ asset('build/assets/images/mr3.jpg') }}" alt="Contact Image" class="contact-image img-fluid">
        </div>
    </div>
</div>

</div>
@endsection







































{{-- @extends('layouts.master')

@section('content')
<div class="container mt-4">
    <h2>Contact Us</h2>
    <div class="row">
        <div class="col-md-6">
            <h4>Our Address</h4>
            <p> info@staysphere.com
                Lahore, Pakistan</p>
            <p>Email: support@hotel.com</p>
            <p>Phone: +123456789</p>
        </div>
        <div class="col-md-6">
            <h4>Send a Message</h4>
                <form action="{{route('contact.store')}}" method="POST">
                @csrf
                <div class="mb-3">
                    <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                </div>
                <div class="mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Your Email" required>
                </div>
                <div class="mb-3">
                    <textarea name="message" class="form-control" placeholder="Your Message" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Send</button>
            </form>
     
        </div>
    </div>
</div>
@endsection --}}
