<?php
//error_reporting(E_ALL);
//ini_set('display_startup_errors', 1);
//ini_set('display_errors', 1);
$servername = "localhost";
// REPLACE with your Database name
$dbname = "sensorData";
// REPLACE with Database user
$username = getenv('SQLUSER');
// REPLACE with Database user password
$password = getenv('SQLPASS');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Connect to the SQL server
  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  //$selection = $_POST['SelectedDatabase'];
//  $selection = 'FlowerSensorData';
  $selection = "";;
  if (isset($_POST['SelectedDatabase'])) {
      $selection = $_POST['SelectedDatabase'];
  //    echo "Selected database: " . $selection;
      // rest of the code here
  } else {
      echo "SelectedDatabase is not set";
  }
  
  //header('Content-Disposition: attachment; filename=data.csv');
  
  if($selection == 'FlowerData'){
    header('Content-Type: text/csv; charset=utf-8');
    $filename = 'flowerData_' . date('m-d-Y') . '.csv';
    header('Content-Disposition: attachment; filename=' . $filename);
    header('Pragma: no-cache');
  } elseif($selection == 'ExteriorData'){
    header('Content-Type: text/csv; charset=utf-8');
    $filename = 'exteriorData_' . date('m-d-Y') . '.csv';
    header('Content-Disposition: attachment; filename=' . $filename);
    header('Pragma: no-cache');
  }
  


  $output = fopen("php://output", "w");

  if($selection == 'FlowerData'){
	  fputcsv($output, array('ID', 'Sensor', 'Location', 'Temperature(C)', 'Humidity(%)', 'Timestamp'));
	  $query = "SELECT * FROM `Flowers` ORDER BY id DESC";
	  $result = mysqli_query($conn, $query);
	  while ($row = mysqli_fetch_assoc($result)) {
	    fputcsv($output, $row);
  	  }
  } elseif($selection == 'ExteriorData'){
    fputcsv($output, array('ID', 'Sensor', 'Temperature(C)', 'Pressure(bar)', 'Humidity(%)', 'PM1', 'PM2.5', 'PM10', 'Timestamp'));
    $query = "SELECT `ID`, `Sensor`, `Temperature(C)`, `Pressure(bar)`, `Humidity(%)`, `PM1`, `PM2.5`, `PM10`, `Timestamp` FROM Exterior ORDER BY `ID` DESC";
    $result = mysqli_query($conn, $query);
    while($row = mysqli_fetch_assoc($result)) {
      fputcsv($output, $row);
    }
  }
  fclose($output);
  $conn->close();
  exit();
}
?>
<html>
<body>
  <title>Downloading CSV...</title>
  <h1>Downloading!</h1>
  <h2>You will be redirected when the download is complete...</h2>
<meta http-equiv="Refresh" content="0; url='https://www.crowleybrynn.com/downloadCSV.php'" />

<form method="post">
  <input type="submit" value="Download CSV">
</form>
</body>
</html>


