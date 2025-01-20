@extends('layouts.LandingPageLayout.landing')
@section('title')
       Art-Express
@endsection

@section('page')
    <section>
        <div class="container d-flex flex-column align-items-center mt-2 mt-md-5 pt-3">
            <h1 class="res-title">Art-Express</h1>
            <h3 class="res-sub text-center">Unleash Your Creativity</h3>
            <p class="res-sub text-center w-75">Dive into a world of breathtaking art and inspiring masterpieces. Explore and connect with creativity like never before.</p>
            @if (auth()->user())
            <center>
                <a href="{{route(auth()->user()->getRoleNames()->first().'.dashboard')}}">
                    <button class="btn btn-primary res-button-font px-4" id="hero-button">Get Started</button>
                </a>
            </center>
            @else
            <center>
                <button class="btn btn-primary res-button-font px-4" id="hero-button" data-bs-toggle="modal" data-bs-target="#Sign-Up">Get Started</button>
            </center>
            @endif
        </div>
        <div class="container-fluid mt-2 mt-md-5 pb-3 pt-3 pb-md-5 pt-md-5 position-relative" id="features">
            <h1 class="text-center res-heading">Features we Provide</h1>
            <div class="container-fluid px-md-3 mt-md-5 mt-3">
                <div class="owl-carousel py-md-2 py-md-3">
                    <div class="slider-card pb-md-2 d-flex align-items-center justify-content-center">
                        <div class="card" >
                        <img src="{{asset('assets/images/images.jpeg')}}" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Discover Art Pieces</h5>
                          <p class="card-text">Explore an exclusive collection of art pieces from talented artists around the globe. Find the perfect artwork to match your style and personality.</p>
                        </div>
                      </div>
                    </div>
                    <div class="slider-card text-white">
                        <div class="card" >
                            <img src="{{asset('assets/images/Artist Showcase.webp')}}" class="card-img-top" alt="...">
                            <div class="card-body">
                              <h5 class="card-title">Artist Showcase</h5>
                              <p class="card-text">Celebrate the creativity of emerging and renowned artists. Browse through curated profiles and learn the stories behind their masterpieces.</p>
                            </div>
                          </div>
                    </div>
                    <div class="slider-card text-white">
                        <div class="card" >
                            <img src="{{asset('assets/images/shutterstock_451991974.jpg')}}" class="card-img-top" alt="...">
                            <div class="card-body">
                              <h5 class="card-title">Blog for Art Enthusiasts</h5>
                              <p class="card-text">Dive into engaging blogs about art trends, techniques, and history. Stay inspired and connected with the art community.</p>
                            </div>
                          </div>
                    </div>
                    <div class="slider-card text-white">
                        <div class="card" >
                            <img src="{{asset('assets/images/chatGPT.jpg.webp')}}" class="card-img-top" alt="...">
                            <div class="card-body">
                              <h5 class="card-title">ChatGPT- Assistance</h5>
                              <p class="card-text">Need help choosing art? Use our AI-powered chat tool to learn more about art categories make your selection easier.</p>
                            </div>
                          </div>
                    </div>
                    <div class="slider-card text-white">
                        <div class="card">
                            <img src="{{asset('assets/images/online-shopping-2.jpg')}}" class="card-img-top" alt="...">
                            <div class="card-body">
                              <h5 class="card-title">Secure Online Shopping</h5>
                              <p class="card-text">Shop for art worry-free with our secure payment system. Enjoy a seamless checkout experience and reliable delivery services.</p>
                            </div>
                          </div>
                    </div>
                </div>
            </div>
            <div class="d-flex gap-3 justify-content-center ">
                <button class="fs-1 d-block d-lg-none shadow" id="prev"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#fff0dc" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-left"><path d="m15 18-6-6 6-6"/></svg></button>
                <button class="fs-1 d-block d-lg-none shadow" id="next"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#fff0dc" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right"><path d="m9 18 6-6-6-6"/></svg></button>
            </div>
        </div>
        <div class="container-fluid mt-2 mt-md-5 mb-3" id="art-grid">
            <h1 class="text-center res-heading" id="art-grid-title">Explore Masterpieces</h1>
            <div class="row container mx-auto row gap-1 gx-0" id="bento-grid">
                <div class="col-lg-5 d-flex gap-1">
                    <img class="portrait-img" src="{{asset('assets/images/IMG-20241222-WA0001.jpg')}}" alt="" style="border: 20px solid var(--secondary)">
                    <img class="portrait-img" src="{{asset('assets/images/IMG-20241222-WA0009.jpg')}}" alt="" style="border: 20px solid var(--secondary)">

                </div>
                <div class="col-lg-6">
                    <img class="landscape-img mx-lg-1" src="{{asset('assets/images/landscape1.png')}}">
                </div>
                <div class="col-lg-6">
                    <img class="landscape-img " src="{{asset('assets/images/landscape2.png')}}">
                </div>
                <div class="col-lg-5 d-flex gap-1">
                    <img class="portrait-img" src="{{asset('assets/images/IMG-20241222-WA0008.jpg')}}" alt="" style="border: 20px solid var(--secondary)">
                    <img class="portrait-img" src="{{asset('assets/images/IMG-20241222-WA0007.jpg')}}" alt="" style="border: 20px solid var(--secondary)">

                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
<script>
    $(document).ready(function () {
        var owl=$('.owl-carousel').owlCarousel({
          margin: 10,
          mouseDrag:false,
          autoplayHoverPause:true,
          responsive: {
            0: {
              items: 1,
              autoplay:true,
              autoplayTimeout:3000,
              loop:true,
              touchDrag:true,
              mouseDrag:true,
            },
            600: {
              items: 2,
              autoplay:true,
              dots:true,
              autoplayTimeout:3000,
              loop:true,
              touchDrag:true
            },
            1000:{
                items:3,
                autoplay:true,
                autoplayTimeout:2000,
                mouseDrag:true,
                touchDrag:true,
                dots:true,
                loop:true
            },
            1300:{
                items:4,
                loop:true,
                mouseDrag:true,
                touchDrag:true,
                autoplay:true,
                autoplayTimeout:2000,
            },
            1600:{
                items:5
            }
          }
        });
    $('#prev').click(function() {
      owl.trigger('prev.owl.carousel');
    });
    $('#next').click(function() {
      owl.trigger('next.owl.carousel');
    });
    })
</script>
@endpush
