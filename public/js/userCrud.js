$(document).ready(function(){
    $('#show-password,#password-show').each(function(){
        $(this).on('change',showPass)
    })
})
function showPass(){
    let toggleType = $(this).is(':checked') ? 'text' : 'password';
    $(".password").each(function(){
        $(this).attr('type',toggleType)
    })
}
function reloadDataTable(){
    $('#user-table').DataTable().ajax.reload();
}

function deleteUser(url){
    Swal.fire({
        title: "Delete Selected!",
        text:"Are you sure you want to delete this user?",
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
            toastr.info('User deletion stopped!')
        }
      });
}

function editUser(user){
    $('#img').attr('src',userAvatarUrl+'/'+user['avatar'])
    $('#id').val(user['id'])
    $('#Name').val(user['name'])
    $('#Email').val(user['email'])
}
 function preview(event){
    const file=event.target.files[0];
    if(file){
        const reader=new FileReader();
        reader.onload=function(e){
            $('#img').attr('src',e.target.result);
        }
        reader.readAsDataURL(file);
    }
 }
