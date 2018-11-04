<?php

switch($_GET['action']) {
    case 'loginUser':
        return loginUser($_POST['userMail'], $_POST['password']);
    case 'logoutUser':
        return logoutUser();
    default:
        break;
}

function loginUser($mail, $password) {
    require_once(dirname(__FILE__) . '/infoGetter.php');

    if($user = getUserFromMailDB($mail)){
        if(password_verify($password, $user['password'])){
            $_SESSION['user'] = $user;
            return true;
        }
        else{
            echo "Dades incorrectes";
            return false;
        }
    }
    else{
        echo "Dades incorrectes";
        return false;
    }
}

function logoutUser() {
    unset($_SESSION['user']);
    return($_SESSION);
}
?>