<!-- Edit Post Modal -->
<div class="modal fade" id="editPostModal" tabindex="-1" aria-labelledby="editPostModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg rounded-3">
            <div class="modal-header bg-success">
                <h5 class="modal-title text-light" id="editPostModalLabel">
                    <i class="fas fa-pencil-alt text-warning me-2"></i>Edit Post
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editPostForm" method="POST" action="{{ route($role . '.blog.update', $blog->id) }}">
                @csrf
                @method('POST')
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label for="title" class="form-label fw-semibold">Post Title</label>
                        <input type="text" class="form-control" id="editTitle" name="title" placeholder="Enter the post title" value="{{ $blog->title }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label fw-semibold">Post Content</label>
                        <textarea class="form-control" id="editContent" name="content" rows="6" placeholder="Write your content here..." required>{{ $blog->content }}</textarea>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="submit" class="btn btn-warning px-4 py-2 rounded-3 shadow-sm">
                        <i class="fas fa-save me-2"></i>Update Post
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
