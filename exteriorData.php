
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Exterior Sensor Data</title>
    <?php include "./header.php" ?>
  </head>

<body>
  <div style="padding-left:16px">
		<h2>Exterior Sensor Data</h2>
    <p>Most of the data is from inside, I need to design and print a housing for the sensors.</p>
    <p>I am still working on converting the various air quality reading to a format similar to the EPA's AQI number. </p>
    <p>The sensor being used for PHT is the MS8607 and the sensor for the Particulate Matter Readings is the PMS5003. </p>
    <p>The PM1.0, PM2.5, and PM10 are in units of µg or micrograms per cubic meter</p>
	</div>
  <?php
  //ini_set('display_errors', 1);
  //ini_set('display_startup_errors', 1);
  //error_reporting(E_ALL);

$servername = "localhost";
// REPLACE with your Database name
$dbname = "sensorData";
// REPLACE with Database user
$username = getenv('SQLUSER');
// REPLACE with Database user password
$password = getenv('SQLPASS');

$conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
  $sql = "SELECT `ID`, `Sensor`, `Temperature(C)`, `Pressure(bar)`, `Humidity(%)`, `PM1`, `PM2.5`, `PM10`, `Timestamp` FROM Exterior ORDER BY `ID` DESC";

  echo '<table cellspacing="5" cellpadding="5" style="padding-left:7px">
        <tr>
          <td><b>ID</b></td>
          <td><b>Sensor</b></td>
          <td><b>Temperature(C)</b></td>
          <td><b>Pressure(bar)</b></td>
          <td><b>Humidity(%)</b></td>
          <td><b>PM1.0</b></td>
          <td><b>PM2.5</b></td>
          <td><b>PM10</b></td>
          <td><b>Timestamp</b></td>
        </tr>';
  if ($result = $conn->query($sql)) {
      while ($row = $result->fetch_assoc()) {
          $row_id = $row["ID"];
          $row_Sensor = $row["Sensor"];
          $row_Temperature = $row["Temperature(C)"];
          $row_Pressure = $row["Pressure(bar)"]; 
          $row_Humidity = $row["Humidity(%)"]; 
          $row_PM01 = $row["PM1"];
          $row_PM25 = $row["PM2.5"];
          $row_PM10 = $row["PM10"];
          $row_reading_time = $row["Timestamp"];
	  $row_Pressure = ($row_Pressure / 1000.0);

          // Uncomment to set timezone to - 1 hour (you can change 1 to any number)
          //$row_reading_time = date("Y-m-d H:i:s", strtotime("$row_reading_time - 1 hours"));
    
          // Uncomment to set timezone to + 4 hours (you can change 4 to any number)
          //$row_reading_time = date("Y-m-d H:i:s", strtotime("$row_reading_time + 4 hours"));
        
          echo '<tr>
                  <td>' . $row_id . '</td>
                  <td>' . $row_Sensor . '</td>
                  <td>' . $row_Temperature . '</td>
                  <td>' . $row_Pressure . '</td>
                  <td>' . $row_Humidity . '</td>
                  <td>' . $row_PM01 . '</td>
                  <td>' . $row_PM25 . '</td>
                  <td>' . $row_PM10 . '</td>
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
