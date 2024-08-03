<?php
function authenticateApiKey($db, $api_key) {
    $query = "SELECT * FROM api_keys WHERE api_key = :api_key";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":api_key", $api_key);
    $stmt->execute();
    
    if ($stmt->rowCount() > 0) {
        return true;
    }
    return false;
}