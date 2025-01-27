<!-- Modal -->
<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="productForm" action="{{route('artist.add')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="productModalLabel">Add Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Product Title -->
                    <div class="mb-3">
                        <label for="title" class="form-label">Product Title</label>
                        <input type="text" class="form-control" id="title" name="title"  value="{{old('title')}}">
                        @error('title')
                            <p class="ms-1 text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <!-- Product Description -->
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" >{{old('description')}}</textarea>
                        @error('description')
                            <p class="ms-1 text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <!-- Product Price -->
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" class="form-control" id="price" name="price"  value="{{old('price')}}">
                        @error('price')
                            <p class="ms-1 text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <!-- Image Input -->
                    <div class="mb-3">
                        <input type="file" class="form-control" id="price" name="image" >
                    </div>
                    <!-- Add Blog Checkbox -->
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="addBlog" name="add_blog" checked>
                        <label class="form-check-label" for="addBlog">Add Blog</label>
                    </div>
                    <!-- Blog Content -->
                    <div class="mb-3 d-none" id="blogContent">
                        <label for="content" class="form-label">Blog Content</label>
                        <textarea class="form-control" id="content" name="content" rows="3">{{old('content')}}</textarea>
                        @error('content')
                            <p class="ms-1 text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <!-- Category Select -->
                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <select class="form-select" id="category" name="category" required>
                            <option value="">Select a Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <p class="ms-1 text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <!-- Subcategory Select -->
                    <div class="mb-3 d-none" id="subcategoryContainer">
                        <label for="subcategory" class="form-label">Subcategory</label>
                        <select class="form-select" id="subcategory" name="subcategory" required>
                            <option value="">Select a Subcategory</option>
                        </select>
                        @error('subcategory')
                            <p class="ms-1 text-danger">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                   <center>
                       <button type="submit" class="btn btn-primary mb-3">Save Product</button>
                   </center>
            </form>
        </div>
    </div>
</div>
