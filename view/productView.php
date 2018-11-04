<div id='productImgDiv'>
    <img id='productImg' src='<?php echo $product["image"] ?>'>
</div>
<div id='productBuyDiv'>
    <p id='productName'><?php echo $product["name"] ?></p>
    <p id='productPrice'><?php echo $product["price"] ?>$</p>
    <button id='wishlistButton' class='submitButton' type='submit'>Afegeix a la llista de desitjos</button>
    <button id='buyButton' class='submitButton' type='submit' data-productID='<?php echo $product["productID"] ?>'>Afegeix a la cistella</button>
    <p id='product-long-desc'><?php echo $product["longDesc"] ?></p>
</div>