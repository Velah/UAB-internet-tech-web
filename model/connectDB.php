<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


function connectDB(){
    // Of course credentials shouldn't be here, but that's what teachers told us to do
	$servername = "localhost";
	$username = "tdiw-b5";
	$password = "eiquudie";
	$db = "tdiw-b5";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $db);

	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

    $conn->set_charset("utf8");
	
    return $conn;
}

function parametrizedQuery($query, $parameters, $parameters_type){
    $conn = connectDB();
    $statement = $conn->prepare($query);

    if(is_array($parameters)){
        foreach ($parameters as $parameter){
            // Changing keys to numeric values to be able to use ...
            $readyParameters[] = $parameter;
        }
        $statement->bind_param($parameters_type, ...$readyParameters);
    }
    else {
        // Here we know there's only one parameter to be binded, so it's done right away
        $statement->bind_param($parameters_type, $parameters);
    }
    $statement->execute();
    $result = $statement->get_result();
    $conn->close();

    return $result;
}

?>