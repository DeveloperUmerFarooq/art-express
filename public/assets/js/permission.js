function deletePermission(id){
    Swal.fire({
        title: "Delete Selected!",
        text:"Are you sure you want to delete this permission?",
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
            window.location.href=`/admin/permission/delete/${id}`
        } else if (result.isDenied) {
            toastr.info('Permission deletion stopped!')
        }
      });
}
function editPermission(user){
    $('#permission-id').val(user['id'])
    $('#name').val(user['name'])
}
function CheckPermissions(permissions, id) {
    $('#role-id').val(id);
    const permissionNames = new Set(permissions.map(permission => permission.name));
    $('.permission-check').each(function () {
        $(this).prop('checked', permissionNames.has($(this).val()));
    });
}

