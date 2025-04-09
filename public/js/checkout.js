var elements=stripe.elements();
    var cardElement=elements.create('card');
    cardElement.mount("#card-element");
    function createToken(){
        const selectedPayment = document.querySelector('input[name="paymentMethod"]:checked').value;
        if (selectedPayment === 'card') {
        stripe.createToken(cardElement).then(function(result){
            if(result.token){
                $('#stripe-token').val(result.token.id);
                document.getElementById('checkout-form').submit()
            }
        })
    }else{
        document.getElementById('checkout-form').submit()
    }
    }
