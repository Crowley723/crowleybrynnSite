<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $hostname = "localhost";
    $database = "sensorData";
    $username = getenv('SQLUSER');
    $password = getenv('SQLPASS');
    //$data = '';
    try{
        $conn = new mysqli($hostname, $username, $password, $database);

        if($conn -> connect_error){
            throw new Exception("Database Connection Error, Error No.: ".$conn->connect_errno." | ".$conn->connect_error);
        }
        $headers = getallheaders();
        $lastLoadedRow = isset($headers['Last-Loaded-Row']) ? $headers['Last-Loaded-Row'] : null;
        if(is_null($lastLoadedRow)){
            $lastLoadedRow = 0;
        }
        if(isset($_GET['page'])){
            $page = $_GET['page'];
            $perPage = isset($_GET['perPage']) ? $_GET['perPage'] : 10;
            $offset = ($page - 1) * $perPage;
            $sql = "SELECT `ID`, `Temperature(C)`, `Pressure(bar)`, `Humidity(%)`, `PM1`, `PM2.5`, `PM10`, `Timestamp` FROM Exterior WHERE ID > " . $lastLoadedRow . " ORDER BY id DESC LIMIT $perPage OFFSET $offset";
        } else{
            //$sql = "SELECT `ID`, `Temperature(C)`, `Humidity(%)`, `Timestamp` FROM Flowers WHERE ID > " . $lastLoadedRow . " ORDER BY id DESC";
            $sql = "SELECT `ID`, `Temperature(C)`, `Pressure(bar)`, `Humidity(%)`, `PM1`, `PM2.5`, `PM10`, `Timestamp` FROM Exterior WHERE ID > " . $lastLoadedRow . " ORDER BY id DESC";
        }
        

        
        if($result = $conn->query($sql)){
            while($row = $result->fetch_assoc()){
                $row_id = $row["ID"];
                $row_Temperature = $row["Temperature(C)"];
                $row_Pressure = round(($row["Pressure(bar)"]/1000.0), 4); 
                $row_Humidity = $row["Humidity(%)"]; 
                $row_PM01 = $row["PM1"];
                $row_PM25 = $row["PM2.5"];
                $row_PM10 = $row["PM10"];
                $row_reading_time = $row["Timestamp"];
	            //$row_Pressure = ($row_Pressure / 1000.0);
                //changing temp to F - in the future there are plans to allow user to change units.
                $row_Temperature = round(($row_Temperature * (9.0/5.0)) + 32,3);
                

                $data[] = array(
                    'ID' => $row_id,
                    'Temperature(F)' => $row_Temperature,
                    'Pressure(bar)' => $row_Pressure,
                    'Humidity(%)' => $row_Humidity,
                    'PM1' => $row_PM01,
                    'PM2.5' => $row_PM25,
                    'PM10' => $row_PM10,
                    'Timestamp' => $row_reading_time
                );
            }
        } else {
            echo "Internal Server Error var result: " . $result; 
        }
        header('Content-Type: application/json');
        echo json_encode($data, JSON_THROW_ON_ERROR);

        $conn->close();
    } catch (Exception $e) {
        echo "Internal Server Error: " . $e->getMessage();
    }
?>