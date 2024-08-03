<?php
class Database {
    private $host;
    private $dbname = "weather_station";
    private $username;
    private $password;
    public $conn;

    public function __construct() {
        $this->host = getenv('SQLHOSTNAME');
        $this->username = getenv('SQLUSER');
        $this->password = getenv('SQLPASS');
    }

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbname, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }
}