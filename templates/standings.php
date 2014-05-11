<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title><?php echo $this->data['page_title']; ?></title>
    <link rel="stylesheet" href="../drb/css/foundation.css" />
    <script src="../drb/js/vendor/modernizr.js"></script>
</head>

<body>

<div class="row">
	<div class="large-12 small-12 columns panel">

<?php

foreach ($this->data['data'] as $total) {
	echo $total['gTotal'].'</br />';
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