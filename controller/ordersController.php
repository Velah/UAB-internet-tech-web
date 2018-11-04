<?php

if(isset($_GET['orderID'])){
    require_once(dirname(__FILE__) . '/../model/infoGetter.php');
    $totalPrice = getPriceFromOrderDB($_GET['orderID']);
    $productsDB = getProductsFromOrder($_GET['orderID']);
    $products = [];
    foreach ($productsDB as $productDB){
        $product = getProductFromIDDB($productDB['productID']);
        $product['amount'] = $productDB['amount'];
        $products[] = $product;
    }
    require_once(dirname(__FILE__) . '/../view/orders/singleOrderView.php');
    return;
}

function getOrders(){
    require_once(dirname(__FILE__) . '/../model/infoGetter.php');
    return getUserOrdersDB();
}

function getProductsFromOrder($orderID){
    require_once(dirname(__FILE__) . '/../model/infoGetter.php');
    return getProductsFromOrderDB($orderID);
}

require_once(dirname(__FILE__) . '/../view/orders/ordersView.php');

?>