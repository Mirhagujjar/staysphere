@extends('layouts.master')
@section('content')


<style>
    /* four cards in one row*/

.card-container1 {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    margin-top: 50px;
  }

  .custom-card1 {
    position: relative;
    width: 23%; /* 4 cards in a row with space */
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  }

  .custom-card1 img {
    width: 100%;
    height: 70vh;
    object-fit: cover;
}

.custom-card1 .bottom-text1 {
  position: absolute;
  bottom: 10px; /* Adjust to move text closer to the bottom */
  left: 50%;
  transform: translateX(-50%);
  color: white;
  padding: 5px 10px;
  border-radius: 5px;
  font-size: 16px;
  font-weight: bold;
  text-align: center;
}





.event-card {
    position: relative;
    border-radius: 10px;
    overflow: hidden;
    height: 90vh;
  }





    body {
        font-family: Arial, sans-serif;
    }

    .hero-section {
        background: url('assets/images/hotel9.jpg') no-repeat center center;
        background-size: cover;
        color: white;
        text-align: center;
        padding: 250px 90px;
        height: 30vh;
    }

    .hero-section h1 {
        font-size: 3rem;
        font-weight: bold;
    }

    .card-text-overlay {

        position: absolute;
        bottom: 10px;
        left: 10px;
        color: white;
        padding: 10px;
        border-radius: 5px;
    }

    .card-text-overlay button {
        background: transparent;
        border: none;
        color: rgb(12, 11, 11);
        font-size: 1.2rem;
        cursor: pointer;
    }

    .carousel-indicators {
        position: absolute;
        bottom: -50px;
    }

    .carousel-indicators [data-bs-target] {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background-color: rgb(3, 3, 3);
    }

    .section-title {
        font-size: 2rem;
        margin-bottom: 30px;
        text-align: center;
        font-weight: bold;
    }

/one sude image and other side text/

    .image-section img {
        width: 100%;
        height: auto;
        border-radius: 15px; /* Rounded corners for images */
        object-fit: cover;
    }
    .text-section {
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 20px;
    }
    .text-section h2 {
        font-size: 2rem;
        margin-bottom: 1rem;
    }
    .text-section p {
        font-size: 1rem;
        color: #555;
    }

    .btn {
            border-radius: 30%;
            background-color: rgb(14, 9, 9);
            color: white;
            padding: 10px;
            margin: 10px;
        }
        .btn:hover {
            background-color: gray;
        }


/*two cards in one row */



        .card-container {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 10px; /* Spacing between cards */
    margin-top: 50px;
  }

  .custom-card {
    position: relative;
    width: 48%; /* Two cards in one row */
    border-radius: 10px;
    overflow: hidden;
  }

  .custom-card img {
    width: 100vh;
    height: 60vh; /* Set image height */
    object-fit: cover;
  }

  .card-footer {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    color: white;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px;
    box-sizing: border-box;
  }

  .card-footer .text {
    font-size: 16px;
    font-weight: bold;
  }

  .card-footer .icon-btn {
    display: flex;
    justify-content: center;
    align-items: center;
    background: white;
    color: black;
    border-radius: 50%;
    width: 30px;
    height: 30px;
    text-align: center;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
  }

  .icon-btn:hover {
    background: black;
    color: white;
    transition: 0.3s;
  }

</style>
</head>
<body>
<!-- Hero Section -->
<div class="hero-section">
    <h1>Plan Your Events</h1>
    <p>Discover venues and services that make your events unforgettable.</p>
</div>

<!-- Event Section -->
<div class="container mt-5">
    <h2 >Social Events</h2>
    <p>Celebrate special moments, big and small.</p>
    <div id="eventCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card position-relative">
                            <img src="assets/images/meeting.jpeg"  height="234vh" class="card-img-top" alt="Plan Your Meeting">
                            <div class="card-text-overlay">
                                <h5>Business Meetings</h5>
                                <button><i class="bi bi-arrow-right-circle"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card position-relative">
                            <img src="assets/images/gather.jpeg" class="card-img-top" alt="Conferences">
                            <div class="card-text-overlay">
                                <h5>Conferences</h5>
                                <button><i class="bi bi-arrow-right-circle"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card position-relative">
                            <img src="assets/images/food1.jpeg"  height="234vh" class="card-img-top" alt="Weddings">
                            <div class="card-text-overlay">
                                <h5>Weddings</h5>
                                <button><i class="bi bi-arrow-right-circle"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card position-relative">
                            <img src="assets/images/12.jpeg"  height="234vh" class="card-img-top" alt="Team Building">
                            <div class="card-text-overlay">
                                <h5>Team Building</h5>
                                <button><i class="bi bi-arrow-right-circle"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card position-relative">
                            <img src="assets/images/food.jpeg" class="card-img-top" alt="Parties">
                            <div class="card-text-overlay">
                                <h5>Parties</h5>
                                <button><i class="bi bi-arrow-right-circle"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card position-relative">
                            <img src="assets/images/6.jpeg" class="card-img-top" alt="Exhibitions">
                            <div class="card-text-overlay">
                                <h5>Exhibitions</h5>
                                <button><i class="bi bi-arrow-right-circle"></i></button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="carousel-indicators">
            <button type="button" data-bs-target="#eventCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#eventCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
        </div>
    </div>
</div>




<!--  ..............................................................................  -->

