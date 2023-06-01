<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Dyn. Load Flower Data</title>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <?php include "./header.php" ?>
    </head>
    <body>
        <h1 style="padding-left:16px">Flower Data</h1>
        <table id="dataTable" cellspacing="5" cellpadding="5" style="padding-left:7px">
        <tr>
          <td><b>ID</b></td>
          <td><b>Temperature(C)</b></td>
          <td><b>Humidity(%)</b></td>
          <td><b>Timestamp</b></td>
        </tr>
        <script src="./getFlowerData.js"></script>
    
        </table>
    </body>
</html>