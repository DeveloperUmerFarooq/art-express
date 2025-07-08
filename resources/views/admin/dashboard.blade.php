@extends('layouts.adminLayout.layout')
@section('title')
    Dashboard-Admin | Art-Express
@endsection
@section('page')
    <div class="container-fluid py-3">
        <!-- Dashboard Header -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-chart-line"></i> Dashboard Overview</h1>
            <div class="d-none d-sm-inline-block">
                <span class="badge bg-primary text-white p-2">
                    <i class="fas fa-calendar-alt mr-2"></i>
                    <?php echo date('F j, Y'); ?>
                </span>
            </div>
        </div>

        <!-- Cards Row -->
        <div class="row justify-content-center">
            <!-- Total Sales Card -->
            <div class="col-xl-2 col-md-4 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Sales</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="totalSales">---</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-money-bill-alt fa-2x text-gray-300"></i>
                            </div>
                        </div>
                        <div class="mt-2 text-right">
                            <span class="text-xs text-muted">This year</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Artists Card -->
            <div class="col-xl-2 col-md-4 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Artists</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="artists">---</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-palette fa-2x text-gray-300"></i>
                            </div>
                        </div>
                        <div class="mt-2 text-right">
                            <span class="text-xs text-muted">Total registered</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Users Card -->
            <div class="col-xl-2 col-md-4 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Users</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="users">---</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                        <div class="mt-2 text-right">
                            <span class="text-xs text-muted">Active accounts</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products Card -->
            <div class="col-xl-2 col-md-4 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Artworks</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="products">---</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-image fa-2x text-gray-300"></i>
                            </div>
                        </div>
                        <div class="mt-2 text-right">
                            <span class="text-xs text-muted">Total pieces</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Blog Posts Card -->
            <div class="col-xl-2 col-md-4 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                    Blog Posts</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="blogs">---</div>
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

            <!-- Monthly Revenue Card -->
            <div class="col-xl-2 col-md-4 mb-4">
                <div class="card border-left-secondary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                    Revenue</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="monthlySalesData">---</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-chart-line fa-2x text-gray-300"></i>
                            </div>
                        </div>
                        <div class="mt-2 text-right">
                            <span class="text-xs text-muted">Current month</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Orders Placed --}}
            <div class="col-xl-2 col-md-4 mb-4">
                <div class="card border-left-secondary shadow py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Order</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="monthlySalesData">---</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-box-open fa-2x text-gray-300"></i>
                            </div>
                        </div>
                        <div class="mt-2 text-right">
                            <span class="text-xs text-muted">Total Orders Placed on the Platform</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Total Auctions on the platform --}}
            <div class="col-xl-2 col-md-4 mb-4">
                <div class="card border-left-secondary shadow py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Auctions</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="monthlySalesData">---</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-gavel fa-2x text-gray-300"></i>
                            </div>
                        </div>
                        <div class="mt-2 text-right">
                            <span class="text-xs text-muted">Total Auctions on Platform</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Total auctions hosted by admin --}}
            <div class="col-xl-2 col-md-4 mb-4">
                <div class="card border-left-secondary shadow py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                    Auctions</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="monthlySalesData">---</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-gavel fa-2x text-gray-300"></i>
                            </div>
                        </div>
                        <div class="mt-2 text-right">
                            <span class="text-xs text-muted">Total Auctions Hosted by Admin</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <!-- Charts Row -->
        <div class="row">
            <!-- Sales Chart -->
            <div class="col-xl-6 col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Monthly Sales Overview</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="salesChart"></canvas>
                        </div>
                        <div class="mt-4 text-center small">
                            <span class="mr-2">
                                <i class="fas fa-circle text-primary"></i> Sales
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Users Chart -->
            <div class="col-xl-6 col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-success">User Acquisition</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="usersChart"></canvas>
                        </div>
                        <div class="mt-4 text-center small">
                            <span class="mr-2">
                                <i class="fas fa-circle text-success"></i> New Users
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Orders Pie Chart -->
            <div class="col-xl-6 col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-warning">Orders Status Pie Chart</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="ordersPieChart" width="200" height="200"></canvas>
                        </div>
                        <div class="mt-4 text-center small">
                            <span class="mr-2"><i class="fas fa-circle text-warning"></i> Orders</span>
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
                            <canvas id="auctionsPieChart" width="200" height="200"></canvas>
                        </div>
                        <div class="mt-4 text-center small">
                            <span class="mr-2"><i class="fas fa-circle text-info"></i> Auctions</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    @push('scripts')
        <script>
            $(document).ready(function() {

                // Fetch Admin Stats
                function fetchDashboardStats() {
                    $.ajax({
                        url: "{{ route('admin.stats') }}",
                        type: 'GET',
                        dataType: 'json',
                        success: function(response) {

                            $('#totalSales').text('Rs ' + response.totalSales.toLocaleString());
                            $('#artists').text(response.artists.toLocaleString());
                            $('#users').text(response.users.toLocaleString());
                            $('#products').text(response.products.toLocaleString());
                            $('#blogs').text(response.blogs.toLocaleString());
                            const currentMonth = new Date().getMonth();
                            $('#monthlySalesData').text('Rs ' + response.monthlySales[currentMonth]
                                .toLocaleString());
                            updateCharts(response.monthlyUsers, response.monthlySales);
                        },
                        error: function(xhr, status, error) {
                            console.error('Error fetching dashboard stats:', error);
                        }
                    });
                }

                const usersCtx = document.getElementById('usersChart').getContext('2d');
                const salesCtx = document.getElementById('salesChart').getContext('2d');

                // userChart
                const usersChart = new Chart(usersCtx, {
                    type: 'bar',
                    data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov',
                            'Dec'
                        ],
                        datasets: [{
                            label: 'New Users',
                            data: [],
                            backgroundColor: 'rgba(28, 200, 138, 0.6)',
                            borderColor: 'rgba(28, 200, 138, 1)',
                            borderWidth: 1,
                        }]
                    },
                    options: getChartOptions()
                });

                // Sales Chart
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
                // Orders Pie Chart - Static Data
                const ordersPieCtx = document.getElementById('ordersPieChart').getContext('2d');
                const ordersPieChart = new Chart(ordersPieCtx, {
                    type: 'pie',
                    data: {
                        labels: ['Pending', 'Processing', 'Completed', 'Cancelled'],
                        datasets: [{
                            data: [12, 20, 40, 5], // ✅ STATIC DATA
                            backgroundColor: ['#f6c23e', '#36b9cc', '#1cc88a', '#e74a3b'],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                         maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }
                });

                // Auctions Pie Chart - Static Data
                const auctionsPieCtx = document.getElementById('auctionsPieChart').getContext('2d');
                const auctionsPieChart = new Chart(auctionsPieCtx, {
                    type: 'pie',
                    data: {
                        labels: ['Scheduled', 'Ongoing', 'Completed', 'Cancelled'],
                        datasets: [{
                            data: [8, 14, 25, 3], // ✅ STATIC DATA
                            backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#e74a3b'],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                         maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }
                });


                function updateCharts(usersData, salesData) {
                    usersChart.data.datasets[0].data = usersData;
                    usersChart.update();

                    salesChart.data.datasets[0].data = salesData;
                    salesChart.update();
                }

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

                fetchDashboardStats();

                setInterval(fetchDashboardStats, 120000);
            });

            // Orders

            const ordersChart = document.getElementById('ordersChart').getContext('2d');
            const ordersPieChart = new Chart(ordersChart, {
                type: 'pie',
                data: {
                    labels: ['Pending', 'Processing', 'Completed'],
                    datasets: [{
                        label: 'Order Status',
                        data: [10, 25, 45],
                        backgroundColor: [
                            '#f6c23e',
                            '#36b9cc',
                            '#1cc88a',
                            '#e74a3b'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });
        </script>
    @endpush
@endsection
