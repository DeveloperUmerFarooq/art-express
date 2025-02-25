@extends('layouts.' . auth()->user()->getRoleNames()->first() . 'Layout.layout')
@section('page')
<div class="container mt-3 mb-3 mb-md-5">
    <form action="{{route(auth()->user()->getRoleNames()->first().'.search')}}" method="GET" class="d-flex gap-1">
        <input type="search" name="name" id="name" class="form-control" placeholder="search art-work...">
        <button type="submit" class="btn btn-primary">Search</button>
    </form>
</div>

<div class="row mt-4 mx-2 align-items-center justify-content-center">
    @if (count($products)>0)
        @foreach ($products as $product)
            <div class="col-md-6 col-lg-3 mb-4">
                    <center>
                    <div class="card mt-5 product-card position-relative">
                        <div class="image-container">
                            <img src="{{ asset($product->image->image_src) }}" class="card-img-top object-fit-contain"
                                alt="Portrait Painting">
                            <div class="magnifier" id="magnifier"></div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{$product->name}}</h5>
                            <a href="{{route(auth()->user()->getRoleNames()->first().'.profile.view',$product->artist->id)}}">
                                <p class="seller"><b>By:{{$product->artist->name}}</b></p>
                            </a>
                            <p class="card-text" style="height: 75px; overflow: hidden; align-content:center">{{$product->description}}</p>
                            <p class="card-price">Price: {{$product->price}} Rs</p>
                            <div class="d-flex justify-content-center gap-1">
                            @can("buy art")
                            <a href="#" class="btn btn-primary"
                            data-bs-toggle="modal"
                            data-bs-target="#buyProductModal"
                            onclick="buy({{$product}})">Buy Now</a>
                            @endcan
                            @can("manage store")
                            <button class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#editProductModal"
                            onclick="edit({{ $product }},'{{ asset($product->image->image_src) }}')">Edit Product</button>
                            @endcan
                            <a href="{{route(auth()->user()->getRoleNames()->first().'.blogs',$product->id)}}" class="btn btn-outline-success">Read Blog</a>
                            @can("manage store")
                        <button class="btn btn-danger position-absolute top-0 end-0" onclick="deleteProduct()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-x">
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
    @else
    <div class="card shadow-sm mt-2 container" style="height: max-content !important">
        <div class="card-body text-center">
            <h5 class="card-title">No Products Added</h5>
            <p class="card-text">It looks like there are no products avaialable for the current subcategory!</p>
        </div>
    </div>
    @endif
    </div>
    @include('products.modals._buy-modal')
@endsection
@push('scripts')
@if (auth()->user()->hasRole('admin'))
<script src="{{ asset('assets/js/productsCrud.js') }}"></script>
{{-- <script src="{{ asset('assets/js/products.js') }}"></script> --}}
@endif
@if (!auth()->user()->hasRole('admin'))
<script src="{{asset('assets/js/order.js')}}"></script>
@endif
<script>
    $('#subId').on('change',function(){
        $('#filter').submit()
    })
</script>
@endpush
