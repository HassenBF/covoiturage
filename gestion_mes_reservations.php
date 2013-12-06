
<style type="text/css">
.styled-button-122 {
	-webkit-box-shadow:rgba(0,0,0,0.2) 0 1px 0 0;
	-moz-box-shadow:rgba(0,0,0,0.2) 0 1px 0 0;
	box-shadow:rgba(0,0,0,0.2) 0 1px 0 0;
	border-bottom-color:#333;
	border:1px solid #61c4ea;
	background-color:#7cceee;
	border-radius:5px;
	-moz-border-radius:5px;
	-webkit-border-radius:5px;
	color:#333;
	font-family:'Verdana',Arial,sans-serif;
	font-size:14px;
	text-shadow:#b2e2f5 0 1px 0;
	padding:5px;
	 cursor: pointer;
	 float:left;
	 width:250px;
}
.styled-button-122:hover{
background-color:#7ddeee;
}
</style>
  


<?php

	echo "</br></br>";	
	echo "Vos réservations : "; 
	echo $_SESSION['pseudo'];
	
	echo "</br></br></br>";
	
	
		
	include('connexion_SQL.php');
	$query = mysql_query("select * from participant where id_utilisateur=$id_utilisateur") or die(mysql_error());
	$j = mysql_num_rows($query);

	if ($j == 0) {
		echo "Vous n'avez aucune réservation"; 
		echo "</br></br>";
	
	}else {
	$participant = mysql_fetch_array($query);	
	$id_participant=$participant['id_participant'];
	   
	?>

	<table class="tablezied"  cellspacing="0" style="margin: 0px;"  >
      <tr><th>Ville de depart</th><th>Ville d'arrivee</th><th>Heure de depart </th><th>date du trajet </th><th>voir les détails </th><th>Supprimer </th></tr><!-- Table Header -->

	<?php	
	$i=0;
		$query2 = mysql_query("select * from participant INNER JOIN trajet ON participant.num_trajet = trajet.num_trajet where participant.id_utilisateur=$id_utilisateur") or die(mysql_error());
	
		while ($donnees = mysql_fetch_array($query2) ) {
			$num_participant=$donnees['id_participant'];
			$num_trajet=$donnees['num_trajet'];
			$ville1=$donnees['ville_depart'];
			$ville2=$donnees['ville_arrivee'];
			$heure=$donnees['heure'];
			//$type_trajet=$donnees['type_trajet'];
			$date_trajet=$donnees['date_trajet'];

		
			if ($i % 2 == 0){echo "<TR>";}else{echo "<TR class='even'>";}		
			echo "<TD><div align=\"center\"> $ville1 </div></TD>";
			echo "<TD><div align=\"center\"> $ville2 </div></TD>";
			echo "<TD><div align=\"center\"> $heure </div></TD>";
			
			echo "<TD><div align=\"center\"> $date_trajet";
			
			echo "<TD><div align=\"center\"><a <a href=\"index.php?detail_projet&num_trajet=$num_trajet\" > Voir les details</a></div></TD>";
			echo "<TD><div align=\"center\"><a href =\"index.php?supprimer_reservation&num_reservation=$num_participant\" onclick=\"return(confirm('Etes-vous sur de vouloir supprimer cette reservation?'));\"><img src='images/adminicons/delete.png' width='24' height='24' border='0'></a></div></TD>";
			echo "</TR>";
			
	
		}
		echo "</table>";
	}	

		


?>






