@extends('layouts.master')

@section('content')

 {{-- slider --}}
 <div id="carouselExampleDark" class="carousel slide carousel-fade" data-bs-ride="carousel" >
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
      <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="3" aria-label="Slide 4"></button>
      <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="4" aria-label="Slide 5"></button>
      <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="5" aria-label="Slide 6"></button>
      <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="6" aria-label="Slide 7"></button>
      <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="7" aria-label="Slide 8"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active" data-bs-interval="2000">
        <img src="{{ asset('build/assets/images/slider.jpg')}}" class="d-block w-100" alt="first slider">
        <div class="carousel-caption d-none d-md-block">
          <h1>StaySphere</h1>
          <h4>"Experience the Art of Hospitality"</h4>
        </div>
      </div>
      <div class="carousel-item " data-bs-interval="2000">
        <img src="{{ asset('build/assets/images/slider1.jpg')}}" class="d-block w-100" alt="second slider">
        <div class="carousel-caption d-none d-md-block">
          <h1>StaySphere</h1>
          <h4>"Stay Easy, Live Luxuriously"</h4>
        </div>
      </div>
      <div class="carousel-item carousel-dark" data-bs-interval="2000">
        <img src="{{ asset('build/assets/images/slider2.jpg')}}" class="d-block w-100" alt="third slider">
        <div class="carousel-caption d-none d-md-block">
          <h1>StaySphere</h1>
          <h4>"Your Stay, Our Priority"</h4>
        </div>
      </div>

      <div class="carousel-item" data-bs-interval="2000">
        <img src="{{ asset('build/assets/images/slider3.jpg')}}" class="d-block w-100" alt="third slider">
        <div class="carousel-caption d-none d-md-block">
          <h1>StaySphere</h1>
          <h4>"Your Stay, Our Priority"</h4>
        </div>
      </div>

      <div class="carousel-item" data-bs-interval="2000">
        <img src="{{ asset('build/assets/images/slider4.jpg')}}" class="d-block w-100" alt="third slider">
        <div class="carousel-caption d-none d-md-block">
          <h1>StaySphere</h1>
          <h4>"Your Stay, Our Priority"</h4>
        </div>
      </div>

      <div class="carousel-item carousel-dark" data-bs-interval="2000">
        <img src="{{ asset('build/assets/images/slider5.jpg')}}" class="d-block w-100" alt="third slider">
        <div class="carousel-caption d-none d-md-block">
          <h1>StaySphere</h1>
          <h4>"Your Stay, Our Priority"</h4>
        </div>
      </div>

      <div class="carousel-item carousel-dark" data-bs-interval="2000">
        <img src="{{ asset('build/assets/images/slider6.jpg')}}" class="d-block w-100" alt="third slider">
        <div class="carousel-caption d-none d-md-block">
          <h1>StaySphere</h1>
          <h4>"Your Stay, Our Priority"</h4>
        </div>
      </div>

      <div class="carousel-item carousel-dark" data-bs-interval="2000">
        <img src="{{ asset('build/assets/images/slider7.jpg')}}" class="d-block w-100" alt="third slider">
        <div class="carousel-caption d-none d-md-block">
          <h1>StaySphere</h1>
          <h4>"Your Stay, Our Priority"</h4>
        </div>
      </div>


    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>

<div class="container-fluid welcome-section">
    <div class="row justify-content-center text-center text-white">
        <div class="col-12 col-md-8">
            <h1 class="display-3 welcome-title">Welcome to Stay Sphere</h1>
            <p class="lead">Your perfect getaway awaits at Stay Sphere. Relax, unwind, and experience luxury like never before.</p>
        </div>
    </div>
</div>

<!-- Hotel Services Section -->
<div class="container hotel-services">
    <div class="row text-center">
        <div class="col-md-4">
            <div class="service-box">
                <h4 class="service-title">Luxurious Rooms</h4>
                <p>Comfortable, spacious rooms with breathtaking views. Your relaxation is our priority.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="service-box">
                <h4 class="service-title">24/7 Customer Service</h4>
                <p>We're here to assist you at all times, ensuring you have a seamless experience throughout your stay.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="service-box">
                <h4 class="service-title">Delicious Dining</h4>
                <p>Indulge in gourmet meals with fresh ingredients and exquisite flavors from around the world.</p>
            </div>
        </div>
    </div>
</div>

<!-- Call to Action -->
<div class="container text-center cta-section">
    <h2>Book Your Stay Now</h2>
    <p class="lead">Don't wait. Reserve your room today and experience the finest hospitality at Stay Sphere.</p>
    <a href="{{route('reservations.create')}}" class="btn btn-lg btn-primary">Book Now</a>
</div>

@endsection
