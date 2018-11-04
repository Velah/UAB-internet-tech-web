<?php

require_once(dirname(__FILE__) . '/connectDB.php');

function sanitize($parameter, $type) {
	if ($type == 'e'){
		$parameter = filter_var($parameter, FILTER_SANITIZE_EMAIL);
		if (filter_var($parameter, FILTER_VALIDATE_EMAIL) === false) {
    		echo($parameter . " is not a valid email address");
    		return false;
		} 
	}
	elseif ($type == 's') {
		$parameter = filter_var($parameter, FILTER_SANITIZE_STRING);
	}
	return $parameter;
}

function addProductToDB($imageURL, $shortDesc, $longDesc, $price, $name, $categoryName){
    require_once(dirname(__FILE__) . '/infoGetter.php');

    $activeDefault = 1; /* Indica si por defecto el producto añadido estará activo o habrá que activarlo manualmente */
    $categoryID = getCategoryFromNameDB($categoryName)['categoryID'];

    $query = "INSERT INTO product (image, shortDesc, longDesc, price, active, name, category) VALUES (?,?,?,?,?,?,?)";
    $parameters = [$imageURL, $shortDesc, $longDesc, $price, $activeDefault, $name, $categoryID];
    $parametersType = 'sssiisi';
    parametrizedQuery($query, $parameters, $parametersType);
}

function addNewOrder(){
    require_once(dirname(__FILE__) . '/infoGetter.php');

    $query = "INSERT INTO orders(userID, price) VALUES (?,?)";
    $userID = $_SESSION['user']['userID'];
    $price = 0;
    foreach($_SESSION['cart'] as $productID => $productQuantity){
        $price += getProductFromIDDB($productID)['price'] * $productQuantity;
    }
    $parameters = [$userID, $price];
    $parametersType = 'ii';

    parametrizedQuery($query,$parameters, $parametersType);

    /* Aquí cogemos la ID del pedido que acabamos de crear para devolverlo */
    $orderID = 0;
    $query = "SELECT orderID FROM orders WHERE userID=?";
    $parameters = $_SESSION['user']['userID'];
    $parametersType = 'i';

    $IDs = parametrizedQuery($query, $parameters, $parametersType);
    while($ID = $IDs->fetch_assoc()['orderID']){
        if($ID > $orderID){
            $orderID = $ID;
        }
    }

    return $orderID;
}

function addProductToOrder($orderID, $productID, $amount){
    $query = "INSERT INTO order_product VALUES (?,?,?)";
    $parameters = [$orderID, $productID, $amount];
    $parametersType = 'iii';

    parametrizedQuery($query, $parameters, $parametersType);

    return true;
}

function addNewProductDB($product){
    require_once(dirname(__FILE__) . '/infoGetter.php');

    $imageDir = 'img/';
    $productImageURL = $imageDir . basename($_FILES["productImage"]["name"]);
    $imageType = strtolower(pathinfo($productImageURL,PATHINFO_EXTENSION));
    if(file_exists($productImageURL)){
        echo "El nom de la imatge ja està en ús";
        return false;
    }
    if($imageType != "jpg" && $imageType != "png" && $imageType != "jpeg"){
        echo "Només s'accepta jpg, png o jpeg";
        return false;
    }
    if (!move_uploaded_file($_FILES["productImage"]["tmp_name"], $productImageURL)) {
        echo "Hi ha hagut un error pujant la imatge";
        return false;
    }

    $query = "INSERT INTO product (image, shortDesc, longDesc, price, active, name, category) VALUES (?,?,?,?,?,?,?)";
    $parameters = [$productImageURL, $product['productShortDesc'], $product['productLongDesc'],
        $product['productPrice'], 0, $product['productName'], $product['productCategory']];
    $parametersType = 'sssiisi';

    parametrizedQuery($query, $parameters, $parametersType);
    return true;
}

function deleteProductFromDB($productID){
    $query = "DELETE FROM product WHERE productID = ?";
    $parameters = $productID;
    $parametersType = 'i';

    parametrizedQuery($query, $parameters, $parametersType);
    return true;
}

function editProductDB($product){
    require_once(dirname(__FILE__) . '/infoGetter.php');

    $originalProduct = getProductFromNameDB($product['originalName']);

    $name = $product['name'];
    $productID = $originalProduct['productID'];
    $category = $product['productCategory'];
    $image = $product['image'];
    $shortDesc = $product['shortDesc'];
    $longDesc = $product['longDesc'];
    $price = $product['price'];

    switch(strtolower($product['active'])) {
        case "sí":
        case "si":
        case "yes":
        case "s":
        case "y":
        case "1":
            $active = 1;
            break;
        case "no":
        case "n":
        case "0":
            $active = 0;
            break;
        default:
            $active = 0;
            break;
    }

    $query = "UPDATE product SET image=?, shortDesc=?, longDesc=?, price=?, active=?, name=?, category=? WHERE productID=?";
    $parameters = [$image, $shortDesc, $longDesc, $price, $active, $name, $category, $productID];
    $parametersType = 'sssiisii';

    parametrizedQuery($query, $parameters, $parametersType);
    return true;
}

function editUserDB($user){
    require_once(dirname(__FILE__) . '/infoGetter.php');

    $mail = $user['mail'];
    $oldPassword = $user['oldPassword'];
    $newPassword = $user['newPassword'];
    $userHashedPassword = getUserFromMailDB($mail)['password'];
    $userID = getUserFromMailDB($mail)['userID'];
    $name = $user['name'];
    $surname = $user['surname'];
    $address = $user['address'];
    $city = $user['city'];
    $postalCode = $user['postalCode'];

    if(preg_match('/\\d/', $name) > 0 or preg_match('/\\d/', $surname) or preg_match('/\\d/', $city)){
        echo "Dades incorrectes";
        return false;
    }

    if(password_verify($oldPassword, $userHashedPassword)){
        $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    }
    else{
        if(!$oldPassword and !$newPassword){
            $newPassword = $userHashedPassword;
        }
        else{
            echo "Dades incorrectes";
            return false;
        }
    }
    $query = "UPDATE user SET mail=?, password=?, name=?, surname=?, address=?, city=?, postalCode=? WHERE userID=?";
    $parameters = [$mail, $newPassword, $name, $surname, $address, $city, $postalCode, $userID];
    $parametersType = 'sssssssi';

    parametrizedQuery($query, $parameters, $parametersType);

    return true;
}

?>