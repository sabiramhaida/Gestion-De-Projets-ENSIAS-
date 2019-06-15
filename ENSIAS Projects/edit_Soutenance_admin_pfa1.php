<?php
include("connect_database.php");

session_start();
if ($_SESSION['login_ok_admin'] == false) {  //controler la session pour des raisons de securite
header('Location:loginpage.php');
}


if(isset($_POST["Enregister"]) && $_POST["Enregister"]!="") {
        $salle=$_POST["selectsalle"];
        $date=$_POST["selectdate"];
        $Heure=$_POST["selectHeure"];
        $Jury=$_POST["selectJury"];

        $query="select *from projet where Type_projet='pfa1'";
        $result=  mysqli_query($connect,$query);
        $count = mysqli_num_rows($result);
//contraintes de la soutenance ................
        for($s=0; $s<$count; $s++){
            for($y=0; $y<$count; $y++)
            {
                if(($date[$s]==$date[$y]) && ($Heure[$s]==$Heure[$y]) && $y!=$s)
                {
                    if($salle[$s]==$salle[$y]){
                        die("la salle ".$salle[$s]."ne peux pas contenir deux Soutenance en meme temps");    
                        header("location: edit_Soutenance_admin_pfa1.php");
                        }
                    if($Jury[$s]==$Jury[$y]){
                        die("le jury ".$Jury[$s]."ne peux pas assister deux Soutenance en meme temps");
                        header("location: edit_Soutenance_admin_pfa1.php");
                        }
                }
            }
            }
//sinon on fait l'insertion...
for($s=0; $s<$count; $s++){
    $rowp=mysqli_fetch_assoc($result);
    $id_projet_sout=$rowp['id_projet'];
    echo $id_projet_sout ;
    mysqli_query($connect,"DELETE from soutenance where id_projet='".$id_projet_sout."'"); 
    mysqli_query($connect,"INSERT into soutenance values(NULL,'". $date[$s]."','".$Heure[$s]."','".$id_projet_sout."','".$salle[$s]."')");
    echo ("INSERT into soutenance values( NULL,'". $date[$s]."','".$Heure[$s]."','".$id_projet_sout."','".$salle[$s]."')");
    mysqli_query($connect,"UPDATE projet set cin_jury='".$Jury[$s]."' where id_projet='".$id_projet_sout."'");
    header("location: Admin_Soutenance.php");
}

}
?>

