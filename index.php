<?php

require "vendor/autoload.php";

// require 'Slim/Slim.php';
// \Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

$app->config(array(
    'debug' => true,
    'templates.path' => 'templates'
));

// $app->get('/hello/:name', function ($name) {
//     echo "Hello, $name";
// });


$app->get('/', function () use ($app) {

	require_once 'php/drbfz.php';
	$db = connect_db();
	$c = 0;

	$r = $db->query('SELECT SUM(bnp_stats.g1 + bnp_stats.hnd) AS gTotal
		FROM bnp_teams
			JOIN bnp_players
				ON bnp_players.tid = bnp_teams.tid
			JOIN bnp_stats
				ON bnp_stats.pid = bnp_players.pid
		WHERE bnp_teams.tid = 1 AND bnp_stats.wid = 1' );

	while ( $row = $r->fetch_array(MYSQLI_ASSOC) ) {
		$data[] = $row;
	}

	$app->render('standings.php', array(
		'page_title' => 'your mom', 
		'data' => $data
			)
	);
});



$app->run();

?>