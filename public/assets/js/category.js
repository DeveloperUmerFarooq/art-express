$(document).ready(function(){
    $('#sub-category-count').on('change',function(){
        let count= $(this).val()
        let container=$('#subcategory')
        container.empty();
        if(count>0){
            for(let i=0;i<count;i++){
                container.append(`
                    <div class="mb-3">
                        <label for="subcategory-${i + 1}" class="form-label">Subcategory Name ${i + 1}:</label>
                        <input type="text" name="subcategories[]" id="subcategory-${i + 1}" class="form-control shadow validate" placeholder="Subcategory Name ${i + 1}" required>
                    </div>
                `);
            }
        }
    })
})

function deleteCategory(url){
    Swal.fire({
        title: "Delete Selected!",
        text:"Are you sure you want to delete this category?",
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
            toastr.info('Category deletion stopped!')
        }
      });
}

function deleteSub(url){
    Swal.fire({
        title: "Delete Selected!",
        text:"Are you sure you want to delete this sub-category?",
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
            toastr.info('Sub-Category deletion stopped!')
        }
      });
}

function editCategory(category){
    $('#category-id').val(category['id'])
    $('#name').val(category['name'])
}

function editSub(subcategory){
    $('#sub-category-id').val(subcategory['id'])
    $('#Name').val(subcategory['name'])
}
