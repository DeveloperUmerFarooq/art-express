@extends('layouts.' . $role . 'Layout.layout')

@section('page')
    <input type="hidden" name="stripeToken" id="stripe-token">
    <div id="card-element" class="form-control">

    </div>

    <button onclick="createToken()">Submit</button>
@endsection
@push('scripts')
<script>
    var elements=stripe.elements();
    var cardElement=elements.create('card');
    cardElement.mount("#card-element");
    function createToken(){
        stripe.createToken(cardElement).then(function(result){
            if(result.token){
                $('#stripe-token').val(result.token.id);
                console.log(result)
            }
        })
    }
</script>
@endpush
