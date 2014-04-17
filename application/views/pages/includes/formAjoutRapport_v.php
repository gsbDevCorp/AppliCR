<?php

//----- Définition des attributs
	
	//-- Dates
	$dataForm['dateRapport'] = array(
			'name' => 'dateRapport',
			'id' => 'dateRapport',
			'disabled' => 'disabled',
			'value' => date("d-m-Y")
	);
	$dataForm['dateVisite'] = array(
			'name' => 'dateVisite',
			'id' => 'dateVisite',
			'placeholder' => 'jj-mm-aaaa',
			'value' => set_value('dateVisite')
	);
	
	//-- Praticiens
	$dataForm['praticiens'] = array(
			'-1' => 'Choisir un praticien'
	);
	foreach($praticiens->result_array() as $praticien) {
		$dataForm['praticiens'] += array(
				$praticien['pra_num'] => $praticien['pra_nom']
		);
	}
	$dataForm['coefConfiance'] = array(
			'name' => 'coefConfiance',
			'id' => 'coefConfiance',
			'value' => set_value('coefConfiance')
	);
	$dataForm['remplacants'] = array(
			'-1' => 'Choisir un remplaçant'
	);
	foreach($praticiens->result_array() as $remplacant) {
		$dataForm['remplacants'] += array(
				$remplacant['pra_num'] => $remplacant['pra_nom']
		);
	}
	
	//-- Motif, Bilan
	$dataForm['motifs'] = array(
			'-1' => 'Choisir un motif'
	);
	foreach($motifs->result_array() as $motif) {
		$dataForm['motifs'] += array(
				$motif['mo_code'] => $motif['mo_libelle']
		);
	}
	$dataForm['autreMotif'] = array(
			'name' => 'autreMotif',
			'id' => 'autreMotif',
			'value' => set_value('autreMotif'),
			'placeholder' => 'Préciser un autre motif',
			'disabled' => 'true'
	);
	$dataForm['bilan'] = array(
			'name' => 'bilan',
			'id' => 'bilan',
			'value' => set_value('bilan'),
			'rows' => '5',
			'cols' => '50'
	);
	
	//-- Éléments présentés
	$dataForm['produits'] = array(
			'-1' => 'Choisir un médicament'
	);
	foreach($medicaments->result_array() as $medicament) {
		$dataForm['produits'] += array(
				$medicament['med_depotlegal'] => $medicament['med_nomcommercial']
		);
	}
	
	//-- Boutons
	$dataForm['submit'] = array(
			'name' => 'sendForm',
			'id' => 'sendForm',
			'value' => 'Valider'
	);

//----- Affichage du formulaire

	echo form_open("rapport_visite_c/enregistrer");
	//-- Gestion des erreurs
	echo validation_errors('<div class="erreur">', '</div>').br();
	if(isset($traitement) && $traitement)
		echo '<div class="success">Le rapport a bien été enregistré</div>'.br();
	//-- Formulaire
		//-- Dates
	echo form_label('DATE DU RAPPORT :','dateRapport');
	echo form_input($dataForm['dateRapport']).br();
	echo form_label('DATE DE VISITE<span class="champsRequis">*</span> :','dateVisite');
	echo form_input($dataForm['dateVisite']).br();
		//-- Praticiens
	echo form_label('PRATICIEN<span class="champsRequis">*</span> :', 'praticiens');
	echo form_dropdown('praticiens', $dataForm['praticiens'], '-1').br();
	echo form_label('COEFF. CONFIANCE :', 'coefConfiance');
	echo form_input($dataForm['coefConfiance']).br();
	echo form_label('REMPLACANT :', 'remplacants');
	echo form_checkbox('avoirRemplacant', 'avoirRemplacant', FALSE,'onClick="selectionne(true, this.checked, \'remplacants\');"');
	echo form_dropdown('remplacants', $dataForm['remplacants'], '-1','disabled="true", id="remplacants"').br();
		//-- Motifs, Bilan
	echo form_label('MOTIF<span class="champsRequis">*</span> :', 'motifs');
	echo form_dropdown('motifs', $dataForm['motifs'], '-1', 'onChange="ajouterMotif(this.value);"');
	echo form_input($dataForm['autreMotif']).br();
	echo form_label('BILAN<span class="champsRequis">*</span> :', 'bilan');
	echo form_textarea($dataForm['bilan']).br();
	
		//--Éléments présentés
	echo '<h3>Éléments présentés :</h3>';
	echo form_label('PRODUIT :', 'produit');
	echo form_dropdown('produit', $dataForm['produits'], '-1').br();
	
		//-- Boutons
	echo '<span class="champsRequis">*</span> : champs requis'.br().br();
	echo '<div class="butsPassage">';
	echo form_reset('reset', 'Annuler');
	echo form_submit($dataForm['submit']);
	echo '</div>'.br();
	
	form_close();
?>