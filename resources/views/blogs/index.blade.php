@extends('layouts.' . auth()->user()->getRoleNames()->first() . 'Layout.layout')

@section('page')
<div class="container my-5">

    <div class="text-center mb-4">
        <img
            src="{{ asset('assets/images/IMG-20241222-WA0007.jpg') }}"
            alt="Beautiful Artwork"
            class="img-fluid"
            height="400"
            width="400"
            style="object-fit: contain; height:20rem; aspect-ratio:1/1;"
        />
    </div>

    <div class="text-center">

        <h1 class="h3 font-weight-bold text-dark">
            Stunning Sunset by the Lake
        </h1>


        <p class="text-muted">
            Posted by <span class="font-weight-bold">Muhammad Umer Farooq</span>
            on January 21, 2025
        </p>
    </div>


    <div class="mt-4">
        <p class="text-justify text-secondary">
            This mesmerizing artwork captures the serene beauty of a sunset by the lake. The vibrant colors and delicate brushstrokes bring to life the tranquility and charm of nature, making it a perfect addition to any art collection.
        </p>
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
                    <pre class="text-secondary">This artwork is absolutely stunning! The colors and composition are so calming and beautiful.</pre>
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
@endsection
