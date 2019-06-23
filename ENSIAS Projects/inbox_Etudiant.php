<?php
session_start();
if ($_SESSION['login_ok_etud'] == false) { //controler la "session" .
    header('Location:loginpage.php');
  }

include("connect_database.php"); //connexion a la BDD.
include("header_etud.php");

$sql2="select * from Notifications where id_destinataire='".$_SESSION['cne_etud']."'ORDER BY id_notif DESC limit 6";

$result2=mysqli_query($connect, $sql2);
?>
 <table bgcolor="#fff" style="margin-top:60px";>
             <caption> <h1>inbox :</h1></caption>
            <thead>
                <tr>
                    <th colspan="4"></th>
                </tr>
                <tr>
                    <th>De </th>
                    <th>Objet</th>
                    <th>message</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
<?php
$count_notif=mysqli_num_rows($result2);
echo $count_notif;
for($i=0 ;$i<$count_notif;$i++){
	$row=mysqli_fetch_assoc($result2);
	$Nom_dest=$row['Nom_destinateur'];
	$Objet=$row['Objet'];
	$message=$row['msg_notif'];
	$datetime_notif=$row['datetime_notif'];
    $statut_notif=$row['statut_notif'];

    if($statut_notif==0){ ?>
            <td> <div class="titre" name='Nom_destinataire'  id='Nom_destinataire' style='color: black; font-weight:bolder'><?php echo $Nom_dest;?></div></td>
            <td> <div class="titre" name='Objet'  id='Objet' style='color:black; font-weight:bolder'><?php echo $Objet; ?></div></td>
            <td> <div class="titre" name='message'  id='message' style='color:black; font-weight:bolder'><?php echo $message ; ?></div></td>
            <td><div class="titre" name='datetime_notif'  id='datetime_notif' style='color:black; font-weight:bolder' ><?php echo $datetime_notif ; ?></div></td><tr></tr>
        <?php }

        else{?>
			<td> <div class="titre" name='Nom_destinataire'  id='Nom_destinataire'><?php echo $Nom_dest; ?></div></td>
            <td> <div class="titre" name='Objet'  id='Objet'><?php echo $Objet; ?></div></td>
            <td> <div class="titre" name='message'  id='message'><?php echo $message ; ?></div></td>
            <td><div class="titre" name='datetime_notif'  id='datetime_notif' ><?php echo $datetime_notif ; ?></div></td><tr></tr>
<?php
                }
$sql="UPDATE Notifications SET statut_notif=1 WHERE  id_destinataire='".$_SESSION['cne_etud']."'";
 mysqli_query($connect, $sql);

}
  ?>
</tbody>
</table>
<?php
include("footer.php");  ?>
</body>
</html>
