<?php

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

$servername = "localhost";
// REPLACE with your Database name
$dbname = "sensorNotifications";
// REPLACE with Database user
$username = getenv('NotiSQLUSER');
// REPLACE with Database user password
$password = getenv('NotiSQLPASS');

//api_key_value must match apikey loaded on esp8266 device in order for post requests to work.
$exteriorSensorAPIKey = getenv('EXTERIORSENSORKEY');
$flowerSensorAPIKey = getenv('FLOWERSENSORKEY');

$api_key = $sensor = $batteryLevel = $eta = $charging = $loggingType = $errorBody = $shutdown = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["api_key"])){
        $api_key = test_input($_POST["api_key"]);
    }else{
        echo "No API Key provided.";
        exit(-1);
    }
    echo "\n";
    if($api_key == $flowerSensorAPIKey) {
        $batteryLevel = test_input($_POST["batteryLevel"]);
        $eta = test_input($_POST["eta"]);
        $charging = test_input($_POST["charging"]);
        $loggingType = test_input($_POST["loggingType"]);
        $errorBody = test_input($_POST["errorBody"]);
        $shutdown = test_input($_POST["shutdown"]);

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "INSERT INTO sensorNotifications.flower*Sensor (`batteryLevel`, `eta`, `charging`, `loggingType`, `errorBody`, `shutdown`) VALUES ('" . $batteryLevel . "', '" . $eta . "', '" . $charging . "', '" . $loggingType . "', '" . $errorBody . "' , '" . $shutdown . "')";
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        }else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
    }else if($api_key == $exteriorSensorAPIKey) {
        $batteryLevel = test_input($_POST["batteryLevel"]);
        $eta = test_input($_POST["eta"]);
        $charging = test_input($_POST["charging"]);
        $loggingType = test_input($_POST["loggingType"]);
        $errorBody = test_input($_POST["errorBody"]);
        $shutdown = test_input($_POST["shutdown"]);

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "INSERT INTO sensorNotifications.exteriorSensor (`batteryLevel`, `eta`, `charging`, `loggingType`, `errorBody`, `shutdown`) VALUES ('" . $batteryLevel . "', '" . $eta . "', '" . $charging . "', '" . $loggingType . "', '" . $errorBody . "' , '" . $shutdown . "')";
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        }else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
    } else {
        echo "Wrong API Key provided.";
    }
}else {
    echo "No data posted with HTTP POST.";
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
