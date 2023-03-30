<?php
// <!-- Most codes in this file are from last A3 -->
//database connection in PHP
$host="localhost";
$user = "root";
$password = "root";
$db = "jedi_encrypted_email";

$connect = mysqli_connect($host, $user, $password, $db);

if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
  }
?>