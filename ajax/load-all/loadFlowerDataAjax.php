<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Dyn. Load Flower Data</title>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <?php include "../../header.php" ?>
    </head>
    <body>
        <h1 style="padding-left:16px">Flower Data</h1>
        <table id="dataTable" cellspacing="5" cellpadding="5" style="padding-left:7px">
        <thead>
            <tr>
            <th><b>ID</b></th>
            <th><b>Temperature(C)</b></th>
            <th><b>Humidity(%)</b></th>
            <th><b>Timestamp</b></th>
            </tr>
        </thead>
            <tbody id="tableBody">
            </tbody>
        </table>
        <script src="./getFlowerDataAjax.js"></script>
    </body>
</html>