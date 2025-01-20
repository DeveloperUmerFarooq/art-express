@extends('layouts.adminLayout.layout')
@section('page')
<div class="container mt-3">
    <input type="text" class="form-control" placeholder="search art-work...">
</div>
    @foreach ($categories as $key=> $category)
        <div class="caontainer-fluid px-md-5 px-2">
            <div class="d-flex">
                <h1 class="product-title" style="color: var(--secondary)">{{$category->name}}</h1>
                <div class="ms-auto align-self-center d-flex gap-3">
                    <a href="{{route(auth()->user()->getRoleNames()->first().".products",$category->id)}}">Browse All</a>
                    <div class="d-flex gap-1">
                        <div id="prev-{{$key}}" style="cursor: pointer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#131010" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-big-left"><path d="M18 15h-6v4l-7-7 7-7v4h6v6z"/></svg></div>
                        <div id="next-{{$key}}" style="cursor: pointer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#131010" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-big-right"><path d="M6 9h6V5l7 7-7 7v-4H6V9z"/></svg></div>
                    </div>
                </div>
            </div>
            <div class="owl-carousel slider-{{$key}}">
                @for ($i = 0; $i < 5; $i++)
                <div class="slider-card">
                    <div class="card mt-5 ms-5 portrait">
                        <div class="image-container">
                            <img src="{{ asset('assets/images/landscape2.png') }}" class="card-img-top object-fit-contain"
                                alt="Portrait Painting">
                            <div class="magnifier" id="magnifier"></div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Beautiful Portrait Painting</h5>
                            <p class="card-text">A stunning hand-painted portrait that captures every detail with elegance and creativity.</p>
                            <p class="card-price">Price: $120</p>
                            <div class="d-flex justify-content-between">
                                <a href="#" class="btn btn-success">Buy Now</a>
                                <a href="#" class="btn btn-info">Read Blog</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="slider-card">
                    <div class="card mt-5 ms-5 portrait">
                        <div class="image-container">
                            <img src="{{ asset('assets/images/IMG-20241222-WA0007.jpg') }}" class="card-img-top object-fit-contain"
                                alt="Portrait Painting">
                            <div class="magnifier" id="magnifier"></div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Beautiful Portrait Painting</h5>
                            <p class="card-text">A stunning hand-painted portrait that captures every detail with elegance and creativity.</p>
                            <p class="card-price">Price: $120</p>
                            <div class="d-flex justify-content-between">
                                <a href="#" class="btn btn-success">Buy Now</a>
                                <a href="#" class="btn btn-info">Read Blog</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endfor
                </div>
            </div>
    @endforeach
    @push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Initialize magnifier functionality
            const imageContainers = document.querySelectorAll(".image-container");

            imageContainers.forEach((container) => {
                const img = container.querySelector(".card-img-top");
                const magnifier = document.createElement("div");
                magnifier.className = "magnifier";
                container.appendChild(magnifier);

                container.addEventListener("mousemove", function (e) {
                    const { left, top, width, height } = img.getBoundingClientRect();
                    const x = e.clientX - left;
                    const y = e.clientY - top;
                    magnifier.style.display = "block";
                    magnifier.style.left = `${x - magnifier.offsetWidth / 4}px`;
                    magnifier.style.top = `${y - magnifier.offsetHeight / 4}px`;
                    magnifier.style.backgroundImage = `url(${img.src})`;
                    magnifier.style.backgroundPosition = `${-x * 2 + magnifier.offsetWidth / 2}px ${-y * 2 + magnifier.offsetHeight / 2}px`;
                });

                container.addEventListener("mouseleave", function () {
                    magnifier.style.display = "none";
                });
            });

            // Initialize each slider with individual navigation
            @foreach ($categories as $key => $category)
                const slider{{ $key }} = $(`.slider-{{ $key }}`).owlCarousel({
                    mouseDrag: true,
                    touchDrag: true,
                    responsive: {
                        0: { items: 1 },
                        600: { items: 2 },
                        1000: { items: 3 },
                        1300: { items: 4 },
                        1600: { items: 5 }
                    }
                });

                $(`#prev-{{ $key }}`).click(function () {
                    slider{{ $key }}.trigger('prev.owl.carousel');
                });
                $(`#next-{{ $key }}`).click(function () {
                    slider{{ $key }}.trigger('next.owl.carousel');
                });
            @endforeach
        });
    </script>
    @endpush
@endsection
