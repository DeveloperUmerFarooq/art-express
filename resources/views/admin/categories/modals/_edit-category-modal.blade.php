<div class="modal fade" id="Edit-Category" tabindex="-1" aria-labelledby="Edit-Category" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header bg-success border-none outline-none d-flex justify-between">
                <h5 class="modal-title fw-semibold text-light" id="Label">
                    <i class="fas fa-edit text-warning me-2"></i> Edit Category
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.management.catergory.update') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <input type="hidden" id="category-id" name="id">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" id="name" name="name" class="form-control shadow validate"
                            placeholder="Name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @error('name')
                            <p class="text-danger mx-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-center mt-2">
                        <button type="submit" class="btn btn-warning px-4 py-2">
                            <i class="fas fa-save me-2"></i> Update Category
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
