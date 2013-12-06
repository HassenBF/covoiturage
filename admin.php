<?php

// include_once('CAS-1.3.2/CAS.php');

//phpCAS::setDebug('/tmp/phpCAS.log'); // Schrijft debug informatie naar een log-file

// Parameters: CAS version, CAS server url, CAS server port, CAS server URI (same as host), 
// boolean indicating session start, communication protocol (SAML) between application and CAS server
// phpCAS::client(SAML_VERSION_1_1,'cas.utbm.fr',443,'', true, '/cas');

// Server from which logout requests are sent
//phpCAS::handleLogoutRequests(true, array('cas1.ugent.be','cas2.ugent.be','cas3.ugent.be','cas4.ugent.be','cas5.ugent.be','cas6.ugent.be'));

// Configuration of the CAS server certificate
// phpCAS::setExtraCurlOption(CURLOPT_SSLVERSION, 3);
// Path to the "trusted certificate authorities" file:
//phpCAS::setCasServerCACert('');
// No server verification (less safe!):
// phpCAS::setNoCasServerValidation();
// The actual user authentication
// phpCAS::forceAuthentication(); 

		$username='antieche';
		$_SESSION['pseudo'] = $username;
		$_SESSION['loginOK'] = true;
		include('connexion_SQL.php');
		
		$query1 = mysql_query("SELECT * FROM utilisateur WHERE pseudo=UPPER('$username')") or die(mysql_error());
		
		while ($donnees = mysql_fetch_array($query1) ) {
			$id_utilisateur = $donnees['id_utilisateur'];
			$_SESSION['id_utilisatuer'] = $id_utilisateur;
		}
		
		mysql_close();
		
		

