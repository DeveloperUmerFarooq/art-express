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
