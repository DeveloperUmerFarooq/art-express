
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
