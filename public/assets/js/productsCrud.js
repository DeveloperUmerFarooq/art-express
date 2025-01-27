document.addEventListener('DOMContentLoaded', function () {
    let categorySelect = document.getElementById('product-category');
    let subcategoryContainer = document.getElementById('product-subcategoryContainer');
    let subcategorySelect = document.getElementById('product-subcategory');
    categorySelect.addEventListener('change', function () {
        let categoryId = this.value;
        if (categoryId) {
            fetch(`/artist/categories/${categoryId}/subcategories`)
                .then(response => response.json())
                .then(data => {
                    subcategoryContainer.classList.remove('d-none');
                    subcategorySelect.innerHTML = '<option value="">Select a Subcategory</option>';
                    data.forEach(subcategory => {
                        subcategorySelect.innerHTML += `<option value="${subcategory.id}">${subcategory.name}</option>`;
                    });
                });
        } else {
            subcategoryContainer.classList.add('d-none');
            subcategorySelect.innerHTML = '<option value="">Select a Subcategory</option>';
        }
    });

})

function edit(product,src){
    $('#productImage').attr('src',src)
    $('#product-title').val(product.name)
    $('#product-description').val(product.description)
    $('#product-price').val(product.price)
    $('#product-id').val(product.id)
    console.log(product,src);
}
