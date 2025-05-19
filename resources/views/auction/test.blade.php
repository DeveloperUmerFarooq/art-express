@extends('layouts.' . $role . 'Layout.layout')
@section('title')
    Auctions | Art-Express
@endsection
@section('page')
<div class="container-fluid pt-4 px-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
    <h2><i class="fas fa-gavel"></i> Auctions</h2>

    @if ($role !== 'user')
        <button class="btn btn-success btn-sm text-light" data-bs-toggle="modal" data-bs-target="#addAuctionModal">
            <i class="fas fa-plus me-1"></i> Create Auction
        </button>
    @endif
</div>

@if ($count<1)
<div class="card shadow-sm mt-2 container" style="height: max-content !important">
    <div class="card-body text-center">
        <h5 class="card-title">No Auctions Added</h5>
        <p class="card-text">It looks like there are no auctions avaialable currently!</p>
    </div>
</div>
@else

@endif
</div>
@include('auction.modals.add-auction')
@endsection
