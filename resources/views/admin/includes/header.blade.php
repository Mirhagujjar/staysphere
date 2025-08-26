 <!--begin::Header-->
 <nav class="app-header navbar navbar-expand bg-body">
     <!--begin::Container-->
     <div class="container-fluid">
         <!--begin::Start Navbar Links-->
         <ul class="navbar-nav">
             <li class="nav-item">
                 <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                     <i class="bi bi-list"></i>
                 </a>
             </li>
             <li class="nav-item d-none d-md-block"><a href="{{ url('/home') }}" class="nav-link">Home</a></li>
             <li class="nav-item d-none d-md-block"><a href="{{ route('admin.contact.index')}}" class="nav-link">Contacts</a></li>
                {{-- <a href="{{ url('/home') }}" class="btn btn-success btn-sm">
                    Go to User Panel
                </a> --}}
         </ul>
         <!--end::Start Navbar Links-->
         <!--begin::End Navbar Links-->
         <ul class="navbar-nav ms-auto">
             <!--begin::Navbar Search-->
             {{-- <li class="nav-item">
                 <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                     <i class="bi bi-search"></i>
                 </a>
             </li> --}}
             <!--end::Navbar Search-->
             <!--begin::Messages Dropdown Menu-->
             {{-- <li class="nav-item dropdown">
                 <a class="nav-link" data-bs-toggle="dropdown" href="#">
                     <i class="bi bi-chat-text"></i>
                     <span class="navbar-badge badge text-bg-danger">3</span>
                 </a>
                 <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                     <a href="#" class="dropdown-item">
                         <!--begin::Message-->
                         <div class="d-flex">
                             <div class="flex-shrink-0">
                                 <img src="../../dist/assets/img/user1-128x128.jpg" alt="User Avatar"
                                     class="img-size-50 rounded-circle me-3" />
                             </div>
                             <div class="flex-grow-1">
                                 <h3 class="dropdown-item-title">
                                     Brad Diesel
                                     <span class="float-end fs-7 text-danger"><i class="bi bi-star-fill"></i></span>
                                 </h3>
                                 <p class="fs-7">Call me whenever you can...</p>
                                 <p class="fs-7 text-secondary">
                                     <i class="bi bi-clock-fill me-1"></i> 4 Hours Ago
                                 </p>
                             </div>
                         </div>
                         <!--end::Message-->
                     </a>
                     <div class="dropdown-divider"></div>
                     <a href="#" class="dropdown-item">
                         <!--begin::Message-->
                         <div class="d-flex">
                             <div class="flex-shrink-0">
                                 <img src="../../dist/assets/img/user8-128x128.jpg" alt="User Avatar"
                                     class="img-size-50 rounded-circle me-3" />
                             </div>
                             <div class="flex-grow-1">
                                 <h3 class="dropdown-item-title">
                                     John Pierce
                                     <span class="float-end fs-7 text-secondary">
                                         <i class="bi bi-star-fill"></i>
                                     </span>
                                 </h3>
                                 <p class="fs-7">I got your message bro</p>
                                 <p class="fs-7 text-secondary">
                                     <i class="bi bi-clock-fill me-1"></i> 4 Hours Ago
                                 </p>
                             </div>
                         </div>
                         <!--end::Message-->
                     </a>
                     <div class="dropdown-divider"></div>
                     <a href="#" class="dropdown-item">
                         <!--begin::Message-->
                         <div class="d-flex">
                             <div class="flex-shrink-0">
                                 <img src="../../dist/assets/img/user3-128x128.jpg" alt="User Avatar"
                                     class="img-size-50 rounded-circle me-3" />
                             </div>
                             <div class="flex-grow-1">
                                 <h3 class="dropdown-item-title">
                                     Nora Silvester
                                     <span class="float-end fs-7 text-warning">
                                         <i class="bi bi-star-fill"></i>
                                     </span>
                                 </h3>
                                 <p class="fs-7">The subject goes here</p>
                                 <p class="fs-7 text-secondary">
                                     <i class="bi bi-clock-fill me-1"></i> 4 Hours Ago
                                 </p>
                             </div>
                         </div>
                         <!--end::Message-->
                     </a>
                     <div class="dropdown-divider"></div>
                     <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                 </div>
             </li> --}}
             <!--end::Messages Dropdown Menu-->
             <!--begin::Notifications Dropdown Menu-->
             {{-- <li class="nav-item dropdown">
                 <a class="nav-link" data-bs-toggle="dropdown" href="#">
                     <i class="bi bi-bell-fill"></i>
                     <span class="navbar-badge badge text-bg-warning">15</span>
                 </a>
                 <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                     <span class="dropdown-item dropdown-header">15 Notifications</span>
                     <div class="dropdown-divider"></div>
                     <a href="#" class="dropdown-item">
                         <i class="bi bi-envelope me-2"></i> 4 new messages
                         <span class="float-end text-secondary fs-7">3 mins</span>
                     </a>
                     <div class="dropdown-divider"></div>
                     <a href="#" class="dropdown-item">
                         <i class="bi bi-people-fill me-2"></i> 8 friend requests
                         <span class="float-end text-secondary fs-7">12 hours</span>
                     </a>
                     <div class="dropdown-divider"></div>
                     <a href="#" class="dropdown-item">
                         <i class="bi bi-file-earmark-fill me-2"></i> 3 new reports
                         <span class="float-end text-secondary fs-7">2 days</span>
                     </a>
                     <div class="dropdown-divider"></div>
                     <a href="#" class="dropdown-item dropdown-footer"> See All Notifications </a>
                 </div>
             </li> --}}
             <!--end::Notifications Dropdown Menu-->
             <!--begin::Fullscreen Toggle-->
             <li class="nav-item">
                <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                    <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                    <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
                </a>
            </li>
            <!--end::Fullscreen Toggle-->
            <!--begin::User Menu Dropdown-->
            <li class="nav-item dropdown user-menu">
                @auth
                    @if(in_array(Auth::user()->role, ['admin', 'super_admin']))
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            @if(Auth::user()->profile_image)
                                <img src="{{ asset('uploads/profile/' . Auth::user()->profile_image) }}" 
                                    class="user-image rounded-circle shadow" alt="User Image" />
                            @else
                                <div class="user-image rounded-circle shadow bg-secondary d-flex justify-content-center align-items-center">
                                    <i class="fas fa-user text-white"></i>
                                </div>
                            @endif
                            <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                            <!-- User Header -->
                            <li class="user-header">
                                @if(Auth::user()->profile_image)
                                    <img src="{{ asset('uploads/profile/' . Auth::user()->profile_image) }}" 
                                        class="rounded-circle shadow" alt="User Image" />
                                @else
                                    <div class="rounded-circle bg-warning d-flex justify-content-center align-items-center mx-auto" 
                                        style="width: 90px; height: 90px;">
                                        <i class="fas fa-user text-white fa-3x"></i>
                                    </div>
                                @endif
                                <p style="text-align: center; color: #08522d;">
                                    {{ Auth::user()->name }}
                                    <small>{{ ucfirst(Auth::user()->role) }} since {{ Auth::user()->created_at->format('M Y') }}</small>
                                </p>
                            </li>

                            <!-- Footer -->
                            <li class="user-footer">
                                <a href="{{ route('admin.profile.show') }}" class="btn btn-default btn-flat">
                                    <i class="fas fa-user me-2"></i> Profile
                                </a>
                                {{-- <a href="#" class="btn btn-default btn-flat float-end" 
                                onclick="event.preventDefault(); showLogoutConfirmation();">
                                    <i class="fas fa-sign-out-alt me-2"></i> Sign out
                                </a> --}}
                                <a class="btn btn-default btn-flat float-end" href="#" onclick="showLogoutConfirmation(event)">
                                    <i class="fas fa-sign-out-alt me-2"></i>
                                    <span>{{ __('Logout') }}</span>
                                </a>
                            </li>
                        </ul>
                    @endif
                @else
                    <!-- When not logged in -->
                    <a href="#" class="nav-link">
                        <img src="{{ asset('build/assets/images/SSlogo9.png') }}" alt="StaySphere Logo" 
                            class="user-image rounded-circle shadow">
                        <span class="d-none d-md-inline">StaySphere</span>
                    </a>
                @endauth

                


                {{-- <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

                

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
                            color: '#343a40'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                document.getElementById('logout-form').submit();
                            }
                        });
                    }
                </script> --}}

                <style>
                    .user-image {
                        width: 30px;
                        height: 30px;
                        object-fit: cover;
                    }

                    .user-header {
                        padding: 10px;
                        text-align: center;
                    }

                    .user-header img,
                    .user-header div {
                        width: 90px;
                        height: 90px;
                        margin-bottom: 10px;
                    }

                    .user-header p {
                        margin-bottom: 0;
                        font-size: 14px;
                    }

                    .user-header small {
                        display: block;
                        font-size: 12px;
                    }

                    .user-footer {
                        padding: 10px;
                        display: flex;
                        justify-content: space-between;
                    }

                    .user-footer .btn {
                        padding: 5px 10px;
                        font-size: 13px;
                    }
                </style>
            </li>

             <!--end::User Menu Dropdown-->
         </ul>
         <!--end::End Navbar Links-->
     </div>
     <!--end::Container-->
 </nav>
 <!--end::Header-->
