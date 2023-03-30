<?php
    require_once('./includes/db.php');
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>MailYoda</title>
</head>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    
<body d-flex flex-column min-vh-100>

<?php

    //all required regex
    $email = "/^[a-zA-Z0-9]{1,}@jediacademy\.edu/";
    $orgEmail = "/^[a-zA-Z0-9]{1,}@theforce\.org/";
    $dalEmail = "/^[a-zA-Z0-9]{1,}@dal\.ca/";

    $firtnameRegex = "/^[A-Z].[a-z]{0,}/";
    $lastnameRegex = "/^[A-Z].[a-z]{0,}/";

    
   if(isset($_POST['register']))
   {
        //get the correct form of email
       if(preg_match($email, $_POST['reg_email']) || preg_match($orgEmail, $_POST['reg_email']) || preg_match($dalEmail, $_POST['reg_email']))
       {
          
           $newUserEmail = $_POST['reg_email'];
           $na = $newUserEmail;
           //check fullname form, whether mathc the regex
           if(preg_match($firtnameRegex, $_POST['reg_firstname']) && preg_match($lastnameRegex, $_POST['reg_lastname']))
           {

                $firstN = $_POST['reg_firstname'];
                $lastN = $_POST['reg_lastname'];

                //encrypted the password
               if($_POST['reg_password'] !== null)
               {
                   
                    $hashPassword = password_hash($_POST['reg_password'], PASSWORD_DEFAULT);
                    $sql = "SELECT * from je_login ORDER BY je_login_id DESC";
                    $result = mysqli_query($connect, $sql);

                    if($result -> num_rows > 0)
                    {
                        $row1 = $result -> fetch_assoc();
                        $newUserID = $row1['je_login_id'] + 1;
                      

                      //add in the new user into database
                        $addNew = "INSERT INTO je_login(je_login_id, je_login_email, je_login_password) VALUES ($newUserID, '$newUserEmail', '$hashPassword')";
                        mysqli_query($connect, $addNew);
                        echo $row1['je_login_id'];

                        $my_sql = "SELECT * from je_login ORDER BY je_login_id DESC";
                        $result1 = mysqli_query($connect, $my_sql);
                        //add in
                        if($result1-> num_rows > 0)
                        {
                            $row2 = $result1-> fetch_assoc();
                            $userID = $row2['je_login_id'];
                            $addUser = "INSERT INTO je_users(je_user_id, je_user_firstname, je_user_lastname, je_user_login_id, je_user_role, je_user_suspended) VALUES ($newUserID, '$firstN', '$lastN', $userID, 0, 0)";
                            mysqli_query($connect, $addUser);
                        }
                        
                        //after register, move to the login page
                        header("Location: ./includes/login.php");
                        
                    }
                    
                   
               }
           }
       }else{
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
          <strong>Something Wrong!</strong> Make user you match the rules.
          </div>';
       }
   }
   
?>

<!-- Register in form -->
<div class="container border border-4 border-info position-absolute top-50 start-50 translate-middle">
    <h1 class="text-center">
        Register
    </h1>
    <form method="POST" action="">
    <!-- Email input -->
    <div class="mb-3 row">
    <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-10">
    <input type="email" class="form-control" id="exampleFormControlInput1" name="reg_email" placeholder="name@example.com(make sure your email is end by jediacademy.edu or theforce.org or dal.ca)">
    </div>
  </div>

<!-- First Name -->
   <div class="mb-3 row">
    <label for="inputFirstName" class="col-sm-2 col-form-label">First Name</label>
    <div class="col-sm-10">
    <input type="text" class="form-control" id="exampleFormControlInput1" name="reg_firstname" placeholder="First Name(First letter must be uppercase)">
    </div>
  </div>

  <!-- Last Name -->
  <div class="mb-3 row">
    <label for="inputLastName" class="col-sm-2 col-form-label">Last Name</label>
    <div class="col-sm-10">
    <input type="text" class="form-control" id="exampleFormControlInput1" name="reg_lastname" placeholder="Last Name(First letter must be uppercase)">
    </div>
  </div>


  <div class="mb-3 row">
    <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="inputPassword" name="reg_password" placeholder="password">
    </div>
  </div>
  

  <div class="row mb-5">
    <p class="col-3"></p>
    <button type="submit" class="btn btn-primary btn-sm col-6" id="regis" name="register">Register</button>
  </div>
  </form>

  </div>

</body>
</html>