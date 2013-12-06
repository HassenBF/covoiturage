function verification()
{
var radiobutton = document.formulaire.traj_retour;
ValueButton="";
for (i=0;i<radiobutton.length;i++){
   if (radiobutton[i].checked==true) {
   	ValueButton=radiobutton[i].value;
   }
 	}

if(document.formulaire.trajet_reg.checked){
	var COCHE = true;
}else{
	var COCHE = false;
}

if(document.formulaire.trajet_reg_retour.checked){
	var COCHE_R = true;
}else{
	var COCHE_R = false;
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
	if(document.formulaire.debt_periode.value == "") {
   alert("Veuillez saisir la date de début de la période svp");
   document.formulaire.debt_periode.focus();
   return false;
  } 
   else if(document.formulaire.fin_periode.value == "") {
   alert("Veuillez saisir la date de fin de la période svp");
   document.formulaire.fin_periode.focus();
   return false;
  
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
	else if((document.formulaire.heure_retour.value.indexOf(':') != 2)&&(document.formulaire.heure_retour.value != "variable")&&(document.formulaire.heure_retour.value != "")) {
   alert("Svp, veuillez saisir votre heure de depart au format hh:mm \n \n exemple: ?ire 06:30 pour un trajet ?h30 \n \n note: vous pouvez ?lement saisir \"variable\" ");
   document.formulaire.heure_retour.focus();
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
  }else if(ValueButton == "oui") {
 
   if(document.formulaire.date_trajet_retour.value == "") {
   alert("Veuillez saisir la date de retour svp");
   document.formulaire.date_trajet_retour.focus();
   return false;
  
  } 
  else if(COCHE_R){
	if(document.formulaire.debt_periode_retour.value == "") {
   alert("Veuillez saisir la date de début de la période svp");
   document.formulaire.debt_periode_retour.focus();
   return false;
  } 
   else if(document.formulaire.fin_periode_retour.value == "") {
   alert("Veuillez saisir la date de fin de la période svp");
   document.formulaire.fin_periode_retour.focus();
   return false;
  
  }
}
  if(document.formulaire.heure_retour.value == "") {
   alert("Veuillez saisir votre heure de retour svp");
   document.formulaire.heure_retour.focus();
   return false;
  } 
   else if((document.formulaire.heure_retour.value.indexOf(':') != 2)&&(document.formulaire.heure_retour.value != "variable")) {
   alert("Svp, veuillez saisir votre heure de retour au format hh:mm \n \n exemple: ?ire 06:30 pour un trajet ?h30 \n \n note: vous pouvez ?lement saisir \"variable\" ");
   document.formulaire.heure_retour.focus();
   return false;
	}
	
	else if(document.formulaire.vehicule_retour.value == "") {
   alert("Veuillez saisir ou choisir votre véhicule de retour svp");
   document.formulaire.vehicule_retour.focus();
   return false;
  } 
  else if(document.formulaire.lieu_rdv_retour.value == "") {
   alert("Veuillez saisir un lieu de rendez-vous pour votre trajet de retour svp");
   document.formulaire.lieu_rdv_retour.focus();
   return false;
  } 
	
var le_select_retour1 = document.getElementById("le_select_retour") ;
var valeur_retour1 = le_select_retour1.options[le_select_retour1.selectedIndex].value;
	
if(valeur_retour1 == "autre") {
	
   if(document.formulaire.marque_retour.value == "") {
   alert("Veuillez saisir une marque de vehicule de retour SVP");
   document.formulaire.marque_retour.focus();
   return false;
  }else if(document.formulaire.couleur_retour.value == "") {
   alert("Veuillez saisir une couleur de vehicule de retour SVP");
   document.formulaire.couleur_retour.focus();
   return false;
  }
  return true
  }
  
var le_select_retour2 = document.getElementById("lieu_rdv_retour") ;
var valeur_retour2 = le_select_retour2.options[le_select_retour2.selectedIndex].value;

if(valeur_retour2 == "autre") {
	
   if(document.formulaire.lieu_rdv_retour_autre.value == "") {
   alert("Veuillez saisir un lieu de rendez-vous pour votre trajet de retour SVP");
   document.formulaire.lieu_rdv_retour_autre.focus();
   return false;
  }
  return true
  }
	return true
  }
	
  return true
 

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

function periode2() {
	
	var targetElement = document.getElementById("periode2") ;
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
function ajouter_lieu_rdv_retour() {
	
	var targetElement = document.getElementById("ajouter_lieu_rdv_retour") ;
	var le_select_retour = document.getElementById("lieu_rdv_retour") ;
	var valeur_retour = le_select_retour.options[le_select_retour.selectedIndex].value;
	
	if (valeur_retour == "autre") { 
		targetElement.style.display = "" ;
		
	} else { 
		
		targetElement.style.display = "none" ;
		
	} 
}


function ajouter_veh_retour() {
	
	var targetElement = document.getElementById("ajout_veh_retour") ;
	var le_select = document.getElementById("le_select_retour") ;
	var valeur = le_select_retour.options[le_select_retour.selectedIndex].value;
	
	if (valeur == "autre") { 
		targetElement.style.display = "" ;
		
	} else { 
	
		targetElement.style.display = "none" ;
		
	} 
}