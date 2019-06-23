<?php
session_start();
if ($_SESSION['login_ok_admin'] == false) { 
header('Location: loginpage.php');
}
?>
<html>
    <header>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" type="text/css" href="css/stylesheet_tables.css">
        <title> Admin</title>
        <div id="Logos">
            <img src="Images/ENSIAS.png" id="ENSIAS">
            <a href="BienvenueEncadrant.html"> <img src="Images/EP.png" id="EP"></a>
            <img src="Images/um5.png" id="um5">
        </div>
    </header>
    <body>
        <nav id="nav">
                <a href="page_admin.php" ><button id="Menus"> Accueil </button></a>
        <a href="Admin_Affectation.php" ><button id="Menus"> Affectations des projets </button></a>
        <a href="Admin_Soutenance.php" ><button id="Menus">  Calendrier des Soutenance</button></a>
        <a href="#" ><button id="Menus"> Gestion Des compts </button></a>
        <a href="Deconnexion.php" ><button id="Menus"> Déconnexion </button></a>
        </nav>
        <a href="#menu" class="navPanelToggle"><span class="fa fa-bars"></span></a>    
        <div id="Connexion">
                <img src="Images/Person.png" id="Person_etud">
                <p id="Welcome1">Espace    Admin</p>
            </div> 
        <div id="Bienvenue">
            <p id="Welcome2">Bienvenue Mr. Admin Heureux de Vous revoir. </p>
        </div> 
    </body>
</body>

</html>
    
<?php include("footer.php");  ?>
</body>

</html>
