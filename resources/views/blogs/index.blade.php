@extends('layouts.' . auth()->user()->getRoleNames()->first() . 'Layout.layout')

@section('page')
    <div class="container my-5">

        <div class="text-center mb-4">
            <img loading="lazy" src="{{ asset($blog->product->image->image_src) }}" alt="Beautiful Artwork" class="img-fluid"
                height="400" width="400" style="object-fit: contain; height:20rem; aspect-ratio:1/1;" />
        </div>

        <div class="text-center">
            <h1 class="h3 font-weight-bold text-dark">
                {{ $blog->title }}
            </h1>
            <p class="text-muted">
                Posted by <span class="font-weight-bold">{{ $blog->product->artist->name }}</span>
                on {{ $blog->created_at->format('F j, Y') }}
            </p>
        </div>

        {{-- Edit and delete actions --}}

        <center>
            <div class="d-flex gap-2 justify-content-center">
                @if (auth()->user()->hasRole('admin') ||
                        (auth()->user()->hasRole('artist') && auth()->user()->id == $blog->product->artist_id))
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editPostModal"
                        onclick="editPost({{ $blog }})">Edit</button>
                    <button class="btn btn-danger"
                        onclick="deletePost('{{ route('artist.blog.delete', $blog->id) }}')">Delete</button>
                @endif
            </div>
        </center>


        <div class="mt-3">
            <p id="blog-content">{{ $blog->content }}</p>
        </div>

        <div class="mt-3 d-flex justify-content-between align-items-center">
            <div>
                <button
                    class="btn {{ $blog->likes->contains('user_id', auth()->user()->id) ? 'btn-success' : 'btn-outline-success' }} d-flex align-items-center gap-2"
                    id="like-btn" onclick="like()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-thumbs-up">
                        <path d="M7 10v12" />
                        <path
                            d="M15 5.88 14 10h5.83a2 2 0 0 1 1.92 2.56l-2.33 8A2 2 0 0 1 17.5 22H4a2 2 0 0 1-2-2v-8a2 2 0 0 1 2-2h2.76a2 2 0 0 0 1.79-1.11L12 2a3.13 3.13 0 0 1 3 3.88Z" />
                    </svg>
                    <span>Like</span>
                </button>
            </div>
            <div>
                <span class="text-muted">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-heart">
                        <path
                            d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z" />
                    </svg>
                    <span id="like-count">{{ $blog->likes->count() }}</span> Likes
                </span>
                <span class="text-muted">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-message-square-more">
                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" />
                        <path d="M8 10h.01" />
                        <path d="M12 10h.01" />
                        <path d="M16 10h.01" />
                    </svg>
                    <span id="comment-count">{{ $blog->comments->count() }}</span> Comments
                </span>
            </div>
        </div>

        <div class="mt-5">
            <h2 class="h5 font-weight-bold text-dark mb-4">Comments</h2>
            <div class="mt-4 mb-md-3 mb-2">
                <h2 class="h5 font-weight-bold text-dark mb-3">Leave a Comment</h2>
                <div class="form-group">
                    <textarea name="comment" id="comment" rows="4" class="form-control" placeholder="Write your comment here..."
                        required></textarea>
                </div>
                <button type="submit" class="btn btn-primary mt-3 d-flex gap-2 align-items-center" onclick="comment()">
                    <l-reuleaux class="d-none" id="loader" size="15" stroke="2" stroke-length="0.05" bg-opacity="0.1" speed="1.2"
                        color="#F4EBD9"></l-reuleaux>
                    <span>Post Comment</span>
                </button>
            </div>
            <div class="mb-4" id="comments">
                @if ($blog->comments->count() > 0)
                    @foreach ($blog->comments as $comment)
                        <div class="d-flex gap-3">
                            <img loading="lazy" src="{{ asset('storage/users-avatar/' . $comment->user->avatar) }}"
                                class="rounded-circle" height="40" width="40" alt="">
                            <div class="mb-4">
                                <span class="small fw-bold">
                                    {{ $comment->user->name }} • <span class="comment-time"
                                        data-comment-id='{{ $comment->id }}'>{{ $comment->created_at->diffForHumans() }}</span>
                                </span>
                                <p class="text-muted emoji-content">{{ $comment->content }}</p>
                            </div>
                            @if (auth()->user()->hasRole('admin') || auth()->user()->id == $comment->user_id)
                                <!-- Dropdown Menu -->
                                <div class="dropdown ms-auto">
                                    <button class="btn btn-sm border-0 bg-transparent p-0" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-ellipsis-vertical">
                                            <circle cx="12" cy="12" r="1" />
                                            <circle cx="12" cy="5" r="1" />
                                            <circle cx="12" cy="19" r="1" />
                                        </svg>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-start">
                                        <li class="bg-transparent">
                                            <button class="dropdown-item text-danger bg-transparent"
                                                onclick="deleteComment('{{ route($role . '.blog.comment.delete', $comment->id) }}')">
                                                Remove Comment
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            @endif
                        </div>
                    @endforeach
                @else
                    <div class="no-comments">
                        <center>
                            <p>No comments yet</p>
                        </center>
                    </div>
                @endif
            </div>
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

        // comment channel broadcast
        var commentChannel = pusher.subscribe('comment.' + "{{ $blog->id }}")
        commentChannel.bind('comment.post.' + blogId, function(data) {
            let comments = document.getElementById('comments');
            let url = `{{ route($role . '.blog.comment.delete', ':id') }}`
                .replace(':id', data.comment.id);
            let commentHtml = `
                <div class="d-flex gap-3">
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
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-ellipsis-vertical">
                                                <circle cx="12" cy="12" r="1" />
                                                <circle cx="12" cy="5" r="1" />
                                                <circle cx="12" cy="19" r="1" />
                                            </svg>
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

            $(comments).prepend(commentHtml);
            document.getElementById('comment-count').innerText = data.count;
            emojyRender()
        })

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
            $('#like-btn').toggleClass('btn-outline-success');
            $('#like-btn').toggleClass('btn-success');
            $.ajax({
                type: "GET",
                url: "{{ route($role . '.blog.like', $blog->id) }}",
                success: function(response) {
                    document.getElementById('like-count').innerText = response.likes;
                }
            });
        }

        //comment
        function comment() {
            if ($('textarea[name="comment"]').val() !== "" || $('textarea[name="comment"]').val() !== null) {
                $("#loader").removeClass("d-none");
                $.ajax({
                    type: "POST",
                    url: "{{ route($role . '.blog.comment', $blog->id) }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        comment: $('textarea[name="comment"]').val()
                    },
                    success: function(response) {
                        $("#comment").emojioneArea()[0].emojioneArea.setText("");
                        $("#loader").addClass("d-none");
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
        setInterval(updateCommentTime, 10000);
    </script>
@endpush
