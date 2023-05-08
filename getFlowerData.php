<?php

    $hostname = "localhost";
    $database = "sensorData";
    $username = getenv('SQLUSER');
    $password = getenv('SQLPASS');

    $conn = new mysqli($hostname, $database, $username, $password);

    if($conn -> connect_error){
        die("Database Connection Error, Error No.: ".$conn->connect_errno." | ".$conn->connect_error);
    }
    $query = "SELECT `ID`, `Sensor`, `Temperature(C)`, `Pressure(bar)`, `Humidity(%)`, `Timestamp` FROM Flowers ORDER BY id DESC";
    $connQuery = $conn->query($query);