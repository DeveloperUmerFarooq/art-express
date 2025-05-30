function editItem(data){
    $('#itemImage').attr('src',data.image)
    $('#item-name').val(data.name)
    $('#item-description').val(data.description)
    $('#item-starting-bid').val(data.starting_bid)
    $('#item-id').val(data.id)
}
function updatePreview(e){
    let input=e.target;
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(event) {
            $('#itemImage').attr('src',event.target.result)
        };
        reader.readAsDataURL(input.files[0]);
    }

    const image=new FileReader();

    console.log(e.target.value);
}

function deleteItem(url){
    console.log(url);
    Swal.fire({
        title: "Delete Selected!",
        text:"Are you sure you want to delete this item?",
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
            toastr.info('Item deletion stopped!')
        }
      });
}
