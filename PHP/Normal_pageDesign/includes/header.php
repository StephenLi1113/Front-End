<?php
	/* 
	* Header file for the timetable website.
	* Assignment 5, CSCI 1170, Winter 2022
	* Starter code provided by Dr. Raghav V. Sampangi
	*/
	session_start();
	require_once "includes/config.php";
	require_once "includes/functions.php";
	require_once "includes/view-elements.php";

	$_SESSION['security-token'] = getToken(session_id());
	$view = new ViewElements($_SESSION['security-token']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>DalTimetable: Neo</title>

	<!-- Link to the main CSS file -->
	<link rel="stylesheet" href="css/main.css">
</head>
<body>
	<header class="pg-banner">
		<nav class="secondary-nav">
			<a href="https://www.dal.ca" target="_blank">Dal Homepage</a>
			<a href="#">Current Students</a>
			<a href="#">Directory</a>
			<a href="#">myDal</a>
			<a href="#">Dal Online</a>
			<a href="#">Brightspace</a>
		</nav>
		<div class="header-container">
			<h1>DalTimetable: Neo</h1>
			<?php
				if (isset($_SESSION['email'])) {
					echo $view->getNav(LOGGEDIN_PRIMARY_NAV);
				}
				else {
					echo $view->getNav(DEFAULT_PRIMARY_NAV);
				}
			?>
		</div>
	</header>
