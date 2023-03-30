<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>MailYoda</title>
</head>
 <!-- All of layout code are from Bootstrap
		 Author: Mark Otto, Jacob Thornton. et, al.
		 URl: https://getbootstrap.com/docs/5.1/getting-started/download/
		data accessed: 20 Mar 2022
	-->
    
<!-- Most codes in this file are from last A3 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<nav class="navbar navbar-expand-lg navbar-light bg-primary sticky-top">
<div class="container-fluid">
<a class="navbar-brand fs-3" href="../index.php">MailYoda</a>
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>
<ul class="nav justify-content-end">

<!-- Feed News button on NavBar -->
<li class="nav-item">
<a class="nav-link text-white" href="../index.php">Inbox</a>
</li>

<li class="nav-item">
<a class="nav-link text-white" href="../index.php#sent">Sent/Drafts</a>
</li>

<li class="nav-item">
<a class="nav-link text-white" href="../index.php#compose">Compose</a>
</li>

<li class="nav-item dropdown">
<?php
        require_once('db.php');

        session_start();
        //user id
        $value = $_SESSION['login'];
        //get all of user information from database
        $sql = "SELECT * FROM je_users where je_user_id='$value'";
        $result= mysqli_query($connect,$sql);

        if($result -> num_rows > 0)
        {
        
            $row = $result->fetch_assoc();
            //show the fullname of user on navBar, and show profile and logout button under fullname
        echo '<a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">'
             . $row['je_user_firstname'] . ' ' .   $row['je_user_lastname'].
        '</a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item nav-link text-black" href="../profile.php">Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item nav-link text-black" href="../includes/logout.php"> Logout </a></li>
            
        </ul>';
        }
    ?>

          
</li>

</ul>
</div>
</nav>
