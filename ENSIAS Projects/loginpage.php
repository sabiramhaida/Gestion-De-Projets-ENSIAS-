<?php
session_start(); 
include("connect_database.php");
$_SESSION['login_ok_etud'] == false;
$_SESSION['login_ok_encad'] == false;
$_SESSION['login_ok_Ese'] == false;
$_SESSION['login_ok_admin'] == false;
$_SESSION['login_ok_jury'] == false;

if (isset($_POST['submit']))
     {
        $username= $_POST["identifiant"];
        $password= $_POST["mot_de_passe"];
        $query="select nom_encad from Encadrant where cin_encad='".$username."' and mdp_encad='".$password."'";
        $result1=  mysqli_query($connect, $query);
        $count1 = mysqli_num_rows($result1);
        if ($count1==1){
            $_SESSION['login_ok_encad'] = true;
            $_SESSION["cin_encad"] = $username;
            $_SESSION["mdp_encad"] = $password;
            header('Location: page_encadrant.php');
        }
        else
        {
            $query="select nom_etud  from Etudiant where cne_etud='" . $username . "' and mdp_etud='". $password ."'";
            $result2=  mysqli_query($connect, $query);
            $count2 = mysqli_num_rows($result2);
            if ($count2==1){
                $_SESSION['login_ok_etud'] = true;
                $_SESSION["cne_etud"] = $username;
                $_SESSION["mdp_etud"] = $password;
                header('Location: page_etudiant.php');    
            }
            else 
            {
                if($username=='admin' && $password=='admin'){
                $_SESSION['login_ok_admin'] = true;
                header('Location: page_admin.php'); }
                else
                {
                    $query="select nom_entreprise  from Entreprise where nom_entreprise='" . $username . "' and mdp_Ese='". $password ."'";
                    $result3=  mysqli_query($connect, $query);
                    $count3 = mysqli_num_rows($result3);
                    if ($count3==1){
                        $_SESSION['login_ok_Ese'] = true;
                        $_SESSION["Nom_entreprise"] = $username;
                        $_SESSION["mdp_Ese"] = $password;
                        header('Location: page_Ese.php');}
                        else
                {
                        $query="select cin_jury, mdp_jury from Jury where cin_jury='" . $username . "' and mdp_jury='". $password ."'";
                        $result3=  mysqli_query($connect, $query);
                        $count3 = mysqli_num_rows($result3);
                        if ($count3==1){
                            $_SESSION['login_ok_jury'] = true;
                            $_SESSION["cin_jury"] = $username;
                            $_SESSION["mdp_jury"] = $password;
                            header('Location: page_jury.php');}
                            else{echo "</br> <h4> mot de passe ou identifiant incorrect..!!!</h4>";}
                }
            }
        }
    }
}

?>

<!--DOCTYPE html-->
<html>
    <header>
        <link rel="stylesheet" type="text/css" href="css/stylesheet.css">
        <title> ENSIAS PROJECTS</title>
        <div id="Logos">
            <a href="index.html" ><img src="Images/ENSIAS.png" id="ENSIAS"></a>
            <img src="Images/EP.png" id="EP">
            <img src="Images/um5.png" id="um5">
        </div>
    </header>
    <body>
        <div id="Conn">
            <div id="Archive">
                <h2 id="SeConn">Se Connecter</h2>
                <form id="Login" method="POST">
                    <input type="text" id="identifiant" placeholder="Identifiant" name="identifiant">
                    <br><br>
                    <input type="password" id="Pswd" placeholder="Mot de Passe" name="mot_de_passe">
                <a><input type="submit" name="submit" value="Connexion" id="button"></a>    
                </form>          
            </div>
        </div>
        
    </body>
</html>
