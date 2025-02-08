  <div class="modal fade" id="buyProductModal" tabindex="-1" aria-labelledby="buyProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="buyProductModalLabel">Buy Product</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="buyProductForm" action="" method="POST">
            @csrf

            <input type="hidden" id="product_id" name="product_id">
            <input type="hidden" class="form-control" id="customer_id" name="customer_id" value="{{auth()->user()->id}}">
            <input type="hidden" class="form-control" id="artist_id" name="artist_id">


            <div class="mb-3">
              <label for="order_date" class="form-label">Confirm Your Address</label>
              <textarea rows="4" class="form-control" id="address" placeholder="address" name="address" required>{{old('address',auth()->user()->profile->address)}}</textarea>
            </div>

            <div class="mb-3">
                <label for="paymentMethod" class="form-label">Choose your payment method</label>
                <select class="form-select" id="paymentMethod" name="paymentMethod" required>
                    <option selected disabled>Choose...</option>
                    <option value="cashOnDelivery">Cash on Delivery</option>
                </select>
            </div>

          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" form="buyProductForm" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </div>
  </div>
