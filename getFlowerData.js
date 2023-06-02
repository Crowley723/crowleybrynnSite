jQuery(document).ready(function() {
    var lastLoadedRow = 0;
    lastLoadedRow = fetchData(lastLoadedRow);
    setInterval(function(){
        fetchData(lastLoadedRow)
    }, 30000);
});

    
    function fetchData(lastLoadedRow) {
        // make an AJAX request to fetch new data
        $.ajax({
            url: 'getFlowerData.php',
            type: 'GET',
            headers:{
                'Last-Loaded-Row': lastLoadedRow
            },
            dataType: 'json',
            success: function(data){
                updatePage(data, lastLoadedRow);
                console.log(`Last-Loaded-Row: ${lastLoadedRow}`);
            },
            error: function(xhr, status, error) {
                console.log(status + ': ' + error);
            }
        });
        return lastLoadedRow;
    }
    function updatePage(data, lastLoadedRow){
        var table = $('#dataTable');
        var highestId = 0;
        var tableBody = table.find('tbody');
        if (tableBody.length === 0) {
            tableBody = $('<tbody>');
            table.append(tableBody);
          }

        for(var i = data.length - 1; i >= 0; i--){
            
            var point = data[i];

            if(point.id > highestId){
                highestId = point.id;
            }
            if (
                point.hasOwnProperty('ID') &&
                point.hasOwnProperty('Temperature(C)') &&
                point.hasOwnProperty('Humidity(%)') &&
                point.hasOwnProperty('Timestamp')
              ) {                
                // Create and append the HTML for the data point
                var newRow = $('<tr>');
                newRow.append('<td>' + point['ID'] + '</td>');
                newRow.append('<td>' + point['Temperature(C)'] + '</td>');
                newRow.append('<td>' + point['Humidity(%)'] + '</td>');
                newRow.append('<td>' + point['Timestamp'] + '</td>');
                
                
                // Append the new data point to the container
                tableBody.prepend(newRow);
            }
        
        }
        if (highestId > lastLoadedRow){
            return highestId;
        } else{
            return lastLoadedRow;
        }
        
    }