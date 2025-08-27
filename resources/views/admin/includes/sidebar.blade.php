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
                            <p>Admin Dashboard</p>

                        </a>
                    </li>
                    {{-- <li class="nav-item">
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
                    </li> --}}
                @endcan
               <!-- Sidebar with Login/Profile Dropdown -->
                @can('access-admin')
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
                {{-- Event management --}}
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-layout-text-window text-warning"></i>
                        <p>Event Management <i class="nav-arrow bi bi-chevron-right text-warning"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.event.page') }}" class="nav-link">
                                <i class="bi bi-arrow-right text-warning"></i>
                                <p>Event Page Builder</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route ('admin.event.content')}}" class="nav-link">
                                <i class="bi bi-arrow-right text-warning"></i>
                                <p>View Event Content</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route ('admin.event-bookings.index')}}" class="nav-link">
                                <i class="bi bi-arrow-right text-warning"></i>
                                <p>User Event Bookings</p>
                            </a>
                        </li>
                    </ul>
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
                <!-- Contact Info -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-list text-warning"></i>
                        <p>Contact Info <i class="nav-arrow bi bi-chevron-right text-warning"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.contact.index')}}" class="nav-link">
                                <i class="bi bi-arrow-right text-warning"></i>
                                <p>View Contacts list</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.contact-settings.index')}}" class="nav-link">
                                <i class="bi bi-arrow-right text-warning"></i>
                                <p>Show Contact Page</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route ('admin.contact-settings.create')}}" class="nav-link">
                                <i class="bi bi-arrow-right text-warning"></i>
                                <p>Create Contact Page</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- Services -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-headset text-warning"></i>
                        <p>Services<i class="nav-arrow bi bi-chevron-right text-warning"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route ('admin.service_requests.index')}}" class="nav-link">
                                <i class="bi bi-arrow-right text-warning"></i>
                                <p>View Service Requests</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.services.index')}}" class="nav-link">
                                <i class="bi bi-arrow-right text-warning"></i>
                                <p>Manage All Services</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <!-- Home Management -->
                 <li class="nav-item">
                    <a href="{{ route('admin.sliders.index') }}" class="nav-link">
                        <i class="nav-icon bi bi-person text-warning"></i>
                        <p>Home Management</p>
                    </a>
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
                <!-- Gallery -->
                <li class="nav-item">
                    <a href="{{ route('admin.gallery') }}" class="nav-link">
                        <i class="nav-icon fas fa-images text-warning"></i>
                        <p>Gallery</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>
<!--end::Sidebar-->
