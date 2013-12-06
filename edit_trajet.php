<?php

$modif="";
if(isset($_GET['modif'])){
$modif=$_GET['modif'];
}
if(isset($_GET['num_trajet'])){
$trajet=$_GET['num_trajet'];
}
$ponct=1;
if(isset($_GET['ponct'])){
$ponct=$_GET['ponct'];
}
$type_trajet="";

if ($ponct == 2) {
	$type_trajet="r�gulier";
}
if ($ponct== 1) {
	$type_trajet="ponctuel";
}
?>


 
<?php
	$ville1="";
	$ville2="";
	$heure="hh:mm";
	$date_trajet="";
	$coment="";
	$freq_trajet="";	
	

if ($_SESSION['loginOK'] == true AND $modif == 1) {
	
	$username=$_SESSION['pseudo'];
		
	include('connexion_SQL.php');
		
	$reponse = mysql_query("SELECT * FROM trajet WHERE num_trajet='$trajet'") or die(mysql_error());
		
	while ($donnees = mysql_fetch_array($reponse) ) {
		$ville1=$donnees['ville_depart'];
		$ville2=$donnees['ville_arrivee'];
		$heure=$donnees['heure'];
		$trajet_reg=$donnees['trajet_reg'];
		$date_trajet=$donnees['date_trajet'];
		$nbr_places=$donnees['nbr_place_dispo'];
		$veh_id=$donnees['id_vehicule'];
		$coment=$donnees['coment'];
		$freq_trajet =$donnees['freq_trajet_reg'];
		}
		
	mysql_close();
	}
	
	else {
		$modif = "";
		}

		?>

			
<form name="formulaire" action="index.php?enregistre_trajet&modif=1" method="post" onSubmit="return verification()">
<p><strong>Mon trajet:</strong></p>
<INPUT TYPE="hidden" NAME="id_trajet" VALUE="<?php echo $trajet; ?>">

</br>
<input type='hidden' name='enregistre_trajet'/>
<table  border="0">
  <tr>
    <td width="240" height="24"><div align="right">Ville de départ * </div></td>
    <td width="500"> 
		<SELECT name="ville1">
			<OPTION <?php if ($ville1 == "") {echo"selected";} ?> VALUE=""></OPTION>
<?php
include('connexion_SQL.php');
$query1 = mysql_query("SELECT * FROM ville ") or die(mysql_error());
while ($ville = mysql_fetch_array($query1) ) { ?>
		
			<OPTION <?php if ($ville1 == $ville['nom_ville']) {echo"selected";} ?> VALUE="<?php echo $ville['nom_ville'];?>"><?php echo $ville['nom_ville'];?></OPTION>
			
<?php	}
mysql_close();
?>		
		</SELECT>
	</td>
  </tr>
</table>

<table  border="0">
  <tr>
    <td width="240" height="24"><div align="right">Ville d'arrivée * </div></td>
    <td width="500">
		<SELECT name="ville2">
			<OPTION <?php if ($ville2 == $ville['nom_ville']) {echo"selected";} ?> VALUE=""></OPTION>
<?php
include('connexion_SQL.php');
$query2 = mysql_query("SELECT * FROM ville ") or die(mysql_error());
while ($ville = mysql_fetch_array($query2) ) { ?>
		
			<OPTION <?php if ($ville2 == $ville['nom_ville']) {echo"selected";} ?> VALUE="<?php echo $ville['nom_ville'];?>"><?php echo $ville['nom_ville'];?></OPTION>
			
<?php	}
mysql_close();
?>		
		</SELECT>
	</td>
  </tr>
</table>

<table  border="0">
  <tr>
    <td width="240" height="24"><div align="right">Date de départ * </div></td>
    <td width="500"><input type="text" id="De" name="date_trajet" autocomplete = "off" <?php echo "value=\"$date_trajet\" onFocus=\"javascript:this.value=''\""; ?> ><input name="trajet_reg" id="reg" type="checkbox" value="1" <?php if ($trajet_reg!= 0) {echo"checked"; } else {echo "unchecked"; } ?> onchange="periode1();" >Trajet régulier </td>
	
	
  </tr>
