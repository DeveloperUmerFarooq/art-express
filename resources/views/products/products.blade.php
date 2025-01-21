@extends('layouts.' . auth()->user()->getRoleNames()->first() . 'Layout.layout')
@section('page')
    <h1 class="mt-3 mx-2">{{ $category->name }}</h1>
    <div class="d-flex flex-wrap mx-2">
        <h5>Browse by Subcategory</h5>
        <h5><a class="ms-3" href="">ask AI about current subcategory</a></h5>
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
                <div class="card mt-5 product-card position-relative">
                    <button class="btn btn-danger position-absolute top-0 end-0 p-2"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg></button>
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
                            <a href="{{route('admin.blogs',1)}}" class="btn btn-outline-success">Read Blog</a>
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
