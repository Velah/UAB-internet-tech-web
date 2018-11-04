$body.on('click', '#buyButton', function (){
    var productID = $(this).attr('data-productID');
    $.get('index.php?action=cart&productID=' + productID, function(){
        $('#cartIcon').click();
    });
});

$body.on('click', '#wishlistButton', function (){
    $(this).text("Work in progress");
    $(this).css({"background-color" : "red"});
});