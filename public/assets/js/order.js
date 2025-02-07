function buy(product){
    $('#product_id').val(product.id);
    $('#artist_id').val(product.artist.id);
    console.log(product.artist.id)
}
