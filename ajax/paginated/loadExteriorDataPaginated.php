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
                <button id="prevPage" onclick=onPrevPageButton()>Previous Page</button>
                Page <span id="currentPageNumber">1</span>
                <button id="nextPage" onclick=onNextPageButton()>Next Page</button>
                <select id="itemsPerPage" onchange=changeItemsPerPage()>
                    <option value="10">10 items per page</option>   
                    <option value="25">25 items per page</option>
                    <option value="50">50 items per page</option>
                </select>
            </div>
        </div>
        <!--script src="./loadExteriorDataPaginated.js"></script-->
        <script>
            var previousPageNumber = 1;
            var currentPageNumber = 1;
            var itemsPerPage = 10;
            var currentPage = [];
            var nextPage = [];
            var previousPage = [];

            document.addEventListener('DOMContentLoaded', function(){
                //loadPageData(1);
            
            
            
            });

            function changeItemsPerPage(){
                let itemsPerPageElement = document.getElementById("itemsPerPage");
                itemsPerPage = itemsPerPageElement.value;
                console.log("Changed Items Per Page to " + itemsPerPage);

            }
            
            function onPrevPageButton(){
                let currentPageNumberElement = document.getElementById("currentPageNumber");
                let currentPageNumber = parseInt(currentPageNumberElement.innerText);
                
                if(currentPageNumber > 1){
                    previousPage = currentPageNumber;
                    currentPageNumberElement.innerText = currentPageNumber - 1;
                    
                    loadPageData(currentPageNumber - 1);
                } else if(currentPageNumber <= 1){
                    currentPageNumberElement.innerText = 1;
                    loadPageData(1);
                }
                
           
            }
            function onNextPageButton(){
                let currentPageNumberElement = document.getElementById("currentPageNumber");
                currentPageNumber = parseInt(currentPageNumberElement.innerText);
                previousPage = currentPageNumber;
                currentPageNumberElement.innerText = currentPageNumber + 1;
                if(currentPageNumber >= 1){
                    loadPageData(currentPageNumber + 1);
                }else if(currentPageNumber < 1){
                    currentPageNumberElement.innerText = 1;
                    loadPageData(1);
                }
                loadPageData(currentPageNumber + 1);
           
            }
            function loadPageData(pageNumber){
                //console.log(parseInt(document.getElementById("currentPageNumber").innerText) + " == " + previousPageNumber);
                if(parseInt(document.getElementById("currentPageNumber").innerText) == previousPageNumber){ 
                    //console.log(parseInt(document.getElementById("currentPageNumber").innerText) + " == " + previousPageNumber);
                    console.log("Didnt load page "+ pageNumber);
                    return;
                }
                console.log("Load Page " + pageNumber + " Data");
            }
            function fetchData(itemsPerPage, currentPageNumber){
                $.ajax({
                    url: '/ajax/load-all/getExteriorDataAjax.php',
                    type: 'GET',
                    headers:{
                        'Entries-To-Get': itemsPerPage,
                        'Page-To-Get': currentPageNumber,
                    },
                    dataType: 'json',
                    success: function(data){
                        cacheData(data);
                    }, error: function(xhr, status, error){
                        console.log(status + ': ' + error);
                    }
                });
            }
            function cacheData(data){

            }
            
        </script>
    </body>
</html>