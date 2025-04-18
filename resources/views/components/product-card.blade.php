<div class="card mt-5 product-card position-relative shadow">
    <div class="ratio ratio-4x3 bg-light">
        <img loading="lazy" src="{{ asset($product->image->image_src) }}" class="w-100 h-100 image"
            alt="{{ $product->name }}" style="object-fit: contain">
    </div>
    <div class="card-body">
        <h5 class="card-title">{{ $product->name }}</h5>
        <p class="card-price text-success">Price: {{ $product->price }} Rs</p>
        <div class="d-flex justify-content-center gap-1">
            @if (request()->is('artist/products'))
                <button class="btn btn-primary btn-sm py-1" data-bs-toggle="modal"
                    data-bs-target="#editProductModal"
                    onclick="edit({{ $product }},'{{ asset($product->image->image_src) }}')">
                    Edit Product
                </button>
            @else
                <a href="{{ route($role . '.artwork', $product->id) }}" class="btn btn-primary">View Artwork</a>
            @endif
            @if ($product->blog)
                <a href="{{ route($role . '.blogs', $product->id) }}" class="btn btn-outline-success">Read Blog</a>
            @else
                @if (request()->is('artist/products'))
                    <button class="btn btn-outline-success btn-sm py-1" onclick="addPost({{ $product->id }})"
                        data-bs-toggle="modal" data-bs-target="#addPostModal">
                        Add Blog
                    </button>
                @endif
            @endif
            @if (auth()->user()->can('manage store') || auth()->user()->products()->where('id', $product->id)->exists())
                <button class="btn btn-danger position-absolute top-0 end-0 m-1"
                    onclick="deleteProduct('{{ route($role . '.product.delete', $product->id) }}')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-x">
                        <path d="M18 6 6 18" />
                        <path d="m6 6 12 12" />
                    </svg></button>
            @endif
        </div>
    </div>
</div>
