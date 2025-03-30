document.addEventListener('DOMContentLoaded', function () {
    let categorySelect = document.getElementById('product-category');
    let subcategoryContainer = document.getElementById('product-subcategoryContainer');
    let subcategorySelect = document.getElementById('product-subcategory');
    if(categorySelect){
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
    }

})

function edit(product,src){
    $('#productImage').attr('src',src)
    $('#product-title').val(product.name)
    $('#product-description').val(product.description)
    $('#product-price').val(product.price)
    $('#product-id').val(product.id)
}

function deleteProduct(url){
    Swal.fire({
        title: "Delete Selected!",
        text:"Are you sure you want to delete this product?",
        showDenyButton: true,
        icon:'question',
        confirmButtonText: "Yes",
        confirmButtonColor:"green",
        denyButtonText: `No`,
        customClass: {
            popup: 'custom-popup'
          }
      }).then((result) => {
        if (result.isConfirmed) {
            window.location.href=`${url}`
        } else if (result.isDenied) {
            toastr.info('Product deletion stopped!')
        }
      });
}

function addPost(id){
    $('#productId').val(id);
    console.log($('#productId').val());
}

function preview(event){
    const file=event.target.files[0];
    if(file){
        const reader=new FileReader();
        reader.onload=function(e){
            $('#productImage').attr('src',e.target.result);
        }
        reader.readAsDataURL(file);
    }
}
