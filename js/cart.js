$body.on('click', '.cartDeleteButton', function (){
    var productName = $(this).parent().find('.cartProductName').text();

    $.get('index.php?action=cart&productName=' + productName, function(){
        $('#cartViewer').click();
    });
});

$body.on('click', '.cartProductName', function (){
    var productID = $(this).attr('data-product');

    addCSS("css/product.css", function () {
        $('#productSection').load('index.php?action=product&productID=' + productID);
    });

});

$body.on('click', '#cartBuyButton', function (){
    $.get('index.php?action=cartBuy', function(data){
        if(!data){
            $.get('index.php?action=cartEmpty', function(){
                addCSS("css/orders.css", function () {
                    $('#productSection').load('index.php?action=orders');
                });
            });
        }
        else{
            var $cartHelp = $('#cartHelp').find('span');
            $cartHelp.css({"color": "red"});
            $cartHelp.text("Primer has d'iniciar sessió");
        }
    });
});

$body.on('click', '#cartEmptyButton', function (){
    $.get('index.php?action=cartEmpty', function(){
        $('#cartViewer').click();
    });
});

$body.on('change', '.cartProductQuantity', function (){
    var productName = $(this).parent().find('.cartProductName').text();
    var productQuantity = $(this).val();

    $.get('index.php?action=cart&productName=' + productName + '&productQuantity=' + productQuantity, function(){
        $('#cartViewer').click();
    });
});