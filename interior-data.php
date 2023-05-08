<!DOCTYPE html>
<html>
  <head>
    <title>Interior Sensor Data</title>
    <?php include "./header.php" ?>

<div style="padding-left:16px">
  <h2>Interior Sensor Data</h2>
  <p>Planned: Sorting, Pages, Entries Per Page...</p>
</div>

  </head>

<?php
require_once '/vars.php';
$servername = "localhost";
$dbname = "esp_data";
$username = $mysql_username;
$password = $mysql_password;
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT id, `sensor`, `location`, `Temperature`, `Humidity`, `Pressure`, reading_time FROM InteriorSensorData ORDER BY id DESC";

echo '<table cellspacing="5" cellpadding="5">
      <tr>
        <td>ID</td>
        <td>Sensor</td>
        <td>Location</td>
        <td>Temperature(C)</td>
        <td>Humidity(%)</td>
        <td>Pressure(bar)</td>
        <td>Timestamp</td>
      </tr>';

if ($result = $conn->query($sql)) {
    while ($row = $result->fetch_assoc()) {
        $row_id = $row["id"];
        $row_sensor = $row["sensor"];
        $row_location = $row["location"];
        $row_Temperature = $row["Temperature"];
        $row_Humidity = $row["Humidity"]; 
        $row_Pressure = $row["Pressure"]; 
        $row_reading_time = $row["reading_time"];
        // Uncomment to set timezone to - 1 hour (you can change 1 to any number)
        //$row_reading_time = date("Y-m-d H:i:s", strtotime("$row_reading_time - 1 hours"));
      
        // Uncomment to set timezone to + 4 hours (you can change 4 to any number)
        //$row_reading_time = date("Y-m-d H:i:s", strtotime("$row_reading_time + 4 hours"));
      
        echo '<tr> 
                <td>' . $row_id . '</td> 
                <td>' . $row_sensor . '</td> 
                <td>' . $row_location . '</td> 
                <td>' . $row_Temperature . '</td> 
                <td>' . $row_Humidity . '</td>
                <td>' . $row_Pressure . '</td> 
                <td>' . $row_reading_time . '</td> 
              </tr>';
    }
    $result->free();
}

$conn->close();


?>
</table>
</body>
</html>
