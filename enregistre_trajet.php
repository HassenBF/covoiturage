
<?php

if(!isset($_SESSION)) { 
        session_start();
} 
	$username  = $_SESSION['pseudo'];
	$id_utilisateur = $_SESSION['id_utilisatuer'];	
	if(isset($_GET['modif'])){$modif=$_GET['modif'];}else{$modif="";}
	if(isset($_POST['id_trajet'])){$id_trajet=$_POST['id_trajet'];}else{$id_trajet="";}

	
		
	$username = $_SESSION['pseudo'];
	
	include('connexion_SQL.php');
	
	$ville1=mysql_real_escape_string(htmlspecialchars($_POST['ville1']));
	$ville2=mysql_real_escape_string(htmlspecialchars($_POST['ville2']));
	$date_trajet=mysql_real_escape_string(htmlspecialchars($_POST['date_trajet']));
	$heure=mysql_real_escape_string(htmlspecialchars($_POST['heure']));
	$nbr_places = mysql_real_escape_string(htmlspecialchars($_POST['nbr_places']));
	$coment=nl2br(mysql_real_escape_string(htmlspecialchars($_POST['coment'])));
	if(isset($_POST['heure_retour']) and !empty($_POST['heure_retour']) and isset($_POST['date_trajet_retour']) and !empty($_POST['date_trajet_retour'])and isset($_POST['nbr_places_retour']) and !empty($_POST['nbr_places_retour'])){
		$heure_retour=mysql_real_escape_string(htmlspecialchars($_POST['heure_retour']));
		$date_trajet_retour=mysql_real_escape_string(htmlspecialchars($_POST['date_trajet_retour']));
		$nbr_places_retour = mysql_real_escape_string(htmlspecialchars($_POST['nbr_places_retour']));
		$coment_retour=nl2br(mysql_real_escape_string(htmlspecialchars($_POST['coment_retour'])));
	}
	
	if(isset ($_POST['lieu_rdv']) and !empty($_POST['lieu_rdv']) and $_POST['lieu_rdv'] != "autre"){
		$lieu_rdv = mysql_real_escape_string(htmlspecialchars($_POST['lieu_rdv']));
		/*$query = mysql_query ("SELECT * FROM lieu_rdv WHERE id_lieu_rdv = $lieu_r");
		while ($reponse = mysql_fetch_array($query) ) {
			$lieu_rdv= $reponse['lieu_rdv'];
		} */
		
	}else if(isset ($_POST['lieu_rdv_autre']) and !empty($_POST['lieu_rdv_autre'])){
		$lieu_r = mysql_real_escape_string(htmlspecialchars($_POST['lieu_rdv_autre']));
		mysql_query ("INSERT INTO lieu_rdv (lieu_rdv) VALUES ('$lieu_r') ") or die(mysql_error());
		$lieu_rdv = mysql_insert_id();
	}else{
		$lieu_rdv="";
	}
	if(isset ($_POST['trajet_reg']) and !empty($_POST['trajet_reg'])){
		$trajet_reg = mysql_real_escape_string(htmlspecialchars($_POST['trajet_reg']));
	}else{
		$trajet_reg=0;
	}
	
	if(isset ($_POST['lieu_rdv_retour']) and !empty($_POST['lieu_rdv_retour']) and $_POST['lieu_rdv_retour'] != "autre"){
		$lieu_rdv_retour = mysql_real_escape_string(htmlspecialchars($_POST['lieu_rdv_retour']));
		/*$query_retour = mysql_query ("SELECT * FROM lieu_rdv WHERE id_lieu_rdv = $lieu_r_retour");
		while ($reponse_retour = mysql_fetch_array($query_retour) ) {
			$lieu_rdv_retour= $reponse_retour['lieu_rdv'];
		} 
		*/
	}else if(isset ($_POST['lieu_rdv_retour_autre']) and !empty($_POST['lieu_rdv_retour_autre'])){
		$lieu_rdv_retour = mysql_real_escape_string(htmlspecialchars($_POST['lieu_rdv_retour_autre']));
	}else{
		$lieu_rdv_retour="";
	}
	
	

	if ($_SESSION['loginOK'] == true AND $modif == 1) 	{ //s'il s'agit d'une modofication
			//print_r($_POST);
			
			$query1 = mysql_query("select id_conducteur from conducteur where id_utilisateur='$id_utilisateur'") or die(mysql_error());
			$conducteur = mysql_fetch_array($query1);	
			$id_cond=$conducteur['id_conducteur'];
			
		if(isset($_POST['ville1']) and !empty($_POST['ville1'])and isset($_POST['ville2']) AND !empty($_POST['ville2']) and isset($_POST['date_trajet']) and !empty($_POST['date_trajet']) and isset($_POST['heure']) and !empty($_POST['heure']) and isset($_POST['nbr_places']) and !empty($_POST['nbr_places']) ){
			if ($lieu_rdv){
				if(isset($_POST['marque']) and !empty($_POST['marque']) and isset($_POST['couleur']) and !empty($_POST['couleur'])){
					
					$marque=mysql_real_escape_string(htmlspecialchars($_POST['marque']));
					$couleur=mysql_real_escape_string(htmlspecialchars($_POST['couleur']));
					$modele=mysql_real_escape_string(htmlspecialchars($_POST['modele']));
					$immatriculation=mysql_real_escape_string(htmlspecialchars($_POST['immatriculation']));
					if(isset($_POST['util_courante'])){
						$util_courante=mysql_real_escape_string(htmlspecialchars($_POST['util_courante']));
						mysql_query("INSERT INTO vehicule (id_conducteur,marque_veh,modele_veh,immatriculation_veh,couleur_veh,util_courante) VALUES('$id_cond','$marque','$modele','$immatriculation','$couleur','$util_courante')") or die(mysql_error());
						$id_veh = mysql_insert_id();
					}else{
						mysql_query("INSERT INTO vehicule (id_conducteur,marque_veh,modele_veh,immatriculation_veh,couleur_veh,util_courante) VALUES('$id_cond','$marque','$modele','$immatriculation','$couleur','0')") or die(mysql_error());
						$id_veh = mysql_insert_id();
					}
					if(isset($_POST['trajet_reg']) and !empty($_POST['trajet_reg']) and isset($_POST['debt_periode']) and !empty($_POST['debt_periode']) and isset($_POST['fin_periode']) and !empty($_POST['fin_periode'])){
					
						$trajet_reg=mysql_real_escape_string(htmlspecialchars($_POST['trajet_reg']));
						$debt_periode=mysql_real_escape_string(htmlspecialchars($_POST['debt_periode']));
						$fin_periode=mysql_real_escape_string(htmlspecialchars($_POST['fin_periode']));
						
						$date = str_replace('/', '-', $date_trajet);
						$date =date('Y-m-d', strtotime($date));
						$date = strtotime($date);
						/*
						$date_debut = str_replace('/', '-', $debt_periode);
						$date_debut =date('Y-m-d', strtotime($date_debut));
						$date_debut = strtotime($date_debut);
						*/
						$date_debut= $date;
						
						$date_fin = str_replace('/', '-', $fin_periode);
						$date_fin =date('Y-m-d', strtotime($date_fin));
						$date_fin = strtotime($date_fin);
						$freq_trajet=mysql_real_escape_string(htmlspecialchars($_POST['freq_trajet']));
						
						mysql_query("UPDATE trajet SET id_lieu_rdv='$lieu_rdv',id_vehicule='$id_veh', ville_depart='$ville1', ville_arrivee='$ville2', heure='$heure',trajet_reg='$trajet_reg',freq_trajet_reg ='$freq_trajet', date_trajet='$date_trajet',nbr_place_dispo='$nbr_places', coment='$coment' WHERE num_trajet='$id_trajet';")or die(mysql_error()) ;
						
						while ($date <= $date_fin){
						
							if($date > $date_debut){
								$date_trajet = date('d/m/Y', $date);
								
								
									mysql_query("INSERT INTO trajet(id_conducteur,id_lieu_rdv,id_vehicule,ville_depart,ville_arrivee,heure,trajet_reg,freq_trajet_reg,date_trajet,nbr_place_dispo,coment) VALUES($id_cond,'$lieu_rdv','$id_veh','$ville1','$ville2','$heure','$trajet_reg','$freq_trajet','$date_trajet','$nbr_places','$coment')")or die(mysql_error()) ;
								
							}
							$date = strtotime('+'.$freq_trajet.' day', $date);
						}
						
						echo "<h4 style='color:green'>Les modifications on bien été prises en compte </h4><br /><br />";
					
					}else{
					
						mysql_query("UPDATE trajet SET id_lieu_rdv='$lieu_rdv' ,id_vehicule='$id_veh', ville_depart='$ville1', ville_arrivee='$ville2', heure='$heure',trajet_reg='0',freq_trajet_reg ='$freq_trajet', date_trajet='$date_trajet',nbr_place_dispo='$nbr_places',coment='$coment' WHERE num_trajet='$id_trajet';") or die(mysql_error());
						echo "<h4 style='color:green'>Les modifications ont bien été prises en compte </h4><br /><br />";
					
					}
					
					//echo "<h4 style='color:green'>ajout nouveau vehicule Les modifications on bien été prises en compte </h4><br /><br />";
					
				}else if(isset($_POST['vehicule']) and !empty($_POST['vehicule']) and $_POST['vehicule']!="autre"){
					$id_veh = $_POST['vehicule'];
					if(isset($_POST['trajet_reg']) and !empty($_POST['trajet_reg']) and isset($_POST['debt_periode']) and !empty($_POST['debt_periode']) and isset($_POST['fin_periode']) and !empty($_POST['fin_periode'])){
					
						$trajet_reg=mysql_real_escape_string(htmlspecialchars($_POST['trajet_reg']));
						$debt_periode=mysql_real_escape_string(htmlspecialchars($_POST['debt_periode']));
						$fin_periode=mysql_real_escape_string(htmlspecialchars($_POST['fin_periode']));
						
						$date = str_replace('/', '-', $date_trajet);
						$date =date('Y-m-d', strtotime($date));
						$date = strtotime($date);
						/*
						$date_debut = str_replace('/', '-', $debt_periode);
						$date_debut =date('Y-m-d', strtotime($date_debut));
						$date_debut = strtotime($date_debut);
						*/
						$date_debut= $date;
						
						$date_fin = str_replace('/', '-', $fin_periode);
						$date_fin =date('Y-m-d', strtotime($date_fin));
						$date_fin = strtotime($date_fin);
						$freq_trajet=mysql_real_escape_string(htmlspecialchars($_POST['freq_trajet']));
						
						
						mysql_query("UPDATE trajet SET id_lieu_rdv='$lieu_rdv',id_vehicule='$id_veh', ville_depart='$ville1', ville_arrivee='$ville2', heure='$heure',trajet_reg='$trajet_reg',freq_trajet_reg ='$freq_trajet', date_trajet='$date_trajet',nbr_place_dispo='$nbr_places', coment='$coment' WHERE num_trajet='$id_trajet';")or die(mysql_error()) ;
						while ($date <= $date_fin){
						
							if($date > $date_debut){
								$date_trajet = date('d/m/Y', $date);
								
								
									mysql_query("INSERT INTO trajet(id_conducteur,id_lieu_rdv,id_vehicule,ville_depart,ville_arrivee,heure,trajet_reg,freq_trajet_reg,date_trajet,nbr_place_dispo,coment) VALUES('$id_cond','$lieu_rdv','$id_veh','$ville1','$ville2','$heure','$trajet_reg','$freq_trajet','$date_trajet','$nbr_places','$coment')")or die(mysql_error()) ;
								
							}
							$date = strtotime('+'.$freq_trajet.' day', $date);
						}
						
						echo "<h4 style='color:green'>Les modifications on bien été prises en compte </h4><br /><br />";
					
					}else{
					
						mysql_query("UPDATE trajet SET id_lieu_rdv='$lieu_rdv',id_vehicule='$id_veh', ville_depart='$ville1', ville_arrivee='$ville2', heure='$heure',trajet_reg='$trajet_reg',freq_trajet_reg ='', date_trajet='$date_trajet',nbr_place_dispo='$nbr_places', coment='$coment' WHERE num_trajet='$id_trajet';") or die(mysql_error());
						echo "<h4 style='color:green'>Les modifications ont bien été prises en compte </h4><br /><br />";
					
					}
					
					//echo "<h4 style='color:green'>ajout nouveau vehicule Les modifications on bien été prises en compte </h4><br /><br />";
					
				}	
				
			}else{		
					echo "<h4 style='color:red'>vous n'avez pas saisi un lieu de rendez-vous! </h4><br />";	
			}
		}
	}
	else { //pour un nouveau trajet
		$query4 = mysql_query("select * from conducteur WHERE id_utilisateur= '$id_utilisateur'") or die(mysql_error());
		$m= mysql_num_rows($query4);
		if( $m == 0){
			$query5=mysql_query("INSERT INTO conducteur (id_utilisateur) VALUES ('$id_utilisateur')") or die(mysql_error());
			
		}
	
		$query1 = mysql_query("select * from trajet INNER JOIN conducteur ON trajet.id_conducteur=conducteur.id_conducteur WHERE conducteur.id_utilisateur= '$id_utilisateur' and ville_depart='$ville1' and ville_arrivee='$ville2' and heure='$heure' and date_trajet='$date_trajet'") or die(mysql_error());
		$i= mysql_num_rows($query1);
		if($i==0){
			$query2 = mysql_query("select id_conducteur from conducteur where id_utilisateur='$id_utilisateur'") or die(mysql_error());
			$conducteur = mysql_fetch_array($query2);	
			$id_cond=$conducteur['id_conducteur'];
			
			if(isset($_POST['ville1']) and !empty($_POST['ville1'])and isset($_POST['ville2']) AND !empty($_POST['ville2']) and isset($_POST['date_trajet']) and !empty($_POST['date_trajet']) and isset($_POST['heure']) and !empty($_POST['heure']) and isset($_POST['nbr_places']) and !empty($_POST['nbr_places']) ){
				if ($lieu_rdv){
					if(isset($_POST['marque']) and !empty($_POST['marque']) and isset($_POST['couleur']) and !empty($_POST['couleur'])){
						
						$marque=mysql_real_escape_string(htmlspecialchars($_POST['marque']));
						$couleur=mysql_real_escape_string(htmlspecialchars($_POST['couleur']));
						$modele=mysql_real_escape_string(htmlspecialchars($_POST['modele']));
						$immatriculation=mysql_real_escape_string(htmlspecialchars($_POST['immatriculation']));
						if(isset($_POST['util_courante'])){
							$util_courante=mysql_real_escape_string(htmlspecialchars($_POST['util_courante']));
						}else{
							$util_courante = 0;
						}
						if(isset($_POST['trajet_reg'])){
							$trajet_reg=mysql_real_escape_string(htmlspecialchars($_POST['trajet_reg']));
						}else{
							$trajet_reg = 0;
						}
						mysql_query("INSERT INTO vehicule (id_conducteur,marque_veh,modele_veh,immatriculation_veh,couleur_veh,util_courante) VALUES('$id_cond','$marque','$modele','$immatriculation','$couleur','$util_courante')") or die(mysql_error());
						$id_veh = mysql_insert_id();
						if(isset($_POST['trajet_reg']) and !empty($_POST['trajet_reg']) and isset($_POST['debt_periode']) and !empty($_POST['debt_periode']) and isset($_POST['fin_periode']) and !empty($_POST['fin_periode'])){
						
							$trajet_reg=mysql_real_escape_string(htmlspecialchars($_POST['trajet_reg']));
							$debt_periode=mysql_real_escape_string(htmlspecialchars($_POST['debt_periode']));
							$fin_periode=mysql_real_escape_string(htmlspecialchars($_POST['fin_periode']));
							$freq_trajet=mysql_real_escape_string(htmlspecialchars($_POST['freq_trajet']));
							
							$date = str_replace('/', '-', $date_trajet);
							$date =date('Y-m-d', strtotime($date));
							$date = strtotime($date);
							/*
							$date_debut = str_replace('/', '-', $debt_periode);
							$date_debut =date('Y-m-d', strtotime($date_debut));
							$date_debut = strtotime($date_debut);
							*/
							$date_debut= $date;
							
							$date_fin = str_replace('/', '-', $fin_periode);
							$date_fin =date('Y-m-d', strtotime($date_fin));
							$date_fin = strtotime($date_fin);
						
							mysql_query("INSERT INTO trajet(id_conducteur,id_lieu_rdv,id_vehicule,ville_depart,ville_arrivee,heure,trajet_reg,freq_trajet_reg,date_trajet,nbr_place_dispo,coment) VALUES('$id_cond','$lieu_rdv','$id_veh','$ville1','$ville2','$heure','$trajet_reg','$freq_trajet','$date_trajet','$nbr_places','$coment')")or die(mysql_error()) ;
							while ($date <= $date_fin){
							
								if($date_debut < $date ){
									//echo $date_debut;
									$date_trajet = date('d/m/Y', $date);
									mysql_query("INSERT INTO trajet(id_conducteur,id_lieu_rdv,id_vehicule,ville_depart,ville_arrivee,heure,trajet_reg,freq_trajet_reg,date_trajet,nbr_place_dispo,coment) VALUES('$id_cond','$lieu_rdv','$id_veh','$ville1','$ville2','$heure','$trajet_reg','$freq_trajet','$date_trajet','$nbr_places','$coment')")or die(mysql_error()) ;
								}
								$date = strtotime('+'.$freq_trajet.' day', $date);
							}
							//mysql_query("INSERT INTO trajet(id_conducteur,id_vehicule,ville_depart,ville_arrivee,heure,trajet_reg,date_trajet,nbr_place_dispo,coment) VALUES('	','$id_veh','$ville1','$ville2','$heure','$trajet_reg','$date_trajet','$nbr_places','$coment')")or die(mysql_error()) ;
							echo "<h4 style='color:green'>Votre trajet a bien été enregistré, merci. </h4><br />";
						}else{
							mysql_query("INSERT INTO trajet(id_conducteur,id_lieu_rdv,id_vehicule,ville_depart,ville_arrivee,heure,trajet_reg,date_trajet,nbr_place_dispo,coment) VALUES('$id_cond','$lieu_rdv','$id_veh','$ville1','$ville2','$heure','0','$date_trajet','$nbr_places','$coment')")or die(mysql_error()) ;
							echo "<h4 style='color:green'>Votre trajet a bien été enregistré, merci. </h4><br />";
						}
					
					}else if(isset($_POST['vehicule']) and !empty($_POST['vehicule']) and $_POST['vehicule']!="autre"){
						$id_veh = $_POST['vehicule'];
						if(isset($_POST['trajet_reg']) and !empty($_POST['trajet_reg']) and isset($_POST['debt_periode']) and !empty($_POST['debt_periode']) and isset($_POST['fin_periode']) and !empty($_POST['fin_periode'])){
						
							$trajet_reg=mysql_real_escape_string(htmlspecialchars($_POST['trajet_reg']));
							$debt_periode=mysql_real_escape_string(htmlspecialchars($_POST['debt_periode']));
							$fin_periode=mysql_real_escape_string(htmlspecialchars($_POST['fin_periode']));
							$freq_trajet=mysql_real_escape_string(htmlspecialchars($_POST['freq_trajet']));
							
							$date = str_replace('/', '-', $date_trajet);
							$date =date('Y-m-d', strtotime($date));
							$date = strtotime($date);
							/*
							$date_debut = str_replace('/', '-', $debt_periode);
							$date_debut =date('Y-m-d', strtotime($date_debut));
							$date_debut = strtotime($date_debut);
							*/
							$date_debut= $date;
							
							$date_fin = str_replace('/', '-', $fin_periode);
							$date_fin =date('Y-m-d', strtotime($date_fin));
							$date_fin = strtotime($date_fin);
						
							mysql_query("INSERT INTO trajet(id_conducteur,id_lieu_rdv,id_vehicule,ville_depart,ville_arrivee,heure,trajet_reg,freq_trajet_reg,date_trajet,nbr_place_dispo,coment) VALUES('$id_cond','$lieu_rdv','$id_veh','$ville1','$ville2','$heure','$trajet_reg','$freq_trajet','$date_trajet','$nbr_places','$coment')")or die(mysql_error()) ;
							while ($date <= $date_fin){
							
								if($date_debut < $date ){
									//echo $date_debut;
									$date_trajet = date('d/m/Y', $date);
									mysql_query("INSERT INTO trajet(id_conducteur,id_lieu_rdv,id_vehicule,ville_depart,ville_arrivee,heure,trajet_reg,freq_trajet_reg,date_trajet,nbr_place_dispo,coment) VALUES('$id_cond','$lieu_rdv','$id_veh','$ville1','$ville2','$heure','$trajet_reg','$freq_trajet','$date_trajet','$nbr_places','$coment')")or die(mysql_error()) ;
								}
								$date = strtotime('+'.$freq_trajet.' day', $date);
							}
							//mysql_query("INSERT INTO trajet(id_conducteur,id_vehicule,ville_depart,ville_arrivee,heure,trajet_reg,date_trajet,nbr_place_dispo,coment) VALUES('$id_cond','$id_veh','$ville1','$ville2','$heure','$trajet_reg','$date_trajet','$nbr_places','$coment')")or die(mysql_error()) ;
							echo "<h4 style='color:green'>Votre trajet a bien été enregistré, merci. </h4><br />";
						}else{
							mysql_query("INSERT INTO trajet(id_conducteur,id_lieu_rdv,id_vehicule,ville_depart,ville_arrivee,heure,trajet_reg,date_trajet,nbr_place_dispo,coment) VALUES('$id_cond','$lieu_rdv','$id_veh','$ville1','$ville2','$heure','0','$date_trajet','$nbr_places','$coment')")or die(mysql_error()) ;
							echo "<h4 style='color:green'>Votre trajet a bien été enregistré, merci. </h4><br />";
						}
					}else{
						echo "<h4 style='color:red'>vous n'avez pas saisi un véhicule pour ce trajet! </h4><br />";
					}
				}
		
				if ($lieu_rdv_retour){
					if(isset($_POST['heure_retour']) and !empty($_POST['heure_retour'])and $_POST['heure_retour'] != "hh:mm" and isset($_POST['date_trajet_retour']) and !empty($_POST['date_trajet_retour'])and isset($_POST['nbr_places_retour']) and !empty($_POST['nbr_places_retour'])){		
						$query3 = mysql_query("select * from trajet INNER JOIN conducteur ON trajet.id_conducteur=conducteur.id_conducteur WHERE conducteur.id_utilisateur= '$id_utilisateur' and ville_depart='$ville2' and ville_arrivee='$ville1' and heure='$heure_retour' and date_trajet='$date_trajet_retour'") or die(mysql_error());
						$j= mysql_num_rows($query3);
						if($j==0){
							if(isset($_POST['marque_retour']) and !empty($_POST['marque_retour']) and isset($_POST['couleur_retour']) and !empty($_POST['couleur_retour'])){
				
								$marque_retour=mysql_real_escape_string(htmlspecialchars($_POST['marque_retour']));
								$couleur_retour=mysql_real_escape_string(htmlspecialchars($_POST['couleur_retour']));
								$modele_retour=mysql_real_escape_string(htmlspecialchars($_POST['modele_retour']));
								$immatriculation_retour=mysql_real_escape_string(htmlspecialchars($_POST['immatriculation_retour']));
								if(isset($_POST['util_courante_retour'])){
									$util_courante_retour=mysql_real_escape_string(htmlspecialchars($_POST['util_courante_retour']));
								}else{
									$util_courante_retour = 0;
								}
								if(isset($_POST['$trajet_reg_retour'])){
									$trajet_reg_retour=mysql_real_escape_string(htmlspecialchars($_POST['trajet_reg_retour']));
								}else{
									$trajet_reg_retour = 0;
								}
								
								mysql_query("INSERT INTO vehicule (id_conducteur,marque_veh,modele_veh,immatriculation_veh,couleur_veh,util_courante) VALUES('$id_cond','$marque_retour','$modele_retour','$immatriculation_retour','$couleur_retour','$util_courante_retour')") or die(mysql_error());
								$id_veh_retour = mysql_insert_id();
								
								if(isset($_POST['trajet_reg_retour']) and !empty($_POST['trajet_reg_retour']) and isset($_POST['debt_periode_retour']) and !empty($_POST['debt_periode_retour']) and isset($_POST['fin_periode_retour']) and !empty($_POST['fin_periode_retour'])){
									$trajet_reg_retour=mysql_real_escape_string(htmlspecialchars($_POST['trajet_reg_retour']));
									$debt_periode_retour=mysql_real_escape_string(htmlspecialchars($_POST['debt_periode_retour']));
									$fin_periode_retour=mysql_real_escape_string(htmlspecialchars($_POST['fin_periode_retour']));
									$freq_trajet_retour=mysql_real_escape_string(htmlspecialchars($_POST['freq_trajet_retour']));
									
									$date_retour = str_replace('/', '-', $date_trajet_retour);
									$date_retour =date('Y-m-d', strtotime($date_retour));
									$date_retour = strtotime($date_retour);
									/*
									$date_debut = str_replace('/', '-', $debt_periode);
									$date_debut =date('Y-m-d', strtotime($date_debut));
									$date_debut = strtotime($date_debut);
									*/
									$date_debut_retour= $date_retour;
									
									$date_fin_retour = str_replace('/', '-', $fin_periode_retour);
									$date_fin_retour =date('Y-m-d', strtotime($date_fin_retour));
									$date_fin_retour = strtotime($date_fin_retour);
								
									mysql_query("INSERT INTO trajet(id_conducteur,id_lieu_rdv,id_vehicule,ville_depart,ville_arrivee,heure,trajet_reg,freq_trajet_reg,date_trajet,nbr_place_dispo,coment) VALUES('$id_cond','$lieu_rdv_retour','$id_veh_retour','$ville2','$ville1','$heure_retour','$trajet_reg_retour','$freq_trajet_retour','$date_trajet_retour','$nbr_places_retour','$coment_retour')")or die(mysql_error()) ;
									while ($date_retour <= $date_fin_retour){
									
										if($date_debut_retour < $date_retour ){
											//echo $date_debut;
											$date_trajet_retour = date('d/m/Y', $date_retour);
											mysql_query("INSERT INTO trajet(id_conducteur,id_lieu_rdv,id_vehicule,ville_depart,ville_arrivee,heure,trajet_reg,freq_trajet_reg,date_trajet,nbr_place_dispo,coment) VALUES('$id_cond','$lieu_rdv_retour','$id_veh_retour','$ville2','$ville1','$heure_retour','$trajet_reg_retour','$freq_trajet_retour','$date_trajet_retour','$nbr_places_retour','$coment_retour')")or die(mysql_error()) ;
										}
										$date_retour = strtotime('+'.$freq_trajet_retour.' day', $date_retour);
									}
									//mysql_query("INSERT INTO trajet(id_conducteur,id_vehicule,ville_depart,ville_arrivee,heure,trajet_reg,date_trajet,nbr_place_dispo,coment) VALUES('$id_cond','$id_veh','$ville1','$ville2','$heure','$trajet_reg','$date_trajet','$nbr_places','$coment')")or die(mysql_error()) ;
									echo "<h4 style='color:green'>Votre trajet a bien été enregistré, merci. </h4><br />";
								}else{
									mysql_query("INSERT INTO trajet(id_conducteur,id_lieu_rdv,id_vehicule,ville_depart,ville_arrivee,heure,trajet_reg,date_trajet,nbr_place_dispo,coment) VALUES('$id_cond','$lieu_rdv_retour','$id_veh_retour','$ville2','$ville1','$heure_retour','0','$date_trajet_retour','$nbr_places_retour','$coment_retour')")or die(mysql_error()) ;
											//print_r($_POST);
								}	
							}else if(isset($_POST['vehicule_retour']) and !empty($_POST['vehicule_retour'])){
								$id_veh_retour = $_POST['vehicule_retour'];
								if(isset($_POST['trajet_reg_retour']) and !empty($_POST['trajet_reg_retour']) and isset($_POST['debt_periode_retour']) and !empty($_POST['debt_periode_retour']) and isset($_POST['fin_periode_retour']) and !empty($_POST['fin_periode_retour'])){
								
									$trajet_reg_retour=mysql_real_escape_string(htmlspecialchars($_POST['trajet_reg_retour']));
									$debt_periode_retour=mysql_real_escape_string(htmlspecialchars($_POST['debt_periode_retour']));
									$fin_periode_retour=mysql_real_escape_string(htmlspecialchars($_POST['fin_periode_retour']));
									$freq_trajet_retour=mysql_real_escape_string(htmlspecialchars($_POST['freq_trajet_retour']));
									
									$date_retour = str_replace('/', '-', $date_trajet_retour);
									$date_retour =date('Y-m-d', strtotime($date_retour));
									$date_retour = strtotime($date_retour);
									/*
									$date_debut = str_replace('/', '-', $debt_periode);
									$date_debut =date('Y-m-d', strtotime($date_debut));
									$date_debut = strtotime($date_debut);
									*/
									$date_debut_retour= $date_retour;
									
									$date_fin_retour = str_replace('/', '-', $fin_periode_retour);
									$date_fin_retour =date('Y-m-d', strtotime($date_fin_retour));
									$date_fin_retour = strtotime($date_fin_retour);
								
									mysql_query("INSERT INTO trajet(id_conducteur,id_lieu_rdv,id_vehicule,ville_depart,ville_arrivee,heure,trajet_reg,freq_trajet_reg,date_trajet,nbr_place_dispo,coment) VALUES('$id_cond','$lieu_rdv_retour','$id_veh_retour','$ville2','$ville1','$heure_retour','$trajet_reg_retour','$freq_trajet_retour','$date_trajet_retour','$nbr_places_retour','$coment_retour')")or die(mysql_error()) ;
									while ($date_retour <= $date_fin_retour){
									
										if($date_debut_retour < $date_retour ){
											//echo $date_debut;
											$date_trajet_retour = date('d/m/Y', $date_retour);
											mysql_query("INSERT INTO trajet(id_conducteur,id_lieu_rdv,id_vehicule,ville_depart,ville_arrivee,heure,trajet_reg,freq_trajet_reg,date_trajet,nbr_place_dispo,coment) VALUES('$id_cond','$lieu_rdv_retour','$id_veh_retour','$ville2','$ville1','$heure_retour','$trajet_reg_retour','$freq_trajet_retour','$date_trajet_retour','$nbr_places_retour','$coment_retour')")or die(mysql_error()) ;
										}
										$date_retour = strtotime('+'.$freq_trajet_retour.' day', $date_retour);
									}
									//mysql_query("INSERT INTO trajet(id_conducteur,id_vehicule,ville_depart,ville_arrivee,heure,trajet_reg,date_trajet,nbr_place_dispo,coment) VALUES('$id_cond','$id_veh','$ville1','$ville2','$heure','$trajet_reg','$date_trajet','$nbr_places','$coment')")or die(mysql_error()) ;
									//echo "<h4 style='color:green'>Votre trajet a bien été enregistré, merci. </h4><br />";
								}else{
									mysql_query("INSERT INTO trajet(id_conducteur,id_lieu_rdv,id_vehicule,ville_depart,ville_arrivee,heure,trajet_reg,date_trajet,nbr_place_dispo,coment) VALUES('$id_cond','$lieu_rdv_retour','$id_veh_retour','$ville2','$ville1','$heure_retour','0','$date_trajet_retour','$nbr_places_retour','$coment_retour')")or die(mysql_error()) ;
											//print_r($_POST);
								}		
							}else{
								echo "<h4 style='color:red'>il manque des champs obligatoires dans le trajet de retour! </h4><br />";
							}
						}else{
							echo "<h4 style='color:red'>Le trajet de retour est déjà saisi sous votre nom! </h4><br />";
						}
					}	
				}
			}else{
				echo "<h4 style='color:red'>il manque des champs obligatoires </h4><br />";
			}
		}else{
			echo "<h4 style='color:red'>Ce trajet est déjà saisi sous votre nom! </h4><br />";
		}
	
	}
			
		
	mysql_close();
		
		
	?>