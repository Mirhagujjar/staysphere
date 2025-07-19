<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard - StaySphere</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

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

        .sidebar {
            background-color: #1e293b;
            color: white;
            width: 250px;
            padding: 20px;
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
            color: #ffc107;
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

        .content-area {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .topbar {
            background-color: #e4e8ec;
            color: rgb(8, 7, 7);
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
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
}

.user-section .arrow.rotate {
    transform: rotate(90deg);
}


        .user-btn i {
            margin-left: 5px;
            color: #ffc107;
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
    </style>
</head>
<body>

<div class="layout">

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">
            <img src="{{ asset('build/assets/images/SSlogo9.png') }}" alt="Logo">
            <span><strong>StaySphere</strong></span>
        </div>

        <a href="#"><i class="fas fa-home"></i> Dashboard</a>

        <a href="#"><i class="fas fa-box-open"></i> Packages</a>
        <a href="#"><i class="fas fa-concierge-bell"></i> Services</a>
<!-- Event Booking Dropdown -->
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
        <a href="#"><i class="fas fa-bed"></i> Room Booking</a>

    </div>

    <!-- Right Content Area -->
    <div class="content-area">

        <!-- Top Navbar -->
        <div class="topbar">
            <div><strong>User Panel</strong></div>

            <div class="user-dropdown-wrapper">
                <div class="user-btn">
                    <span><i class="fas fa-user-circle"></i> {{ Auth::user()->name ?? 'User' }}</span>
                    <i class="fas fa-angle-down"></i>
                </div>
                <div class="user-menu">
                    <a href="#"><i class="fas fa-user"></i> Profile</a>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>



        <!-- Main Page Content -->
        <div class="main-content">
            @yield('content')
        </div>

    </div>

</div>
<script>
    function toggleUserDropdown(el) {
        const arrow = el.querySelector('.arrow');
        arrow.classList.toggle('rotate');

        const dropdown = el.nextElementSibling;
        dropdown.classList.toggle('show');
        el.classList.toggle('active');
    }

    function toggleEventDropdown(el) {
        const arrow = el.querySelector('.arrow');
        arrow.classList.toggle('rotate');

        const dropdown = el.nextElementSibling;
        dropdown.classList.toggle('show');
        el.classList.toggle('active');
    }
</script>

</body>
</html>
