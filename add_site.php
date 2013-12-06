<?php 

	include('connexion_SQL.php');
	
	$ville=$_POST['new_site'];
	$date=$_POST['fin_periode'];
	
	
	
	$tabDate = explode('/' , $date);
$date_conv  = $tabDate[2].'-'.$tabDate[1].'-'.$tabDate[0];


	// Vérifie si l'enregistrement existe déjà
	$res = mysql_query("SELECT * FROM ville where nom_ville='$ville'") or die(mysql_error());
	$i= mysql_num_rows($res);
	if($i==0)
	{
	if(isset($_POST['fin_periode'])){
	mysql_query("INSERT INTO ville (nom_ville,date_validite,site_reg) values('$_POST[new_site]','$date_conv','1')");
	echo(" Enregistrement effectué"); 
	echo $date_conv;
	}else{
	mysql_query("INSERT INTO ville (nom_ville) values('$_POST[new_site]')");
	echo(" Enregistrement effectué"); 
	}
	}
	 	
	mysql_close();
	include('admin.php');
	
?>