// Handle logout requests
if (isset($_REQUEST['logout'])) {
		session_unset();
		phpCAS::logoutWithRedirectService('http://localhost/covoiturage v0.7/index.php');
		 
		
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php

if(!isset($_SESSION)) 
    { 
        session_start();
		
    } 
	
	
	if((isset($_POST['ville1']) and !empty($_POST['ville1'])) || (isset($_POST['ville2']) AND !empty($_POST['ville2'])) || (isset($_POST['date_trajet']) and !empty($_POST['date_trajet']) ) || (isset($_POST['heure']) and !empty($_POST['heure']))){
		$ville1=mysql_real_escape_string(htmlspecialchars($_POST['ville1']));
		$ville2=mysql_real_escape_string(htmlspecialchars($_POST['ville2']));
		$date_trajet=mysql_real_escape_string(htmlspecialchars($_POST['date_trajet']));
		$heure=mysql_real_escape_string(htmlspecialchars($_POST['heure']));
		
	}else{
		$ville1="";
		$ville2="";
		$heure="hh:mm";
		$date_trajet="";
	}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=UTF-8"/> 
<title>BuildUp Real Estate</title>
	<link rel="stylesheet" type="text/css" href="style.css" />
	<link rel="stylesheet" type="text/css" href="jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="demos.css">
	<script src="jquery-1.5.1.js"></script>
	<script src="jquery.ui.core.js"></script>
	<script src="jquery.ui.widget.js"></script>
	<script src="jquery.ui.datepicker.js"></script>
	
	
	<script language="Javascript">
// ==================
//	Activations - Désactivations
// ==================
function GereControle(Controleur, Controle, Masquer) {
var objControleur = document.getElementById(Controleur);
var objControle = document.getElementById(Controle);
	if (Masquer=='1')
		objControle.style.visibility=(objControleur.checked==true)?'visible':'hidden';
	else
		objControle.disabled=(objControleur.checked==true)?false:true;
	return true;
}
</script>
	
	<script> 
		$(function() {
			$( "#datepicker1" ).datepicker({ minDate: -0 });
			//$( "#De" ).datepicker({ minDate: -0 });
			var dates = $( "#De, #A" ).datepicker({ 
					defaultDate: "+1w",
					changeMonth: false,
					numberOfMonths: 1,
					onSelect: function( selectedDate ) {
						var option = this.id == "De" ? "minDate" : "maxDate",
							instance = $( this ).data( "datepicker" ),
							date = $.datepicker.parseDate(
								instance.settings.dateFormat ||
								$.datepicker._defaults.dateFormat,
								selectedDate, instance.settings );
						dates.not( this ).datepicker( "option", option, date );
					}
				});
				
		});
		$(function() {
			
			var dates = $( "#De2, #A2" ).datepicker({ 
					defaultDate: "+1w",
					changeMonth: false,
					numberOfMonths: 1,
					onSelect: function( selectedDate ) {
						var option = this.id == "De2" ? "minDate" : "maxDate",
							instance = $( this ).data( "datepicker" ),
							date = $.datepicker.parseDate(
								instance.settings.dateFormat ||
								$.datepicker._defaults.dateFormat,
								selectedDate, instance.settings );
						dates.not( this ).datepicker( "option", option, date );
					}
				});
				
		});
		$(function() {
			
			var dates = $( "#De3, #A3" ).datepicker({ 
					defaultDate: "+1w",
					changeMonth: false,
					numberOfMonths: 1,
					onSelect: function( selectedDate ) {
						var option = this.id == "De3" ? "minDate" : "maxDate",
							instance = $( this ).data( "datepicker" ),
							date = $.datepicker.parseDate(
								instance.settings.dateFormat ||
								$.datepicker._defaults.dateFormat,
								selectedDate, instance.settings );
						dates.not( this ).datepicker( "option", option, date );
					}
				});
				
		});
	</script> 

</head>
<body>
<div id="main_container">

<div id="header">

       <div id="logo">
        <a href="index.html"><img src="images/carpool-masthead.png" width="147" height="78" alt="" title="" border="0" /></a>
       </div>
           
       <div class="banner_adds"></div>    


<div class="menu">

<ul>
<li><a href="index.php?accueil">Acceuil</a></li>
<?php
include('connexion_SQL.php');
		
		$response1 = mysql_query("select id_utilisateur from utilisateur where pseudo='$username'") or die(mysql_error());
		$j= mysql_num_rows($response1);	
				
if (isset($_SESSION['loginOK']) && $j != 0 ) {
?>
<li><a href="javascript:document.location.href='index.php?modif=1&edit_profile'">Modifier mes donnéees</a></li>
<li ><a href="javascript:document.location.href='index.php?add_trajet'">Saisir un trajet</a></li>
<li><a href="javascript:document.location.href='index.php?gestion_mes_trajet'">Gérer mes trajet </a></li>
<li><a href="javascript:document.location.href='index.php?gestion_mes_reservations'">Gérer mes réservations </a></li>
<?php
$verif_admin = mysql_query("SELECT * FROM admin WHERE id_utilisateur = $id_utilisateur;") or die(mysql_error());
$l= mysql_num_rows($verif_admin);
if($l){
?>
<li><a href="admin.php">Admin</a></li>
<?php }
}

$verif_admin = mysql_query("SELECT * FROM admin WHERE id_utilisateur = 3;") or die(mysql_error());
$l= mysql_num_rows($verif_admin);
if($l){
?>
<li><a href="admin.php">Admin</a></li>
<?php } ?>

</ul>
</div>
</div>
    

    
    <div id="main_content"> 
    	<div class="column1">
        
        
        	<div class="left_box">
            	<div class="top_left_box">
                </div>
                <div style="padding-left: 10px;" class="center_left_box">
                	<div class="box_title"><span>Votre</span> Espace</div>
                    
 
                 	
<?php

	  		if (isset($_SESSION['loginOK'])) {
				
				echo "Votre espace : "; 
				echo"<STRONG>";
				echo $_SESSION['pseudo'];
				echo"</STRONG>";
				echo "<BR><BR>";
				echo "</strong>"; ?>
				<input type="submit" class="styled-button-6" value="Déconnecter" onclick="javascript:document.location.href='?logout='" />
				
<?php				include('connexion_SQL.php');
							
				$reponse = mysql_query("SELECT trajet.id_conducteur FROM trajet INNER JOIN utilisateur ON trajet.id_conducteur = utilisateur.id_utilisateur WHERE utilisateur.pseudo = '$username';") or die (mysql_error());
				$n = mysql_num_rows($reponse);	
				mysql_close(); ?>
							
<form action="index.php" method="post" >
	</br>
	<STRONG>Chercher un trajet </strong></br><br/>
	<table><tr><td>
	<label>Départ :</label>
	<input type="hidden" name="rech" /></td><td>
	<SELECT name="ville1">
		<OPTION <?php if ($ville1 == "") {echo"selected";} ?> VALUE=""></OPTION>
		<?php
		include('connexion_SQL.php');
		$query1 = mysql_query("SELECT * FROM ville ") or die(mysql_error());
		while ($ville_depart = mysql_fetch_array($query1) ) { ?>
				
		<OPTION <?php if ($ville1 == $ville_depart['nom_ville']) {echo"selected";} ?> VALUE="<?php echo $ville_depart['nom_ville'];?>"><?php echo $ville_depart['nom_ville'];?></OPTION>
					
		<?php	}
		mysql_close();
		?>		
	</SELECT></td></tr>
		
	<!-- <input type="text" name="ville1" value="" onFocus="javascript:this.value=''" size="15"> -->
	<tr><td>
	<label>Arrivée :</label>
	<input type="hidden" name="rech" /></td><td>
	
	<SELECT name="ville2">
		<OPTION <?php if ($ville2 == "") {echo"selected";} ?> VALUE=""></OPTION>
		<?php
		include('connexion_SQL.php');
		$query2 = mysql_query("SELECT * FROM ville ") or die(mysql_error());
		while ($ville_arrivee = mysql_fetch_array($query2) ) { ?>
		<OPTION <?php if ($ville2 == $ville_arrivee['nom_ville']) {echo"selected";} ?> VALUE="<?php echo $ville_arrivee['nom_ville'];?>"><?php echo $ville_arrivee['nom_ville'];?></OPTION>	
		<?php	}
	mysql_close();
?>		
	</SELECT></td></tr><tr><td>
		
	<!-- <input type="text" name="ville2" value="Sevenans" value="Belfort" onFocus="javascript:this.value=''" size="15"> -->
	
	<label>Date :</label></td><td>
	<input type="text" id="datepicker1"  autocomplete = "off" name="date_trajet" value="<?php echo $date_trajet; ?>" onFocus="javascript:this.value=''" size="15"> 
	 </td></tr><tr><td>
	
	<label>Horaire : </label></td>
	<td>
	<SELECT name="heure">
		<OPTION <?php if ($heure == "tous") {echo"selected";} ?> VALUE="tous">Tous</OPTION>
		<OPTION <?php if ($heure == "00:00") {echo"selected";} ?> VALUE="00:00">00:00</OPTION>
		<OPTION <?php if ($heure == "00:30") {echo"selected";} ?> VALUE="00:30">00:30</OPTION>
		<OPTION <?php if ($heure == "01:00") {echo"selected";} ?> VALUE="01:00">01:00</OPTION>
		<OPTION <?php if ($heure == "01:30") {echo"selected";} ?> VALUE="01:30">01:30</OPTION>
		<OPTION <?php if ($heure == "02:00") {echo"selected";} ?> VALUE="02:00">02:00</OPTION>
		<OPTION <?php if ($heure == "02:30") {echo"selected";} ?> VALUE="02:30">02:30</OPTION>
		<OPTION <?php if ($heure == "03:00") {echo"selected";} ?> VALUE="03:00">03:00</OPTION>
		<OPTION <?php if ($heure == "03:30") {echo"selected";} ?> VALUE="03:30">03:30</OPTION>
		<OPTION <?php if ($heure == "04:00") {echo"selected";} ?> VALUE="04:00">04:00</OPTION>
		<OPTION <?php if ($heure == "04:30") {echo"selected";} ?> VALUE="04:30">04:30</OPTION>
		<OPTION <?php if ($heure == "05:00") {echo"selected";} ?> VALUE="05:00">05:00</OPTION>
		<OPTION <?php if ($heure == "05:30") {echo"selected";} ?> VALUE="05:30">05:30</OPTION>
		<OPTION <?php if ($heure == "06:00") {echo"selected";} ?> VALUE="06:00">06:00</OPTION>
		<OPTION <?php if ($heure == "06:30") {echo"selected";} ?> VALUE="06:30">06:30</OPTION>
		<OPTION <?php if ($heure == "07:00") {echo"selected";} ?> VALUE="07:00">07:00</OPTION>
		<OPTION <?php if ($heure == "07:30") {echo"selected";} ?> VALUE="07:30">07:30</OPTION>
		<OPTION <?php if ($heure == "08:00") {echo"selected";} ?> VALUE="08:00">08:00</OPTION>
		<OPTION <?php if ($heure == "08:30") {echo"selected";} ?> VALUE="08:30">08:30</OPTION>
		<OPTION <?php if ($heure == "09:00") {echo"selected";} ?> VALUE="09:00">09:00</OPTION>
		<OPTION <?php if ($heure == "09:30") {echo"selected";} ?> VALUE="09:30">09:30</OPTION>
		<OPTION <?php if ($heure == "10:00") {echo"selected";} ?> VALUE="10:00">10:00</OPTION>
		<OPTION <?php if ($heure == "10:30") {echo"selected";} ?> VALUE="10:30">10:30</OPTION>
		<OPTION <?php if ($heure == "11:00") {echo"selected";} ?> VALUE="11:00">11:00</OPTION>
		<OPTION <?php if ($heure == "11:30") {echo"selected";} ?> VALUE="11:30">11:30</OPTION>
		<OPTION <?php if ($heure == "12:00") {echo"selected";} ?> VALUE="12:00">12:00</OPTION>
		<OPTION <?php if ($heure == "12:30") {echo"selected";} ?> VALUE="12:30">12:30</OPTION>
		<OPTION <?php if ($heure == "13:00") {echo"selected";} ?> VALUE="13:00">13:00</OPTION>
		<OPTION <?php if ($heure == "13:30") {echo"selected";} ?> VALUE="13:30">13:30</OPTION>
		<OPTION <?php if ($heure == "14:00") {echo"selected";} ?> VALUE="14:00">14:00</OPTION>
		<OPTION <?php if ($heure == "14:30") {echo"selected";} ?> VALUE="14:30">14:30</OPTION>
		<OPTION <?php if ($heure == "15:00") {echo"selected";} ?> VALUE="15:00">15:00</OPTION>
		<OPTION <?php if ($heure == "15:30") {echo"selected";} ?> VALUE="15:30">15:30</OPTION>
		<OPTION <?php if ($heure == "16:00") {echo"selected";} ?> VALUE="16:00">16:00</OPTION>
		<OPTION <?php if ($heure == "16:30") {echo"selected";} ?> VALUE="16:30">16:30</OPTION>
		<OPTION <?php if ($heure == "17:00") {echo"selected";} ?> VALUE="17:00">17:00</OPTION>
		<OPTION <?php if ($heure == "17:30") {echo"selected";} ?> VALUE="17:30">17:30</OPTION>
		<OPTION <?php if ($heure == "18:00") {echo"selected";} ?> VALUE="18:00">18:00</OPTION>
		<OPTION <?php if ($heure == "18:30") {echo"selected";} ?> VALUE="18:30">18:30</OPTION>
		<OPTION <?php if ($heure == "19:00") {echo"selected";} ?> VALUE="19:00">19:00</OPTION>
		<OPTION <?php if ($heure == "19:30") {echo"selected";} ?> VALUE="19:30">19:30</OPTION>
		<OPTION <?php if ($heure == "20:00") {echo"selected";} ?> VALUE="20:00">20:00</OPTION>
		<OPTION <?php if ($heure == "20:30") {echo"selected";} ?> VALUE="20:30">20:30</OPTION>
		<OPTION <?php if ($heure == "21:00") {echo"selected";} ?> VALUE="21:00">21:00</OPTION>
		<OPTION <?php if ($heure == "21:30") {echo"selected";} ?> VALUE="11:30">21:30</OPTION>
		<OPTION <?php if ($heure == "22:00") {echo"selected";} ?> VALUE="22:00">22:00</OPTION>
		<OPTION <?php if ($heure == "22:30") {echo"selected";} ?> VALUE="22:30">22:30</OPTION>
		<OPTION <?php if ($heure == "23:00") {echo"selected";} ?> VALUE="23:00">23:00</OPTION>
		<OPTION <?php if ($heure == "23:30") {echo"selected";} ?> VALUE="23:30">23:30</OPTION>
	</SELECT>
	&nbsp;&nbsp;
	</td>	</tr>
	</table>
	<p>
   	    <input type="submit" name="soumettre" class="styled-button-12" value="Rechercher"> 
	</p>
</form>
			
		
				<!--  -->
<style type="text/css">
.styled-button-6 {
	background:#f78096;
	background:-moz-linear-gradient(top,#f78096 0%,#f56778 100%);
	background:-webkit-gradient(linear,left top,left bottom,color-stop(0%,#f78096),color-stop(100%,#f56778));
	background:-webkit-linear-gradient(top,#f78096 0%,#f56778 100%);
	background:-o-linear-gradient(top,#f78096 0%,#f56778 100%);
	background:-ms-linear-gradient(top,#f78096 0%,#f56778 100%);
	background:linear-gradient(top,#f78096 0%,#f56778 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#f78096',endColorstr='#f78096',GradientType=0);
	padding:5px 4px;
	color:#fff;
	font-family:'Helvetica Neue',sans-serif;
	font-size:12px;
	border-radius:4px;
	-moz-border-radius:4px;
	-webkit-border-radius:4px;
	border:1px solid #ae4553;
	 cursor: pointer;
}
.styled-button-6:hover{
background:#f22096;
}
</style>
				<?php
				}
				
				else {
				echo "$username";
				//echo "$_SESSION[\'pseudo\']";
				
				?>
		
			
		<form action="verif_login.php?accueil" method="post" class="form" >
		 <div class="form_row">
		 <label class="left">User :</label><input type="text" name="pseudo" size="18"
		value=" <?php if(isset($_COOKIE['pseudo'])){echo $_COOKIE['pseudo'] ;} ?>"
		onFocus="javascript:this.value=''"></div>
		
		 <div class="form_row">
		 <label class="left">Password :</label><input type="password" name="password" onFocus="javascript:this.value=''" size="18" ></div>
		

		  <div style="float:right; padding:10px 25px 0 0;">
                    <input type="image" src="images/login.gif">
                    </div>
      	</form>
		<br/>	<br/>	<br/>	<br/>
		<div class="more" style="margin-top: 40px;margin-right: 30px;">
         <a href="oublimdp.php" class="pink" >Identifiants oubli&eacute;s ?</a>
		 <br/>
		<a href="saisir_donnees_perso.php" class="pink">S'inscrire</a>
		</div>
		
<?php } ?>
                
                </div>
                <div class="bottom_left_box">
                </div>
            </div>
            
            
 
        	<div class="left_box">
            	<div class="top_left_box">
                </div>
                <div class="center_left_box">
                	<div class="box_title"><span>Derniers</span> evenements</div>
					
					<table name="evenements">  
                    <?php 			
					include('connexion_SQL.php');
					$result4 = mysql_query("SELECT desc_even  FROM evenement") or die(mysql_error());		
					$i= mysql_num_rows($result4);
					if($i == 0)
					{
					?>
						<div align="center" style="color:#FB1313;"><strong><big>
						Aucun évènement
						</big></strong></div>
					<?php
					}
					else
					{					
					while ($row4 = mysql_fetch_array($result4)) 
					{
					?>
					<div align="center" style="color:#036700;">
						<big><b><cols  VALUE="<?php echo $row4['desc_even'] ;  ?>"><?php echo $row4['desc_even'] ;  ?></cols> </big>
					</div>
					<?php 
					}
					}
					
					mysql_close();
					?>	
					</table>					          
                
                </div>
                <div class="bottom_left_box">
                </div>
            </div>  
 
 
        	<div class="left_box">
            	<div class="top_left_box">
                </div>
                <div class="center_left_box">
                	<div class="box_title"><span>Contact</span> information:</div>
                    
                    
                    <div class="form">
                    <div class="form_row">
                    	<img src="images/contact_envelope.gif" width="50" height="47" border="0" class="img_right" alt="" title="" />
                        <div class="contact_information">
                        Email: <br />
                        Telephone:  <br />
                        Mobile:     <br />
                        Fax:       <br /><br />
                        
                        <span>www.utbm.fr</span>
                        </div>
                    </div>                    
                    </div>
                
                
                </div>
                <div class="bottom_left_box">
                </div>
            </div>  
			</div><!-- end of column one -->
			
			
			  	<?php
if (isset($_SESSION['loginOK']) && $j != 0 ) {
if(isset($_GET['edit_profile']) ){ ?>	
		
	<div class="column4">
        
        <div class="title">Modifier mes données </div> 
		<?php
			include('edit_profile.php');
			
		?>
	</div>
<?php } ?>


<div class="column4">

    <div class="title">Ajout d'un nouveau site </div> 
	<table  border="0">
		<tr> <td width="240" height="24"><p><strong>Ajout d'un nouveau site</strong></p> </td>
			<td width="500">&nbsp;</td>
		
		</tr>
		</table>
  
		<form action="add_site.php" method="post">
			<!--<td width="500"><input type="text" id="De" name="new_site" autocomplete = "off" ><input name="trajet_reg" id="reg" type="checkbox" value="1"onchange="periode11();" >Site régulier </td> <br/>	<br/>-->
			<td width="500" height="240"><input name="new_site" type="text" ></td> 
			<input type="checkbox" id="chkb_10" onClick="GereControle('chkb_10', 'A2', '1');GereControle('chkb_10', 'A1', '1');" CHECKED>&nbsp;<label for="chkb_10">Site temporaire</label><br/>	<br/>	
			<td width="500">&nbsp;</td>
			
			
			

<strong id="A1">Saisir la date de validité du site   :</strong><input type="text" id="A2" name="fin_periode" autocomplete = "off" <?php echo "value=\"\" onFocus=\"javascript:this.value=''\"" ?> ></td>

<br /><br />
			
					
			<input type="submit" name="envoyer" value="Valider" />
			<input type="button" value="Annuler"  onClick="javascript:document.location.href='index.php?accueil'" />
		</form>
		
		<table  border="0">
			<tr><td height="8"></td></tr>
		</table>
		
		
		
    <div class="title">Suppression d'un site </div> 		
	<table  border="0">
		<tr> <td width="240" height="24"><p><strong>Supprimer un site</strong></p> </td>
			<td width="500">&nbsp;</td>
		</tr>
	</table>
  
		<form action="del_site.php" method="post">
			<SELECT name="ville_del">		
				<?php 			
				include('connexion_SQL.php');
				$result4 = mysql_query("SELECT nom_ville  FROM ville") or die(mysql_error());		
				while ($row4 = mysql_fetch_array($result4)) {
				?>
				<OPTION  VALUE="<?php echo $row4['nom_ville'] ;  ?>"><?php echo $row4['nom_ville'] ;  ?></OPTION>
				<?php 
				}
				mysql_close();
				?>			
			</SELECT>
			<div id="reponse">
			
			</div>
		<br/>
		<td width="500">&nbsp;</td>			
		<input type="submit" name="Envoyer" value="Valider" />
		<input type="button" value="Annuler"  onClick="javascript:document.location.href='index.php?accueil'" />
		</form>
		
		<table  border="0">
			<tr><td height="8"></td></tr>
		</table>
		
		<div class="title">Ajout d'un nouvel évènement </div> 
		<table  border="0">
		<tr><td width="240" height="24"><p><strong>Ajout d'un évènement</strong></p> </td>
			<td width="500">&nbsp;</td>
		</tr>
		</table>
  
		<form action="add_events.php" method="post">
			<td width="500"><input name="new_event" type="text" /></td>
			<td width="500">&nbsp;</td>				
			<br/>	
			<br/>	
			<input type="submit" name="envoyer" value="Valider" />
			<input type="button" value="Annuler"  onClick="javascript:document.location.href='index.php?accueil'" />
		</form>
		
		
		<table  border="0">
			<tr><td height="8"></td></tr>
		</table>
		
		<div class="title">Suppression d'un évènement </div> 		
		<table  border="0">
		<tr> <td width="240" height="24"><p><strong>Supprimer un évènement</strong></p> </td>
			<td width="500">&nbsp;</td>
		</tr>
		</table>
  
		<form action="del_events.php" method="post">
			<SELECT name="ville_del">		
				<?php 			
				include('connexion_SQL.php');
				$result4 = mysql_query("SELECT desc_even  FROM evenement") or die(mysql_error());		
				while ($row4 = mysql_fetch_array($result4)) {
				?>
				<OPTION  VALUE="<?php echo $row4['desc_even'] ;  ?>"><?php echo $row4['desc_even'] ;  ?></OPTION>
				<?php 
				}
				mysql_close();
				?>			
			</SELECT>
			<div id="reponse">
			
			</div>
		<br/>
		<td width="500">&nbsp;</td>			
		<input type="submit" name="Envoyer" value="Valider" />
		<input type="button" value="Annuler"  onClick="javascript:document.location.href='index.php?accueil'" />
		</form>
		
		
		<table  border="0">
			<tr><td height="8"></td></tr>
		</table>


<?php
if(isset($_GET['detail_projet'])){ ?>	
		
	<div class="column4">
        
        <div class="title">Détails trajet</div> 
		<?php
			include('contact.php');
		?>
	</div>
<?php } ?>

<?php
if(isset($_GET['supprimer_trajet'])){ ?>	
		
	<div class="column4">
    <?php
		include('supprimer_trajet.php');
	?>
	</div>
<?php } ?>

<?php
if(isset($_GET['supprimer_reservation'])){  ?>	
		
	<div class="column4">
    <?php
		include('supprimer_reservation.php');
		
	?>
	</div>
<?php } ?>



			  	<?php
if(isset($_GET['edit_trajet'])){ ?>	
		
		   		<div class="column4">
        
        <div class="title">Modifier un trajet </div> 
		<?php
include('edit_trajet.php');
		?>
</div>
<?php } ?>

<?php 
if(isset($_GET['reserver'])){ ?>	
		
		   		<div class="column4">
        
        <div class="title">Reservation</div> 
		<?php
include('reserver_trajet.php');
		?>
</div>
<?php } ?>


<?php
if(isset($_GET['gestion_mes_trajet'])){ ?>	
		
		   		<div class="column4">
        
        <div class="title">Gestion de mes trajet </div> 
		<?php
include('gestion_mes_trajets.php');
		?>
</div>
<?php } ?>
<?php
if(isset($_GET['gestion_mes_reservations'])){ ?>	
		
		   		<div class="column4">
        
        <div class="title">Gestion de mes rémservations </div> 
		<?php
include('gestion_mes_reservations.php');
		?>
</div>
<?php } ?>


			  	<?php
if(isset($_GET['add_trajet'])){ ?>	
		
		   		<div class="column4">
        
<div class="title">Ajouter un trajet </div> 
		<?php
include('add_trajet.php');
		?>
</div>
<?php } ?>


			  	<?php
if(isset($_GET['enregistre_trajet'])){ ?>	
		
		   		<div class="column4">
        
		<?php
include('enregistre_trajet.php');
		?>
</div>
<?php } ?>
<?php 
if(isset($_GET['frame_gauche'])){ 	
		
		include('frame_gauche.php');
		
} ?>


<!-- end of column four -->	

		
	<?php
if(isset($_POST['rech'])){ ?>	
		
		   		<div class="column4">
        
        <div class="title">Liste de trajet </div> 
	<?php include('result_search.php');?>
<?php } ?>
</div>

<?php
if(!isset($_POST['rech']) && isset($_GET['accueil'])){ ?>	
		
		   		<div class="column4">
        
        <div class="title">Liste de trajet </div> 
	<?php include('result_search.php');?>
<?php } ?>
</div>

<?php }else{ ?>
<div class="column4">
        
<div class="title"> Enregistrement </div> 
		<?php
include('enregistrement.php');
		?>
</div>

<?php
if(isset($_GET['enregistre_conducteur'])){ ?>	
		
		   		<div class="column4">
        
		<?php
include('enregistre_utilisateur.php');
		?>
</div>
<?php } ?>

<?php } ?>   

</div>
<!-- end of main_container -->

</body>
</html>