<html>
    <header>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" type="text/css" href="css/stylesheet_tables.css">
        <title> Admin</title>
         <script src="Sujets.js"></script>

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
<form method= "POST"  action="edit_Soutenance_admin_pfa1.php" name="frmUser" id="frmUser" >
<table bgcolor="#fff" style="margin-top:5px";>
             <caption> <h1>Plannification des Soutenances  des PFA1 des pour l'année  <?php echo date('Y'); ?> :</h1></caption>
            <thead>
                <tr>
                    <th colspan="9">Année: <?php echo date('Y'); ?></th>
                </tr>
                <tr>
                    <th>Binome/Monome</th>
                    <th>Titre</th>
                    <th>Encadrant</th>
                    <th>Type_projet</th>
                    <th>Jury</th>
                    <th>Date</th>
                    <th>Heure</th>
                    <th>Salle</th>
                </tr>
            </thead>
            <tbody>
              <!-- code php pour insirer les donnes-->
                    <?php
              // --> planning des Soutenance.
               $query="select *from projet where Type_projet='pfa1'";
               $result=  mysqli_query($connect,$query);

               $count = mysqli_num_rows($result);
               for($i=0; $i<$count; $i++){
                $row2=  mysqli_fetch_assoc($result);
                $titre_projet=$row2['intitule_sujet'];
                $id_m_b_projet=$row2['id_m_b'];
                $Type_projet_s=$row2['Type_projet'];
                $code_projet_s=$row2['id_projet'];

                $query55="select cin_encad,cin_jury from projet where id_projet='".$code_projet_s."'";
                $result55 =mysqli_query($connect,$query55);
                $row_cin_=mysqli_fetch_assoc($result55);
                $code_encad_s=$row_cin_['cin_encad'];
                $code_jury_s=$row_cin_['cin_jury'];


                $query66="select *from Encadrant where cin_encad= '".$code_encad_s."'";
                $result66=mysqli_query($connect,$query66);
                $row_encad=mysqli_fetch_assoc($result66);
                $nom_encad_s=$row_encad['nom_encad'];
                $prenom_encad_s=$row_encad['prenom_encad'];
                $cin_encad_s=$row_encad['cin_encad'];


                $query88 = "select *from Jury where cin_jury ='".$code_jury_s."'";

                $result88=mysqli_query($connect,$query88);

                $row_jury=mysqli_fetch_assoc($result88);
                $nom_jury_s=$row_jury['nom_jury'];
                $prenom_jury_s=$row_jury['prenom_jury'];
                
                $nom_complete_encad=$nom_encad_s." ".$prenom_encad_s;
                $nom_complete_jury=$nom_jury_s." ".$prenom_jury_s;
           

                $query3="select nom_etud, prenom_etud, cne_etud from Etudiant where id_m_b=".$id_m_b_projet."";
                $result3=  mysqli_query($connect,$query3);
                $row3=  mysqli_fetch_assoc($result3);
                $nom_etud1=$row3['nom_etud'];
                $prenom_etud1=$row3['prenom_etud'];
                $cne1=$row3['cne_etud'];
                $nom_complete_etud1=$nom_etud1.' '.$prenom_etud1;
                $row4=  mysqli_fetch_assoc($result3);
                $nom_etud2=$row4['nom_etud'];
                $prenom_etud2=$row4['prenom_etud'];
                $cne2=$row4['cne_etud'];
                $nom_complete_etud2=$nom_etud2.' '.$prenom_etud2;
                $Binome=$nom_complete_etud1.' ,'.$nom_complete_etud2;
?>

                <tr class='pfa1'>                
                <td><div> <?php echo utf8_encode($Binome) ; ?></div></td>
                <td><div> <?php echo utf8_encode($titre_projet) ; ?></div></td>
                <td><div><?php echo utf8_encode($nom_complete_encad) ;?></div></td>
                <td><div><?php echo utf8_encode($Type_projet_s); ?></div></td>
                <td><div  class="container "><select id="titreForSout" name="selectJury[]"><option value="">..choix Jury..</option>  <?php  

          
                $sql = mysqli_query($connect, " SELECT * FROM Jury where cin_jury ");
                $countJury=mysqli_num_rows($sql);
            for($k=0; $k<$countJury; $k++){
                $rowJury=mysqli_fetch_assoc($sql);
                $Jury=$rowJury['nom_jury']." ".$rowJury['prenom_jury'];
                $code_jury_s=$rowJury['cin_jury'];
                ?>
                <option value="<?php echo $code_jury_s ?>">
                <?php                   
                echo $Jury ;
             }
             ?> 
      </option>
      </select>
      </div>
      </td> 
                <td><div><input type="date" name="selectdate[]" id="titreForSout" required=""></div></td>
                <td><div  class="container "><select id="titreForSout" name="selectHeure[]">
                    <option value="9:00">9:00</option>
                    <option value="9:30">9:30</option> 
                    <option value="10:00">10:00</option> 
                    <option value="10:30">10:30</option> 
                    <option value="11:00">11:00</option> 
                    <option value="11:30">11:30</option> 
                    <option value="12:00">12:00</option>
                    <option value="14:00">14:00</option>
                    <option value="14:30">14:30</option> 
                    <option value="15:00">15:00</option> 
                    <option value="15:30">15:30</option>
                    <option value="15:30">15:30</option> 
                    <option value="16:30">16:30</option> 
                    <option value="17:00">17:00</option> 
                     </select>
                <td><div  class="container "><select id="" name="selectsalle[]"><option value="">..choixsalle..</option>  <?php 
                $sql = mysqli_query($connect, " SELECT * FROM `salle_soutenance` ");
                $countsalle=mysqli_num_rows($sql);
            for($k=0; $k<$countsalle; $k++){
                $rowsalle=mysqli_fetch_assoc($sql);
                $salle=$rowsalle['num_salle'];
                ?>
                <option value="<?php echo $salle ?>">
                <?php                   
                echo $salle ;
             }
             ?> 
      </option>
      </select>
      </div>
      </td>
               </tr><tr>
                <?php  
                }




                ?>
                <td colspan="2"><input type="submit" name="Enregister" value="Enregister" class="btnSubmit"></td>     


            </tbody>         
            </table>

</body>
<?php  include("footer.php") ?>
</html>