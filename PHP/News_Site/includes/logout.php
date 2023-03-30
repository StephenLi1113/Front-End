<?php
//Clear login-data.txt data
file_put_contents("../server/login-data.txt", "");
//link to index.php
header("Location: ../index.php");

?>

