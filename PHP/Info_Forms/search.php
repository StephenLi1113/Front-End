<?php
	/*
	 *	Code for CSCI 2170: GL2, Winter 2022
	 *	Please read the instructions on Brightspace and work on this lab exercise during the lab time.
	 */

	/*
	 * This search form processing was coded by: Shun Li
	 * Student name: Shun Li
	 * Email:  sh615496@dal.ca
	 */

	require_once "includes/functions.php";
	require_once "includes/header.php";


?>



	<main class="pg-main-content">
		<!-- Search form to be processed in contact.php -->
		<form action="search.php" method="get">
			<label for="search-input">Hey doc! What're you looking for?</label>
			<input type="text" id="search-input" name="i-search">
			<input type="submit" name="submit-btn" value="Let's search for this thing">

		</form>

		

		<!-- Display search results below -->
		<hr>
		<h2>Search results</h2>
		<?php
		
		//Read line by line
			
			$file = file_get_contents("./files/search-text.txt");
			$line = explode("\n", $file);

			foreach($line as $newline)
			{
				//to judge whether the line contains input string
				$search = strpos($newline, $_GET["i-search"]);
				if($search)
				{
					echo $newline;
				}

			}

		
		?>
	</main>


	
		

<?php
	require_once "includes/footer.php";
?>