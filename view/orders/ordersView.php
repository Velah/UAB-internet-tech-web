<?php

echo "<div id='ordersDiv'>";

if($orders = getOrders()){
    for($i = count($orders); $i > 0; $i--){
        $products = getProductsFromOrder($orders[$i-1]['orderID']);

        echo "<div class='order'>
                  <span class='orderText' data-orderID='" . $orders[$i-1]['orderID'] . "'>Comanda nº" . $i . " 
                  | Preu Total: " . $orders[$i-1]['price'] . "$ | Data: " . $orders[$i-1]['date'] . "</span>
              </div>";
    }
    echo "<div id='ordersHelp'></div>";
}
else{
    echo "<div id='ordersHelp'>
              <span>Encara no has realitzat cap compra</span>
          </div>";
}

echo "</div>";

?>