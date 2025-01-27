@extends('layouts.' . auth()->user()->getRoleNames()->first() . 'Layout.layout')
@section('page')
<div class="d-flex container mt-3">
    <h3>Manage Products</h3>
    <button class="btn btn-primary ms-auto" data-bs-toggle="modal" data-bs-target="#productModal">Add Product</button>
</div>
<div class="row mx-2 align-items-center justify-content-center">

    @foreach ($products as $product)
    <div class="col-md-6 col-lg-3 mb-4">
            <center>
            <div class="card mt-5 product-card position-relative">
                <div class="d-flex gap-1 position-absolute top-0 end-0">
                    <button class="btn btn-dark opacity-50"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-pen-line"><path d="m18 5-2.414-2.414A2 2 0 0 0 14.172 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2"/><path d="M21.378 12.626a1 1 0 0 0-3.004-3.004l-4.01 4.012a2 2 0 0 0-.506.854l-.837 2.87a.5.5 0 0 0 .62.62l2.87-.837a2 2 0 0 0 .854-.506z"/><path d="M8 18h1"/></svg></button>

                    <button class="btn btn-danger"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg></button>
                </div>
                <div class="image-container">
                    <img src="{{ asset($product->image->image_src) }}" class="card-img-top object-fit-contain"
                        alt="Portrait Painting">
                    <div class="magnifier" id="magnifier"></div>
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{$product->title}}</h5>
                    <p class="seller"><b>By: {{$product->artist->name}}</b></p>
                    <p class="card-text">{{$product->description}}</p>
                    <p class="card-price">Price: {{$product->price}} Rs</p>
                    <div class="d-flex justify-content-center gap-1 mt-auto">
                        <a href="{{route(auth()->user()->getRoleNames()->first().'.blogs',$product->blog->id)}}" class="btn btn-outline-success">Read Blog</a>
                    </div>
                </div>
            </div>
        </center>
        </div>
    @endforeach
@include('artist.products.modals._Add-Product')
</div>
@endsection
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
    const addBlogCheckbox = document.getElementById('addBlog');
    const blogContent = document.getElementById('blogContent');
    const categorySelect = document.getElementById('category');
    const subcategoryContainer = document.getElementById('subcategoryContainer');
    const subcategorySelect = document.getElementById('subcategory');

    if(addBlogCheckbox.checked){
        blogContent.classList.remove('d-none');
    }
    // Toggle blog content field
    addBlogCheckbox.addEventListener('change', function () {
        blogContent.classList.toggle('d-none', !this.checked);
    });

    // Fetch subcategories based on category selection
    categorySelect.addEventListener('change', function () {
        const categoryId = this.value;
        if (categoryId) {
            fetch(`/artist/categories/${categoryId}/subcategories`)
                .then(response => response.json())
                .then(data => {
                    subcategoryContainer.classList.remove('d-none');
                    subcategorySelect.innerHTML = '<option value="">Select a Subcategory</option>';
                    data.forEach(subcategory => {
                        subcategorySelect.innerHTML += `<option value="${subcategory.id}">${subcategory.name}</option>`;
                    });
                });
        } else {
            subcategoryContainer.classList.add('d-none');
            subcategorySelect.innerHTML = '<option value="">Select a Subcategory</option>';
        }
    });
});

</script>
@endpush
