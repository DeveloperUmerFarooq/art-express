@extends('layouts.artistLayout.layout')
@section('title')
Artist Dashboard
@endsection
@section('page')
<div class="container-fluid py-3">
    <!-- Dashboard Header -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Artist Dashboard</h1>
        <div class="d-none d-sm-inline-block">
            <span class="badge bg-primary text-white p-2">
                <i class="fas fa-calendar-alt mr-2"></i>
                <?php echo date('F j, Y'); ?>
            </span>
        </div>
    </div>

    <!-- Cards Row -->
    <div class="row justify-content-center">
        <!-- Total Monthly Sales Card -->
        <div class="col-xl-2 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                Revenue</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$totalMonthlySaleAmount}} Rs</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chart-line  fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    <div class="mt-2 text-right">
                        <span class="text-xs text-muted">This month's earnings</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Sales on Platform -->
        <div class="col-xl-2 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Sales</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$totalSalesAmount}} Rs</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-money-bill-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    <div class="mt-2 text-right">
                        <span class="text-xs text-muted">Total sales on platform</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Likes Card -->
        <div class="col-xl-2 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Total Likes</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$totalLikes}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-heart fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    <div class="mt-2 text-right">
                        <span class="text-xs text-muted">On your artworks</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Products Card -->
        <div class="col-xl-2 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Artworks</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$totalProducts}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-palette fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    <div class="mt-2 text-right">
                        <span class="text-xs text-muted">In your collection</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Blog Posts Card -->
        <div class="col-xl-2 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Blog Posts</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$totalBlogs}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-newspaper fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    <div class="mt-2 text-right">
                        <span class="text-xs text-muted">Published articles</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sales Chart -->
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Monthly Sales Performance</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="salesChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-2">
                            <i class="fas fa-circle text-primary"></i> Sales (Rs)
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
// Sales Chart
const salesCtx = document.getElementById('salesChart').getContext('2d');
const salesChart = new Chart(salesCtx, {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        datasets: [{
            label: 'Monthly Sales (Rs)',
            data: @json($monthlySales),
            borderColor: 'rgba(78, 115, 223, 1)',
            backgroundColor: 'rgba(78, 115, 223, 0.05)',
            fill: true,
            tension: 0.3,
            pointBackgroundColor: 'rgba(78, 115, 223, 1)',
            pointRadius: 3,
            pointHoverRadius: 5,
            pointHoverBackgroundColor: 'rgba(78, 115, 223, 1)',
            pointHitRadius: 10,
            pointBorderWidth: 2,
            borderWidth: 2,
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true,
                grid: {
                    display: true,
                    color: "rgba(0, 0, 0, .05)",
                    drawBorder: false
                },
                ticks: {
                    padding: 10
                }
            },
            x: {
                grid: {
                    display: false
                },
                ticks: {
                    padding: 10
                }
            }
        },
        plugins: {
            legend: {
                display: false
            },
            tooltip: {
                backgroundColor: 'rgba(0,0,0,0.8)',
                titleColor: '#fff',
                bodyColor: '#fff',
                footerColor: '#fff',
                borderColor: 'rgba(0,0,0,0.2)',
                borderWidth: 1,
                padding: 15,
                displayColors: false
            }
        },
    }
});
</script>
@endpush

@endsection
