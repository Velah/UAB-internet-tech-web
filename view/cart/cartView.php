<?php

$totalPrice = 0;

echo "<div id='cart'>";

if($products = getCart()){
    foreach($products as $productID => $product){
       $price =  $product[0]['price'] * $product[1];
       $totalPrice += $price;
        echo "<div class='cartProduct'>
            <span class='cartProductName' data-product='" . $productID . "'>" . $product[0]['name'] . "</span>
            <input class='cartProductQuantity' name='quantity' type='text' placeholder='" . $product[1] . "' min='1'>
            <span class='cartProductPrice'>" . $price . "$</span>
            <button class='submitButton cartDeleteButton' type='button'>Elimina el producte</button>
        </div>";
    }
    echo "<div id='totalPrice'>
              <span>Preu total: " . $totalPrice . "$</span>
          </div>";
    echo "<div>
              <button id='cartBuyButton' class='submitButton' type='button'>Finalitza la compra</button>
          </div>";
    echo "<div>
              <button id='cartEmptyButton' class='submitButton' type='button'>Buida la cistella</button>
          </div>";
    echo "<div id='cartHelp'>
              <span></span>
          </div>";
}
else {
    echo "<div id='cartHelp'>
              <span>Encara no has afegit productes a la cistella</span>
          </div>";
}

echo "</div>";