<?php

require_once(dirname(__FILE__) . '/../model/infoGetter.php');

if(isset($_GET['search'])){
    $products = getProductsFromSearchDB($_GET['search']);
}
else{
    $products = getProductsFromCategoryDB($_GET['category']);;
}

require_once(dirname(__FILE__) . '/../view/listView.php');

?>