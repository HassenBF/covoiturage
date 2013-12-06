

<script type="text/javascript" language="Javascript" >

<!--
function verification()
{
if(document.formulaire.nom.value == "") {
   alert("Veuillez entrer votre nom svp");
   document.formulaire.nom.focus();
   return false;
  }
  else   if(document.formulaire.prenom.value == "") {
   alert("Veuillez entrer votre prénom svp");
   document.formulaire.prenom.focus();
   return false;
  }
  else   if(document.formulaire.mail.value == "") {
   alert("Veuillez entrer une adresse email svp");
   document.formulaire.mail.focus();
   return false;
  }
  
  else  if(document.formulaire.mail.value.indexOf('@') == -1) {
   alert("Ce n'est pas une adresse mail valide");
   document.formulaire.mail.focus();
   return false;
  }
  else  if(document.formulaire.mail.value.indexOf('.') == -1) {
   alert("Ce n'est pas une adresse mail valide");
   document.formulaire.mail.focus();
   return false;
  }
  else if(document.formulaire.marque.value != "" || document.formulaire.couleur.value != "" ) {
	if(document.formulaire.marque.value != "" && document.formulaire.couleur.value != ""){
		return true;
	}else{
	   alert("Veuillez avez oublié de renseigner un des champs obligatoires dans la séction véhicule ");
	   document.formulaire.marque.focus();
	   return false;
   }
  }
 
   else if(document.formulaire.accord.checked == false) {
   alert("Veuillez accepter la difusion de vos coordonnées svp");
   document.formulaire.accord.focus();
   return false;
  } 
  
  	
return true
}

function visibilite(thingId) 
{ 
var targetElement; 
targetElement = document.getElementById(thingId) ; 
if (targetElement.style.display == "none") 
{ 
targetElement.style.display = "" ; 
} else { 
targetElement.style.display = "none" ; 
} 
} 

function ajouter_veh() {
	
	var targetElement = document.getElementById("ajout_veh") ;
	var input_suppr = document.getElementById("suppr_vehi") ;
	var util_coourante = document.getElementById("util_courante") ;
	var le_checkbox = document.getElementById("le_checkbox") ;
	var le_select = document.getElementById("le_select") ;
	var valeur = le_select.options[le_select.selectedIndex].value;
	
	if (valeur == "autre") { 
		targetElement.style.display = "" ;
		util_coourante.style.display = "none";
		input_suppr.style.display = "none";
	} else { 
		var div_id = document.getElementById(valeur);
		div_id.style.display = "";
		//targetElement.style.display = "none" ;
		/*input_suppr.style.display = "";
		util_coourante.style.display = "";
		util_coourante.style.display = "inline-block";*/
		

		
		if(valeur == "util_courante"){
			le_checkbox.checked=true;
			
		}else{
			le_checkbox.checked=false;
			
		}
	} 
}
//-->
</script>

<?php

If (isset($_GET['suppr_impossible']) and $_GET['suppr_impossible']==1) {
	
	echo "<h4 style='color:red'>vous ne pouvez pas supprimer cette voiture car elle existe dans l'un de vos trajets actuels! </h4><br />";

}
If (isset($_GET['suppr']) and $_GET['suppr']==1) {
	
	echo "<h4 style='color:green'>la suppression de la voiture a été bien effectuée </h4><br />";

}

	
If (isset($_GET['modif']) && $_GET['modif']!= 2) {

$modif=$_GET['modif'];

		
		$mail="";
		$nom="nom";
		$prenom="prenom";
		$tel="tel";
	}

