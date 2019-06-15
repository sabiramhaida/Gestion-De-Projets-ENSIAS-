<?php
include("connect_database.php");
session_start();

if ($_SESSION['login_ok_admin'] == false) {  //controler la session pour des raisons de securite
header('Location:loginpage.php');
}


if(isset($_POST["modifierAffectation"]) && $_POST["modifierAffectation"]!="") {
$usersCount = count($_POST["selectedbinome"]);

for($i=0;$i<$usersCount;$i++){
  for($m=$i+1;$m<$usersCount;$m++){
    if($_POST["selectedbinome"][$i]==$_POST["selectedbinome"][$m])
    {
      die("un seul binome pour deux projets !!");
    }
}
}

for($i=0;$i<$usersCount;$i++){

mysqli_query($connect, "UPDATE projet set id_m_b = Null WHERE id_m_b='".$_POST["selectedbinome"][$i]."'");
$res[$i]=mysqli_query($connect, "UPDATE projet set id_m_b ='".$_POST["selectedbinome"][$i]."' WHERE id_projet='" . $_POST["idssujets"][$i] . "'");
}

//pour notifier les Encadrants et les etudiants Que l'Affectation des projets a été Modifié.
$query="select cin_encad from Encadrant";
$result=  mysqli_query($connect,$query);
$count = mysqli_num_rows($result);

for($i=0; $i<$count; $i++){
  $row=  mysqli_fetch_assoc($result);
  $id_encadr_dest=$row['cin_encad'];
  $current_date=date('Y-m-d H:i:s');
  $result77=mysqli_query($connect,"INSERT into Notifications( Nom_destinateur, id_destinataire, Objet , msg_notif,datetime_notif) values ('Administration','".$id_encadr_dest."','Affectation des Projets','l Affectation est Disponible,'".$current_date."')");
}

$query="select cne_etud from Etudiant";
$result=  mysqli_query($connect,$query);
$count = mysqli_num_rows($result);

for($i=0; $i<$count; $i++){
  $row=  mysqli_fetch_assoc($result);
  $id_encadr_dest=$row['cne_etud'];
  $current_date=date('Y-m-d H:i:s');
  mysqli_query($connect,"INSERT into Notifications( Nom_destinateur, id_destinataire, Objet , msg_notif,datetime_notif) values ('Administration','".$id_encadr_dest."','Affectation des Projets','l Affectation est Disponible','".$current_date."')");
}
 header('Location:Admin_Affectation.php');
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
</body>


</html>
<div>
<form method= "POST"  action="edit_Affectation_admin.php" onsubmit="return confirm('Voullez vous vraiment faire ces modifications ?')" >
 <table bgcolor="#fff" style="margin-top:80px";>
<?php 
$prj=["pfa1","pfa2","pfe"];

   for($j=0; $j<3;  $j++){
 ?>
            <caption> <h1>Affectation des projets pour l'année <?php echo date('Y') ; ?> :</h1></caption>
            <thead>
                <tr>
                    <th colspan="6"><?php echo $prj[$j] ; ?></th>
                </tr>
                <tr>
                    <th></th>
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
                    die("Error in qu");
                }
                $count = mysqli_num_rows($result);
                for($i=0; $i<$count; $i++){
                    $row=  mysqli_fetch_assoc($result);
                    $titre=$row['intitule_sujet'];
                    $issujet=$row['id_projet'];
                    $Type=$row['Type_projet'];
                    $code=$row['id_binome'];
                    $cin_encadrant=$row['cin_encad'];
                    $nomEse= $row['nom_entreprise'];
                    $query2="select cne_etud, nom_etud, prenom_etud from etudiant where id_binome='".$code."'";
                    $result2=  mysqli_query($connect, $query2);
                    $row_etudiant_1= mysqli_fetch_assoc($result2);
                    $nom1= $row_etudiant_1['nom_etud'];
                    $prenom1= $row_etudiant_1['prenom_etud'];
                    $cne1= $row_etudiant_1['cne_etud'];
                    $row_etudiant_2= mysqli_fetch_assoc($result2);
                    $nom2= $row_etudiant_2['nom_etud'];
                    $prenom2= $row_etudiant_2['prenom_etud'];
                    $cne2= $row_etudiant_2['cne_etud'];
                    $binome= $nom1.' '.$prenom1.' - '.$nom2.' '.$prenom2;                  
                    $query3="select nom_encad, prenom_encad from Encadrant where cin_encad='".$cin_encadrant."'";
                    $result3=  mysqli_query($connect, $query3);
                    $row_enc= mysqli_fetch_assoc($result3);
                    $nom_enc= $row_enc['nom_encad'];
                    $prenom_enc= $row_enc['prenom_encad'];
                    $encadrant=$nom_enc.' '.$prenom_enc;
                    //liste des binome de premiere annee ............................................
                    $query2all="select cne_etud, nom_etud, prenom_etud from etudiant ";
                    $result2all=  mysqli_query($connect, $query2all);
                    $row_etudiant_1all= mysqli_fetch_assoc($result2all);
                    $nom1all= $row_etudiant_1all['nom_etud'];
                    $prenom1all= $row_etudiant_1all['prenom_etud'];
                    $cne1all= $row_etudiant_1all['cne_etud'];
                    $row_etudiant_2all= mysqli_fetch_assoc($result2all);
                    $binomeall= $nom1all.' '.$prenom1all.' - '.$nom2all.' '.$prenom2all;         
                    $sql = mysqli_query($connect, " SELECT id_m_b FROM monome_binome where id_m_b  order by type Asc ");
                    $countbinome=mysqli_num_rows($sql);
              ?>
      <td><input type='hidden' name='idssujets[]' class='txtField' value="<?php echo $issujet ?>">
      <td>
        <div  class="container "><select id="binome/monome" name="selectedbinome[]">  <?php  
          for($k=0; $k<$countbinome; $k++){
              $rowbinome=mysqli_fetch_assoc($sql);
              $rowbinome=$rowbinome['id_m_b'];
            ?>
              <option value="<?php echo $rowbinome ?>">
              <?php  
              $query2="select cne_etud, nom_etud, prenom_etud from Etudiant where id_m_b='".$rowbinome."'";
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
              echo $binome ;
             }
             ?> 
      </option>
      </select>
      </div>
      </td>
      
      <td> <div class="titre"><?php echo utf8_encode($titre); ?></div></td>
      <td><div><?php echo utf8_encode($encadrant); ?></div></td>
      <td><div><?php echo utf8_encode($Type); ?></div></td>
      <td><div ><?php echo utf8_encode($nomEse) ; ?></div></td></tr><tr>
      </tbody>
              <?php
            }
              }
                ?>
<td colspan="2"><input type="submit" name="modifierAffectation" value="Modifier l'Affectation" class="btnSubmit"></td>     
</tr>
</table>
</tbody>
    <script  src="js/affectation.js"></script>
</body>
</html>