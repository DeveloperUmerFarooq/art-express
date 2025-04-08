@extends('layouts.' . $role . 'Layout.layout')

@section('page')
    <input type="hidden" name="stripeToken" id="stripe-token">
    <div id="card-element" class="form-control">

    </div>

    <button onclick="createToken()">Submit</button>
@endsection
@push('scripts')
<script src="{{asset('js/checkout.js')}}"></script>
@endpush
