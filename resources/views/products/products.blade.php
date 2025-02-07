@extends('layouts.' . auth()->user()->getRoleNames()->first() . 'Layout.layout')
@section('page')
<div class="container mt-3 mb-3 mb-md-5">
    <form action="" class="d-flex gap-1">
        <input type="search" class="form-control" placeholder="search art-work...">
        <button type="submit" class="btn btn-primary">Search</button>
    </form>
</div>
<div class="px-2">
    <h1 class="mt-3 mx-2">{{ $category->name }}</h1>
    <div class="d-flex flex-wrap mx-2">
        <h5>Browse by Subcategory</h5>
        <h7><a class="ms-3" href="">ask AI about current subcategory</a></h7>
        <form method="GET" action="" class="d-flex flex-wrap ms-auto gap-2">
            <div class="list-group">
                <select name="subcategories[]" class="form-select">
                    @foreach ($subCategories as $subcategory)
                    @if (count($subcategory->products)>0)
                    <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                    @endif
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Apply Filter</button>
        </form>
    </div>
</div>

    <div class="row mt-4 mx-2 align-items-center justify-content-center">

        @foreach ($category->products as $product)
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
                            <p class="seller"><b>By:{{$product->artist->name}}</b></p>
                            <p class="card-text" style="height: 75px; overflow: hidden; align-content:center">{{$product->description}}</p>
                            <p class="card-price">Price: {{$product->price}} Rs</p>
                            <div class="d-flex justify-content-center gap-1">
                            @can("buy art")
                            <a href="#" class="btn btn-primary">Buy Now</a>
                            @endcan
                            @can("manage store")
                            <button class="btn btn-primary">Edit Product</button>
                            @endcan
                            <a href="{{route(auth()->user()->getRoleNames()->first().'.blogs',$product->id)}}" class="btn btn-outline-success">Read Blog</a>
                            @can("manage store")
                            {{-- <button class="btn btn-dark opacity-50" data-bs-toggle="modal"
                            data-bs-target="#editProductModal"
                            onclick="edit({{ $product }},'{{ asset($product->image->image_src) }}')"></button> --}}
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
    </div>
@endsection
@push('scripts')
@endpush
