    @extends('layouts.' . $role . 'Layout.layout')
    @section('title')
        Checkout | Art-Express
    @endsection
    @section('page')
        <div class="py-5">
            <div class="container bg-light shadow mx-auto p-5 d-flex flex-column gap-2">
                <div class="d-flex flex-column align-items-center">
                    <img src="{{ $item->image }}" class="object-fit-contain w-25" alt="">
                    <div class="info text-center">
                        <h1>{{ $item->name }}</h1>
                        <h3 class="bg-success text-light w-auto d-inline p-2 rounded-4">Rs
                            {{ number_format($item->current_bid, 0) }}</h3>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <div class="text-center w-50">
                        <label class="form-label fw-bolder fs-2">Card Details</label>
                        <div id="card-element" class="form-control py-3 mb-3"></div>
                        <button class="btn btn-success btn-lg" onclick="generateToken()">Pay Now</button>
                    </div>
                </div>
                <form action="{{ route('item.checkout') }}" method="POST" id="payment-form">
                    @csrf
                    <input type="hidden" name="stripeToken" id="stripe-token">
                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                </form>
            </div>
        </div>
    @endsection
    @push('scripts')
        <script>
            var elements = stripe.elements();
            var cardElement = elements.create('card');
            cardElement.mount("#card-element");
            function generateToken() {
                stripe.createToken(cardElement).then(function(result) {
                    if (result.token) {
                        $('#stripe-token').val(result.token.id);
                        document.getElementById('payment-form').submit()
                    }
                })
            }
        </script>
    @endpush
