<div class="modal fade" id="customRequestModal" tabindex="-1" aria-labelledby="customRequestModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form method="GET" action="{{route('artist.custom.request.index')}}">
        @csrf
        <div class="modal-content">
          <div class="modal-header bg-success">
            <h5 class="modal-title text-light">How many items?</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <input type="email" name="user_email" class="form-control validate mb-3" placeholder="Enter Customer Email" required>
            <input type="number" name="item_count" min="1" class="form-control" required placeholder="Enter number of items">
          </div>
          <div class="d-flex align-items-center justify-content-center mb-3">
              <button type="submit" class="btn btn-success">Continue</button>
          </div>
        </div>
      </form>
    </div>
  </div>
