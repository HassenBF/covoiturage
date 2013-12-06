
<script type="text/javascript" language="Javascript" >

<!--
function verification1()
{
   if(document.formulaire.nom.value == "") {
   alert("Veuillez entrer votre nom svp");
   document.formulaire.nom.focus();
   return false;
  }
   else if(document.formulaire.prenom.value == "") {
   alert("Veuillez confirmer votre prenom svp");
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
 
   else if(document.formulaire.accord.checked == false) {
   alert("Veuillez accepter la difusion de vos coordonnées svp");
   document.formulaire.accord.focus();
   return false;
  } 
  
  	
return true
}
//-->
</script>

<?php

if ($_SESSION['loginOK']) {
?>

		
		
<form name="formulaire" action="enregistre_utilisateur.php" method="post" onSubmit="return verification1()">
  
  <table  border="0">
    <tr>
      <td width="240" height="24"><p><strong>Je m'inscrits:</strong></p>
      </td>
      <td width="500">&nbsp;</td>
  </tr>
  </table>
  
    <table  border="0">
		<tr>
			<td width="240" height="24">
				<div align="right">Mon nom*</div>
			</td>
			<td width="500">
				<input name="nom" type="text"  onFocus="javascript:this.value=''" >
			</td>
		</tr>
		<tr>
			<td width="240" height="24">
				<div align="right">Mon prénom*</div>
			</td>
			<td width="500">
				<input type="text" name="prenom"  >
			</td>
		</tr>
		<tr>
			<td width="240" height="24">
				<div align="right">Mon mail*</div>
			</td>
			<td width="500">
				<input type="text" name="mail" >
			</td>
		</tr>
	  <tr>
			<td width="240" height="24"><div align="right">Mon téléphone</div></td>
			<td width="500"><input type="text" name="tel" ><input name="afficher_tel"  type="checkbox"  value="1" >Afficher mon téléphone dans les annonces</td>
	  </tr>
	</table>
	
	
	
  <hr/>
	

<p>* champs obligatoires</p>

<BR>

<p>
  <input name="accord" type="checkbox" value="oui" "unchecked" >
  J'accepte que mes coordonnées soient communiquées aux usagers de ce site (dans tous les cas mon adresse mail ne sera pas visible sur le site)<br />
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ce site s'engage à ne pas communiquer vos données à toute autre personne que les utilisateurs de ce site.<br />
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Je decharge les createurs de ce site de toute responsabilité en cas de problème survenu lors du covoiturage. 
  
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
	 	 float:right;
	 width:100px;
}
</style>
   	 
  </p>
</blockquote>


</TD>
</TR>

</table>
</form>
<?php } ?>
