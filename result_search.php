<?php	
	include('connexion_SQL.php');
	$cond = mysql_query("SELECT * FROM conducteur WHERE id_utilisateur = '$id_utilisateur'") or die(mysql_error());
	while ($conducteur = mysql_fetch_array($cond) ){
		$id_cond = $conducteur['id_conducteur'];
	}
	
	$ville1="" ;
	$ville2="" ;
	$date="";
	$heure="tous" ;
	
	if(isset($_POST['ville1'])){$ville1=mysql_real_escape_string(htmlspecialchars($_POST['ville1']));}
	if(isset($_POST['ville2'])){$ville2=mysql_real_escape_string(htmlspecialchars($_POST['ville2']));}
	if(isset($_POST['date_trajet'])){$date=mysql_real_escape_string(htmlspecialchars($_POST['date_trajet']));}
	if(isset($_POST['heure'])){	$heure=mysql_real_escape_string(htmlspecialchars($_POST['heure']));}

	
?>
		

<?php

	if ($heure =="tous") {
		
		$heure1="00:00";
		$heure2="24:00";
	}else {
		$heure_ex = explode(":", $heure);

		if ($heure_ex[0] != "00") {$h1=$heure_ex[0]-1;} else {$h1=$heure_ex[0];} 
		if($heure_ex[0] < 11 AND $heure_ex[0] != "00") { $h1="0".$h1; } 
			 
		$h2=$heure_ex[0]+1;
		if($heure_ex[0] < 9) { $h2="0".$h2; } 


		if ($heure_ex[1] == 30){ $heure1=$heure_ex[0].":00"; $heure2=$h2.":00";}
		else{ $heure1=$h1.":30"; $heure2=$heure_ex[0].":30";}

	}
	
	if( isset($_POST['soumettre']) AND $_POST['soumettre'] == "Rechercher"){
	$query1 = "SELECT * FROM trajet WHERE STR_TO_DATE( date_trajet,  '%d/%m/%Y' ) >= NOW( ) AND id_conducteur NOT IN (SELECT id_conducteur FROM conducteur WHERE id_conducteur=$id_utilisateur) AND ville_depart ='$ville1'";
	if(!empty($ville2))
		$query1 .= " AND ville_arrivee = '$ville2'";
	if(!empty($date))
		$query1 .= " AND date_trajet = '$date'";
	if(!empty($heure))
		$query1 .= " AND heure between '$heure1' and '$heure2'";
	
	$result = mysql_query($query1)or die(mysql_error());
	$j=mysql_num_rows($result);
	
	
	if ($j == 0) {
		echo "&nbsp;Désolé;, aucun trajet ne correspond a votre recherche"; 
		echo "</br></br>";
		
	}else {
		
		echo "<BR>";
		echo "Il y a <strong>".$j." trajet(s)</strong> correspondants entre ".$heure1." et ".$heure2;
		

?>
	
	
	
	
	<table class="tablezied"  cellspacing="0"  >
      <tr><th>Ville de depart</th><th>Ville d'arrivee</th><th>Date de depart </th><th>Heure de depart </th><th>Nombre de places restantes </th><th>Voir les details </th></tr><!-- Table Header -->

		
	<?php
	$i=0;			
				
				while ($trajet = mysql_fetch_array($result) )
				{
				$num_T=$trajet['num_trajet'];
				$ident=$trajet['id_conducteur'];
				$ville_depart=$trajet['ville_depart'];
				$ville_arrivee=$trajet['ville_arrivee'];
				$heure=$trajet['heure'];
				$places_dsipo=$trajet['nbr_place_dispo'];
				$date_trajet=$trajet['date_trajet'];
				$id_lieu_depart = $trajet['id_lieu_rdv'];
				$type_trajet=$trajet['trajet_reg'];
				
				$query2 = mysql_query("SELECT * FROM lieu_rdv WHERE id_lieu_rdv='$id_lieu_depart'") or die(mysql_error());
				while ($lieu_rdv = mysql_fetch_array($query2) ){
					$lieu_rdv = $lieu_rdv['lieu_rdv'];
				}
				$query3 = mysql_query("SELECT * FROM participant WHERE num_trajet='$num_T'") or die(mysql_error());
				$places_rest = $places_dsipo - mysql_num_rows($query3);
								
					 if ($i % 2 == 0){echo "<TR>";}else{echo "<TR class='even'>";}									
				echo "<TR>";
				echo "<TD> $ville_depart </TD>";
				echo "<TD> $ville_arrivee </TD>";
				echo "<TD> $date_trajet </TD>";
				echo "<TD> $heure  </TD>";
				echo "<TD> $places_rest </TD>";
								
				/*echo "<TD> $type_trajet";
				if ($type_trajet == "ponctuel") {
					$type_trajet;
				}
				echo " </TD>";*/
				
				echo "<TD>  <a href=\"index.php?detail_projet&num_trajet=$num_T\" > Voir les details</a></TD>";
				echo "</TR>";
				$i++;
				}
				echo "</table>";
	}
				
		mysql_close();

		?>
		
		
		<BR><hR>
		<?php if ($ville1 <> "" OR $ville2<> "") { ?>	
		<strong>&nbsp;&nbsp;Resultats sur les autres sites de covoiturage :</strong>
		
		
	
	<BR><BR>
	&nbsp;<a href="http://www.123envoiture.com/recherche-resultats.php?recherche=rapide&ville_depart=<?php echo$ville1; ?>&ville_arrivee=<?php echo$ville2; ?>&status=tous"TARGET="_blank">123envoiture</a>
	
	
	<?php if ($ville1 <> "" AND $ville2<> "") { ?>
	<BR><BR>	
	&nbsp;<a href="http://www.easycovoiturage.com/covoiturage/covoiturage_page/page.php?source=index&adr_from=<?php echo$ville1; ?>&elarg_dep=0&adr_to=<?php echo$ville2; ?>&elarg_arr=0&conpass=CP&date_trajet=jj/mm/aaaa%20&date_elarg=0"TARGET="_blank">Easy Covoiturage</a>
	<?php } ?>
	
	<BR><BR>	
	<form name='recherche' action="http://www.tribu-covoiturage.com/recherche.php" method="POST">
	<input type="hidden" value="<?php echo$ville1; ?>" name="DVille" id="DVille" >
	<input type="hidden" value="<?php echo$ville2; ?>" name="AVille" id="AVille" >
	&nbsp;<a href="#" onclick="document.recherche.submit();">Tribu covoiturage</a>
	</form> 

	<?php } 
	
	}?>