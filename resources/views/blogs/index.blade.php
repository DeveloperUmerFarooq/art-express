@extends('layouts.' . $role . 'Layout.layout')
@section('title')
    Product Blog | Art-Express
@endsection
@section('page')
    <div class="container my-5">

        <!-- Image Section -->
        <div class="text-center mb-4">
            <img loading="lazy" src="{{ asset($blog->product->image->image_src) }}" alt="Beautiful Artwork"
                class="img-fluid rounded" style="object-fit: contain; height: 30em; aspect-ratio: 1/1;" />
        </div>

        <!-- Blog Title and Info -->
        <div class="text-center mb-4">
            <h1 class="h3 font-weight-bold text-dark">{{ $blog->title }}</h1>
            <p class="text-muted">
                Posted by <span class="font-weight-bold">{{ $blog->product->artist->name }}</span>
                on {{ $blog->created_at->format('F j, Y') }}
            </p>
        </div>

        <!-- Edit and Delete Actions -->
        <div class="d-flex justify-content-center gap-3 mb-4">
            @if (auth()->user()->can('manage blog') ||
                    (auth()->user()->can('manage blog') && auth()->user()->id == $blog->product->artist_id))
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editPostModal"
                    onclick="editPost({{ $blog }})">
                    <i class="fas fa-edit me-1"></i> Edit
                </button>
                <button class="btn btn-danger" onclick="deletePost('{{ route('artist.blog.delete', $blog->id) }}')">
                    <i class="fas fa-trash me-1"></i> Delete
                </button>
            @endif
        </div>

        <!-- Blog Content -->
        <div class="mt-4">
            <p id="blog-content" class="text-muted">{{ $blog->content }}</p>
        </div>

        <!-- Like and Comment Count -->
        <div class="mt-3 d-flex justify-content-between align-items-center">
            <div>
                <button
                    class="btn {{ $blog->likes->contains('user_id', auth()->user()->id) ? 'btn-success' : 'btn-outline-success' }} d-flex align-items-center gap-2"
                    id="like-btn" onclick="like()">
                    <i class="fas fa-thumbs-up"></i> Like
                </button>
            </div>
            <div class="text-muted d-flex gap-3">
                <span>
                    <i class="fas fa-heart"></i> <span id="like-count">{{ $blog->likes->count() }}</span> Likes
                </span>
                <span>
                    <i class="fas fa-comments"></i> <span id="comment-count">{{ $blog->comments->count() }}</span> Comments
                </span>
            </div>
        </div>

        <!-- Comment Section -->
        <div class="mt-5">
            <h2 class="h5 font-weight-bold text-dark mb-4">Comments</h2>
            <div class="mt-4 mb-3">
                <h3 class="h6 font-weight-bold text-dark mb-3">Leave a Comment</h3>
                <div class="form-group">
                    <textarea name="comment" id="comment" rows="4" class="form-control" placeholder="Write your comment here..."
                        required></textarea>
                </div>
                <button type="submit"
                    class="btn btn-primary mt-3 d-flex gap-2 justify-content-between align-items-center px-4 py-2 rounded-3 shadow-sm border-0"
                    onclick="comment()">
                    <div class="d-flex gap-2 align-items-center">
                        <i class="fas fa-comment-alt"></i>
                        <span>Post Comment</span>
                    </div>
                    <div class="spinner-grow spinner-grow-sm d-none" id="loader" role="status"></div>
                </button>

            </div>

            <!-- Display Comments -->
            <div class="mb-4" id="comments">
                @if ($blog->comments->count() > 0)
                    @include('blogs.partials.comments', ['comments' => $blog->comments])
                @else
                    <div class="text-center text-muted">
                        <p>No comments yet</p>
                    </div>
                @endif
            </div>
            @if ($comments->hasMorePages())
                <div class="text-center mt-3">
                    <button id="load-more-comments" class="btn btn-outline-success" data-next-page="2"
                        data-blog-id="{{ $blog->id }}">
                        <i class="fas fa-comments me-2"></i> Load More Comments
                    </button>
                    <div id="loading-spinner" class="d-none mt-2">
                        <div class="spinner-border text-success" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    @if (!auth()->user()->hasRole('user'))
        @include('blogs.modals._Edit-Post')
    @endif
