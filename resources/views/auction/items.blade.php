@extends('layouts.' . $role . 'Layout.layout')
@section('title')
    Auction Items | Art-Express
@endsection
@section('page')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <h1 class="h2 font-weight-bold text-dark">
            <i class="fas fa-gavel mr-2"></i>Auction Items
        </h1>
        @if($role === 'admin' || $items[0]->auction->host_id===auth()->id())
         <button class="btn btn-success btn-sm text-light">
                    <i class="fas fa-plus me-1"></i> Add Item
                </button>
        @endif
    </div>

    @if(count($items) > 0)
    <div class="row">
        @foreach($items as $item)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100 shadow-sm hover-shadow-lg transition">
                <div class="position-relative" style="height: 250px; overflow: hidden;">
                    <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="card-img-top h-100 w-100 object-fit-cover">
                    <span class="position-absolute top-0 end-0 bg-danger text-white small fw-bold px-2 py-1 rounded m-2">
                        <i class="fas fa-bolt mr-1"></i>Live
                    </span>
                </div>
                <div class="card-body">
                    <h3 class="h5 card-title font-weight-bold text-dark">
                        <i class="fas fa-image mr-2 text-secondary"></i> {{ $item['name'] }}
                    </h3>
                    <p class="card-text text-muted mb-3">
                        <i class="fas fa-align-left mr-2 text-secondary"></i> {{ Str::limit($item['description'], 100) }}
                    </p>

                    <div class="d-flex justify-content-between mb-3">
                        <div>
                            <small class="text-muted d-block">
                                <i class="fas fa-flag mr-1"></i> Starting Bid
                            </small>
                            <span class="h5 font-weight-bold text-success">
                                <i class="fas fa-dollar-sign mr-1"></i>{{ number_format($item['starting_bid'], 2) }}
                            </span>
                        </div>
                        <div class="text-end">
                            <small class="text-muted d-block">
                                <i class="fas fa-trophy mr-1"></i> Current Bid
                            </small>
                            <span class="h5 font-weight-bold {{ $item['current_bid'] ? 'text-success' : 'text-secondary' }}">
                                @if($item['current_bid'])
                                    <i class="fas fa-dollar-sign mr-1"></i>{{ number_format($item['current_bid'], 2) }}
                                @else
                                    <i class="fas fa-times-circle mr-1"></i> No bids
                                @endif
                            </span>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button class="btn btn-primary flex-grow-1">
                            <i class="fas fa-eye mr-2"></i>View Details
                        </button>
                        @if($role === 'admin'|| $item->auction->host_id===auth()->id())
                        <button class="btn btn-warning text-white">
                            <i class="fas fa-edit mr-1"></i>Edit
                        </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="text-center py-5">
        <i class="fas fa-box-open fa-4x text-muted mb-4"></i>
        <h3 class="h4 font-weight-bold text-dark">No auction items found</h3>
        <p class="text-muted mb-4">There are currently no items available for auction.</p>
        @if($role === 'admin')
        <button class="btn btn-primary">
            <i class="fas fa-plus mr-2"></i>Add New Item
        </button>
        @endif
    </div>
    @endif
</div>
@endsection
