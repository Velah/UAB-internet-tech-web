<?php

if($products = getCart()){
    foreach($products as $productID => $product){
        echo "<div class='cartDropdownProduct'>
              <span>" . $product[0]['name'] . "  x" . $product[1] . "   " . $product[0]['price'] * $product[1] . "$</span> 
          </div>";
    }
}
else{
    echo "<span>No tens productes a la cistella</span>";
}

echo "<a id='cartViewer'>Visualitza la cistella</a>";

?>