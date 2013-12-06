<?php
	if(isset($_GET['num_trajet']) and !empty($_GET['num_trajet'])){
		include('connexion_SQL.php');

		$num_trajet=$_GET['num_trajet'];
		//$id_participant=$_SESSION['id'];
		$response = mysql_query("select * from utilisateur where id_utilisateur='$id_utilisateur'") or die(mysql_error());
		while($utilisateur = mysql_fetch_array($response)){
		$nom=$utilisateur['nom'];
		$prenom = $utilisateur['prenom'];
		$mail = $utilisateur['mail'];
		$tel = $utilisateur['tel'];
		$afficher_tel = $utilisateur['afficher_tel'];
		}
		$i=0;
		
		$query1 = mysql_query("select * from participant where id_utilisateur='$id_utilisateur' and num_trajet='$num_trajet'"); 
		$i = mysql_num_rows($query1);
		if($i == 0 ){
		
			mysql_query("INSERT INTO participant (id_utilisateur,num_trajet) VALUES ('$id_utilisateur','$num_trajet') ") or die(mysql_error()); ?>
			<h4 style='color:green'>Votre réservation a bien été enregistré, merci. </h4><br />
			<?php 
		$query = mysql_query("select * from trajet where num_trajet='$num_trajet'") or die(mysql_error());
		while($trajet = mysql_fetch_array($query)){
		$ville_depart=$trajet['ville_depart'];
		$ville_arrivee = $trajet['ville_arrivee'];
		$date_trajet = $trajet['date_trajet'];
		$heure = $trajet['heure'];
		
		}
     $headers ='From: "no_replay covoiturage utbm"<madjer.ntieche@gmail.com>'."\n"; 
     //$headers .='Reply-To: adresse_de_reponse@fai.fr'."\n"; 
     $headers .='Content-Type: text/html; charset="utf_8"'."\n"; 
     $headers .='Content-Transfer-Encoding: 8bit'; 
	 $adresse_destinataire = $mail;
	 $Sujet = "confirmation de réseravtion";
	 $Message = "&nbsp;&nbsp;	Vous avez réservé un trajet sur le site de covoiturage de l'UTBM, en voici les détails: <br/><br/>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	Ville de départ 	: $ville_depart <br/><br/>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	Ville d'arrivée 	: $ville_arrivee <br/><br/>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	Date du trajet 		: $date_trajet <br/><br/>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	L'heure du trajet 	: $heure <br/><br/>
				&nbsp;&nbsp;	Pour plus de détails, veuillez consulter votre compte sur notre site de covoiturage.Merci pour votre visite";
	 
// echo "$adresse_destinataire  ";
     if(mail($adresse_destinataire, $Sujet, $Message, $headers)) 
     { 
          echo 'Le message de confirmation a bien été envoyé, veuillez consulter votre boite mail'; 
     } 
     else 
     { 
          echo 'Le message n\'a pu etre envoyé'; 
     } 
?>
		
<?php	}else{?>
			<h4 style='color:red'>Vous participez déjà a ce trajet</h4><br />
<?php		}
	}
?>
	