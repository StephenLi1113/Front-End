<?php
    session_start();
	//if user enter a vaild account, then show the homepage
	if(isset($_SESSION['valid']) !== true)
	{
		require_once './includes/login.php';
	}else{
		require_once './includes/db.php';
		require_once './includes/header.php';

		//get user information
		$userID = $_SESSION['login'];

		$userSql = "SELECT * FROM je_login where je_login_id = $userID";
		$result_sql = mysqli_query($connect, $userSql);
		if($result_sql -> num_rows > 0)
		{
			$userRow = $result_sql -> fetch_assoc();
			$userEmail = $userRow['je_login_email'];
		}


        echo'<body class="bg-white d-flex flex-column">
		<div class="container bg-light d-flex flex-column min-vh-100">
		<div class="bg-light d-flex flex-column">
		<h2 class="text-center">Inbox</h2>
		<span class="border-top border-4 border-info mb-3"></span>';
		//Inbox part
		$sql = "SELECT * from je_inbox";
		$result = mysqli_query($connect, $sql);
		if($result -> num_rows > 0)
		{
			//show all of information in inbox
			$row = mysqli_fetch_all($result, MYSQLI_ASSOC);
			
			for($j = 0; $j < $result -> num_rows; $j++)
			{	
				if($row[$j]['je_email_to_id'] === $userID){


				echo '<div class="row border border-success border-3 rounded ms-3 me-3 mb-3 mt-1">
					<a href="index.php?' . 'view=inbox&email_id='. $row[$j]['je_email_id'] . '&email_from=' . $row[$j]['je_email_from_email'] . '&date_received='. $row[$j]['je_date_received'].'">' . $row[$j]['je_email_subject'] . '</a>';

				echo '<div class="row mb-5 mt-4 name='.$row[$j].'">'
						. $row[$j]['je_email_content'] . '</div>';
						echo'<p class="col-5"></p>
						</div>';
				}
			}
		}
		
		echo '</div>';
		
		//Sent and Draft part
		echo '<h2 id="sent" class="text-center">Sent/Drafts</h2>
		<span class="border-top border-4 border-info mb-3"></span>';
		if(isset($_POST['encryMess']) && $message !== "")
		{
			echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Encrypted!</strong> This email is encrypted.
            
            </div>';
		}

		//to print all of sent email in the Sent/draft part
		$SD_sql = "SELECT * from je_email_sentdrafts";
		$SD_result = mysqli_query($connect, $SD_sql);
		if($SD_result -> num_rows > 0)
		{
			$SD_row = mysqli_fetch_all($SD_result, MYSQLI_ASSOC);
			
			for($i = 0; $i < $SD_result -> num_rows; $i++)
			{	
				if($SD_row[$i]['je_sentdraft_from_id'] === $userID){

				echo '<div class="row border border-success border-3 rounded ms-3 me-3 mb-3 mt-1">
					<a href="index.php?' . 'view=sentdrafts&email_id='. $SD_row[$i]['je_sentdraft_id'] . '&email_from=' . $SD_row[$i]['je_sentdraft_from_email'] . '&date_received='. $SD_row[$i]['je_sentdraft_datetime'].'">' . $SD_row[$i]['je_sentdraft_subject'] . '</a>';

				echo '<div class="row mb-5 mt-4 name='.$SD_row[$i].'">'
						. $SD_row[$i]['je_sentdraft_content'] . '</div>';
						echo'<p class="col-5"></p>
						</div>';

				}
			}
		}

		
		//regex of email and phone number
		$emailForm = "/^[a-z0-9]{1,}.*@[a-z0-9]{1,}\.[a-z]{1,4}$/";
		$phoneNum = "/^\d{1,10}.*$/";


		//move +4 ASCII number
		function moveasc($value)
		{
			$sep = str_split($value[0]);
			for($j = 0; $j < count($sep); $j++)
			{
			
			$sep[$j] = chr(ord($sep[$j])+4);
			}
			$emcry = implode($sep);

			return($emcry);
		}

		//user input
		$message = $_POST['mess'];
		$toEmail = $_POST['ToEmail'];
		$subject = $_POST['subject'];
		//time getter
		$time = date('Y-m-d H:i:s');

		// get the new id of sentdraft database
		$sqleee = "SELECT * from je_email_sentdrafts ORDER BY je_sentdraft_id DESC";
		$resultee = mysqli_query($connect, $sqleee);
		if($resultee -> num_rows > 0)
		{
			$rowee = $resultee -> fetch_assoc();
			$drafid = $rowee['je_sentdraft_id'] + 1;
		}

		//to get the new id of inbox in the database
		$numberSql = "SELECT * from je_inbox ORDER BY je_email_id DESC";
		$numResult = mysqli_query($connect, $numberSql);
		if($numResult -> num_rows > 0)
		{
			$rownn = $numResult -> fetch_assoc();
			$inboxID = $rownn['je_email_id'] + 1;
			
		}

		//get the id of sent user email
		$fromid = "SELECT * FROM je_login where je_login_email = '$toEmail'";
		$firesult= mysqli_query($connect, $fromid);
		if($firesult -> num_rows > 0)
		{
			$firow = $firesult -> fetch_assoc();
			$fi = $firow['je_login_id'];
			
		}

		//Send a email without encrypted
		if(isset($_POST['regular']) && $message !== "" && $subject !== "")
		{
			$inboxRece = "INSERT INTO je_inbox(je_email_id, je_email_from_email, je_email_to_id, je_email_subject, je_email_content, je_email_enc,je_date_received)
							VALUES($inboxID, '$userEmail', $fi, '$subject', '$message', 0, '$time')";


			$inboxSent = "INSERT INTO je_email_sentdrafts(je_sentdraft_id, je_sentdraft_to_email, je_sentdraft_from_id, je_sentdraft_subject, je_sentdraft_content, je_sentdraft_draft, je_sentdraft_enc,je_sentdraft_datetime)
					VALUES($drafid, '$toEmail', $userID, '$subject', '$message', 0, 0, '$time')";

			
			mysqli_query($connect, $inboxRece);
			mysqli_query($connect, $inboxSent);
		}


		///Send encrypted email
		if(isset($_POST['encryMess']) && $message !== "" && $subject !== "") 
		{
			//split a string in to array
			$word = explode(" ", $message);
			
			//to match the regex
			for($i = 0; $i < count($word); $i++)
			{
				if(preg_match($emailForm, $word[$i], $array) || preg_match($phoneNum, $word[$i], $array) || preg_match("/c.+p/", $word[$i], $array)
				 || preg_match("/T.+p/i", $word[$i], $array) || preg_match("/e.+t/i", $word[$i], $array) || preg_match("/a.+e/i", $word[$i], $array)
				 || preg_match("/a.*w/i", $word[$i], $array) || preg_match("/c.+e/i", $word[$i], $array) || preg_match("/u.+e/", $word[$i], $array))
				{
					//get the encrypted message
					$word[$i] ='$eas$'.moveasc($array);
					
				}
			}
			//combined all encrypted words into message
			$encryMessage = implode(" ", $word);
			
			//add new email in to the database
			$encryinbox = "INSERT INTO je_inbox(je_email_id, je_email_from_email, je_email_to_id, je_email_subject, je_email_content, je_email_enc,je_date_received)
							VALUES($inboxID, '$userEmail', $fi, '$subject', '$encryMessage', 1, '$time')";
			mysqli_query($connect, $encryinbox);


			$encrySql = "INSERT INTO je_email_sentdrafts(je_sentdraft_id, je_sentdraft_to_email, je_sentdraft_from_id, je_sentdraft_subject, je_sentdraft_content, je_sentdraft_draft, je_sentdraft_enc,je_sentdraft_datetime)
					VALUES($drafid, '$toEmail', $userID, '$subject', '$encryMessage', 0, 1, '$time')";

			mysqli_query($connect, $encrySql);
		
			
		}
		
		//Save as draft
		//save draft in database
		if(isset($_POST['draft']))
		{
			
			$draftSent = "INSERT INTO je_email_sentdrafts(je_sentdraft_id, je_sentdraft_to_email, je_sentdraft_from_id, je_sentdraft_subject, je_sentdraft_content, je_sentdraft_draft, je_sentdraft_enc,je_sentdraft_datetime)
					VALUES($drafid, '$toEmail', $userID, '$subject', '$message', 1, 0, '$time')";

			mysqli_query($connect, $draftSent);
		}

		//clean the data
		function clean($data)
		{
			$data = htmlspecialchars($data);
			$data = stripslashes($data);
			$data = trim($data);
			return $data;
		}

		//cancel buttom to clean all user input
		if(isset($_POST['cancel']))
		{
			clean($_POST['mess']);
			clean($_POST['ToEmail']);
			clean($_POST['subject']);
		}




		echo '<h2 id="compose" class="text-center">Compose</h2>
		<span class="border-top border-4 border-info mb-3"></span>';
		echo '
		<span class="border border-4 border-warning mb-3">
		<form class="ms-3 me-3 mt-5" method="POST" action="">
		<div class="mb-3 row">
		<label for="staticEmail" class="col-sm-2 col-form-label">To:</label>
		<div class="col-sm-10">
		<input type="email" class="form-control" id="exampleFormControlInput1" name="ToEmail" placeholder="name@example.com">
		</div>
		</div>
		
		<div class="mb-3 row">
		<label for="staticEmail" class="col-sm-2 col-form-label">From:</label>
		<div class="col-sm-10">	
		<input type="text" readonly class="form-control-plaintext" id="staticEmail" value="'.$userEmail.'">
		</div>
		</div>
		
		<div class="mb-3 row">
		<label for="staticEmail" class="col-sm-2 col-form-label">Email Subject:</label>
		<div class="col-sm-10">
		<input type="text" class="form-control" id="exampleFormControlInput1" name="subject" placeholder="Email Subject(If you want to reply a email, please add Re:  at the first of your subject line)">
		</div>
		</div>

		
		<div class="mb-3 row">
		<label for="exampleFormControlTextarea1" class="col-sm-2 col-form-label">Message:</label>
		<div class="col-sm-10">
		<textarea class="form-control" id="exampleFormControlTextarea1" placeholder="Message" name="mess" rows="3"></textarea>
		</div>
		</div>
		
		<div class="row mb-2">
		<p class="col-4"></p>
		<button type="submit" class="btn btn-primary btn-sm col-5" name="regular">Send a regular email</button>
		</div>


		<div class="row mb-2">
		<p class="col-4"></p>
		<button type="submit" class="btn btn-primary btn-sm col-5" name="encryMess">Send encrypted email</button>
	  	</div>

		<div class="row mb-3">
		<p class="col-4"></p>
		<button type="submit" class="btn btn-primary btn-sm col-5" name="draft">Save as draft</button>
	  	</div>

		<div class="row mb-5">
		<p class="col-4"></p>
		<button type="submit" class="btn btn-primary btn-sm col-5" name="cancel">Cancel</button>
	  	</div>
		</form>
		</span>';

		
		echo '</div>
		</body>';
		require_once('./includes/footer.php');
    }

	
		
?>

</html>

