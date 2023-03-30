<!-- Most codes in this file are from last A3 -->

<?php
 require_once('./includes/header.php');
?>

<body class="bg-white d-flex flex-column min-vh-100">
    <?php
        require_once('./includes/db.php');
    ?>
    <div class="container bg-light d-flex flex-column min-vh-100">

      <!-- show user a suspend message -->
      <?php

      //prevent direct url access to php file
      if(!isset($_SERVER['HTTP_REFERER'])){
        // redirect them to your desired location
        header('location:../index.php');
        exit;
        }


      session_start();
      $id = $_SESSION['login'];

      ?>
    <h2 class="text-center">Profile</h2>
          <div class="row">
            <div class="col-4"></div>

            <!-- 
              user profile image from https://commons.wikimedia.org/wiki/File:OOjs_UI_icon_userAvatar.svg
               Data accessed: 26 Mar, 2022
             -->
            <img src="./img/user.png" class="img-fluid w-25 p-3 col-5 ms-5" alt="...">
            </div>
            <?php
                session_start();

                //$_SESSION['login'] is user_id
                $value = $_SESSION['login'];

                //get user inforamtion from database
                $sql = "SELECT * FROM je_login where je_login_id = '$value'";
                $second = "SELECT * FROM je_users where je_user_id = '$value'";
                $result = mysqli_query($connect, $sql);
                $result1 = mysqli_query($connect, $second);

                //get firstname and lastname of user from database
                echo '<form method="POST" action="">';
                if($result1 -> num_rows > 0)
                {
                    
                    $row1 = $result1->fetch_assoc();
                    
                    //show firstname and lastname of user on profile webpage
                    echo '<div class="mb-3 row">
                   
                    <div class="col-sm-10">
                    
                    <div class="row">
                    <div class="col-3"></div>
                    <div class="col-5">
                    <label >First Name</label>
                    
                    <input type="text" class="form-control" id="floatingInputValue" name="firstname" placeholder="name@example.com" value='. $row1['je_user_firstname'] .'>
                    </div>
                    <div class="col-4">
                    <label >Last Name</label>
                    <input type="text" class="form-control" id="floatingInputValue" name = "lastname" placeholder="name@example.com" value='. $row1['je_user_lastname'] .'>
                    </div>
                    </div>
                 
                    </div>
                  </div>';
                }

                //get the email and password of user from database
                if($result -> num_rows > 0)
                {
                    $row = $result->fetch_assoc();
                   
                    //show email and password of user on profile webpage
                   echo '<div class="mb-3 row" > 
                    <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                   
                    <input type="email" class="form-control" id="floatingInputValue" name = "email" placeholder="name@example.com" value='.$row['je_login_email'].'>
                 
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                   
                    <input type="password" class="form-control" id="floatingInputValue" name="password" placeholder="name@example.com" value='.$row['je_login_password'].'>
               
                    </div>
                  </div>';
                }

                echo '<div class="row">
                <p class="col-5"></p>
                <button type="submit" class="btn btn-primary btn-sm text-center col-3 ms-1" name="update">Update</button>
                </div>
                </form>';

               

                //once clicked the updata button on profile page, then update new data to the database
                if(isset($_POST['update']))
                {
                  
                  
                  $f = $_POST['firstname'];
                  $l = $_POST['lastname'];
                  $e = $_POST['email'];
                  $p = password_hash($_POST['password'], PASSWORD_DEFAULT);

                  //regex for all requirments
                  $email = "/^[a-zA-Z0-9]{1,}@jediacademy\.edu/";
                  $orgEmail = "/^[a-zA-Z0-9]{1,}@theforce\.org/";
                  $dalEmail = "/^[a-zA-Z0-9]{1,}@dal\.ca/";
                  $firtnameRegex = "/^[A-Z].[a-z]{0,}/";
                  $lastnameRegex = "/^[A-Z].[a-z]{0,}/";
                
                  //check if changed value mathch the regex
                if(preg_match($email, $e) || preg_match($orgEmail, $e) || preg_match($dalEmail, $e)){
                    if(preg_match($firtnameRegex, $f) && preg_match($lastnameRegex, $l))
                    {

                        $fname = "UPDATE je_users SET je_user_firstname = '$f' where je_user_id = $value";
                        $lanme = "UPDATE je_users SET je_user_lastname = '$l' where je_user_id = $value";
                        $email = "UPDATE je_login SET je_login_email = '$e' where je_login_id = $value";
                        $pass = "UPDATE je_login SET je_login_password = '$p' where je_login_id = $value";
                        
                         //update all of changed information to the database
                        mysqli_query($connect, $fname);
                        mysqli_query($connect, $lanme);
                        mysqli_query($connect, $email);
                        mysqli_query($connect, $pass);
                    }else{
                        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Something worng! </strong> The first letter of name must be uppercase!
                        </div>';
                    }
                }else{
                    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Something worng! </strong> The email form is not correct!
                        </div>';
                }
                
                

            }
                 

            ?>

            
            
            
        
</table>
    


</div>
</body>

<?php
	require_once('./includes/footer.php')
?>
</html>