<?php

echo "<div id='editProductsDiv'>";
foreach ($products as $product){
    $productID = $product['productID'];
    $productName = $product['name'];
    $price = $product['price'];

    echo "<div class='editProductsSingleProduct'>
              <span class='editProductsSingleProductText' data-productID='" . $productID . "'>ProductID: " . $productID . " 
              | " . $productName . " | " . $price . "$</span>
              <button class='submitButton editProductsEditButton'>Edita</button>
              <button class='submitButton editProductsDeleteButton'>Elimina</button>
          </div>";
}
echo "</div>";

?>