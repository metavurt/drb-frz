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
					SUM(twins) AS wins, SUM(tloss) AS loss, FORMAT(100 * SUM(twins)/(SUM(twins) + SUM(tloss)), 2) as pcnt,
					SUM(tpins) AS tpins FROM bnp_teams JOIN bnp_points
					ON bnp_points.tid = bnp_teams.tid
					GROUP BY tid
					ORDER BY wins DESC, tpins DESC' );

	while ( $row = $r->fetch_array(MYSQLI_ASSOC) ) {
		$data[] = $row;
	}

	$app->render('standings.php', array('page_title' => 'DRB Team Standings','data' => $data));
	
});

$app->get('/players', function () use ($app) {
	
	require_once 'php/drbfz.php';
	$db = connect_db();

	$r = $db->query('SELECT bnp_players.pid as pid, pname, SUM(g1 + g2 + g3) as tpins, COUNT(wid)*3 as gms,
					ROUND(SUM(g1 + g2 + g3)/(COUNT(wid)*3), 0) as avgs,
					ROUND(SUM(hnd)/COUNT(wid), 0) as hnd
					FROM bnp_players
					JOIN bnp_stats
					ON bnp_stats.pid = bnp_players.pid
					GROUP BY pid');

	while ( $row = $r->fetch_array(MYSQLI_ASSOC) ) {
		$data[] = $row;
	}

	$app->render('players.php', array('page_title' => 'DRB Players','data' => $data));

});

$app->get('/player/(:id)', function($id) use ($app) {

	require_once 'php/drbfz.php';
	$db = connect_db();

	$r = $db->query('SELECT bnp_players.pid, bnp_players.tid as tid, pname, SUM(g1 + g2 + g3) as tpins, COUNT(wid)*3 as gms,
					ROUND(SUM(g1 + g2 + g3)/(COUNT(wid)*3), 0) as avgscore,
					ROUND(SUM(hnd)/COUNT(wid), 0) as hnd,
					GREATEST(MAX(g1), MAX(g2), MAX(g3)) AS hscore,
                    LEAST(MIN(g1), MIN(g2), MIN(g3)) as lscore
					FROM bnp_players
					JOIN bnp_stats
					WHERE bnp_stats.pid = '.$id.' AND bnp_players.pid = '.$id);

	while ( $row = $r->fetch_array(MYSQLI_ASSOC) ) {
		$data[] = $row;
	}

	$r2 = $db->query('SELECT g1, g2, g3
					FROM bnp_stats
					WHERE bnp_stats.pid = '.$id);

	while ($row2 = $r2->fetch_array(MYSQLI_ASSOC) ) {
		$gdata[] = $row2;
	}

	$app->render('player.php', array('page_title' => 'DRB Player Stats', 'data' => $data, 'gdata' => $gdata));


});



$app->get('/team/:team', function ($team) use ($app) {

	require_once 'php/drbfz.php';
	$db = connect_db();

	$r = $db->query('SELECT tname, bnp_players.pid as pid, pname, SUM(g1 + g2 + g3) as tpins, COUNT(wid)*3 as gms,
					ROUND(SUM(g1 + g2 + g3)/(COUNT(wid)*3), 0) as avgs,
					ROUND(SUM(hnd)/COUNT(wid), 0) as hnd
					FROM bnp_teams, bnp_players
					JOIN bnp_stats
					ON bnp_stats.pid = bnp_players.pid
					WHERE bnp_teams.tid = '.$team.' AND bnp_players.tid = '.$team.'
					GROUP BY pid');

	while ( $row = $r->fetch_array(MYSQLI_ASSOC) ) {
		$data[] = $row;
	}

	$s = $db->query('SELECT wid, tpins
					FROM bnp_points
					WHERE tid = '.$team);

	while ( $sow = $s->fetch_array(MYSQLI_ASSOC) ) {
		$tdata[] = $sow;
	}

	$app->render('team.php', array('page_title' => 'DRB Team Stats', 'data' => $data, 'tdata' => $tdata));

});


$app->get('/teams', function () use ($app) {

	require_once 'php/drbfz.php';
	$db = connect_db();

	$r = $db->query('SELECT tid, tname AS TeamName
					FROM bnp_teams
					ORDER BY tname ASC');

	while ( $row = $r->fetch_array(MYSQLI_ASSOC) ) {
		$data[] = $row;
	}

	$app->render('teams.php', array('page_title' => 'DRB Thur Mixed: ','data' => $data));

});

$app->run();

?>