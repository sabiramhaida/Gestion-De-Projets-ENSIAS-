<?php
session_start();
include("connect_database.php");

if(isset($_POST["submitrv"]) && $_POST["submitrv"]!="") {
$usersCount = count($_POST["idsrv"]);
for($i=0;$i<$usersCount;$i++) {


if($_POST["state"][$i]=='Oui'or $_POST["state"][$i]=="oui"){
  $_POST["state"][$i]=1;
 }
 else
 {
  $_POST["state"][$i]=0;
 }


mysqli_query($connect, "UPDATE Rendez_vous set date_rv ='" . $_POST["dateo"][$i] . "', horaire_rv='" . $_POST["heureo"][$i] . "', travail_a_faire='" . $_POST["taf"][$i] ."',statut_rv='".$_POST["state"][$i]."' WHERE id_rv='" . $_POST["idsrv"][$i] ."'");
header("Location:Encadrant_rv.php");
}

}
include("header.php");

?>

<form method= "POST" onsubmit="return confirm('Voullez vous faire ces modifications ?');" action="edit_rv_Encadrant.php" name="frmUser">
<table bgcolor="#fff" style="margin-top:60px";>
             <caption> <h1></h1></caption>
            <thead>
                <tr>
                    <th colspan="6">Année: <?php echo date('Y'); ?></th>
                </tr>
                <tr>
                  <th></th>
                  <th>titre de projet</th>
                    <th>date</th>
                    <th>heure</th>
                     <th>travail à faire</th>
                    <th> Effectué ?</th>
                </tr>
                </tr>
            </thead>
            <tbody>
              <!-- code php pour insirer les donnes-->
<?php

$rowCount = count($_POST["supprv"]);
for($i=0;$i<$rowCount;$i++) {
$result = mysqli_query($connect, "SELECT * FROM Rendez_vous WHERE id_rv='" . $_POST["supprv"][$i] . "'");
$result2 = mysqli_query($connect, "SELECT intitule_sujet FROM projet WHERE id_projet in ( select id_projet from Rendez_vous where id_rv='".$_POST["supprv"][$i]."')");
$row[$i]= mysqli_fetch_array($result);
$row2=mysqli_fetch_array($result2);
                    $id=$row[$i]['id_rv'];
                    $date=$row[$i]['date_rv'];
                    $t_a_f=$row[$i]['travail_a_faire'];
                    $heure=$row[$i]['horaire_rv'];
                    $statut_rv=$row[$i]['statut_rv'];
                    $titre_projet_rv=$row2['intitule_sujet'];
                    ?> 
      <td><input type='hidden' name='idsrv[]' value="<?php echo $id; ?>">
      <td> <div  name='titre_p_rv' class="titre"><?php echo  $titre_projet_rv; ?></div></td>
      <td><input  type="date" classe="date" name="dateo[]" required value="<?php echo date($date, strtotime(date('Y-m-d')));?>" required="" ><div></td>
      <td><input  type="time" name="heureo[]"  classe="heure" required="" value=<?php echo $heure; ?>></div></td>
      <td> <input  name='taf[]'   value=<?php echo $t_a_f ; ?> ></div></td>
      <td><input  name='state[]'  class='effectue' value= "<?php if ($statut_rv==0) {echo("Non");} else{ echo("Oui");} ?>"></div></td>
      </tr>
       <tr>
</tbody>
<?php 
}
?>
<tr>
<td colspan="2"><input type="submit" name="submitrv" value="Enregistrer" class="btnSubmit"></td>
</tr>
</table>
</form>
</div>
</html>
<?php include("footer.php");  ?>

</body>
</html>