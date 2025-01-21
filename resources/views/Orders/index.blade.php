@extends('layouts.' . auth()->user()->getRoleNames()->first() . 'Layout.layout')
@section('page')
<div class="container mt-5">
    <div class="row gap-2 align-items-center justify-content-center">
        @for ($i=0;$i<9;$i++)
        <div class="card order-card col-md-6">
            <div class="card-header">
                <h5 class="card-title">Order #12345</h5>
            </div>
            <div class="card-body">
                <!-- Order Information -->
                <p><strong>Customer:</strong> Muhammad Umer Farooq</p>
                <p><strong>Order Date:</strong> January 21, 2025</p>
                <p><strong>Status:</strong> <span class="badge bg-warning">Processing</span></p>

                <!-- Order Details -->
                <h6 class="mt-4">Order Details:</h6>
                <div class="order-item">
                    <p><strong>Product:</strong> Beautiful Portrait Painting</p>
                    <p><strong>Quantity:</strong> 1</p>
                    <p><strong>Price:</strong> 1200Rs</p>
                </div>

                <!-- Total Price -->
                <div class="order-summary mt-3">
                    <p><strong>Total Price:</strong> 1200Rs</p>
                </div>

                <!-- Actions -->
                <div class="d-flex justify-content-center gap-1 mt-4">
                    <a href="#" class="btn btn-primary">Mark as Completed</a>
                    <a href="#" class="btn btn-danger">Cancel Order</a>
                </div>
            </div>
        </div>
        @endfor
    </div>
</div>

@endsection
