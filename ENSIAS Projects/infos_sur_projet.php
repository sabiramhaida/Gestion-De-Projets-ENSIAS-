<?php
include("connect_database.php");
session_start();

if ($_SESSION['login_ok_etud'] == false) { 
header('Location:loginpage.php');

}
?>

<html>
    <header>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" type="text/css" href="css/stylesheet_tables.css">
        <title> Espace Etudiant</title>
       <script src="Sujets.js"></script>

        <div id="Logos">
            <img src="Images/ENSIAS.png" id="ENSIAS">
            <a href="BienvenueEncadrant.html"> <img src="Images/EP.png" id="EP"></a>
            <img src="Images/um5.png" id="um5">
        </div>
    </header>
    <body>
        <nav id="nav">
                <a href="page_etudiant.php" ><button id="Menus"> Accueil </button></a>
        <a href="Etudiant_Affectation.php" ><button id="Menus"> Affectations </button></a>
        <a href="Etudiant_rv.php"><button id="Menus"> Mes Rendez-vous </button></a> 
        <a href="Etudiant_Soutenance.php" ><button id="Menus"> Soutenance</button></a>
        <a href="Etudiant_Archive.php" ><button id="Menus"> Archive </button></a>
        <a href="Deconnexion.php" ><button id="Menus"> Déconnexion </button></a>
        </nav>
        <a href="#menu" class="navPanelToggle"><span class="fa fa-bars"></span></a>   
    </body>
  <table bgcolor="#fff" style="margin-top:250px";>
             <caption> <h1>Description de votre Projet:</h1></caption>
            <thead>
                <tr>
                    <th colspan="5">Année: <?php echo date('Y'); ?></th>
                </tr>
                <tr>
                    <th>titre</th>
                    <th>Descriotion de votre Projet</th> 
                </tr>
            </thead>
            <tbody>
              <!-- code php pour insirer les donnes-->
              <?php
              $query="select intitule_sujet,desciption  from projet where id_projet='".$_SESSION['c_p']."'";
                $result=  mysqli_query($connect,$query);
                $count = mysqli_num_rows($result);
                $row=  mysqli_fetch_assoc($result);
                $Titre=$row['intitule_sujet'];
                $desc=$row['desciption'];
                echo utf8_encode("<tr class='pfa1'>");
                echo utf8_encode( "<td> <div class='titre'>".$Titre."</div></td>
                                      <td><div>".$desc."</div></td>
                                      </tr>
                                    <tr>");                
              ?>

</body>

</html>

</body>
</html>