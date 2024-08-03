<?php
class WeatherData {
    private $conn;
    private $table_name = "weather_data";
    public function __construct($db) {
        $this->conn = $db;
    }

    public function create($data) {
        $query = "INSERT INTO " . $this->table_name . "
                    SET temperature = :temperature,
                        humidity = :humidity,
                        pressure =: pressure,
                        `PM1.0` = :pm1, 
                        `PM2.5` = :pm25, 
                        `PM10` = :pm10";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":temperature", $data['temperature']);
        $stmt->bindParam(":humidity", $data['humidity']);
        $stmt->bindParam(":pressure", $data['pressure']);
        $stmt->bindParam(":pm1", $data['PM1.0']);
        $stmt->bindParam(":pm25", $data['PM2.5']);
        $stmt->bindParam(":pm10", $data['PM10']);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}