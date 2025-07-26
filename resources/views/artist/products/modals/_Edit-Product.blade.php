<!-- Modal -->
<div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content rounded-3 shadow-sm border-0">
            <form id="editProductForm" action="{{route($role.'.product.update')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="product-id" name="id">

                <!-- Modal Header -->
                <div class="modal-header bg-success px-4 py-3">
                    <h5 class="modal-title text-light" id="editProductModalLabel">
                        <i class="fas fa-edit me-2 text-warning"></i>Edit Product
                    </h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body px-4 py-4">

                    <!-- Product Image -->
                    <div class="mb-4 text-center">
                        <div class="shadow-sm border rounded-3 p-2 d-inline-block">
                            <img loading="lazy" src="" id="productImage" width="200" class="img-fluid rounded" alt="Product Image">
                        </div>
                    </div>

                    <!-- Image Input -->
                    <div class="mb-3">
                        <label for="image" class="form-label fw-semibold">Change Image</label>
                        <input type="file" data-target="#productImage" class="form-control" id="image" name="image" onchange="preview(event)">
                    </div>

                    <!-- Product Title -->
                    <div class="mb-3">
                        <label for="title" class="form-label fw-semibold">Product Title</label>
                        <input type="text" class="form-control" id="product-title" name="title" value="{{ old('title') }}">
                        @error('title')
                            <p class="ms-1 text-danger small">{{$message}}</p>
                        @enderror
                    </div>

                    <!-- Product Description -->
                    <div class="mb-3">
                        <label for="description" class="form-label fw-semibold">Description</label>
                        <textarea class="form-control" id="product-description" name="description" rows="3">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="ms-1 text-danger small">{{$message}}</p>
                        @enderror
                    </div>

                    <!-- Product Price -->
                    <div class="mb-3">
                        <label for="price" class="form-label fw-semibold">Price</label>
                        <input type="number" class="form-control" id="product-price" name="price" value="{{ old('price') }}">
                        @error('price')
                            <p class="ms-1 text-danger small">{{$message}}</p>
                        @enderror
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer px-4 py-3 justify-content-center">
                    <button type="submit" class="btn btn-warning px-4 py-2 fw-semibold">
                        <i class="fas fa-save me-2"></i>Update Product
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
