<?php

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);





$servername = getenv('SQLHOSTNAME');
// REPLACE with your Database name
$dbname = "sensorData";
// REPLACE with Database user
$username = getenv('SQLUSER');
// REPLACE with Database user password
$password = getenv('SQLPASS');




// Keep this API Key value to be compatible with the ESP32 code provided in the project page. 
// If you change this value, the ESP32 sketch needs to match
$api_key_value = getenv('FLOWERSSENSORKEY');
$api_key = $sensor = $location = $Temperature = $Humidity = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["api_key"])){
        $api_key = test_input($_POST["api_key"]);
    } else{
        echo "api_key is empty";
        exit(-1);
    }

    
    //echo "\nAPI_Key:";
    //echo $api_key;
    //echo "\nAPI_Key_Value:";
    //echo $api_key_value;
    echo "\n";
    if($api_key == $api_key_value) {
        //echo "API Key Accepted";
        $sensor = test_input($_POST["Sensor"]);
        $Temperature = test_input($_POST["Temperature"]);
        $Pressure = test_input($_POST["Pressure"]);
        $Humidity = test_input($_POST["Humidity"]);
        
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        
        $sql = "INSERT INTO Flowers (`Sensor`, `Temperature(C)`, `Pressure(bar)`, `Humidity(%)`) VALUES ('" . $sensor . "', '" . $Temperature . "','" . $Pressure . "', '" . $Humidity . "')";

        // $sql = "INSERT INTO Flowers (`Sensor`, `Location`, `Temperature(C)`, `Pressure(bar)` `Humidity(%)`) VALUES ('" . $sensor . "', '" . $location . "', '" . $Temperature . "', '" . $Humidity . "')";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } 
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
    }
    else {
        echo "Wrong API Key provided.";
    }
}else {
    echo "No data posted with POST.";
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
