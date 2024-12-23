@extends('layouts.LandingPageLayout.landing')
@section('title')
       Hello
@endsection

@section('page')
    <section>
        <div class="container d-flex flex-column align-items-center mt-5 pt-3">
            <h1 class="res-title">Art-Express</h1>
            <h3 class="res-sub text-center">Unleash Your Creativity</h3>
            <p class="res-sub text-center w-75">Dive into a world of breathtaking art and inspiring masterpieces. Explore and connect with creativity like never before.</p>
            <center><button class="btn btn-primary res-button-font">Get Started</button></center>
        </div>
        <div class="container-fluid mt-2 mt-md-5 pt-3 pt-md-5" id="features">
            <h1 class="text-center res-heading">Features we Provide</h1>
        </div>
        <div class="container-fluid mt-2 mt-md-5 pt-3 pt-md-5">
            <h1 class="text-center res-heading">Explore Masterpieces</h1>
        </div>
    </section>
@endsection
