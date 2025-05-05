@extends('layouts.' . $role . 'Layout.layout')

@section('page')
<div class="container my-5">
    <h2 class="mb-4 fw-semibold text-dark">Add {{ $count }} Order Item{{ $count > 1 ? 's' : '' }}</h2>

    <form method="POST" action="" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="artist_id" value="{{ auth()->user()->id }}">
        <input type="hidden" name="customer_id" value="{{ $id }}">

        @for ($i = 0; $i < $count; $i++)
            <div class="p-4 mb-4 border border-2 rounded-3 bg-light">
                <h5 class="mb-3">Item #{{ $i + 1 }}</h5>

                <!-- Item Name -->
                <div class="mb-3">
                    <label for="item_name_{{ $i }}" class="form-label">Item Name</label>
                    <input type="text" name="items[{{ $i }}][item_name]" class="form-control" id="item_name_{{ $i }}" required>
                </div>

                <!-- Image Upload -->
                <div class="mb-3">
                    <label for="img_src_{{ $i }}" class="form-label">Item Image</label>
                    <input type="file" name="items[{{ $i }}][img_src]" class="form-control" id="img_src_{{ $i }}" accept="image/*" required>
                </div>

                <!-- Quantity -->
                <div class="mb-3">
                    <label for="quantity_{{ $i }}" class="form-label">Quantity</label>
                    <input type="number" name="items[{{ $i }}][quantity]" class="form-control" id="quantity_{{ $i }}" min="1" required>
                </div>

                <!-- Price -->
                <div class="mb-2">
                    <label for="price_{{ $i }}" class="form-label">Price</label>
                    <input type="number" name="items[{{ $i }}][price]" class="form-control" id="price_{{ $i }}" step="0.01" min="0" required>
                </div>
            </div>
        @endfor

        <div class="text-center">
            <button type="submit" class="btn btn-primary px-4 py-2">Submit All</button>
        </div>
    </form>
</div>
@endsection
