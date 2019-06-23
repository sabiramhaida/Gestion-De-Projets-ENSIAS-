<?php
session_start();
include("connect_database.php");

if(isset($_POST["submit"]) && $_POST["submit"]!="") {
$usersCount = count($_POST["iddds"]);
for($i=0;$i<$usersCount;$i++) {
mysqli_query($connect, "UPDATE projet set intitule_sujet ='" . $_POST["titreo"][$i] . "', nom_entreprise='". $_POST['Ese'][$i]."', Type_projet='" . $_POST["typeo"][$i] ."' WHERE id_projet='" . $_POST["iddds"][$i] . "'");
//header('Location:sujets_Encadrant.php');
}
header("Location:sujets_Encadrant.php");
}
include("header.php");
?>

<div>
<form method= "POST" onsubmit="return confirm('Voullez vous faire ces modifications ?');" action="edit_sujet_Encadrant.php" name="frmUser">
<table bgcolor="#fff" style="margin-top:60px";>
             <caption> <h1> Editer les sujets choisis</h1></caption>
            <thead>
                <tr>
                    <th colspan="7">Année: <?php echo date('Y'); ?></th>
                </tr>
                <tr>
                    <th></th>
                    <th>Titre</th>
                     <th>Type_projet</th>
                    <th>Entreprise</th>
                    <th> 
                        <i class='material-icons button add' onclick='ajouter()' id='addd'>Ajouter</i></div>
                    </th>
                </tr>
                </tr>
            </thead>
            <tbody>
              <!-- code php pour insirer les donnes-->
<?php
$rowCount = count($_POST["supp"]);
for($i=0;$i<$rowCount;$i++) {
$result = mysqli_query($connect, "SELECT * FROM projet WHERE id_projet='" . $_POST["supp"][$i] . "'");
if(!$result){die("eeeeee");}
$row[$i]= mysqli_fetch_array($result);
                   $titre=$row[$i]['intitule_sujet'];
                    $Type=$row[$i]['Type_projet'];
                    $Desc=$row[$i]['desciption'];
                    $id=$row[$i]['id_projet'];
                    $Entreprise=$row['nom_entreprise'];
                    echo utf8_encode( "<td><input type='hidden' name='iddds[]' class='txtField' value=".$id.">
                                      <td><input class='txtField' name='titreo[]'  value=".$titre."></div></td>
                                      <td><input class='txtField' name='typeo[]'  value=".$Type." ></div></td>
                                      <td><input  class='txtField' name='Ese[]' value=".$Entreprise."></div></td>
                                      </tr>
                                    <tr>");
                }
             ?>  
</tbody>
<tr>
<td colspan="2"><input type="submit" name="submit" value="Enregistrer" class="btnSubmit"></td>
</tr>


</table>
</form>
</div>
</html>

<?php include("footer.php");  ?>

</body>
</html>


