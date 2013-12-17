<?php
	// file: connectdb.php
	// author: E. Setio Dewo, Maret 2003
	
	include 'config/model.php';

	$db_username = "h31497_siakad";
	$db_hostname = "localhost";
	$db_password = "siakad";
	$db_name = "siakad_db";

	$con = _connect($db_hostname, $db_username, $db_password);
	$db  = _select_db($db_name, $con);