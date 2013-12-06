<?php 

	include('connexion_SQL.php');
	
	$events=$_POST['ville_del'];
	mysql_query("DELETE FROM evenement WHERE desc_even='$events'");
	echo"Suppression réussie";
	
    mysql_close();
	include('admin.php');
    // Déconnection de MySQL	
	
?>