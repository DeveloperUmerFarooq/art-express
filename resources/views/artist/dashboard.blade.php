@extends('layouts.artistLayout.layout')
@section('title')
    Artist Dashboard | Art-Express
@endsection
@section('page')
    <div class="container-fluid py-3">
        <!-- Dashboard Header -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-chart-line"></i> Artist Dashboard</h1>
            <div class="d-none d-sm-inline-block">
                <span class="badge bg-primary text-white p-2">
                    <i class="fas fa-calendar-alt mr-2"></i>
                    <?php echo date('F j, Y'); ?>
                </span>
            </div>
        </div>
        <hr>
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
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="currentMonthSales">---</div>
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
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="totalSalesAmount">---</div>
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
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="total-likes">---</div>
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
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="total-products">---</div>
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
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="total-blogs">---</div>
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

            <!-- Auctions Hosted -->
            <div class="col-xl-2 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Auctions</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="total-auctions">---</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-gavel fa-2x text-gray-300"></i>
                            </div>
                        </div>
                        <div class="mt-2 text-right">
                            <span class="text-xs text-muted">Auctions Hosted</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <!-- Sales Chart -->
        <div class="row">
            <div class="col-xl-6 col-lg-6">
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
            <!-- Auctions Pie Chart -->
            <div class="col-xl-6 col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-info">Auctions Status Pie Chart</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="auctionsPieChart" height="150"></canvas>
                        </div>
                        <div class="mt-4 text-center small">
                            <span class="mr-2"><i class="fas fa-circle text-info"></i> Auctions</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            // Initialize the sales chart
            const salesCtx = document.getElementById('salesChart').getContext('2d');
            const salesChart = new Chart(salesCtx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov',
                        'Dec'
                    ],
                    datasets: [{
                        label: 'Monthly Sales (Rs)',
                        data: [],
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
                options: getChartOptions()
            });
            // Auctions Pie Chart - Static Data
            const auctionsPieCtx = document.getElementById('auctionsPieChart').getContext('2d');
            const auctionsPieChart = new Chart(auctionsPieCtx, {
                type: 'pie',
                data: {
                    labels: ['Upcoming', 'Ongoing', 'Ended'],
                    datasets: [{
                        data: [],
                        backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#e74a3b'],
                        borderWidth: 1
                    }]
                },
                options:{
                    responsive:true,
                    maintainAspectRatio:false
                }
            });

            function getChartOptions() {
                return {
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
                    }
                };
            }

            // Function to fetch and update dashboard stats
            function fetchDashboardStats() {
                $.ajax({
                    url: "{{ route('artist.stats') }}",
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        $('#currentMonthSales').text('Rs ' + response.currentMonthSales
                        .toLocaleString());
                        $('#totalSalesAmount').text('Rs ' + response.totalSalesAmount.toLocaleString());
                        $('#total-likes').text(response.totalLikes.toLocaleString());
                        $('#total-products').text(response.totalProducts.toLocaleString());
                        $('#total-blogs').text(response.totalBlogs.toLocaleString());
                        $('#total-auctions').text(response.auctions.toLocaleString());

                        salesChart.data.datasets[0].data = response.monthlySales;
                        salesChart.update();

                        auctionsPieChart.data.datasets[0].data=response.auctionsData;
                        auctionsPieChart.update();


                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching dashboard stats:', error);
                    }
                });
            }

            fetchDashboardStats();

            setInterval(fetchDashboardStats, 120000);
        });
    </script>
@endpush
