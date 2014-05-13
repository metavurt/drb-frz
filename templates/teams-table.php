<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title><?php echo $this->data['page_title']; ?></title>
    <link rel="stylesheet" href="/drb/css/foundation.css" />
    <link rel="stylesheet" href="/drb/css/drbfz.css" />
    <script src="/drb/js/vendor/modernizr.js"></script>
</head>

<body>

<div class="off-canvas-wrap" data-offcanvas="">
    <div class="inner-wrap">
        <nav class="tab-bar drb-bg-red">
            <section class="left-small">
                <a class="left-off-canvas-toggle menu-icon" href="#"><span></span></a>
            </section>

            <section class="middle tab-bar-section">
                <h1 class="title">DRB Thur Mixed</h1>
            </section>
        </nav>

        <aside class="left-off-canvas-menu drb-bg-drd">
            <ul class="off-canvas-list">
                <li><a href="/drb/">Weekly Standings</a></li>
                <li><a href="index.php/teams">Teams</a></li>
                <li><a href="index.php/players">Players</a></li>
            </ul>
        </aside>

        <section class="main-section">
            <!-- MAIN CONTENT GOES HERE -->
			<div class="row">
				<div class="large-12 small-12 alpha-horizontal omega-horizontal columns">
					<table class="drb-standings">
					<thead>
						<tr>
							<th></th>
							<th>Player</th>
							<th class="text-center">Pins</th>
							<th class="text-center">Games</th>
							<th class="text-center">Avg</th>
							<th class="text-center">H*</th>
						</tr>
					</thead>
					<tbody>

					<?php
						
						$c = 1;

						foreach ($this->data['data'] as $playerData) { 
							echo "<tr>\n\t";
							echo "<td>".$c."</td>\n\t";
							echo "<td>".$playerData['pname']."</td>\n\t";
							echo "<td class='text-center'>".$playerData['tpins']."</td>\n\t";
							echo "<td class='text-center'>".$playerData['gms']."</td>\n\t";
							echo "<td class='text-center'>".$playerData['avgs']."</td>\n\t";
							echo "<td class='text-center'>".$playerData['hnd']."</td>\n";
							echo "</tr>\n";
							$c++;
						}

					?>
					</tbody>
					</table>
				</div>
			</div>

        </section><a class="exit-off-canvas"></a>
    </div>
</div>


<script src="/drb/js/vendor/jquery.js"></script>
<script src="/drb/js/foundation.min.js"></script>
<script>
  $(document).foundation();
</script>

</body>
</html>