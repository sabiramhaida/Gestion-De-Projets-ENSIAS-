<?php
session_start();
include("connect_database.php"); //connexion a la BDD.
include("header_etud.php");

if ($_SESSION['login_ok_etud'] == false) { //controler la "session" .
    header('Location:loginpage.php');
  }


if(isset($_POST["Demander"]) && $_POST["Demander"]!="") {
$result=mysqli_query($connect,"select max(id_rv) as max_id from Rendez_vous where id_projet='".$_SESSION["code_p"]."'" );

$row2=  mysqli_fetch_assoc($result);
$max_idrv=$row2['max_id'];


$result3=mysqli_query($connect,"select intitule_sujet , cin_encad from projet where id_projet='".$_SESSION['code_p']."'" );

$row3=  mysqli_fetch_assoc($result3);
$initule_sujet=$row3['intitule_sujet'];
$cin_encad=$row3['cin_encad'];
  $count=mysqli_num_rows($result3);

$result2=mysqli_query($connect, "UPDATE Rendez_vous set seconde_date ='" .$_POST["dater"]."', seconde_horaire='".$_POST["heurer"]."', raison_report='".utf8_encode($_POST["raison"])."' WHERE id_rv ='".$max_idrv."'");

  $result7=mysqli_query($connect,"select nom_etud, prenom_etud from Etudiant where cne_etud='".$_SESSION['cne_etud']."'" );
  $row=mysqli_fetch_assoc($result7);
  $prenom_destinateur=$row['prenom_etud'];
  $nom_destinateur=$row['nom_etud']." ".$prenom_destinateur;
  $current_date=date('Y-m-d H:i:s');
if($result2){
  $sql2 = "INSERT INTO Notifications ( Nom_destinateur,id_destinateur, id_destinataire, Objet , msg_notif,datetime_notif)  VALUES('".$nom_destinateur."','".$_SESSION['cne_etud']. "','" .$cin_encad."','report de rv','Demande de report de rv pour le projet: $initule_sujet ','".$current_date."')";

  $resulth=mysqli_query($connect, $sql2);

  if($resulth){
    header("Location:Etudiant_rv.php");

}
}
}

?>
<div>
<form method= "POST"  action="demande_report_rv.php" name="frmUser">

<table bgcolor="#fff" style="margin-top:60px";>
             <caption> <h1>Demander Un report de Rendez-vous :</h1></caption>
            <thead>
                <tr>
                    <th colspan="7">Année: <?php echo date('Y'); ?></th>
                </tr>
                <tr>
                    <th>date</th>
                    <th>heure</th>
                </tr>
                </tr>
            </thead>
            <tbody>
                        <td><input type="date" name="dater" required  value="<?php echo date('Y-m-d', strtotime(date('Y-m-d')));?>" required="" ><div></td>
                        <td><input  name='heurer' type="time"  value="9:00" required="" ></div></td>
                              </tr>
</tbody>
<tr>
</tr>
<thead>
                <tr>
                    <th colspan="7">Pour Quelle Raison ?</th>
                </tr>
                 <tr></tr>
                 <th></th>
                 <th></th>
                </thead>
                <tbody>
                	<td><textarea class='txtFieldraison' type="textarea" name='raison'  value="" required="vous devez specifier la raison du report "></textarea></td>
					<td colspan="2"><input type="submit" name="Demander" value="Envoyer La demande" class="btnSubmit"></td></tr>
            	</tbody>
        </div></td></tbody></table></form>
    </div>
 <?php 
 include("footer.php") ?>