<!-- All of layout code are from Bootstrap
		 Author: Mark Otto, Jacob Thornton. et, al.
		 URl: https://getbootstrap.com/docs/5.1/getting-started/download/
		data accessed: 20 Mar 2022
	-->


  <!-- Most codes in this file are from last A3 -->
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



//prevent direct url access to php file
if(!isset($_SERVER['HTTP_REFERER'])){
  // redirect them to index location
  header('location:../index.php');
  exit;
  }

if(isset($_POST['login'])){
  require_once('db.php');

    if ($connect->connect_error) {
      die("Connection failed: " . $connect->connect_error);
    }
 

    //get user input
    $username = $_POST['email'];
    $password = $_POST['password'];

    //base on user input to search data in database
    $sql = "SELECT * FROM je_login where je_login_email='$username'";

    $result= mysqli_query($connect,$sql);
    $row12 = $result->fetch_assoc();
    
    $dataPass = $row12['je_login_password'];
    $num = $row12['je_login_id'];
     
    if($result -> num_rows > 0 && password_verify($password, $dataPass))
    {
     
    
     //get user id
    
     session_start();
     $_SESSION['login'] = $num;
     
     $_SESSION['valid'] = true;
     
    header("Location: ../index.php");
     
    
     
 }else{
   
  //  if user enter a invaild account, then show a error massage on the web
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Invaild account!</strong> Please make sure your account is vaild and try again.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
  
 }
}

if(isset($_POST['register']))
{
    //to the register page
    header("Location: ../register.php");
}
?>

  <!-- Log in form -->
    <div class="container border border-4 border-info position-absolute top-50 start-50 translate-middle">
    <h1 class="text-center">
        Log in
    </h1>
    <form method="POST" action="">
    <div class="mb-3 row">
    <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-10">
    <input type="email" class="form-control" id="exampleFormControlInput1" name="email" placeholder="name@example.com">
    </div>
  </div>
  <div class="mb-3 row">
    <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="inputPassword" name="password" placeholder="password">
    </div>
  </div>
  <div class="row mb-2">
    <p class="col-3"></p>
  <button type="submit" class="btn btn-primary btn-sm col-6" id="log in" name="login">Log in</button>
  </div>

  <div class="row mb-5">
    <p class="col-3"></p>
    <button type="submit" class="btn btn-primary btn-sm col-6" id="regis" name="register">New to this MailYoda? Register here.</button>
  </div>
  </form>

  </div>

</body>

</html>


