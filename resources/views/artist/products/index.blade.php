@extends('layouts.' . $role . 'Layout.layout')
@section('title')
    Products | Art-Express
@endsection
@section('page')
    <div class="container-fluid mt-4">

        <!-- Page Header -->
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h3 class="fw-bold">
                <i class="fas fa-box-open me-2"></i>Manage Products
            </h3>
            <button class="btn btn-success btn-sm shadow-sm px-4 py-2" data-bs-toggle="modal" data-bs-target="#productModal">
                <i class="fas fa-plus me-1"></i>Add Product
            </button>
        </div>

        <!-- Product List -->
        <div class="row gx-4 gy-4">
            @if (count($products) > 0)
                @foreach ($products as $product)
                    <div class="col-md-6 col-lg-3">
                        <x-product-card :product="$product" />
                    </div>
                @endforeach
            @else
                <!-- No Products Card -->
                <div class="col-12">
                    <div class="card border-0 shadow-sm text-center py-5">
                        <div class="card-body">
                            <h4 class="text-muted">
                                <i class="fas fa-boxes text-secondary fa-2x mb-3"></i><br>
                                No Products Added
                            </h4>
                            <p class="text-muted mb-0">It looks like you haven't added any products yet.</p>
                            <p class="text-muted">Click on "Add Product" to get started!</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $products->links() }}
        </div>
    </div>

    <!-- Modals -->
    @include('artist.products.modals._Add-Product')
    @include('artist.products.modals._Edit-Product')
    @include('blogs.modals._Add-Post')
@endsection

@push('scripts')
    <script src="{{ asset('js/productsCrud.js') }}"></script>
    <script src="{{ asset('js/products.js') }}"></script>
@endpush
