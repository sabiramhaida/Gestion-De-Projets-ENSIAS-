if(isset($_POST['suppr'])){//si le bouton submit est cliqué et que $_POST['suppr'] est reconnu
    $Suppr="";
    foreach($_POST['suppr'] as $ids){
        mysqli_query($mysqli,"DELETE FROM membres WHERE id='".$ids."'");//pensez à sécuriser la variable $ids pour éviter une éventuelle injection SQL
        $Suppr.="$ids ";//on les sauvegardes dans la variable $Suppr pour afficher ce qui à été supprimé
    }
    echo "ID supprimés: $Suppr";
}
$req=mysqli_query($mysqli,"SELECT * FROM membres");//on sélectionne notre table, "membres" pour l'exemple
     
    // Pour faire des tests et ajouter des membres à votre table, vous pouvez lancer un code comme:
    //for($i=1;$i<=10;$i++){
    //  mysqli_query($mysqli,"INSERT INTO membres SET pseudo='Pseudo$i',mdp='test'");//ajoutera 10 nouvelles entrées dans la table membres
    //}
     
echo '<form action="" method="post">';//début de notre formulaire, pensez à renseigner le "action" par votre page où ce trouve ce script
//on affiche tous les membres avec leur propre case à cocher pour faire le choix de la suppression
while($info=mysqli_fetch_assoc($req)){
    echo '<input type="checkbox" name="suppr[]" value="'.$info['id'].'"/> Membre ID '.$info['id'].'';
}
echo '<input type="submit"/>';//bouton de validation
echo '</form>';//fin de notre formulaire