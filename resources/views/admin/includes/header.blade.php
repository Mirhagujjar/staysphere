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
