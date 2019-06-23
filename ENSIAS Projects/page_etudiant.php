<?php
session_start();
if ($_SESSION['login_ok_etud'] == false) { 
header('Location:loginpage.php');
}

include("connect_database.php");

$query1="select nom_etud, prenom_etud from Etudiant where cne_etud='".$_SESSION["cne_etud"] ."'";
$result1= mysqli_query($connect, $query1);
$row1=  mysqli_fetch_assoc($result1);
$nom_user= $row1['nom_etud'];
$prenom_user= $row1['prenom_etud'];

$query="select id_projet from projet where id_m_b in (select id_m_b from Etudiant where cne_etud='".$_SESSION['cne_etud']."')";
$result=  mysqli_query($connect, $query);
$row=  mysqli_fetch_assoc($result);
$cp= $row['id_projet'];
$_SESSION['c_p']= $cp;
include("header_etud.php")
?>

        <div id="Connexion">
                <img src="Images/Person.png" id="Person_etud">
                <p id="Welcome1">Espace Etudiant</p>
            </div> 
        <div id="Bienvenue">
            <p id="Welcome2">Bienvenue Mr.<?php echo" ".$nom_user." ".$prenom_user.""?>, Heureux de Vous revoir. </p>
        </div> 

    </body>

</body>
<?php include("footer.php");  ?>
</html>

</body>
</html>