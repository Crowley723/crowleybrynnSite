jQuery(document).ready(function(){
    fetchData();
    setInterval(function(){
        fetchData();
    }, 30000);
});

function fetchData(){
    $.ajax({
        url: 'getFlowerDataSimple.php',
        type: 'GET',
        headers:{

        },
        dataType: 'json',
        success: function(data) {
            updatePage(data)

        }, error: function(xhr, status, error){
            console.log(status + ': ' + error);
        }
    });
}

function updatePage(data, callback) {
    var table = $('#dataTable');
    var tableBody = table.find('tbody');
    if (tableBody.length === 0) {
        tableBody = $('<tbody>');
        table.prepend(tableBody); // Prepend the table body to maintain newest item at the top
    }
    for (var i = data.length - 1; i >= 0; i--) {
        var point = data[i];

        console.log('Data: ' + data);
        console.log('HighestID: ' + highestId);
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

            // Prepend the new data point to the container
            tableBody.prepend(newRow);
        }
    }

}