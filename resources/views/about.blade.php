@extends('layouts.master')

@section('content')
<div class="container mt-4">
    <h2>About Our Hotel</h2>
    <p>Our hotel provides luxury rooms with high-quality service.</p>

    <h2 class="text-center mt-4">About Us</h2>
<div class="container mt-4">
    <div class="row">
        <div class="col-md-4">
            <div class="card mb-4 card-hover">
                <div class="card-body">
                    <h5 class="card-title">Our Mission</h5>
                    <p class="card-text">At Stay Sphere, our mission is to create a welcoming environment where guests can relax and enjoy their stay. We strive to exceed expectations through our commitment to quality and service.</p>
                    {{-- <a href="{{ route('hotel.aboutUs', ['id' => 1]) }}" class="stretched-link"></a> --}}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4 card-hover">
                <div class="card-body">
                    <h5 class="card-title">Our History</h5>
                    <p class="card-text">Founded in 2000, Stay Sphere has been a cornerstone of hospitality in the community. Over the years, we have evolved to meet the changing needs of our guests while maintaining our commitment to excellence.</p>
                    {{-- <a href="{{ route('hotel.aboutUs', ['id' => 2]) }}" class="stretched-link"></a> --}}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4 card-hover">
                <div class="card-body">
                    <h5 class="card-title">Our Values</h5>
                    <ul class="card-text">
                        <li>Guest Satisfaction</li>
                        <li>Sustainability</li>
                        <li>Community Engagement</li>
                        {{-- <a href="{{ route('hotel.aboutUs', ['id' => 3]) }}" class="stretched-link"></a> --}}
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card mb-4 card-hover">
                <div class="card-body">
                    <h5 class="card-title">Facilities</h5>
                    <p class="card-text">We offer a range of facilities to make your stay enjoyable:</p>
                    {{-- <a href="{{ route('hotel.aboutUs', ['id' => 4]) }}" class="stretched-link"></a> --}}
                    <ul>
                        <li>Luxurious Rooms</li>
                        <li>On-site Restaurant</li>
                        <li>Spa and Wellness Center</li>
                        <li>Swimming Pool</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4 card-hover">
                <div class="card-body">
                    <h5 class="card-title">Awards</h5>
                    <p class="card-text">We are proud to have received numerous awards for our service and hospitality, including the "Best Hotel in the City" award for three consecutive years.</p>
                    {{-- <a href="{{ route('hotel.aboutUs', ['id' => 5]) }}" class="stretched-link"></a> --}}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4 card-hover">
                <div class="card-body">
                    <h5 class="card-title">Community Involvement</h5>
                    <p class="card-text">Stay Sphere actively participates in local events and supports various charities, ensuring that we make a positive impact in our community.</p>
                    {{-- <a href="{{ route('hotel.aboutUs', ['id' => 6]) }}" class="stretched-link"></a> --}}
                </div>
            </div>
        </div>
    </div>

    <h3 class="text-center mt-4">What Our Guests Say</h3>
    <blockquote class="blockquote text-center">
        <p class="mb-0">"Stay Sphere is the best hotel I've ever stayed at! The staff is incredibly friendly, and the amenities are top-notch." <br></p><br>
        <footer class="blockquote-footer">Jane Doe</footer>
    </blockquote>

    <h3 class="text-center mt-4">Join Us</h3>
    <p class="text-center">We invite you to experience the warmth and hospitality of Stay Sphere. <a href="#" class="btn btn-primary">Book your stay today!</a></p>
</div>
</div>
@endsection
