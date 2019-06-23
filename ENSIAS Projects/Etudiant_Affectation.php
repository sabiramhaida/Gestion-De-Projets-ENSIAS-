<?php
include("connect_database.php");

session_start();
if ($_SESSION['login_ok_etud'] == false) { 
header('Location:loginpage.php');
}
include("header_etud.php");

?>

 <table bgcolor="#fff" style="margin-top:10px";>
   
             <caption> <h1>l'Affectation des projets pour l'année <?php echo date('Y') ; ?> :</h1></caption>
<?php  
$prj=['PFA1','PFA2','PFE'];
for($k=0; $k<3; $k++) { 
?>
            <thead>
                <tr>
                    <th colspan="5"> <?php echo $prj[$k] ; ?></th>
                </tr>
                <tr>
                    <th>Binome/Monome</th>
                    <th>Titre</th>
                    <th>Encadrant</th>
                    <th>Type_projet</th>
                    <th>Entreprise</th>
                </tr>
            </thead>
            <tbody>
              <!-- code php pour insirer les donnes-->
               <?php
            // --> Les Projets  PFA1.
                $query="select * from projet where Type_projet='".$prj[$k]."' ";
                $result=  mysqli_query($connect,$query);
                if(! $result){
                    die("Error in query");
                }
                $count = mysqli_num_rows($result);
                for($i=0; $i<$count; $i++){
                    $row=  mysqli_fetch_assoc($result);
                    $titre=$row['intitule_sujet'];
                    $Type=$row['Type_projet'];
                    $code=$row['id_m_b'];
                   $Nom_entreprise=$row['nom_entreprise'];

                    $cin_encadrant=$row['cin_encad'];
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
                    , '.$nom2.' '.$prenom2;                  
                    $query3="select nom_encad, prenom_encad from Encadrant where cin_encad='".$cin_encadrant."'";
                    $result3=  mysqli_query($connect, $query3);
                    $row_enc= mysqli_fetch_assoc($result3);
                    $nom_enc= $row_enc['nom_encad'];
                    $prenom_enc= $row_enc['prenom_encad'];
                    $encadrant=$nom_enc.' '.$prenom_enc;
                    echo utf8_encode("<tr class='pfa1'>");
                    if($cne1==$_SESSION['cne_etud'] || $cne2==$_SESSION['cne_etud']){
                        echo utf8_encode("<td> <div style='color:green; font-weight:bolder'>".$binome."</div></td>");
                    }
                    else{
                        echo utf8_encode("<td><div>".$binome."</div></td>");
                    }
                    echo utf8_encode( "<td> <div class=''>".$titre."</div></td>
                                      <td><div>".$encadrant."</div></td>
                                      <td><div>".$prj[$k]."</div></td>
                                      <td><div class='Entreprise'>".$Nom_entreprise."</div></td>
                                      </tr>
                                    <tr>");
                ?>
            </tbody>   
            <?php 
            } 
        }
             ?>
</table>

</body>
<?php include("footer.php");  ?>
</html>