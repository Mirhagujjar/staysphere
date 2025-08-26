<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard - StaySphere</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('build/assets/images/SSlogo9.png')}}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- SweetAlert -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @include('components.logout-confirmation')

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f1f5f9;
        }

        .layout {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            background-color: #1e293b;
            color: white;
            width: 250px;
            padding: 20px;
            position: fixed;
            top: 0;
            left: -250px; /* hidden by default */
            height: 100%;
            transition: all 0.3s ease;
            z-index: 2000;
        }

        .sidebar.active {
            left: 0;
        }

        .sidebar a {
            color: white;
            display: block;
            text-decoration: none;
            margin: 10px 0;
            padding: 8px;
            border-radius: 5px;
        }

        .sidebar a i {
            color: #ffc107 !important; /* Always yellow */
            margin-right: 10px;
        }

        .sidebar a:hover {
            background-color: #334155;
        }

        .logo {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
        }

        .logo img {
            width: 35px;
            margin-right: 10px;
        }

        /* Content Area */
        .content-area {
            flex: 1;
            display: flex;
            flex-direction: column;
            margin-left: 0;
            transition: margin-left 0.3s ease;
            width: 100%;
        }

        .content-area.shifted {
            margin-left: 250px;
        }

        /* Topbar */
        .topbar {
            background-color: #e4e8ec;
            color: #000;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Hamburger */
        .toggle-btn {
            font-size: 20px;
            cursor: pointer;
            margin-right: 15px;
            color: #1e293b;
        }

        .user-dropdown-wrapper {
            position: relative;
            display: inline-block;
        }

        .user-btn {
            cursor: pointer;
            display: flex;
            align-items: center;
        }

        .user-btn i {
            margin-left: 5px;
            color: #ffc107 !important;
        }

        .user-menu {
            display: none;
            position: absolute;
            right: 0;
            background-color: #334155;
            padding: 10px;
            border-radius: 5px;
            z-index: 1000;
        }

        .user-menu a {
            color: white;
            display: block;
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 3px;
            font-size: 14px;
        }

        .user-menu a:hover {
            background-color: #475569;
        }

        .user-dropdown-wrapper:hover .user-menu {
            display: block;
        }

        .main-content {
            padding: 30px;
        }

        /* Dropdown */
        .user-section {
            margin-top: 10px;
        }

        .user-section .user-dropdown {
            display: none;
            margin-left: 20px;
        }

        .user-section .user-dropdown.show {
            display: block;
        }

        .user-section .arrow {
            margin-left: auto;
            transition: transform 0.3s ease;
            color: #ffc107 !important;
        }

        .user-section .arrow.rotate {
            transform: rotate(90deg);
        }
    </style>
</head>
<body>

<div class="layout">

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="logo">
            <img src="{{ asset('build/assets/images/SSlogo9.png') }}" alt="Logo">
            <span><strong>StaySphere</strong></span>
        </div>

        <a href="{{ route('user.dashboard') }}"><i class="fas fa-home"></i> User Panel</a>

        <!-- Package -->
        <div class="user-section">
            <div class="user-btn" onclick="toggleEventDropdown(this)">
                <span><i class="fas fa-box-open"></i> Package</span>
                <i class="fas fa-angle-right arrow"></i>
            </div>
            <div class="user-dropdown">
                <a href="{{ route('user.add.package') }}"><i class="fas fa-plus-circle"></i> Add Package</a>
                <a href="{{ route('booking.index') }}"><i class="fas fa-list"></i> View All Packages</a>
            </div>
        </div>

        <!-- Services -->
        <div class="user-section">
            <div class="user-btn" onclick="toggleEventDropdown(this)">
                <span><i class="fas fa-concierge-bell"></i> Services</span>
                <i class="fas fa-angle-right arrow"></i>
            </div>
            <div class="user-dropdown">
                <a href="{{ route('user.services.create') }}"><i class="fas fa-plus-circle"></i> Add Services</a>
                <a href="{{ route('user.services.requests') }}"><i class="fas fa-list"></i> View All Services</a>
            </div>
        </div>

        <!-- Events -->
        <div class="user-section">
            <div class="user-btn" onclick="toggleEventDropdown(this)">
                <span><i class="fas fa-calendar-alt"></i> Event Booking</span>
                <i class="fas fa-angle-right arrow"></i>
            </div>
            <div class="user-dropdown">
                <a href="{{ route('user.event-booking.create') }}"><i class="fas fa-plus-circle"></i> Add New Event</a>
                <a href="{{ route('user.event-booking.index') }}"><i class="fas fa-list"></i> View All Events</a>
            </div>
        </div>

        <!-- Rooms -->
        <div class="user-section">
            <div class="user-btn" onclick="toggleEventDropdown(this)">
                <span><i class="fas fa-bed"></i> Room Booking</span>
                <i class="fas fa-angle-right arrow"></i>
            </div>
            <div class="user-dropdown">
                <a href="{{ route('user.rooms.index') }}"><i class="fas fa-plus-circle"></i> Booking Room</a>
                <a href="{{ route('user.reservations.index') }}"><i class="fas fa-list"></i> View All Booking</a>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="content-area" id="content">
        <!-- Topbar -->
        <div class="topbar">
            <span class="toggle-btn" onclick="toggleSidebar()"><i class="fas fa-bars"></i></span>
            <div><a href="{{ url('/home') }}" class="nav-link">Home</a></div>

            <div class="user-dropdown-wrapper">
                <div class="user-btn">
                    <span><i class="fas fa-user-circle"></i> {{ Auth::user()->name ?? 'User' }}</span>
                    <i class="fas fa-angle-down"></i>
                </div>
                <div class="user-menu">
                    <a href="{{route('user.profile.show')}}"><i class="fas fa-user"></i> Profile</a>
                    <a class="dropdown-item d-flex align-items-center py-2 text-danger" href="#" onclick="showLogoutConfirmation(event)">
                        <i class="fas fa-sign-out-alt me-2"></i> <span>{{ __('Logout') }}</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            @yield('content')
        </div>
    </div>
</div>

<script>
    function toggleEventDropdown(el) {
        const arrow = el.querySelector('.arrow');
        arrow.classList.toggle('rotate');
        const dropdown = el.nextElementSibling;
        dropdown.classList.toggle('show');
    }

    function toggleSidebar() {
        document.getElementById("sidebar").classList.toggle("active");
        document.getElementById("content").classList.toggle("shifted");
    }
</script>

</body>
</html>
