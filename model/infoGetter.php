<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once(dirname(__FILE__) . '/connectDB.php');

function getCategoriesDB(){
    $conn = connectDB();
    $query = "SELECT * FROM category";
    $categories = $conn->query($query);
    $conn->close();
    if(!$categories){
        echo "No s'han trobat categories";
        return false;
    }
    return $categories;
}

function getCategoryFromIDDB($categoryID){
    $query = "SELECT * FROM category WHERE categoryID=?";
    $product = parametrizedQuery($query, $categoryID, 'i');
    if(!$product){
        echo "La categoria no existeix";
        return false;
    }
    return $product->fetch_assoc();
}

function getCategoryFromNameDB($categoryName){
    $query = "SELECT * FROM category WHERE name=?";
    $product = parametrizedQuery($query, $categoryName, 's');
    if(!$product){
        echo "La categoria no existeix";
        return false;
    }
    return $product->fetch_assoc();
}

function getProductsFromCategoryDB($category){
    $query = "SELECT categoryID FROM category WHERE name=?";
    $catID = parametrizedQuery($query, $category, 's');
    if(!$catID){
        echo "La categoria no existeix";
        return false;
    }
    $catID = $catID->fetch_assoc()["categoryID"];

    $query = "SELECT * FROM product WHERE category=?";
    $products = parametrizedQuery($query, $catID, 'i');
    if(!$products){
        echo "No s'han trobat productes";
        return false;
    }
    return $products;
}

function getProductsFromSearchDB($search){
    $query = "SELECT * FROM product WHERE name LIKE ?";
    $parameters = "%" . $search . "%";
    $parametersType = 's';

    $products = parametrizedQuery($query, $parameters, $parametersType);
    if(!$products){
        echo "No s'han trobat productes";
        return false;
    }
    return $products;
}

function getProductFromIDDB($productID){
    $query = "SELECT * FROM product WHERE productID=?";
    $product = parametrizedQuery($query, $productID, 'i');
    if(!$product){
        echo "El producte no existeix";
        return false;
    }
    return $product->fetch_assoc();
}

function getProductFromNameDB($productName){
    $query = "SELECT * FROM product WHERE name=?";
    $product = parametrizedQuery($query, $productName, 's');
    if(!$product){
        echo "El producte no existeix";
        return false;
    }
    return $product->fetch_assoc();
}

function getAllUsersDB(){
    $conn = connectDB();
    $query = "SELECT * FROM user";

    if($users = $conn->query($query)){
        $usersReturn = [];
        while($user = $users->fetch_assoc()){
            $usersReturn[] = $user;
        }
        if($usersReturn == []){
            echo "No hi ha usuaris registrats";
            return false;
        }
        else{
            return $usersReturn;
        }
    }
    else{
        echo "Error: " . $query . "<br>" . $conn->error;
        return false;
    }
}

function getAllOrdersDB(){
    $users = getAllUsersDB();
    $orders = [];
    $ordersReturn = [];
    foreach($users as $user){
        $userOrders = getUserOrdersDB($user['userID']);
        foreach($userOrders as $userOrder){
            $orders[$userOrder['orderID']]['userID'] = $userOrder['userID'];
            $orders[$userOrder['orderID']]['totalPrice'] = $userOrder['price'];
            $orders[$userOrder['orderID']]['date'] = $userOrder['date'];
            $orders[$userOrder['orderID']]['products'] = getProductsFromOrderDB($userOrder['orderID']);
            $dates[$userOrder['orderID']] = $userOrder['date'];
        }
    }
    /* Ordenamos por fecha antes de devolver el array */
    arsort($dates);
    foreach($dates as $orderID => $date){
        $ordersReturn[$orderID] = $orders[$orderID];
    }
    return $ordersReturn;
}

function getAllProductsDB(){
    $conn = connectDB();
    $query = "SELECT * FROM product";

    if($products = $conn->query($query)){
        $productsReturn = [];
        while($product = $products->fetch_assoc()){
            $productsReturn[] = $product;
        }
        if($productsReturn == []){
            echo "No hi ha productes registrats";
            return false;
        }
        else{
            return $productsReturn;
        }
    }
    else{
        echo "Error: " . $query . "<br>" . $conn->error;
        return false;
    }
}

function getUserFromMailDB($userMail){
    $query = "SELECT * FROM user WHERE mail=?";
    $user = parametrizedQuery($query, $userMail, 's');
    if(!$user){
        echo "Dades incorrectes";
        return false;
    }
    return $user->fetch_assoc();
}

function getUserFromIDDB($userID){
    $query = "SELECT * FROM user WHERE userID=?";
    $user = parametrizedQuery($query, $userID, 'i');
    if(!$user){
        echo "Dades incorrectes";
        return false;
    }
    return $user->fetch_assoc();
}

function getUserOrdersDB($userID = false){
    $query = "SELECT * FROM orders WHERE userID=?";
    if($userID){
        $parameters = $userID;
    }
    else{
        $parameters = $_SESSION['user']['userID'];
    }
    $parametersType = 'i';
    $orders = parametrizedQuery($query, $parameters, $parametersType);

    if(!$orders){
        echo "No s'han trobat comandes";
        return false;
    }
    $ordersArray = [];
    while($order = $orders -> fetch_assoc()){
        $ordersArray[] = $order;
    }

    return $ordersArray;
}

function getPriceFromOrderDB($orderID){
    $query = "SELECT price FROM orders WHERE orderID=?";
    $parameters = $orderID;
    $parametersType = 'i';
    $price = parametrizedQuery($query, $parameters, $parametersType);
    if(!$price){
        echo "No s'ha trobat aquesta comanda";
        return false;
    }
    else{
        return $price->fetch_assoc()['price'];
    }
}

function getProductsFromOrderDB($orderID){
    $query = "SELECT productID, amount FROM order_product WHERE orderID=?";
    $products = parametrizedQuery($query, $orderID, 'i');

    if(!$products){
        echo "No s'han trobat productes";
        return false;
    }
    $productsArray = [];
    while($product = $products -> fetch_assoc()){
        $productsArray[] = $product;
    }

    return $productsArray;
}

?>