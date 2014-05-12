<?php

require "vendor/autoload.php";

$app = new \Slim\Slim();

$app->config(array(
	'debug' => true,
    'templates.path' => 'templates'
));

$log = $app->getLog();
$log->setLevel(\Slim\Log::DEBUG);
$log->setEnabled(true);


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

	$app->render('standings-table.php', array('page_title' => 'DRB Team Standings','data' => $data));
	
});

$app->get('/hello/:name', function ($name) {
	echo "hello, how are ya, $name";
});

$app->get('/wk/:week', function ($week) {

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
		WHERE bnp_stats.wid = $week GROUP BY bnp_teams.tid ORDER BY TotalPins DESC' );

	while ( $row = $r->fetch_array(MYSQLI_ASSOC) ) {
		$data[] = $row;
	}

	$app->render('weekly.php', array('page_title' => 'DRB Week Standings','data' => $data));	

});

$app->run();

?>