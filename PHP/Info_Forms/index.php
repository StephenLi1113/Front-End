<?php
	/*
	 *	Code for CSCI 2170: GL2, Winter 2022
	 *	Please read the instructions on Brightspace and work on this lab exercise during the lab time.
	 */

	/*
	 * This homepage form processing was coded by:
	 * Student name: 
	 * B00#: 
	 * Email:  
	 */

	require_once "includes/functions.php";
	require_once "includes/header.php";
?>

	<main class="pg-main-content">
		<!-- Post submission form to be processed in contact.php -->
		<form action="index.php" method="post">
			<label for="thoughts-title">Title for the post</label>
			<input type="text" id="thoughts-title" name="i-title">
			<label for="thoughts-author">Posted by</label>
			<input type="text" id="thoughts-author" name="i-author">
			<label for="thoughts-datetime">Posted at (automatically determined)</label>
			<input type="text" id="thoughts-datetime" name="i-datetime" disabled>
			<label for="thoughts">Detailed post</label>
			<textarea id="thoughts" name="i-toughts"></textarea>
			<input type="submit" name="submit-btn" value="Let's post this!">
		</form>

		<!-- Display post below -->
		<hr>
		<h2>Submitted post</h2>
	</main>

<?php
	require_once "includes/footer.php";
?>