/*
 * Producto nuevo
 */
$body.on('click', '#newProduct', function (){
    $('#productSection').load('index.php?action=newProduct', function () {
        var $input = $('.inputFile'),
            $label	 = $input.next( 'label' ),
            labelVal = $label.html();

        $body.on('change', $input, function (e){
            var fileName = '';

            if( e.target.value ){
                fileName = e.target.value.split( '\\' ).pop();
            }
            if( fileName )
                $label.html( fileName );
            else
                $label.html( labelVal );
        });

        $body.on('submit', '#newProductForm', function (){
            var $form = $(this);
            var inputsArray = $form.serializeArray();
            var $help = $('#newProductHelp').find('span');

            event.preventDefault();
            if(isNaN(inputsArray[4]["value"])){
                $help.text("Introdueix un preu correcte");
            }

            $.ajax({
                url: "index.php?action=newProduct",
                type: "POST",
                data:  new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data){
                    if(data){
                        $help.text(data);
                    }
                    else{
                        $('#userDropdownAdmin').click();
                    }
                }
            });
        });
    });
});
/**********************************************************************************************************************/

/*
 * Edición de un producto
 */
$body.on('click', '#editProduct', function (){
    $('#productSection').load('index.php?action=editProduct', function () {
        $body.on('click', '.editProductsSingleProductText', function (){
            var productID = $(this).attr('data-productID');
            addCSS('css/product.css', function () {
                $('#productSection').load('index.php?action=product&productID=' + productID);
            });
        });
        $body.on('click', '.editProductsEditButton', function (){
            $('#productSection').load('index.php?action=editProduct&productID=' + $(this).parent().find('span').attr('data-productID'), function () {
                $body.on('click', '#editProductsEditEditButton', function (){
                    event.preventDefault();
                    $('.formInput').each(function () {
                        if(!$(this).val()){
                            $(this).val($(this).attr('placeholder'));
                        }
                    });
                    $.post('index.php?action=editProduct', $('#editProductsEditForm').serialize(), function (data) {
                        console.log(data);
                        $('#userDropdownAdmin').click();
                    });
                });
            });
        });
        $body.on('click', '.editProductsDeleteButton', function (){
            $.get('index.php?action=editProduct&deleteProductID=' + $(this).parent().find('span').attr('data-productID'), function () {
                $('#productSection').load('index.php?action=editProduct');
            });
        });
    });
});
/**********************************************************************************************************************/

/*
 * Listado de pedidos
 */
$body.on('click', '#ordersList', function (){
    $('#productSection').load('index.php?action=ordersList', function () {
        $body.on('click', '.ordersListSingleOrderText', function (){
            var orderID = $(this).attr('data-orderID');
            addCSS("css/orders.css", function () {
                $('#productSection').load('index.php?action=ordersList&orderID=' + orderID);
            });
        });
    });
});
/**********************************************************************************************************************/
