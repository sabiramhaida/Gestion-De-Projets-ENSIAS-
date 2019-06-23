<?php
include("connect_database.php");

session_start();
if ($_SESSION['login_ok_encad'] == false) { 
header('Location:loginpage.php');
}
include("header.php");
?>
<table bgcolor="#fff" style="margin-top:50px";>
             <caption> <h1>Table d'Affectation:</h1></caption>
            <thead>
                <tr>
                    <th colspan="5">Année: <?php echo date('Y'); ?></th>
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
                $query="select * from projet order by Type_projet desc ";
                
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
                    $cin_encadrant=$row['cin_encad'];
                    $Nom_entreprise=$row['nom_entreprise'];

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
                    $cin_enc= $row_enc['cin_encad'];
                    $encadrant=$nom_enc.' '.$prenom_enc;
                    echo utf8_encode("<tr class='pfa1'>");
                    echo utf8_encode("<td><div>".$binome."</div></td>
                                      <td> <div class='titre'>".$titre."</div></td>");
                                     
                    if($cin_encadrant==$_SESSION['cin_encad']){
                        echo utf8_encode("<td> <div style='color:green; font-weight:bolder'>".$encadrant."</div></td>");
                    }
                    else{
                    echo utf8_encode("<td><div>".$encadrant."</div></td>");
                    }

                    echo utf8_encode("<td><div>".strtoupper($Type)."</div></td>
                                      <td><div class='Entreprise'>".$Nom_entreprise."</div></td>
                                      </tr>
                                    <tr>");
                }
                ?>
            </tbody>         
        </table>

<?php include("footer.php");  ?>

</body>

</html>


