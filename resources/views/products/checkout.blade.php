@extends('layouts.' . $role . 'Layout.layout')

@section('page')
    <form action="" method="POST" id="checkout-form">
        <input type="hidden" name="stripeToken" id="stripe-token">
        @csrf
    </form>
    <div id="card-element" class="form-control">

    </div>

    <button onclick="createToken()">Submit</button>
@endsection
@push('scripts')
    <script src="{{ asset('js/checkout.js') }}"></script>
@endpush
