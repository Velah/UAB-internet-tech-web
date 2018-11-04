/*
 * Variables
 */
var $body = $('body');
var $landing = $('#landing-productSection');
var $productSection = $('#productSection');
var $searchBar = $('#searchBar');
var $navbar = $('#navBar');
var $cartIcon = $('#cartIcon');
/**********************************************************************************************************************/

function removeCSS(cssURL){
    $('document').ready(function () {
        $('link').each(function () {
            if ($(this).attr('href') === cssURL) {
                $(this).remove();
            }
        });
    });
}

/*
 * Los default parameters solo funcionan en navegadores compatibles con ES6, pero como en la práctica solamente usamos
 * Chrome (que sí que es compatible) no hay problema.
 * En caso de necesitarlo, sustituir la definición de la función por:
 * function addCSS(cssURL, callback){
 *     callback = callback || false;
 */
function addCSS(cssURL, callback = false){
    var $head = $('head');
    var exists = false;

    $('link').each(function () {
        if($(this).attr('href') === cssURL){
            exists = true;
        }
    });

    if(!exists){
        $head.append("<link>");
        var $cssFile = $head.children(":last");
        $cssFile.attr({
            rel:  "stylesheet",
            type: "text/css",
            href: cssURL
        });
    }

    if(callback){
        callback();
    }
}
