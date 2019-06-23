<?php
    session_start();
    include("connect_database.php");
    $query='DELETE FROM projet WHERE id_projet IN('.implode(',', array_map('intval', $_POST['supp'])).')';
    $result= mysqli_query($connect, $query);
    header("Location:sujets_Encadrant.php ");
?>	