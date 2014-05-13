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

	$r = $db->query('SELECT bnp_teams.tid, tname,
					SUM(twins) as wins, sum(tloss) as loss,
					FORMAT(100 * SUM(twins)/(SUM(twins) + SUM(tloss)), 2) as pcnt,
					SUM(tpins) as tpins
					FROM bnp_teams
					JOIN bnp_points
					ON bnp_points.tid = bnp_teams.tid
					GROUP BY tid
					ORDER BY wins DESC, tpins DESC' );

	while ( $row = $r->fetch_array(MYSQLI_ASSOC) ) {
		$data[] = $row;
	}

	$app->render('standings-table.php', array('page_title' => 'DRB Team Standings','data' => $data));
	
});

$app->get('/players', function () use ($app) {
	
	require_once 'php/drbfz.php';
	$db = connect_db();

	$r = $db->query('SELECT bnp_players.pid, pname, SUM(g1 + g2 + g3) as tpins, COUNT(wid)*3 as gms,
					ROUND(SUM(g1 + g2 + g3)/(COUNT(wid)*3), 0) as avgs,
					ROUND(SUM(hnd)/COUNT(wid), 0) as hnd
					FROM bnp_players
					JOIN bnp_stats
					ON bnp_stats.pid = bnp_players.pid
					GROUP BY pid');

	while ( $row = $r->fetch_array(MYSQLI_ASSOC) ) {
		$data[] = $row;
	}

	$app->render('players-table.php', array('page_title' => 'DRB Player Stats','data' => $data));

});

$app->get('/tm/:team', function ($team) use ($app) {

	require_once './php/drbfz.php';
	$db = connect_db();

	$r = $db->query('SELECT bnp_players.pid, pname, SUM(g1 + g2 + g3) as tpins, COUNT(wid)*3 as gms,
					ROUND(SUM(g1 + g2 + g3)/(COUNT(wid)*3), 0) as avgs,
					ROUND(SUM(hnd)/COUNT(wid), 0) as hnd
					FROM bnp_players
					JOIN bnp_stats
					ON bnp_stats.pid = bnp_players.pid
					WHERE bnp_players.tid = 1
					GROUP BY pid');

	while ( $row = $r->fetch_array(MYSQLI_ASSOC) ) {
		$data[] = $row;
	}

	$app->render('teams-table.php', array('page_title' => 'DRB Team Stats '.$team,'data' => $data));

});

$app->run();

?>