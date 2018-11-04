$('.landing-category').click(function(){
    /* Cuando hacemos click en una de las categorías, cargamos el listado de productos de esa categoría y actualizamos
       el id del div de la parte derecha que contiene el listado de los productos para que se adapte al css. A parte,
       hacemos que se vea el menú de categorías de la derecha, que por defecto está en invisible, y también cargamos su
       css. Al final quitamos el css de la página de inicio ya que no lo necesitaremos más.
     */
    var category = $(this).attr('data-category');

    $('#landing-productSection').load('index.php?action=list&category=' + category, function(){
        loadCategoriesMenuFromLanding();
    });
});

function loadCategoriesMenuFromLanding(){
    $('#navCategories').css({'display': 'block'});
    $('#landing-productSection').attr("id","productSection");
    removeCSS("css/landing.css");
}

function unloadCategoriesMenuFromLanding() {
    addCSS("css/landing.css", function () {
        $('#navCategories').css({'display': 'none'});
        $('#productSection').attr("id","landing-productSection");
    });
}