
<!-- Add Post Modal -->
<div class="modal fade" id="addPostModal" tabindex="-1" aria-labelledby="addPostModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addPostModalLabel">Add New Post</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route(auth()->user()->getRoleNames()->first().'.blog.add') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="id" id="productId">
          <div class="modal-body">
            <div class="mb-3">
              <label for="content" class="form-label">Content</label>
              <textarea name="content" id="content" class="form-control" rows="4" placeholder="Write your post content here" required>{{old('content')}}</textarea>
            </div>
            @error('content')
            <p class="ms-1 text-danger">{{$message}}</p>
            @enderror
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Add Post</button>
          </div>
        </form>
      </div>
    </div>
  </div>
