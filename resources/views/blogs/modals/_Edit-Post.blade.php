<!-- Edit Post Modal -->
<div class="modal fade" id="editPostModal" tabindex="-1" aria-labelledby="editPostModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPostModalLabel">Edit Post</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editPostForm" method="POST" action="{{route(auth()->user()->getRoleNames()->first().'.blog.update',$blog->id)}}">
                @csrf
                @method('POST')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="editTitle" name="title" placeholder="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Content</label>
                        <textarea class="form-control" id="editContent" name="content" rows="4" placeholder="content" required></textarea>
                    </div>
                </div>
                <center>
                    <button type="submit" class="btn btn-primary mb-3">Update Post</button>
                </center>
            </form>
        </div>
    </div>
</div>
