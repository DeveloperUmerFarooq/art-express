<div class="card mt-5 product-card position-relative">
    <div class="image-container">
        <img src="{{ asset($product->image->image_src) }}"
            class="card-img-top object-fit-contain" alt="Portrait Painting">

    </div>
    <div class="card-body">
        <h5 class="card-title">{{ $product->name }}</h5>
        <a
            href="{{ route(auth()->user()->getRoleNames()->first() . '.profile.view', $product->artist->id) }}">
            <p class="seller"><b>By:{{ $product->artist->name }}</b></p>
        </a>
        <p class="card-text" style="height: 75px; overflow: hidden; align-content:center">
            {{ $product->description }}</p>
        <p class="card-price text-success">Price: {{ $product->price }} Rs</p>
        <div class="d-flex justify-content-center gap-1">
            @can('buy art')
            @if (!auth()->user()->products()->where('id', $product->id)->exists())
            <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                data-bs-target="#buyProductModal" onclick="buy({{ $product }})">Buy
                Now</a>
            @endif
            @endcan
            @can('manage store')
                <button class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#editProductModal"
                    onclick="edit({{ $product }},'{{ asset($product->image->image_src) }}')">Edit
                    Product</button>
            @endcan
            <a href="{{ route(auth()->user()->getRoleNames()->first() . '.blogs', $product->id) }}"
                class="btn btn-outline-success">Read Blog</a>
            @can('manage store')
                <button class="btn btn-danger position-absolute top-0 end-0 m-1"
                    onclick="deleteProduct('{{ route(auth()->user()->getRoleNames()->first() . '.product.delete', $product->id) }}')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x">
                        <path d="M18 6 6 18" />
                        <path d="m6 6 12 12" />
                    </svg></button>
            @endcan
        </div>
    </div>
</div>
