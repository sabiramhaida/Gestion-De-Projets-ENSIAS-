<?php
session_start();
include("connect_database.php");
$query='UPDATE monome_binome set id_proejt= '.$_GET['projetid'].' where id_m_b = '.$_GET['mnBn'].'';

$result= mysqli_query($connect, $query);

?>