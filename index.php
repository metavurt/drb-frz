<?php
/** 
 * APILogWriter: Custom log writer for our application
 *
 * We must implement write(mixed $message, int $level)
*/
class APILogWriter {
	public function write($message, $level = \Slim\Log::DEBUG) {
		# Simple for now
		echo $level.': '.$message.'<br />';
	}
}

# Load the Slim framework
require "vendor/autoload.php";

$app = new \Slim\Slim();

# Fire up an app
$app->config(array(
		'mode' => 'development',
		'debug' => true,
	    'templates.path' => 'templates',
		'log.writer' => new APILogWriter()
	)
);

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

$app->get('/view/(:id)', function($id) use ($app) {
	require_once 'php/drbfz.php';
	$db = connect_db();

	

});

$app->get('/tm/:team', function ($team) use ($app) {

	require_once 'php/drbfz.php';
	$db = connect_db();

	$r = $db->query('SELECT bnp_players.pid, pname, SUM(g1 + g2 + g3) as tpins, COUNT(wid)*3 as gms,
					ROUND(SUM(g1 + g2 + g3)/(COUNT(wid)*3), 0) as avgs,
					ROUND(SUM(hnd)/COUNT(wid), 0) as hnd
					FROM bnp_players
					JOIN bnp_stats
					ON bnp_stats.pid = bnp_players.pid
					WHERE bnp_players.tid = '.$team.'
					GROUP BY pid');

	while ( $row = $r->fetch_array(MYSQLI_ASSOC) ) {
		$data[] = $row;
	}

	$app->render('teams-table.php', array('page_title' => 'DRB Team Stats '.$team,'data' => $data));

});

$app->run();

?>