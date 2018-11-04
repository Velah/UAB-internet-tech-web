<?php

    if(isset($_GET['productID'])) {
        /*
         * Si se especifica la ID de un producto es que tenemos que añadirlo a la cesta
         */
        require_once(dirname(__FILE__) . '/../model/cartManager.php');
        return addProductToCart($_GET['productID']);
    }
    elseif(isset($_GET['productName'])) {
        /*
         * Si se especifica el nombre de un producto es que tenemos que eliminarlo de la cesta o, si también se
         * especifica una cantidad, que tenemos que actualizarla
         */
        require_once(dirname(__FILE__) . '/../model/infoGetter.php');
        require_once(dirname(__FILE__) . '/../model/cartManager.php');
        $productID = getProductFromNameDB($_GET['productName'])['productID'];
        if(isset($_GET['productQuantity'])){
            return updateCartProductQuantity($productID, $_GET['productQuantity']);
        }
        else{
            return deleteProductFromCart($productID);
        }
    }

    switch($_GET['action']){
        case 'cartDropdown':
            require_once(dirname(__FILE__) . '/../view/header/cartDropdownView.php');
            break;
        case 'cart':
            require_once(dirname(__FILE__) . '/../view/cart/cartView.php');
            break;
        case 'cartEmpty':
            require_once(dirname(__FILE__) . '/../model/cartManager.php');
            return emptyCart();
        case 'cartBuy':
            require_once(dirname(__FILE__) . '/../model/cartManager.php');
            return finishOrder();
        default:
            break;
    }

    function getCart(){
        require_once(dirname(__FILE__) . '/../model/cartManager.php');
        return getCartProducts();
    }


?>