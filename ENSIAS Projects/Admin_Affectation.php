<?php
include("connect_database.php");

session_start();
if ($_SESSION['login_ok_admin'] == false) {  //controler la session pour des raisons de securite
header('Location:loginpage.php');
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
    </body>
<div>
<form method= "POST"  action="edit_Affectation_admin.php" >
 <table bgcolor="#fff" style="margin-top:70px";>
              <caption> <h1> Affecataion des projets pour l'année <?php echo date('Y');?></h1></caption>
<?php 
$prj=["PFA1","PFA2","PFE"];

for($j=0; $j<3;  $j++){
 ?>
            <thead>
                <tr>
                    <th colspan="6"><?php echo $prj[$j] ; ?></th>
                </tr>
                <tr>
                    <th>Binome/Monome</th>
                    <th>Titre</th>
                    <th>Encadrant</th>
                    <th>Type_projet</th>
                    <th>Entreprise</th>
                </tr>
                </tr>
            </thead>
            <tbody>
              <!-- code php pour insirer les donnes-->
               <?php
                $query[$j]="select *from projet  where Type_projet='".$prj[$j]."'";
                $result=  mysqli_query($connect,$query[$j]);
                if(!$result){
                    die("Error in query");
                }
                $count = mysqli_num_rows($result);
                for($i=0; $i<$count; $i++){
                    $row=  mysqli_fetch_assoc($result);
                    $titre=$row['intitule_sujet'];
                    $Type=$row['Type_projet'];
                    $code=$row['id_m_b'];
                    $cin_encadrant=$row['cin_encad'];
                    $nomEse= $row['nom_entreprise'];

                    $query2="select cne_etud, nom_etud, prenom_etud from Etudiant where id_m_b='".$code."'";
                    $result2=  mysqli_query($connect, $query2);
                    $row_etudiant_1= mysqli_fetch_assoc($result2);
                    $nom1= $row_etudiant_1['nom_etud'];
                    $prenom1= $row_etudiant_1['prenom_etud'];
                    $cne1= $row_etudiant_1['cne_etud'];
                    $row_etudiant_2= mysqli_fetch_assoc($result2);
                    $nom2= $row_etudiant_2['nom_etud'];
                    $prenom2= $row_etudiant_2['prenom_etud'];
                    $cne2= $row_etudiant_2['cne_etud'];
                    $binome= $nom1.' '.$prenom1.'
                    - '.$nom2.' '.$prenom2;                  
                    $query3="select nom_encad, prenom_encad from Encadrant where cin_encad='".$cin_encadrant."'";
                    $result3=  mysqli_query($connect, $query3);
                    $row_enc= mysqli_fetch_assoc($result3);
                    $nom_enc= $row_enc['nom_encad'];
                    $prenom_enc= $row_enc['prenom_encad'];
                    $encadrant=$nom_enc.' '.$prenom_enc;
              ?> 
      <td><div><?php echo utf8_encode($binome); ?></div></td>
      <td> <div class='titre'><?php echo utf8_encode($titre); ?></div></td>
      <td><div><?php echo utf8_encode($encadrant); ?></div></td>
      <td><div><?php echo utf8_encode($prj[$j]); ?></div></td>
      <td><div ><?php echo utf8_encode($nomEse) ; ?></div></td></tr><tr>
      </tbody>
              <?php
            }
              }
                ?>
<td colspan="2"><input type="submit" name="submit" value="Modifier l'Affectation" class="btnSubmit"></td>     
</tr>
</table>
</tbody>
<?php include("footer.php");  ?>
</body>
</html>