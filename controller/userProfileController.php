<?php

    if(isset($_POST['mail'])){
        require_once(dirname(__FILE__) . "/../model/infoSetter.php");
        editUserDB($_POST);
        $_SESSION['user'] = getUserFromMailDB($_POST['mail']);
        return true;
    }
    else{
        $user = $_SESSION['user'];
        unset($user['userID']);
        unset($user['admin']);
        require_once(dirname(__FILE__) . '/../view/user/userProfileView.php');
    }

?>