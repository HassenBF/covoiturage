<?php 
if(!isset($_SESSION)) 
    { 
        session_start();
		
    } 
	$id_utilisateur = $_SESSION['id_utilisatuer'];
	include('connexion_SQL.php');
	
	$event=$_POST['new_event'];
	
			



	// Vérifie si l'enregistrement existe déjà
	$res = mysql_query("SELECT * FROM evenement where desc_even='$event'") or die(mysql_error());
	$i= mysql_num_rows($res);
	if($i==0)
	{
	
	$query1 = mysql_query("SELECT id_admin FROM admin WHERE id_utilisateur = $id_utilisateur") or die(mysql_error());
	while ($donnees = mysql_fetch_array($query1) ) {
		$id_admin = $donnees['id_admin'];
		echo "id_admin " . $id_admin ;
		mysql_query("INSERT INTO evenement (desc_even,id_admin) values('$_POST[new_event]',$id_admin)");
		
	}
	}
	 		
    mysql_close();
	include('admin.php');
	
?>