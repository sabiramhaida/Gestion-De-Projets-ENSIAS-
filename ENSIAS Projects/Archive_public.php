<?php
include("connect_database.php");
?>

<!--DOCTYPE html-->
<html>
    <header>
          <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" type="text/css" href="css/stylesheet_tables.css">
        <title> ENSIAS PROJECTS</title>
        <div id="Logos">
            <img src="Images/ENSIAS.png" id="ENSIAS">
            <a href="index.html" ><img src="Images/EP.png" id="EP"></a>
            <img src="Images/um5.png" id="um5">
        </div>
    </header>
    <body>  
  <table bgcolor="#fff" style="margin-top:50px";>
             <caption> <h1>Archive des rapport:</h1></caption>
            <thead>
                <tr>
                    <th colspan="5">Année: <?php echo date('Y'); ?></th>
                </tr>
                <tr>
                    <th>Titre</th>
                    <th>Etudiant</th>
                    <th>Année</th>
                    <th>Type</th>
                    <th>fichier</th>
                </tr>
            </thead>
            <tbody>
              <!-- code php pour insirer les donnes a partir de la BDD
                :   Test0 -->
              <?php
              // -->Archive
                $query="select * from Documentation";

               $result=  mysqli_query($connect,$query);
               $count = mysqli_num_rows($result);
               for($i=0; $i<$count; $i++){
                $row=  mysqli_fetch_assoc($result);
                $fichier=$row['Rapport'];
                $id_projet=$row['id_projet'];
                $resultp=  mysqli_query($connect,"select *from projet where id_projet='".$id_projet."'");
                $rowp= mysqli_fetch_assoc($resultp);

                $intitule_sujet=$rowp['intitule_sujet'];
                $Type_projet=$rowp['Type_projet'];
                $annee_projet=$rowp['annee_projet'];

                $resultbino_monom= mysqli_query($connect,"select nom_etud, prenom_etud from Etudiant where id_m_b='".$rowp['id_m_b']."'");
                $rowEtud1= mysqli_fetch_assoc($resultbino_monom);
                $nom11=$rowEtud1['nom_etud'];
                $nom12=$rowEtud1['prenom_etud'];
                $rowEtud2= mysqli_fetch_assoc($resultbino_monom);
                $nom21=$rowEtud2['nom_etud'];
                $nom22=$rowEtud2['prenom_etud'];
                $nom=$nom11." ".$nom12." - ".$nom21." ".$nom22;
                ?>
                <td> <div class='titre'><?php echo $intitule_sujet ;?></div></td>
                <td><div> <?php echo $nom ;?></div> </td>
                <td><div><?php echo $annee_projet ;?></div></td>
                <td><div><?php echo $Type_projet ;?></div></td>
                <td><a href=/PFA1_2019_Test/Archive/<?php echo $fichier; ?> download ='rapport_<?php echo $fichier; ?>'>Telecharger</a></td>
                </tr><tr>
<?php   
              }
?>
            </tbody>         
       
            </table>
<?php include("footer.php");  ?>
</body>
</html>