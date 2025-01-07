@extends('layouts.adminLayout.layout')
@section('title')
Dashboard-Admin
@endsection
@section('page')
<div class="container mt-5">
    <div class="row">
        <!-- Total Sales Card -->
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3" style="height: max-content">
                <div class="card-header">Total Sales</div>
                <div class="card-body">
                    <h5 class="card-title text-center" style="color: var(--primary)">$1,230</h5>
                    <p class="card-text">This month's sales</p>
                </div>
            </div>
        </div>

        <!-- Number of Artists Card -->
        <div class="col-md-3">
            <div class="card text-white bg-primary bg-gradient mb-3" style="height: max-content">
                <div class="card-header">Artists</div>
                <div class="card-body">
                    <h5 class="card-title text-center" style="color:var(--primary)">50</h5>
                    <p class="card-text">Total artists on the platform</p>
                </div>
            </div>
        </div>

        <!-- Number of Users Card -->
        <div class="col-md-3">
            <div class="card text-white bg-success bg-gradient mb-3" style="height: max-content">
                <div class="card-header">Users</div>
                <div class="card-body">
                    <h5 class="card-title text-center" style="color:var(--primary);">50</h5>
                    <p class="card-text">Total Users on the platform</p>
                </div>
            </div>
        </div>

        <!-- Number of Products Card -->
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3" style="height: max-content">
                <div class="card-header">Products</div>
                <div class="card-body">
                    <h5 class="card-title text-center" style="color:var(--primary)">120</h5>
                    <p class="card-text">Total number of artworks</p>
                </div>
            </div>
        </div>

        <!-- Number of Blog Posts Card -->
        <div class="col-md-3">
            <div class="card text-white bg-danger bg-gradient mb-3" style="height: max-content">
                <div class="card-header">Blog Posts</div>
                <div class="card-body">
                    <h5 class="card-title text-center" style="color:var(--primary)">35</h5>
                    <p class="card-text">Total blog posts published</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container mt-5">
    <div class="row">
        <!-- Sales Chart -->
        <div class="col-md-6">
            <canvas id="salesChart"></canvas>
        </div>

        <!-- Users Chart -->
        <div class="col-md-6">
            <canvas id="usersChart"></canvas>
        </div>
    </div>
</div>

@push('scripts')
<script>
// Users Chart
const usersCtx = document.getElementById('usersChart').getContext('2d');
const usersChart = new Chart(usersCtx, {
    type: 'bar',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        datasets: [{
            label: 'New Users',
            data: [50, 75, 100, 120, 130, 150, 180],
            backgroundColor: 'rgba(75, 192, 75, 0.6)',
            borderColor: 'rgba(75, 192, 75, 1)',
            borderWidth: 1,
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

// Sales Chart
const salesCtx = document.getElementById('salesChart').getContext('2d');
const salesChart = new Chart(salesCtx, {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        datasets: [{
            label: 'Monthly Sales ($)',
            data: [1200, 1500, 1700, 1400, 1600, 1800, 2000],
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
