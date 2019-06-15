<?php
session_start();
$_SESSION = array();
session_destroy();
$_SESSION['login_ok_etud'] = false; 
$_SESSION['login_ok_admin'] = false;
$_SESSION['login_ok_encad'] = false;
$_SESSION['login_ok_Ese'] = false;
header('location: index.html');
?>
