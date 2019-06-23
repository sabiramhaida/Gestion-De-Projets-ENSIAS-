<?php
session_start();
if ($_SESSION['login_ok_Ese'] == false) { 
header('Location:loginpage.php');
}
include("connect_database.php");
$query1="select Nom_entreprise from entreprise where Nom_entreprise='".$_SESSION["Nom_entreprise"]."'";
$result1= mysqli_query($connect, $query1);
$row1=  mysqli_fetch_assoc($result1);
$nom_user= $row1['Nom_entreprise'];
?>
<!DOCTYPE html>
<html lang="Fr" >

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Espace Ese</title>

      <link rel="stylesheet" href="css/style.css">
      <img src="Images/Logo%20ENSIAS.png" height="100" width="100" id="ENSIAS">
</head>
<body>
  <html>
	<head>
  		<link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,300italic,400italic,600italic,600' rel='stylesheet' type='text/css'>
  		<link rel="Stylesheet" href="css/master.css" type="text/css" />
  		</style>

  		<link rel="Stylesheet" href="https://ianlunn.github.io/Hover/css/hover.css" type="text/css" />
  
  		<link rel="Stylesheet" href='https://fonts.googleapis.com/css?family=Muli' type='text/css'>
	</head>
<body>
<nav>
    <ul>
      <li><a href="page_Ese">Accueil</a></li>
      <li><a href="Ese_Affectation.php">Affectation de Mes Projets</a></li>
      <li><a href="#">paramètres</a>
       <ul>
          <li><a href="changerMdp.php">changer le mot de passe</a></li>
          <li><a href="changerMdp.php">Modifier Mes Coordonnées</a></li>
        </ul>
        </li>
      <li><a href="#">Mes Projets</a>
        <ul>
          <li><a href="Ese_Soutenance.php">Mes sujets Proposés</a></li>

          <li><a href="Ese_Soutenance.php">Calendrier Des Soutenances</a></li>
        </ul>
      </li>
      <li><a href="Deconnexion.php">Déconnexion</a></li>
    </ul>
</nav>
<h4>ENSIAS-projects</h4>
<div class="welcome"> <?php echo ("<h1>".$nom_user." ".$prenom_user."</h1");?> </div>
</body>
</html>
</body>
</html>