<?php

    function getCategories(){
        require_once(dirname(__FILE__) . '/../model/infoGetter.php');

        return getCategoriesDB();
    }

    require_once(dirname(__FILE__) . '/../view/landingView.php');
?>