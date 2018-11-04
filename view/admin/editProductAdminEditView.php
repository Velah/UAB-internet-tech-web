<?php

echo "<div id='editProductsEditDiv'>";
echo "<form id='editProductsEditForm'>";
foreach($product as $productInfo => $value){
    switch($productInfo){
        case "image":
            echo "<span>URL de la imatge</span>";
            break;
        case "shortDesc":
            echo "<span>Descripció curta</span>";
            break;
        case "longDesc":
            echo "<span>Descripció llarga</span>";
            break;
        case "price":
            echo "<span>Preu</span>";
            break;
        case "active":
            if($value){
                $value = "Sí";
            }
            else{
                $value = "No";
            }
            echo "<span>Visible?</span>";
            break;
        case "name":
            echo "<span>Nom</span>";
            break;
        case "category":
            $value = getCategoryNameFromID($value);
            echo "<span>Categoria</span>";
            break;
        default:
            break;
    }
    if($productInfo == 'longDesc') {
        echo "<textarea id='longDescInput' class='editProductsEditInput formInput' name='" . $productInfo . "' placeholder='" . $value . "'></textarea><br>";
    }
    else{
        if($productInfo == 'category'){
            echo "<select id='newProductSelectCategory' class='formInput' name='productCategory'>";
            foreach($categories as $category){
                if($category['name'] == $value){
                    echo "<option value='" . $category['categoryID'] . "' selected>" . $category['name'] . "</option>";
                }
                else{
                    echo "<option value='" . $category['categoryID'] . "'>" . $category['name'] . "</option>";
                }
            }
            echo "</select><br>";
        }
        else{
            echo "<input class='editProductsEditInput formInput' name='" . $productInfo . "' type='text' placeholder='". $value . "'><br>";
        }
    }
}
echo "<input class='inputFile formInput' name='originalName' type='text' placeholder='" . $product['name'] . "'><br>";
echo "<button id='editProductsEditEditButton' class='submitButton'>Edita el producte</button>";
echo "</form>";
echo "</div>";
?>