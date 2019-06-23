<?php
include("connect_database.php");

session_start();
if ($_SESSION['login_ok_jury'] == false) { 
header('Location:loginpage.php');
}
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

    </body>


  <table bgcolor="#fff" style="margin-top:60px";>
             <caption> <h1>Planning des Soutenances:</h1></caption>
            <thead>
                <tr>
                    <th colspan="8">Année: <?php echo date('Y'); ?></th>
                </tr>
                <tr>
                    <th>Binome/Monome</th>
                    <th>Encadrant</th>
                    <th>Type_projet</th>
                    <th>Jury</th>
                    <th>Date</th>
                    <th>heure </th>
                    <th>Salle</th>
                    <th>Note</th>
                </tr>
            </thead>
            <tbody>
              <!-- code php pour insirer les donnes-->
              <?php
              // --> planning des Soutenance.
               $query="select *from soutenance";
               $result=  mysqli_query($connect,$query);

               $count = mysqli_num_rows($result);
               for($i=0; $i<$count; $i++){
                $row=  mysqli_fetch_assoc($result);
                $date_s=$row['date_soutenance'];
                $note_s=$row['note'];
                $code_proj=$row['id_projet'];
                $heure_s=$row['horaire_soutenance'];
                $salle_s=$row['num_salle'];

                $query55="select cin_encad,cin_jury from projet where id_projet=".$code_proj."";
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

                $queryyy="select * from projet where  id_projet='".$code_proj."'";
                $resultt=  mysqli_query($connect,$queryyy);
                $row2=  mysqli_fetch_assoc($resultt);
                $titre_projet=$row2['intitule_sujet'];
                $id_m_b_projet=$row2['id_m_b'];
                $Type_projet_s=$row2['Type_projet'];

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
                
                echo utf8_encode("<tr class='pfa1'>");
                echo utf8_encode("<td><div>".$Binome."</div></td>");
                echo utf8_encode("<td><div>".$nom_complete_encad."</div></td>");
                echo utf8_encode("<td><div>".$Type_projet_s."</div></td>");
                if($code_jury_s==$_SESSION['cin_jury']){
                        echo utf8_encode("<td><div style='font-weight: bolder; color:green'>".$nom_complete_jury."</div></td>");
                    }

                else{
                      echo utf8_encode("<td><div>".$nom_complete_jury."</div></td>");
                    }
                 echo utf8_encode("<td><div>".$date_s."</div></td>
                            <td><div>". $heure_s."</div></td>
                            <td><div>".$salle_s."</div></td>
                            <td><div>".$note_s."</div></td>
                            </tr>
                           <tr>");
                
                }                ?>

            </tbody>         
            </table>
        <?php include("footer.php");  ?>
</body>
</html>