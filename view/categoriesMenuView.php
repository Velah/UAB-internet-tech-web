<?php

    $categories = getCategories();

    echo "<div id='navCategories'>
              <ul id='categoriesList'>";
    while ($category = $categories->fetch_assoc()) {
        echo "<li class='category' data-category='" . $category["name"] . "'>";
        echo "    <img class='categoryImg' src='img/categories/icons/" . $category["categoryID"] . ".png'>";
        echo $category["name"];
        echo "</li>";
    }
    echo "    </ul>
          </div>";

?>