

<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Flower Sensor Data</title>
		<?php include "./header.php" ?>
  </head>
  <body>
  <div style="padding-left:16px">
    <h2>Flower Sensor Data</h2>
    <p>The sensor being used for PHT is the MS8607</p>
    <p>Planned: Sorting, Pages, Entries Per Page</p>
  </div>
  <?php
    //ini_set('display_errors', 1);
    //ini_set('display_startup_errors', 1);
    //error_reporting(E_ALL);
  
    //require_once '/vars.php';
    $servername = "localhost";
    $dbname = "sensorData";
    $username = getenv('SQLUSER');
    $password = getenv('SQLPASS');
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT `ID`, `Sensor`, `Temperature(C)`, `Humidity(%)`, `Timestamp`  FROM Flowers ORDER BY id DESC";

    echo '<table cellspacing="5" cellpadding="5" style="padding-left:7px">
          <tr>
            <td><b>ID</b></td>
            <td><b>Sensor</b></td>
            <td><b>Temperature(F)</b></td>
            <td><b>Humidity(%)</b></td>
            <td><b>Timestamp</b></td>
          </tr>';

    if ($result = $conn->query($sql)) {
        while ($row = $result->fetch_assoc()) {
            $row_id = $row["ID"]; 
            $row_sensor = $row["Sensor"];
            $row_Temperature = $row["Temperature(C)"];
            $row_Humidity = $row["Humidity(%)"];
            $row_reading_time = $row["Timestamp"];

      $row_Temperature = ($row_Temperature * (9.0/5.0)) + 32;
      //$row_Pressure = ($row_Pressure / 1000.0);
            // Uncomment to set timezone to - 1 hour (you can change 1 to any number)
            //$row_reading_time = date("Y-m-d H:i:s", strtotime("$row_reading_time - 1 hours"));
          
            // Uncomment to set timezone to + 4 hours (you can change 4 to any number)
            //$row_reading_time = date("Y-m-d H:i:s", strtotime("$row_reading_time + 4 hours"));
            echo '<tr>
                    <td>' . $row_id . '</td>
                    <td>' . $row_sensor . '</td>
                    <td>' . $row_Temperature . '</td>
                    <td>' . $row_Humidity . '</td>
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
