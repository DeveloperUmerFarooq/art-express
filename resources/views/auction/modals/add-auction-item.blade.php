<!-- Add Item Modal -->
<div class="modal fade" id="addItemModal" tabindex="-1" aria-labelledby="addItemModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form method="POST" action="{{ route($role . '.item.store') }}" enctype="multipart/form-data">
      @csrf
      <div class="modal-content">
        <div class="modal-header bg-success">
          <h5 class="modal-title text-light" id="addItemModalLabel">Add New Item</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <input type="hidden" name="auction_id" value="{{$id}}">
          {{-- Item Name --}}
          <div class="mb-3">
            <label class="form-label">Item Name</label>
            <input type="text" name="name" class="form-control" placeholder="Enter item name" required>
            @error('name')
                <p class="text-danger ms-1">{{$message}}</p>
            @enderror
          </div>

          {{-- Description --}}
          <div class="mb-3">
            <label class="form-label">Item Description</label>
            <textarea name="description" class="form-control" rows="2" placeholder="Enter description"></textarea>
            @error('description')
                <p class="text-danger ms-1">{{$message}}</p>
            @enderror
          </div>

          {{-- Starting Bid --}}
          <div class="mb-3">
            <label class="form-label">Starting Bid (PKR)</label>
            <input type="number" name="starting_bid" step="1" min="1" class="form-control" required placeholder="Enter starting bid">
            @error('starting_bid')
                <p class="text-danger ms-1">{{$message}}</p>
            @enderror
          </div>

          {{-- Item Image --}}
            <div class="mb-3">
              <label class="form-label">Item Image</label>
              <input type="file" name="image" class="form-control" required>
              @error('image')
                <p class="text-danger ms-1">{{$message}}</p>
            @enderror
            </div>
        </div>


        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Add Item</button>
        </div>
      </div>
    </form>
  </div>
</div>
