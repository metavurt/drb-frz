<?php

function connect_db() {
	$server = 'localhost';
	$user = 'weo3_weo3';
	$pass = 'p4ntaLoc1ni';
	$database = 'weo3_drb';
	$connection = new mysqli($server, $user, $pass, $database);

	return $connection;
}

?>