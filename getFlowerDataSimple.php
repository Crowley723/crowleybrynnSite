<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $hostname = "localhost";
    $database = "sensorData";
    $username = getenv('SQLUSER');
    $password = getenv('SQLPASS');
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
        $sql = "SELECT `ID`, `Temperature(C)`, `Humidity(%)`, `Timestamp` FROM Flowers WHERE ID > " . $lastLoadedRow . " ORDER BY id DESC";
        //$sql = "SELECT `ID`, `Temperature(C)`, `Humidity(%)`, `Timestamp` FROM Flowers ORDER BY id DESC";
        if($result = $conn->query($sql)){
            while($row = $result->fetch_assoc()){
                $row_id = $row["ID"]; 
                $row_Temperature = $row["Temperature(C)"];
                $row_Humidity = $row["Humidity(%)"];
                $row_timestamp = $row["Timestamp"];
                //changing temp to F - in the future there are plans to allow user to change units.
                $row_Temperature = round(($row_Temperature * (9.0/5.0)) + 32,3);
                

                $data[] = array(
                    'ID' => $row_id,
                    'Temperature(C)' => $row_Temperature,
                    'Humidity(%)' => $row_Humidity,
                    'Timestamp' => $row_timestamp
                );
            }
        }
        header('Content-Type: application/json');
        echo json_encode($data, JSON_THROW_ON_ERROR);

        $conn->close();
    } catch (Exception $e) {
        echo "Internal Server Error: " . $e->getMessage();
    }
?>