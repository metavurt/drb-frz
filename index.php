<?php

require "vendor/autoload.php";

require 'Slim/Slim.php';
\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

$app->get('/hello/:name', function ($name) {
    echo "Hello, $name";
});


/*
$app->get('/:w/:t', function () use ($app) {
	require_once 'php/zj.php';
	require_once 'php/drbfz.php';

	$db = connect_db();

	$r = $db->query('SELECT SUM(bnp_stats.g1 + bnp_stats.hnd)
		FROM bnp_teams
			JOIN bnp_players
				ON bnp_players.tid = bnp_teams.tid
			JOIN bnp_stats
				ON bnp_stats.pid = bnp_players.pid
		WHERE bnp_teams.tid = $t AND bnp_stats.wid = $w;' );

	while($w = $r->fetch_array(MYSQLI_ASSOC)) {
		$data[] = $w;
	}

	$app-render('standings.php', array(
		'page_title' => 'your mom', 
		'data' => $data
			)
	);
});

*/

$app->run();

?>