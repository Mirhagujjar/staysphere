@extends('layouts.app')

@section('content')

<style>
    *{
        font-family: "Montserrat", Helvetica, sans-serif;
    }
    /* <!------------------------------- Top Banner ------------------------> */
    .half-screen-image {
    position: relative;
    height: 70vh;
    background: url('{{ asset('build/assets/images/multiproperty1.jpg') }}')  center/cover no-repeat;
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
     font-weight: bold;

    }


    .link-container {
     margin-top: 10px;
     font-size: 20px;
     font-weight: 500;
     color: #F8F9FA;
    }

    .link-container a {
     text-decoration: none;
     color: #F1C40F;
    }

    .link-container a:hover {
      color: #1ABC9C;
     }

     /* <!--------------------- Room Section -------------------------------> */

    .section-title h2 {
     font-size: 35px;
     font-weight: 600;
     margin-top: 0;
     line-height: 1.4;
     color: #2C3E50;
     margin-bottom: 0;
    }
    .text-center {
      text-align: center ;
     }


    /* ---------------------------------cards------------------------------ */

    .g-4{
      padding:10px;
    } 
    .card{
      margin-top: 60px;
      position: relative;
      background-color:#343A40;
      color: #F8F9FA;
    }

    .card-title {
        font-size: 1.2rem;
        font-weight: bold;
        text-align: center;
    }

    .card-text {
        text-align: center;
        font-size: 1rem;
    }

    /* ----------------Badges-----------------------*/
    .badge {

        position: absolute;
        top: 10px;
        left: 10px;
        padding: 5px 10px;
        font-size: 0.9rem;

    }


   /* ----------------------Card Hover------------------------ */

   .card-hover {
      position: relative;
      overflow: hidden;
    }

    .card-hover .card-overlay {
     position: absolute;
     top: 0;
     left: 0;
     width: 100%;
     height: 100%;
     background-color: rgba(0, 0, 0, 0.6);
     color: white;
     display: flex;
     flex-direction: column;
     justify-content: center;
     align-items: center;
     opacity: 0;
     transition: opacity 0.3s ease-in-out;
    }

    .card-hover:hover .card-overlay {
      opacity: 1;
    }

    .card-overlay .details {
      font-size: 0.9rem;
      margin-bottom: 10px;
      text-align: center;
     }

    .card-overlay .btn-book {
      background-color: #F1C40F;
      color: white;
      padding: 8px 15px;
      font-size: 0.9rem;
      border-radius: 5px;
      cursor: pointer;
      text-decoration: none;
    }

    /* -----------------------Facilities----------------------------- */
    .facilities-section {
        margin-top: 100px;
        margin-bottom: 100px;
        padding: 50px 20px;
        background: url('{{ asset('build/assets/images/natur.jpg') }}') center/cover no-repeat;
        position: relative;
        color: #fff;
    }

    .facilities-section h2 {
        font-size:4rem;
        text-align: center;
        margin-bottom: 30px;
        color: #ffffff;
    }

    .facility-item {

        background-color: rgba(0, 0, 0, 0.6);
        padding: 20px;
        border-radius: 10px;
        transition: transform 0.3s ease;
        color: #fff;
    }

    .facility-item i {
        font-size: 2rem;
        color: #F1C40F;
        margin-bottom: 10px;
    }

    .facility-item:hover {
        transform: scale(1.1);
    }

    /* -------------------last----------------- */
    .margin_120_95 {
      padding-top: 120px;
      padding-bottom: 95px;
    }

    .title small {
      text-transform: uppercase;
      color: #2C3E50;
      letter-spacing: 3px;
      font-weight: 600;
      font-size: 0.75rem;
    }

    .title h2 {
      font-weight: 700;
      font-size: 2.375rem;
      color: #333;
      margin-bottom: 15px;
    }

    .phone_element a {
      display: flex;
      align-items: center;
      text-decoration: none;
      color: #978667;
    }

    .phone_element a i {
      margin-right: 15px;
      font-size: 1.875rem;
      color: #2C3E50;
    }

    .phone_element a span {
      font-size: 1.125rem;
      font-weight: 600;
      color:#2C3E50;
    }

    .booking_wrapper {
      background-color: rgba(151, 134, 103, 0.05);
      border-radius: 10px;
      padding: 20px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    /* -----------------------filters- */
    .filters-sidebar {
      position: sticky;
      top: 100px;
      background:#343A40;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.1);
      margin-left: 20px;
    }
</style>

<!------------------------------- Top Banner ------------------------>
<div class="half-screen-image">
    <div class="half-screen-image">
        <div class="overlay-text">
            <h1>Rooms</h1>
            <p >Indulge in the ultimate blend of elegance and comfort in our meticulously designed rooms.</p>
            <div class="link-container">
                <a href="/">Home</a> > Rooms
            </div>
        </div>
    </div>
</div>

<!--------------------- Room Section ------------------------------->
{{-- <div class="container my-5">
    <div class="section-title text-center">
        <h2>Our Rooms & Rates</h2>
    </div>


     <div class="row g-4">
        <div class="col-lg-3">
            <div class="card p-3 shadow-sm">
                <h4>Filters</h4>
                <hr>

                <!-- Room Type -->
                <h6>Room Type</h6>
                <div>
                    <input type="radio" id="single" name="roomType"> <label for="single">Single Room</label> <br>
                    <input type="radio" id="double" name="roomType"> <label for="double">Double Room</label> <br>
                    <input type="radio" id="suite" name="roomType"> <label for="suite">Suite</label>
                </div>

                <!-- Price Range -->
                <h6 class="mt-3">Price Range</h6>
                <select class="form-select">
                    <option selected>5000 - 10000</option>
                    <option>10000 - 20000</option>
                    <option>20000 - 30000</option>
                </select>

                <!-- Facilities -->
                <h6 class="mt-3">Facilities</h6>
                <div>
                    <input type="checkbox" id="wifi"> <label for="wifi">WiFi</label> <br>
                    <input type="checkbox" id="ac"> <label for="ac">AC</label> <br>
                    <input type="checkbox" id="breakfast"> <label for="breakfast">Breakfast</label> <br>
                    <input type="checkbox" id="pool"> <label for="pool">Swimming Pool</label> <br>
                    <input type="checkbox" id="parking"> <label for="parking">Parking</label>
                </div>

                <!-- Guest Capacity -->
                <h6 class="mt-3">Guest Capacity</h6>
                <select class="form-select">
                    <option>1 Person</option>
                    <option>2 Persons</option>
                    <option>Family</option>
                </select>

                <!-- Sort By -->
                <h6 class="mt-3">Sort By</h6>
                <select class="form-select">
                    <option selected>Price: Low to High</option>
                    <option>Price: High to Low</option>
                    <option>Most Popular</option>
                </select>

                <button class="btn btn-warning mt-3 w-100">Apply Filters</button>
                <button class="btn btn-outline-danger mt-2 w-100">Reset</button>
            </div>
        </div>
        <!-- Card 1 -->
        <div class="col-md-4">
            <div class="card card-hover">
                <span class="badge text-bg-success">NEW</span>
                <img src="{{ asset('assets/images/room1.png') }}" class="card-img-top" alt="Luxury Room">
                <div class="card-body">
                    <h5 class="card-title">Luxury Room</h5>
                    <p class="card-text">$320 / Per Night</p>
                </div>
                <div class="card-overlay">
                    <div class="details">
                        <p>4 Guests</p>
                        <p>70ft Room Size</p>
                        <p>$320 / Per Night</p>
                    </div>
                    <a href="{{route('room_booking.create')}}" class="btn-book">Book Now</a>
                </div>

            </div>
        </div>

        <!-- Card 2 -->
        <div class="col-md-4">
            <div class="card card-hover">
                <span class="badge text-bg-danger">SALE</span>
                <img src="{{ asset('assets/images/room2.png') }}" class="card-img-top" alt="Deluxe Room">
                <div class="card-body">
                    <h5 class="card-title">Deluxe Room</h5>
                    <p class="card-text">$280 / Per Night</p>
                </div>
                <div class="card-overlay">
                    <div class="details">
                        <p>2 Guests</p>
                        <p>35ft Room Size</p>
                        <p>$280 / Per Night</p>
                    </div>
                    <a href="{{route('room_booking.create')}}" class="btn-book">Book Now</a>
                </div>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="col-md-4">
            <div class="card card-hover">
                <img src="{{ asset('assets/images/room3.png') }}" class="card-img-top" alt="Standard Room">
                <div class="card-body">
                    <h5 class="card-title">Family Suite</h5>
                    <p class="card-text">$200 / Per Night</p>
                </div>
                <div class="card-overlay">
                    <div class="details">
                        <p>4 Guests</p>
                        <p>60ft Room Size</p>
                        <p>$200 / Per Night</p>
                    </div>
                    <a href="{{route('room_booking.create')}}" class="btn-book">Book Now</a>
                </div>
            </div>
        </div>


         <!-- Card 4 -->
        <div class="col-md-4">
            <div class="card card-hover">
                <img src="{{ asset('assets/images/room4.png') }}" class="card-img-top" alt="Standard Room">
                <div class="card-body">
                    <h5 class="card-title">Standard Room</h5>
                    <p class="card-text">$120 / Per Night</p>
                </div>

                <div class="card-overlay">
                    <div class="details">
                        <p>2 Guests</p>
                        <p>30ft Room Size</p>
                        <p>$120 / Per Night</p>
                    </div>
                    <a href="{{route('room_booking.create')}}" class="btn-book">Book Now</a>
                </div>
            </div>
        </div>


         <!-- Card 5 -->

        <div class="col-md-4">
            <div class="card card-hover">
                <img src="{{ asset('assets/images/room5.png') }}" class="card-img-top" alt="Standard Room">
                <div class="card-body">
                    <h5 class="card-title">Standard Room</h5>
                    <p class="card-text">$120 / Per Night</p>
                </div>
                <div class="card-overlay">
                    <div class="details">
                        <p>2 Guests</p>
                        <p>30ft Room Size</p>
                        <p>$120 / Per Night</p>
                    </div>
                    <a href="{{route('room_booking.create')}}" class="btn-book">Book Now</a>
                </div>
            </div>
        </div>

         <!-- Card 6 -->
        <div class="col-md-4">
            <div class="card card-hover">
                <img src="{{ asset('assets/images/room6.png') }}" class="card-img-top" alt="Standard Room">
                <div class="card-body">
                    <h5 class="card-title">Standard Room</h5>
                    <p class="card-text">$120 / Per Night</p>
                </div>

                <div class="card-overlay">
                    <div class="details">
                        <p>2 Guests</p>
                        <p>30ft Room Size</p>
                        <p>$120 / Per Night</p>
                    </div>
                    <a href="{{route('room_booking.create')}}" class="btn-book">Book Now</a>
                </div>
            </div>
        </div>



</div> --}}
<div class="container1 my-5">
    <div class="section-title text-center">
        <h2>Our Rooms & Rates</h2>
    </div>

    <div class="row g-4">
        <!-- Filters Sidebar (Left) -->
        <div class="col-lg-3">
            <div class="card p-3 shadow-sm filters-sidebar">
                <h4>Filters</h4>
                <hr>
                <h6>Room Type</h6>
                <div>
                    <input type="radio" id="single" name="roomType"> <label for="single">Single Room</label> <br>
                    <input type="radio" id="double" name="roomType"> <label for="double">Double Room</label> <br>
                    <input type="radio" id="suite" name="roomType"> <label for="suite">Suite</label>
                </div>

                <h6 class="mt-3">Price Range</h6>
                <select class="form-select">
                    <option selected>5000 - 10000</option>
                    <option>10000 - 20000</option>
                    <option>20000 - 30000</option>
                </select>

                <h6 class="mt-3">Facilities</h6>
                <div>
                    <input type="checkbox" id="wifi"> <label for="wifi">WiFi</label> <br>
                    <input type="checkbox" id="ac"> <label for="ac">AC</label> <br>
                    <input type="checkbox" id="breakfast"> <label for="breakfast">Breakfast</label> <br>
                    <input type="checkbox" id="pool"> <label for="pool">Swimming Pool</label> <br>
                    <input type="checkbox" id="parking"> <label for="parking">Parking</label>
                </div>

                <h6 class="mt-3">Guest Capacity</h6>
                <select class="form-select">
                    <option>1 Person</option>
                    <option>2 Persons</option>
                    <option>Family</option>
                </select>

                <h6 class="mt-3">Sort By</h6>
                <select class="form-select">
                    <option selected>Price: Low to High</option>
                    <option>Price: High to Low</option>
                    <option>Most Popular</option>
                </select>

                <button class="btn btn-warning mt-3 w-100">Apply Filters</button>
                <button class="btn btn-outline-danger mt-2 w-100">Reset</button>
            </div>
        </div>

        <!-- Rooms Display (Right) -->
        <div class="col-lg-9">
            <div class="row g-4">
                <!-- Card 1 -->
                <div class="col-md-4">
                    <div class="card card-hover">
                        <span class="badge text-bg-success">NEW</span>
                        <img src="{{ asset('build/assets/images/room1a.jpg') }}" class="card-img-top" alt="Luxury Room">
                        <div class="card-body">
                            <h5 class="card-title">Luxury Room</h5>
                            <p class="card-text">30000 / Per Night</p>
                        </div>
                        <div class="card-overlay">
                            <div class="details">
                                <p>4 Guests</p>
                                <p>70ft Room Size</p>
                                <p>30000 / Per Night</p>
                            </div>
                            <a href="{{route('reservations.create')}}" class="btn-book">Book Now</a>
                        </div>
                    </div>
                </div>
                <!-- Card 1 -->
                <div class="col-md-4">
                    <div class="card card-hover">
                        <img src="{{ asset('build/assets/images/room2.jpg') }}" class="card-img-top" alt="Luxury Room">
                        <div class="card-body">
                            <h5 class="card-title">Luxury Room</h5>
                            <p class="card-text">28000 / Per Night</p>
                        </div>
                        <div class="card-overlay">
                            <div class="details">
                                <p>4 Guests</p>
                                <p>70ft Room Size</p>
                                <p>28000 / Per Night</p>
                            </div>
                            <a href="{{route('reservations.create')}}" class="btn-book">Book Now</a>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="col-md-4">
                    <div class="card card-hover">
                        <span class="badge text-bg-danger">SALE</span>
                        <img src="{{ asset('build/assets/images/room3.jpg') }}" class="card-img-top" alt="Deluxe Room">
                        <div class="card-body">
                            <h5 class="card-title">Deluxe Room</h5>
                            <p class="card-text">25000/ Per Night</p>
                        </div>
                        <div class="card-overlay">
                            <div class="details">
                                <p>2 Guests</p>
                                <p>35ft Room Size</p>
                                <p>25000 / Per Night</p>
                            </div>
                            <a href="{{route('reservations.create')}}" class="btn-book">Book Now</a>
                        </div>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="col-md-4">
                    <div class="card card-hover">
                        <img src="{{ asset('build/assets/images/room4.jpg') }}" class="card-img-top" alt="Standard Room">
                        <div class="card-body">
                            <h5 class="card-title">Family Suite</h5>
                            <p class="card-text">20000 / Per Night</p>
                        </div>
                        <div class="card-overlay">
                            <div class="details">
                                <p>4 Guests</p>
                                <p>60ft Room Size</p>
                                <p>20000/ Per Night</p>
                            </div>
                            <a href="{{route('reservations.create')}}" class="btn-book">Book Now</a>
                        </div>
                    </div>
                </div>

                 <!-- Card 4 -->
        <div class="col-md-4">
            <div class="card card-hover">
                <img src="{{ asset('build/assets/images/room5.jpg') }}" class="card-img-top" alt="Standard Room">
                <div class="card-body">
                    <h5 class="card-title">Standard Room</h5>
                    <p class="card-text">10000 / Per Night</p>
                </div>

                <div class="card-overlay">
                    <div class="details">
                        <p>2 Guests</p>
                        <p>30ft Room Size</p>
                        <p>10000/ Per Night</p>
                    </div>
                    <a href="{{route('reservations.create')}}" class="btn-book">Book Now</a>
                </div>
            </div>
        </div>


         <!-- Card 5 -->

        <div class="col-md-4">
            <div class="card card-hover">
                <img src="{{ asset('build/assets/images/room6.jpg') }}" class="card-img-top" alt="Standard Room">
                <div class="card-body">
                    <h5 class="card-title">Standard Room</h5>
                    <p class="card-text">10000 / Per Night</p>
                </div>
                <div class="card-overlay">
                    <div class="details">
                        <p>2 Guests</p>
                        <p>30ft Room Size</p>
                        <p>10000/ Per Night</p>
                    </div>
                    <a href="{{route('reservations.create')}}" class="btn-book">Book Now</a>
                </div>
            </div>
        </div>

         <!-- Card 6 -->
        <div class="col-md-4">
            <div class="card card-hover">
                <img src="{{ asset('build/assets/images/room7a.jpg') }}" class="card-img-top" alt="Standard Room">
                <div class="card-body">
                    <h5 class="card-title">Standard Room</h5>
                    <p class="card-text">10000 / Per Night</p>
                </div>

                <div class="card-overlay">
                    <div class="details">
                        <p>2 Guests</p>
                        <p>30ft Room Size</p>
                        <p>10000/ Per Night</p>
                    </div>
                    <a href="{{route('reservations.create')}}" class="btn-book">Book Now</a>
                </div>
            </div>
        </div>


        <div class="col-md-4">
            <div class="card card-hover">
                <img src="{{ asset('build/assets/images/room8.jpg') }}" class="card-img-top" alt="Standard Room">
                <div class="card-body">
                    <h5 class="card-title">Standard Room</h5>
                    <p class="card-text">15000 / Per Night</p>
                </div>

                <div class="card-overlay">
                    <div class="details">
                        <p>2 Guests</p>
                        <p>30ft Room Size</p>
                        <p>15000 / Per Night</p>
                    </div>
                    <a href="{{route('reservations.create')}}" class="btn-book">Book Now</a>
                </div>
            </div>
        </div> <div class="col-md-4">
            <div class="card card-hover">
                <img src="{{ asset('build/assets/images/room9.jpg') }}" class="card-img-top" alt="Standard Room">
                <div class="card-body">
                    <h5 class="card-title">Standard Room</h5>
                    <p class="card-text">8000/ Per Night</p>
                </div>

                <div class="card-overlay">
                    <div class="details">
                        <p>2 Guests</p>
                        <p>30ft Room Size</p>
                        <p>8000 / Per Night</p>
                    </div>
                    <a href="{{route('reservations.create')}}" class="btn-book">Book Now</a>
                </div>
            </div>
        </div>

        </div>
    </div>
</div>

{{-- ----------------------------Fcilities------------------------------ --}}
<div class="facilities-section">
    <h2 class="text-center mb-4">Main Facilities</h2>
    <div class="container">
        <div class="row g-4">
            <!-- Facility 1 -->
            <div class="col-md-3">
                <div class="facility-item text-center">
                    <i class="bi bi-car-front"></i>
                    <h5>Car Parking</h5>
                </div>
            </div>
            <!-- Facility 2 -->
            <div class="col-md-3">
                <div class="facility-item text-center">
                    <i class="bi bi-wifi"></i>
                    <h5>High-Speed Wifi</h5>
                </div>
            </div>
            <!-- Facility 3 -->
            <div class="col-md-3">
                <div class="facility-item text-center">
                    <i class="bi bi-water"></i>
                    <h5>Swimming Pool</h5>
                </div>
            </div>
            <!-- Facility 4 -->
            <div class="col-md-3">
                <div class="facility-item text-center">
                    <i class="bi bi-cup-straw"></i>
                    <h5>Free Breakfast</h5>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- -------------------------last---------------------- --}}

