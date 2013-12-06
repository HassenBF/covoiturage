function verification()
{
var radiobutton = document.formulaire.traj_retour;

if(document.formulaire.trajet_reg.checked){
	var COCHE = true;
}else{
	var COCHE = false;
}

if(document.formulaire.ville1.value == "") {
   alert("Veuillez saisir une ville de depart svp");
   document.formulaire.ville1.focus();
   return false;
  } 
   
  
   else if(document.formulaire.ville2.value == "") {
   alert("Veuillez saisir une ville d'arrivée svp");
   document.formulaire.ville2.focus();
   return false;
  
  }
   else if(document.formulaire.ville1.value == document.formulaire.ville2.value) {
   alert("Vous avez saisi la meme ville pour le départ et l'arrivée !");
   document.formulaire.ville2.focus();
   return false;
  
  } 
  else if(document.formulaire.date_trajet.value == "") {
   alert("Veuillez saisir la date de départ svp");
   document.formulaire.date_trajet.focus();
   return false;
  
  }
  
 
  else if(COCHE){
  
  if(document.formulaire.debt_periode){
	if(document.formulaire.debt_periode.value == "") {
   
   document.formulaire.debt_periode.focus();
   return false;
  } 
   else if(document.formulaire.fin_periode.value == "") {
   
   document.formulaire.fin_periode.focus();
   return false;
  
  }
  }
}

  if(document.formulaire.heure.value == "") {
   alert("Veuillez saisir votre heure de depart svp");
   document.formulaire.heure.focus();
   return false;
  } 
  
  
   else if((document.formulaire.heure.value.indexOf(':') != 2)&&(document.formulaire.heure.value != "variable")) {
   alert("Svp, veuillez saisir votre heure de depart au format hh:mm \n \n exemple: ?ire 06:30 pour un trajet ?h30 \n \n note: vous pouvez ?lement saisir \"variable\" ");
   document.formulaire.heure.focus();
   return false;
	}
	else if(document.formulaire.vehicule.value == "") {
   alert("Veuillez saisir ou choisir votre véhicule svp");
   document.formulaire.vehicule.focus();
   return false;
  } 
  else if(document.formulaire.lieu_rdv.value == "") {
   alert("Veuillez saisir un lieu de rendez-vous svp");
   document.formulaire.lieu_rdv.focus();
   return false;
  } 
	
var le_select1 = document.getElementById("le_select") ;
var valeur1 = le_select1.options[le_select1.selectedIndex].value;
	
if(valeur1 == "autre") {
	
   if(document.formulaire.marque.value == "") {
   alert("Veuillez saisir une marque de vehicule SVP");
   document.formulaire.marque.focus();
   return false;
  }else if(document.formulaire.couleur.value == "") {
   alert("Veuillez saisir une couleur de vehicule SVP");
   document.formulaire.couleur.focus();
   return false;
  }
  return true
  }
  
var le_select2 = document.getElementById("lieu_rdv") ;
var valeur2 = le_select2.options[le_select2.selectedIndex].value;

if(valeur2 == "autre") {
	
   if(document.formulaire.lieu_rdv_autre.value == "") {
   alert("Veuillez saisir un lieu de rendez-vous SVP");
   document.formulaire.lieu_rdv_autre.focus();
   return false;
  }
  return true
  }
	
  return true;
 

}

function visibilite(thingId) { 
	var targetElement; 
	targetElement = document.getElementById(thingId) ; 
	if (targetElement.style.display == "none") { 
		targetElement.style.display = "" ; 
	} else { 
		targetElement.style.display = "none" ; 
	} 
} 

function periode1() {
	
	var targetElement = document.getElementById("periode1") ;
	if (targetElement.style.display == "none") { 
		targetElement.style.display = "" ; 
	} else { 
		targetElement.style.display = "none" ; 
	} 
}


function ajouter_veh() {
	
	var targetElement = document.getElementById("ajout_veh") ;
	var le_select = document.getElementById("le_select") ;
	var valeur = le_select.options[le_select.selectedIndex].value;
	
	if (valeur == "autre") { 
		targetElement.style.display = "" ;
		
	} else { 
	
		targetElement.style.display = "none" ;
		
	} 
}


function ajouter_lieu_rdv() {
	
	var targetElement = document.getElementById("ajouter_lieu_rdv") ;
	var le_select = document.getElementById("lieu_rdv") ;
	var valeur = le_select.options[le_select.selectedIndex].value;
	
	if (valeur == "autre") { 
		targetElement.style.display = "" ;
		
	} else { 
		
		targetElement.style.display = "none" ;
		
	} 
}
