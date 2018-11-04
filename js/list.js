$('.category').click(function (){
    /* Cuando hacemos click en una de las categorías del menú de la derecha cargamos los productos de ese menú y
       actualizamos el div que los contiene.
     */
    var category = $(this).attr('data-category');

    $('#productSection').load('index.php?action=list&category=' + category, function() {
        /* Por si hemos cargado un listado de productos desde la vista detallada de uno de ellos, quitamos el css
           de la vista detallada del producto.
         */
        removeCSS("css/product.css");
        removeCSS("css/cart.css");
    });
});

$('body').on('click', '.product', function (){
    /* Los eventos se enlazan a los elementos de HTML al cargar el archivo js. Entonces, al modificar los elementos
       de la web, los productos que cargamos no tendran el evento 'click'. Entonces, cuando hacemos click encima de un
       producto cargado dinámicamente, en realidad estamos haciendo click a lo que está debajo de ese producto (que
       tampoco es 'productSection' porque también ha sido modificado), que es directamente el body. Entonces, cuando
       hacemos click en el body, le podemos "pasar como parámetro" al evento lo que en realidad estamos clickando, que
       en nuestro caso es el product que queremos.
     */

    var productID = $(this).attr('data-product');

    addCSS("css/product.css", function () {
        $('#productSection').load('index.php?action=product&productID=' + productID);
    });
});