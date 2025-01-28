@extends('layouts.' . auth()->user()->getRoleNames()->first() . 'Layout.layout')

@section('page')
<div class="container my-5">

    <div class="text-center mb-4">
        <img
            src="{{ asset($blog->product->image->image_src) }}"
            alt="Beautiful Artwork"
            class="img-fluid"
            height="400"
            width="400"
            style="object-fit: contain; height:20rem; aspect-ratio:1/1;"
        />
    </div>

    <div class="text-center">
        <h1 class="h3 font-weight-bold text-dark">
            {{$blog->title}}
        </h1>

        <p class="text-muted">
            Posted by <span class="font-weight-bold">{{$blog->product->artist->name}}</span>
            on {{ $blog->created_at->format('F j, Y') }}
        </p>
    </div>

    {{-- Edit and delete actions --}}

    <center>
        <div class="d-flex gap-2 justify-content-center">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editPostModal" onclick="editPost({{$blog}})">Edit</button>
            <button class="btn btn-danger">Delete</button>
        </div>
    </center>

    <div class="mt-4">
        <p class="text-justify text-secondary text-black">
            {{$blog->content}}
        </p>
    </div>

    <div class="mt-3 d-flex justify-content-between align-items-center">
        <div>
            <button class="btn btn-outline-primary d-flex align-items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-thumbs-up"><path d="M7 10v12"/><path d="M15 5.88 14 10h5.83a2 2 0 0 1 1.92 2.56l-2.33 8A2 2 0 0 1 17.5 22H4a2 2 0 0 1-2-2v-8a2 2 0 0 1 2-2h2.76a2 2 0 0 0 1.79-1.11L12 2a3.13 3.13 0 0 1 3 3.88Z"/></svg>
                <span>Like</span>
            </button>
        </div>
        <div>
            <span class="text-muted me-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-heart"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/></svg>
                <span id="like-count">125</span> Likes
            </span>
            <span class="text-muted">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-square-more"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/><path d="M8 10h.01"/><path d="M12 10h.01"/><path d="M16 10h.01"/></svg>
                <span id="comment-count">2</span> Comments
            </span>
        </div>
    </div>

    <div class="mt-5">
        <h2 class="h5 font-weight-bold text-dark mb-4">Comments</h2>

        <div class="mb-4">
            <div class="d-flex mb-3">
                <img
                    src=""
                    alt="User Icon"
                    class="rounded-circle me-3"
                    style="width: 50px; height: 50px;"
                />
                <div>
                    <h6 class="font-weight-bold mb-1">Muhammad Ismail</h6>
                    <p class="text-muted small mb-1">January 20, 2025</p>
                    <p class="text-secondary">This artwork is absolutely stunning! The colors and composition are so calming and beautiful.</p>
                </div>
            </div>

            <div class="d-flex">
                <img
                    src=""
                    alt="User Icon"
                    class="rounded-circle me-3"
                    style="width: 50px; height: 50px;"
                />
                <div>
                    <h6 class="font-weight-bold mb-1">Muhammad Umer</h6>
                    <p class="text-muted small mb-1">January 19, 2025</p>
                    <p class="text-secondary">
                        The details in this piece are breathtaking. Amazing work by the artist!
                    </p>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <h2 class="h5 font-weight-bold text-dark mb-3">Leave a Comment</h2>
            <form action="#" method="POST">
                <div class="form-group">
                    <textarea
                        name="comment"
                        rows="4"
                        class="form-control"
                        placeholder="Write your comment here..."
                        required
                    ></textarea>
                </div>
                <button
                    type="submit"
                    class="btn btn-primary mt-3"
                >
                    Post Comment
                </button>
            </form>
        </div>
    </div>
</div>
@include('blogs.modals._Edit-Post')
@endsection
@push('scripts')
    <script src="{{asset('assets/js/blogCrud.js')}}"></script>
@endpush
