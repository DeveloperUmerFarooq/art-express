@extends('layouts.' . $role . 'Layout.layout')
@section('title')
    Product Search | Art-Express
@endsection
@section('page')
<div class="container mt-3 mb-3 mb-md-5">
    <form action="{{route($role.'.search')}}" method="GET" class="d-flex gap-1">
        <input type="search" name="name" id="name" class="form-control" placeholder="search art-work...">
        <button type="submit" class="btn btn-primary">Search</button>
    </form>
</div>

<div class="row mt-4 mx-2 align-items-center justify-content-center">
    @if (count($products)>0)
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
@endsection
@push('scripts')
@if (auth()->user()->hasRole('admin'))
<script src="{{ asset('js/productsCrud.js') }}"></script>
{{-- <script src="{{ asset('js/products.js') }}"></script> --}}
@endif
@if (!auth()->user()->hasRole('admin'))
<script src="{{asset('js/order.js')}}"></script>
@endif
<script>
    $('#subId').on('change',function(){
        $('#filter').submit()
    })
</script>
@endpush
