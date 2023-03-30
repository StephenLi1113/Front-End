
<!-- Reuse header -->
<?php require_once 'header.php';
    
?>

 <!-- All of layout code are from Bootstrap
		 Author: Mark Otto, Jacob Thornton. etc
		 URl: https://getbootstrap.com/docs/5.1/getting-started/download/
		data accessed: 15 Feb 2022
	-->

<main id="pg-main-content" class="container bg-white" >
    <br>
    <br>
    <br>
    <br>
<form name ="formlog" action="" method="POST" class="ms-3 border border-info border-4 rounded-pill pt-5">


            <h1 class="text-center">Log in</h1>
            
            <div class="row">
            <div class="col-4"></div>
           <div class="col-6">
			<div class="form-floating mt-4">
            <!-- 
                Email input
             -->
			<input type="email" class="form-control w-75" name="floatingInput" placeholder="name@example.com">
			<label for="floatingInput">Email address</label>
			</div>

            <!-- Password input -->
			<div class="form-floating mt-4">
			<input type="password" class="form-control w-75" name="floatingPassword" placeholder="Password">
			<label for="floatingPassword">Password</label>
            </div>
        </div>
    </div>

            
        

<?php
    
    //list to same a account information
    $acclist = array();

    //read csv file
    $file = fopen('../server/users.csv', 'r');

    $count = 0;

	while (($line = fgetcsv($file)) !== FALSE) {
        //$line is an array of the csv elements
        //save user information into $acclist
        $acclist[$count] = $line[0];
        $count = $count + 1;
        $acclist[$count] = $line[1];
        $count = $count + 1;
        $acclist[$count] = $line[2];
        $count = $count + 1;
    }
    
    //close file
    fclose($file);

    
    $num = 0;
    $index = 0;
    
    $wiriteFile = fopen('../server/login-data.txt', 'w+');
    $username = null;

    
	if(isset($_POST['submit']) == true){
    for($i = 0; $i < count($acclist); $i++)
    {      
        //if user input correct email and password, then log in successed
        if($acclist[$i] === $_POST['floatingInput'] and $acclist[$i+1] === $_POST['floatingPassword'])
        {
            //write data in login-data.txt file
            fwrite($wiriteFile, $acclist[$i-1]);
            $username = $acclist[$i-1];
            fwrite($wiriteFile, ",");
            fwrite($wiriteFile, $acclist[$i]);
            fwrite($wiri1teFile, "\n");
            //record whether log into the account
            $num++;
        }
        
    }

    //if log in successed, then link to index.php
    if($num == 1)
    {
        
        header("Location: ../index.php");
        
        
    }else{
        //if did not log in successed, then show error message
        echo '<div class="alert alert-warning alert-dismissible fade show fixed-top" role="alert">
                <strong>Error!</strong> Please enter a vaild account.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
       
            //error message under input forms
            $_POST["tip"] = "Invaild account!";
            //$tip to transite value to html
            $tip = $_POST["tip"];
    
           
}

    fclose($file);
}else
{
    //if user has not enter account, then show nothing
    echo "";
}



?>


<div class="row">
    <div class="col-5"></div>
    <!-- if enter a invalid account, then show a error message -->

    <p class="bg-danger mt-2 col-3 text-center fs-3" id="tip" name ="tip"><?php echo htmlspecialchars($tip); ?></p>
    
</div>
<!-- submit button -->
<div class="row">
<div class="col-5"></div>

<input type="submit" name="submit" value="Submit" class="mt-1 mb-5 col-3 bg-primary" id="submit"> 

</div>

</form>
			

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>			
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

			


</main>





<!-- Reuse footer -->
<?php include ('./footer.php') ?>
</body>

</html>