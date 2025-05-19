@extends('layouts.' . $role . 'Layout.layout')

@section('page')
    <div class="container pt-3">
        <h3 class="mb-4"><i class="fas fa-gavel"></i> Create Auction</h3>

        <form action="{{ route($role . '.auction.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Auction Details --}}
            <div class="card mb-4">
                <div class="card-header bg-success text-white">Auction Details</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Auction Title</label>
                        <input type="text" name="title" class="form-control" placeholder="Enter auction title"
                            required>
                        @error('title')
                            <p class="ms-1 text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="3" placeholder="Enter auction description (optional)"></textarea>
                        @error('description')
                            <p class="ms-1 text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Start Date</label>
                            <input type="date" name="start_date" class="form-control" required>
                            @error('start_date')
                                <p class="ms-1 text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Start Time</label>
                            <input type="time" name="start_time" class="form-control" required>
                            @error('start_time')
                                <p class="ms-1 text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">End Time</label>
                            <input type="time" name="end_time" class="form-control" required>
                            @error('end_time')
                                <p class="ms-1 text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- Auction Items --}}
            <div class="card mb-4">
                <div class="card-header bg-dark text-white">Auction Items ({{ $itemCount }})</div>
                <div class="card-body">
                    @for ($i = 0; $i < $itemCount; $i++)
                        <div class="border p-3 mb-3 rounded">
                            <h5>Item {{ $i + 1 }}</h5>

                            {{-- Item Image --}}
                            <div class="mb-3">
                                <label class="form-label">Item Image</label>
                                <input type="file" name="items[{{ $i }}][image]" class="form-control"
                                    required>
                                @error("items.$i.image")
                                    <p class="ms-1 text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Item Name --}}
                            <div class="mb-3">
                                <label class="form-label">Item Name</label>
                                <input type="text" name="items[{{ $i }}][name]" class="form-control"
                                    placeholder="Enter item name" required>
                                @error("items.$i.name")
                                    <p class="ms-1 text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Item Description --}}
                            <div class="mb-3">
                                <label class="form-label">Item Description</label>
                                <textarea name="items[{{ $i }}][description]" class="form-control" rows="2"
                                    placeholder="Enter item description (optional)"></textarea>
                                @error("items.$i.description")
                                    <p class="ms-1 text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Starting Bid --}}
                            <div class="mb-3">
                                <label class="form-label">Starting Bid (PKR)</label>
                                <input type="number" name="items[{{ $i }}][starting_bid]" step="0.01"
                                    min="0" class="form-control" placeholder="Enter starting bid amount" required>
                                @error("items.$i.starting_bid")
                                    <p class="ms-1 text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    @endfor

                </div>
            </div>

            <div class="text-end">
                <button class="btn btn-primary"><i class="fas fa-save me-1"></i> Submit Auction</button>
            </div>
        </form>
    </div>
@endsection
