$(document).ready(function() {
    var last_id = 0; // initialize the last_id variable
    
    function fetchData() {
        // make an AJAX request to fetch new data
        $.ajax({
            url: 'get_sensor_data.php',
            type: 'POST',
            dataType: 'json',
            data: { last_id: last_id },
            success: function(response) {
                // loop through the new data and append it to the top of the table
                $.each(response, function(key, value) {
                    var row_id = value.id;
                    var row_location = value.Location;
                    var row_Temperature = value['Temperature(C)'];
                    var row_Humidity = value['Humidity(%)'];
                    var row_Pressure = value['Pressure(bar)'];
                    var row_PM01 = value['PM1.0'];
                    var row_PM25 = value['PM2.5'];
                    var row_PM10 = value['PM10'];
                    var row_reading_time = value.reading_time;
                    
                    var row = '<tr>\
                                  <td>' + row_id + '</td>\
                                  <td>' + row_location + '</td>\
                                  <td>' + row_Temperature + '</td>\
                                  <td>' + row_Humidity + '</td>\
                                  <td>' + row_Pressure + '</td>\
                                  <td>' + row_PM01 + '</td>\
                                  <td>' + row_PM25 + '</td>\
                                  <td>' + row_PM10 + '</td>\
                                  <td>' + row_reading_time + '</td>\
                              </tr>';
                              
                    $('#sensor-data tbody').prepend(row); // add the new row to the top of the table
                    
                    last_id = row_id; // update the last_id variable with the new row ID
                });
            },
            error: function(xhr, status, error) {
                console.log('Error: ' + error.message);
            }
        });
    }
    
    fetchData(); // fetch the initial data
    
    // set up a timer to fetch new data every 30 seconds
    setInterval(fetchData, 30000);
});
