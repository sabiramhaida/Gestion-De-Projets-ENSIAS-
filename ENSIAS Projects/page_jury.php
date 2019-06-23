<?php
session_start();
if ($_SESSION['login_ok_jury'] == false) { //controler la "session" .
    header('Location:loginpage.php');
  }
include("connect_database.php"); //connexion a la BDD.

$query1="select nom_jury, prenom_jury from Jury where cin_jury='".$_SESSION["cin_jury"] ."'";
$result1= mysqli_query($connect, $query1);
$row1=  mysqli_fetch_assoc($result1);
$nom_user= $row1['nom_jury'];
$prenom_user= $row1['prenom_jury'];
?>

<html>
    <header>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" type="text/css" href="css/stylesheet_tables.css">
        <title> Jury </title>
        <div id="Logos">
            <img src="Images/ENSIAS.png" id="ENSIAS">
            <a href="BienvenueEncadrant.html"> <img src="Images/EP.png" id="EP"></a>
            <img src="Images/um5.png" id="um5">
        </div>
    </header>
    <body>
        <nav id="nav">
                <a href="page_jury.php" ><button id="Menus"> Accueil </button></a>
        <a href="Jury_Soutenance.php" ><button id="Menus"> Calendrier des Soutenance</button></a>
        <a href="Deconnexion.php" ><button id="Menus"> Déconnexion </button></a>
        </nav>
        <a href="#menu" class="navPanelToggle"><span class="fa fa-bars"></span></a>    
        <div id="Connexion">
                <img src="Images/Person.png" id="Person_etud">
                <p id="Welcome1">Espace Jury</p>
            </div> 
        <div id="Bienvenue">
            <p id="Welcome2">Bienvenue Mr. <?php echo" ".$nom_user." ".$prenom_user.""?> ,Heureux de Vous revoir. </p>
        </div> 
    </body>
</body>

</html>
    
<?php include("footer.php");  ?>
</body>

</html>
