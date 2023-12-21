<?php

$SQLHostname = getenv('SQLHOSTNAME');
$DBUsername = getenv('DOORUSER');
$DBPassword = getenv('DOORPASS');
$DBName = getenv('DOORDB');

define('DOORSENSORAPIKEY', getenv('DOORAPIKEY'));

$body = file_get_contents("php://input");
$payload = json_decode($body, true);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if(signatureMatchesDoorSensorApiKey($body)){
        $databaseConnection = new mysqli($SQLHostname, $DBUsername, $DBPassword, $DBName);
        if ($databaseConnection->connect_error) {
            die("Connection failed: " . $databaseConnection->connect_error);
        }
        $preparedQuery = $databaseConnection->prepare("INSERT INTO SensorHistory (status) VALUES (?)");
        $preparedQuery->bind_param("i", $newDoorStatus);

        $newDoorStatus = $payload['status'];

        if($preparedQuery->execute()){
            echo "New record created successfully";
        } else {
            echo "Error: <br>" . $databaseConnection->error;
        }
        $databaseConnection->close();
    } else{
        http_response_code(403);
        echo "Unauthorized";
    }
    

} else{
    http_response_code(501);
    echo "Unsupported Request";
}



function signatureMatchesDoorSensorApiKey($body){
    $headers = getallheaders();

    if (isset($headers['X-Hub-Signature-256'])) {
	$signature = $headers['X-Hub-Signature-256'];
	$expectedSignature = 'sha256=' . hash_hmac('sha256', $body, DOORSENSORAPIKEY);
	return hash_equals($expectedSignature, $signature);
    }else {
        return false;
    }
}

if (!function_exists('getallheaders')) {
    function getallheaders() {
        $headers = [];
        foreach ($_SERVER as $name => $value) {
            if (substr($name, 0, 5) == 'HTTP_') {
                $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
            }
        }
        return $headers;
    }
}
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
