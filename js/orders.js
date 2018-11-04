$('body').on('click', '.orderText', function (){
    var orderID = $(this).attr('data-orderID');
    console.log("orderID -------->" + orderID);
    $('#productSection').load('index.php?action=orders&orderID=' + orderID);
});

$body.on('click', '.singleOrderProductName', function (){
    var productID = $(this).attr('data-productID');
    addCSS("css/product.css", function () {
        $('#productSection').load('index.php?action=product&productID=' + productID);
    });

});
