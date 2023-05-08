

<?php

//require_once '';
$servername = "localhost";
$dbname = "esp_data";
$username = $mysql_username;
$password = $mysql_password;
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$last_update = $_GET['last_update'];


$sql = "SELECT id, `Sensor`, `Location`, `Temperature(C)`, `Humidity(%)`, `Pressure(bar)`, `PM1.0`, `PM2.5`, `PM10`, reading_time FROM SensorData ORDER BY id ASC";

if ($result = $conn->query($sql)) {
    $rows = array();
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
    $result->free();
    echo json_encode($rows);
}else {
	echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>
