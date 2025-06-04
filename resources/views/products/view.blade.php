@extends('layouts.' . $role . 'Layout.layout')
@section('title')
    Product View | Art-Express
@endsection
@section('page')
    @php
        $sellable = $product->status == 'Unsold' ? true : false;
    @endphp
    <div id="product-page">
        <div class="container py-5">
            <div class="row">
                <!-- Product Image -->
                <div class="col-lg-6 mb-4">
                    <div class="card h-auto rounded-0">
                        <img style="border: 10px solid white" src="{{ asset($product->image->image_src) }}" alt="Artwork">
                    </div>
                </div>

                <!-- Product Details -->
                <div class="col-lg-6">
                    <div class="card border-0">
                        <div class="card-body">
                            <h2 class="card-title">{{ $product->name }}</h2>
                            <p class="text-muted mb-2">By: <strong>{{ $product->artist->name }}</strong></p>

                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h3 class="text-success mb-0">{{ $product->price }} Rs</h3>
                                <span
                                    class="badge {{ $sellable ? 'bg-success' : 'bg-danger' }}">{{ $sellable ? 'In Stock' : 'Out Of Stock' }}</span>
                            </div>

                            <p class="card-text mb-4">
                                {{ $product->description }}
                            </p>

                            <hr>

                            <!-- Shipping Form -->
                            @can('buy art')
                                <h5 class="mb-3">Shipping Information</h5>
                                <form class="mb-4" action="{{ route('order.store') }}" method="POST"
                                    @if (!$sellable) onsubmit="event.preventDefault()" @endif
                                    id="checkout-form">
                                    @csrf
                                    <input type="hidden" name="customer_id" value="{{ auth()->user()->id }}">
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="total_amount" value="{{ $product->price + 250 }}">
                                    <input type="hidden" name="artist_id" value="{{ $product->artist->id }}">
                                    <div class="mb-3">
                                        <label class="form-label">Full Address</label>
                                        <textarea @if (!$sellable) disabled @endif class="form-control validate" name="address" rows="3"
                                            placeholder="Street, City, State, ZIP Code" required @if (auth()->user()->products()->where('id', $product->id)->exists()) disabled @endif>{{ old('address', auth()->user()->profile->address) }}</textarea>
                                    </div>
                                    @error('address')
                                        <p class="ms-1 text-danger">{{ $message }}</p>
                                    @enderror
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Phone Number</label>
                                            <input @if (!$sellable) disabled @endif type="tel"
                                                name="tel" class="form-control validate" placeholder="+1 (123) 456-7890"
                                                required @if (auth()->user()->products()->where('id', $product->id)->exists()) disabled @endif
                                                value="{{ old('tel', auth()->user()->profile->phone_number) }}">
                                            @error('tel')
                                                <p class="ms-1 text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Email</label>
                                            <input @if (!$sellable) disabled @endif type="email"
                                                name="customer_email" class="form-control validate"
                                                placeholder="customer@gmail.com" required
                                                value="{{ old('customer_email', auth()->user()->email) }}"
                                                @if (auth()->user()->products()->where('id', $product->id)->exists()) disabled @endif>
                                            @error('customer_email')
                                                <p class="ms-1 text-danger">{{ $message }}</p>
                                            @enderror
                                            <input type="hidden" name="stripeToken" id="stripe-token">
                                        </div>
                                    </div>
                                    <div class="d-none" id="card-input">
                                        <label class="form-label">Card Details</label>
                                        <div id="card-element" class="form-control py-2 mb-3"></div>
                                    </div>
                                    <!-- Payment Methods -->
                                    <h5 class="mb-3">Payment Method</h5>
                                    <div class="mb-4">
                                        <div class="form-check mb-3 border p-3 rounded">
                                            <input @if (!$sellable) disabled @endif
                                                @if (auth()->user()->products()->where('id', $product->id)->exists()) disabled @endif class="form-check-input"
                                                value="card" type="radio" name="paymentMethod" id="cardPayment">
                                            <label class="form-check-label" for="cardPayment">
                                                <strong>Credit/Debit Card</strong>
                                            </label>
                                        </div>

                                        <div class="form-check border p-3 rounded">
                                            <input @if (!$sellable) disabled @endif
                                                @if (auth()->user()->products()->where('id', $product->id)->exists()) disabled @endif class="form-check-input"
                                                value="cod" type="radio" name="paymentMethod" id="codPayment">
                                            <label class="form-check-label" for="codPayment">
                                                <strong>Cash on Delivery</strong>
                                            </label>
                                        </div>
                                        @error('paymentMethod')
                                            <p class="ms-1 text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="d-flex gap-3">
                                        <h3>Delivery Charges:</h3>
                                        <h3 class="text-danger mb-0">250 Rs</h3>
                                    </div>
                                    <!-- Buy Now Button -->
                                </form>
                            @endcan
                            @can('buy art')
                                @if (!auth()->user()->products()->where('id', $product->id)->exists())
                                    @if ($sellable)
                                        <button class="btn btn-primary btn-lg w-100 py-3" onclick="createToken()">
                                            Buy Now
                                        </button>
                                    @else
                                        <button class="btn btn-danger btn-lg w-100 py-3">
                                            Sold
                                        </button>
                                    @endif
                                @endif
                            @endcan

                            @if (auth()->user()->can('manage store') ||
                                    (auth()->user()->products()->where('id', $product->id)->exists() && auth()->user()->can('edit art')))
                                @if ($product->status==="unsold")
                                <div class="d-flex gap-2">
                                    <button class="btn btn-primary btn-lg w-100" data-bs-toggle="modal"
                                        data-bs-target="#editProductModal"
                                        onclick="edit({{ $product }},'{{ asset($product->image->image_src) }}')">Edit
                                        Product</button>
                                </div>
                                @endif
                            @endif
                            <!-- Additional Info -->
                            <div class="mt-3">
                                <p class="small text-muted mb-1 bg-success d-inline rounded-pill p-2 "><i
                                        class="fa-solid fa-shield-halved text-light"></i> <span class="text-light">Secure payment</span></p>
                            </div>
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
    <script src="{{ asset('js/checkout.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const cardPaymentRadio = document.getElementById('cardPayment');
            const codPaymentRadio = document.getElementById('codPayment');
            const cardElement = document.getElementById('card-input');

            function toggleCardElement() {
                if (cardPaymentRadio.checked) {
                    cardElement.classList.remove('d-none');
                } else {
                    cardElement.classList.add('d-none');
                }
            }
            cardPaymentRadio.addEventListener('change', toggleCardElement);
            codPaymentRadio.addEventListener('change', toggleCardElement);
        });
    </script>

@endpush
