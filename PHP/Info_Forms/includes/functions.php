<?php
function sanitizeDataFromClient($stringDataFromForm){
    $sanitisesDataFromClient = trim($stringDataFromForm);
    $sanitisesDataFromClient = htmlspecialchars($sanitisesDataFromClient);
    $sanitisesDataFromClient = stripslashes($sanitisesDataFromClient);

    return $sanitisesDataFromClient;
}

function navItem($filename, $title) {
    /* 
        basename($_SERVER['PHP_SELF'] referenced from StackOverflow
        Author: flori
        Date retrieved: Feb 1 2022
        URL: https://stackoverflow.com/questions/18023149/php-how-can-i-know-the-current-page-name-im-in-it
    */
    $class = basename($_SERVER['PHP_SELF']) == $filename ? "active" : "";
    echo "<a href='$filename' class='$class'>$title</a>";
}
?>