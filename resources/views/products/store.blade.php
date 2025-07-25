@extends('layouts.' . $role . 'Layout.layout')
@section('title')
    {{$role==="admin"?"Products":"Store"}} | Art-Express
@endsection
@section('page')
    <div class="container mt-3 mb-3 mb-md-5">
        <form action="{{ route($role . '.search') }}" method="GET" class="d-flex gap-1">
            <input type="search" name="name" id="name" class="form-control" placeholder="search art-work...">
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
    </div>
    @foreach ($categories as $key => $category)
        <div class="caontainer-fluid px-md-5 px-2">
            <div class="d-flex flex-wrap align-items-center justify-content-between">
                <h1 class="product-title fs-1" style="color: var(--secondary);">{{ $category->name }}</h1>
                <div class="ms-auto d-flex gap-3 align-items-center">
                    <a class="browse"
                        href="{{ route($role . '.products', $category->id) }}">Browse
                        All</a>
                    <div class="d-none d-md-flex gap-1">
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
                    <p class="card-text">It looks like there are no products avaialable for the current category!</p>
                </div>
            </div>
            @else
            <div class="owl-carousel slider-{{ $key }}">
                @foreach ($category->products()->latest()->take(10)->get() as $product)
                    <div class="slider-card my-3">
                        <center>
                            <x-product-card :product="$product" />
                        </center>
                    </div>
                @endforeach
            </div>
            @endif
        </div>
    @endforeach
@endsection
@push('scripts')
    @if (!auth()->user()->hasRole('user'))
        <script src="{{ asset('js/productsCrud.js') }}"></script>
        {{-- <script src="{{ asset('js/products.js') }}"></script> --}}
    @endif
    @if (!auth()->user()->hasRole('admin'))
        <script src="{{ asset('js/order.js') }}"></script>
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
