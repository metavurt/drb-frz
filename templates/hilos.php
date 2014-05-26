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
                <li><a href="/drb/index.php/teams">Teams</a></li>
                <li><a href="/drb/index.php/players">Players</a></li>
                <li><a href="/drb/index.php/vs">Weekly Matchups</a></li>
            </ul>
        </aside>

        <section class="main-section">
            <!-- MAIN CONTENT GOES HERE -->
			<div class="row">
				<div class="large-5 small-6 columns">
					<table id="himalelist" class="drb-standings">
					<caption>Men High Score Game (scratch)</caption>
					<thead>
						<tr>
							<th></th>
							<th>Player</th>
							<th class="text-center">Score</th>
						</tr>
					</thead>
					<tbody>

					<?php
						
						$c = 1;

						foreach ($this->data['mdatah'] as $maleDataHigh) { 
							echo "<tr>\n\t";
							echo "<td class='text-right'>".$c."</td>\n\t";
							echo "<td><a href='/drb/index.php/player/".$maleDataHigh['pid']."'>".$maleDataHigh['pname']."</a></td>\n\t";
							echo "<td class='text-center'>".$maleDataHigh['hscore']."</td>\n\t";
							echo "</tr>\n";
							$c++;
						}

					?>
					</tbody>
					</table>
				</div>

				<div class="large-2 hide-for-small hide-for-medium columns">
				</div>

				<div class="large-5 small-6 columns">
					<table id="lomalelist" class="drb-standings">
					<caption>Men Low Score Game (scratch)</caption>
					<thead>
						<tr>
							<th></th>
							<th>Player</th>
							<th class="text-center">Score</th>
						</tr>
					</thead>
					<tbody>

					<?php
						
						$c = 1;

						foreach ($this->data['mdatal'] as $maleDataLow) { 
							echo "<tr>\n\t";
							echo "<td class='text-right'>".$c."</td>\n\t";
							echo "<td><a href='/drb/index.php/player/".$maleDataLow['pid']."'>".$maleDataLow['pname']."</a></td>\n\t";
							echo "<td class='text-center'>".$maleDataLow['lscore']."</td>\n\t";
							echo "</tr>\n";
							$c++;
						}

					?>
					</tbody>
					</table>
				</div>
			</div>

			<p><hr /></p>

			<div class="row">
				<div class="large-5 small-6 columns">
					<table id="hifemalelist" class="drb-standings">
					<caption>Women High Score Game (scratch)</caption>
					<thead>
						<tr>
							<th></th>
							<th>Player</th>
							<th class="text-center">Score</th>
						</tr>
					</thead>
					<tbody>

					<?php
						
						$c = 1;

						foreach ($this->data['fdatah'] as $femaleDataHigh) { 
							echo "<tr>\n\t";
							echo "<td class='text-right'>".$c."</td>\n\t";
							echo "<td><a href='/drb/index.php/player/".$femaleDataHigh['pid']."'>".$femaleDataHigh['pname']."</a></td>\n\t";
							echo "<td class='text-center'>".$femaleDataHigh['hscore']."</td>\n\t";
							echo "</tr>\n";
							$c++;
						}

					?>
					</tbody>
					</table>
				</div>

				<div class="large-2 hide-for-small hide-for-medium columns">
				</div>

				<div class="large-5 small-6 columns">
					<table id="hifemalelist" class="drb-standings">
					<caption>Women Low Score Game (scratch)</caption>
					<thead>
						<tr>
							<th></th>
							<th>Player</th>
							<th class="text-center">Score</th>
						</tr>
					</thead>
					<tbody>

					<?php
						
						$c = 1;

						foreach ($this->data['fdatal'] as $femaleDataLow) { 
							echo "<tr>\n\t";
							echo "<td class='text-right'>".$c."</td>\n\t";
							echo "<td><a href='/drb/index.php/player/".$femaleDataLow['pid']."'>".$femaleDataLow['pname']."</a></td>\n\t";
							echo "<td class='text-center'>".$femaleDataLow['lscore']."</td>\n\t";
							echo "</tr>\n";
							$c++;
						}

					?>
					</tbody>
					</table>
				</div>
			</div>

        </section>
        <a class="exit-off-canvas"></a>
    </div>
</div>


<script src="/drb/js/vendor/jquery.js"></script>
<script src="/drb/js/foundation.min.js"></script>
<script>
  $(document).foundation();
</script>

</body>
</html>