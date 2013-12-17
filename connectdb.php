<?php
	// file: connectdb.php
	// author: E. Setio Dewo, Maret 2003
	
	include 'config/model.php';

	$db_username = "h31497_siakad";
	$db_hostname = "localhost";
	$db_password = "siakad";
	
	if ($_SERVER['HTTP_HOST'] == 'localhost') {
		$db_name = "siakad_db";
	} else {
		$db_name = "h31497_siakad";
	}

	$con = _connect($db_hostname, $db_username, $db_password);
	$db  = _select_db($db_name, $con);