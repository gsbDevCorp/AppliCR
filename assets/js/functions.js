/**
* Active l'objet pObjet du formulaire si la valeur sélectionnée (pSelection) est égale à la valeur attendue (pValeur)
*/
function selectionne(pValeur, pSelection, pObjet) {
	if (pSelection == pValeur)
		document.getElementById(pObjet).disabled = false;
	else
		document.getElementById(pObjet).disabled = true;
}

/**
* Active l'input d'autre motif
*/
function ajouterMotif(motif) {
	if (motif == 5)
		document.getElementById('autreMotif').disabled = false;
	else {
		document.getElementById('autreMotif').value = '';
		document.getElementById('autreMotif').disabled = true;
	}
}

/**
* Ajouter un échantillon sur un nouveau rapport
*/
function ajouterEchantillon() {
	alert('ajouter');
}