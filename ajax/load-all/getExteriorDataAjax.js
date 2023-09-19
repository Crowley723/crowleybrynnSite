var highestId = "0";

jQuery(document).ready(function(){
    fetchData();
    setInterval(function(){
        fetchData();
    }, 30000);
});

function fetchData(){
    $.ajax({
        url: '/ajax/load-all/getExteriorDataAjax.php',
        type: 'GET',
        headers:{
            'Last-Loaded-Row': highestId
        },
        dataType: 'json',
        success: function(data) {
            updatePage(data)
            console.log(highestId);

        }, error: function(xhr, status, error){
            console.log(status + ': ' + error);
        }
    });
}

function updatePage(data) {
    var table = $('#dataTable');
    var tableBody = table.find('tbody');
    if (tableBody.length === 0) {
        tableBody = $('<tbody>');
        table.prepend(tableBody); // Prepend the table body to maintain newest item at the top
    }
    //console.log(typeof data)
    if(data.length > 0 && data != null){
        for (var i = data.length - 1; i >= 0; i--) {
            var point = data[i];
            //console.log(data[i]);
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
                //console.log("Point has correct properties!");
                // Create and append the HTML for the data point
                if(parseInt(point['ID']) > parseInt(highestId)){
                    highestId = point['ID'];
                }
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
}
