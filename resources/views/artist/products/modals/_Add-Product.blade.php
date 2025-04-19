<!-- Modal -->
<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow-lg border-0 rounded-4">
            <form id="productForm" action="{{route('artist.add')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header bg-success px-4 py-3 rounded-top">
                    <h5 class="modal-title fw-bold text-light" id="productModalLabel">
                        <i class="fas fa-plus-circle me-2 text-primary"></i> Add New Product
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-4 py-3">
                    <!-- Product Title -->
                    <div class="mb-3">
                        <label for="title" class="form-label fw-semibold">Product Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{old('title')}}">
                        @error('title')
                            <p class="ms-1 text-danger small">{{$message}}</p>
                        @enderror
                    </div>

                    <!-- Product Description -->
                    <div class="mb-3">
                        <label for="description" class="form-label fw-semibold">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3">{{old('description')}}</textarea>
                        @error('description')
                            <p class="ms-1 text-danger small">{{$message}}</p>
                        @enderror
                    </div>

                    <!-- Product Price -->
                    <div class="mb-3">
                        <label for="price" class="form-label fw-semibold">Price</label>
                        <input type="number" class="form-control" id="price" name="price" value="{{old('price')}}">
                        @error('price')
                            <p class="ms-1 text-danger small">{{$message}}</p>
                        @enderror
                    </div>

                    <!-- Image Input -->
                    <div class="mb-3">
                        <label for="image" class="form-label fw-semibold">Product Image</label>
                        <input type="file" class="form-control" id="price" name="image" required>
                        @error('image')
                            <p class="ms-1 text-danger small">{{$message}}</p>
                        @enderror
                    </div>

                    <!-- Add Blog Checkbox -->
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" id="addBlog" name="add_blog" checked>
                        <label class="form-check-label" for="addBlog">Add Blog</label>
                    </div>

                    <!-- Blog Content -->
                    <div class="mb-3 d-none" id="blogContent">
                        <label for="content" class="form-label fw-semibold">Blog Content</label>
                        <textarea class="form-control" id="content" name="content" rows="3">{{old('content')}}</textarea>
                        @error('content')
                            <p class="ms-1 text-danger small">{{$message}}</p>
                        @enderror
                    </div>

                    <!-- Category Select -->
                    <div class="mb-3">
                        <label for="category" class="form-label fw-semibold">Category</label>
                        <select class="form-select" id="category" name="category" required>
                            <option value="">Select a Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <p class="ms-1 text-danger small">{{$message}}</p>
                        @enderror
                    </div>

                    <!-- Subcategory Select -->
                    <div class="mb-3 d-none" id="subcategoryContainer">
                        <label for="subcategory" class="form-label fw-semibold">Subcategory</label>
                        <select class="form-select" id="subcategory" name="subcategory" required>
                            <option value="">Select a Subcategory</option>
                        </select>
                        @error('subcategory')
                            <p class="ms-1 text-danger small">{{$message}}</p>
                        @enderror
                    </div>
                </div>

                <div class="modal-footer px-4 pb-4 pt-2 border-0 d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i> Save Product
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
