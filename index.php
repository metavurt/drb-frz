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
					hnd
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
					hnd,
					GREATEST(MAX(g1), MAX(g2), MAX(g3)) AS hscore,
                    LEAST(MIN(g1), MIN(g2), MIN(g3)) as lscore
					FROM bnp_players
					JOIN bnp_stats
					WHERE bnp_stats.pid = '.$id.' AND bnp_players.pid = '.$id);

	while ( $row = $r->fetch_array(MYSQLI_ASSOC) ) {
		$data[] = $row;
	}

	$r2 = $db->query('SELECT wid, g1, g2, g3, hnd
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
					hnd
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


$app->get('/vs/:t1/:t2/:wk', function($t1,$t2,$wk) use ($app) {

	require_once 'php/drbfz.php';
	$db = connect_db();

	$r1 = $db->query('SELECT tname, bnp_players.pid as pid, pname, g1, g2, g3, hnd
					FROM bnp_teams, bnp_players
					JOIN bnp_stats
					ON bnp_stats.pid = bnp_players.pid
					WHERE bnp_teams.tid = '.$t1.' AND bnp_players.tid = '.$t1.'
					AND bnp_stats.wid = '.$wk.'
					GROUP BY pid');

	while ( $row1 = $r1->fetch_array(MYSQLI_ASSOC) ) {
		$data1[] = $row1;
	}

	$r2 = $db->query('SELECT tname, bnp_players.pid as pid, pname, g1, g2, g3, hnd
					FROM bnp_teams, bnp_players
					JOIN bnp_stats
					ON bnp_stats.pid = bnp_players.pid
					WHERE bnp_teams.tid = '.$t2.' AND bnp_players.tid = '.$t2.'
					AND bnp_stats.wid = '.$wk.'
					GROUP BY pid');

	while ( $row2 = $r2->fetch_array(MYSQLI_ASSOC) ) {
		$data2[] = $row2;
	}


	$app->render('result.php', array('page_title' => 'DRB Thur Mixed Result','data1' => $data1, 'data2' => $data2));	


});


$app->get('/vs', function() use ($app) {

	require_once 'php/drbfz.php';
	$db = connect_db();


	$r = $db->query('SELECT m.mid, m.wid, t1.tid AS tid1, t1.tname AS team1, t2.tid AS tid2, t2.tname AS team2
					FROM bnp_schedule as m
					LEFT JOIN bnp_teams AS t1
					ON t1.tid = m.tid1
					LEFT JOIN bnp_teams AS t2
					ON t2.tid = m.tid2');

	while ( $row = $r->fetch_array(MYSQLI_ASSOC) ) {
		$data[] = $row;
	}

	$app->render('results.php', array('page_title' => 'DRB Thur Mixed Results', 'data' => $data));


});

$app->get('/hilos', function() use ($app) {

	require_once 'php/drbfz.php';
	$db = connect_db();

	$m = "m";
	$f = "f";

	$r = $db->query('SELECT DISTINCT bnp_players.pid as pid, pname, GREATEST(MAX(g1), MAX(g2), MAX(g3)) AS hscore
					FROM bnp_players
					JOIN bnp_stats
					ON bnp_stats.pid = bnp_players.pid
                    WHERE bnp_players.mf = "'.$m.'"
					GROUP BY bnp_players.pid
                    ORDER BY hscore DESC LIMIT 10');

	while( $row = $r->fetch_array(MYSQLI_ASSOC) ) {
		$mdatah[] = $row;
	}

	$r2 = $db->query('SELECT DISTINCT bnp_players.pid as pid, pname, MAX( g1 + g2 + g3 ) AS hscore
					FROM bnp_players
					JOIN bnp_stats
					ON bnp_stats.pid = bnp_players.pid
                    WHERE bnp_players.mf = "'.$m.'"
					GROUP BY bnp_players.pid
                    ORDER BY hscore DESC LIMIT 10');

	while( $row2 = $r2->fetch_array(MYSQLI_ASSOC) ) {
		$mdatah2[] = $row2;
	}
	

	$s = $db->query('SELECT DISTINCT bnp_players.pid as pid, pname, GREATEST(MAX(g1), MAX(g2), MAX(g3)) AS hscore
					FROM bnp_players
					JOIN bnp_stats
					ON bnp_stats.pid = bnp_players.pid
                    WHERE bnp_players.mf = "'.$f.'"
					GROUP BY bnp_players.pid
                    ORDER BY hscore DESC LIMIT 10');

	while( $sow = $s->fetch_array(MYSQLI_ASSOC) ) {
		$fdatah[] = $sow;
	}

	$s2 = $db->query('SELECT DISTINCT bnp_players.pid as pid, pname, MAX( g1 + g2 + g3 ) AS hscore
					FROM bnp_players
					JOIN bnp_stats
					ON bnp_stats.pid = bnp_players.pid
                    WHERE bnp_players.mf = "'.$f.'"
					GROUP BY bnp_players.pid
                    ORDER BY hscore DESC LIMIT 10');

	while( $sow2 = $s2->fetch_array(MYSQLI_ASSOC) ) {
		$fdatah2[] = $sow2;
	}	

	$t = $db->query('SELECT DISTINCT bnp_players.pid as pid, pname, LEAST(MIN(g1), MIN(g2), MIN(g3)) AS lscore
					FROM bnp_players
					JOIN bnp_stats
					ON bnp_stats.pid = bnp_players.pid
                    WHERE bnp_players.mf = "'.$m.'"
					GROUP BY bnp_players.pid
                    ORDER BY lscore ASC LIMIT 10');

	while( $tow = $t->fetch_array(MYSQLI_ASSOC) ) {
		$mdatal[] = $tow;
	}

	$v = $db->query('SELECT DISTINCT bnp_players.pid as pid, pname, LEAST(MIN(g1), MIN(g2), MIN(g3)) AS lscore
					FROM bnp_players
					JOIN bnp_stats
					ON bnp_stats.pid = bnp_players.pid
                    WHERE bnp_players.mf = "'.$f.'"
					GROUP BY bnp_players.pid
                    ORDER BY lscore ASC LIMIT 10');

	while( $vow = $v->fetch_array(MYSQLI_ASSOC) ) {
		$fdatal[] = $vow;
	}

	$app->render('hilos.php', array('page-title' => 'DRB THU Mixed', 'mdatah' => $mdatah, 'mdatah2' => $mdatah2, 'fdatah' => $fdatah, 'fdatah2' => $fdatah2, 'mdatal' => $mdatal, 'fdatal' => $fdatal));

});


$app->run();

?>