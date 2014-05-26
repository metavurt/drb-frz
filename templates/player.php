<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title><?php echo $this->data['page_title']; ?></title>
    <link rel="stylesheet" href="../../css/foundation.css" />
    <link rel="stylesheet" href="../../css/drbfz.css" />
    <script src="../../js/vendor/modernizr.js"></script>
</head>

<body>

<div class="off-canvas-wrap" data-offcanvas="">
    <div class="inner-wrap">
    	<div class="fixed">
	        <nav class="tab-bar drb-bg-red">
	            <section class="left-small">
	                <a class="left-off-canvas-toggle menu-icon" href="#"><span></span></a>
	            </section>

	            <section class="middle tab-bar-section">
	                <h1 class="title">DRB Thur Mixed</h1>
	            </section>
	        </nav>
	    </div>

        <aside class="left-off-canvas-menu drb-bg-drd">
            <ul class="off-canvas-list">
                <li><a href="/drb/">Weekly Standings</a></li>
                <li><a href="/drb/index.php/teams">Teams</a></li>
                <li><a href="/drb/index.php/players">Players</a></li>
                <li><a href="/drb/index.php/hilos">Highs / Lows</a></li>
            </ul>
        </aside>

        <section class="main-section">
            <!-- MAIN CONTENT GOES HERE -->
            <?php
            		foreach ($this->data['data'] as $playerData) {
            			$name = $playerData['pname'];
            			$tpins = $playerData['tpins'];
            			$gms = $playerData['gms'];
            			$avg = $playerData['avgscore'];
            			$high = $playerData['hscore'];
            			$low = $playerData['lscore'];
            			$tid = $playerData['tid'];
            		}


            ?>

            <div class="row">
            	<div class="large-8 small-11 small-centered alpha-horizontal columns">
            		<h4><?php echo $name; ?></h4>
					<div class="row">
						<div class="large-12 small-12 alpha-horizontal omega-horizontal columns">
							<table class="drb-standings">
								<thead>
									<tr>
										<th class="text-center">Pins</th>
										<th class="text-center">Games</th>
										<th class="text-center">Avg</th>
										<th class="text-center">High</th>
										<th class="text-center">Low</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td class='text-center'><?php echo $tpins; ?></td>
										<td class='text-center'><?php echo $gms; ?></td>
										<td class='text-center'><?php echo $avg; ?></td>
										<td class='text-center'><?php echo $high; ?></td>
										<td class='text-center'><?php echo $low; ?></td>
									</tr>
								</tbody>
							</table>

							<table id="drb-weekly-scores" class="drb-standings">
								<thead>
									<tr>
										<th class="text-center"></th>
										<th class="text-center">Gm3</th>
										<th class="text-center">Gm2</th>
										<th class="text-center">Gm1</th>
									</tr>
								</thead>
								<tbody>

									<?php

					            		$wkCount = 1;
					            		$nd = null;

					            		foreach ($this->data['gdata'] as $gameData) {
					            			if($gameData['wid'] == $wkCount) {
						            			echo "<tr>\n\t";
						            			echo "<td class='text-center'>".$wkCount."</td>\n";
						            			echo "<td class='text-center'>".$gameData['g3']."</td>\n";
						            			echo "<td class='text-center'>".$gameData['g2']."</td>\n";
						            			echo "<td class='text-center'>".$gameData['g1']."</td>\n";
						            			echo "</tr>\n\t";
						            		} else {
						            			if($gameData['wid'] > $wkCount) {
							            			echo "<tr>\n\t";
							            			echo "<td class='text-center'>".$wkCount."</td>\n";
							            			echo "<td class='text-center'>".$nd."</td>\n";
							            			echo "<td class='text-center'>".$nd."</td>\n";
							            			echo "<td class='text-center'>".$nd."</td>\n";
							            			echo "</tr>\n\t";
							            			echo "<tr>\n\t";
							            			echo "<td class='text-center'>".$gameData['wid']."</td>\n";
							            			echo "<td class='text-center'>".$gameData['g3']."</td>\n";
							            			echo "<td class='text-center'>".$gameData['g2']."</td>\n";
							            			echo "<td class='text-center'>".$gameData['g1']."</td>\n";
							            			echo "</tr>\n\t";							            			
						            			}
						            			if($gameData['wid'] < $wkCount) {
							            			echo "<tr>\n\t";
							            			echo "<td class='text-center'>".$gameData['wid']."</td>\n";
							            			echo "<td class='text-center'>".$gameData['g3']."</td>\n";
							            			echo "<td class='text-center'>".$gameData['g2']."</td>\n";
							            			echo "<td class='text-center'>".$gameData['g1']."</td>\n";
							            			echo "</tr>\n\t";
							            			echo "<tr>\n\t";
							            			echo "<td class='text-center'>".$wkCount."</td>\n";
							            			echo "<td class='text-center'>".$nd."</td>\n";
							            			echo "<td class='text-center'>".$nd."</td>\n";
							            			echo "<td class='text-center'>".$nd."</td>\n";
							            			echo "</tr>\n\t";
						            			}
						            		}
						            		$wkCount++;
					            		}

					            	?>

					            </tbody>
					        </table>

							<table id="drb-weekly-handicap" class="drb-standings">
								<thead>
									<tr>
										<th class="text-center">W</th>
										<th class="text-center">H</th>
									</tr>
								</thead>
								<tbody>

									<?php

					            		$wkCount = 1;
					            		$nd = null;

					            		foreach ($this->data['gdata'] as $gameData) {
					            			if($wkCount == $gameData['wid']) {
						            			echo "<tr>\n\t";
						            			echo "<td class='text-center'>".$gameData['wid']."</td>\n";
						            			echo "<td class='text-center'>".$gameData['hnd']."</td>\n";
						            			echo "</tr>\n\t";
						            			$wkCount++;
						            		} else {
						            			$tempWID = $gameData['wid'];
						            			while($wkCount < $tempWID) {
													echo "<tr>\n\t";
							            			echo "<td class='text-center'>".$wkCount."</td>\n";
							            			echo "<td class='text-center'>".$nd."</td>\n";													
							            			echo "</tr>\n\t";
							            			echo "</tr>\n\t";
							            			$wkCount++;						            				
						            			}
						            			echo "<tr>\n\t";
						            			echo "<td class='text-center'>".$gameData['wid']."</td>\n";
						            			echo "<td class='text-center'>".$gameData['hnd']."</td>\n";
						            			echo "</tr>\n\t";
						            			$wkCount++;
						            		}
					            		}

					            	?>

					            </tbody>
					        </table>
						</div>
					</div>
					<div class="row">
						<div class="small-12 columns">
							<div id="handicap-chart"></div>
						</div>
					</div>
					<hr />					
					<div class="row">
						<div class="small-12 columns">
							<div id="weekly-chart"></div>
						</div>
					</div>
					<hr />
					<div class="row">
						<div class="small-12 large-6 text-center columns">
							<p><?php echo '<a class="button small radius" href="/drb/index.php/team/' . $tid . '">view team page</a>'; ?></p>
						</div>
						<div class="small-12 large-6 text-center columns">
							<p><a class="button small radius" href="/drb/index.php/players">view all players</a></p>
						</div>
					</div>
				</div>
			</div>

        </section><a class="exit-off-canvas"></a>
    </div>
