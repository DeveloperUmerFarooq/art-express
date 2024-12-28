document.getElementById('password-show').addEventListener('change',showPass)
function showPass(){
    let toggle=document.getElementById('password-show')
    let pass=document.getElementById('password');
    let confirmPass= document.getElementById('confirm-password');
    pass.type=toggle.checked?'text':'password'
    confirmPass.type=toggle.checked?'text':'password'
}
function deleteUser(id,e){
    Swal.fire({
        title: "Do you want to delete the artist?",
        showDenyButton: true,
        icon:'question',
        confirmButtonText: "Yes",
        confirmButtonColor:"green",
        denyButtonText: `No`
      }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = `/admin/delete/${id}`;
        } else if (result.isDenied) {

        }
      });
}

function editUser(user){
    $('#img').attr('src',user['profile']['profile_image'])
    $('#id').val(user['id'])
    $('#Name').val(user['name'])
    $('#Email').val(user['email'])
}
