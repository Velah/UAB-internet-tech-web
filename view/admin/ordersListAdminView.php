<?php

echo "<div id='ordersListDiv'>";
foreach ($orders as $orderID => $order){
    $userID = $order['userID'];
    $totalPrice = $order['totalPrice'];
    $data = $order['date'];

    echo "<div class='ordersListSingleOrder'>
              <span class='ordersListSingleOrderText' data-orderID='" . $orderID . "'>OrderID: " . $orderID . " 
              | UserID: " . $userID . " | " . $totalPrice . "$ | Data: " . $data . "</span>
          </div>";
}

?>