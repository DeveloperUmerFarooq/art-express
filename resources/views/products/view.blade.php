@extends('layouts.' . auth()->user()->getRoleNames()->first() . 'Layout.layout')

@section('page')
<div class="container py-5">
    <div class="row">
        <!-- Product Image -->
        <div class="col-lg-6 mb-4">
            <div class="card h-auto">
                <img src="{{ asset($product->image->image_src) }}" alt="Artwork">
            </div>
        </div>

        <!-- Product Details -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">{{$product->name}}</h2>
                    <p class="text-muted mb-2">By: <strong>{{$product->artist->name}}</strong></p>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h3 class="text-success mb-0">{{$product->price}} Rs</h3>
                        <span class="badge bg-success">{{$product->status=="Unsold"?"In Stock":"Out Of Stock"}}</span>
                    </div>

                    <p class="card-text mb-4">
                        {{$product->description}}
                    </p>

                    <hr>

                    <!-- Shipping Form -->
                    <h5 class="mb-3">Shipping Information</h5>
                    <form class="mb-4">
                        <div class="mb-3">
                            <label class="form-label">Full Address</label>
                            <textarea class="form-control" name="address" rows="3" placeholder="Street, City, State, ZIP Code" required>{{old('address',auth()->user()->profile->address)}}</textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Phone Number</label>
                                <input type="tel" name="tel" class="form-control" placeholder="+1 (123) 456-7890" required value="{{old('tel',auth()->user()->profile->phone_number)}}">
                            </div>
                        </div>
                    </form>

                    <!-- Payment Methods -->
                    <h5 class="mb-3">Payment Method</h5>
                    <div class="mb-4">
                        <div class="form-check mb-3 border p-3 rounded">
                            <input class="form-check-input" type="radio" name="paymentMethod" id="cardPayment" checked>
                            <label class="form-check-label" for="cardPayment">
                                <strong>Credit/Debit Card</strong>
                            </label>
                        </div>

                        <div class="form-check border p-3 rounded">
                            <input class="form-check-input" type="radio" name="paymentMethod" id="codPayment">
                            <label class="form-check-label" for="codPayment">
                                <strong>Cash on Delivery</strong>
                            </label>
                        </div>
                    </div>

                    <!-- Buy Now Button -->
                    @can('buy art')
                    @if (!auth()->user()->products()->where('id', $product->id)->exists())
                    <button class="btn btn-primary btn-lg w-100 py-3">
                        Buy Now
                    </button>
                    @endif
                    @endcan
                    @if(auth()->user()->can('manage store')||auth()->user()->products()->where('id', $product->id)->exists())
                    <div class="d-flex gap-2">
                        <button class="btn btn-primary btn-lg w-100" data-bs-toggle="modal"
                            data-bs-target="#editProductModal"
                            onclick="edit({{ $product }},'{{ asset($product->image->image_src) }}')">Edit
                            Product</button>
                    </div>
                    @endif
                    <!-- Additional Info -->
                    <div class="mt-3">
                        <p class="small text-muted mb-1"><i class="bi bi-shield-check"></i> Secure payment</p>
                        <p class="small text-muted"><i class="bi bi-truck"></i> Free shipping</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@if (!auth()->user()->hasRole('user'))
    @include('artist.products.modals._Edit-Product')
@endif
@endsection
@push('scripts')
@if (!auth()->user()->hasRole('user'))
    <script src="{{ asset('js/productsCrud.js') }}"></script>
@endif
@endpush
