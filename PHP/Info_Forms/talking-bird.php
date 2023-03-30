<?php
	/*
	 *	Code for CSCI 2170: GL2, Winter 2022
	 *	Please read the instructions on Brightspace and work on this lab exercise during the lab time.
	 */

	/*
	 * This talking bird form processing was coded by:
	 * Student name: 
	 * B00#: 
	 * Email:  
	 */

	require_once "includes/functions.php";
	require_once "includes/header.php";

	
?>

	<main class="pg-main-content">
		<!-- Talking bird form to be processed in contact.php -->
		<form action="talking-bird.php" method="post">
			<label for="tweeeeeter-input">What's on your mind?</label>
			<textarea id="tweeeeeter-input" name="i-chirp"></textarea>
			<input type="submit" name="submit-btn" value="Talk like a bird">
		</form>



		<!-- Display chirps from the talking bird below -->
		<hr>
		<h2>Chirps from the talking bird</h2>
	</main>

<?php
	require_once "includes/footer.php";
?>