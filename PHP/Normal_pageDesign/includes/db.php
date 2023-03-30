<?php
	/* 
	 * DB file for the timetable website.
	 * Assignment 5, CSCI 1170, Winter 2022
	 * Starter code provided by Dr. Raghav V. Sampangi
	 */


	require_once "config.php";
	
	$db = new mysqli(DBHOST, DBUSER, DBPSWD, DBNAME);

	if ($db->connect_error) {
		die("Noooooooo<br>" . $db->connect_error);
	}
?>