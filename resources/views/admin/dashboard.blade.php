@extends('layouts.admin')

@section('content')
<style>
    .card {
        border-radius: 0.75rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        transition: transform 0.2s ease-in-out;
    }
    .card:hover {
        transform: translateY(-2px);
    }
    .card-title {
        font-weight: 600;
        color: #2d3748;
    }
    .btn {
        border-radius: 2rem;
        font-weight: 500;
        padding: 0.375rem 1.25rem;
    }
    .stat-value {
        font-size: 2.5rem;
        font-weight: 700;
        color: #4a5568;
    }
    .room-type-badge {
        border-radius: 0.5rem;
        background-color: #f7fafc;
        padding: 0.5rem;
        margin: 0.25rem 0;
    }
    <style>
    /* Custom CSS for dashboard */
    .icon-circle {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
    }
    
    .avatar-circle-sm {
        width: 32px;
        height: 32px;
        background-color: #f8f9fc;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        color: #4e73df;
    }
    
    .initials {
        font-size: 0.875rem;
    }
    
    .card {
        border: none;
        border-radius: 0.35rem;
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.1);
    }
    
    .border-left-primary {
        border-left: 0.25rem solid #4e73df !important;
    }
    
    .border-left-success {
        border-left: 0.25rem solid #1cc88a !important;
    }
    
    .border-left-warning {
        border-left: 0.25rem solid #f6c23e !important;
    }
    
    .border-left-danger {
        border-left: 0.25rem solid #e74a3b !important;
    }
    
    .border-left-info {
        border-left: 0.25rem solid #36b9cc !important;
    }
    
    .border-left-secondary {
        border-left: 0.25rem solid #858796 !important;
    }
    
    .border-left-dark {
        border-left: 0.25rem solid #5a5c69 !important;
    }
    
    .border-left-teal {
        border-left: 0.25rem solid #20c9a6 !important;
    }
    
    .border-left-purple {
        border-left: 0.25rem solid #6f42c1 !important;
    }
    
    .bg-teal {
        background-color: #20c9a6 !important;
    }
    
    .bg-purple {
        background-color: #6f42c1 !important;
    }
    
    .text-teal {
        color: #20c9a6 !important;
    }
    
    .text-purple {
        color: #6f42c1 !important;
    }
    
    .table-responsive {
        min-height: 300px;
    }
    
    .badge {
        font-size: 0.75rem;
        font-weight: 600;
        padding: 0.35em 0.65em;
    }
    
    .badge-success {
        background-color: #1cc88a;
    }
    
    .badge-warning {
        background-color: #f6c23e;
        color: #1a1a1a;
    }

    .icon-circle {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .avatar-circle-sm {
        width: 32px;
        height: 32px;
        background-color: #f8f9fc;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        color: #4e73df;
    }
    .chart-area {
        height: 300px;
    }
    .chart-pie {
        height: 250px;
    }

</style>

<section class="content">
    <div class="container-fluid">
        <!-- Dashboard Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="h3 mb-0 text-gray-800">Dashboard Overview</h1>
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="dashboardDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-calendar-alt mr-1"></i> Last 30 Days
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dashboardDropdown">
                            <a class="dropdown-item" href="#">Today</a>
                            <a class="dropdown-item" href="#">Last 7 Days</a>
                            <a class="dropdown-item" href="#">Last 30 Days</a>
                            <a class="dropdown-item" href="#">This Month</a>
                            <a class="dropdown-item" href="#">Custom Range</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Key Metrics Cards -->
        <div class="row g-4 mb-4">
            <!-- Total Rooms -->
            <div class="col-xl-3 col-md-6">
                <div class="card border-left-primary shadow h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <span class="text-xs font-weight-bold text-primary text-uppercase">Total Rooms</span>
                                <h2 class="mt-2 font-weight-bold">{{ $totalRooms ?? 0 }}</h2>
                            </div>
                            <div class="icon-circle bg-primary">
                                <i class="fas fa-bed text-white"></i>
                            </div>
                        </div>
                        <div class="mt-3">
                            <a href="{{ route('admin.rooms.index') }}" class="text-primary font-weight-bold">
                                View details <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Reservations -->
            <div class="col-xl-3 col-md-6">
                <div class="card border-left-success shadow h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <span class="text-xs font-weight-bold text-success text-uppercase">Total Reservations</span>
                                <h2 class="mt-2 font-weight-bold">{{ $totalReservations ?? 0 }}</h2>
                            </div>
                            <div class="icon-circle bg-success">
                                <i class="fas fa-calendar-check text-white"></i>
                            </div>
                        </div>
                        <div class="mt-3">
                            <a href="{{ route('admin.reservations.index') }}" class="text-success font-weight-bold">
                                View details <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Users -->
            <div class="col-xl-3 col-md-6">
                <div class="card border-left-warning shadow h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <span class="text-xs font-weight-bold text-warning text-uppercase">Total Users</span>
                                <h2 class="mt-2 font-weight-bold">{{ $totalUsers ?? 0 }}</h2>
                            </div>
                            <div class="icon-circle bg-warning">
                                <i class="fas fa-users text-white"></i>
                            </div>
                        </div>
                        <div class="mt-3">
                            <a href="{{ route('admin.users.index') }}" class="text-warning font-weight-bold">
                                View details <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Packages -->
            <div class="col-xl-3 col-md-6">
                <div class="card border-left-danger shadow h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <span class="text-xs font-weight-bold text-danger text-uppercase">Total Packages</span>
                                <h2 class="mt-2 font-weight-bold">{{ $totalPackages ?? 0 }}</h2>
                            </div>
                            <div class="icon-circle bg-danger">
                                <i class="fas fa-gift text-white"></i>
                            </div>
                        </div>
                        <div class="mt-3">
                            <a href="{{ route('admin.packages.index') }}" class="text-danger font-weight-bold">
                                View details <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Events -->
            <div class="col-xl-3 col-md-6">
                <div class="card border-left-info shadow h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <span class="text-xs font-weight-bold text-info text-uppercase">Total Events</span>
                                <h2 class="mt-2 font-weight-bold">{{ $totalEvents ?? 0 }}</h2>
                            </div>
                            <div class="icon-circle bg-info">
                                <i class="fas fa-bullhorn text-white"></i>
                            </div>
                        </div>
                        <div class="mt-3">
                            <a href="{{ route('events') }}" class="text-info font-weight-bold">
                                View details <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Reviews -->
            <div class="col-xl-3 col-md-6">
                <div class="card border-left-secondary shadow h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <span class="text-xs font-weight-bold text-secondary text-uppercase">Total Reviews</span>
                                <h2 class="mt-2 font-weight-bold">{{ $totalReviews ?? 0 }}</h2>
                            </div>
                            <div class="icon-circle bg-secondary">
                                <i class="fas fa-star text-white"></i>
                            </div>
                        </div>
                        <div class="mt-3">
                            <a href="{{ route('admin.review.index') }}" class="text-secondary font-weight-bold">
                                View details <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Blogs -->
            {{-- <div class="col-xl-3 col-md-6">
                <div class="card border-left-dark shadow h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <span class="text-xs font-weight-bold text-dark text-uppercase">Total Blogs</span>
                                <h2 class="mt-2 font-weight-bold">{{ $totalBlogs ?? 0 }}</h2>
                            </div>
                            <div class="icon-circle bg-dark">
                                <i class="fas fa-blog text-white"></i>
                            </div>
                        </div>
                        <div class="mt-3">
                            <a href="{{ route('admin.blogs.index') }}" class="text-dark font-weight-bold">
                                View details <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div> --}}

            <!-- Contact Messages -->
            <div class="col-xl-3 col-md-6">
                <div class="card border-left-teal shadow h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <span class="text-xs font-weight-bold text-teal text-uppercase">Contact Messages</span>
                                <h2 class="mt-2 font-weight-bold">{{ $totalContactMessages ?? 0 }}</h2>
                            </div>
                            <div class="icon-circle bg-teal">
                                <i class="fas fa-envelope text-white"></i>
                            </div>
                        </div>
                        <div class="mt-3">
                            <a href="{{ route('admin.contact.index') }}" class="text-teal font-weight-bold">
                                View details <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Service Requests -->
            <div class="col-xl-3 col-md-6">
                <div class="card border-left-purple shadow h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <span class="text-xs font-weight-bold text-purple text-uppercase">Service Requests</span>
                                <h2 class="mt-2 font-weight-bold">{{ $totalServiceRequests ?? 0 }}</h2>
                            </div>
                            <div class="icon-circle bg-purple">
                                <i class="fas fa-tools text-white"></i>
                            </div>
                        </div>
                        <div class="mt-3">
                            <a href="{{ route('admin.service_requests.index') }}" class="text-purple font-weight-bold">
                                View details <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
         <!-- Charts Row -->
        <div class="row mb-4">
            <!-- Reservations Chart -->
            <div class="col-xl-8">
                <div class="card shadow">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Reservations Trend</h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="#">Export Data</a>
                                <a class="dropdown-item" href="#">Print Chart</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Refresh</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="reservationsChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Room Type Distribution -->
            <div class="col-xl-4">
                <div class="card shadow">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Room Type Distribution</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-pie pt-4 pb-2">
                            <canvas id="roomTypeChart"></canvas>
                        </div>
                        <div class="mt-4 text-center small">
                            @foreach($typeWiseCounts as $type)
                                <span class="mr-3">
                                    <i class="fas fa-circle" style="color: {{ $type->roomType->color ?? '#4e73df' }}"></i>
                                    {{ ucfirst($type->roomType->label) }} ({{ $type->total }})
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Latest Reservations -->
        <div class="card shadow mt-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Latest Reservations</h6>
                <a href="{{ route('admin.reservations.index') }}" class="btn btn-sm btn-primary">View All</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>Reservation ID</th>
                                <th>Customer</th>
                                {{-- <th>Room</th> --}}
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($latestReservations as $reservation)
                                <tr>
                                    <td>#{{ $reservation->id }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-circle-sm mr-2">
                                                <span class="initials">{{ substr(optional($reservation->user)->name ?? 'G', 0, 1) }}</span>
                                            </div>
                                            <div>
                                                <div class="font-weight-bold">{{ optional($reservation->user)->name ?? 'Guest' }}</div>
                                                <div class="text-muted small">{{ optional($reservation->user)->email ?? 'N/A' }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    {{-- <td>{{ optional($reservation->room)->name ?? 'N/A' }}</td> --}}
                                    <td>{{ optional($reservation->created_at)->format('d M, Y') }}</td>
                                    <td>
                                        <span class="badge badge-{{ ($reservation->status ?? '') === 'confirmed' ? 'success' : 'warning' }}">
                                            {{ ucfirst($reservation->status ?? 'pending') }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4">No reservations found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Chart.js Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Reservations Line Chart
    document.addEventListener('DOMContentLoaded', function() {
        var ctx = document.getElementById('reservationsChart').getContext('2d');
        var reservationsChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Reservations',
                    data: [65, 59, 80, 81, 56, 55, 40, 62, 45, 70, 85, 90],
                    backgroundColor: 'rgba(78, 115, 223, 0.05)',
                    borderColor: 'rgba(78, 115, 223, 1)',
                    pointBackgroundColor: 'rgba(78, 115, 223, 1)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgba(78, 115, 223, 1)',
                    borderWidth: 2,
                    tension: 0.3
                }]
            },
            options: {
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Room Type Pie Chart
        var ctx2 = document.getElementById('roomTypeChart').getContext('2d');
        var roomTypeChart = new Chart(ctx2, {
            type: 'doughnut',
            data: {
                labels: ['Standard', 'Deluxe', 'Suite', 'Executive'],
                datasets: [{
                    data: [35, 25, 20, 20],
                    backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e'],
                    hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf', '#dda20a'],
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                }]
            },
            options: {
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    });
</script>

@endsection