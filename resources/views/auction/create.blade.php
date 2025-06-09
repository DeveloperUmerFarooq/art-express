@extends('layouts.' . $role . 'Layout.layout')
@section('title')
    Create Auctions | Art-Express
@endsection
@section('page')
    <div class="container py-3">
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
                            required value="{{ old('title') }}">
                        @error('title')
                            <p class="ms-1 text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="3" placeholder="Enter auction description (optional)">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="ms-1 text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Start Date</label>
                            <input type="date" name="start_date" class="form-control" required
                                value="{{ old('start_date') }}">
                            @error('start_date')
                                <p class="ms-1 text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Start Time</label>
                            <input type="time" name="start_time" class="form-control" required
                                value="{{ old('start_time') }}">
                            @error('start_time')
                                <p class="ms-1 text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">End Time</label>
                            <input type="time" name="end_time" class="form-control" required
                                value="{{ old('end_time') }}">
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

                            {{-- Item Image with Preview --}}
                            <div class="mb-3">
                                <label class="form-label">Item Image</label>
                                <input type="file" name="items[{{ $i }}][image]"
                                       class="form-control item-image-input"
                                       data-preview-target="item-preview-{{ $i }}"
                                       required>

                                {{-- Image Preview Container --}}
                                <div class="mt-2 text-center">
                                    <img id="item-preview-{{ $i }}"
                                         src="https://via.placeholder.com/200x150?text=No+Image+Selected"
                                         alt="Item Preview"
                                         class="img-thumbnail"
                                         style="max-width: 200px; max-height: 150px; display: block; margin: 0 auto;">
                                </div>

                                @error("items.$i.image")
                                    <p class="ms-1 text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Item Name --}}
                            <div class="mb-3">
                                <label class="form-label">Item Name</label>
                                <input type="text" name="items[{{ $i }}][name]" class="form-control"
                                    placeholder="Enter item name" required value="{{ old("items.$i.name") }}">
                                @error("items.$i.name")
                                    <p class="ms-1 text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Item Description --}}
                            <div class="mb-3">
                                <label class="form-label">Item Description</label>
                                <textarea name="items[{{ $i }}][description]" class="form-control" rows="2"
                                    placeholder="Enter item description (optional)">{{ old("items.$i.description") }}</textarea>
                                @error("items.$i.description")
                                    <p class="ms-1 text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Starting Bid --}}
                            <div class="mb-3">
                                <label class="form-label">Starting Bid (PKR)</label>
                                <input type="number" name="items[{{ $i }}][starting_bid]" step="0.01" min="0"
                                    class="form-control" placeholder="Enter starting bid amount" required
                                    value="{{ old("items.$i.starting_bid") }}">
                                @error("items.$i.starting_bid")
                                    <p class="ms-1 text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    @endfor
                </div>
            </div>

            <div class="text-center">
                <button class="btn btn-primary"><i class="fas fa-save me-1"></i> Submit Auction</button>
            </div>
        </form>
    </div>

@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.item-image-input').forEach(input => {
                input.addEventListener('change', function(e) {
                    const previewId = this.getAttribute('data-preview-target');
                    const previewElement = document.getElementById(previewId);

                    if (this.files && this.files[0]) {
                        const reader = new FileReader();

                        reader.onload = function(e) {
                            previewElement.src = e.target.result;
                        }

                        reader.readAsDataURL(this.files[0]);
                    }
                });
            });
        });
    </script>
@endpush
