@foreach ($comments as $comment)
    <div class="d-flex gap-3 mb-4 comment-item">
        <img loading="lazy" src="{{ asset('storage/users-avatar/' . $comment->user->avatar) }}" class="rounded-circle" height="40" width="40" alt="User Avatar">
        <div>
            <span class="small fw-bold">{{ $comment->user->name }} •
                <span class="comment-time" data-comment-id='{{ $comment->id }}'>{{ $comment->created_at->diffForHumans() }}</span>
            </span>
            <p class="text-muted mt-2 emoji-content">{{ $comment->content }}</p>
        </div>

        @if (auth()->user()->hasRole('admin') || auth()->user()->id == $comment->user_id)
            <div class="dropdown ms-auto">
                <button class="btn btn-sm border-0 bg-transparent p-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                </button>
                <ul class="dropdown-menu">
                    <li><button class="dropdown-item text-danger" onclick="deleteComment('{{ route($role . '.blog.comment.delete', $comment->id) }}')">
                        Remove Comment
                    </button></li>
                </ul>
            </div>
        @endif
    </div>
@endforeach
