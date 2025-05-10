@extends('layouts.app')

@section('content')
    <style>
        * {
            font-family: "Montserrat", Helvetica, sans-serif;
            box-sizing: border-box;

        }

        html,
        body {
            overflow-x: hidden;
           
            margin: 0;
           
            padding: 0;
            
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
            color: #111111;
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
            <h1>Rooms</h1>
            <p>Indulge in the ultimate blend of elegance and comfort in our meticulously designed rooms.</p>
            <div class="link-container">
                <a href="/">Home</a> > Rooms
            </div>
        </div>
    </div>

    <!--------------------- Room Section ------------------------------->
    <div class="container my-5">
        <div class="section-title text-center">
            <h2>Our Rooms & Rates</h2>
        </div>

        <div class="row g-4">
            <!-- Filters Sidebar (Left) -->
            <div class="col-lg-3">
                <div class="card p-3 shadow-sm filters-sidebar">
                    <h4>Filters</h4>
                    <hr>
                    <form method="GET" action="{{ route('user.rooms.index') }}">
                        <h6>Room Type</h6>
                        <select name="room_type" class="form-select">
                            <option value="">Any</option>
                            <option value="Deluxe">Deluxe</option>
                            <option value="Suite">Suite</option>
                        </select>

                        <h6 class="mt-3">Max Price</h6>
                        <input type="number" name="max_price" class="form-control" placeholder="Enter max price">

                        <h6 class="mt-3">Facilities</h6>
                        <input type="text" name="facilities" class="form-control" placeholder="Enter facilities (comma separated)">

                        <h6 class="mt-3">Sort By Price</h6>
                        <select name="sort_order" class="form-select">
                            <option value="asc">Low to High</option>
                            <option value="desc">High to Low</option>
                        </select>

                        <button type="submit" class="btn btn-warning mt-3 w-100">Apply Filters</button>
                        <a href="{{ route('user.rooms.index') }}" class="btn btn-outline-danger mt-2 w-100">Reset</a>
                    </form>
                </div>
            </div>

            {{-- <div class="col-lg-3">
                <div class="card p-3 shadow-sm filters-sidebar">
                    <h4>Filters</h4>
                    <hr>
                    <form method="GET" action="{{ route('user.rooms.index') }}">
                        <h6>Room Type</h6>
                        <select name="room_type" class="form-select">
                            <option value="">Any</option>
                            <option value="Deluxe">Deluxe</option>
                            <option value="Suite">Suite</option>
                            <option value="Standard">Standard</option>
                            <option value="Single">Single</option>
                        </select>

                        <h6 class="mt-3">Max Price (PKR)</h6>
                        <input type="number" name="max_price" class="form-control" placeholder="Enter max price">

                        <h6 class="mt-3">Min Price (PKR)</h6>
                        <input type="number" name="min_price" class="form-control" placeholder="Enter min price">

                        <h6 class="mt-3">Facilities</h6>
                        <input type="text" name="facilities" class="form-control" placeholder="Enter facilities (comma separated)">

                        <h6 class="mt-3">Star Rating</h6>
                        <select name="star_rating" class="form-select">
                            <option value="">Any</option>
                            <option value="1">1 Star</option>
                            <option value="2">2 Stars</option>
                            <option value="3">3 Stars</option>
                            <option value="4">4 Stars</option>
                            <option value="5">5 Stars</option>
                        </select>

                        <h6 class="mt-3">Room Capacity</h6>
                        <input type="number" name="room_capacity" class="form-control" placeholder="Enter minimum capacity">

                        <h6 class="mt-3">Distance (km)</h6>
                        <input type="number" name="distance" class="form-control" placeholder="Enter max distance from location">

                        <h6 class="mt-3">Sort By Price</h6>
                        <select name="sort_order" class="form-select">
                            <option value="asc">Low to High</option>
                            <option value="desc">High to Low</option>
                        </select>

                        <!-- Additional Filters -->
                        <h6 class="mt-3">Breakfast Included</h6>
                        <select name="breakfast" class="form-select">
                            <option value="">Any</option>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>

                        <h6 class="mt-3">Pet-Friendly</h6>
                        <select name="pet_friendly" class="form-select">
                            <option value="">Any</option>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>

                        <h6 class="mt-3">Cancellation Policy</h6>
                        <select name="cancellation_policy" class="form-select">
                            <option value="">Any</option>
                            <option value="flexible">Flexible</option>
                            <option value="strict">Strict</option>
                        </select>

                        <!-- Popular Filters -->
                        <h6 class="mt-3">Popular Filters</h6>
                        <div class="form-check">
                            <input type="checkbox" name="popular_filters[]" value="4_stars" class="form-check-input" id="filter4Stars">
                            <label class="form-check-label" for="filter4Stars">4 Stars</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" name="popular_filters[]" value="double_bed" class="form-check-input" id="filterDoubleBed">
                            <label class="form-check-label" for="filterDoubleBed">Double Bed</label>
                        </div>

                        <button type="submit" class="btn btn-warning mt-3 w-100">Apply Filters</button>
                        <a href="{{ route('user.rooms.index') }}" class="btn btn-outline-danger mt-2 w-100">Reset</a>
                    </form>
                </div>
            </div> --}}

            <!-- Rooms Display (Right) -->
            {{-- <div class="col-lg-9 ">
                <div class="row g-4 ">
                    @foreach($rooms as $room)
                    <div class="col-md-4 ">
                        <div class="card card-hover">
                            @if($room->is_new)
                            <span class="badge text-bg-success">NEW</span>
                            @endif
                            @if($room->on_sale)
                            <span class="badge text-bg-danger">SALE</span>
                            @endif
                            <img src="{{ asset($room->image) }}" alt="{{ $room->room_name }}" class="card-img-top object-fit-cover" alt="{{ $room->room_name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $room->room_name }}</h5>
                                <p class="card-text">Rs. {{ number_format($room->price) }} / Per Night</p>
                            </div>
                            <div class="card-overlay">
                                <div class="details">
                                    <p>{{ $room->guest_capacity }} Guests</p>
                                    <p>{{ $room->size }} ft Room Size</p>
                                    <p>Rs. {{ number_format($room->price) }} / Per Night</p>
                                </div>
                                <a href="{{ route('user.rooms.show', $room->id) }}" class="btn-book">View Details</a>
                            </div>
                            @if(!$room->isBooked())
                                <div class="card-footer text-center">
                                    <a href="{{ route('user.reservations.create', ['room_id' => $room->id]) }}" class="btn btn-primary">
                                        Book Now
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div> --}}

            {{-- <div class="col-lg-9">
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    @foreach($rooms as $room)
                    <div class="col">
                        <div class="card h-100 card-hover shadow-sm" style="border-color: #2C3E50;">
                            <!-- Image with fixed aspect ratio -->
                            <div class="position-relative ratio ratio-16x9 overflow-hidden">
                                <img src="{{ asset($room->image) }}" class="card-img-top object-fit-cover" alt="{{ $room->room_name }}">
                                <!-- Badges -->
                                <div class="position-absolute top-0 start-0 p-2">
                                    @if($room->is_new)
                                    <span class="badge bg-success">NEW</span>
                                    @endif
                                    @if($room->on_sale)
                                    <span class="badge bg-danger">SALE</span>
                                    @endif
                                </div>
                            </div>

                            <!-- Card Body -->
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title text-2C3E50">{{ $room->room_name }}</h5>
                                <p class="card-text text-343A40">Rs. {{ number_format($room->price) }} / Per Night</p>

                                <!-- Overlay Content (hidden by default) -->
                                <div class="card-overlay mt-auto pt-3 border-top">
                                    <div class="details small">
                                        <p class="mb-1"><i class="fas fa-users me-2"></i>{{ $room->guest_capacity }} Guests</p>
                                        <p class="mb-1"><i class="fas fa-ruler-combined me-2"></i>{{ $room->size }} ft²</p>
                                        <p class="mb-3"><i class="fas fa-tag me-2"></i>Rs. {{ number_format($room->price) }} / Night</p>
                                    </div>
                                    <div class="d-grid gap-2">
                                        <a href="{{ route('user.rooms.show', $room->id) }}" class="btn btn-outline-1ABC9C">
                                            View Details
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Footer -->
                            @if(!$room->isBooked())
                            <div class="card-footer bg-transparent border-top-0 pt-0">
                                <a href="{{ route('user.reservations.create', ['room_id' => $room->id]) }}"
                                   class="btn btn-1ABC9C w-100">
                                    Book Now
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div> --}}

            <div class="col-lg-9">
                <div class="row g-4">
                    @foreach($rooms as $room)
                    <div class="col-md-4">
                        <div class="card card-hover h-80">

                            <div class="position-relative" style="height: 200px; overflow: hidden;">
                                @if($room->is_new)
                                <span class="badge text-bg-success position-absolute top-0 start-0 m-2">NEW</span>
                                @endif
                                @if($room->on_sale)
                                <span class="badge text-bg-danger position-absolute top-0 end-0 m-2">SALE</span>
                                @endif
                                <img src="{{ asset($room->image) }}"
                                     class="w-100 h-100 object-fit-cover"
                                     alt="{{ $room->room_name }}">
                            </div>

                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $room->room_name }}</h5>
                                <p class="card-text">Rs. {{ number_format($room->price) }} / Per Night</p>
                                <div class="card-overlay mt-auto">
                                    <div class="details">
                                        <p>{{ $room->guest_capacity }} Guests</p>
                                        <p>{{ $room->size }} ft Room Size</p>
                                        <p>Rs. {{ number_format($room->price) }} / Per Night</p>
                                    </div>
                                    <a href="{{ route('user.rooms.show', $room->id) }}" class="btn-book">View Details</a>
                                </div>
                            </div>

                            @if(!$room->isBooked())
                            <div class="card-footer text-center">
                                <a href="{{ route('user.reservations.create', ['room_id' => $room->id]) }}"
                                   class="btn btn-primary">
                                    Book Now
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

   {{-- ----------------------------Facilities------------------------------ --}}
   <div class="facilities-section">
    <h2 class="text-center mb-4">Main Facilities</h2>
    <div class="container">
        <div class="row g-4">
            <!-- Facility 1 -->
            <div class="col-md-3 ">
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
                        <input type="date" class="form-control" id="date_booking" name="date_booking"
                            placeholder="Select Date">
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
                                    <input type="number" class="form-control" id="adults_booking"
                                        placeholder="Adults">
                                </div>
                                <div class="col-6">
                                    <input type="number" class="form-control" id="childs_booking"
                                        placeholder="Children">
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
