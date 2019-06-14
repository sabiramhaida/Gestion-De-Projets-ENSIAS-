<?php
session_start();
include("connect_database.php");


$typeo=$_POST['typeo'];
$titreo =$_POST['titreo'];
$descrepo =$_POST['descrepo'];
$cin_encad = $_SESSION['cin_encad'];
$Ese=$_POST['Ese'];
if(isset($_POST["ajouter"]) && $_POST["ajouter"]!="") 
{ if(strtoupper($typeo)=='PFE')
  { 

  $query= "INSERT INTO projet ( intitule_sujet, desciption, Type_projet, cin_encad, nom_entreprise) VALUES ('".$titreo."','".$descrepo."','".$typeo."','".$cin_encad."','".$Ese."')";
  $result=mysqli_query($connect, $query);

  if(!$result){ echo "<SCRIPT LANGUAGE='JavaScript'>confirm('vous devez entrer une Entreprise valide !');</SCRIPT>";}
  else{
    header("location:sujets_Encadrant.php");
  }

 }
 else{

  $query= "INSERT INTO projet ( intitule_sujet, desciption, Type_projet, cin_encad) VALUES ('".$titreo."','".$descrepo."','".$typeo."','".$cin_encad."')";
  $result=mysqli_query($connect, $query);
header("location:sujets_Encadrant.php");
 }
}
include("header.php");

?>
<div>
<form method= "POST"  action="ajout_sujet_Encadrant.php" name="frmUser">
<table bgcolor="#fff" style="margin-top:60px";>
             <caption> <h1>Ajouter un sujet:</h1></caption>
            <thead>
                <tr>
                    <th colspan="7">Année: <?php echo date('Y'); ?></th>
                </tr>
                <tr>
                    <th>Titre</th>
                    <th>Description</th>
                     <th>Type_projet</th>
                    <th>Entreprise</th>
                </tr>
                </tr>
            </thead>
            <tbody>
                                      <td><input class='txtField' name='titreo'  value="titre" required=""></div></td>
                                      <td><input class='txtField' name='descrepo'  value="descr" ></div></td>
                                      <td><input class='txtField' name='typeo'  value="pfa1" required="" ></div></td>
                                      <td><input  class='txtField' name='Ese' value="Entreprise  "></div></td>
                                      </tr>
                                                                         <tr>
</tbody>
<tr>
<td colspan="2"><input type="submit" name="ajouter" value="Ajouter" class="btnSubmit"></td>
</tr>
</table>
</form>
</div>
</html>
<?php include("footer.php");  ?>  
</body>

</html>
