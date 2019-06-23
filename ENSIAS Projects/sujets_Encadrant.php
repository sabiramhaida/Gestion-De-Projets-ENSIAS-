<?php
session_start();
if ($_SESSION['login_ok_encad'] == false) { //controler la "session" .
    header('Location:loginpage.php');
  }
include("connect_database.php"); //connexion a la BDD.
 print($_POST["supp"]);
include("header.php");

?>
<div>
<form method= "POST"  action="" name="frmUser">
<table bgcolor="#fff" style="margin-top:60px";>
             <caption> <h1>Sujets proposés:</h1></caption>
            <thead>
                <tr>
                    <th colspan="7">Année: <?php echo date('Y'); ?></th>
                </tr>
                <tr>
                    <th></th>
                    <th>monome/binome</th>
                    <th>Titre</th>
                     <th>Type projet</th>
                    <th>Entreprise</th>
                    <th> 
                        <input name='action' type='button' value=' Ajouter' class='material-icons button add' onclick='setAddAction("ajout_sujet_Encadrant.php");'>
                    </th>
                </tr>
                </tr>
            </thead>
            <tbody>
              <!-- code php pour insirer les donnes-->
               <?php
            // --> Les Projets  PFA1.
                $query="select id_projet, intitule_sujet, desciption, nom_entreprise,Type_projet from projet where cin_encad='".$_SESSION["cin_encad"] ."'";
                $result=  mysqli_query($connect,$query);
                if(! $result){
                    die("Error in query");
                }
                $count = mysqli_num_rows($result);
                for($i=0; $i<$count; $i++){
                    $row=  mysqli_fetch_assoc($result);
                    $titre=$row['intitule_sujet'];
                    $Type=$row['Type_projet'];
                    $Desc=$row['desciption'];
                    $id=$row['id_projet'];
                    $Entreprise=$row['nom_entreprise'];
                    $query2="select id_m_b from projet where id_projet='".$id."'";
                    $result2=  mysqli_query($connect,$query2);
                    $row2=  mysqli_fetch_assoc($result2);
                    $code=$row2['id_m_b'];
                    $query3="select cne_etud, nom_etud, prenom_etud from Etudiant where id_m_b='".$code."'";
                    $result3=  mysqli_query($connect, $query3);
                    $row_etudiant_1= mysqli_fetch_assoc($result3);
                    $nom1= $row_etudiant_1['nom_etud'];
                    $prenom1= $row_etudiant_1['prenom_etud'];
                    $cne1= $row_etudiant_1['cne_etud'];
                    $row_etudiant_2= mysqli_fetch_assoc($result3);
                    $nom2= $row_etudiant_2['nom_etud'];
                    $prenom2= $row_etudiant_2['prenom_etud'];
                    $cne2= $row_etudiant_2['cne_etud'];
                    $binome= $nom1.' '.$prenom1.'
                    - '.$nom2.' '.$prenom2;      
                    echo utf8_encode( "<td><input type='checkbox' name='supp[]' value='".$id."'></td>
                                    <td> <div class='titre' name='titreo'  id='titreo'>".$binome."</div></td>
                                      <td> <div class='titre' name='titreo'  id='titreo'>".$titre."</div></td>
                                      <td><div name='typeo'  id='typeo' >".$Type."</div></td>
                                      <td><div name='Ese' class='Entreprise'  >".$Entreprise."</div></td>
                                      </tr>
                                    <tr>");
                }
                ?>
            <td><input name='action' type='button' value=' Supprimer' class='material-icons button add' onclick='setDeleteAction("supprimer_sujet_encadrant.php");'> </td>
            <td><input name='action' type='button' value=' Modifier' class='material-icons button add' onclick='setUpdateAction("edit_sujet_Encadrant.php");'> </td>
            </tbody>   
</table>
</form>
</div>
</html>
<?php include("footer.php");  ?>
</body>
</html>
