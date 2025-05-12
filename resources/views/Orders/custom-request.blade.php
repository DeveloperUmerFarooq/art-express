@extends('layouts.' . $role . 'Layout.layout')

@section('page')
    <div class="container my-5">
        <h2 class="mb-4 fw-semibold text-dark">Add {{ $count }} Order Item{{ $count > 1 ? 's' : '' }}</h2>

        <form method="POST" action="{{ route('artist.custom.request.store') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="artist_id" value="{{ auth()->user()->id }}">
            <input type="hidden" name="customer_id" value="{{ $user->id }}">
            <input type="hidden" name="customer_email" value="{{ $user->email }}">
            <input type="hidden" name="artist_email" value="{{ auth()->user()->email }}">
            <div class="p-4 mb-4 border-2 rounded-3 bg-light">
                <h5 class="mb-3">Customer Data</h5>
                <div class="mb-3">
                    <label for="customer_address" class="form-label">Customer Address</label>
                    <input type="text" name="customer_address" class="form-control" id="customer_address" required
                        value="{{ old('customer_address', $user->profile->address) }}">
                        @error('customer_address')
                            <p class="text-danger ms-1">{{$message}}</p>
                        @enderror
                </div>
                <div class="mb-3">
                    <label for="customer_tel" class="form-label">Customer Phone Number</label>
                    <input type="text" name="customer_tel" class="form-control" id="customer_tel" required
                        value="{{ old('customer_tel', $user->profile->phone_number) }}">
                    @error('customer_tel')
                        <p class="text-danger ms-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="customer_email" class="form-label">Customer Email</label>
                    <input type="text" name="customer_email" class="form-control" id="customer_email" required
                        value="{{ old('customer_email', $user->email) }}">
                    @error('customer_email')
                        <p class="text-danger ms-1">{{$message}}</p>
                    @enderror
                </div>

            </div>
            @for ($i = 0; $i < $count; $i++)
                <div class="p-4 mb-4 border-2 rounded-3 bg-light">
                    <h5 class="mb-3">Item #{{ $i + 1 }}</h5>

                    <!-- Item Name -->
                    <div class="mb-3">
                        <label for="item_name_{{ $i }}" class="form-label">Item Name</label>
                        <input type="text" name="items[{{ $i }}][item_name]"
                            class="form-control @error("items.$i.item_name") is-invalid @enderror"
                            id="item_name_{{ $i }}" value="{{ old("items.$i.item_name") }}" required>
                        @error("items.$i.item_name")
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Image Upload -->
                    <div class="mb-3">
                        <label for="img_src_{{ $i }}" class="form-label">Item Image</label>
                        <input type="file" name="items[{{ $i }}][img_src]"
                            class="form-control @error("items.$i.img_src") is-invalid @enderror"
                            id="img_src_{{ $i }}" accept="image/*" required>
                        @error("items.$i.img_src")
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Quantity -->
                    <div class="mb-3">
                        <label for="quantity_{{ $i }}" class="form-label">Quantity</label>
                        <input type="number" name="items[{{ $i }}][quantity]"
                            class="form-control @error("items.$i.quantity") is-invalid @enderror"
                            id="quantity_{{ $i }}" value="{{ old("items.$i.quantity") }}" min="1"
                            required>
                        @error("items.$i.quantity")
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Price -->
                    <div class="mb-2">
                        <label for="price_{{ $i }}" class="form-label">Price</label>
                        <input type="number" name="items[{{ $i }}][price]"
                            class="form-control @error("items.$i.price") is-invalid @enderror"
                            id="price_{{ $i }}" value="{{ old("items.$i.price") }}" step="0.01"
                            min="0" required>
                        @error("items.$i.price")
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            @endfor


            <div class="text-center">
                <button type="submit" class="btn btn-primary px-4 py-2">Submit All</button>
            </div>
        </form>
    </div>
@endsection