@endsection
@push('scripts')
    <script src="{{ asset('js/blogCrud.js') }}"></script>
    <script>
        // Like channel broadcast
        var blogId = @json($blog->id);
        var likeChannel = pusher.subscribe('like.' + blogId)
        likeChannel.bind('like.post.' + "{{ $blog->id }}", function(data) {
            document.getElementById('like-count').innerText = data.count;
        })

        // Load more comments functionality
        $(document).on('click', '#load-more-comments', function() {
            const button = $(this);
            const nextPage = button.data('next-page');
            const blogId = button.data('blog-id');
            const spinner = $('#loading-spinner');

            // Show loading spinner and hide button
            button.addClass('d-none');
            spinner.removeClass('d-none');

            $.ajax({
                url: "{{ route('blog.comments.load', ':blogId') }}".replace(':blogId', blogId),
                type: 'GET',
                data: {
                    page: nextPage
                },
                success: function(response) {
                    if (response.html) {
                        $('#comments').append(response.html);
                        emojyRender();
                        updateCommentTime();

                        if (response.hasMore) {
                            button.data('next-page', nextPage + 1);
                            button.removeClass('d-none');
                        } else {
                            button.parent().remove();
                        }
                    }
                },
                error: function() {
                    alert('Failed to load more comments. Please try again.');
                },
                complete: function() {
                    spinner.addClass('d-none');
                }
            });
        });

        // Comment channel broadcast
        var commentChannel = pusher.subscribe('comment.' + "{{ $blog->id }}")
        commentChannel.bind('comment.post.' + blogId, function(data) {
            let commentsContainer = $('#comments');
            let noCommentsMsg = commentsContainer.find('.text-center.text-muted');

            if (noCommentsMsg.length) {
                noCommentsMsg.remove();
            }

            let url = `{{ route($role . '.blog.comment.delete', ':id') }}`.replace(':id', data.comment.id);
            let commentHtml = `
        <div class="d-flex gap-3 comment-item">
            <img loading="lazy" src="${data.user.avatar ? '/storage/users-avatar/' + data.user.avatar : '/default-avatar.png'}"
                class="rounded-circle" height="40" width="40" alt="">
            <div class="mb-4">
                <span class="small fw-bold">
                    ${data.user.name} • <span class="comment-time" data-comment-id="${data.comment.id}">
                        ${data.time}
                    </span>
                </span>
                <p class="text-muted emoji-content">${data.comment.content}</p>
            </div>
            ${data.user.id == "{{ auth()->id() }}" || "{{ auth()->user()->hasRole('admin') }}" ? `
                            <div class="dropdown ms-auto">
                                <button class="btn btn-sm border-0 bg-transparent p-0" type="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-start">
                                    <li class="bg-transparent">
                                        <button class="dropdown-item text-danger bg-transparent"
                                            onclick="deleteComment('${url}')">
                                            Remove Comment
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        ` : ''}
        </div>
    `;

            commentsContainer.prepend(commentHtml);
            document.getElementById('comment-count').innerText = data.count;
            emojyRender();
        });

        //emojy render
        function emojyRender() {
            $("#comment").emojioneArea({
                pickerPosition: "top",
                tonesStyle: "bullet",
                autocomplete: false,
                saveEmojisAs: "shortname",
            });
            document.querySelectorAll(".emoji-content").forEach((el) => {
                el.innerHTML = emojione.toImage(el.innerHTML);
            });
        }

        $(document).ready(function() {
            emojyRender()
        });

        //like
        function like() {
            $.ajax({
                type: "GET",
                url: "{{ route($role . '.blog.like', $blog->id) }}",
                success: function(response) {
                    $('#like-btn').toggleClass('btn-outline-success');
                    $('#like-btn').toggleClass('btn-success');
                    document.getElementById('like-count').innerText = response.likes;
                }
            });
        }

        //comment
        function comment() {
            if ($('textarea[name="comment"]').val() !== "" || $('textarea[name="comment"]').val() !== null) {
                $("#loader").removeClass("d-none")
                $.ajax({
                    type: "POST",
                    url: "{{ route($role . '.blog.comment', $blog->id) }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        comment: $('textarea[name="comment"]').val()
                    },
                    success: function(response) {
                        $("#loader").addClass("d-none")
                        $("#comment").emojioneArea()[0].emojioneArea.setText("");
                    }
                });
            }
        }

        //deleteComment
        function deleteComment(url) {
            $.ajax({
                type: "GET",
                url: `${url}`,
                success: function(response) {
                    window.location.reload();
                }
            });
        }

        //UpdateCommentTime
        function updateCommentTime() {
            document.querySelectorAll('.comment-time').forEach(el => {
                let id = el.getAttribute('data-comment-id');
                $.ajax({
                    type: "GET",
                    url: "{{ route('comment.time', ':id') }}".replace(':id', id),
                    success: function(response) {
                        el.innerText = response.updated_at
                    }
                });
            })
        }
        setInterval(updateCommentTime, 30000);
    </script>
@endpush
