/*
 * Herramientas del usuario
 */
$('#profileIcon').click(function() {
    /*
        User dropdown
     */
    var $dropdown = $(this).parent().find('.dropdown').find('.dropdown-content');
    $dropdown.css({"display": "block"});

    $dropdown.mouseleave(function () {
        $dropdown.css({"display": "none"});
    });
    $navbar.mouseleave(function () {
        $dropdown.css({"display": "none"});
    });
    $cartIcon.mouseenter(function () {
        $dropdown.css({"display": "none"});
    });

    $body.on('click', '#userDropdownUserProfile', function () {
        addCSS('css/userProfile.css', function () {
            if($landing.length){
                $landing.load('index.php?action=userProfile', function(){
                    loadCategoriesMenuFromLanding();
                });
            }
            else{
                $productSection.load('index.php?action=userProfile');
            }
        });
    });

    $body.on('click', '#userDropdownLogout', function (){
        $.get('index.php?action=logoutUser', function(){
            location.reload();
        });
    });

    $body.on('click', '#userDropdownAdmin', function () {
        addCSS('css/admin.css', function () {
            if($landing.length){
                $landing.load('index.php?action=admin', function(){
                    loadCategoriesMenuFromLanding();
                });
            }
            else{
                $productSection.load('index.php?action=admin');
            }
        });
    });

    $body.on('click', '#userDropdownOrders', function () {
        addCSS('css/orders.css', function () {
            if($landing.length){
                $landing.load('index.php?action=orders', function(){
                    loadCategoriesMenuFromLanding();
                });
            }
            else{
                $productSection.load('index.php?action=orders');
            }
        });
    });
});
/**********************************************************************************************************************/

/*
 * Cesto de la compra
 */
$('#cartIcon').click(function() {
    /*
     *  Cart dropdown
     */
    var $dropdown = $(this).parent().find('.dropdown').find('.dropdown-content');
    $dropdown.css({"display": "block", "width": "20vw"});
    $dropdown.parent().css({"left": "76vw"});

    $dropdown.load('index.php?action=cartDropdown', function () {
        $dropdown.mouseleave(function () {
            $dropdown.css({"display": "none"});
        });
        $('#navBar').mouseleave(function () {
            $dropdown.css({"display": "none"});
        });
        $('#profileIcon').mouseenter(function(){
            $dropdown.css({"display": "none"});
        });

        $body.on('click', '#cartViewer', function (){
            /*
                Load cart view
             */
            addCSS("css/cart.css", function () {
                if($landing.length){
                    $landing.load('index.php?action=cart', function(){
                        loadCategoriesMenuFromLanding();
                        $('.cartProductQuantity').each(function () {
                            $(this).css({"width": $(this).attr('placeholder').toString().length + "vw"});
                        });
                    });
                }
                else{
                    $productSection.load('index.php?action=cart', function () {
                        $('.cartProductQuantity').each(function () {
                            $(this).css({"width": $(this).attr('placeholder').toString().length + "vw"});
                        });
                    });
                }
            });
        });
    });
});
/**********************************************************************************************************************/

/*
 * Barra de búsqueda
 */
$searchBar.on('input', function() {
    if($(this).val()){
        addCSS('css/list.css', function () {
            if($landing.length){
                $landing.load('index.php?action=list&search=' + $searchBar.val(), function () {
                    loadCategoriesMenuFromLanding();
                });
            }
            else{
                $productSection.load('index.php?action=list&search=' + $searchBar.val());
            }
        });
    }
    else{
        unloadCategoriesMenuFromLanding();
        $landing.load('index.php');
    }
});
/**********************************************************************************************************************/

