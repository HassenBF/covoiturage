<?php 

	include('connexion_SQL.php');
	
	$ville=$_POST['ville_del'];
	mysql_query("DELETE FROM ville WHERE nom_ville = '$ville'");
	
    mysql_close();
	include('admin.php');
        // Déconnection de MySQL
	
	
?>