const dataCache = [];
var highestId = 0;

jQuery(document).ready(function(){
    fetchData(10);
   
});


function fetchData(numberOfRows){
    $.ajax({
        url: '/ajax/load-all/getExteriorDataAjax.php',
        type: 'GET',
        headers:{
            'Entries-To-Get': numberOfRows,
            'Last-Loaded-Row': 0
        },
        dataType: 'json',
        success: function(data) {
            cacheData(data)
            //loadPage();

        }, error: function(xhr, status, error){
            console.log(status + ': ' + error);
        }
    });
}

function cacheData(data){
    for(var i = data.length - 1; i>=0; i--){
        point = data[i];
        if(point != null && point.hasOwnProperty('ID')){
            if(point['ID'] > highestId){
                highestId = point['ID'];
            }
            dataCache[point['ID']] = point;
        }
    }
}


function loadPage(){
    let rowsPerPageElement = document.getElementById("itemsPerPage");
    let rowsPerPage = rowsPerPageElement.options[rowsPerPageElement.selectedIndex].value;
    console.log(rowsPerPage);
    fetchData(rowsPerPage);
    let currentPage = document.getElementById('currentPageNumber');
    var firstEntry;
    if(currentPage === 1){
        firstEntry = highestId;
    } else{
        firstEntry = highestId - currentPage * itemsPerPage;
    }
    var lastEntry = firstEntry - itemsPerPage;

    var table = $('#dataTable');
    var tableBody = table.find('tableBody');

    for(var i = lastEntry; i <= firstEntry; i++){
        var point = data[i];
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
            console.log(i);
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