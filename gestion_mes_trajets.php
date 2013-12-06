 
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
 // session_start();
	echo "</br></br>";	
	echo "Vos trajet : "; 
	echo $_SESSION['pseudo'];
	// $id_utilisateur= $_SESSION['id_utilisatuer'];
	echo"</BR></BR>";
	echo "<a href=\"index.php?add_trajet\" class='styled-button-122'>Saisir un nouveau trajet</a>";
	
	echo "</br></br></br>";

	
		
	include('connexion_SQL.php');
	$cond = mysql_query("SELECT * FROM conducteur WHERE id_utilisateur = '$id_utilisateur'") or die(mysql_error());
	while ($conducteur = mysql_fetch_array($cond) ){
		$id_cond = $conducteur['id_conducteur'];
	}
	
	// echo " id conducteur $id_cond";

	
	
	$reponse = mysql_query("SELECT * FROM trajet WHERE id_conducteur=$id_cond AND STR_TO_DATE( date_trajet,  '%d/%m/%Y' ) >= NOW( ) ORDER BY STR_TO_DATE( date_trajet,  '%d/%m/%Y' ) asc") or die(mysql_error());
	$i=mysql_num_rows($reponse);
	
	
	if ($i == 0) {
		echo "Pas de trajet enregistré"; 
		echo "</br></br>";
	}
	
	else {
	   
	?>

	<table class="tablezied"  cellspacing="0" style="margin: 0px;"  >
      <tr><th>Ville de depart</th><th>Ville d'arrivee</th><th>Heure de depart </th><th>Type et date de trajet</th><th>Nombre de places</th><th>nombre de reservations au trajet</th><th>Lieu de départ</th><th>Vos commentaires</th><th>Modifier</th><th>Supprimer </th></tr><!-- Table Header -->

	<?php	
	$i=0;
		while ($donnees = mysql_fetch_array($reponse) ) {
			$num_trajet=$donnees['num_trajet'];
			$ville1=$donnees['ville_depart'];
			$ville2=$donnees['ville_arrivee'];
			$heure=$donnees['heure'];
			$nbr_places=$donnees['nbr_place_dispo'];
			$lieu_rdv=$donnees['id_lieu_rdv'];
			$commentaire=$donnees['coment'];
			if($donnees['trajet_reg']==1){
				$type_trajet="trajet régulier";
			}else{
				$type_trajet="trajet ponctuel";
			}
			$date_trajet=$donnees['date_trajet'];
			
			$query = mysql_query("SELECT * FROM participant WHERE num_trajet='$num_trajet' ") or die(mysql_error());
			$nbr_places_resv = mysql_num_rows($query);
		
			 if ($i % 2 == 0){echo "<TR>";}else{echo "<TR class='even'>";}		
			echo "<TD><div align=\"center\"> $ville1 </div></TD>";
			echo "<TD><div align=\"center\"> $ville2 </div></TD>";
			echo "<TD><div align=\"center\"> $heure </div></TD>";
			
			echo "<TD><div align=\"center\"> $type_trajet";
			
				echo ": ".$date_trajet;
			
			echo "</div></TD>";
			echo "<TD><div align=\"center\"> $nbr_places </div></TD>";
			echo "</div></TD>";
			echo "<TD><div align=\"center\"> $nbr_places_resv </div></TD>";
			echo "</div></TD>";
			echo "<TD><div align=\"center\"> $lieu_rdv </div></TD>";
			echo "</div></TD>";
			echo "<TD><div align=\"center\"> $commentaire </div></TD>";
			
			
			echo "<TD><div align=\"center\"><a href =\"index.php?add_trajet&modif=1&num_trajet=$num_trajet\"><img src='images/adminicons/edit.png' width='24' height='24' border='0'></a></div></TD>";	
			echo "<TD><div align=\"center\"><a href =\"index.php?supprimer_trajet&num_trajet=$num_trajet\" onclick=\"return(confirm('Etes-vous sûr de vouloir supprimer ce trajet?'));\"><img src='images/adminicons/delete.png' width='24' height='24' border='0'></a></div></TD>";
			echo "</TR>";
			
	
		}
		echo "</table>";
	}	

		


?>






