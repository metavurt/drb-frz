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
	<div class="large-12 small-12 alpha-horizontal omega-horizontal columns">
		<div class="row">
			<div class="small-5 columns">Team</div>
			<div class="small-1 columns text-center">1</div>
			<div class="small-1 columns text-center">2</div>
			<div class="small-1 columns text-center">3</div>
			<div class="small-4 columns text-center">Total Pins</div>
		</div>

<?php

	foreach ($this->data['data'] as $teamData) { 
		echo "<div class='row'>\n\t";
		echo "<div class='small-5 columns'>".$teamData['TeamName']."</div>\n\t";
		echo "<div class='small-1 columns text-center'>".$teamData['Game1']."</div>\n\t";
		echo "<div class='small-1 columns text-center'>".$teamData['Game2']."</div>\n\t";
		echo "<div class='small-1 columns text-center'>".$teamData['Game3']."</div>\n\t";
		echo "<div class='small-4 columns text-center'>".$teamData['TotalPins']."</div>\n";
		echo "</div>\n";
	}

?>

	</div>
</div>
    <script src="../drb/js/vendor/jquery.js"></script>
    <script src="../drb/js/foundation.min.js"></script>
    <script>
      $(document).foundation();
    </script>

</body>
</html>