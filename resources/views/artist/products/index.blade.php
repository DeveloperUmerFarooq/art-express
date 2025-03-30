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
                        <div class="card product-card h-100 shadow-sm border-0 overflow-hidden">
                            <!-- Delete Button -->
                            <div class="position-absolute top-0 end-0 m-2 z-1">
                                <button class="btn btn-sm btn-danger p-1" onclick="deleteProduct('{{route('artist.product.delete',$product->id)}}')">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x">
                                        <path d="M18 6 6 18" />
                                        <path d="m6 6 12 12" />
                                    </svg>
                                </button>
                            </div>

                            <!-- Image Container -->
                            <div class="ratio ratio-4x3 bg-light">
                                <img loading="lazy" src="{{ asset($product->image->image_src) }}"
                                     class="object-fit-contain w-100 h-100"
                                     alt="{{ $product->name }}"
                                     style="background-color: var(--secondary);">
                            </div>

                            <!-- Card Body -->
                            <div class="card-body d-flex flex-column p-3">
                                <!-- Title and Artist -->
                                <div class="mb-2">
                                    <h5 class="card-title fs-6 fw-bold mb-1 text-truncate">{{ $product->name }}</h5>
                                    <p class="text-muted small mb-2">By: {{ $product->artist->name }}</p>
                                </div>

                                <!-- Description -->
                                <p class="card-text text-muted small mb-3 text-truncate text-wrap" style="max-height: 4.5em; overflow: hidden;">
                                    {{ $product->description }}
                                </p>

                                <!-- Price -->
                                <p class="fw-bold text-success mb-3">Price: {{ number_format($product->price) }}Rs</p>

                                <!-- Buttons -->
                                @if ($product->blog)
                                <div class="d-flex gap-2 mt-auto">
                                    <button class="btn btn-primary btn-sm flex-grow-1 py-1"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editProductModal"
                                            onclick="edit({{ $product }},'{{ asset($product->image->image_src) }}')">
                                        Edit
                                    </button>
                                    <a href="{{ route(auth()->user()->getRoleNames()->first() . '.blogs', $product->blog->id) }}"
                                       class="btn btn-outline-success btn-sm flex-grow-1 py-1">
                                        Read Blog
                                    </a>
                                </div>
                                @else
                                <button class="btn btn-primary btn-sm w-100 py-1"
                                        onclick="addPost({{$product->id}})"
                                        data-bs-toggle="modal"
                                        data-bs-target="#addPostModal">
                                    Add Blog
                                </button>
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
    <script src="{{ asset('js/productsCrud.js') }}"></script>
    <script src="{{ asset('js/products.js') }}"></script>
@endpush
