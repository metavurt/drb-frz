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
            </ul>
        </aside>

        <section class="main-section">

					<?php

						$team1Pins = '[';
						$team1Names = '[';
						$team2Hands = '[';
						$ph = '';
						$pn = '';
						$pp = '';
						$th1 = 0;
						$i = 0;

						$team1TotalPins = [];
						$team1Points = 0;

						foreach ($this->data['data1'] as $teamData1) { 
							$tname1 = $teamData1['tname'];
							$pn = $teamData1['pname'];
							$ph = $teamData1['hnd'];
							$th1 += $ph;
							$pp = '['.(($teamData1['g1'] + $teamData1['hnd']) * -1).','.(($teamData1['g2'] + $teamData1['hnd']) * -1).','.(($teamData1['g3'] + $teamData1['hnd']) * -1).']';
							
							array_push($team1TotalPins, ($teamData1['g1'] + $teamData1['g2'] + $teamData1['g3'] + ($teamData1['hnd'] * 3)));

							if($i == 0) {
								$team1Pins .= $pp; // first one so no comma in front
								$team1Names .= '\''.$pn.'\'';
								$team1Hands .= $ph;								
							} else {
								$team1Pins .= ','.$pp;
								$team1Names .= ',\''.$pn.'\'';
								$team1Hands .= ','.$ph;
							}
							$i++;

						}

						$team1Names .= ']';
						$team1Pins .= ']';
						$team1Hands .= ']';

						$team2Pins = '[';
						$team2Names = '[';
						$team2Hands = '[';
						$th2 = 0;
						$j = 0;
						$pp = '';

						$team2TotalPins = [];
						$team2Points = 0;

						foreach ($this->data['data2'] as $teamData2) {
							$tname2 = $teamData2['tname'];
							$pn = $teamData2['pname'];
							$ph = $teamData2['hnd'];
							$th2 += $ph;
							$pp = '['.($teamData2['g1'] + $teamData2['hnd']).','.($teamData2['g2'] + $teamData2['hnd']).','.($teamData2['g3'] + $teamData2['hnd']).']';

							array_push($team2TotalPins, ($teamData2['g1'] + $teamData2['g2'] + $teamData2['g3'] + ($teamData2['hnd'] * 3)));

							if($j == 0) {
								$team2Pins .= $pp; // first one so no comma in front
								$team2Names .= '\''.$pn.'\'';
								$team2Hands .= $ph;								
							} else {
								$team2Pins .= ','.$pp;
								$team2Names .= ',\''.$pn.'\'';
								$team2Hands .= ','.$ph;
							}
							$j++;
						}

						$team2Names .= ']';
						$team2Pins .= ']';
						$team2Hands .= ']';

					?>


            <div class="row">
				<div class="large-12 small-12 alpha-horizontal omega-horizontal columns">
					<!-- put shit here -->

					<script>
						var t1tpns = '<?php echo $team1TotalPins[0].", ".$team1TotalPins[1].", ".$team1TotalPins[2]; ?>';
						var t2tpns = '<?php echo $team2TotalPins[0].", ".$team2TotalPins[1].", ".$team2TotalPins[2]; ?>';

					</script>

					<?php 

						for($x=0; $x<3; $x++) {
							if($team1TotalPins[$x] > $team2TotalPins[$x]) {
								$team1Points += 1;
							} else {
								$team2Points += 1;
							}
						}

						if( ($team1TotalPins[0] + $team1TotalPins[1] + $team1TotalPins[2]) > ($team2TotalPins[0] + $team2TotalPins[1] + $team2TotalPins[2]) ) {
							$team1Points += 1;
						} else {
							$team2Points += 1;
						}

						echo "<h3>".$tname1.": ".$team1Points."&nbsp;&nbsp;&nbsp;&nbsp;".$tname2.": ".$team2Points."</h3>";

					?>



				</div>
			</div>

			<div class="row">
				<div class="large-12 small-12 alpha-horizontal omega-horizontal columns">

					<div id="boxscore" style="width:100%; height:20em;"></div>
					<h4>If chart isn't drawing, please rotate your device to landscape</h4>

				</div>
			</div>
			<div class="row">
				<div class="small-12 columns">
					<div id="container"></div>
				</div>
			</div>
			<hr />
			<div class="row">
				<div class="large-6 small-12 alpha-horizontal omega-horizontal large-centered text-center columns">
					<a class="button small radius" href="/drb/index.php/vs">view all results</a>
				</div>
			</div>

        </section>
        <a class="exit-off-canvas"></a>
    </div>
</div>


<script src="/drb/js/vendor/jquery.js"></script>
<script src="/drb/js/foundation.min.js"></script>
<script src="/drb/js/highcharts.js"></script>
<script src="/drb/js/modules/data.js"></script>

<script>
  $(document).foundation();

  var t1p = <?php echo $team1Pins; ?>;
  var t2p = <?php echo $team2Pins; ?>;

</script>

<script>
$(function () {

	Highcharts.setOptions({
        colors: ['#2A940A', '#00685B','#64B197', '#B3E0CD', '#09398C', '#005B96', '#6497B1', '#b3CDE0']
    });	

    var chart,
        categories = ['Gm1', 'Gm2', 'Gm3'];

    var team1Name = '<?php echo $tname1; ?>';
    var team2Name = '<?php echo $tname2; ?>';
    var team1Handicap = '<?php echo $th1; ?>';
    var team2Handicap = '<?php echo $th2; ?>';

    var t1n = <?php echo $team1Names; ?>;
    var t2n = <?php echo $team2Names; ?>;

    $(document).ready(function() {
        $('#boxscore').highcharts({
            chart: {
                type: 'bar',
            },
            title: {
            	text: team1Name+"( "+team1Handicap+" )   vs   "+team2Name+"( "+team2Handicap+" )"
            },
            subtitle: {
            	text: 'team handicap total in ( )'
            },
            xAxis: [{
                categories: categories,
                reversed: true,
                labels: {
                    step: 1
                }
            }, { // mirror axis on right side
                opposite: true,
                reversed: true,
                categories: categories,
                linkedTo: 0,
                labels: {
                    step: 1
                }
            }],
            yAxis: {
                title: {
                    text: null
                },
                labels: {
                    formatter: function(){
                        return Math.abs(this.value);
                    }
                },
                min: -900,
                max: 900,
				reversedStacks: false
            },
            tooltip: {
                formatter: function(){
                    return '<b>'+ this.series.name +'</b><br/>'+
                        'Score: '+ Highcharts.numberFormat(Math.abs(this.point.y), 0);
                }
            },
            plotOptions: {
                series: {
                    stacking: 'normal'
                }
            },
	        credits: {
	        	enabled: false
	        },

            series: [{

         data: t1p[0], 
            name: t1n[0]
        }, {
            data: t1p[1],
            name: t1n[1]
        }, {
            data: t1p[2],
            name: t1n[2]
        }, {
            data: t1p[3],
            name: t1n[3]

            }, {

         data: t2p[0],
            name: t2n[0]
        }, {
            data: t2p[1],
            name: t2n[1]
        }, {
            data: t2p[2],
            name: t2n[2]
        }, {
            data: t2p[3],
            name: t2n[3]

            }]
        });
    });
    
});
    
</script>

</body>
</html>