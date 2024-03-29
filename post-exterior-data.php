<?php

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);



//require_once '/vars.php';
$servername = getenv('SQLHOSTNAME');
// REPLACE with your Database name
$dbname = "sensorData";
// REPLACE with Database user
$username = getenv('SQLUSER');
// REPLACE with Database user password
$password = getenv('SQLPASS');
$flower_sensor_api_key = getenv('EXTERIORSENSORKEY');

// Keep this API Key value to be compatible with the ESP32 code provided in the project page. 
// If you change this value, the ESP32 sketch needs to match

//$api_key_value = "key";
$api_key = $Sensor = $Temperature = $Humidity = $Pressure = $PM01 = $PM25 = $PM10 = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $api_key = test_input($_POST["api_key"]);
    //echo "\nAPI_Key:";
    //echo $api_key;
    //echo "\nAPI_Key_Value:";
    //echo $api_key_value;
    //echo "\n";
    if($api_key == $api_key_value) {
        $sensor = test_input($_POST["Sensor"]);
        $Temperature = test_input($_POST["Temperature"]);
        $Pressure = test_input($_POST["Pressure"]);
        $Humidity = test_input($_POST["Humidity"]);
        $PM01 = test_input($_POST["PM01"]);
        $PM25 = test_input($_POST["PM25"]);
        $PM10 = test_input($_POST["PM10"]);

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
//        $sql = "INSERT INTO SensorData (Sensor, Location, Temperature(C), Humidity(%), Pressure(bar)) VALUES ('" . $sensor . "', '" . $location . "', '" . $Temperature . "', '" . $Humidity . "', '" . $Pressure . "')";
$sql = "INSERT INTO Exterior (`Sensor`, `Temperature(C)`, `Pressure(bar)`, `Humidity(%)`, `PM1`, `PM2.5`, `PM10`) VALUES ('" . $Sensor . "', '" . $Temperature . "', '" . $Pressure . "', '" . $Humidity . "', '" . $PM01 . "', '" . $PM25 . "' , '" . $PM10 . "')";

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

}
else {
    echo "No data posted with HTTP POST.";
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
