<?php

switch($_GET['action']){
    case 'admin':
        require_once(dirname(__FILE__) . "/../view/admin/adminView.php");
        break;
    case 'newProduct':
        if(isset($_POST['productName'])){
            require_once(dirname(__FILE__) . "/../model/infoSetter.php");
            return addNewProductDB($_POST);
        }
        require_once(dirname(__FILE__) . "/../model/infoGetter.php");
        $categories = getCategoriesDB();
        require_once(dirname(__FILE__) . "/../view/admin/newProductAdminView.php");
        break;
    case 'editProduct':
        if(isset($_GET['productID'])){
            require_once(dirname(__FILE__) . "/../model/infoGetter.php");
            $product = getProductFromIDDB($_GET['productID']);
            $categories = getCategoriesDB();
            unset($product['productID']);
            require_once(dirname(__FILE__) . "/../view/admin/editProductAdminEditView.php");
            break;
        }
        elseif(isset($_GET['deleteProductID'])){
            require_once(dirname(__FILE__) . "/../model/infoSetter.php");
            deleteProductFromDB($_GET['deleteProductID']);
            break;
        }
        elseif(isset($_POST['name'])){
            require_once(dirname(__FILE__) . "/../model/infoSetter.php");
            editProductDB($_POST);
            break;
        }
        else{
            require_once(dirname(__FILE__) . "/../model/infoGetter.php");
            $products = getAllProductsDB();
            require_once(dirname(__FILE__) . "/../view/admin/editProductAdminView.php");
            break;
        }
    case 'ordersList':
        require_once(dirname(__FILE__) . "/../model/infoGetter.php");
        if(isset($_GET['orderID'])){
            $productsDB = getProductsFromOrderDB($_GET['orderID']);
            $products = [];
            foreach ($productsDB as $productDB){
                $product = getProductFromIDDB($productDB['productID']);
                $product['amount'] = $productDB['amount'];
                $products[] = $product;
            }
            $totalPrice = getPriceFromOrderDB($_GET['orderID']);
            require_once(dirname(__FILE__) . "/../view/orders/singleOrderView.php");
            break;
        }
        else{
            $orders = getAllOrdersDB();
            require_once(dirname(__FILE__) . "/../view/admin/ordersListAdminView.php");
            break;
        }
    default:
        break;
}

function getCategoryNameFromID($categoryID){
    require_once(dirname(__FILE__) . "/../model/infoGetter.php");
    return getCategoryFromIDDB($categoryID)['name'];
}

?>