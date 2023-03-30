<?php
	/* 
	* Login script for the timetable website.
	* Assignment 5, CSCI 1170, Winter 2022
	* Starter code provided by Dr. Raghav V. Sampangi
	*/

	session_start();

	require_once "functions.php";
	require_once "db.php";

	if (isset($_REQUEST['l-submit'])) {
		if ($_SESSION['security-token'] == $_REQUEST['l-token']) {
			// Process the login
			$email = sanitizeData($_REQUEST['l-email']);
			$pswd = sanitizeData($_REQUEST['l-pswd']);

			$loginSQL = "SELECT * FROM c_login WHERE c_login_email='{$email}'";

			$result = $db->query($loginSQL);

			if ($result->num_rows > 0) {
				$row = $result->fetch_assoc();

				if (password_verify($pswd, $row['c_login_password'])) {
					session_regenerate_id();
					$_SESSION['security-token'] = "";
					$_SESSION['email'] = $email;
					//echo "here - login success";
					$userInfoSQL = "SELECT * FROM c_user WHERE c_user_login_id='{$row['c_login_id']}'";
					$resultUserInfo = $db->query($userInfoSQL);

					if ($resultUserInfo->num_rows > 0) {
						$row = $resultUserInfo->fetch_assoc();
						$_SESSION['username'] = $row['c_user_f_name'] . " " . $row['c_user_l_name'];
						$_SESSION['user_ID'] = $row['c_user_id'];
					}
					header("Location: ../index.php");
				}
				else {
					//echo "here - login found, password error";
					header("Location: ../index.php?loginerror=1");
				}
			}
		}
		else {
			//echo "here - login not found";
			header("Location: ../index.php?loginerror=1");
		}
	}


?>