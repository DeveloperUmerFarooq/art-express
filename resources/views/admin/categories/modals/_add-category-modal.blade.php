<div class="modal fade" id="Add-Category" tabindex="-1" aria-labelledby="AddCategoryLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-success">
                <h5 class="modal-title fw-semibold text-light" id="AddCategoryLabel">
                    <i class="fas fa-folder-plus me-2 text-light"></i> Add Category
                </h5>
                <button type="button" class="btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form action="{{ route('admin.management.catergory.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="category-name" class="form-label fw-semibold">Category Name</label>
                        <input type="text" name="name" id="category-name" class="form-control validate validate @error('name') is-invalid @enderror" placeholder="e.g. Abstract Art" value="{{ old('name') }}" required autofocus>
                        @error('name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="sub-category-count" class="form-label fw-semibold">Number of Subcategories <span class="text-muted">(Optional)</span></label>
                        <input type="number" name="count" id="sub-category-count" class="form-control validate validate shadow-sm" placeholder="e.g. 3" min="0">
                        <small class="text-muted">Leave blank if no subcategories are needed.</small>
                    </div>

                    <div id="subcategory">
                        @error('subcategories')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-check-circle me-1"></i> Add Category
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
