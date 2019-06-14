<?php
$host="127.0.0.1";
$user="pfa1";
$password="A-tourists0";
$database="BDD_PFA1";
$connect=  mysqli_connect($host, $user, $password, $database);
if(mysqli_connect_errno()){
    die("Cannot connect to database:". mysqli_connect_error());   
}
 else {
    echo ('');  
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php

        ?>
    </body>
</html>
