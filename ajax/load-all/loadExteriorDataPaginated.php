<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Dyn. Load Exterior Data Pagination</title>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <?php include "../../header.php" ?>
    </head>
    <body>
        <h1 style="padding-left:16px">Exterior Data</h1>
        <table id="dataTable" cellspacing="5" cellpadding="5" style="padding-left:7px">
        <thead>
            <tr>
            <th><b>ID</b></th>
            <th><b>Temperature(F)</b></th>
            <th><b>Pressure(bar)</b></th>
            <th><b>Humidity(%)</b></th>
            <th><b>PM1</b></th>
            <th><b>PM2.5</b></th>
            <th><b>PM10</b></th>
            <th><b>Timestamp</b></th>
            </tr>
        </thead>
            <tbody id="tableBody">
            </tbody>
        </table>
        <div id="pagination">
            <button id="prevPage">Previous Page</button>
            <span id="currentPage">Page 1</span>
            <button id="nextPage">Next Page</button>
            <select id="itemsPerPage">
                <option value="10">10 items per page</option>
                <option value="20">20 items per page</option>
                <option value="30">30 items per page</option>
            </select>
        </div>

        <script src="./getExteriorDataAjaxPaginated.js"></script>
    </body>
</html>