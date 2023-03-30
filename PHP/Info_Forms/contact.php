<?php
	/*
	 *	Code for CSCI 2170: GL2, Winter 2022
	 *	Please read the instructions on Brightspace and work on this lab exercise during the lab time.
	 */

	/*
	 * This contact form processing was coded by:
	 * Student name: 
	 * B00#: 
	 * Email:  
	 */

	require_once "includes/functions.php";
	require_once "includes/header.php";
?>

	<main class="pg-main-content">
		<!-- Contact form to be processed in contact.php -->
		<form action="contact.php" method="post">
			<label for="name-input">Your full name:</label>	
			<input type="text" id="name-input" name="i-name">
			<label for="email-input">Your email:</label>
			<input type="email" id="email-input" name="i-email">
			<label for="message-input">Your message</label>
			<textarea id="message-input" name="i-message"></textarea>
			<input type="submit" name="submit-btn" value="Send message">
			<input type="button" name="undo-message" value="Undo send!" onclick="">
		</form>

		<!-- Display sent message below -->
		<hr>
		<h2>Sent message</h2>
	</main>

<?php
	require_once "includes/footer.php";
?>