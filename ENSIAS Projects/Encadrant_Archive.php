<?php
session_start();
include("connect_database.php");

if ($_SESSION['login_ok_encad'] == false) { //controler la "session" .
    header('Location:loginpage.php');
  }

include("header.php");
?>
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
              $query="select * from Documentation" ;
               $result=  mysqli_query($connect,$query);
               $count = mysqli_num_rows($result);
               for($i=0; $i<$count; $i++){
                $row=  mysqli_fetch_assoc($result);
                $fichier=$row['Rapport'];
                //$fichier='rap';
                echo utf8_encode( "<td> <div class='titre'>Test0</div></td>
                                      <td><div>rien</div></td>
                                      <td><div>rien</div></td>
                                      <td><div>rien</div></td>
                                    <td><a href=/PFA1_2019_Test/Archive/".$fichier." download ='rapport'>Telecharger</a></td>
                                       </tr>
                                    <tr>
                                    ");     
              }
?>
            </tbody>         
            </table>
            <?php include("footer.php");  ?>

</body>
</html>