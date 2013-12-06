<?php

$num=$_GET['num_trajet'];
$username=$_SESSION['pseudo'];


if ($_SESSION['loginOK'] == true) {

	include('connexion_SQL.php');
	
	
	
	$query= "SELECT Distinct util.mail, tr.ville_depart, tr.ville_arrivee, tr.date_trajet, tr.heure FROM utilisateur util INNER JOIN participant par ON util.id_utilisateur=par.id_utilisateur INNER JOIN trajet tr ON par.num_trajet = tr.num_trajet WHERE tr.num_trajet =$num";
	$reponse = mysql_query($query) or die(mysql_error());
		
	while ($mail_participant = mysql_fetch_array($reponse) ) {
		$mail = $mail_participant['mail'];
		$ville_depart = $mail_participant['ville_depart'];
		$ville_arrivee = $mail_participant['ville_arrivee'];
		$date_trajet = $mail_participant['date_trajet'];
		$heure = $mail_participant['heure'];
		$headers ='From: "no_replay covoiturage utbm"<covoiturage@utbm.fr>'."\n"; 
		 //$headers .='Reply-To: adresse_de_reponse@fai.fr'."\n"; 
		 $headers .='Content-Type: text/html; charset="utf_8"'."\n"; 
		 $headers .='Content-Transfer-Encoding: 8bit'; 
		 $adresse_destinataire = $mail;
		 $Sujet = "Annulation du trajet";
		 $Message = "&nbsp;&nbsp;	Le trajet suivant auquel vous avez particpé a été annulé: <br/><br/>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	Ville de départ 	: $ville_depart  <br/><br/>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	Ville d'arrivée 	:  $ville_arrivee<br/><br/>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	Date du trajet 		:  $date_trajet<br/><br/>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	L'heure du trajet 	:  $heure<br/><br/>";
		
		mail($adresse_destinataire, $Sujet, $Message, $headers) ;
		
	}
	mysql_query("DELETE FROM participant WHERE num_trajet='$num'") or die(mysql_error());
	mysql_query("DELETE FROM trajet WHERE num_trajet='$num'") or die(mysql_error());
	
	header("Location:index.php?gestion_mes_trajet");
}


mysql_close();

?>





	