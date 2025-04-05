@extends('layouts.' . auth()->user()->getRoleNames()->first() . 'Layout.layout')
@section('page')
    <div class="d-flex container mt-3">
        <h3>Manage Products</h3>
        <button class="btn btn-primary ms-auto" data-bs-toggle="modal" data-bs-target="#productModal">Add Product</button>
    </div>
    <div class="row mx-2 align-items-center justify-content-center">
        @if (count($products) > 0)
            @foreach ($products as $product)
                <div class="col-md-6 col-lg-3 mb-4">
                    <center>
                        <x-product-card :product="$product" />
                    </center>
                </div>
            @endforeach
        @else
            <!-- No Products Added Card -->
            <div class="card shadow-sm mt-2 container" style="height: max-content !important">
                <div class="card-body text-center">
                    <h5 class="card-title">No Products Added</h5>
                    <p class="card-text">It looks like you haven't added any products yet. Add your first product to get
                        started!</p>
                </div>
            </div>
        @endif
        <div class="d-flex ms-auto mt-4 justify-content-center">
            {{ $products->links() }}
        </div>
    </div>
    @include('artist.products.modals._Add-Product')
    @include('artist.products.modals._Edit-Product')
    @include('blogs.modals._Add-Post')
@endsection
@push('scripts')
    <script src="{{ asset('js/productsCrud.js') }}"></script>
    <script src="{{ asset('js/products.js') }}"></script>
@endpush
