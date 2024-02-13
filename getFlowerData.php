<?php

    //ini_set('display_errors', 1);
    //ini_set('display_startup_errors', 1);
    //error_reporting(E_ALL);

    $servername = getenv('SQLHOSTNAME');
    $database = "sensorData";
    $username = getenv('SQLUSER');
    $password = getenv('SQLPASS');

    $conn = new mysqli($hostname, $username, $password, $database);

    if($conn -> connect_error){
        die("Database Connection Error, Error No.: ".$conn->connect_errno." | ".$conn->connect_error);
        
    }
    $headers = getallheaders();
    $lastLoadedRow = isset($headers['Last-Loaded-Row']) ? $headers['Last-Loaded-Row'] : null;
    if(is_null($lastLoadedRow)){
        $lastLoadedRow = 0;
    }
    $query = "SELECT `ID`, `Temperature(C)`, `Humidity(%)`, `Timestamp` FROM Flowers WHERE ID > " . $lastLoadedRow . " ORDER BY id DESC";
    $result = $conn->query($query);

    $data = array();
    if($result->num_rows > 0){
        $data = $result->fetch_all(MYSQLI_ASSOC);
    }
    header('Content-Type: application/json');
    echo json_encode($data, JSON_THROW_ON_ERROR);

    $conn->close();
?>