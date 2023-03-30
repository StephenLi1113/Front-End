<?php

    //prevent direct url access to php file
    if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to index location
    header('location:../index.php');
    exit;
    }
    //if logout, then only show the login page
    session_start();
    $_SESSION['valid'] = false;
    header("Location: ../includes/login.php");

?>