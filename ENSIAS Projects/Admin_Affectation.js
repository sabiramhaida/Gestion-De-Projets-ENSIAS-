function projetDistribution(var idProjet, var monBin){
	$.ajax({
		source: 'affecterProjet.php',
		data: {'projetid='+idProjet+'&mnBn'+monBin}
	})
}