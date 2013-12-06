<?php



if ($_SESSION['loginOK'] == true) {

	include('connexion_SQL.php');
	
	
	/*
	$query = mysql_query("SELECT * FROM trajet WHERE num_trajet='$num'") or die(mysql_error());

	//on verifie l'identitée du créateur de la fiche :
	while ($donnees = mysql_fetch_array($reponse) ) {
		$id_trajet=$donnees['ID'];
	}*/
	
	if(isset($_GET['num_reservation']) and !empty($_GET['num_reservation'])){
		$num=$_GET['num_reservation'];
		mysql_query("DELETE FROM participant WHERE id_participant='$num'") or die (mysql_error());
		echo "</BR>";
		echo "<h3 style='color:green'>Réservation supprimée avec succès !</h3>";
	}
}else {
	echo "Merci de vous indentifier pour accéder à cette page";
}

mysql_close();


?>
