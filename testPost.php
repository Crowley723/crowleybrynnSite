<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


 print_r(var_dump($_REQUEST));
echo "\n";
print_r(apache_request_headers());
echo "\n";
print_r(apache_response_headers());
echo "\n";
print_r($_SERVER);
//echo "\n";
//print_r(file_get_contents('php://input');
echo "\n Done!\n";
 ?>
