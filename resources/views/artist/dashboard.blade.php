@extends('layouts.artistLayout.layout')
@section('title')
Dashboard-Admin
@endsection
@section('page')
<div class="container mt-5">
    <div class="row">
        <!-- Total Sales Card -->
        <div class="col-md-3">
            <div class="card dashboard-card text-white bg-success mb-3" style="height: max-content">
                <div class="card-header">Total Sales</div>
                <div class="card-body">
                    <h5 class="card-title text-center" style="color: var(--primary)">{{$totalSaleAmount}} Rs</h5>
                    <p class="card-text">This month's sales</p>
                </div>
            </div>
        </div>

        <!-- Number of Likes Card -->
        <div class="col-md-3">
            <div class="card dashboard-card text-white bg-danger bg-gradient mb-3" style="height: max-content">
                <div class="card-header">Likes</div>
                <div class="card-body">
                    <h5 class="card-title text-center" style="color:var(--primary)">{{$totalLikes}}</h5>
                    <p class="card-text">Total likes on platform</p>
                </div>
            </div>
        </div>


        <!-- Number of Products Card -->
        <div class="col-md-3">
            <div class="card dashboard-card text-white bg-primary mb-3" style="height: max-content">
                <div class="card-header">Products</div>
                <div class="card-body">
                    <h5 class="card-title text-center" style="color:var(--primary)">{{$totalProducts}}</h5>
                    <p class="card-text">Total number of artworks</p>
                </div>
            </div>
        </div>

        <!-- Number of Blog Posts Card -->
        <div class="col-md-3">
            <div class="card dashboard-card text-white bg-danger bg-gradient mb-3" style="height: max-content">
                <div class="card-header">Blog Posts</div>
                <div class="card-body">
                    <h5 class="card-title text-center" style="color:var(--primary)">{{$totalBlogs}}</h5>
                    <p class="card-text">Total blog posts published</p>
                </div>
            </div>
        </div>
    </div>
</div>
<center>
    <div class="container mt-5">
        <canvas id="salesChart"></canvas>
    </div>
</center>

@push('scripts')
<script>
    const salesCtx = document.getElementById('salesChart').getContext('2d');

    const salesChart = new Chart(salesCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Monthly Sales (Rs)',
                data: @json($monthlySales),
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                fill: true,
                tension: 0.4,
                pointBackgroundColor: 'rgba(75, 192, 192, 1)',
                pointRadius: 5,
                pointHoverBackgroundColor: 'rgba(0, 123, 255, 1)',
                borderWidth: 2,
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                }
            },
            plugins: {
                tooltip: {
                    backgroundColor: 'rgba(0,0,0,0.7)',
                    titleColor: '#fff',
                    bodyColor: '#fff',
                    footerColor: '#fff',
                    borderColor: 'rgba(0,0,0,0.3)',
                    borderWidth: 1,
                }
            },
        }
    });
    </script>

@endpush
@endsection
