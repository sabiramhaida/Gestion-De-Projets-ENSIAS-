<?php
session_start();
if ($_SESSION['login_ok_encad'] == false) { //controler la "session" .
    header('Location:loginpage.php');
  }
include("connect_database.php"); //connexion a la BDD.
include("header.php");
?>

<div>
<form method= "POST"  action="" name="frmUser">
<table bgcolor="#fff" style="margin-top:50px">
 <?php
            // --> Les Projets  PFA1.
  $query="select id_projet from projet where cin_encad='".$_SESSION["cin_encad"]."' and Type_Projet ='pfa1'";
  $result0= mysqli_query($connect,$query);
  $count0= mysqli_num_rows($result0);

  $query2="select id_projet from projet where cin_encad='".$_SESSION["cin_encad"]."' and Type_Projet ='pfa2'";
  $result1= mysqli_query($connect,$query2);
  $count1 = mysqli_num_rows($result1);

  $query3="select id_projet from projet where cin_encad='".$_SESSION["cin_encad"]."' and Type_Projet ='pfe'";
  $result2=mysqli_query($connect,$query3);
  $count2=mysqli_num_rows($result2);

  $result=[$result0,$result1,$result2];
  $count=[$count0,$count1,$count2];

  $prj=['PFA1','PFA2','PFE'];
  
  for($i=0; $i<3; $i++){
?>
             <caption> <h1>les 2 derniers Rendez-Vous programmés pour chaque projet </h1>
              <div id="ok">
              <a id ="ok" href="rv_statistique_Encadrant.php">pour voir les statistiques des rendez-vous cliquer ici</a>
              </div>
             </caption>

            <thead>
                <tr>
                    <th colspan="8" classe="<?php echo $prj[$i]; ?>">rv: <?php echo $prj[$i]; ?></th>
                </tr>
                <tr>
                      <th></th>
                    <th>Monome/Binome</th>
                    <th>Titre</th>
                    <th>date</th>
                    <th>heure</th>
                     <th>travail à faire</th>
                    <th>Compte rendu</th>
                    <th> Effectué ? </th>
                </tr>
                </tr>
            </thead>
            <tbody>
              <!-- code php pour insirer les donnes-->
<?php 

                for($j=0; $j<$count[$i]; $j++){
                    $row[$j]=  mysqli_fetch_assoc($result[$i]);
                    $id_p=$row[$j]['id_projet'];
                    $querryy="select id_rv from Rendez_vous where id_projet='".$id_p."' order by id_rv desc limit 2 ";
                    $row11= mysqli_query($connect,$querryy);
                    $counttest=mysqli_num_rows($row11);
                  
                  for($k=0; $k<$counttest; $k++){
                    $temp=mysqli_fetch_assoc($row11);
                    $id_rv=$temp['id_rv'];
                    $lastquery="select *from Rendez_vous where id_rv='".$id_rv."'";
                    $lastrow= mysqli_query($connect,$lastquery);
                    $lasttemp=mysqli_fetch_assoc($lastrow);
                    $id=$lasttemp['id_rv'];
                    $date=$lasttemp['date_rv'];
                    $t_a_f=$lasttemp['travail_a_faire'];
                    $heure=$lasttemp['horaire_rv'];
                    $status_rv=$lasttemp['statut_rv'];
                    $compte_rendu=$lasttemp['chemin_compte_rendu'];
                    $query_b="select nom_etud, prenom_etud from Etudiant where id_m_b in (select id_m_b from projet where id_projet='".$id_p."')";
                    $result_b=  mysqli_query($connect,$query_b);
                    $row_etudiant_1= mysqli_fetch_assoc($result_b);

                    $nom1= $row_etudiant_1['nom_etud'];
                    $prenom1= $row_etudiant_1['prenom_etud'];
                    $row_etudiant_2= mysqli_fetch_assoc($result_b);
                    $nom2= $row_etudiant_2['nom_etud'];
                    $prenom2= $row_etudiant_2['prenom_etud'];
                    $binome_monome= $nom1.' '.$prenom1.'-
                      '.$nom2.' '.$prenom2; 

                    $query_titre="select intitule_sujet from projet where id_projet='".$id_p."'";
                    $result_titre=  mysqli_query($connect,$query_titre);
                    $row_titre= mysqli_fetch_assoc($result_titre);
                    $intitule=$row_titre['intitule_sujet'];

                    $counttest=mysqli_num_rows($row11);
      //if($counttest!=0){
          ?>
            <td><input type='checkbox' name='supprv[]' value='<?php echo $id_rv ?>'></td>
            <td> <div  name='binome_monome'  id='titre'><?php echo $binome_monome; ?></div></td>
            <td> <div  name='titrprojet'  id='titre'><?php echo  utf8_encode($intitule); ?></div></td>
            <td> <div  name='daterv'  id='titre'><?php echo $date ; ?></div></td>
            <td><div name='heurerv'  id='heurer' ><?php echo utf8_encode($heure)  ; ?></div></td>
            <td> <div  name='tafev'  id='titre'><?php  echo $t_a_f ; ?></div></td>
            <?php if(($compte_rendu)&&($compte_rendu!="")) { ?>
            <td><a href=/PFA1_2019_Test/CR/<?php echo $compte_rendu ?> download ='CR'>Telecharger</a>
            </td>
            <?php } else {?>
                <td><a>Pas disponible</a>
                  <?php
            }
            ?>
               <td> <div  name='state'  id='titreo'><?php if($status_rv==0) {echo "Non " ;}
               else { echo " Oui " ;} ?></div></td></tr><tr>    </tbody>  
              <?php
            //}
            }
              }
                }
                ?>
            <td></td>
            <td><input name='action' type='button' value=' Supprimer' class='material-icons button add' onclick='setDeleteAction("supprimer_rv_encadrant.php");'> </td>
            
            <td><input name='action' type='button' value=' Modifier' class='material-icons button add' onclick='setUpdateAction("edit_rv_Encadrant.php");'> </td>
            <td> 
            <input name='action' type='button' value=' Ajouter' class='material-icons button add' onclick='setAddAction("ajout_rv_Encadrant.php");'>
            </td>
</table>
</form>
</div>
<?php include("footer.php");  ?>
</html>
</body>
</html>
