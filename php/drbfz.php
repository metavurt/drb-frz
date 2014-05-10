<?php

function connect_db(){
	$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die('Could not connect: ' . mysql_error());
	mysql_select_db(DB_NAME) or die('Could not select database. You probably deleted it. Dumbass.');
	mysql_query("SET NAMES utf8");
	return $link;
}

function getTeamGameTotal($tid, $wid, $gnum) {

	$q = "SELECT SUM(bnp_stats.g$gnum + bnp_stats.hnd)
		FROM bnp_teams
			JOIN bnp_players
				ON bnp_players.tid = bnp_teams.tid
			JOIN bnp_stats
				ON bnp_stats.pid = bnp_players.pid
		WHERE bnp_teams.tid = $tid AND bnp_stats.wid = $wid";

	$r = mysql_query($q) or die(mysql_errno()." | ".mysql_error());

	while($row = mysql_fetch_array($r)) {
		$teamGameTotal = $row[0];
		echo $teamGameTotal;
	}

}

?>