<div class="container py-5" id="booking_section">
    <div class="row justify-content-between align-items-center">
        <!-- Left Section -->
        <div class="col-xl-4 mb-4">
            <div class="title">
                <small>StaySphere Hotel</small>
                <h2>Check Availability</h2>
            </div>
            <p>Discover the ultimate luxury experience. Book your stay with us for unforgettable memories.</p>
            <p class="phone_element no_borders">
                <a href="tel://423424234">
                    <i class="bi bi-telephone-fill"></i>
                    <span>
                        <em>Info and bookings</em> <br>+92 123 456 7890
                    </span>
                </a>
            </p>
        </div>

        <!-- Right Section -->
        <div class="col-xl-7">
            <div class="booking_wrapper bg-light p-4 rounded shadow">
                <form>

                    <div class="mb-3">
                        <input type="date" class="form-control" id="date_booking" name="date_booking" placeholder="Select Date">
                    </div>


                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <select class="form-select">
                                <option>Select Room</option>
                                <option>Double Room</option>
                                <option>Deluxe Room</option>
                                <option>Superior Room</option>
                                <option>Junior Suite</option>
                            </select>
                        </div>


                        <div class="col-lg-6 mb-3">
                            <div class="row">
                                <div class="col-6">
                                    <input type="number" class="form-control" id="adults_booking" placeholder="Adults">
                                </div>
                                <div class="col-6">
                                    <input type="number" class="form-control" id="childs_booking" placeholder="Children">
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="text-end">
                        <button type="submit" class=" rounded-pill px-4 py-2">Book Now</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



@endsection