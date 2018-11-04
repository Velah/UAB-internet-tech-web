<?php

require_once(dirname(__FILE__) . '/../model/infoGetter.php');
$product = getProductFromIDDB($_GET['productID']);

require_once(dirname(__FILE__) . '/../view/productView.php');

?>