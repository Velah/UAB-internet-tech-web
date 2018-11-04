<?php

while($product = $products->fetch_assoc()){
    if($product['active']){
        echo "<div class='product' data-product='" . $product["productID"] . "'>
                  <img class='product-img' src='" . $product["image"] . "'>
                  <div class='product-name'>" . $product["name"] . "</div>
                  <div class='product-price'>" . $product["price"] . "$</div>
                  <div class='product-short-description'>" . $product["shortDesc"] . "</div>
              </div>";
    }
}

?>