if ($_SESSION['loginOK'] == true AND $modif == 1) {
	
	$user = $_SESSION['pseudo'];
	$id_utilisatuer = $_SESSION['id_utilisatuer'];
		
	include('connexion_SQL.php');
		
	$query1 = mysql_query("SELECT * FROM utilisateur WHERE pseudo='$user'") or die(mysql_error());
		
	while ($donnees = mysql_fetch_array($query1) ) {
		
		$mail=$donnees['mail'];
		$nom=$donnees['nom'];
		$prenom=$donnees['prenom'];
		$tel=$donnees['tel'];
		$afficher_tel=$donnees['afficher_tel'];
		
		}
	$query2 = mysql_query("SELECT * FROM vehicule INNER JOIN conducteur ON vehicule.id_conducteur = conducteur.id_conducteur WHERE conducteur.id_utilisateur= ".$_SESSION['id_utilisatuer']." AND util_courante=1") or die(mysql_error());
	while ($donnees = mysql_fetch_array($query1) ) {
		
		$marque_vehi=$donnees['marque_vehi'];
		$couleur_vehi=$donnees['couleur_vehi'];
		$photo=$donnees['photo'];
		
	}
	mysql_close();
	}
	
	else {
		//$modif = "";
		}
?>


<form name="formulaire" action="<?php if ($modif == 1) { echo"enregistre_utilisateur.php?modif=1"; }else {echo"enregistre_utilisateur.php"; } ?>" method="post" onSubmit="return verification()">
  
	<table  border="0">
		<tr>
			<td width="240" height="24"><p><strong>Je m'identifie:</strong></p>
			</td>
			<td width="500">&nbsp;</td>
		</tr>
	</table>
  
    <table  border="0">
	
		<tr>
		  <td width="240" height="24"><div align="right">Mon nom*</div></td>
		  <td width="500"><input name="nom" type="text" <?php echo "value=\"$nom\""; ?> ></td>
		</tr>
		<tr>
			<td width="240" height="24"><div align="right">Mon prénom*</div></td>
			<td width="500"><input name="prenom" type="text" <?php echo "value=\"$prenom\""; ?> ></td>
		</tr>
    
	</table>
	
	<hr/>
	
  

<p><strong>Pour me joindre:</strong></p>
<table  border="0">
  <tr>
    <td width="240" height="24"><div align="right">Mon adresse mail*      </div></td>
    <td width="500"><input type="text" name="mail" <?php echo "value=\"$mail\""; ?>></td>
  </tr>
</table>

	<table  border="0">
  <tr>
    <td width="240" height="24"><div align="right">Mon téléphone</div></td>
    <td width="500"><input type="text" name="tel" <?php if($tel==""){echo "value=\"\"";}else{echo "value=\"0$tel\"";} ?>><input name="afficher_tel"  type="checkbox" <?php if ($afficher_tel==1) {echo"checked";?> value="1"<?php } else {echo "unchecked"; ?> value="1" <?php }?>  >Afficher mon téléphone dans les annonces</td>
  </tr>
	</table>
<hr/>

