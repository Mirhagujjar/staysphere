@extends('layouts.app')

@section('content')
<style>
    * {
        font-family: "Montserrat", Helvetica, sans-serif;
        box-sizing: border-box;
        /* Ensure consistent box sizing */
    }

    html,
    body {
        overflow-x: hidden;
        /* Prevent horizontal overflow */
        margin: 0;
        /* Reset default margin */
        padding: 0;
        /* Reset default padding */
    }

    /* <!------------------------------- Top Banner ------------------------> */
    .half-screen-image {
        position: relative;
        height: 70vh;
        background: url('{{ asset('build/assets/images/r.jpg') }}') center/cover no-repeat;
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
        text-align: center;
    }

    /* ---------------------------------cards------------------------------ */
    .g-4 {
        padding: 10px;
    }

    .card {
        margin-top: 60px;
        position: relative;
        background-color: #343A40;
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
        background: url('{{ asset('build/assets/images/rf.jpg') }}') center/cover no-repeat;
        position: relative;
        color: #fff;
    }

    .facilities-section h2 {
        font-size: 4rem;
        text-align: center;
        margin-bottom: 30px;
        color: #131111;
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
        color: #2C3E50;
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
        background: #343A40;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.1);
        margin-left: 20px;
    }
</style>

    <!------------------------------- Top Banner ------------------------>
    <div class="half-screen-image">
        <div class="overlay-text">
            <h1>{{ $room->room_name }}</h1>
            <p>Indulge in the ultimate blend of elegance and comfort in our meticulously designed rooms.</p>
            <div class="link-container">
                <a href="/">Home</a> > <a href="{{ route('user.rooms.index') }}">Rooms</a> > {{ $room->room_name }}
            </div>
        </div>
    </div>

    <!--------------------- Room Details Section ------------------------------->
    <div class="container my-5">
        <div class="section-title text-center">
            <h2>Room Details</h2>
        </div>
    
        <div class="row">
            <div class="col-md-6">
                <img src="{{ asset($room->image) }}" alt="{{ $room->room_name }}" class="img-thumbnail" style="max-width: 500px; height: auto;">

            </div>
            <div class="col-md-6">
                <h3>Price: Rs. {{ number_format($room->price) }}</h3>
                <p>Capacity: {{ $room->room_capacity }} Persons</p>
                <p>Facilities: {{ $room->facilities }}</p>
                <p>Has View: {{ $room->has_view ? 'Yes' : 'No' }}</p>

                @if (isset($checkIn) && isset($checkOut) && $room->isBooked($checkIn, $checkOut))
                    <p class="text-danger">This room is already booked.</p>
                @else
                    <span class="badge bg-success">Available</span>
                    <a href="{{ route('user.reservations.create', ['room_id' => $room->id]) }}" class="btn btn-warning mt-3">
                        Book Now
                    </a>
                @endif
            </div>
        </div>
    </div>
    
    

    {{-- ----------------------------Facilities------------------------------ --}}
    {{-- <div class="facilities-section">
        <h2 class="text-center mb-4">Main Facilities</h2>
        <div class="container">
            <div class="row g-4">
                <div class="col-md-3 ">
                    <div class="facility-item text-center">
                        <i class="bi bi-car-front"></i>
                        <h5>Car Parking</h5>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="facility-item text-center">
                        <i class="bi bi-wifi"></i>
                        <h5>High-Speed Wifi</h5>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="facility-item text-center">
                        <i class="bi bi-water"></i>
                        <h5>Swimming Pool</h5>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="facility-item text-center">
                        <i class="bi bi-cup-straw"></i>
                        <h5>Free Breakfast</h5>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- -------------------------Booking Section---------------------- --}}
    <div class="container py-5" id="booking_section">
        <div class="row justify-content-between align-items-center">
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
                                    <option>{{ $room->room_name }}</option>
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
                            <button type="submit" class="rounded-pill px-4 py-2">Book Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection