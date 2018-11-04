<?php
require_once(dirname(__FILE__) . '/connectDB.php');
require_once(dirname(__FILE__) . '/infoSetter.php');

$completed = false;

$sql = "INSERT INTO user(name, surname, mail, password, address, city, postalCode) VALUES (?, ?, ?, ?, ?, ?, ?)";
$parameters = $_POST;

foreach ($parameters as $parameter){
    $parameter = htmlentities($parameter, ENT_QUOTES | ENT_HTML5, 'UTF-8');
}
$parameters["password"] = password_hash($_POST["password"], PASSWORD_DEFAULT);

foreach ($parameters as $key => $value) {
    if ($key == 'email'){
        $value = sanitize($value, 'e');
        if (!$value){
            return false;
        }
    }
    else{
        $value = sanitize($value, 's');
    }
}

if(checkEmailDB($parameters["email"])){
    parametrizedQuery($sql, $parameters, 'sssssss');
    $completed = true;
}
else{
    echo "<div>
              <p>Aquest email ja està en ús</p>
          </div>";
}

require_once(dirname(__FILE__) . '/../view/login/registerCompletedView.php');

function checkEmailDB($newEmail){
    require_once(dirname(__FILE__) . '/infoGetter.php');

    $users = getAllUsersDB();
    foreach($users as $user){
        if($newEmail === $user['mail']){
            return false;
        }
    }
    return true;
}

?>