

<?php
session_start();

if ($_SESSION['login_ok_etud'] == false) { //controler la "session" .
    header('Location:loginpage.php');
  }
include("connect_database.php"); //connexion a la BDD.
include("header_etud.php");
?>

<div>
<form method= "POST"  action="" name="frmUser" enctype="multipart/form-data">
<table bgcolor="#fff" style="margin-top:50px";>

             <caption> <h1> les 2 derniers Rendez-vous programmés pour votre projet:</h1></caption>
            <thead>
                <tr>
                    <th colspan="8">Rendez-Vous : <?php echo $prj[$i]; ?></th>
                </tr>
                <tr>
                    <th>date</th>
                    <th>heure</th>
                    <th>Effectué ?</th>
                    <th>travail à faire</th>
                    <th>Compte rendu</th>
                    <th>deposer un Compte rendu</th>
                </tr>
                </tr>
            </thead>
            <tbody>
              <!-- code php pour insirer les donnes-->
<?php 
  $query="select id_projet from projet where id_m_b in (select id_m_b from Etudiant where cne_etud='".$_SESSION['cne_etud']."')";
$result=mysqli_query($connect,$query);
$counttest=mysqli_num_rows ($result);
                    $row=  mysqli_fetch_assoc($result);
                    $id_p=$row['id_projet'];
                    $_SESSION["code_p"]=$id_p;
                    $lastquery="select * from Rendez_vous where id_projet='".$id_p."' order by id_rv desc limit 2" ;
                    $lastrow= mysqli_query($connect,$lastquery);
                    $counttest=mysqli_num_rows($lastrow);
                    for($k=0; $k<$counttest; $k++){
                    $lasttemp=mysqli_fetch_assoc($lastrow);
                    $id=$lasttemp['id_rv'];
                    $date=$lasttemp['date_rv'];
                    $t_a_f=$lasttemp['travail_a_faire'];
                    $heure=$lasttemp['horaire_rv'];
                    $compte_rendu=$lasttemp['chemin_compte_rendu'];
                    $status_rv=$lasttemp['statut_rv'];
          ?>
            <td> <div  name='daterv'  id='titreo'><?php echo $date ; ?></div></td>
            <td><div name='heurerv'  id='heurerv' ><?php echo $heure ; ?></div></td>
            <td> <div  name='state'  id='titreo'><?php if($status_rv==0) {echo "Non " ;}
               else { echo " Oui " ;} ?></div></td>
            <td> <div  name='tafev'  id='titreo'><?php  echo utf8_encode($t_a_f) ; ?></div></td>

            <?php 
            if(($compte_rendu)&&($compte_rendu!="")) { ?>

            <td><a href=/PFA1_2019_Test/CR/<?php echo $compte_rendu ?> download ="<?php echo " ".$compte_rendu ;?>">Telecharger</a></td>

            <?php 
            }else{
                ?>
                <td>pas disponible</td>
            <?php   
            }
            if($status_rv==1)
            {
            ?>
            <td><input type="file" name="uploaded"></td></tr><tr>

            <?php
            $_SESSION["fileToUp"]=$id;
            }
            else{ ?></tr><tr>
            <?php
            }
            }
            ?>
            </tbody>
            <td><input name='action' type='button' value='demander un report' class='material-icons button add' onclick='setReporeterAction("demande_report_rv.php");'> </td>

            <td><input name='action' type='button' value='upload' class='material-icons button add' onclick='setAddAction("uploadfile.php");'> </td></table>
</form>
</div>
</html>
<?php include("footer.php"); ?>
</body>
<script src="Sujets.js"></script>
</html>