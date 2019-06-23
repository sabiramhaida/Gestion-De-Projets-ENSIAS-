<?php
session_start();
include("connect_database.php");

    $target = "CR/";
    $target = $target.basename($_FILES['uploaded']['name']);


    if (move_uploaded_file($_FILES['uploaded']['tmp_name'], $target))
    {
        echo basename($_FILES['uploaded']['name']);
        echo $_SESSION["fileToUp"];
       $ok=mysqli_query($connect,"UPDATE Rendez_vous set chemin_compte_rendu='".basename($_FILES['uploaded']['name'])."'  where id_rv='".$_SESSION["fileToUp"]."'");

       header("location: Etudiant_rv.php");

    }
    else
    {
        echo "Sorry, there was a problem uploading your file.";
    }


?>
