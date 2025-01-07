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
    $('.mark-null').on('change', function () {
        var target = $($(this).data('target'));

        if ($(this).is(':checked')) {
            target.val(null);
            target.prop('disabled', true);
        } else {
            target.val(target[0].defaultValue);
            target.prop('disabled', false);
        }
    });
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
            $(this).val(this.defaultValue);
        })
        $('#profile-submit').hide();
        $('#cancel').hide();
    })
})
