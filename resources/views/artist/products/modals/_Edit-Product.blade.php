<!-- Modal -->
<div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editProductForm" action="{{route(auth()->user()->getRoleNames()->first().'.product.update')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="product-id" name="id">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Product Image -->
                    <center>
                        <div class="mb-3 text-center shadow w-50">
                            <!-- Display current product image if available -->
                            <img src="" id="productImage" width="200" class="img-fluid" alt="Product Image">
                        </div>
                    </center>

                    <!-- Image Input -->
                    <div class="mb-3">
                        <label for="image" class="form-label">Change Image</label>
                        <input type="file" class="form-control" id="image" name="image" onchange="preview(event)">
                    </div>

                    <!-- Product Title -->
                    <div class="mb-3">
                        <label for="title" class="form-label">Product Title</label>
                        <input type="text" class="form-control" id="product-title" name="title" value="{{ old('title') }}">
                        @error('title')
                            <p class="ms-1 text-danger">{{$message}}</p>
                        @enderror
                    </div>

                    <!-- Product Description -->
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="product-description" name="description" rows="3">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="ms-1 text-danger">{{$message}}</p>
                        @enderror
                    </div>

                    <!-- Product Price -->
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" class="form-control" id="product-price" name="price" value="{{ old('price') }}">
                        @error('price')
                            <p class="ms-1 text-danger">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                <center>
                    <button type="submit" class="btn btn-primary mb-3">Update Product</button>
                </center>
            </form>
        </div>
    </div>
</div>
