<?php
session_start();
$_SESSION = array();
session_destroy();
$_SESSION['login_ok'] = false; 
header('location: menu.html');
?>

