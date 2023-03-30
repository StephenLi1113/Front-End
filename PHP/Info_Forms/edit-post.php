<?php
	/*
	 *	Code for CSCI 2170: GL2, Winter 2022
	 *	Please read the instructions on Brightspace and work on this lab exercise during the lab time.
	 */

	/*
	 * This edit post form processing was coded by:
	 * Student name: 
	 * B00#: 
	 * Email:  
	 */

	require_once "includes/functions.php";
	require_once "includes/header.php";
?>

	<main class="pg-main-content">
		<!-- Post edit form to be processed in contact.php -->
		<form action="index.php" method="post">
			<a href="edit-post.php?edit=true" role="button">Edit this post</a>
			<label for="thoughts-title">Title for the post</label>
			<input type="text" id="thoughts-title" name="i-title" value="Value from file" disabled>
			<label for="thoughts-author">Posted by</label>
			<input type="text" id="thoughts-author" name="i-author" value="Value from file" disabled>
			<label for="thoughts-datetime">Posted updated at (automatically determined)</label>
			<input type="text" id="thoughts-datetime" name="i-datetime" value="(automatically determined)" disabled>
			<label for="thoughts">Detailed post</label>
			<textarea id="thoughts" name="i-toughts" disabled>Value from file</textarea>
			<input type="submit" name="submit-btn" value="Let's post this!" disabled>
		</form>

		<!-- Display post below -->
		<hr>
		<h2>Updated post</h2>
	</main>

<?php
	require_once "includes/footer.php";
?>