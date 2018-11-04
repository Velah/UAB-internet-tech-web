$('.changeLoginRegister').click(function () {
    $('#loginDiv').fadeToggle(500);
    $('#registerDiv').fadeToggle(500);
});

$('#loginButton').click(function (event) {
    event.preventDefault();
    $.post('index.php?action=loginUser', $('#loginForm').serialize(), function(data) {
        if(data){
            $('#loginHelp').text(data);
        }
        else{
            window.location.href = "index.php";
        }
    });
});
