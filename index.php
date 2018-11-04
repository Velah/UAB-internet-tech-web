<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start([
    'cookie_lifetime' => 86400
]);

if (!isset($_SESSION['cart'])){
	$_SESSION['cart'] = [];
}

if(isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'cart':
        case 'cartDropdown':
        case 'cartEmpty':
        case 'cartBuy':
            include(dirname(__FILE__) . '/controller/cartController.php');
            break;
        case 'login':
        case 'loginUser':
        case 'logoutUser':
            include(dirname(__FILE__) . '/controller/loginController.php');
            break;
        case 'admin':
        case 'newProduct':
        case 'editProduct':
        case 'ordersList':
            include(dirname(__FILE__) . '/controller/adminController.php');
            break;
        case 'userProfile':
            include(dirname(__FILE__) . '/controller/userProfileController.php');
            break;
        case 'orders':
            include(dirname(__FILE__) . '/controller/ordersController.php');
            break;
        case 'list':
            include(dirname(__FILE__) . '/controller/listController.php');
            break;
        case 'product':
            include(dirname(__FILE__) . '/controller/productController.php');
            break;
        default:
            include(dirname(__FILE__) . '/controller/landingController.php');
            break;
    }
}
else {
    include(dirname(__FILE__) . '/controller/landingController.php');
}
?>
