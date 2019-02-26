/*
---------------------------------------------------------------------
GESTION DU FORMULAIRE D'INSCRIPTION DANS PAGE 'ACTIVITES DU MOIS'
---------------------------------------------------------------------
*/

var boutonsInscription=document.querySelectorAll(".inscription");
var sous_couche=document.querySelector("#overlay");
var formulaire=document.querySelector("#formInscription");

boutonsInscription.forEach(function(bouton){
	bouton.addEventListener("click",function(e){
		
		sous_couche.style.display="block";
		formulaire.style.display="block";

	});
});


formulaire.addEventListener("submit",function(e){
	e.preventDefault();
	fermetureInscription();
});



function fermetureInscription(){
	sous_couche.style.display="none";
	formulaire.style.display="none";
}