<p><strong>Mon vehicule:</strong></p>
<?php
	include('connexion_SQL.php');
	$query2 = mysql_query("SELECT * FROM vehicule INNER JOIN conducteur ON vehicule.id_conducteur = conducteur.id_conducteur WHERE conducteur.id_utilisateur= $id_utilisateur") or die(mysql_error());
	mysql_close();
	$i=mysql_num_rows($query2);
	if($i!=0){
	
	$m=0;
	
	while ($vehicule= mysql_fetch_array($query2) ) {
		$m++;
		$id_vehi=$vehicule['id_vehicule'];
		$marque_vehi=$vehicule['marque_veh'];
		$couleur_vehi=$vehicule['couleur_veh'];
		$modele_vehi=$vehicule['modele_veh'];
		$immatriculation_vehi=$vehicule['immatriculation_veh'];
		$util_courante=$vehicule['util_courante'];
		
	
?>




	<table  border="0">
		<tr>
			<td width="240" height="24"><p><strong>véhicule <?php echo $m;?>:</strong></p>
			</td>
			<td width="500">&nbsp;</td>
		</tr>
	</table>
  
    <table  border="0">
	
		<tr>
		  <td width="80" height="24"><div align="right">La marque*</div></td>
		  <td width="260"><input name="marque<?php echo $m;?>" type="text" <?php echo "value=\"$marque_vehi\""; ?> ></td>
		  <td width="20" height="24"><div align="right">La couleur*</div></td>
		  <td width="500"><input name="couleur<?php echo $m;?>" type="text" <?php echo "value=\"$couleur_vehi\""; ?> ></td>
		</tr>
		
		<tr>
		  <td width="80" height="24"><div align="right">Le modele </div></td>
		  <td width="260"><input name="modele<?php echo $m;?>" type="text" <?php echo "value=\"$modele_vehi\""; ?> ></td>
		  <td width="20" height="24"><div align="right">L'immatriculation </div></td>
		  <td width="500"><input name="immatriculation<?php echo $m;?>" type="text" <?php echo "value=\"$immatriculation_vehi\""; ?> ><input name="util_courante<?php echo $m;?>"  type="checkbox" <?php if ($util_courante==1) {echo"checked"; } else {echo "unchecked"; }?> value="1" >Utilisation courante 
		</tr>
		
	</table>
		

		
	<input type="submit" name="suppr_<?php echo $id_vehi;?>"   value="supprimer cette voiture" onclick="return(confirm('Etes-vous sur de vouloir supprimer cette voiture?'));"/>	
    
	
<?php }
	?>	

<table  border="0">
		<tr>
			<td width="240" height="24"><p><strong>Ajouter un autre v�hicule :</strong></p>
			</td>
			<td width="500">&nbsp;</td>
		</tr>
	</table>



<table  border="0">
	
		<tr>
		  <td width="80" height="24"><div align="right">La marque*</div></td>
		  <td width="260"><input name="marque" type="text"  ></td>
		  <td width="20" height="24"><div align="right">La couleur*</div></td>
		  <td width="500"><input name="couleur" type="text" ></td>
		</tr>
		
		<tr>
		  <td width="80" height="24"><div align="right">Le mod�le </div></td>
		  <td width="260"><input name="modele" type="text" ></td>
		  <td width="20" height="24"><div align="right">L'immatriculation </div></td>
		  <td width="500"><input name="immatriculation" type="text"  ><input name="util_courante"  type="checkbox" value="1" >Utilisation courante </td>
		</tr>
		
	</table>

<?php }else{ ?>
	
	
<table  border="0">
		<tr>
			<td width="240" height="24"><p><strong>Ajouter un v�hicule :</strong></p>
			</td>
			<td width="500">&nbsp;</td>
		</tr>
	</table>


<table  border="0">
	
		<tr>
		  <td width="80" height="24"><div align="right">La marque*</div></td>
		  <td width="260"><input name="marque" type="text"  ></td>
		  <td width="20" height="24"><div align="right">La couleur*</div></td>
		  <td width="500"><input name="couleur" type="text" ></td>
		</tr>
		
		<tr>
		  <td width="80" height="24"><div align="right">Le mod�le </div></td>
		  <td width="260"><input name="modele" type="text" ></td>
		  <td width="20" height="24"><div align="right">L'immatriculation </div></td>
		  <td width="500"><input name="immatriculation" type="text"  ><input name="util_courante"  type="checkbox" value="1" >Utilisation courante </td>
		</tr>
		
	</table>
	

<?php } ?>
	<hr/>
<p>* champs obligatoires</p>

<BR>

<p>
  <input name="accord" type="checkbox" value="oui" <?php if ($modif != "") {echo"checked"; } else {echo "unchecked"; } ?> >
  J'accepte que mes coordonn�es soient communiqu�es aux usagers de ce site (dans tous les cas mon adresse mail ne sera pas visible sur le site)<br />
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ce site s'engage à ne pas communiquer vos donn�es à toute autre personne que les utilisateurs de ce site.<br />
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Je d�charge les créateurs de ce site de toute responsabilité en cas de problème survenu lors du covoiturage. 
  
  <br />
</p>
<blockquote>
  <p>
  <input type="submit" name="soumettre"  class="styled-button-12" value="Valider" /> 
<style type="text/css">
.styled-button-12 {
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
	 	 
	 width:100px;
}
</style>
   	 
  </p>
</blockquote>
</form>

</TD>
</TR>

</table>

