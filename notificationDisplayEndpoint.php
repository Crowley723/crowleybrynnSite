<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Replace these values with your actual database and API key information
$servername = "localhost";
// REPLACE with your Database name
$dbname = "sensorNotifications";
// REPLACE with Database user
$username = getenv('NotiSQLUSER');
// REPLACE with Database user password
$password = getenv('NotiSQLPASS');

$validApiKey = getenv('NOTIFICATIONBASEKEY');

// Get the API key from the request

if($_SERVER["REQUEST_METHOD"] == "GET"){
    if(isset($_GET['api_key'])){
        $apiKey =  test_input($_GET["api_key"]);
    }else{
        echo "No API Key provided.";
        
        http_response_code(403);
        exit(-1);
    }
    if(isset($_GET['sensor'])){
        $sensor = test_input($_GET['sensor']);
    }else{
        echo "No Sensor Specified.";
        http_response_code(403);
        exit(-1);
    }
    echo "\n";

    if($apiKey == $validApiKey){
        $dbConn = new mysqli($servername, $username, $password, $dbname);
        if ($dbConn->connect_error) {
            die("Database connection failed: " . mysqli_connect_error());
        }
        if($sensor == "exterior"){
            // Perform a SQL query to retrieve information from the database
            $query = "SELECT * FROM sensorNotifications.exteriorSensor ORDER BY timestamp DESC LIMIT 1";
            $result = mysqli_query($dbConn, $query);
        } elseif($sensor == "flowers"){
            $query = "SELECT * FROM sensorNotifications.flowerSensor ORDER BY timestamp DESC LIMIT 1";
            $result = mysqli_query($dbConn, $query);
        } else{
            $result = "null";
        }
        
        if (!$result) {
            die("Database query failed: " . mysqli_error($dbConn));
        }
        
        // Fetch the data from the result
        $data = mysqli_fetch_assoc($result);
        // Close the database connection
        mysqli_close($dbConn);
        // Respond with the fetched data as JSON
        header("Content-Type: application/json");
        echo json_encode($data);



    } else{
        echo "Wrong API Key provided";
        http_response_code(403);
        exit();
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
