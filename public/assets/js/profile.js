$(document).ready(function(){
    $('#profile-submit').hide();
    $('#cancel').hide();
    $("#edit-details").on('click',(e)=>{
        e.preventDefault();
        $('#profile input,textarea').each(function(){
            $(this).prop('disabled',!$(this).prop('disabled'));
            $('#profile-submit').show();
            $('#cancel').show();
        })
    })
    $('#password-show').on('change',function(){
        let toggleType = $(this).is(':checked') ? 'text' : 'password';
        $(".password").each(function(){
            $(this).attr('type',toggleType)
        })
    })
    $('#cancel').on('click',function(e){
        e.preventDefault()
        $('#profile input,textarea').each(function(){
            $(this).prop('disabled',!$(this).prop('disabled'));
            $('#profile-submit').hide();
            $('#cancel').hide();
        })
    })
    $('#profile-submit').on('click',function(){
        document.getElementById('profile').submit();
    });
})
