
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Tiger News</title>
</head>

 <!-- All of layout code are from Bootstrap
		 Author: Mark Otto, Jacob Thornton. etc
		 URl: https://getbootstrap.com/docs/5.1/getting-started/download/
		data accessed: 15 Feb 2022
	-->

<!-- Bootstrap core CSS CDN 
    https://getbootstrap.com/docs/5.1/getting-started/download/
  -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<body class="bg-light">


<nav class="navbar navbar-expand-lg navbar-light bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand fs-3" href="../index.php">Tiger News</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
            <ul class="nav justify-content-end">

            <li class="nav-item">
            <a class="nav-link text-white" href="../index.php">Home</a>
            </li>

            <li class="nav-item">
           
            
              <?php
            
                
              //Read login user information
                $file = fopen('./server/login-data.txt', 'r');
                $file2 = fopen('../server/login-data.txt', 'r');
                
                //if login data fil doesn't contain any data, still show "Log in"
                if(filesize('./server/login-data.txt') == 0 AND filesize('../server/login-data.txt') == 0){
                       echo ' <a class="text-start nav-link text-white" href="../includes/login.php" name="log">Log in</a>';
                       
                }else{
                  //if login-data.txt contains user information, then read it.
                while (($line = fgets($file)) !== FALSE) {
                  //get username
                  $collect = explode(",",$line);
                    if($collect[0] !== "")
                    {
                      $temp = $collect[0];
                      //show a form like "Welcome, User Name! (logout)"
                      echo '<a class="nav-link text-white" href="./includes/logout.php">'. "Welcome, ". $temp ."! ". "(log out)" . '</a>';
                      
                    }

                }
                
                //This is while loop is same function as above, but this is to let articles page can show "Welcome, User Name! (logout)"
                 //if login-data.txt contains user information, then read it.
                while(($line1 = fgets($file2)) !== FALSE)
                {
                  //get username
                  $collect1 = explode(",",$line1);
                    if($collect1[0] !== "")
                    {
                      $temp1 = $collect1[0];
                      //show a form like "Welcome, User Name! (logout)"
                      echo '<a class="nav-link text-white" href="../includes/logout.php">'. "Welcome, ". $temp1 ."! ". "(log out)" . '</a>';
                      
                    }
                }
              }
                
               //close file
                fclose($file);
                fclose($file2);
                
                  
              ?>
              
            
            </li>

            </ul>

  </div>
</nav>





