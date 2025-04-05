<div class="card mt-5 product-card position-relative">
    <div class="ratio ratio-4x3 bg-light">
        <img loading="lazy" src="{{ asset($product->image->image_src) }}"
             class="object-fit-contain w-100 h-100 image"
             alt="{{ $product->name }}">
    </div>
    <div class="card-body">
        <h5 class="card-title">{{ $product->name }}</h5>
        <p class="card-price text-success">Price: {{ $product->price }} Rs</p>
        <div class="d-flex justify-content-center gap-1">
            <a href="{{route($role.'.artwork',$product->id)}}" class="btn btn-primary">View Artwork</a>
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
