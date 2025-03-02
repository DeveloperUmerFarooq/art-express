@extends('layouts.' . auth()->user()->getRoleNames()->first() . 'Layout.layout')

@section('page')
    <div class="container mt-3 mb-3 mb-md-5">
        <form action="{{ route(auth()->user()->getRoleNames()->first() . '.search') }}" method="GET" class="d-flex gap-1">
            <input type="search" name="name" id="name" class="form-control" placeholder="search art-work...">
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
    </div>
    @foreach ($categories as $key => $category)
        <div class="caontainer-fluid px-md-5 px-2">
            <div class="d-flex flex-wrap align-items-center justify-content-between">
                <h1 class="product-title" style="color: var(--secondary);">{{ $category->name }}</h1>
                <div class="ms-auto d-flex gap-3 align-items-center">
                    <a class="browse"
                        href="{{ route(auth()->user()->getRoleNames()->first() . '.products', $category->id) }}">Browse
                        All</a>
                    <div class="d-flex gap-1">
                        <div id="prev-{{ $key }}" style="cursor: pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="#131010" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-arrow-big-left">
                                <path d="M18 15h-6v4l-7-7 7-7v4h6v6z" />
                            </svg>
                        </div>
                        <div id="next-{{ $key }}" style="cursor: pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="#131010" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-arrow-big-right">
                                <path d="M6 9h6V5l7 7-7 7v-4H6V9z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            @if (count($category->products) < 1)
            <div class="card shadow-sm mt-2 container" style="height: max-content !important">
                <div class="card-body text-center">
                    <h5 class="card-title">No Products Added</h5>
                    <p class="card-text">It looks like there are no products avaialable for the current subcategory!</p>
                </div>
            </div>
            @else
            <div class="owl-carousel slider-{{ $key }}">
                @foreach ($category->products as $product)
                    <div class="slider-card">
                        <center>
                            <div class="card mt-5 product-card position-relative">
                                <div class="image-container">
                                    <img src="{{ asset($product->image->image_src) }}"
                                        class="card-img-top object-fit-contain" alt="Portrait Painting">

                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <a
                                        href="{{ route(auth()->user()->getRoleNames()->first() . '.profile.view', $product->artist->id) }}">
                                        <p class="seller"><b>By:{{ $product->artist->name }}</b></p>
                                    </a>
                                    <p class="card-text" style="height: 75px; overflow: hidden; align-content:center">
                                        {{ $product->description }}</p>
                                    <p class="card-price text-success">Price: {{ $product->price }} Rs</p>
                                    <div class="d-flex justify-content-center gap-1">
                                        @can('buy art')
                                        @if (!auth()->user()->products()->where('id', $product->id)->exists())
                                        <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#buyProductModal" onclick="buy({{ $product }})">Buy
                                            Now</a>
                                        @endif
                                        @endcan
                                        @can('manage store')
                                            <button class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#editProductModal"
                                                onclick="edit({{ $product }},'{{ asset($product->image->image_src) }}')">Edit
                                                Product</button>
                                        @endcan
                                        <a href="{{ route(auth()->user()->getRoleNames()->first() . '.blogs', $product->id) }}"
                                            class="btn btn-outline-success">Read Blog</a>
                                        @can('manage store')
                                            <button class="btn btn-danger position-absolute top-0 end-0 m-1"
                                                onclick="deleteProduct('{{ route(auth()->user()->getRoleNames()->first() . '.product.delete', $product->id) }}')">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x">
                                                    <path d="M18 6 6 18" />
                                                    <path d="m6 6 12 12" />
                                                </svg></button>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                        </center>
                    </div>
                @endforeach
            </div>
            @endif
        </div>
    @endforeach
    @if (!auth()->user()->hasRole('user'))
        @include('artist.products.modals._Edit-Product')
    @endif
    @include('products.modals._buy-modal')
@endsection
@push('scripts')
    @if (!auth()->user()->hasRole('user'))
        <script src="{{ asset('assets/js/productsCrud.js') }}"></script>
        {{-- <script src="{{ asset('assets/js/products.js') }}"></script> --}}
    @endif
    @if (!auth()->user()->hasRole('admin'))
        <script src="{{ asset('assets/js/order.js') }}"></script>
    @endif
    <script>
        @foreach ($categories as $key => $category)
            const slider{{ $key }} = $(`.slider-{{ $key }}`).owlCarousel({
                mouseDrag: true,
                touchDrag: true,
                margin: 10,
                responsive: {
                    0: {
                        items: 1.2
                    },
                    600: {
                        items: 2
                    },
                    1000: {
                        items: 3
                    },
                    1300: {
                        items: 4
                    },
                    1600: {
                        items: 5
                    }
                }
            });

            $(`#prev-{{ $key }}`).click(function() {
                slider{{ $key }}.trigger('prev.owl.carousel');
            });
            $(`#next-{{ $key }}`).click(function() {
                slider{{ $key }}.trigger('next.owl.carousel');
            });
        @endforeach
    </script>
@endpush
