<?php
    session_start();
    $connect=  mysqli_connect("127.0.0.1", "pfa1", "A-tourists0", "version99"); 
    $query='DELETE FROM Rendez_vous WHERE id_rv IN('.implode(',', array_map('intval', $_POST['supprv'])).')';
    $result= mysqli_query($connect, $query);
    header("Location:Encadrant_rv.php ");
?>
