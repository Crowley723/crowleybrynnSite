<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Testing Ajax</title>
    <?php include "./header.php" ?>
  <head>
  <body>
  <div id="demo">
    <h2>Letting AJAX change this test!</h2>
    <button type="button" onclick="loadDoc()">Change Content</button>
  </body>
  <script>
    function loadDoc() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
       document.getElementById("demo").innerHTML = this.responseText;
      }
    };
    xhttp.open("GET", "ajax_info.txt", true);
    xhttp.send();
  }
  </script>

</html>