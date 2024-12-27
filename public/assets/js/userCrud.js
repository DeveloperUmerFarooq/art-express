const pass=document.getElementById('password');
const confirmPass= document.getElementById('confirm-password');
const toggle=document.getElementById('password-show')
toggle.addEventListener('change',()=>{
    pass.type=toggle.checked?'text':'password'
    confirmPass.type=toggle.checked?'text':'password'
})
function addArtist(){
    const formData = {
        _token: $('meta[name="csrf-token"]').attr('content'),
        name:$('#name').val(),
        email:$('#email').val(),
        password:$('#name').val(),
        password_confirmation:$('#confirm-password').val(),
    };
    $('#Add-Artist').modal('hide');
    $.ajax({
        type: "POST",
        url: "/admin/add/artist",
        data: formData,
        success: function (response) {
            $('#artists-table').DataTable().ajax.reload();
            Swal.fire({
                title: 'Error!',
                text: 'Do you want to continue',
                icon: 'error',
                confirmButtonText: 'Cool'
              })
        },
        error: function (xhr, status, error) {
            console.error("Error:", xhr.responseText);
            alert("Failed to add artist. Check console for details.");
        }
    });
}
