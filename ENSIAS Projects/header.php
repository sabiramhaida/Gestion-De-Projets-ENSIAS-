<?php
include("connect_database.php");
$result=mysqli_query($connect,"select *from Notifications where id_destinataire='".$_SESSION['cin_encad']."' and statut_notif= 0 ");
$count_notif_unseen=mysqli_num_rows($result);
  ?>


<html>
    <header>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" type="text/css" href="css/stylesheet_tables.css">
        <title> ENSIAS PROJECTS</title>
         <script src="Sujets.js"></script>

        <div id="Logos">
            <img src="Images/ENSIAS.png" id="ENSIAS">
            <a href="BienvenueEncadrant.html"> <img src="Images/EP.png" id="EP"></a>
            <img src="Images/um5.png" id="um5">
        </div>
    </header>
    <body>
        <nav id="nav">
        <a href="page_encadrant.php" ><button id="Menus"> Accueil </button></a>
        <a href="inbox_Encadrant.php" class="notification"><span> Inbox </span><?php if($count_notif_unseen>0 ) {?><span class="badge"><?php echo $count_notif_unseen ;?> </span></a> <?php } ?> 
        <a href="Encadrant_Affectation.php" ><button id="Menus"> Affectations </button></a>
        <a href="Encadrant_Soutenance.php" ><button id="Menus"> Soutenance</button></a>
        <a href="sujets_Encadrant.php"><button id="Menus"> Mes Projets </button></a> 
        <a href="Encadrant_rv.php"><button id="Menus"> Mes Rendez-vous </button></a>
        <a href="Encadrant_Archive.php" ><button id="Menus"> Archive </button></a>
        <a href="Deconnexion.php" ><button id="Menus"> Déconnexion </button></a>
        </nav>
        <a href="#menu" class="navPanelToggle"><span class="fa fa-bars"></span></a>    
    </body>
</html>
