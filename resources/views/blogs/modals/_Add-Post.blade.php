<!-- Add Post Modal -->
<div class="modal fade" id="addPostModal" tabindex="-1" aria-labelledby="addPostModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0 shadow-lg rounded-3">
            <div class="modal-header bg-success">
                <h5 class="modal-title text-white" id="addPostModalLabel">
                    <i class="fas fa-plus-circle text-primary me-2"></i>Add New Post
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route($role . '.blog.add') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" id="productId">
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label for="content" class="form-label fw-semibold">Post Content</label>
                        <textarea name="content" id="content" class="form-control" rows="6" placeholder="Write your post content here..." required>{{ old('content') }}</textarea>
                    </div>
                    @error('content')
                    <p class="ms-1 text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary px-4 py-2 rounded-3 shadow-sm">
                        <i class="fas fa-save me-2"></i>Add Post
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
