@extends('user.layout.master')

@section('content')
<style>
    :root {
        --primary: #4e73df;
        --primary-light: rgba(78, 115, 223, 0.1);
        --success: #1cc88a;
        --success-light: rgba(28, 200, 138, 0.1);
        --warning: #f6c23e;
        --warning-light: rgba(246, 194, 62, 0.1);
        --danger: #e74a3b;
        --danger-light: rgba(231, 74, 59, 0.1);
        --gray-800: #2d3748;
        --gray-700: #4a5568;
        --gray-100: #f8f9fc;
    }
    
    .dashboard-card {
        border-radius: 0.75rem;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
        transition: all 0.3s ease-in-out;
        border: none;
        overflow: hidden;
        position: relative;
    }
    
    .dashboard-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 2rem 0 rgba(58, 59, 69, 0.2);
    }
    
    .dashboard-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
    }
    
    .card-primary::before { background-color: var(--primary); }
    .card-success::before { background-color: var(--success); }
    .card-warning::before { background-color: var(--warning); }
    .card-danger::before { background-color: var(--danger); }
    
    .card-body {
        padding: 1.5rem;
    }
    
    .stat-label {
        font-size: 0.85rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--gray-700);
        margin-bottom: 0.5rem;
    }
    
    .stat-value {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--gray-800);
        margin-bottom: 1rem;
    }
    
    .stat-icon {
        position: absolute;
        right: 1.5rem;
        top: 1.5rem;
        opacity: 0.2;
        font-size: 4rem;
        z-index: 0;
    }
    
    .stat-link {
        font-size: 0.85rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        color: inherit;
    }
    
    .stat-link i {
        transition: transform 0.2s;
        font-size: 0.75rem;
        margin-left: 0.25rem;
    }
    
    .stat-link:hover {
        text-decoration: none;
    }
    
    .stat-link:hover i {
        transform: translateX(3px);
    }
    
    .chart-card {
        border: none;
        border-radius: 0.75rem;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
    }
    
    .chart-card .card-header {
        background-color: var(--gray-100);
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        padding: 1rem 1.5rem;
        font-weight: 600;
        color: var(--gray-800);
        border-radius: 0.75rem 0.75rem 0 0 !important;
    }
    
    .chart-container {
        position: relative;
        padding: 1.5rem;
        min-height: 250px;
    }
    
    .welcome-banner {
        background: linear-gradient(135deg, var(--primary) 0%, #224abe 100%);
        border-radius: 0.75rem;
        padding: 2rem;
        color: white;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
    }
    
    .welcome-banner::before {
        content: '';
        position: absolute;
        top: -50px;
        right: -50px;
        width: 200px;
        height: 200px;
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }
    
    .welcome-banner::after {
        content: '';
        position: absolute;
        bottom: -80px;
        right: -30px;
        width: 200px;
        height: 200px;
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }
    
    .welcome-title {
        font-weight: 700;
        margin-bottom: 0.5rem;
        position: relative;
        z-index: 1;
    }
    
    .welcome-text {
        opacity: 0.9;
        margin-bottom: 1.5rem;
        max-width: 600px;
        position: relative;
        z-index: 1;
    }
    
    @media (max-width: 768px) {
        .stat-value {
            font-size: 1.5rem;
        }
        
        .welcome-banner {
            padding: 1.5rem;
        }
    }
</style>

<div class="container-fluid">
    <!-- Welcome Banner -->
    <div class="welcome-banner">
        <h1 class="welcome-title">Welcome back, {{ Auth::user()->name }}!</h1>
        <p class="welcome-text">Here's what's happening with your hotel experience today. Manage your bookings, services, and events all in one place.</p>
        <div class="d-flex">
            <div class="mr-3">
                <div class="text-white font-weight-bold">{{ now()->format('l') }}</div>
                <div class="text-white-50">{{ now()->format('F j, Y') }}</div>
            </div>
        </div>
    </div>

    <!-- Key Metrics Cards -->
    <div class="row mb-4">
        <!-- My Bookings -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="dashboard-card card-primary h-100">
                <div class="card-body position-relative">
                    <i class="fas fa-bed stat-icon text-primary"></i>
                    <div class="stat-label">My Bookings</div>
                    <div class="stat-value">{{ $totalUserBookings ?? 0 }}</div>
                    <a href="{{ route('user.reservations.index') }}" class="stat-link text-primary">
                        View details <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- My Packages -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="dashboard-card card-success h-100">
                <div class="card-body position-relative">
                    <i class="fas fa-gift stat-icon text-success"></i>
                    <div class="stat-label">My Packages</div>
                    <div class="stat-value">{{ $totalUserPackages ?? 0 }}</div>
                    <a href="{{ route('booking.index') }}" class="stat-link text-success">
                        View details <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- My Services -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="dashboard-card card-warning h-100">
                <div class="card-body position-relative">
                    <i class="fas fa-concierge-bell stat-icon text-warning"></i>
                    <div class="stat-label">My Services</div>
                    <div class="stat-value">{{ $totalUserServices ?? 0 }}</div>
                    <a href="{{ route('user.services.requests') }}" class="stat-link text-warning">
                        View details <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- My Events -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="dashboard-card card-danger h-100">
                <div class="card-body position-relative">
                    <i class="fas fa-calendar-alt stat-icon text-danger"></i>
                    <div class="stat-label">My Events</div>
                    <div class="stat-value">{{ $totalUserEvents ?? 0 }}</div>
                    <a href="{{ route('user.event-booking.index') }}" class="stat-link text-danger">
                        View details <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row mb-4">
        <!-- Booking Trend Chart -->
        <div class="col-xl-8 mb-4">
            <div class="chart-card card h-100">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <span>Booking Trend</span>
                        <div class="dropdown no-arrow">
                            <button class="btn btn-link btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right shadow">
                                <a class="dropdown-item" href="#">Last 6 Months</a>
                                <a class="dropdown-item" href="#">Last Year</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="bookingTrendChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Package Distribution Chart -->
        {{-- <div class="col-xl-4 mb-4">
            <div class="chart-card card h-100">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <span>Package Distribution</span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="packageChart"></canvas>
                    </div>
                    <div class="mt-3 text-center small">
                        @foreach($packageTypes ?? ['Standard','Deluxe','Suite'] as $index => $type)
                            <span class="mr-2">
                                <i class="fas fa-circle" style="color: {{ ['#4e73df','#1cc88a','#36b9cc'][$index] }}"></i> {{ $type }}
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div> --}}
    </div>

    <!-- Recent Activity Section -->
    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Recent Activity</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow">
                            <a class="dropdown-item" href="#">View All</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="text-center py-4">
                        <i class="fas fa-history fa-2x text-gray-300 mb-3"></i>
                        <p class="text-muted">Your recent activities will appear here</p>
                        <a href="#" class="btn btn-primary btn-sm">Refresh</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Booking Trend Chart
    var ctx = document.getElementById('bookingTrendChart').getContext('2d');
    var bookingChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($bookingMonths ?? ['Jan','Feb','Mar','Apr','May','Jun']) !!},
            datasets: [{
                label: 'Bookings',
                data: {!! json_encode($bookingCounts ?? [0,0,0,0,0,0]) !!},
                backgroundColor: 'rgba(78, 115, 223, 0.05)',
                borderColor: 'rgba(78, 115, 223, 1)',
                pointBackgroundColor: 'rgba(78, 115, 223, 1)',
                pointBorderColor: '#fff',
                pointHoverRadius: 5,
                pointHoverBackgroundColor: 'rgba(78, 115, 223, 1)',
                pointHoverBorderColor: '#fff',
                pointHitRadius: 10,
                pointBorderWidth: 2,
                borderWidth: 2,
                tension: 0.3,
                fill: true
            }]
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    titleMarginBottom: 10,
                    titleFontColor: '#6e707e',
                    titleFontSize: 14,
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    intersect: false,
                    mode: 'index',
                    caretPadding: 10,
                    callbacks: {
                        label: function(context) {
                            return context.parsed.y + ' bookings';
                        }
                    }
                }
            },
            scales: {
                x: {
                    grid: {
                        display: false,
                        drawBorder: false
                    },
                    ticks: {
                        color: '#858796'
                    }
                },
                y: {
                    grid: {
                        color: "rgb(234, 236, 244)",
                        zeroLineColor: "rgb(234, 236, 244)",
                        drawBorder: false,
                        borderDash: [2],
                        zeroLineBorderDash: [2]
                    },
                    ticks: {
                        color: '#858796',
                        padding: 20,
                        callback: function(value) {
                            return Number.isInteger(value) ? value : '';
                        }
                    },
                    beginAtZero: true
                }
            }
        }
    });

    // Package Distribution Chart
    var ctx2 = document.getElementById('packageChart').getContext('2d');
    var packageChart = new Chart(ctx2, {
        type: 'doughnut',
        data: {
            labels: @json($packageTypes ?? ['Standard','Deluxe','Suite']),
            datasets: [{
                data: @json($packageCounts ?? [0,0,0]),
                backgroundColor: ['#4e73df','#1cc88a','#36b9cc'],
                hoverBackgroundColor: ['#2e59d9','#17a673','#2c9faf'],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }]
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                    callbacks: {
                        label: function(context) {
                            var label = context.label || '';
                            var value = context.raw || 0;
                            var total = context.dataset.data.reduce((a, b) => a + b, 0);
                            var percentage = Math.round((value / total) * 100);
                            return label + ': ' + value + ' (' + percentage + '%)';
                        }
                    }
                }
            },
            cutout: '70%'
        }
    });

    // Responsive chart resizing
    window.addEventListener('resize', function() {
        bookingChart.resize();
        packageChart.resize();
    });
});
</script>
@endsection