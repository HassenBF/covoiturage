
		
<?php

	if (isset($_SESSION['loginOK']) and  $_SESSION['loginOK'] == true)
		{		
		
		$num=$_GET['num_trajet'];
		
		include('connexion_SQL.php');
		
		$reponse = mysql_query("SELECT * FROM trajet WHERE num_trajet='$num'") or die(mysql_error());
		
		while ($donnees = mysql_fetch_array($reponse) ) {
			$id2=$donnees['id_conducteur'];
			$ville1=$donnees['ville_depart'];
			$ville2=$donnees['ville_arrivee'];
			$places_dsipo=$donnees['nbr_place_dispo'];
			$heure=$donnees['heure'];
			$type_trajet=$donnees['trajet_reg'];
			$date_trajet=$donnees['date_trajet'];
			$coment=$donnees['coment'];
		}
		$id2=10;
		$reponse3 = mysql_query("SELECT * FROM participant WHERE num_trajet='$num'") or die(mysql_error());
		$places_rest = $places_dsipo - mysql_num_rows($reponse3);
		
		$reponse2 = mysql_query("SELECT * FROM utilisateur WHERE id_utilisateur='$id2'") or die(mysql_error());
		
		while ($donnees2 = mysql_fetch_array($reponse2) ) {
			$nom=$donnees2['nom'];
			$prenom=$donnees2['prenom'];
			$tel=$donnees2['tel'];
			$afficher_tel = $donnees2['afficher_tel'];
		} ?>
<form name="formulaire" action="index.php?reserver&num_trajet=<?php echo "$num" ; ?>"  method="post" >


<?php 		
		echo "D&eacute;tails du trajet : ";
		echo "<strong>";
		echo $ville1; 
		echo "   =>   "; 
		echo $ville2; 
		echo "</strong>";
		echo "</BR></BR> Type de trajet : ";
		if ($type_trajet == 1) {
			echo "régulier";
		}else{
			echo "ponctuel";
		}
		
			echo "</BR></BR> Date du trajet :&nbsp;";
			echo "<strong>";
			echo "$date_trajet";
			echo "</strong>";
		
		echo "</BR></BR> Places restantes :&nbsp;";
		echo $places_rest;
		echo "<br /><br />D&eacute;part &agrave; : ";
		echo "<strong>";
		echo $heure; 
		echo "</strong>";
		echo "<br /><br /> Conducteur : ";
		echo "<strong>";
		echo $nom; 
		echo " ";
		echo $prenom;
		echo "</strong>";			
		echo "<br /><br />";
		if($afficher_tel){
		echo "Téléphone : ";
		echo "<strong>";
		echo "0".$tel; 
		echo "</strong>";
		}
		echo "<br /><br />Commentaires : ";
		echo "<strong>";
		echo $coment;
		echo "</strong>";
		
		
		mysql_close();
	
	
	echo"</br></br>";	
	
	
	
	
if ($places_rest > 0){?>
	<input type="submit" name="soumettre"  class="styled-button-12" value="résérver" />
<?php
}else{?>
	<h4 style='color:red'>Ce trajet est complet ! </h4><br />

<?php }?>
	</form>
	
<?php	}
	
	else {
	echo "</BR></BR></BR></BR>";
	echo"<div align=\"center\">";
	echo"Merci de vous identifier pour acceder à cette page.";
	echo "</BR></BR><BR>";
	echo "Vous n'&ecirc;tes pas inscrits? <a href=\"saisir_donnees_perso.php\" TARGET=\"bas\">Formulaire d'inscription</a>";
	echo"</div>";
		}
	
	?>
