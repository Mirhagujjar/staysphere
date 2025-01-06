<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Hotel Management')</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #F8F9FA; /* Off-White */
            color: #343A40; /* Dark Gray */
        }
        .navbar {
            background-color: #2C3E50 !important; /* Midnight Blue */
        }
        .navbar a {
            color: white !important;
        }
        .navbar-brand img {
            border-radius: 20%;
            width: 50px;
        }
        .btn-primary {
            background-color: #F1C40F !important; /* Soft Gold */
            border: none;
        }
        .btn-primary:hover {
            background-color: #D4AC0D !important;
        }
        .footer {
            background-color: #343A40; /* Dark Gray */
            color: white;
            padding: 10px;
            text-align: center;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="logo.jpg" alt="Brand Logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Header -->
    @yield('header')
    <header class="text-center py-3" style="background-color: #1ABC9C; color: white;">
        <h1>Stay Sphere</h1>
    </header>

    <!-- Content -->
    <div class="container mt-4">
        @yield('content')

        <h2 class="text-center">Welcome to Our Hotel Management System</h2>
        <p class="text-center">
            Our hotel management system provides a seamless experience for both administrators and guests.
        </p>

        <div class="row">
            <div class="col-md-4">
                <h3>Basic Hotel Services</h3>
                <ul>
                    <li>Room Service</li>
                    <li>Housekeeping</li>
                    <li>Concierge</li>
                    <li>Reception/Front Desk</li>
                    <li>Wi-Fi/Internet Access</li>
                </ul>
            </div>
            <div class="col-md-4">
                <h3>Food & Beverage Services</h3>
                <ul>
                    <li>Restaurants</li>
                    <li>Bars and Lounges</li>
                    <li>Cafes and Snack Bars</li>
                    <li>In-Room Dining</li>
                </ul>
            </div>
            <div class="col-md-4">
                <h3>Recreational & Wellness</h3>
                <ul>
                    <li>Swimming Pool</li>
                    <li>Fitness Center</li>
                    <li>Spa & Massage</li>
                    <li>Sauna & Steam Room</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Footer -->
    @yield('footer')
    <footer class="footer mt-5">
        <p>&copy; 2025 Hotel Management. All Rights Reserved.</p>
    </footer>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
