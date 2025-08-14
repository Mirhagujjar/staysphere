<!doctype html>
<html lang="en">
<!--begin::Head-->
<head>
    @include('admin.includes.head')
    @include('components.logout-confirmation')


     <!--  Custom CSS (agar koi ho) -->
     {{-- <link rel="stylesheet" href="{{ asset('css/custom.css') }}"> --}}
     

     <!-- Bootstrap CSS -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

     @stack('styles')

     
</head>

<!--end::Head-->
<!--begin::Body-->

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
        @include('admin.includes.header')
        {{-- @include('admin.includes.sidebar') --}}
        @if(isset($rooms) && count($rooms) > 0)
            @include('admin.includes.sidebar', ['rooms' => $rooms])
        @else
            @include('admin.includes.sidebar')
        @endif
              <!--begin::App Main-->
        <main class="app-main">
            <!--begin::App Content Header-->
            <div class="app-content-header">
                <!--begin::Container-->
                <div class="container-fluid">
                    <!--begin::Row-->
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0">Dashboard</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                            </ol>
                        </div>
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Container-->
            </div>
            <!--end::App Content Header-->
            <!--begin::App Content-->
            



            

            <div class="container mt-4">
                @yield('content')
            </div>


            <!--end::App Content-->
        </main>
        <!--end::App Main-->
        <!--begin::Footer-->
        <footer class="app-footer">
            <!--begin::To the end-->
            <div class="float-end d-none d-sm-inline">Anything you want</div>
            <!--end::To the end-->
            <!--begin::Copyright-->
            {{-- <strong>
                Copyright &copy; 2014-2025&nbsp;
                <a href="https://adminlte.io" class="text-decoration-none">AdminLTE.io</a>.
            </strong> --}}
            All rights reserved.
            <!--end::Copyright-->
        </footer>
        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

        <!--end::Footer-->
    </div>
    <!--end::App Wrapper-->
    <!--begin::Script-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->

    <!--end::Script-->
    @stack('scripts')
    @stack('js')
</body>
<!--end::Body-->

</html>

