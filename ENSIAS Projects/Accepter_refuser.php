<?php
session_start();
if ($_SESSION['login_ok_encad'] == false) { //controler la "session" .
    header('Location:loginpage.php');
  }
include("connect_database.php"); //connexion a la BDD.
$current_date=date('Y-m-d H:i:s');


//######################################################################################################

if($_POST["reponse"]=='Accepter')//---------------------Si l'encadrant a refusé la demande---------------------------------
{ 
	$result=mysqli_query($connect,"select nom_encad, prenom_encad from Encadrant where cin_encad='".$_SESSION['cin_encad']."'" );
	$row=mysqli_fetch_assoc($result);
	$prenom_destinateur=$row['prenom_encad'];
	$nom_destinateur=$row['nom_encad']." ".$prenom_destinateur;
	$result1=mysqli_query($connect,"select cne_etud from Etudiant where id_m_b='".$_SESSION["id_m_b_report_refuser"]."'");
	$row1=mysqli_fetch_assoc($result1);
	$id_destinataire1=$row1['cne_etud'];
	$row2=mysqli_fetch_assoc($result1);
	$id_destinataire2=$row2['cne_etud'];
	

	//----------------------------------Update du rv ---------------------------------------------------------
	//chercher le rv qu'e l'encadrant a accepté de le reporter.
	$sqlget_id_rv="select max(id_rv) as id_accept_report from projet pr join Rendez_vous rv on pr.id_projet where pr.id_m_b='".$_SESSION["id_m_b_report_refuser"]."'";
	$resultget_id_rv=mysqli_query($connect,$sqlget_id_rv);
	$rowget_id_rv=mysqli_fetch_assoc($resultget_id_rv);
	$id_accept_report=$rowget_id_rv['id_accept_report'];

	//extraire le nv date, l'heure du rendez-vous.
	$sql="select seconde_horaire, seconde_date from Rendez_vous where id_rv='".$id_accept_report."'";
	$result=mysqli_query($connect,$sql);
	$row=mysqli_fetch_assoc($result);

	$seconde_horaire=$row['seconde_horaire'];
	$seconde_date=$row['seconde_date'];
	//update rv ...

	$sqlupdate="UPDATE `Rendez_vous` SET `date_rv` = '".$seconde_date."', `horaire_rv` = '".$seconde_horaire."', `raison_report` = NULL, `seconde_horaire` = NULL, `seconde_date` = NULL where `Rendez_vous`.`id_rv` = '".$id_accept_report."'";

	mysqli_query($connect,$sqlupdate);
	//pour  informormer l'encadrant qu'ila bien accepter la demande+ l'empecher a re envoyer une nouvelle notif aux etudiants.
	$resultget_id_notif=mysqli_query($connect,"select max(id_notif) as id_notif from Notifications where(id_destinateur='".$id_destinataire1."' or id_destinateur='".$id_destinataire2."')");
	$rowget_id_notif=mysqli_fetch_assoc($resultget_id_notif);
	$id_notif=$rowget_id_notif['id_notif'];

	mysqli_query($connect, "UPDATE Notifications set Objet='report rv (Acceptée)' where id_notif='".$id_notif."'");

	//------------------------------Notifier le Binomemonome--------------------------------------------------------

	//notifier les deux etudiant que leurs demande a été Accepter.
	$sql="INSERT into Notifications( Nom_destinateur,id_destinateur, id_destinataire, Objet , msg_notif,datetime_notif) values ('".$nom_destinateur."','".$_SESSION['cin_encad']."','".$id_destinataire1."','report de rv','votre demande pour reporter le rv à été Accepter','".$current_date."')";
	mysqli_query($connect,$sql);

	$sql="INSERT into Notifications(Nom_destinateur,id_destinateur, id_destinataire, Objet , msg_notif,datetime_notif) values ('".$nom_destinateur."','".$_SESSION['cin_encad']."','".$id_destinataire2."','report de rv','votre demande pour reporter le rv à été Accepter','".$current_date."')";
	mysqli_query($connect,$sql);
	header("location:inbox_Encadrant.php");
}




//###############################################################################################################################

if($_POST["reponse"]=='Réfuser')//---------------------Si l'encadrant a réfusé la demande---------------------------------
{	 {
		// sinon, si l'encadrant a réfusé la demande on va  informer le bino/mono qu'il a réfusé leurs demande de report .

	$result=mysqli_query($connect,"select nom_encad, prenom_encad from Encadrant where cin_encad='".$_SESSION['cin_encad']."'" );
	$row=mysqli_fetch_assoc($result);
	$prenom_destinateur=$row['prenom_encad'];
	$nom_destinateur=$row['nom_encad']." ".$prenom_destinateur;
	$result1=mysqli_query($connect,"select cne_etud from Etudiant where id_m_b='".$_SESSION["id_m_b_report_refuser"]."'");

	$row1=mysqli_fetch_assoc($result1);
	$id_destinataire1=$row1['cne_etud'];

	//pour  informormer l'encadrant qu'ila bien accepter la demande+ l'empecher a re envoyer une nouvelle notif aux etudiants.

	$resultget_id_notif=mysqli_query($connect,"select max(id_notif) as id_notif from Notifications where(id_destinateur='".$id_destinataire1."' or id_destinateur='".$id_destinataire2."')");
	$rowget_id_notif=mysqli_fetch_assoc($resultget_id_notif);
	$id_notif=$rowget_id_notif['id_notif'];

	mysqli_query($connect, "UPDATE Notifications set Objet='report rv (Réfusée)' where id_notif='".$id_notif."'");

	//-------------------------------Notifier le Binome/monome---------------------------------------------------

	//notifier les deux etudiant que leurs demande a été Accepter.
	$sql="INSERT into Notifications( Nom_destinateur,id_destinateur, id_destinataire, Objet , msg_notif,datetime_notif) values ('".$nom_destinateur."','".$_SESSION['cin_encad']."','".$id_destinataire1."','report de rv','votre demande pour reporter le rv à été réfusée','".$current_date."')";

	mysqli_query($connect,$sql);

	$row2=mysqli_fetch_assoc($result1);
	$id_destinataire2=$row2['cne_etud'];

	$sql="INSERT into Notifications( Nom_destinateur,id_destinateur, id_destinataire, Objet , msg_notif,datetime_notif) values ('".$nom_destinateur."','".$_SESSION['cin_encad']."','".$id_destinataire2."','report de rv','votre demande pour reporter le rv à été refusée','".$current_date."')";
	mysqli_query($connect,$sql);

	header("location:inbox_Encadrant.php");
	}
}

