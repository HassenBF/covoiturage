<?php
header('Content-Type: text/html; charset=UTF-8');

// if(!isset($_SESSION)) 
    // { 
        session_start();
		
    // } 
	$username  = $_SESSION['pseudo'];
	// echo "le nom de l'utilisateur est $username";/*
	if(isset($_SESSION['id_utilisatuer'])){
	$id_utilisateur = $_SESSION['id_utilisatuer'];
	}
	$nom=mysql_real_escape_string(htmlspecialchars($_POST['nom']));
	$prenom=mysql_real_escape_string(htmlspecialchars($_POST['prenom']));
	$mail=mysql_real_escape_string(htmlspecialchars($_POST['mail']));
	$tel=mysql_real_escape_string(htmlspecialchars($_POST['tel']));
	if(isset($_POST['afficher_tel'])){
		$afficher_tel=mysql_real_escape_string(htmlspecialchars($_POST['afficher_tel']));
	}else{
		$afficher_tel=0;
	}
	
	include('connexion_SQL.php');
	

if(isset($_GET['modif']) and $_GET['modif'] == 1 ){

mysql_query("UPDATE utilisateur SET mail='$mail',nom=UPPER('$nom'), prenom =UPPER('$prenom'), tel='$tel',afficher_tel='$afficher_tel' WHERE id_utilisateur = $id_utilisateur ") or die(mysql_error());

$query1 = mysql_query("SELECT * FROM vehicule INNER JOIN conducteur ON vehicule.id_conducteur = conducteur.id_conducteur WHERE conducteur.id_utilisateur= $id_utilisateur") or die(mysql_error());
$m=0;
while ($vehicule= mysql_fetch_array($query1) ) {
$m++;
	$id_vehicule=$vehicule['id_vehicule'];
	If(isset($_POST['suppr_'.$id_vehicule]) AND !empty($_POST['suppr_'.$id_vehicule])){
	
		$query2 = mysql_query("SELECT * FROM trajet WHERE id_vehicule = '$id_vehicule'") or die(mysql_error());
		$n= mysql_num_rows($query2);
		if($n!=0){
			header('Location: index.php?modif=1&edit_profile&suppr_impossible=1');
		}else{
			
		mysql_query("DELETE FROM vehicule WHERE id_vehicule = '$id_vehicule'") or die(mysql_error());
		header('Location: index.php?modif=1&edit_profile&suppr=1');
		}
	
	}else{
	
		if(isset($_POST['marque'.$m]) && isset($_POST['couleur'.$m]) AND !empty($_POST['marque'.$m]) AND !empty($_POST['couleur'.$m])){
			
			$marque=mysql_real_escape_string(htmlspecialchars($_POST['marque'.$m]));
			$couleur=mysql_real_escape_string(htmlspecialchars($_POST['couleur'.$m]));
			$modele=mysql_real_escape_string(htmlspecialchars($_POST['modele'.$m]));
			$immatriculation=mysql_real_escape_string(htmlspecialchars($_POST['immatriculation'.$m]));
			if(isset($_POST['util_courante'.$m]) && !empty($_POST['util_courante'.$m]) ){
				$util_courante=mysql_real_escape_string(htmlspecialchars($_POST['util_courante'.$m]));
				mysql_query("UPDATE  vehicule SET marque_veh = UPPER('$marque'),modele_veh = UPPER('$modele'),immatriculation_veh = UPPER('$immatriculation'),couleur_veh = UPPER('$couleur'),util_courante = '$util_courante' where id_vehicule=".$vehicule['id_vehicule']."") or die(mysql_error());
			
			}else{
			mysql_query("UPDATE  vehicule SET marque_veh = UPPER('$marque'),modele_veh = UPPER('$modele'),immatriculation_veh = UPPER('$immatriculation'),couleur_veh = UPPER('$couleur'),util_courante ='' where id_vehicule=".$vehicule['id_vehicule']."") or die(mysql_error());
			}
			
			
	}
	}
	}
		
		if(isset($_POST['marque']) && isset($_POST['couleur']) AND !empty($_POST['marque']) AND !empty($_POST['couleur'])){
			
			$marque=mysql_real_escape_string(htmlspecialchars($_POST['marque']));
			$couleur=mysql_real_escape_string(htmlspecialchars($_POST['couleur']));
			$modele=mysql_real_escape_string(htmlspecialchars($_POST['modele']));
			$immatriculation=mysql_real_escape_string(htmlspecialchars($_POST['immatriculation']));
				
			$query1 = mysql_query("SELECT * FROM conducteur  WHERE id_utilisateur= $id_utilisateur ") or die(mysql_error());
			$i = mysql_num_rows($query1);
			
			if($i == 0){
				
				mysql_query("INSERT INTO conducteur (id_utilisateur) VALUES ('$id_utilisateur')")or die(mysql_error());
				$id_conducteur = mysql_insert_id();
				mysql_query("INSERT INTO vehicule (id_conducteur, marque_veh,modele_veh,immatriculation_veh,couleur_veh,util_courante) VALUES ('$id_conducteur',UPPER('$marque'),UPPER('$modele'),UPPER('$immatriculation'),UPPER('$couleur'),'1')")or die(mysql_error());
				
			}else{

				
		
					$query3 = mysql_query("SELECT * FROM conducteur WHERE id_utilisateur = $id_utilisateur;") or die(mysql_error());
					while ($conducteur = mysql_fetch_array($query3) ) {
						$id_conducteur=$conducteur['id_conducteur'];
					}
					if(isset($_POST['util_courante']) && !empty($_POST['util_courante']) ){
				$util_courante=mysql_real_escape_string(htmlspecialchars($_POST['util_courante']));
				mysql_query("INSERT INTO vehicule (id_conducteur, marque_veh,modele_veh,immatriculation_veh,couleur_veh,util_courante) VALUES ('$id_conducteur',UPPER('$marque'),UPPER('$modele'),UPPER('$immatriculation'),UPPER('$couleur'),'1')")or die(mysql_error());
			
			}else{
			mysql_query("INSERT INTO vehicule (id_conducteur, marque_veh,modele_veh,immatriculation_veh,couleur_veh,util_courante) VALUES ('$id_conducteur',UPPER('$marque'),UPPER('$modele'),UPPER('$immatriculation'),UPPER('$couleur'),'')")or die(mysql_error());
			}
			
				}
				
			}
		echo "<script type=\"text/javascript\">alert(\"Vos changements sont bien pris en comptes, merci.\"); location =\"index.php?accueil\"</script>";
	
		
	
}else{
	
	mysql_query("INSERT INTO utilisateur(pseudo,mail,nom,prenom,tel,afficher_tel) VALUES('$username','$mail',UPPER('$nom'),UPPER('$prenom'), '$tel','$afficher_tel')");
			$id_utilis = mysql_insert_id();
			mysql_query("INSERT INTO conducteur (id_utilisateur ) VALUES($id_utilis)") or die(mysql_error());
	
		$_SESSION['nom'] = $nom;
		$_SESSION['prenom'] = $prenom;
		$_SESSION['mail'] = $mail;
		//$_SESSION['tel'] = $tel;
		
		$reponse = mysql_query("SELECT * FROM utilisateur WHERE pseudo='$username'") or die(mysql_error());
						
		while ($donnees = mysql_fetch_array($reponse) )
			{
			$_SESSION['id'] = $donnees['id_utilisateur'];
			}
		
		
		
		
		
		//include('menus_session.htm');
		
		     
		echo "<script type=\"text/javascript\">alert(\"Votre inscription a bien &eacute;t&eacute; prise en compte, merci.\"); location =\"index.php\"</script>" ;     

		}
	mysql_close();
		
		
	
		
		
			
		
		
		

