document.getElementById('password-show').addEventListener('change',showPass)
function showPass(){
    let toggle=document.getElementById('password-show')
    let pass=document.getElementById('password');
    let confirmPass= document.getElementById('confirm-password');
    pass.type=toggle.checked?'text':'password'
    confirmPass.type=toggle.checked?'text':'password'
}
function reloadDataTable(){
    $('#user-table').DataTable().ajax.reload();
}

function deleteUser(id){
    Swal.fire({
        title: "Delete Selected!",
        text:"Are you sure you want to delete this user?",
        showDenyButton: true,
        icon:'question',
        confirmButtonText: "Yes",
        confirmButtonColor:"green",
        denyButtonText: `No`
      }).then((result) => {
        if (result.isConfirmed) {
            window.location.href=`/admin/delete/${id}`
        } else if (result.isDenied) {
            toastr.info('User deletion stopped!')
        }
      });
}

function editUser(user){
    $('#img').attr('src',user['profile']['profile_image'])
    $('#id').val(user['id'])
    $('#Name').val(user['name'])
    $('#Email').val(user['email'])
}
