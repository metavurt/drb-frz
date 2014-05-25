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
            <!-- MAIN CONTENT GOES HERE -->

					<?php
						foreach ($this->data['data1'] as $teamData1) { 
							$tname1 = $teamData1['tname'];
						}

						foreach ($this->data['data2'] as $teamData2) {
							$tname2 = $teamData2['tname'];
						}


						// $c = 1;
						// $i = 0;
						// $tp = 0;
						// $pn = '';
						// $pp = '[';

						// foreach ($this->data['data'] as $playerData) { 
							// 	echo "<tr>\n\t";
							// 	echo "<td>".$c."</td>\n\t";
							// 	echo "<td><a href='/drb/index.php/player/".$playerData['pid']."'>".$playerData['pname']."</a></td>\n\t";
							// 	echo "<td class='text-center'>".$playerData['tpins']."</td>\n\t";
							// 	echo "<td class='text-center'>".$playerData['gms']."</td>\n\t";
							// 	echo "<td class='text-center'>".$playerData['avgs']."</td>\n\t";
							// 	echo "<td class='text-center'>".$playerData['hnd']."</td>\n";
							// 	echo "</tr>\n";
							// 	$pn = $playerData['pname'];
							// 	$tp = $playerData['tpins'];
							// 	if($i == 0) {
							// 		$pp .= '[\''.$pn.'\''.', '.$tp.']';
							// 	} else {
							// 		$pp .= ',[\''.$pn.'\''.', '.$tp.']';
							// 	}
							// 	$i++;
							// 	$c++;
						// }

						// $pp .= ']';



					?>


            <div class="row">
				<div class="large-12 small-12 alpha-horizontal omega-horizontal columns">
 					<h3><?php echo $tname1."   vs   ".$tname2; ?></h3>
				</div>
			</div>

			<div class="row">
				<div class="large-12 small-12 alpha-horizontal omega-horizontal columns">

<!-- 					<table id="drb-weekly-scores" class="drb-standings">
						<thead>
							<tr>
								<th class="text-center"></th>
								<th class="text-center">Week</th>
							</tr>
						</thead>
						<tbody> -->

							<?php

			            		// foreach ($this->data['tdata'] as $teamData) {
			            		// 	echo "<tr>\n\t";
			            		// 	echo "<th class='text-center'>".$teamData['wid']."</th>\n";
			            		// 	echo "<td class='text-center'>".$teamData['tpins']."</td>\n";
			            		// 	echo "</tr>\n\t";
			            		// }

			            	?>
<!--
			            </tbody>
			        </table> -->

<!-- 			        <div id="teamchart" style="width:100%;min-height:20em"></div>
 -->
					<!-- <table class="drb-standings">
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
					<tbody> -->
					<?php
						
						// $c = 1;
						// $i = 0;
						// $tp = 0;
						// $pn = '';
						// $pp = '[';

						// foreach ($this->data['data'] as $playerData) { 
						// 	echo "<tr>\n\t";
						// 	echo "<td>".$c."</td>\n\t";
						// 	echo "<td><a href='/drb/index.php/player/".$playerData['pid']."'>".$playerData['pname']."</a></td>\n\t";
						// 	echo "<td class='text-center'>".$playerData['tpins']."</td>\n\t";
						// 	echo "<td class='text-center'>".$playerData['gms']."</td>\n\t";
						// 	echo "<td class='text-center'>".$playerData['avgs']."</td>\n\t";
						// 	echo "<td class='text-center'>".$playerData['hnd']."</td>\n";
						// 	echo "</tr>\n";
						// 	$pn = $playerData['pname'];
						// 	$tp = $playerData['tpins'];
						// 	if($i == 0) {
						// 		$pp .= '[\''.$pn.'\''.', '.$tp.']';
						// 	} else {
						// 		$pp .= ',[\''.$pn.'\''.', '.$tp.']';
						// 	}
						// 	$i++;
						// 	$c++;
						// }

						// $pp .= ']';

					?>

					<!-- </tbody>
					</table> -->

					<div id="boxscore" style="width:100%; height:20em;"></div>

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
					<a class="button small radius" href="/drb/index.php/teams">view all teams</a>
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
</script>

<script>
$(function () {

	//var ld = <?php echo $pp; ?>;

	Highcharts.setOptions({
        colors: ['#2A940A', '#00685B','#64B197', '#B3E0CD', '#09398C', '#005B96', '#6497B1', '#b3CDE0']
    });	

  //   $('#container').highcharts({
  //       chart: {
  //           plotBackgroundColor: null,
  //           plotBorderWidth: null,
  //           plotShadow: false
  //       },
  //       title: {
  //           text: ''
  //       },
  //       tooltip: {
  //   	    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
  //       },
  //       plotOptions: {
  //           pie: {
		// 		allowPointSelect: true,
		// 		cursor: 'pointer',
		// 		dataLabels: {
		// 			enabled: false
		// 		},
		// 		showInLegend: true
  //           }
  //       },
  //       credits: {
		// 	enabled: false
		// },
  //       series: [{
  //           type: 'pie',
  //           name: 'Contributions',
  //           data: ld
  //       }]
  //   });

	// $('#teamchart').highcharts({
 //        data: {
 //            table: document.getElementById('drb-weekly-scores')
 //        },
 //        chart: {
 //            type: 'line',
 //            spacingBottom: 40
 //        },
 //        title: {
 //            text: 'Weekly Game Scores'
 //        },
 //        legend: {
 //        	reversed: true
 //        },
 //        credits: {
 //        	enabled: false
 //        },
 //        xAxis: {
 //        	allowDecimals: false
 //        },
 //        yAxis: {
	// 		allowDecimals: false,
 //        	title: {
 //        		text: 'Total Pins'
 //        	}
 //        },
 //        tooltip: {
 //            formatter: function() {
 //                return '<strong>'+this.point.y+'</strong>'
 //            }
 //        }
 //    });


});



$(function () {
    var chart,
        categories = ['Gm1', 'Gm2', 'Gm3'];

    var team1Name = '';
    var team2Name = '';

    $(document).ready(function() {
        $('#boxscore').highcharts({
            chart: {
                type: 'bar'
            },
            title: {
                text: 'Three & A Half Amigos vs Guttermouth'
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
    
            plotOptions: {
                series: {
                    stacking: 'normal'
                }
            },
	        credits: {
	        	enabled: false
	        },

            series: [{

         data: [-129, -171, -196],
            name: 'Obiwan Kenobilly'
        }, {
            data: [-144, -176, -235],
            name: 'Old Lefty'
        }, {
            data: [-151, -123, -191],
            name: 'Couple Two Tree'
        }, {
            data: [-201, -144, -248],
            name: 'Hot Wheels'

            }, {

         data: [129, 171, 106],
            name: 'Burke'
        }, {
            data: [144, 176, 135],
            name: 'Britney Spares'
        }, {
            data: [151, 123, 161],
            name: 'Nacho Pobre'
        }, {
            data: [201, 144, 188],
            name: 'Tall Chirro'

            }]
        });
    });
    
});
    
</script>

</body>
</html>