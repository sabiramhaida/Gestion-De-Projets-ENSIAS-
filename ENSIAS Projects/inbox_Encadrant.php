
<?php
session_start();
if ($_SESSION['login_ok_encad'] == false) { //controler la "session" .
    header('Location:loginpage.php');
  }

include("connect_database.php"); //connexion a la BDD.
include("header.php");

$sql2="select * from Notifications where id_destinataire='".$_SESSION['cin_encad']."'ORDER BY id_notif desc limit 6";

$sql2="select * from Notifications where id_destinataire='".$_SESSION['cin_encad']."'ORDER BY id_notif desc limit 6";


$result2=mysqli_query($connect, $sql2);
?>
<form method= "POST"  action="Accepter_refuser.php" name="frmUser">
 <table bgcolor="#fff" style="margin-top:60px";>
             <caption> <h1>inbox :</h1></caption>
            <thead>
                <tr>
                    <th colspan="4"></th>
                </tr>
                <tr>
                    <th>De</th>
                    <th>Objet</th>
                    <th>message</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
<?php
$count_notif=mysqli_num_rows($result2);
for($i=0 ;$i<$count_notif;$i++){

	$row=mysqli_fetch_assoc($result2);
	$Nom_dest=$row['Nom_destinateur'];
	$Objet=$row['Objet'];
	$message=$row['msg_notif'];
	$datetime_notif=$row['datetime_notif'];
  $id_dest=$row['id_destinateur'];
  $statut_notif=$row['statut_notif'];
	

//cette if else pour distinguer entre les notifs lues/Non lues...

  if($statut_notif==0)
  {
            $sql4="select max(rv.id_rv) as max_rv, pr.id_m_b as id from Rendez_vous rv, projet pr where pr.id_projet=rv.id_projet and  pr.id_m_b in (select id_m_b from Etudiant where cne_etud='".$id_dest."') ";

            $result4=mysqli_query($connect, $sql4);
            $row4=mysqli_fetch_assoc($result4);
            $max_id_rv=$row4['max_rv'];
            $id_destinataire_m_b=$row4['id'];
            $_SESSION["id_m_b_report_refuser"]=$id_destinataire_m_b; //pour connaitre le id du nv distanataire/the old destinateur..
            ?>
            <td> <div class="titre" name='Nom_destinataire'  id='Nom_destinataire'  style='color: black; font-weight:bolder'><?php echo $Nom_dest; ?></div></td>

            <td> <div class="titre" name='Objet'  id='Objet'  style='color: black; font-weight:bolder'><?php echo $Objet; ?></div></td>

            <?php
          if($Objet!='report de rv'){
              ?>
              <td> <div class="titre" name='message' value  id='message'  style='color: black; font-weight:bolder'><?php echo utf8_encode($message) ; ?></div></td>
              <?php
          }else{
            $sql5="select seconde_horaire, seconde_date,raison_report  from Rendez_vous where id_rv='".$max_id_rv."'";

            $result5=mysqli_query($connect, $sql5);
            $row5=mysqli_fetch_assoc($result5);
            $raison_report=$row5['raison_report'];
            $seconde_date=$row5['seconde_date'];
            $seconde_horaire=$row5['seconde_horaire'];
              ?>

             <td> <div class="titre" name='message_idrv' id='message'  style='color: black; font-weight:bolder'><?php echo utf8_encode($message."jusqu'à  ".$seconde_date."à  ".$seconde_horaire." Car ".$raison_report ); ?></div> <div id="ok">
              <a><input id ="ok"  name ='reponse' value="Accepter" 
              type="submit"></a> <div id="No">
              <a><input id ="No"  name ='reponse' value="Réfuser" type ="submit" ></a>
              </div></td>

           <?php } ?>

            <td><div class="titre" name='datetime_notif'  id='datetime_notif'  style='color: black; font-weight:bolder' ><?php echo $datetime_notif ; ?></div></td><tr></tr>


<?php } else{ ?>

            <td> <div class="titre" name='Nom_destinataire'  id='Nom_destinataire'><?php echo $Nom_dest; ?></div></td>
            <td> <div class="titre" name='Objet'  id='Objet' ><?php echo $Objet; ?></div></td>
            <?php
            $Nom_dest=$row['Nom_destinateur'];

            $sql4="select max(rv.id_rv) as max_rv, pr.id_m_b as id from Rendez_vous rv, projet pr where pr.id_projet=rv.id_projet and  pr.id_m_b in (select id_m_b from Etudiant where cne_etud='".$id_dest."') ";

            $result4=mysqli_query($connect, $sql4);
            $row4=mysqli_fetch_assoc($result4);
            $max_id_rv=$row4['max_rv'];
            $id_destinataire_m_b=$row4['id'];
            $_SESSION["id_m_b_report_refuser"]=$id_destinataire_m_b; //pour connaitre le id du nv distanataire/the old destinateur..
            
            
          if($Objet!='report de rv'){
              ?>
              <td> <div class="titre" name='message' value  id='message'><?php echo utf8_encode($message) ; ?></div></td>
              <?php
          }else{
            $sql5="select seconde_horaire, seconde_date,raison_report  from Rendez_vous where id_rv='".$max_id_rv."'";

            $result5=mysqli_query($connect, $sql5);
            $row5=mysqli_fetch_assoc($result5);
            $raison_report=$row5['raison_report'];
            $seconde_date=$row5['seconde_date'];
            $seconde_horaire=$row5['seconde_horaire'];
              ?>

             <td> <div class="titre" name='message_idrv' id='message'><?php  echo utf8_encode($message."jusqu a "." ".$seconde_date." "."a"." ".$seconde_horaire." "."Car"."  ".$raison_report) ; ?></div> <div id="ok">
              <a><input id ="ok"  name ='reponse' value="Accepter" 
              type="submit"></a> <div id="No">
              <a><input id ="No"  name ='reponse' value="Réfuser" type ="submit" ></a>
              </div></td>

           <?php } ?>

            <td><div class="titre" name='datetime_notif'  id='datetime_notif' ><?php echo $datetime_notif ; ?></div></td><tr></tr>

<?php
}
}
//marquer les notifications 'seen':
$sql="UPDATE Notifications SET statut_notif=1 WHERE  id_destinataire='".$_SESSION['cin_encad']."'";
$result=mysqli_query($connect, $sql);

  ?>
</tbody>
</table>
<?php include("footer.php");?>
</body>
</html>
