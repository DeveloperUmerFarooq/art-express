<!-- Add Item Modal -->
<div class="modal fade" id="editItemModal" tabindex="-1" aria-labelledby="editItemModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form method="POST" action="{{ route($role . '.item.update') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="item_id" id="item-id">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title text-light" id="editItemModalLabel">
                        <i class="fas fa-edit me-2 text-warning"></i>Edit Item
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-4 text-center">
                        <div class="shadow-sm border rounded-3 p-2 d-inline-block">
                            <img loading="lazy" src="" id="itemImage" width="200" class="img-fluid rounded" alt="Item Image">
                        </div>
                    </div>
                    {{-- Item Name --}}
                    <div class="mb-3">
                        <label class="form-label">Item Name</label>
                        <input type="text" id="item-name" name="name" class="form-control" placeholder="Enter item name"
                            required>
                        @error('name')
                            <p class="text-danger ms-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Description --}}
                    <div class="mb-3">
                        <label class="form-label">Item Description</label>
                        <textarea name="description" id="item-description" class="form-control" rows="2" placeholder="Enter description"></textarea>
                        @error('description')
                            <p class="text-danger ms-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Starting Bid --}}
                    <div class="mb-3">
                        <label class="form-label">Starting Bid (PKR)</label>
                        <input type="number" name="starting_bid" step="1" min="1" class="form-control"
                            required placeholder="Enter starting bid" id="item-starting-bid">
                        @error('starting_bid')
                            <p class="text-danger ms-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Item Image --}}
                    <div class="mb-3">
                        <label class="form-label">Item Image</label>
                        <input type="file" name="image"
                        onchange="updatePreview(event)"
                        class="form-control">
                        @error('image')
                            <p class="text-danger ms-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>


                <div class="modal-footer px-4 py-3 justify-content-center">
                    <button type="submit" class="btn btn-warning px-4 py-2 fw-semibold">
                        <i class="fas fa-save me-2"></i>Update Item
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
