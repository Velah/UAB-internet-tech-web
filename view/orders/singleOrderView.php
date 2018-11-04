<?php

echo "<div id='singleOrder'>";
foreach($products as $product){
    $price =  $product['price'] * $product['amount'];
    echo "<div class='singleOrderProduct'>
            <span class='singleOrderProductName' data-productID='" . $product['productID'] . "'>" . $product['name'] . "</span>
            <span class='singleOrderProductQuantity'>x" . $product['amount'] . "</span>
            <span class='singleOrderProductPrice'>" . $price . "$</span>
        </div>";
}
echo "<div id='singleOrderTotalPrice'>
              <span>Preu total: " . $totalPrice . "$</span>
          </div>";
echo "</div>";
?>