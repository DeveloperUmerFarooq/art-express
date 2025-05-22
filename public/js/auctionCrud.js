function edit(data){
    $("#auction-id").val(data.id);
    $("#auction-title").val(data.title);
    $("#auction-description").val(data.description);
}
function deleteAuction(url){
    Swal.fire({
        title: "Delete Selected!",
        text:"Are you sure you want to delete this auction?",
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
            toastr.info('Auction deletion stopped!')
        }
      });
}

function openRegister(id){
    $('#auction_id').val(id);
}
