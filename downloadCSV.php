<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Download Table</title>
		<?php include "./header.php" ?>
		<div style="padding-left:16px">
			<h2>Download Complete Table</h2>
			<p>Still working on specific date functionality, currently you get the entire table. Which in some cases, can take a while to compile.</p>
		</div>
	</head>
<div>
<body>
  <form id ="tableForm" class="form-horizontal" action="downloadCSVFunction.php" method="post" name="export_csv" enctype="multipart/form-data">
	<div class="form-group"><br>
		<div class="buttonIndent">
		<label for="SelectedDatabase">Select a Table: </label>
		<select name="SelectedDatabase" id="selectTable" form="tableForm">
			<option disabled selected=true value> -- Select an Option -- </option>
			<option value="ExteriorData">ExteriorData</option>
			<option value="FlowerData">FlowerData</option>
			<!--option value="InteriorData">InteriorSensorData</option//-->
		</select>
			 <input type="submit" name="Download CSV" class="btn btn-success" value="Export as CSV"/>
			</div>
		</div>
	</div>
  </form>
</body>
</div>
</html>
