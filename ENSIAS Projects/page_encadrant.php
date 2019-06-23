<?php
session_start();
if ($_SESSION['login_ok_encad'] == false) { //controler la "session" .
    header('Location:loginpage.php');
  }
include("connect_database.php"); //connexion a la BDD.

$query1="select nom_encad, prenom_encad from Encadrant where cin_encad='".$_SESSION["cin_encad"]."'";
$result1= mysqli_query($connect, $query1);
$row1=  mysqli_fetch_assoc($result1);
$nom_user= $row1['nom_encad'];
$prenom_user= $row1['prenom_encad'];

$query="select id_projet from projet where cin_encad ='".$_SESSION['cin_encad']."'";
$result=  mysqli_query($connect, $query);
$row=  mysqli_fetch_assoc($result);
$cp= $row['id_projet'];
$_SESSION['c_p']= $cp;

include("header.php");
?>
        <div id="Connexion">
                <img src="Images/Person.png" id="Person_etud">
                <p id="Welcome1">Espace Encadrant</p>
            </div> 
        <div id="Bienvenue">
            <p id="Welcome2">Bienvenue Mr. <?php echo" ".$nom_user." ".$prenom_user.""?>, Heureux de Vous revoir. </p>
        </div> 

    </body>

<?php
include("footer.php"); 
 ?>
</html>
