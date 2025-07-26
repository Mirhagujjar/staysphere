<!--begin::Sidebar-->
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand text-center p-3">
        <a class='brand-link d-flex align-items-center justify-content-center' href="{{ route('admin.dashboard') }}">
            <img src="{{ asset('build/assets/images/SSlogo9.png') }}" alt="StaySphere Logo"
                class="brand-image opacity-75 shadow" style="height: 40px;" />
            <span class="brand-text fw-light ms-2 text-light">StaySphere</span>
        </a>
    </div>
    <!--end::Sidebar Brand-->

    <!-- Custom Sidebar Styles -->
    <style>
        .sidebar {
            background-color: #2C3E50;
            color: #F8F9FA;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        }

        .nav-link.active {
            background-color: #1ABC9C;
            color: #ffffff !important;
        }

        .nav-icon {
            margin-right: 10px;
        }

        .nav-treeview .nav-link {
            padding-left: 2rem;
        }
    </style>


    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper sidebar">
        <nav class="mt-2">
            <ul class="nav flex-column sidebar-menu" data-lte-toggle="treeview" role="menu" data-accordion="false">

                <!-- Dashboard -->
                @can('access-super-admin')

                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-speedometer text-warning"></i>
                            <p>Super Admin Dashboard</p>

                        </a>
                    </li>

                    {{-- @auth
                        @if(in_array(Auth::user()->role, [ 'super_admin']))
                            @php
                                $admin = Auth::user();
                            @endphp
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    @if ($admin->profile_image)
                                        <img src="{{ asset('uploads/profile/' . $admin->profile_image) }}"
                                            class="rounded-circle me-2" width="40" height="40" alt="Profile Image">
                                    @else
                                        <div class="rounded-circle bg-secondary d-flex justify-content-center align-items-center me-2" style="width: 40px; height: 40px;">
                                            <i class="fas fa-user text-white"></i>
                                        </div>
                                    @endif
                                    <span class="d-none d-lg-inline">{{ $admin->name }}</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.profile.show') }}">
                                            <i class="fas fa-user me-2"></i>My Profile
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.logout') }}"
                                        onclick="event.preventDefault(); showLogoutConfirmation();">
                                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @endif

                    @endauth

                    <!-- Add SweetAlert CSS -->
                    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                    <!-- Add Font Awesome -->
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

                    <script>
                        function showLogoutConfirmation() {
                            Swal.fire({
                                title: 'Logout Confirmation',
                                text: "Are you sure you want to logout?",
                                icon: 'question',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Yes, Logout',
                                cancelButtonText: 'Cancel',
                                background: '#f8f9fa',
                                color: '#343a40',
                                // backdrop: `
                                //     rgba(0,0,0,0.4)
                                //     url("https://i.gifer.com/origin/b4/b4d657e7ef262b88eb5f7ac021edda87.gif")
                                //     left top
                                //     no-repeat
                                // `
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    document.getElementById('logout-form').submit();
                                }
                            });
                        }
                    </script> --}}

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon bi bi-person-circle text-warning"></i>
                            <p>Admins<i class="nav-arrow bi bi-chevron-right text-warning"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.superadmin.list') }}" class="nav-link">
                                    <i class="bi bi-arrow-right text-warning"></i>
                                    <p>View All Admins</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.superadmin.create') }}" class="nav-link">
                                    <i class="bi bi-arrow-right text-warning"></i>
                                    <p>Create new Admin</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endcan



               <!-- Sidebar with Login/Profile Dropdown -->
                @can('access-admin')
                        {{-- @auth
                            @if(Auth::user()->role === 'admin')
                                @php
                                    $admin = Auth::user();
                                @endphp

                                <li class="nav-item">
                                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                                        <i class="nav-icon bi bi-speedometer text-warning"></i>
                                        <p>Admin Dashboard</p>

                                    </a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        @if ($admin->profile_image)
                                            <img src="{{ asset('uploads/profile/' . $admin->profile_image) }}"
                                                class="rounded-circle me-2" width="40" height="40" alt="Admin Image">
                                        @else
                                            <div class="rounded-circle bg-secondary d-flex justify-content-center align-items-center me-2" style="width: 40px; height: 40px;">
                                                <i class="fas fa-user text-white"></i>
                                            </div>
                                        @endif
                                        <span class="d-none d-lg-inline">{{ $admin->name }}</span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('admin.profile.show') }}">
                                                <i class="fas fa-user me-2"></i>My Profile
                                            </a>
                                        </li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('admin.logout') }}"
                                            onclick="event.preventDefault(); showLogoutConfirmation();">
                                                <i class="fas fa-sign-out-alt me-2"></i>Logout
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            @endif
                        @else
                            <li class="nav-item">
                                <a href="{{ route('admin.login') }}" class="nav-link btn btn-outline-primary px-3">
                                    <i class="fas fa-sign-in-alt me-1"></i>Login
                                </a>
                            </li>
                        @endauth --}}
                                            {{-- <!-- Add SweetAlert CSS -->
                        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                        <!-- Add Font Awesome -->
                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

                        <script>
                            function showLogoutConfirmation() {
                                Swal.fire({
                                    title: 'Logout Confirmation',
                                    text: "Are you sure you want to logout?",
                                    icon: 'question',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Yes, Logout',
                                    cancelButtonText: 'Cancel',
                                    background: '#f8f9fa',
                                    color: '#343a40',
                                    // backdrop: `
                                    //     rgba(0,0,0,0.4)
                                    //     url("https://i.gifer.com/origin/b4/b4d657e7ef262b88eb5f7ac021edda87.gif")
                                    //     left top
                                    //     no-repeat
                                    // `
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        document.getElementById('logout-form').submit();
                                    }
                                });
                            }
                        </script> --}}


                        <!-- Room Management -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-door-closed text-warning"></i>
                                <p>
                                    Room Management
                                    <i class="nav-arrow bi bi-chevron-right text-warning"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.rooms.index') }}" class="nav-link">
                                        <i class="bi bi-arrow-right text-warning"></i>
                                        <p>View All Rooms</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.rooms.create') }}" class="nav-link">
                                        <i class="bi bi-arrow-right text-warning"></i>
                                        <p>Add New Room</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        {{-- filters --}}
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-funnel text-warning"></i>
                                <p>Manage Filters<i class="nav-arrow bi bi-chevron-right text-warning"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.filters.index') }}" class="nav-link">
                                        <i class="bi bi-arrow-right text-warning"></i>
                                        <p>View All Filters</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.filters.create') }}" class="nav-link">
                                        <i class="bi bi-arrow-right text-warning"></i>
                                        <p>Add Filters options</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        {{-- <li class="nav-item">
                            <a href="{{ route('admin.facilities.index') }}" class="nav-link">
                                <i class="nav-icon bi bi-building text-warning"></i>
                                <p>Facilities</p>
                            </a>
                        </li> --}}

                        <!-- Reservations -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-calendar-check text-warning"></i>
                                <p>Reservations <i class="nav-arrow bi bi-chevron-right text-warning"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.reservations.index') }}" class="nav-link">
                                        <i class="bi bi-arrow-right text-warning"></i>
                                        <p>View All Reservations</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.reservations.past') }}" class="nav-link">
                                        <i class="bi bi-arrow-right text-warning"></i>
                                        <p>View delete Reservations</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Packages -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-archive text-warning"></i>
                                <p>Packages <i class="nav-arrow bi bi-chevron-right text-warning"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.packages.index') }}" class="nav-link">
                                        <i class="bi bi-arrow-right text-warning"></i>
                                        <p>View All Packages</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.bookingspackages.index') }}" class="nav-link">
                                        <i class="bi bi-arrow-right text-warning"></i>
                                        <p>Check Package Bookings</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                @endcan

                <!-- Events -->
                {{-- <li class="nav-item">
                    <a href="{{ route('admin.events.index') }}" class="nav-link">
                        <i class="nav-icon bi bi-calendar-event text-warning"></i>
                        <p>Events Management</p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.events') }}" class="nav-link">
                                <i class="bi bi-arrow-right text-warning"></i>
                                <p>View All Events</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.events.create') }}" class="nav-link">
                                <i class="bi bi-arrow-right text-warning"></i>
                                <p>Add New Event</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}
                {{-- <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.events.index') }}">
                        <i class="bi bi-calendar-event"></i> Events
                    </a>
                </li> --}}
                <li class="nav-item">
                    <a href="{{ route('admin.event.page') }}" class="nav-link">
                        <i class="nav-icon bi bi-layout-text-window text-warning"></i>
                        <p>Page Builder</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.event.content') }}" class="nav-link">
                        <i class="nav-icon bi bi-table text-warning"></i>
                        <p>View Page Content</p>
                    </a>
                </li>



                <li class="nav-item">
                    <a href="{{ route('admin.event-bookings.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-calendar-check text-warning"></i>
                        <p>User Event Bookings</p>
                    </a>
                </li>
                <!-- About Us -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-info-circle text-warning"></i>
                        <p>About Us <i class="nav-arrow bi bi-chevron-right text-warning"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.about.show')}}" class="nav-link">
                                <i class="bi bi-arrow-right text-warning"></i>
                                <p>View About Us</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route ('admin.about.edit')}}" class="nav-link">
                                <i class="bi bi-arrow-right text-warning"></i>
                                <p>Add About Us</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Reviews -->
                <li class="nav-item">
                    <a href="{{ route('admin.review.index') }}" class="nav-link">
                        <i class="nav-icon bi bi-chat-left-text text-warning"></i>
                        <p>Reviews</p>
                    </a>
                </li>



                <!-- Users Management -->
                <li class="nav-item">
                    <a href="{{ route('admin.users.index') }}" class="nav-link">
                        <i class="nav-icon bi bi-person text-warning"></i>
                        <p>Users Management</p>
                    </a>
                </li>

                <!-- Blog Management -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-pencil-square text-warning"></i>
                        <p>Blog Management <i class="nav-arrow bi bi-chevron-right text-warning"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a href="{{ route('admin.blog.main') }}" class="nav-link"><i class="bi bi-arrow-right text-warning"></i> <p>Edit Main Blog Page</p></a></li>
                        <li class="nav-item"><a href="{{route('admin.blogs.index')}}" class="nav-link"><i class="bi bi-arrow-right text-warning"></i> <p>View All Blogs</p></a></li>
                        <li class="nav-item"><a href="{{ route('admin.blogs.create') }}" class="nav-link"><i class="bi bi-arrow-right text-warning"></i> <p>Add New Blog</p></a></li>
                    </ul>
                </li>

                {{-- <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.gallery') }}">
                        <i class="fas fa-images"></i>
                        <p>Gallery</p>
                    </a>
                </li> --}}

                <li class="nav-item">
                    <a href="{{ route('admin.gallery') }}" class="nav-link">
                        <i class="nav-icon fas fa-images text-warning"></i>
                        <p>Gallery</p>
                    </a>
                </li>


                <!-- Analytics -->
                {{-- <li class="nav-item mt-3">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-graph-up text-warning"></i>
                        <p>Analytics <i class="nav-arrow bi bi-chevron-right text-warning"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-arrow-right text-warning"></i> <p>Marketing</p></a></li>
                        <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-arrow-right text-warning"></i> <p>Visitors</p></a></li>
                    </ul>
                </li> --}}





            </ul>
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>
<!--end::Sidebar-->
