function editPost(post){
    $('#editTitle').val(post.title);
    $('#editContent').val(post.content)
    console.log(post);
}

function deletePost(url){
    Swal.fire({
        title: "Delete Selected!",
        text:"Are you sure you want to delete this Blog?",
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
            toastr.info('Blog deletion stopped!')
        }
      });
}
