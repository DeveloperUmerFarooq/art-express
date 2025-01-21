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
        @for ($i = 0; $i < 12; $i++)
        <div class="col-md-6 col-lg-3 mb-4">
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
                        <p class="card-text">A stunning hand-painted portrait that captures every detail with elegance and
                            creativity.</p>
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
@endsection
@push('scripts')
@endpush
