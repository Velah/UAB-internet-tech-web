$body.on('click', '#editUserProfileButton', function () {
    var $form = $('#editUserProfileForm');
    var $help = $('#editUserProfileHelp').find('span');

    event.preventDefault();
    $('.formInput').each(function () {
        if(!$(this).val()){
            $(this).val($(this).attr('placeholder'));
        }
    });
    $.post('index.php?action=userProfile', $form.serialize(), function(data){
        if(data){
            $help.text(data);
        }
        else{
            $('#userDropdownUserProfile').click();
        }
    });
});