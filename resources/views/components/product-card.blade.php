<div class="card mt-5 product-card position-relative shadow rounded-2 border-0 overflow-hidden">
    <!-- Image Section -->
    <div class="ratio ratio-4x3 bg-light rounded-top overflow-hidden">
        <img loading="lazy" src="{{ asset($product->image->image_src) }}"
             class="w-100 h-100 image" alt="{{ $product->name }}"
             style="object-fit: contain;">
    </div>

    <!-- Card Body -->
    <div class="card-body text-center">
        <h5 class="card-title fw-bold text-dark">{{ $product->name }}</h5>
        <span class="badge bg-success fs-6 mb-3">Price: {{number_format($product->price,0) }} Rs</span>

        <!-- Action Buttons -->
        <div class="d-flex flex-wrap justify-content-center gap-2">
            @if (request()->is('artist/products'))
                @can('edit art')
                @if ($product->status==="Unsold")
                    <button class="btn btn-primary btn-sm"
                            data-bs-toggle="modal"
                            data-bs-target="#editProductModal"
                            onclick="edit({{ $product }}, '{{ asset($product->image->image_src) }}')">
                        <i class="fas fa-edit me-1"></i> Edit Product
                    </button>
                @endif
                @endcan
            @else
                @can('view art')
                    <a href="{{ route($role . '.artwork', $product->id) }}"
                       class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-eye me-1"></i> View Artwork
                    </a>
                @endcan
            @endif

            @if ($product->blog)
                <a href="{{ route($role . '.blogs', $product->blog->id) }}"
                   class="btn btn-outline-success btn-sm">
                   <i class="fas fa-book-open me-1"></i> Read Blog
                </a>
            @else
                @if (request()->is('artist/products'))
                    <button class="btn btn-outline-success btn-sm"
                            onclick="addPost({{ $product->id }})"
                            data-bs-toggle="modal"
                            data-bs-target="#addPostModal">
                        <i class="fas fa-plus me-1"></i> Add Blog
                    </button>
                @endif
            @endif
        </div>
    </div>

    <!-- Delete Button -->
    @if (auth()->user()->can('manage store') ||
         (auth()->user()->products()->where('id', $product->id)->exists() && auth()->user()->can('delete art')))
         @if ($product->status==="Unsold")
         <button class="btn btn-danger btn-sm position-absolute top-2 end-0 z-3"
                 onclick="deleteProduct('{{ route($role . '.product.delete', $product->id) }}')"
                 title="Delete Product">
             <i class="fas fa-times"></i>
         </button>
         @endif
    @endif
</div>
