<div class="modal fade" id="registerAuctionModal" tabindex="-1" aria-labelledby="registerAuctionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form method="POST" id="checkout-form" action="" onsubmit="register(event)">
        @csrf
        <div class="modal-content">
          <div class="modal-header bg-success">
            <h5 class="modal-title text-light">Enter Your Card Details:</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div id="card-element" class="form-control py-2 mb-3"></div>
          </div>
          <div class="d-flex align-items-center justify-content-between mx-2 mb-3">
            <input type="hidden" name="stripe_token" id="stripe-token">
            <span>Note: <span class="text-danger">The registeration will cost 2000PKR</span></span>
              <button type="submit" class="btn btn-success">Continue</button>
          </div>
        </div>
      </form>
    </div>
  </div>
@push('scripts')
  <script>
    var elements=stripe.elements();
    var cardElement=elements.create('card');
    cardElement.mount("#card-element");
    function register(event){
        event.preventDefault();
        stripe.createToken(cardElement).then(function(result){
            if(result.token){
                $('#stripe-token').val(result.token.id);
                document.getElementById('checkout-form').submit()
            }
        })
    }
  </script>
@endpush