<div class="py-5">
<div class="container">
    <div  class="text-section mt-3" >
        <h1>Trends & Highlights</h1>
        <p>Get inspired: Trends, tips and more.
        </p>
    </div>
    <div class="card-container1">
      <!-- Card 1 -->
      <div class="custom-card1">
        <img src="assets/images/tablet.jpeg" alt="Card Image 1">
        <div class="bottom-text1">Sustainable Meetings</div>
      </div>
      <!-- Card 2 -->
      <div class="custom-card1">
        <img src="assets/images/gre.jpeg" alt="Card Image 2">
        <div class="bottom-text1">Business Travel</div>
      </div>
      <!-- Card 3 -->
      <div class="custom-card1">
        <img src="assets/images/bil.jpeg" alt="Card Image 3">
        <div class="bottom-text1">Manage Event</div>
      </div>
      <!-- Card 4 -->
      <div class="custom-card1">
        <img src="assets/images/plan.jpeg" alt="Card Image 4">
        <div class="bottom-text1">Plan Small Event</div>
      </div>
    </div>
  </div>
</div>


<!--  ..............................................................................  -->
<div class="container">
<div class="mt-3"><h1>How to Book Your Event</h1>
<p>Plan seamlessly with our innovative tools and resources.
</p></div>
    <div class="card-container1 ">
      <!-- Card 1 -->
      <div class="custom-card ">
        <img src="assets/images/book.jpeg" alt="Card Image 1">
        <div class="card-footer">
          <span class="text">Submit A Request For Porposal</span>
          <a href="#" class="icon-btn">
            <span>&gt;</span> <!-- Icon: ">" -->
          </a>
        </div>
      </div>
      <!-- Card 2 -->
      <div class="custom-card ">
        <img src="assets/images/com.jpeg" alt="Card Image 2">
        <div class="card-footer">
          <span class="text">Explore Tools And Resourses</span>
          <a href="#" class="icon-btn">
            <span>&gt;</span> <!-- Icon: ">" -->
          </a>
        </div>
      </div>
    </div>
  </div>



<!--  ..............................................................................  -->

<div class="container py-5">
    <div class="text-section mt-3"><h1>Explore Curated Experiences</h1>
    <p>Optimize your next meeting and event with a space and style that’s just right.

    </p></div>
<!-- First Row -->
<div class="row align-items-center mb-5">
    <div class="col-md-6 image-section">
        <img src="assets/images/meeting.jpeg" alt="Hotel Image 1">
    </div>
    <div class="col-md-6 text-section">
        <h2>Mindful Meetings & Events</h2>
        <p>
            Mindful Meetings & Events focus on creating purposeful, engaging, and memorable gatherings that prioritize wellness, sustainability, and meaningful connections. This approach is becoming increasingly popular in hotel management and event planning as organizations and individuals seek to balance productivity with mental well-being and environmental responsibility.


        </p>
    </div>
</div>

<!-- Second Row -->
<div class="row align-items-center mb-5">
    <div class="col-md-6 order-md-2 image-section">
        <img src="assets/images/1.jpg" alt="Hotel Image 2">
    </div>
    <div class="col-md-6 order-md-1 text-section">
        <h2>Conferences</h2>
        <p>
            Conferences are formal gatherings organized to discuss specific topics, share knowledge, and foster collaboration among attendees. They bring together professionals, experts, and enthusiasts to exchange ideas, network, and stay updated on the latest trends and innovations in their respective fields.
        </p>

    </div>
</div>
<!-- third Row -->
<div class="row align-items-center mb-5">
    <div class="col-md-6 image-section">
        <img src="assets/images/music.jpeg" alt="Hotel Image 1">
    </div>
    <div class="col-md-6 text-section">
        <h2>Sufi Musical Performance </h2>
        <p>
            Sufi Musical Performances are spiritual and artistic expressions rooted in the Sufi tradition of Islam. These performances use music as a way to bring people closer to the divine, focusing on love, devotion, and unity. Sufi music is performed in various styles around the world, with Qawwali being one of the most famous forms.
        </p>
    </div>
</div>
<!-- 4th row -->
<div class="row align-items-center mb-5">
    <div class="col-md-6 order-md-2 image-section">
        <img src="assets/images/1.jpg" alt="Hotel Image 2">
    </div>
    <div class="col-md-6 order-md-1 text-section">
        <h2>Gather Together</h2>
        <p>
            Flexible meeting and public spaces designed for productivity and collaboration.
        </p>

    </div>
</div>

<!-- 5th row-->
<div class="row align-items-center mb-5">
    <div class="col-md-6 image-section">
        <img src="assets/images/hotel.jpeg" alt="Hotel Image 1">
    </div>
    <div class="col-md-6 text-section">
        <h2>Multi-Property Hotel </h2>
        <p>
            Managing multiple properties can feel overwhelming and eat up a lot of your time.
            However, our approach and cloud-based system make it easy.
            You can oversee all your properties from a single platform, boosting your revenue and freeing up time for more valuable activities.
        </p>
    </div>
</div>

</div>





@endsection






















{{-- @extends('layouts.master')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Upcoming Events</h2>

    <div class="row">
        @foreach($events as $event)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <img src="{{ asset('images/' . $event['image']) }}" class="card-img-top" alt="{{ $event['title'] }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $event['title'] }}</h5>
                        <p class="text-muted">{{ $event['date'] }}</p>
                        <p class="card-text">{{ $event['description'] }}</p>
                        <a href="#" class="btn btn-primary">Learn More</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection --}}
