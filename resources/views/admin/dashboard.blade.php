@extends('layouts.adminLayout.layout')
@section('title')
Dashboard-Admin
@endsection

@section('page')
<div class="container mt-5">
    <div class="row">
        <!-- Total Sales Card -->
        <div class="col-md-3">
            <div class="card text-white bg-danger mb-3" style="height: max-content">
                <div class="card-header">Total Sales</div>
                <div class="card-body">
                    <h5 class="card-title text-center" style="color: var(--primary)">$1,230</h5>
                    <p class="card-text">This month's sales</p>
                </div>
            </div>
        </div>

        <!-- Number of Artists Card -->
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3" style="height: max-content">
                <div class="card-header">Artists</div>
                <div class="card-body">
                    <h5 class="card-title text-center" style="color:var(--primary)">50</h5>
                    <p class="card-text">Active artists on the platform</p>
                </div>
            </div>
        </div>

        <!-- Number of Users Card -->
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3" style="height: max-content">
                <div class="card-header">Users</div>
                <div class="card-body">
                    <h5 class="card-title text-center" style="color:var(--primary);">50</h5>
                    <p class="card-text">Active Users    on the platform</p>
                </div>
            </div>
        </div>

        <!-- Number of Products Card -->
        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3" style="height: max-content">
                <div class="card-header">Products</div>
                <div class="card-body">
                    <h5 class="card-title text-center" style="color:var(--primary)">120</h5>
                    <p class="card-text">Total number of artworks</p>
                </div>
            </div>
        </div>

        <!-- Number of Blog Posts Card -->
        <div class="col-md-3">
            <div class="card text-white bg-info mb-3" style="height: max-content">
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
    type: 'bar',  // Bar chart to visualize user count per month
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        datasets: [{
            label: 'New Users',
            data: [50, 75, 100, 120, 130, 150, 180],  // Example number of new users per month
            backgroundColor: 'rgba(255, 159, 64, 0.6)',
            borderColor: 'rgba(255, 159, 64, 1)',
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

 // Get the context of the canvas element
const ctx = document.getElementById('salesChart').getContext('2d');

// Create a linear gradient for the chart's line fill
const gradient = ctx.createLinearGradient(0, 0, 0, 400);
gradient.addColorStop(0, 'rgba(75, 192, 192, 0.4)');  // Start with a lighter color
gradient.addColorStop(1, 'rgba(75, 192, 192, 1)');    // End with a stronger color

const salesChart = new Chart(ctx, {
    type: 'line', // Line chart type
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'], // Monthly labels
        datasets: [{
            label: 'Monthly Sales ($)',
            data: [1200, 1500, 1700, 1400, 1600, 1800, 2000], // Sales data points
            borderColor: 'rgba(75, 192, 192, 1)',   // Line color
            backgroundColor: gradient,              // Gradient background
            fill: true,                              // Fill the area below the line
            tension: 0.4,                            // Smooth the curve of the line
            pointBackgroundColor: 'rgba(75, 192, 192, 1)', // Points color
            pointRadius: 5,                         // Size of the points
            pointHoverBackgroundColor: 'rgba(0, 123, 255, 1)', // Hover color for points
            borderWidth: 2,                         // Line thickness
        }]
    },
    options: {
        responsive: true, // Make the chart responsive
        scales: {
            y: {
                beginAtZero: true,           // Ensure the Y-axis starts from 0
                grid: {
                    borderColor: 'rgba(0,0,0,0.1)', // Grid lines color
                    borderWidth: 1,
                },
                ticks: {
                    font: {
                        size: 14,          // Font size for Y-axis labels
                    },
                },
            },
            x: {
                grid: {
                    borderColor: 'rgba(0,0,0,0.1)', // Grid lines color
                    borderWidth: 1,
                },
                ticks: {
                    font: {
                        size: 14,          // Font size for X-axis labels
                    },
                },
            },
        },
        plugins: {
            legend: {
                position: 'top',            // Position of the legend
                labels: {
                    font: {
                        size: 16,            // Font size for legend
                    },
                },
            },
            tooltip: {
                enabled: true,
                backgroundColor: 'rgba(0,0,0,0.7)',  // Tooltip background color
                titleColor: '#fff',                   // Title text color in tooltip
                bodyColor: '#fff',                    // Body text color in tooltip
                footerColor: '#fff',                  // Footer text color in tooltip
                borderColor: 'rgba(0,0,0,0.3)',      // Tooltip border color
                borderWidth: 1,                       // Tooltip border width
                caretSize: 8,                         // Size of the caret (the little triangle)
            },
        },
        animation: {
            duration: 1500,  // Duration for the chart animation
            easing: 'easeOutQuart',  // Animation easing effect
        }
    }
});


</script>
@endpush

@endsection
