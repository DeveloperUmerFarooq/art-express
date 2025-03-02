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
                        <div class="card mt-5 product-card position-relative">
                            <div class="position-absolute top-0 end-0 m-1">
                                <button class="btn btn-danger" onclick="deleteProduct('{{route('artist.product.delete',$product->id)}}')">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                        height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-x">
                                        <path d="M18 6 6 18" />
                                        <path d="m6 6 12 12" />
                                    </svg></button>
                            </div>
                            <div class="image-container">
                                <img src="{{ asset($product->image->image_src) }}" class="card-img-top object-fit-contain"
                                    alt="Portrait Painting">

                            </div>
                            <div class="card-body d-flex flex-column gap-0">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="seller"><b>By: {{ $product->artist->name }}</b></p>
                                <p class="card-text text-justify" style="height: 75px; overflow: hidden;">
                                    {{ $product->description }}</p>
                                <p class="card-price text-success">Price: {{ $product->price }} Rs</p>
                                @if ($product->blog)
                                <div class="d-flex justify-content-center gap-1 mt-auto">
                                    <button class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#editProductModal"
                                    onclick="edit({{ $product }},'{{ asset($product->image->image_src) }}')">Edit Product</button>
                                    <a href="{{ route(auth()->user()->getRoleNames()->first() . '.blogs', $product->blog->id) }}"
                                        class="btn btn-outline-success">Read Blog</a>
                                </div>
                                @else
                                <button class="btn btn-primary" onclick="addPost({{$product->id}})"  data-bs-toggle="modal" data-bs-target="#addPostModal">Add Blog</button>
                                @endif
                            </div>
                        </div>
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
    <script src="{{ asset('assets/js/productsCrud.js') }}"></script>
    <script src="{{ asset('assets/js/products.js') }}"></script>
@endpush
