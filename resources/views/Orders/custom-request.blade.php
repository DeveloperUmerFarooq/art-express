@extends('layouts.' . $role . 'Layout.layout')

@section('page')
<div class="container my-1 my-md-3 my-lg-5">
    <h2>Add {{ $count }} Order Items</h2>
    <form method="POST" action="" enctype="multipart/form-data">
        <input type="hidden" name="artist_id" value="{{auth()->user()->id}}">
        <input type="hidden" name="customer_id" value="{{$id}}">
        @csrf
        @for ($i = 0; $i < $count; $i++)
            <div class="card mb-3">
                <div class="card-body">
                    <h5>Item #{{ $i + 1 }}</h5>

                    <!-- Item Name -->
                    <div class="mb-2">
                        <label for="item_name_{{ $i }}">Item Name:</label>
                        <input type="text" name="items[{{ $i }}][item_name]" class="form-control" id="item_name_{{ $i }}" required>
                    </div>

                    <!-- Image Upload -->
                    <div class="mb-2">
                        <label for="img_src_{{ $i }}">Item Image:</label>
                        <input type="file" name="items[{{ $i }}][img_src]" class="form-control" id="img_src_{{ $i }}" accept="image/*" required>
                    </div>

                    <!-- Quantity -->
                    <div class="mb-2">
                        <label for="quantity_{{ $i }}">Quantity:</label>
                        <input type="number" name="items[{{ $i }}][quantity]" class="form-control" id="quantity_{{ $i }}" min="1" required>
                    </div>

                    <!-- Price -->
                    <div class="mb-2">
                        <label for="price_{{ $i }}">Price:</label>
                        <input type="number" name="items[{{ $i }}][price]" class="form-control" id="price_{{ $i }}" step="0.01" min="0" required>
                    </div>
                </div>
            </div>
        @endfor

        <button type="submit" class="btn btn-primary">Submit All</button>
    </form>

  </div>

@endsection
