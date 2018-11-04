<form id="newProductForm" enctype="multipart/form-data">
    <input class="formInput" placeholder="Nom del producte" name="productName" type="text" required><br>
    <input id="productImageInput" class="formInput inputFile" placeholder="Imatge" name="productImage" type="file" required>
    <label for="productImageInput">Tria una imatge</label><br>
    <input class="formInput" placeholder="Descripció curta" name="productShortDesc" type="text" required><br>
    <textarea id="longDescInput" class="formInput" placeholder="Descripció llarga" name="productLongDesc" required></textarea><br>
    <input class="formInput" placeholder="Preu" name="productPrice" type="text" pattern="[0-9]+" required><br>
    <select id="newProductSelectCategory" class="formInput" name="productCategory">
        <?php
            foreach($categories as $category){
                echo "<option value='" . $category['categoryID'] . "'>" . $category['name'] . "</option>";
            }
        ?>
    </select><br>
    <button id="addProductButton" class="submitButton" type="submit">Afegeix el producte</button>
</form>
<div id="newProductHelp" class="help">
    <span></span>
</div>