<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title><?php echo $this->data['page_title']; ?></title>
    <link rel="stylesheet" href="../drb/css/foundation.css" />
    <link rel="stylesheet" href="../drb/css/drbfz.css" />
    <script src="../drb/js/vendor/modernizr.js"></script>
</head>

<body>

<div class="row">
	<div class="large-12 small-12 columns">
		<table>
			<thead>
			<tr>
				<th>Team</th>
				<th>Game 1</th>
				<th>Game 2</th>
				<th>Game 3</th>
				<th>Total Pins</th>
			</tr>
			</thead>
			<tbody>

<?php

	foreach ($this->data['data'] as $teamData) { 
		echo "<tr>\n\t";
		echo "<td>".$teamData['TeamName']."</td>\n\t";
		echo "<td>".$teamData['Game1']."</td>\n\t";
		echo "<td>".$teamData['Game2']."</td>\n\t";
		echo "<td>".$teamData['Game3']."</td>\n\t";
		echo "<td>".$teamData['TotalPins']."</td>\n";
		echo "</tr>\n";
	}

?>
			</tbody>
		</table>

	</div>
</div>
    <script src="../drb/js/vendor/jquery.js"></script>
    <script src="../drb/js/foundation.min.js"></script>
    <script>
      $(document).foundation();
    </script>

</body>
</html>