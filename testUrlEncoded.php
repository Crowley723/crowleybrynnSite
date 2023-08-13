<?php
// Check if the request method is GET
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Check if the 'api_key' and 'sensor' parameters are present in the query string
    if (isset($_GET['api_key']) && isset($_GET['sensor'])) {
        // Retrieve and sanitize the values of 'api_key' and 'sensor'
        $api_key = htmlspecialchars($_GET['api_key']);
        $sensor = htmlspecialchars($_GET['sensor']);
        
        // You can now use the $api_key and $sensor variables for further processing
        // For example, you can perform API key validation, data processing, etc.
        
        // Respond with a success message
        $validApiKey = getenv('NOTIFICATIONBASEKEY');
        if($api_key == $validApiKey){
            $response = array('message' => 'Request successful', 'api_key' => $api_key, 'sensor' => $sensor);
            echo json_encode($response);
        }else {
            // Respond with an error message if 'api_key' and 'sensor' parameters are missing
            $error_response = array('error' => 'Wrong api key');
            echo json_encode($error_response);
        }
        
    } else {
        // Respond with an error message if 'api_key' and 'sensor' parameters are missing
        $error_response = array('error' => 'Missing parameters');
        echo json_encode($error_response);
    }
} else {
    // Respond with an error message for unsupported request methods
    $error_response = array('error' => 'Unsupported request method');
    echo json_encode($error_response);
}
?>
