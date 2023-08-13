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
$api_key = $sensor = "";



if($_SERVER["REQUEST_METHOD"] == "GET"){
    if (isset($_GET['api_key']) && isset($_GET['sensor'])) {
        $api_key = htmlspecialchars($_GET['api_key']);
        $sensor = htmlspecialchars($_GET['sensor']);
    }else{
        $error_response = array('error' => 'Missing parameters');
        echo json_encode($error_response);
    }

    echo "\n";
    var_dump($validApiKey, $api_key);
    echo $validApiKey;
    echo $api_key;
    if($api_key == $validApiKey){
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
