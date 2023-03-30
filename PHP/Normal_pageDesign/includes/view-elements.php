<?php
	require_once "includes/config.php";

	/*
	 * nav.php
	 * Starting code for CSCI 2170 (W2022) to return an appropriate navigation menu based on the condition specified.
	 */


	/*
	 * ViewElements: A class that helps create view elements
	 * (1) Nav bar options
	 * (2) Search bar to search for courses
	 */
	class ViewElements {
		private $navPrimaryDefault, $navPrimaryLoggedIn, $searchCourses;

		function __construct($token) {
			$this->navPrimaryDefault = <<<ENDNAVDEF
			<nav class="primary-nav">
				<form class="nav-login-form" action="includes/login.php" method="post">
					<input type="email" name="l-email" id="login-email" placeholder="Email to login">
					<input type="password" name="l-pswd" id="login-pswd">
					<input type="hidden" name="l-token" value="{$token}">
					<input type="submit" name="l-submit" value="Login">
				</form>
			</nav>
ENDNAVDEF;
			
			$this->searchCourses = <<<ENDSEARCHBAR
			<aside class="search-bar">
				<form action="" method="post" class="search-form">
					<label for="search-keywords">Search for courses to add: </label>
					<input type="text" name="s-keywords" id="search-keywords" placeholder="Search using course name or course code">
					<input type="button" name="s-search-btn" id="search-btn" value="Find course(s)">
				</form>
			</aside>
ENDSEARCHBAR;		
		}

		/*
		*	function getNav()
		*	Takes an option - either logged in or not - as argument and
		*	returns an appropriate nav for the web page.
		*/
		function getNav($option) {
			if ($option == DEFAULT_PRIMARY_NAV) {		
				return $this->navPrimaryDefault;
			}
			else {
				$this->navPrimaryLoggedIn = <<<ENDNAVLI
				<nav class="primary-nav">
					<h3>Welcome, {$_SESSION['username']} (<a href="includes/logout.php">Logout</a>)</h3>
				</nav>
ENDNAVLI;
					return $this->navPrimaryLoggedIn;
			}
		}

		/*
		*	function getSearchBar()
		*	Returns the course search bar for the web page.
		*/
		function getSearchBar() {
			return $this->searchCourses;
		}

	} // end class


?>