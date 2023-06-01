$(document).ready(function() {
    var lastLoadedRow = 0;
    lastLoadedRow = fetchData(lastLoadedRow);
    setInterval(fetchData(lastLoadedRow), 30000);
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
                lastLoadedRow = updatePage(data);
            },
            
            // data: { last_id: last_id },
            // success: function(response) {
            //     // loop through the new data and append it to the top of the table
            //     $.each(response, function(key, value) {
            //         var row_id = value.id;
            //         var row_location = value.Location;
            //         var row_Temperature = value['Temperature(C)'];
            //         var row_Pressure = value['Pressure(bar)'];
            //         var row_Humidity = value['Humidity(%)'];
            //         var row_timestamp = value['Timestamp'];
                    
            //         var row = '<tr>\
            //                       <td>' + row_id + '</td>\
            //                       <td>' + row_location + '</td>\
            //                       <td>' + row_Temperature + '</td>\
            //                       <td>' + row_Humidity + '</td>\
            //                       <td>' + row_Pressure + '</td>\
            //                       <td>' + row_timestamp + '</td>\
            //                   </tr>';
                              
            //         $('#flowerData').html(row); // add the new row to the top of the table
                    
            //     });
            // },
            error: function(xhr, status, error) {
                console.log(status + ': ' + error);
            }
        });
    }
    function updatePage(data){
        var container = $('#dataTable');
        var existingDataPoints = container.children();
        var highestId = 0;

        for(var i = data.length -1; i>=0; i--){
            var point = data[i];
            if(point.id > highestId){
                highestId = point.id;
            }
        }
        return highestId;
    }