</div>


<script src="../../js/vendor/jquery.js"></script>
<script src="../../js/foundation.min.js"></script>
<script src="../../js/highcharts.js"></script>
<script src="../../js/modules/data.js"></script>

<script>
$(document).foundation();

	$(function () {

		Highcharts.setOptions({
	        colors: ['#D64D4D', '#4D7358', '#0C457D']
	    });

	    $('#weekly-chart').highcharts({
	        data: {
	            table: document.getElementById('drb-weekly-scores')
	        },
	        chart: {
	            type: 'bar',
	            spacingBottom: 40
	        },
	        title: {
	            text: 'Weekly Game Scores'
	        },
	        legend: {
	        	reversed: true
	        },
	        credits: {
	        	enabled: false
	        },
	        xAxis: {
	        	tickInterval: 1,
	        	title: {
	        		text: 'Week'
	        	}
	        },
	        yAxis: {
	            allowDecimals: false,
	            title: {
	                text: 'Score'
	            }
	        },
	        tooltip: {
	            formatter: function() {
	                return '<strong>'+this.point.y+'</strong>'
	            }
	        }
	    });

		$('#handicap-chart').highcharts({
	        data: {
	            table: document.getElementById('drb-weekly-handicap')
	        },
	        chart: {
	            type: 'line',
	            spacingBottom: 40
	        },
	        title: {
	            text: 'Weekly Game Handicaps'
	        },
	        legend: {
	        	enabled: false
	        },
	        credits: {
	        	enabled: false
	        },
	        yAxis: {
	        	title: {
	        		text: 'Handicap'
	        	}
	        },
	        xAxis: {
	            allowDecimals: false,
	            title: {
	                text: 'Week'
	            }
	        },
	        tooltip: {
	            formatter: function() {
	                return this.point.y;
	            }
	        }
	    });


	});

</script>

</body>
</html>