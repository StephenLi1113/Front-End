<?php
	/* 
	* Main functions file for the timetable website.
	* Assignment 5, CSCI 1170, Winter 2022
	* Starter code provided by Dr. Raghav V. Sampangi
	*/

	/* Function to sanitize form data: 
	 * Cleans data by removing empty leading/trailing characters (trim()),
	 * converting all components of HTML tags and entities into special characters (htmlspecialchars()), and
	 * converting all backslash/escape characters into regular characters (stripslashes()).
	 * Returns cleaned/sanitized string.
	 */
	function sanitizeData($string) {
		return stripslashes(htmlspecialchars(trim($string)));
	}

	/* Function to hash session ID: 
	 * Hash the session ID using the hash() function, using the SHA3-512 algorithm.
	 * The session ID is first exclusive-ORed with a random number to generate a unique updating value.
	 * Returns hashed session ID.
	 */
	function getToken($sessionID) {
		return hash("sha3-512", $sessionID xor rand());
	}

?>