<?php

echo "<div id='editUserProfileDiv'>";
echo "<form id='editUserProfileForm'>";

foreach($user as $userInfo => $value){
    switch($userInfo){
        case 'mail':
            echo "<span>Correu Electrònic</span>";
            break;
        case 'password':
            echo "<span>Antic Password</span>";
            echo "<input class='formInput' name='oldPassword' type='password'><br>";
            echo "<span>Nou Password</span>";
            echo "<input class='formInput' name='newPassword' type='password'><br>";
            break;
        case 'name':
            echo "<span>Nom</span>";
            break;
        case 'surname':
            echo "<span>Cognoms</span>";
            break;
        case 'address':
            echo "<span>Direcció</span>";
            break;
        case 'city':
            echo "<span>Ciutat</span>";
            break;
        case 'postalCode':
            echo "<span>Codi Postal</span>";
            break;
        default:
            break;
    }
    if($userInfo != 'password'){
        echo "<input class='formInput' name='" . $userInfo . "' type='text' placeholder='". $value . "'><br>";
    }
}
echo "<button id='editUserProfileButton' class='submitButton'>Guardar canvis</button>";
echo "</form>";
echo "</div>";
echo "<div id='editUserProfileHelp' class='help'>";
echo "<span></span>";
echo "</div>";
?>