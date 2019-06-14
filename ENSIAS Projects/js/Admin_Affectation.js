// enregistrer les modifications des soutenances
function enregistrer_s(n) {
        var bool= confirm("Attention! Vous pouvez perdre des informations antérieurs.");
        if (bool==true){
            var n_salle= document.getElementById('salle.'+n).innerHTML;
            var n_date= document.getElementById('date.'+n).innerHTML;
            var n_note= document.getElementById('note.'+n).innerHTML;
            document.location="admin_soutenances.php?cmb="+n+"&d="+n_date+"&s="+n_salle+"&n="+n_note;
        }
        else{
            document.reload();
        }
        
}
