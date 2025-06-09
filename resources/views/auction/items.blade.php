@php
    use Carbon\Carbon;
    $auction = $items[0]->auction;
    $startDate = Carbon::parse($auction->start_date);
@endphp

@extends('layouts.' . $role . 'Layout.layout')
@section('title')
    Auction Items | Art-Express
@endsection

@section('page')
    <div class="container-fluid py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="d-flex align-items-center gap-2">
                <h1 class="h2 font-weight-bold text-dark mb-1">
                    <i class="fas fa-gavel me-2 text-primary"></i> Auction Items
                </h1>
                @if ($auction->status === 'ongoing')
                    <div class="bg-danger rounded-circle" title="Live" style="width: 10px; height: 10px; cursor:pointer">
                    </div>
                @endif
            </div>

            @if ($auction->host_id === auth()->id())
                @if ($auction->status === 'ongoing')
                    <a href="{{ route($role . '.auction.end', $auction->id) }}">
                        <button class="btn btn-danger btn-sm shadow-sm">
                            <i class="fas fa-gavel me-2"></i> End Auction
                        </button>
                    </a>
                @else
                    <button class="btn btn-success btn-sm shadow-sm" data-bs-toggle="modal" data-bs-target="#addItemModal">
                        <i class="fas fa-plus me-2"></i> Add New Item
                    </button>
                @endif
            @endif
        </div>

        @if (count($items) > 0)
            <div class="row g-4">
                @foreach ($items as $item)
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="card h-100 border-0 shadow-sm overflow-hidden hover-shadow-lg transition-all">
                            <div class="card-header bg-white border-0 p-0 position-relative">
                                @if ($startDate->toDateString() > now()->toDateString() && $auction->host_id === auth()->id())
                                    <button onclick="deleteItem('{{ route($role . '.item.delete', $item->id) }}')"
                                        class="btn btn-danger btn-sm position-absolute top-2 end-2 z-3 shadow-sm"
                                        title="Delete Item" style="width: 30px; height: 30px">
                                        <i class="fas fa-times"></i>
                                    </button>
                                @endif
                                <!-- Item Image -->
                                <div class="position-relative" style="height: 220px; overflow: hidden;">
                                    <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}"
                                        class="img-fluid w-100 h-100 object-fit-contain" data-bs-toggle="modal"
                                        data-bs-target="#imageModal" data-image-url="{{ $item['image'] }}"
                                        style="background-color: var(--secondary)">



                                    <!-- Bid Count Badge -->
                                    <span
                                        class="position-absolute bottom-2 start-2 bg-dark text-white small fw-bold px-2 py-1 rounded">
                                        <i class="fas fa-gavel me-1"></i> {{ $item->bids_count ?? 0 }} Bids
                                    </span>
                                </div>
                            </div>

                            <!-- Card Body -->
                            <div class="card-body d-flex flex-column">
                                <h3 class="h5 card-title font-weight-bold text-dark mb-2">
                                    <i class="fas fa-image me-2 text-secondary"></i> {{ $item['name'] }}
                                </h3>

                                <p class="card-text text-muted mb-3 flex-grow-1">
                                    <i
                                        class="fas fa-align-left me-2 text-secondary"></i>{{ Str::limit($item['description'], 120) }}
                                </p>

                                <!-- Bid Information -->
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <small class="text-muted d-block">
                                            <i class="fas fa-flag me-1"></i> Starting Bid
                                        </small>
                                        <span class="h5 font-weight-bold text-success">
                                            {{ number_format($item['starting_bid'], 0) }} Rs
                                        </span>
                                    </div>
                                    <div class="text-end">
                                        <small class="text-muted d-block">
                                            <i class="fas fa-trophy me-1"></i> Current Bid
                                        </small>
                                        <span
                                            class="h5 font-weight-bold {{ $item['current_bid'] ? 'text-success' : 'text-secondary' }}"
                                            id="current-bid-{{ $item->id }}">
                                            @if ($item['current_bid'])
                                                {{ number_format($item['current_bid'], 0) }} Rs
                                            @else
                                                <span class="badge bg-light text-dark">No bids yet</span>
                                            @endif
                                        </span>
                                    </div>
                                </div>

                                <!-- Bid Form -->
                                @if (Request::is('*/participate*'))
                                    <form action="{{ route('bid.place', $item['id']) }}" id="bid-form-{{ $item->id }}"
                                        method="POST" class="mb-3">
                                        @csrf
                                        <div class="input-group">
                                            <span class="input-group-text bg-light">Rs</span>
                                            <input type="hidden" name="user_id" id="user_id"
                                                value="{{ auth()->id() }}">
                                            <input type="number" name="bid_amount" id="bid_input-{{ $item->id }}"
                                                class="form-control"
                                                min="{{ $item['current_bid'] ? $item['current_bid'] + 1 : $item['starting_bid'] + 1 }}"
                                                value="{{ $item['current_bid'] ?? $item['starting_bid'] + 1 }}"
                                                placeholder="Your bid amount" required>
                                        </div>
                                    </form>
                                @endif

                                <!-- Action Buttons -->
                                <div class="d-flex gap-2 mt-auto">
                                    @if (Request::is('*/participate'))
                                        <button
                                            class="btn btn-success flex-grow-1 shadow-sm place-bid d-flex align-items-center justify-content-center gap-2"
                                            onclick="placeBid('{{ route('bid.place', $item['id']) }}', event, {{ $item->id }},{{ $item->id }})">
                                            <i class="fas fa-gavel me-1"></i>
                                            <span>Place Bid</span>
                                            <div id="spinner-{{ $item->id }}" class="spinner-grow text-light d-none"
                                                role="status" style="width:1rem;height:1rem">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                        </button>

                                        </button>
                                    @endif
                                    @if ($item->auction->host_id === auth()->id() && $startDate->toDateString() > now()->toDateString())
                                        <button class="btn btn-outline-warning flex-grow-1" data-bs-toggle="modal"
                                            data-bs-target="#editItemModal" onclick="editItem({{ $item }})">
                                            <i class="fas fa-edit me-2"></i> Edit Item
                                        </button>
                                    @endif
                                </div>
                                @if ($item->auction->status==='ended')
                                <div class="mt-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="badge bg-success">
                                            {{ $item->status }}
                                        </span>
                                        <small class="text-muted" title="{{$item->winner->email}}">
                                            <i class="fas fa-crown text-warning me-1"></i>
                                            Winner: {{ $item->winner->name }}
                                        </small>
                                    </div>
                                </div>
                                @endif
                            </div>


                            <!-- Card Footer -->
                            <div class="card-footer bg-white border-0 pt-0">
                                <small class="text-muted">
                                    <i class="fas fa-calendar-alt me-1"></i>
                                    Added on {{ $item->created_at->format('M d, Y') }}
                                </small>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-5 my-5">
                <div class="mb-4">
                    <i class="fas fa-box-open fa-4x text-light" style="font-size: 5rem;"></i>
                </div>
                <h3 class="h4 font-weight-bold text-dark mb-3">No Auction Items Available</h3>
                <p class="text-muted mb-4">There are currently no items listed for auction.</p>
                <button class="btn btn-primary px-4">
                    <i class="fas fa-plus me-2"></i> Create New Auction
                </button>
            </div>
        @endif
    </div>
    @if ($role !== 'user')
        @include('auction.modals.add-auction-item')
        @include('auction.modals.edit-auction-item')
    @endif
    @include('auction.modals.image-preview')
@endsection
@push('scripts')
    <script src="{{ asset('js/auctionItems.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modalImage = document.getElementById('modalImage');
            document.querySelectorAll('[data-bs-target="#imageModal"]').forEach(button => {
                button.addEventListener('click', function() {
                    modalImage.src = this.getAttribute('data-image-url');
                    modalImage.alt = this.alt;
                });
            });
        });
        const auction_id = {{ $auction->id }};
        const bidChannel = pusher.subscribe('bid.' + auction_id);
        bidChannel.bind('bid.update', function(data) {
            $(`#current-bid-${data.item_id}`).text(`${parseFloat(data.amount).toFixed(0)} Rs`)
                .removeClass('text-secondary')
                .addClass('text-success');
        })
        const endAuction = pusher.subscribe('auction.' + auction_id);
        endAuction.bind('AuctionEnded', function(data) {
            Swal.fire({
                icon: 'info',
                title: 'Auction Ended',
                text: data.message,
                timer: 5000,
                confirmButtonText: 'Go to Auctions'
            }).then(() => {
                window.location.href = "{{ route('auction') }}";
            });
        })
    </script>
    <script src="{{ asset('js/bidding.js') }}"></script>
@endpush
