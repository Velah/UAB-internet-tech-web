<?php

/*
 * It returns an array where the key is productID and its value is an array
 * that contains the whole product
 */
function getCartProducts(){
    if(!isset($_SESSION['cart'])){
        return false;
    }

    require_once(dirname(__FILE__) . '/infoGetter.php');
    $cartProducts = [];
    foreach($_SESSION['cart'] as $productID => $productQuantity){
        $product = getProductFromIDDB($productID);
        $cartProducts[$productID] = [$product,$productQuantity];
    }
    return $cartProducts;
}

function addProductToCart($productID){
    if(isset($_SESSION['cart'][$productID])){
        $_SESSION['cart'][$productID] += 1;
    }
    else{
        $_SESSION['cart'][$productID] = 1;
    }
    return true;
}

function updateCartProductQuantity($productID, $productQuantity){
    if(isset($_SESSION['cart'][$productID])){
        $_SESSION['cart'][$productID] = $productQuantity;
        return true;
    }
    else{
        echo "No s'ha trobat aquest producte";
        return false;
    }
}

function deleteProductFromCart($productID){
    if(isset($_SESSION['cart'][$productID])){
        unset($_SESSION['cart'][$productID]);
        return true;
    }
    else{
        echo "No s'ha trobat aquest producte";
        return false;
    }
}

function emptyCart(){
    if(isset($_SESSION['cart'])){
        unset($_SESSION['cart']);
        return true;
    }
    else{
        echo "La cistella ja està buida";
        return false;
    }
}

function finishOrder(){
    if(!isset($_SESSION['user'])){
        echo "Has d'iniciar sessió abans de finalitzar la compra";
        return false;
    }

    require_once(dirname(__FILE__) . '/infoSetter.php');

    $orderID = addNewOrder();
    foreach($_SESSION['cart'] as $productID => $productQuantity){
        addProductToOrder($orderID, $productID, $productQuantity);
    }

    return true;
}

?>