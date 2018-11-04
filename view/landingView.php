<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/common.css">
    <link rel="stylesheet" type="text/css" href="css/header.css">
    <link rel="stylesheet" type="text/css" href="css/landing.css">
    <script type="text/javascript" src="js/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="js/common.js" defer></script>
    <script type="text/javascript" src="js/landing.js" defer></script>
    <script type="text/javascript" src="js/list.js" defer></script>
    <script type="text/javascript" src="js/header.js" defer></script>
    <script type="text/javascript" src="js/product.js" defer></script>
    <script type="text/javascript" src="js/cart.js" defer></script>
    <script type="text/javascript" src="js/orders.js" defer></script>
    <script type="text/javascript" src="js/admin.js" defer></script>
    <script type="text/javascript" src="js/userProfile.js" defer></script>
</head>

    <?php require_once(dirname(__FILE__) . '/header/headerView.php'); ?>

    <?php require_once(dirname(__FILE__) . '/categoriesMenuView.php'); ?>

    <?php showCategories(); ?>

</body>
</html>

<?php
    function showCategories(){
        $categories = getCategories();

        echo "<div id='landing-productSection'>
                ";
        while($category = $categories->fetch_assoc()){
            echo "<div class='landing-category' data-category='" . $category["name"] . "'>
                        <img class='landing-category-img' src='img/categories/icons/" . $category["categoryID"] . ".png'>
                        <div class='landing-category-name'>" . $category["name"] . "</div>
                    </div>
                </a>";
        }
        echo "</div>";
    }
?>