@extends('layouts.LandingPageLayout.landing')
@section('title')
       Art-Express
@endsection

@section('page')
    <section>
        <div class="py-2 py-md-3" id="hero-section">
            <div class="container d-flex flex-column align-items-center py-3 glasmorphism">
                <center><img loading="lazy" src="{{asset('assets/images/logo.svg')}}" id="logo"
                     height="150" alt="" style="filter:drop-shadow(1px 1px 10px #131010)"></center>
                <h1 class="res-title">Art-Express</h1>
                <h3 class="res-sub text-center">Get the Art you Desire</h3>
                <p class="res-sub text-center w-75">Dive into a world of breathtaking art and inspiring masterpieces. Explore and connect with creativity like never before.</p>
                @if (auth()->user())
                <center>
                    <a href="{{route($role.'.dashboard')}}">
                        <button class="btn btn-primary res-button-font px-4" id="hero-button">Get Started</button>
                    </a>
                </center>
                @else
                <center>
                    <button class="btn btn-primary res-button-font px-4" id="hero-button" data-bs-toggle="modal" data-bs-target="#Sign-Up">Get Started</button>
                </center>
                @endif
            </div>
        </div>
        <div id="features">
            <div class="container-fluid pb-3 pb-md-5 position-relative">
                <div class="pt-md-3 pt-2">
                    <h1 class="text-center res-heading">Features we Provide</h1>
                    <div class="container-fluid px-md-3 mt-md-5 mt-3">
                        <div class="owl-carousel py-md-2 py-md-3">
                            <div class="slider-card pb-md-2 d-flex align-items-center justify-content-center">
                                <div class="card features-card" >
                                <img loading="lazy" src="{{asset('assets/images/images.jpeg')}}" class="card-img-top" alt="...">
                                <div class="card-body d-flex flex-column">
                                  <h5 class="card-title flex-1">Discover Art Pieces</h5>
                                  <p class="card-text flex-1">Explore an exclusive collection of art pieces from talented artists around the globe. Find the perfect artwork to match your style and personality.</p>
                                </div>
                              </div>
                            </div>
                            <div class="slider-card text-white">
                                <div class="card features-card" >
                                    <img loading="lazy" src="{{asset('assets/images/Artist Showcase.webp')}}" class="card-img-top" alt="...">
                                    <div class="card-body d-flex flex-column">
                                      <h5 class="card-title flex-1">Artist Showcase</h5>
                                      <p class="card-text flex-1">Celebrate the creativity of emerging and renowned artists. Browse through curated profiles and learn the stories behind their masterpieces.</p>
                                    </div>
                                  </div>
                            </div>
                            <div class="slider-card text-white">
                                <div class="card features-card" >
                                    <img loading="lazy" src="{{asset('assets/images/shutterstock_451991974.jpg')}}" class="card-img-top" alt="...">
                                    <div class="card-body d-flex flex-column">
                                      <h5 class="card-title flex-1">Product Blogs</h5>
                                      <p class="card-text flex-1">Dive into engaging blogs about art trends, techniques, and history. Stay inspired and connected with the art community.</p>
                                    </div>
                                  </div>
                            </div>
                            <div class="slider-card text-white">
                                <div class="card features-card" >
                                    <img loading="lazy" src="{{asset('assets/images/chatGPT.jpg.webp')}}" class="card-img-top" alt="...">
                                    <div class="card-body d-flex flex-column">
                                      <h5 class="card-title flex-1">ChatGPT- Assistance</h5>
                                      <p class="card-text flex-1">Need help choosing art? Use our AI-powered chat tool to learn more about art categories make your selection easier.</p>
                                    </div>
                                  </div>
                            </div>
                            <div class="slider-card">
                                <div class="card features-card">
                                    <img loading="lazy" src="{{asset('assets/images/online-shopping-2.jpg')}}" class="card-img-top" alt="...">
                                    <div class="card-body d-flex flex-column">
                                      <h5 class="card-title flex-1">Secure Shopping</h5>
                                      <p class="card-text flex-1">Shop for art worry-free with our secure payment system. Enjoy a seamless checkout experience and reliable delivery services.</p>
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
            </div>
        </div>
        <div class="container-fluid mt-2 mt-md-5" id="art-grid">
            <h1 class="text-center res-heading pt-2 pt-md-3" id="art-grid-title">Explore Masterpieces</h1>
            @if ($images->count()>0)
            <div class="landing-layout">
                @foreach ($images as $image)
                <div><img loading="lazy" class="layout-img" src="{{asset($image->image_src)}}" alt=""></div>
                @endforeach
            </div>
            @else
            <div class="card shadow-sm container my-5" style="height: max-content !important">
            <div class="card-body d-flex flex-column text-center">
                <h5 class="card-title flex-1">No Products Added</h5>
                <p class="card-text flex-1">It looks like there are no product images avaialable!</p>
            </div>
        </div>
            @endif
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
          loop:true,
          mouseDrag:true,
          touchDrag:true,
          autoplay:true,
          responsive: {
            0: {
              items: 1,
              autoplayTimeout:3000,
            },
            600: {
              items: 2,
              autoplayTimeout:3000,
            },
            1000:{
                items:3,
                autoplayTimeout:2000,
            },
            1300:{
                items:4,
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
