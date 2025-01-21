@extends('layouts.adminLayout.layout')
@section('page')
<div class="container mt-3 mb-3 mb-md-5">
    <input type="text" class="form-control" placeholder="search art-work...">
</div>
    @foreach ($categories as $key=> $category)
        <div class="caontainer-fluid px-md-5 px-2">
            <div class="d-flex flex-wrap align-items-center justify-content-between">
                <h1 class="product-title" style="color: var(--secondary);">{{ $category->name }}</h1>
                <div class="ms-auto d-flex gap-3 align-items-center">
                    <a class="browse" href="{{ route(auth()->user()->getRoleNames()->first() . '.products', $category->id) }}">Browse All</a>
                    <div class="d-flex gap-1">
                        <div id="prev-{{$key}}" style="cursor: pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#131010" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-big-left">
                                <path d="M18 15h-6v4l-7-7 7-7v4h6v6z"/>
                            </svg>
                        </div>
                        <div id="next-{{$key}}" style="cursor: pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#131010" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-big-right">
                                <path d="M6 9h6V5l7 7-7 7v-4H6V9z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <div class="owl-carousel slider-{{$key}}">
                @for ($i = 0; $i < 5; $i++)
                <div class="slider-card">
                    <center>
                        <div class="card mt-5 product-card">
                            <div class="image-container">
                                <img src="{{ asset('assets/images/landscape2.png') }}" class="card-img-top object-fit-contain"
                                    alt="Portrait Painting">
                                <div class="magnifier" id="magnifier"></div>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Beautiful Portrait Painting</h5>
                                <p class="seller"><b>By:M. Umer Farooq</b></p>
                                <p class="card-text">A stunning hand-painted portrait that captures every detail with elegance and creativity.</p>
                                <p class="card-price">Price: $120</p>
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="#" class="btn btn-primary">Buy Now</a>
                                    <a href="#" class="btn btn-outline-success">Read Blog</a>
                                </div>
                            </div>
                        </div>
                    </center>
                </div>
                <div class="slider-card">
                    <center>
                        <div class="card mt-5 product-card">
                            <div class="image-container">
                                <img src="{{ asset('assets/images/IMG-20241222-WA0007.jpg') }}" class="card-img-top object-fit-contain"
                                    alt="Portrait Painting">
                                <div class="magnifier" id="magnifier"></div>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Beautiful Portrait Painting</h5>
                                <p class="seller"><b>By:M. Umer Farooq</b></p>
                                <p class="card-text">A stunning hand-painted portrait that captures every detail with elegance and creativity.</p>
                                <p class="card-price">Price: $120</p>
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="#" class="btn btn-primary">Buy Now</a>
                                    <a href="#" class="btn btn-outline-success">Read Blog</a>
                                </div>
                            </div>
                        </div>
                    </center>
                </div>
                @endfor
                </div>
            </div>
    @endforeach
    @push('scripts')
    <script>
            @foreach ($categories as $key => $category)
                const slider{{ $key }} = $(`.slider-{{ $key }}`).owlCarousel({
                    mouseDrag: true,
                    touchDrag: true,
                    margin:10,
                    responsive: {
                        0: { items: 1.2 },
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
    </script>
    @endpush
@endsection
