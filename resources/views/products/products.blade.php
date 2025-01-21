@extends('layouts.adminLayout.layout')

@section('page')
    <h1 class="mt-3 mx-2">{{ $category->name }}</h1>
    <div class="d-flex flex-wrap mx-2">
        <h5>Browse by Subcategory</h5>
        <form method="GET" action="" class="d-flex flex-wrap ms-auto gap-2">
            <div class="list-group">
                <select name="subcategories[]" class="form-select">
                    @foreach ($subCategories as $subcategory)
                        <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Apply Filter</button>
        </form>
    </div>

    <div class="row mt-4 mx-2 align-items-center justify-content-center">
        <center>
            <div class="col-md-4 mb-4">
                <div class="card mt-5 product-card">
                    <div class="image-container">
                        <img src="{{ asset('assets/images/IMG-20241222-WA0007.jpg') }}" class="card-img-top object-fit-contain"
                            alt="Portrait Painting">
                        <div class="magnifier" id="magnifier"></div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Beautiful Portrait Painting</h5>
                        <p class="seller"><b>By:M. Umer Farooq</b></p>
                        <p class="card-text">A stunning hand-painted portrait that captures every detail with elegance and
                            creativity.</p>
                        <p class="card-price">Price: $120</p>
                        <div class="d-flex justify-content-center gap-1">
                            <a href="#" class="btn btn-primary">Buy Now</a>
                            <a href="#" class="btn btn-outline-success">Read Blog</a>
                        </div>
                    </div>
                </div>
            </div>
        </center>

    </div>
@endsection
@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Initialize magnifier functionality
            const imageContainers = document.querySelectorAll(".image-container");

            imageContainers.forEach((container) => {
                const img = container.querySelector(".card-img-top");
                const magnifier = document.createElement("div");
                magnifier.className = "magnifier";
                container.appendChild(magnifier);

                container.addEventListener("mousemove", function(e) {
                    const {
                        left,
                        top,
                        width,
                        height
                    } = img.getBoundingClientRect();
                    const x = e.clientX - left;
                    const y = e.clientY - top;
                    magnifier.style.display = "block";
                    magnifier.style.left = `${x - magnifier.offsetWidth / 4}px`;
                    magnifier.style.top = `${y - magnifier.offsetHeight / 4}px`;
                    magnifier.style.backgroundImage = `url(${img.src})`;
                    magnifier.style.backgroundPosition =
                        `${-x * 2 + magnifier.offsetWidth / 2}px ${-y * 2 + magnifier.offsetHeight / 2}px`;
                });

                container.addEventListener("mouseleave", function() {
                    magnifier.style.display = "none";
                });
            });
        });
    </script>
@endpush
