@extends('layouts.' . auth()->user()->getRoleNames()->first() . 'Layout.layout')
@section('page')
    <div class="container mt-3 mb-3 mb-md-5">
        <form action="{{ route(auth()->user()->getRoleNames()->first() . '.search') }}" method="GET" class="d-flex gap-1">
            <input type="search" name="name" id="name" class="form-control" placeholder="search art-work...">
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
    </div>
    <div class="px-2">
        <h1 class="mt-3 mx-2">{{ $category->name }}</h1>
        <div class="d-flex gap-2 flex-wrap mx-2">
            <h5>Browse by Subcategory</h5>
            <h7><a class="ms-md-3" href="">ask AI about current subcategory</a></h7>
            <form class="mt-1 mt-sm-0 ms-auto" method="GET" action="{{ route(auth()->user()->getRoleNames()->first() . '.filter', $category->id) }}"
                id="filter" class="d-flex flex-wrap ms-auto gap-2">
                <div class="list-group">
                    <select name="subcategory" id="subId" class="form-select">
                        @foreach ($subCategories as $subcategory)
                            <option value="{{ $subcategory->id }}"
                                @isset($subId)
                        @if ($subcategory->id == $subId) selected @endif
                    @endisset>
                                {{ $subcategory->name }}</option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>
    </div>

    <div class="row mt-4 mx-2 align-items-center justify-content-center">
        @if (count($products) > 0)
            @foreach ($products as $product)
                <div class="col-md-6 col-lg-3 mb-4">
                    <center>
                        <x-product-card :product="$product" />
                    </center>
                </div>
            @endforeach
        @else
            <div class="card shadow-sm mt-2 container" style="height: max-content !important">
                <div class="card-body text-center">
                    <h5 class="card-title">No Products Added</h5>
                    <p class="card-text">It looks like there are no products avaialable for the current subcategory!</p>
                </div>
            </div>
        @endif
    </div>
    @if (!auth()->user()->hasRole('user'))
        @include('artist.products.modals._Edit-Product')
    @endif
    @include('products.modals._buy-modal')
@endsection
@if (!auth()->user()->hasRole('user'))
    @include('artist.products.modals._Edit-Product')
@endif
@push('scripts')
    @if (auth()->user()->hasRole('admin'))
        <script src="{{ asset('assets/js/productsCrud.js') }}"></script>
        {{-- <script src="{{ asset('assets/js/products.js') }}"></script> --}}
    @endif
    @if (!auth()->user()->hasRole('admin'))
        <script src="{{ asset('assets/js/order.js') }}"></script>
    @endif
    <script>
        $('#subId').on('change', function() {
            $('#filter').submit()
        })
    </script>
@endpush
