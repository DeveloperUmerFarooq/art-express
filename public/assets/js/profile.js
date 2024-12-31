$(document).ready(function(){
    $('#profile-submit').hide();
    $('#cancel').hide();
    $("#edit-details").on('click',function(e){
        e.preventDefault();
        $(this).css('pointer-events','none')
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
        $('#edit-details').css('pointer-events','auto')
        $('#profile input,textarea').each(function(){
            $(this).prop('disabled',!$(this).prop('disabled'));
            $('#profile-submit').hide();
            $('#cancel').hide();
        })
    })
})
