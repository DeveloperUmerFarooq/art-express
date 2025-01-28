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
                            <div class="d-flex gap-1 position-absolute top-0 end-0">
                                <button class="btn btn-dark opacity-50" data-bs-toggle="modal"
                                    data-bs-target="#editProductModal"
                                    onclick="edit({{ $product }},'{{ asset($product->image->image_src) }}')"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="lucide lucide-file-pen-line">
                                        <path
                                            d="m18 5-2.414-2.414A2 2 0 0 0 14.172 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2" />
                                        <path
                                            d="M21.378 12.626a1 1 0 0 0-3.004-3.004l-4.01 4.012a2 2 0 0 0-.506.854l-.837 2.87a.5.5 0 0 0 .62.62l2.87-.837a2 2 0 0 0 .854-.506z" />
                                        <path d="M8 18h1" />
                                    </svg></button>

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
                                <div class="magnifier" id="magnifier"></div>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="seller"><b>By: {{ $product->artist->name }}</b></p>
                                <p class="card-text">{{ $product->description }}</p>
                                <p class="card-price">Price: {{ $product->price }} Rs</p>
                                @if ($product->blog)
                                <div class="d-flex justify-content-center gap-1 mt-auto">
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
