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
        <style>
        #dataTable {
            padding-left: 7px;
        }
        #pagination {
            display: inline-block;
            margin: 0 auto;
            padding: 7px;
        }
        </style>
        <?php include "../../header.php" ?>
    </head>
    <body>
        <h1 style="padding-left:16px">Exterior Data</h1>
        <div>
            <table id="dataTable" cellspacing="5" cellpadding="5">
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
                <tbody id="tableBody"></tbody>
            </table>
            <div id="pagination">
                <button id="prevPage">Previous Page</button>
                Page <span id="currentPageNumber">1</span>
                <button id="nextPage">Next Page</button>
                <select id="itemsPerPage">
                    <option value="10">10 items per page</option>   
                    <option value="25">25 items per page</option>
                    <option value="50">50 items per page</option>
                </select>
            </div>
        </div>

        <!--script src="./loadExteriorDataPaginated.js"></script-->
        <script>
            const dataCache = [];
            var highestId = 0;
            //console.log("Hello!");

            document.addEventListener('DOMContentLoaded', function() {
                loadPage();
            });
            
            function fetchData(numberOfRows, startingElement){
                $.ajax({
                    url: '/ajax/load-all/getExteriorDataAjax.php',
                    type: 'GET',
                    headers:{
                        'Entries-To-Get': numberOfRows,
                        'Starting-Element': startingElement,
                        'Last-Loaded-Row': highestId
                    },
                    dataType: 'json',
                    success: function(data) {
                        cacheData(data);
                        console.log(data);

                    }, error: function(xhr, status, error){
                        console.log(status + ': ' + error);
                    }
                });
            }
            function cacheData(data){
                for(var i = data.length - 1; i>=0; i--){
                    point = data[i];
                    if(point != null && point.hasOwnProperty('ID')){
                        console.log("Point: " + point); 
                        if(point['ID'] > highestId){
                            highestId = point['ID'];
                            console.log("HighestID: " + highestId);
                        }
                        dataCache[point['ID']] = point;
                        //console.log("ID: " + point['ID']);
                    }
                }
            }
            function loadPage(){
                let rowsPerPageElement = document.getElementById("itemsPerPage");
                let rowsPerPage = rowsPerPageElement.options[rowsPerPageElement.selectedIndex].value;
                console.log("Rows Per Page: " + rowsPerPage);
                
                let currentPage = document.getElementById("currentPageNumber").textContent;
                console.log("Current Page: " + currentPage);

                var firstEntry;
                console.log("Highest ID: " + highestId);
                if(currentPage == 1){
                    firstEntry = highestId;
                } else{
                    firstEntry = highestId - (currentPage * rowsPerPage);
                }
                if(firstEntry == 0){
                    lastEntry = 0
                    firstEntry = 10;
                } else{
                    var lastEntry = firstEntry - rowsPerPage;
                }
                

                console.log("First Entry: " + firstEntry);
                console.log("Last Entry: " + lastEntry);
                
                fetchData(rowsPerPage, lastEntry);

                var table = $('#dataTable');
                var tableBody = table.find('tableBody');
                

                for(var i = lastEntry; i <= firstEntry; i++){
                    var point = dataCache[i];
                    console.log("Data["+ i+"]: "+dataCache[i]); 
                    if (
                        point.hasOwnProperty('ID') &&
                        point.hasOwnProperty('Temperature(F)') &&
                        point.hasOwnProperty('Pressure(bar)') &&
                        point.hasOwnProperty('Humidity(%)') &&
                        point.hasOwnProperty('PM1') &&
                        point.hasOwnProperty('PM2.5') &&
                        point.hasOwnProperty('PM10') &&
                        point.hasOwnProperty('Timestamp')
                    ) {
                        console.log("Point has the properties!" + point);
                        var newRow = $('<tr>');
                        newRow.append('<td>' + point['ID'] + '</td>');
                        newRow.append('<td>' + point['Temperature(F)'] + '</td>');
                        newRow.append('<td>' + point['Pressure(bar)'] + '</td>');
                        newRow.append('<td>' + point['Humidity(%)'] + '</td>');
                        newRow.append('<td>' + point['PM1'] + '</td>');
                        newRow.append('<td>' + point['PM2.5'] + '</td>');
                        newRow.append('<td>' + point['PM10'] + '</td>');
                        newRow.append('<td>' + point['Timestamp'] + '</td>');

                        // Prepend the new data point to the container
                        tableBody.prepend(newRow);
                    } else{
                        console.log("Point doesnt have correct properties!");
                        //console.log(point);
                    }
                }

            }
            </script>
    </body>
</html>