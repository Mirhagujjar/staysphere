    <!--begin::Sidebar-->
    <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
        <!--begin::Sidebar Brand-->
        <div class="sidebar-brand">
            <!--begin::Brand Link-->
            <a class='brand-link' href='/dist/pages/'>
                <!--begin::Brand Image-->
                <img src="{{ asset('build/assets/images/SSlogo9.png') }}" alt="AdminLTE Logo"
                    class="brand-image opacity-75 shadow" />
                <!--end::Brand Image-->
                <!--begin::Brand Text-->
                <span class="brand-text fw-light">StaySphere</span>
                <!--end::Brand Text-->
            </a>
            <!--end::Brand Link-->
        </div>
        <!--end::Sidebar Brand-->
        <!--begin::Sidebar Wrapper-->
        <style>
            .sidebar {
                background-color:  #2C3E50; 
                color: #F8F9FA; 
                box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
                }
        </style>
        <div class="sidebar-wrapper sidebar">
            <nav class="mt-2">
                <!--begin::Sidebar Menu-->
                <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                    {{--  Dashboard --}}
                    <li class="nav-item menu-open">
                        <a href="{{route('admin.dashboard')}}" class="nav-link active">
                            <i class="nav-icon bi bi-speedometer text-warning"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    {{-- Booking Calender --}}
                    {{-- <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon bi bi-calendar text-warning"></i>
                            <p>
                                Booking Calendar
                                <i class="nav-arrow bi bi-chevron-right text-warning"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a class='nav-link' href='/dist/pages/widgets/small-box'>
                                    <i class="nav-icon bi bi-arrow-right text-wrning"></i>
                                    <p>calendar</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class='nav-link' href='/dist/pages/widgets/info-box'>
                                    <i class="nav-icon bi bi-arrow-right text-wrning"></i>
                                    <p>Booking list</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class='nav-link' href='/dist/pages/widgets/cards'>
                                    <i class="nav-icon bi bi-arrow-right text-wrning"></i>
                                    <p>Work schedule</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class='nav-link' href='/dist/pages/widgets/cards'>
                                    <i class="nav-icon bi bi-arrow-right text-wrning"></i>
                                    <p>Booking analytics</p>
                                </a>
                            </li>
                        </ul>
                    </li> --}}

                    {{-- Room mangement --}}
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
                                <a class='nav-link' href="{{ route('admin.rooms.index') }}">
                                    <i class="nav-icon bi bi-arrow-right text-warning"></i>
                                    <p>View All Rooms</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class='nav-link' href="{{ route('admin.rooms.create') }}">
                                    <i class="nav-icon bi bi-arrow-right text-warning"></i>
                                    <p>Add New Room</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.reservations.index') }}" class="nav-link">
                            <i class="nav-icon bi bi-calendar-check text-warning"></i>
                            <p>Reservations</p>
                        </a>
                    </li>

                    {{-- packages --}}
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon bi bi-archive text-warning"></i>
                            <p>
                                Packages
                                <i class="nav-arrow bi bi-chevron-right text-warning"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a class='nav-link' href="{{ route('admin.packages.index') }}">
                                    <i class="nav-icon bi bi-arrow-right text-warning"></i>
                                    <p>View All Packages</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class='nav-link' href="{{ route('admin.bookingspackages.index') }}">
                                    <i class="nav-icon bi bi-arrow-right text-warning"></i>
                                    <p>Check Packages Bookings </p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    {{-- event --}}

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon bi bi-calendar-event text-warning"></i>
                            <p>
                                Events Management
                                <i class="nav-arrow bi bi-chevron-right text-warning"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a class='nav-link' href="{{ route('admin.events') }}">
                                    <i class="nav-icon bi bi-arrow-right text-warning"></i>
                                    <p>View All Events</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class='nav-link' href="{{ route('admin.events.create') }}">
                                    <i class="nav-icon bi bi-arrow-right text-warning"></i>
                                    <p>Add New Event</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                 {{-- about us --}}
                 <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-info-circle text-warning"></i>
                        <p>
                            About Us
                            <i class="nav-arrow bi bi-chevron-right text-warning"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a class='nav-link' href="{{ route('admin.about.index') }}">
                                <i class="nav-icon bi bi-arrow-right text-warning"></i>
                                <p>View About Us</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class='nav-link' href="{{ route('admin.about.create') }}">
                                <i class="nav-icon bi bi-arrow-right text-warning"></i>
                                <p>Add About Us</p>
                            </a>
                        </li>
                    </ul>
                </li>


                    {{-- booking management --}}
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon bi bi-door-closed text-warning"></i>
                            <p>
                                Bookings Management
                                <i class="nav-arrow bi bi-chevron-right text-warning"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a class='nav-link' href='/dist/pages/widgets/small-box'>
                                    <i class="nav-icon bi bi-arrow-right text-warning"></i>
                                    <p> Approve Bookings</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class='nav-link' href='/dist/pages/widgets/info-box'>
                                    <i class="nav-icon bi bi-arrow-right text-warning"></i>
                                    <p>Reject Bookings </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class='nav-link' href='/dist/pages/widgets/cards'>
                                    <i class="nav-icon bi bi-arrow-right text-warning"></i>
                                    <p> Check Booking Status
                                        {{-- (Pending, Confirmed, Cancelled) --}}
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class='nav-link' href='/dist/pages/widgets/cards'>
                                    <i class="nav-icon bi bi-arrow-right text-warning"></i>
                                    <p> Search / Filter Bookings
                                        {{-- (Date, Room Type, Status) --}}
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>


                    {{-- Users Management --}}
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon bi bi-person text-warning"></i>
                            <p>
                                Users Management
                                <i class="nav-arrow bi bi-chevron-right text-warning"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a class='nav-link' href='/dist/pages/widgets/small-box'>
                                    <i class="nav-icon bi bi-arrow-right text-warning"></i>
                                    <p>View All Users</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class='nav-link' href='/dist/pages/widgets/info-box'>
                                    <i class="nav-icon bi bi-arrow-right text-warning"></i>
                                    <p>Ban / Unban Users
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>

                      {{-- Blog Management --}}
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon bi bi-pencil-square text-warning"></i>
                            <p>
                                Blog Management
                                <i class="nav-arrow bi bi-chevron-right text-warning"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a class='nav-link' href='/dist/pages/widgets/small-box'>
                                    <i class="nav-icon bi bi-arrow-right text-wrning"></i>
                                    <p>Add New Blog</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class='nav-link' href='/dist/pages/widgets/info-box'>
                                    <i class="nav-icon bi bi-arrow-right text-wrning"></i>
                                    <p> Edit Existing Blogs</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class='nav-link' href='/dist/pages/widgets/cards'>
                                    <i class="nav-icon bi bi-arrow-right text-wrning"></i>
                                    <p> Delete Blogs</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    {{-- Contact Management --}}
                    {{-- <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon bi bi-envelope text-warning"></i>
                            <p>
                                contact Management
                                <i class="nav-arrow bi bi-chevron-right text-warning"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a class='nav-link' href='/dist/pages/widgets/small-box'>
                                    <i class="nav-icon bi bi-arrow-right text-wrning"></i>
                                    <p>View contact List</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class='nav-link' href='/dist/pages/widgets/info-box'>
                                    <i class="nav-icon bi bi-arrow-right text-wrning"></i>
                                    <p>replay the contactor</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class='nav-link' href='/dist/pages/widgets/cards'>
                                    <i class="nav-icon bi bi-arrow-right text-wrning"></i>
                                    <p>Delete massages</p>
                                </a>
                            </li>
                        </ul>
                    </li> --}}

                    {{-- break line --}}
                    <div>
                        <ul class="nav flex-column" style="color:aliceblue">
                            <hr>
                            {{-- site and mobile app --}}
                            {{-- <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon bi bi-globe text-warning"></i>
                                    <p>
                                        Site and Mobile App
                                        <i class="nav-arrow bi bi-chevron-right text-warning"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a class='nav-link' href='/dist/pages/widgets/small-box'>
                                            <i class="nav-icon bi bi-server text-warning"></i>
                                            <p>Website & SEO
                                                <i class="nav-arrow bi bi-chevron-right text-warning"></i>
                                            </p>
                                        </a>
                                        <ul class="nav nav-treeview">
                                            <li class="nav-item">
                                                <a class='nav-link' href='/dist/pages/widgets/small-box'>
                                                    <i class="nav-icon bi bi-arrow-right text-warning"></i>
                                                    <p>Website </p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class='nav-link' href='/dist/pages/widgets/small-box'>
                                                    <i class="nav-icon bi bi-arrow-right text-warning"></i>
                                                    <p>SEO</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class='nav-link' href='/dist/pages/widgets/small-box'>
                                                    <i class="nav-icon bi bi-arrow-right text-warning"></i>
                                                    <p>Site Speed</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class='nav-link' href='/dist/pages/widgets/small-box'>
                                                    <i class="nav-icon bi bi-arrow-right text-warning"></i>
                                                    <p>Uptime and security</p>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="nav-item">
                                        <a class='nav-link' href='/dist/pages/widgets/info-box'>
                                            <i class="nav-icon bi bi-phone text-warning"></i>
                                            <p>Mobile app</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class='nav-link' href='/dist/pages/widgets/info-box'>
                                            <i class="nav-icon bi bi-tag text-warning"></i>
                                            <p>Logo & Brand</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class='nav-link' href='/dist/pages/widgets/info-box'>
                                            <i class="nav-icon bi bi-server text-warning"></i>
                                            <p>Hopp- Link in Bio</p>
                                        </a>
                                    </li>
                                </ul>
                            </li> --}}
                            {{-- inbox --}}
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon bi bi-inbox text-warning"></i>
                                    <p>Inbox</p>
                                </a>
                            </li>

                            {{-- customer and leads  --}}
                            {{-- <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon bi bi-people text-warning"></i>
                                    <p>
                                        Customers & Leads
                                        <i class="nav-arrow bi bi-chevron-right text-warning"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a class='nav-link' href='/dist/pages/widgets/small-box'>
                                            <i class="nav-icon bi bi-arrow-right text-warning"></i>
                                            <p>Contects</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class='nav-link' href='/dist/pages/widgets/info-box'>
                                            <i class="nav-icon bi bi-arrow-right text-warning"></i>
                                            <p>Form & Submission</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class='nav-link' href='/dist/pages/widgets/info-box'>
                                            <i class="nav-icon bi bi-arrow-right text-warning"></i>
                                            <p>Cummunity</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class='nav-link' href='/dist/pages/widgets/info-box'>
                                            <i class="nav-icon bi bi-arrow-right text-warning"></i>
                                            <p>Loyalty Programs</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class='nav-link' href='/dist/pages/widgets/info-box'>
                                            <i class="nav-icon bi bi-arrow-right text-warning"></i>
                                            <p>Business Email</p>
                                        </a>
                                    </li>
                                </ul>
                            </li> --}}

                            {{-- Marteking  --}}
                            {{-- <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon bi bi-bar-chart-line text-warning"></i>
                                    <p>
                                        Marketing
                                        <i class="nav-arrow bi bi-chevron-right text-warning"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a class='nav-link' href='/dist/pages/widgets/small-box'>
                                            <i class="nav-icon bi bi-arrow-right text-warning"></i>
                                            <p>Marketing Home</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class='nav-link' href='/dist/pages/widgets/info-box'>
                                            <i class="nav-icon bi bi-arrow-right text-warning"></i>
                                            <p>Google Ads</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class='nav-link' href='/dist/pages/widgets/info-box'>
                                            <i class="nav-icon bi bi-arrow-right text-warning"></i>
                                            <p>Facebook & Instagram Ads</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class='nav-link' href='/dist/pages/widgets/info-box'>
                                            <i class="nav-icon bi bi-arrow-right text-warning"></i>
                                            <p>Email Marketing</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class='nav-link' href='/dist/pages/widgets/info-box'>
                                            <i class="nav-icon bi bi-arrow-right text-warning"></i>
                                            <p>Social Media Marketing</p>
                                            bage adding id panding
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class='nav-link' href='/dist/pages/widgets/info-box'>
                                            <i class="nav-icon bi bi-arrow-right text-warning"></i>
                                            <p>Referral Program</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class='nav-link' href='/dist/pages/widgets/info-box'>
                                            <i class="nav-icon bi bi-arrow-right text-warning"></i>
                                            <p>Coupons</p>
                                        </a>
                                    </li>
                                </ul>
                            </li> --}}

                            {{-- Analyics  --}}
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon bi bi-graph-up text-warning"></i>
                                    <p>
                                        Analytics
                                        <i class="nav-arrow bi bi-chevron-right text-warning"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    {{-- <li class="nav-item">
                                        <a class='nav-link' href='/dist/pages/widgets/small-box'>
                                            <i class="nav-icon bi bi-arrow-right text-warning"></i>
                                            <p>Highlights</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class='nav-link' href='/dist/pages/widgets/info-box'>
                                            <i class="nav-icon bi bi-arrow-right text-warning"></i>
                                            <p> Real Time</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class='nav-link' href='/dist/pages/widgets/info-box'>
                                            <i class="nav-icon bi bi-arrow-right text-warning"></i>
                                            <p>Traffic</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class='nav-link' href='/dist/pages/widgets/info-box'>
                                            <i class="nav-icon bi bi-arrow-right text-warning"></i>
                                            <p>Behaviour</p>
                                        </a>
                                    </li> --}}
                                    <li class="nav-item">
                                        <a class='nav-link' href='/dist/pages/widgets/info-box'>
                                            <i class="nav-icon bi bi-arrow-right text-warning"></i>
                                            <p>Marketing</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class='nav-link' href='/dist/pages/widgets/info-box'>
                                            <i class="nav-icon bi bi-arrow-right text-warning"></i>
                                            <p>Session Recorings</p>
                                        </a>
                                    </li>
                                    {{-- <li class="nav-item">
                                        <a class='nav-link' href='/dist/pages/widgets/info-box'>
                                            <i class="nav-icon bi bi-arrow-right text-warning"></i>
                                            <p>Insights</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class='nav-link' href='/dist/pages/widgets/info-box'>
                                            <i class="nav-icon bi bi-arrow-right text-warning"></i>
                                            <p>Benchmarks</p>
                                        </a>
                                    </li> --}}
                                    <li class="nav-item">
                                        <a class='nav-link' href='/dist/pages/widgets/info-box'>
                                            <i class="nav-icon bi bi-arrow-right text-warning"></i>
                                            <p>All reports</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            {{-- Automations --}}
                            {{-- <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon bi bi-recycle text-warning"></i>
                                    <p>
                                        Automations
                                        <i class="nav-arrow bi bi-chevron-right text-warning"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a class='nav-link' href='/dist/pages/widgets/small-box'>
                                            <i class="nav-icon bi bi-arrow-right text-wrning"></i>
                                            <p>Automations</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class='nav-link' href='/dist/pages/widgets/info-box'>
                                            <i class="nav-icon bi bi-arrow-right text-wrning"></i>
                                            <p>Functions</p>
                                        </a>
                                    </li>
                                </ul>
                            </li> --}}
                            <hr>
                        </ul>
                    </div>


                    {{-- setting --}}
                    <li class="nav-item menu-open">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon bi bi-gear text-warning"></i>
                            <p>
                                Settings
                            </p>
                        </a>
                    </li>
                    {{-- dsign site --}}
                    <hr style="color: white">
                    <li class="nav-item menu-open justfiy-content-center">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon bi bi-brush text-warning"></i>
                            <p>
                                Design Site
                            </p>
                        </a>
                    </li>
                </ul>
                <!--end::Sidebar Menu-->
            </nav>
        </div>
        <!--end::Sidebar Wrapper-->
    </aside>
    <!--end::Sidebar-->
