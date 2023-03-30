<h2>Thoughts about this article? Share below!</h2>
<div class="row border border-success border-4 rounded mb-4">
<form action="" method="POST">
  <!-- Email input form -->
<div class="row">
<div class="col-6">
  <label for="exampleFormControlInput1" class="form-label">Email address</label>
  <input type="email" class="form-control" name = "exampleFormControlInput1" id="exampleFormControlInput1" placeholder="name@example.com">
</div>

<!-- Full name input form -->
<div class="col-6">
  <label for="exampleFormControlInput1" class="form-label">Full name</label>
  <input type="text" class="form-control" name = "exampleFormControlInput2" id="exampleFormControlInput2" placeholder="Firstname + Lastname">
</div>
</div>

<!-- Comments form -->
<div class="row">
  <div class="col-3"></div>
<div class="col-7">
  <label for="exampleFormControlTextarea1" class="form-label">Enter Comments Here</label>
  <textarea class="form-control" name = "exampleFormControlTextarea1" id="exampleFormControlTextarea1" rows="3"></textarea>
</div>
</div>

<div class="row">
<div class="col-5"></div>
<input type="submit" name="submit" value="Submit Comment" class="btn btn-secondary btn-lg mt-2 mb-3 col-2 text-center col-2">
</div>
</form>
<?php

//coninus to write data into  file 
$filewrite = fopen('../server/comments.txt', 'a');
$infolist = array();
if(isset($_POST['submit']))
{

    // through the URL to get the name of article file
  if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
      $link = "https";
  else $link = "http";
  // use explod to split a URL by using '/'
    $namelist = explode("/",$_SERVER['PHP_SELF']);

  //save all data in a array by using php array key =>
    $list = array(
      "file_name" => $namelist[count($namelist)-1],
      "commenter_name" => $_POST['exampleFormControlInput2'],
      "commenter_email" => $_POST['exampleFormControlInput1'],
      "comment" => $_POST['exampleFormControlTextarea1'],
    );

    //Encode this associative array into JSON 
  $data = json_encode($list) . "\n";

  //add a line change elemnt in array
  array_push($infolist, $data);
  // store all json in comments.txt
  for($i = 0; $i < count($infolist); $i++)
  {

    fwrite($filewrite, $infolist[$i]);
  }
  fclose($filewrite);
  
}




?>

</div>
