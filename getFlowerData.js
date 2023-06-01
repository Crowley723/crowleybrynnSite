jQuery(document).ready(function() {
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
            

            error: function(xhr, status, error) {
                console.log(status + ': ' + error);
            }
        });
    }
    function updatePage(data){
        var container = $('#dataTable');
        var existingDataPoints = container.children();
        var highestId = 0;

        for(var i = data.length - 1; i >= 0; i--){
            var point = data[i];
            if(point.id > highestId){
                highestId = point.id;
            }
            var dataPoint = $('<div>').addClass('dataPoint');
            var html = point.temperature + ' | ' + point.pressure + ' | ' + point.humidity;
            dataPoint.text(html);
            container.prepend(dataPoint);

        
        }
        return highestId;
    }