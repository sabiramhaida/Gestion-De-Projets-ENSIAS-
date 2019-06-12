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
?>

<html>
    <header>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" type="text/css" href="css/stylesheet.css">
        <title> ENSIAS PROJECTS</title>
        <div id="Logos">
            <img src="Images/ENSIAS.png" id="ENSIAS">
            <a href="BienvenueEncadrant.html"> <img src="Images/EP.png" id="EP"></a>
            <img src="Images/um5.png" id="um5">
        </div>
    </header>
    <body>
        <nav id="nav">
                <a href="page_encadrant.php" ><button id="Menus"> Accueil </button></a>
        <a href="Encadrant_Affectation.php" ><button id="Menus"> Affectations </button></a>
        <a href="Encadrant_Soutenance.php" ><button id="Menus"> Soutenance</button></a>
        <a href="sujets_Encadrant.php"><button id="Menus"> Mes Projets </button></a> 
        <a href="Encadrant_rv.php"><button id="Menus"> Mes Rendez-vous </button></a> 

        <a href="Encadrant_Archive.php" ><button id="Menus"> Archive </button></a>
        <a href="Deconnexion.php" ><button id="Menus"> Déconnexion </button></a>
        </nav>
        <a href="#menu" class="navPanelToggle"><span class="fa fa-bars"></span></a>    
        <div id="Bienvenue">
            <p id="Welcome">Bienvenue<?php echo" ".$nom_user." ".$prenom_user.""?> </p>
        </div>
    </body>
</html>
