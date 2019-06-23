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

<table bgcolor="#fff" style="margin-top:50px";>
 <?php
   // --> Les Projets  PFA1.
  $query="select id_projet from projet where cin_encad='".$_SESSION["cin_encad"]."' and Type_Projet ='pfa1'";
  $result0= mysqli_query($connect,$query);
  $count0= mysqli_num_rows($result0);
  // --> Les Projets  PFA2.
  $query2="select id_projet from projet where cin_encad='".$_SESSION["cin_encad"]."' and Type_Projet ='pfa2'";
  $result1= mysqli_query($connect,$query2);
  $count1 = mysqli_num_rows($result1);
  // --> Les Projets  PFE.
  $query3="select id_projet from projet where cin_encad='".$_SESSION["cin_encad"]."' and Type_Projet ='pfe'";
  $result2=mysqli_query($connect,$query3);
  $count2=mysqli_num_rows($result2);

  $result=[$result0,$result1,$result2];
  $count=[$count0,$count1,$count2];

  $id_p[2]=$row[2]['id_projet'];
  $prj=['PFA1','PFA2','PFE'];
for($i=0; $i<3; $i++){
?>
             <caption> <h1>les Statistiques des rendez-vous </h1></caption>

            <thead>
                <tr>
                    <th colspan="7">rv: <?php echo $prj[$i]; ?></th>
                </tr>
                <tr>
                      <th></th>
                    <th>Monome/Binome</th>
                    <th>Titre</th>
                    <th>Rendez-vous programmés </th>
                    <th>Rendez-vous Effectués </th>
                    <th>pourcentage </th>
                </tr>
                </tr>
            </thead>
            <tbody>
              <!-- code php pour insirer les donnes-->
<?php 

                for($j=0; $j<$count[$i]; $j++){
                    $row[$j]=  mysqli_fetch_assoc($result[$i]);
                    $id_p=$row[$j]['id_projet'];
                    $querryy="select count(id_rv) as nbr_prgrm, id_projet from Rendez_vous group by id_projet having id_projet='".$id_p."'";
                    $row11= mysqli_query($connect,$querryy);
                    $temp=mysqli_fetch_assoc($row11);
                    $nbr_prgrm=$temp['nbr_prgrm'];
                    $lastquery="select count(id_rv) as nbr_eff, id_projet,statut_rv from Rendez_vous where statut_rv=1 group by id_projet having id_projet='".$id_p."'";
                    $lastrow= mysqli_query($connect,$lastquery);
                    $lasttemp=mysqli_fetch_assoc($lastrow);
                    $nbr_eff=$lasttemp['nbr_eff'];
                    if(!$nbr_eff){$nbr_eff=0;}
                    $query_b="select nom_etud, prenom_etud from Etudiant where id_m_b in (select id_m_b from projet where id_projet='".$id_p."')";
                    $result_b=  mysqli_query($connect,$query_b);
                    $row_etudiant_1= mysqli_fetch_assoc($result_b);

                    $nom1= $row_etudiant_1['nom_etud'];
                    $prenom1= $row_etudiant_1['prenom_etud'];
                    $row_etudiant_2= mysqli_fetch_assoc($result_b);
                    $nom2= $row_etudiant_2['nom_etud'];
                    $prenom2= $row_etudiant_2['prenom_etud'];
                    $binome_monome= $nom1.' '.$prenom1.'
                      '.$nom2.' '.$prenom2; 

                    $query_titre="select intitule_sujet from projet where id_projet='".$id_p."'";
                    $result_titre=  mysqli_query($connect,$query_titre);
                    $row_titre= mysqli_fetch_assoc($result_titre);
                    $intitule=$row_titre['intitule_sujet'];
                    $pourcentage= ($nbr_eff/$nbr_prgrm)*100;
                    $counttest=mysqli_num_rows($row11);
      if($counttest!=0){
          ?>
            <td><input type='checkbox' name='supprv[]' value='<?php echo $id ?>'></td>
            <td> <div  name='binome_monome'  id='titreo'><?php echo $binome_monome; ?></div></td>
            <td> <div  name='titrprojet'  id='titreo'><?php echo utf8_encode($intitule_sujet); ?></div></td>
            <td> <div  name='daterv'  id='titreo'><?php echo $nbr_prgrm ; ?></div></td>
            <td><div name='heurerv'  id='heurerv' ><?php echo $nbr_eff ; ?></div></td>
            <td> <div  name='tafev'  id='titreo'><?php  echo "".number_format($pourcentage, 2, ',', '')."%"; ?></div></td>
            </tr><tr>
            </tbody>  
              <?php
            }
              }
                }
                ?>
</table>
</form>
</div>
</html>
<?php include("footer.php");  ?>
</body>
</html>