</table>
<?php if($trajet_reg == 0){?>
<div id="periode1" style="display:none;"><br>
<table  border="0">
  <tr>
    <td width="100" height="24"><div align="right">saisir la période de votre trajet régulier: </div></td>
    <td width="210">DE&nbsp;&nbsp;&nbsp;<input type="text" id="De2" name="debt_periode" autocomplete = "off" <?php echo "value=\"\" onFocus=\"javascript:this.value=''\"" ?> >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;A</td>
	<td width="210"><input type="text" id="A2" name="fin_periode" autocomplete = "off" <?php echo "value=\"\" onFocus=\"javascript:this.value=''\"" ?> ></td>
	
  </tr>
</table>

<table  border="0">
  <tr>
		<td width="240" height="24"><div align="right">la fréquence de vos trajets réguliers*: tous les  </div></td>
		<td width="500">	
				<select name="freq_trajet"> 
					<option <?php if ($freq_trajet == 1) {echo"selected";} ?> VALUE="1"> 1</option> 
					<option <?php if ($freq_trajet == 2) {echo"selected";} ?> VALUE="2"> 2</option> 
					<option <?php if ($freq_trajet == 3) {echo"selected";} ?> VALUE="3"> 3</option>
					<option <?php if ($freq_trajet == 4) {echo"selected";} ?> VALUE="4"> 4</option>
					<option <?php if ($freq_trajet == 5) {echo"selected";} ?> VALUE="5"> 5</option>
					<option <?php if ($freq_trajet == 6) {echo"selected";} ?> VALUE="6"> 6</option>
					<option <?php if ($freq_trajet == 7) {echo"selected";} ?> VALUE="7"> 7</option>
				</select> jour(s)
		</td>
  </tr>
</table>

</div>
<?PHP }?>
<table  border="0">
  <tr>
    <td width="240" height="24"><div align="right">Heure de départ * </div></td>
    <td width="500"><input type="TIME" name="heure" <?php echo "value=\"$heure\""; ?> onFocus="javascript:this.value=''"> hh:mm ou "variable"</td>
	
  </tr>
</table>

<table  border="0">
  <tr>
    <td width="240" height="24"><div align="right">Nombre de place * </div></td>
    <td width="500"><select name="nbr_places" > 
						<option <?php if ($nbr_places == 1) {echo"selected";} ?> VALUE="1"> 1</option> 
						<option <?php if ($nbr_places == 2) {echo"selected";} ?> VALUE="2"> 2</option> 
						<option <?php if ($nbr_places == 3) {echo"selected";} ?> VALUE="3"> 3</option>
						<option <?php if ($nbr_places == 4) {echo"selected";} ?> VALUE="4"> 4</option>
						<option <?php if ($nbr_places == 5) {echo"selected";} ?> VALUE="5"> 5</option>						
					</select> 
	</td>
	
  </tr>
</table>
<?php
	include('connexion_SQL.php');
	$query2 = mysql_query("SELECT * FROM vehicule INNER JOIN conducteur ON vehicule.id_conducteur = conducteur.id_conducteur WHERE conducteur.id_utilisateur= $id_utilisateur") or die(mysql_error());
	mysql_close();
	$i=mysql_num_rows($query2);
	if($i!=0){
	?>
<table  border="0">
  <tr>
    <td width="240" height="24"><div align="right">Vehicule * </div></td>
    <td width="500">
	
		<SELECT name="vehicule" id="le_select" onchange="ajouter_veh();">
			<OPTION VALUE=""></OPTION>
			<?php
			$check=false;
			while ($vehicule= mysql_fetch_array($query2) ) { ?>
		
			<OPTION <?php if ($veh_id == $vehicule['id_vehicule']){?> selected="selected" value="<?php echo $vehicule['id_vehicule'];?>" <?php $check=true;}else{?> value="<?php echo $vehicule['id_vehicule']; ?>" <?php }?>><?php echo $vehicule['marque_veh']." - ".$vehicule['modele_veh']." - ".$vehicule['couleur_veh'];?></OPTION>
			<?php	}?>
				<OPTION VALUE="autre" >autre</OPTION>
		</SELECT>
		
	</td>
	
  </tr>
</table>
<div id="ajout_veh" style="display:none;"><br>
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
</div>
<?php }else{ ?>

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
		  <td width="500"><input name="immatriculation" type="text"  ><input name="util_courante"  type="checkbox" value="oui" >Utilisation courante </td>
		</tr>
		
	</table>
<?php } ?>


</br>
<table  border="0">
  <tr>
    <td width="240" height="24"><div align="right">Commentaires</div></td>
    <td width="500"><TEXTAREA rows="4" cols="40" name="coment"><?php echo "$coment"; ?></TEXTAREA></td>
  </tr>
</table>

<p>* champs obligatoires</p>

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
	 float:right;
	 width:100px;
}
</style>
 
<input type="button" value="Annuler"  onClick="javascript:document.location.href='index.php?accueil'" >
</p>
</form>

