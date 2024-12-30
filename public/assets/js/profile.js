$(document).ready(function(){
    $("#edit-details").on('click',(e)=>{
        e.preventDefault();
        $('#profile input,textarea').each(function(){
            $(this).prop('disabled',!$(this).prop('disabled'));
            $('#profile-submit').toggleClass('d-none');
        })
    })
    $('#password-show').on('change',function(){
        let toggleType = $(this).is(':checked') ? 'text' : 'password';
        $("input[type='password'], input[type='text']").each(function(){
            $(this).attr('type',toggleType)
        })
    })
})
