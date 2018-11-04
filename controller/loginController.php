<?php

    if(isset($_GET['action'])){
        switch($_GET['action']){
            case 'loginUser':
            case 'logoutUser':
                require_once(dirname(__FILE__) . '/../model/sessionManager.php');
                return;
            case 'login':
                require_once(dirname(__FILE__) . '/../view/login/loginView.html');
                break;
            default:
                break;
        }
    }
    elseif(isset($_POST['name'])){
        require_once(dirname(__FILE__) . '/../model/newUser.php');
    }

?>