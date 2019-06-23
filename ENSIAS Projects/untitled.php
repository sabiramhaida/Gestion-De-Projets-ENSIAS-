<?php
session_start();
if ($_SESSION['login_ok_encad'] == false) { //controler la "session" .
    header('Location:loginpage.php');
  }
include("connect_database.php"); //connexion a la BDD.
 print($_POST["supp"]);
?>
<!DOCTYPE html>
<html lang="Fr">
<html>
    <?php
        if(isset($_GET['n'])) {
            $query="select max(id_projet) from projet";
            $res= mysqli_query($connect, $query);
            $row=  mysqli_fetch_assoc($res);
            $num= $row['max(id_projet)']+1;
            $query3="insert into projet values (".$num.", '1111-11-11', '...Aremplir...', '...A remplir par le binome/monome...', '-', '".$cp."')";
            $result3=mysqli_query($connect, $query3); 
            if(! $result3){
                    die("Error  inserrrrrrrrrrrrrrrrrrrrrrs");
                }
            header("Location: sujets_Encadrant.php?cp=".$cp);
        }
    ?>
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
      <title> Mes Sujets </title>
      <script src="Sujets.js"></script>
      <link rel="stylesheet" href="css/Etudiant_Affectation.css">
      <img src="Images/Logo%20ENSIAS.png" height="100" width="100" id="ENSIAS">
</head>
<body>
  <html>
	<head>
  		<link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,300italic,400italic,600italic,600' rel='stylesheet' type='text/css'>
  		<link rel="Stylesheet" href="css/master.css" type="text/css" />
  		</style>
  		<link rel="Stylesheet" href="https://ianlunn.github.io/Hover/css/hover.css" type="text/css" />
  
  		<link rel="Stylesheet" href='https://fonts.googleapis.com/css?family=Muli' type='text/css'>
	</head>
<body>
  <nav>
    <ul>
      <li><a href="page_encadrant.php">Accueil</a></li>
       <li><a href="Encadrant_Affectation.php">Affectation</a></li>
       <li><a href="#">paramètres</a></li>
       <ul>
          <li><a href="Encadrant_changerMdp.php">changer le mot de passe</a></li>
        </ul>
      <li><a href="#">Mes Projets</a>
        <ul>
          <li><a href="sujets_Encadrant.php">Mes Sujets proposés</a></li>
          <li><a href="Encadrant_rv.php">Rendez-Vous</a></li>
          <li><a href="Encadrant_Soutenance.php ?>">Soutenance</a></li>
        </ul>
      </li>
      <li><a href="Encadrant_Archive.php">Archive</a>
      </li>
      <li><a href="Deconnexion.php">Déconnexion</a></li>
    </ul>
  </nav>
<h4>ENSIAS-projects</h4>
<div>
<form method= "POST" onsubmit="return confirm('Voulez vous faire cette modification ?');" action="supprimer_sujet_encadrant.php" name="formulaire1">
<table bgcolor="#fff" style="margin-top:250px";>
             <caption> <h1>Table d'Affectation:</h1></caption>
            <thead>
                <tr>
                    <th colspan="7">Année: <?php echo date('Y'); ?></th>
                </tr>
                <tr>
                    <th></th>>
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
                    echo utf8_encode( "<td><input type='checkbox' id=check name='supp[]' value='".$id."'></td>
                                      <td> <div class='titre'  contenteditable id='titreo'>".$titre."</div></td>
                                      <td><div contenteditable  id='typeo' >".$Type."</div></td>
                                      <td><div class='Entreprise' contenteditable >".$Entreprise."</div></td>
                                      </tr>
                                    <tr>");
                }                           
                  echo utf8_encode("<td><input type='submit' name='action' value='Delete' class='material-icons button delete' > </td>");
                  echo utf8_encode("<td><input type='submit' name='action' value='save' class='material-icons button save'>
                            </td>");
                ?>
                
            </tbody>   
</table>
</form>
</div>
</html>
</body>
</html>












<?php
    session_start();
    $connect=  mysqli_connect("127.0.0.1", "pfa1", "A-tourists0", "version99"); 
    if($_POST['action']=='Delete'){
    $query='DELETE FROM projet WHERE id_projet IN('. implode(',', array_map('intval', $_POST['supp'])) . ')';
  }
  else{
    if($_POST['action']=='save'){
          $query='';
    }
  }
    $result= mysqli_query($connect, $query);
    header("Location:sujets_Encadrant.php ");
?>
