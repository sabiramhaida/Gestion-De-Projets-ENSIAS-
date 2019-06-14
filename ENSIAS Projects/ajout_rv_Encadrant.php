<?php
session_start();
include("connect_database.php");


$dateo=$_POST['dateo'];
$heureo =$_POST['heureo'];
$travail_a_faireo =$_POST['travail_a_faireo'];
$idd = $_POST['id_sujet_rv'];

if(isset($_POST["ajouterrv"]) && $_POST["ajouterrv"]!="") 

{
 $query= "INSERT INTO Rendez_vous ( date_rv, travail_a_faire, horaire_rv, id_projet ) VALUES ('".$dateo."', '".$travail_a_faireo."', '".$heureo."', '".$idd."')";

 echo $query;
   $result=mysqli_query($connect, $query);

if(!$result){die("");}
  header("Location:Encadrant_rv.php");
}
include("header.php");

?>
<div>
<form method= "POST"  action="ajout_rv_Encadrant.php" name="frmUser">
<table bgcolor="#fff" style="margin-top:25px";>
             <caption> <h1>Ajouter un rendez-Vous:</h1></caption>
            <thead>
                <tr>
                    <th colspan="7">Année: <?php echo date('Y'); ?></th>
                </tr>
                <tr>
                    <th>date</th>
                    <th>heure</th>
                     <th>travail à faire</th>
                </tr>
                </tr>
            </thead>
            <tbody>
                                      <td><input type="date" name="dateo" required  value="<?php echo date('Y-m-d', strtotime(date('Y-m-d')));?>"/><div></td>
                                      <td><input  name='heureo' type="time"  value="9:00:00" ></div></td>
                                      <td><input class='txtField' name='travail_a_faireo'  value="cdc"></div></td>
                                      </tr>
</tbody>
<tr>
</tr>
<thead>
                <tr>
                    <th colspan="7">Pour Quelle projet ?</th>
                </tr>
                 <tr>
                    <th></th>
                    <th>Titre projet</th>
                    <th>Type </th>
                  </tr>
                </thead>
                <tbody>
                  

               <?php
                $query="select id_projet, intitule_sujet,Type_projet from projet where cin_encad='".$_SESSION["cin_encad"] ."'";
                $result=  mysqli_query($connect,$query);
                if(! $result){
                    die("Error in query");
                }
                $count = mysqli_num_rows($result);
                for($i=0; $i<$count; $i++){
                    $row=  mysqli_fetch_assoc($result);
                    $titre=$row['intitule_sujet'];
                    $Type=$row['Type_projet'];
                    $id=$row['id_projet'];
                    $Entreprise=$row['nom_entreprise'];
                    echo utf8_encode( "<td><input type='checkbox' name='id_sujet_rv' value='".$id."'></td>
                                      <td> <div class='titre' name='titreo'  id='titreo'>".$titre."</div></td>
                                      <td><div name='typeo' class='titre' id='typeo' >".$Type."</div></td>
                                      </tr>
                                    <tr>");
                }
                ?>
</tbody>
<tr>
<td colspan="2"><input type="submit" name="ajouterrv" value="Ajouter" class="btnSubmit"></td>
</tr>
</table>
</form>
</div>
</html>
</body>
</html>
