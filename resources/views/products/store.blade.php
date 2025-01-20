@extends('layouts.adminLayout.layout')
@section('page')
    <div class="card mt-5 ms-5 portrait">
        <div class="image-container">
            <img src="{{ asset('assets/images/IMG-20241222-WA0001.jpg') }}" class="card-img-top object-fit-contain"
                alt="Portrait Painting">
            <div class="magnifier" id="magnifier"></div>
        </div>
        <div class="card-body">
            <h5 class="card-title">Beautiful Portrait Painting</h5>
            <p class="card-text">A stunning hand-painted portrait that captures every detail with elegance and creativity.
                Perfect for your living room or as a gift.</p>
            <p class="card-price">Price: $120</p>
            <div class="d-flex justify-content-between">
                <a href="#" class="btn btn-success">Buy Now</a>
                <a href="#" class="btn btn-info">Read Blog</a>
            </div>
        </div>
    </div>
    <div class="card mt-5 ms-5 landscape">
        <div class="image-container">
            <img src="{{ asset('assets/images/IMG-20241222-WA0002.jpg') }}" class="card-img-top object-fit-contain"
                alt="Portrait Painting">
            <div class="magnifier" id="magnifier"></div>
        </div>
        <div class="card-body">
            <h5 class="card-title">Beautiful Portrait Painting</h5>
            <p class="card-text">A stunning hand-painted portrait that captures every detail with elegance and creativity.
                Perfect for your living room or as a gift.</p>
            <p class="card-price">Price: $120</p>
            <div class="d-flex justify-content-between">
                <a href="#" class="btn btn-success">Buy Now</a>
                <a href="#" class="btn btn-info">Read Blog</a>
            </div>
        </div>
    </div>
    @push('scripts')
    <script>

        document.addEventListener("DOMContentLoaded", function () {
            // Select all image containers
            const imageContainers = document.querySelectorAll(".image-container");

            imageContainers.forEach((container) => {
                const img = container.querySelector(".card-img-top");

                // Create a magnifier dynamically for each container
                const magnifier = document.createElement("div");
                magnifier.className = "magnifier";
                container.appendChild(magnifier);

                // Event listener for mousemove
                container.addEventListener("mousemove", function (e) {
                    const { left, top, width, height } = img.getBoundingClientRect();
                    const x = e.clientX - left;
                    const y = e.clientY - top;

                    // Display and position the magnifier
                    magnifier.style.display = "block";
                    magnifier.style.left = `${x - magnifier.offsetWidth / 4}px`;
                    magnifier.style.top = `${y - magnifier.offsetHeight / 4}px`;

                    // Set magnifier background to match the zoomed-in portion
                    magnifier.style.backgroundImage = `url(${img.src})`;
                    magnifier.style.backgroundPosition = `${-x * 2 + magnifier.offsetWidth / 2}px ${
                        -y * 2 + magnifier.offsetHeight / 2
                        }px`;
                    });

                    // Hide magnifier on mouse leave
                    container.addEventListener("mouseleave", function () {
                        magnifier.style.display = "none";
                    });
                });
            });

        </script>
    @endpush
@endsection
