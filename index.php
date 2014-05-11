<?php

require "vendor/autoload.php";

$app = new \Slim\Slim();

$app->config(array(
    'debug' => true,
    'templates.path' => 'templates'
));

$app->get('/', function () use ($app) {

	require_once 'php/drbfz.php';
	$db = connect_db();

	$r = $db->query('SELECT tname AS TeamName, bnp_teams.tid, SUM(bnp_stats.g1 + bnp_stats.hnd) AS Game1,
				SUM(bnp_stats.g2 + bnp_stats.hnd) AS Game2,
                SUM(bnp_stats.g3 + bnp_stats.hnd) AS Game3,
                SUM(bnp_stats.g1 + bnp_stats.g2 + bnp_stats.g3 + (bnp_stats.hnd * 3)) AS TotalPins
		FROM bnp_teams
			JOIN bnp_players
            	ON bnp_players.tid = bnp_teams.tid
			JOIN bnp_stats
				ON bnp_stats.pid = bnp_players.pid
		WHERE bnp_stats.wid = 1 GROUP BY bnp_teams.tid ORDER BY TotalPins DESC' );

	while ( $row = $r->fetch_array(MYSQLI_ASSOC) ) {
		$data[] = $row;
	}

	$app->render('standings.php', array('page_title' => 'DRB Team Standings','data' => $data));
	
});

$app->run();

?>