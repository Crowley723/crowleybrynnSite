<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../config/ApiKeyAuth.php';
include_once '../models/WeatherData.php';

$database = new Database();
$db = $database->getConnection();

// Check for API key in the request headers
$headers = getallheaders();
$api_key = isset($headers['X-API-Key']) ? $headers['X-API-Key'] : null;

if (!$api_key || !authenticateApiKey($db, $api_key)) {
    http_response_code(401);
    echo json_encode(array("message" => "Unauthorized. Invalid or missing API key."));
    exit();
}

$weather_data = new WeatherData($db);

$data = json_decode(file_get_contents("php://input"));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        !empty($data->temperature) &&
        !empty($data->humidity) &&
        !empty($data->pressure) &&
        !empty($data->PM1_0) &&
        !empty($data->PM2_5) &&
        !empty($data->PM10)
    ) {
        $input_data = array(
            "temperature" => $data->temperature,
            "humidity" => $data->humidity,
            "pressure" => $data->pressure,
            "PM1.0" => $data->PM1_0,
            "PM2.5" => $data->PM2_5,
            "PM10" => $data->PM10
        );

        if ($weather_data->create($input_data)) {
            http_response_code(201);
            echo json_encode(array("message" => "Weather data was created."));
        } else {
            http_response_code(503);
            echo json_encode(array("message" => "Unable to create weather data."));
        }
    } else {
        http_response_code(400);
        echo json_encode(array("message" => "Unable to create weather data. Data is incomplete."));
    }
} else {
    http_response_code(405);
    echo json_encode(array("message" => "Method not allowed."));
}