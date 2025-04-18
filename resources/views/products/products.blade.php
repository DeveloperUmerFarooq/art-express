@extends('layouts.' . $role . 'Layout.layout')
@section('page')
    <div class="container mt-3 mb-3 mb-md-5">
        <form action="{{ route($role . '.search') }}" method="GET" class="d-flex gap-1">
            <input type="search" name="name" id="name" class="form-control" placeholder="search art-work...">
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
    </div>
    <div class="px-2">
        <h1 class="mt-3 mx-2">{{ $category->name }}</h1>
        <div class="d-flex gap-2 flex-wrap mx-2">
            <h7><a class="ms-1" href="">Ask AI about current category</a></h7>
            <form class="mt-1 mt-sm-0 ms-auto" method="GET" action="{{ route($role . '.filter', $category->id) }}"
                id="filter" class="d-flex flex-wrap ms-auto gap-2">
                <div class="list-group">
                    <select name="subcategory" id="subId" class="form-select">
                        <option value="">--Select a category--</option>
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
        <script src="{{ asset('js/productsCrud.js') }}"></script>
        {{-- <script src="{{ asset('js/products.js') }}"></script> --}}
    @endif
    @if (!auth()->user()->hasRole('admin'))
        <script src="{{ asset('js/order.js') }}"></script>
    @endif
    <script>
        $('#subId').on('change', function() {
            $('#filter').submit()
        })
    </script>
@endpush
