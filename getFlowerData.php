<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $hostname = "localhost";
    $database = "sensorData";
    $username = getenv('SQLUSER');
    $password = getenv('SQLPASS');

    $conn = new mysqli($hostname, $username, $password, $database);

    if($conn -> connect_error){
        echo "Connect Error";
        die("Database Connection Error, Error No.: ".$conn->connect_errno." | ".$conn->connect_error);
        
    }
    $lastLoadedRow = $_SERVER['Last-Loaded-Row'];
    $query = "SELECT `ID`, `Sensor`, `Temperature(C)`, `Humidity(%)`, `Timestamp` FROM Flowers WHERE ID > $lastLoadedRow ORDER BY id DESC";
    $result = $conn->query($query);

    $data = array();
    echo $result;
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $data[] = $row;
        }
        
    }
    header('Content-Type: application/json');
    echo var_dump($data);
    echo json_encode($data);

    $conn->close();
?>