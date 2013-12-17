<?php

//----- Définition des attributs
	
	//-- Dates
	$dataForm['dateRapport'] = array(
			'name' => 'dateRapport',
			'id' => 'dateRapport',
			'value' => set_value('dateRapport')
	);
	$dataForm['dateVisite'] = array(
			'name' => 'dateVisite',
			'id' => 'dateVisite',
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
	$dataForm['bilan'] = array(
			'name' => 'bilan',
			'id' => 'bilan',
			'value' => set_value('dateVisite'),
			'rows' => '5',
			'cols' => '50'
	);
	//-- Boutons
	$dataForm['submit'] = array(
			'name' => 'sendForm',
			'id' => 'sendForm',
			'value' => 'Valider'
	);

//----- Affichage du formulaire

	echo form_open("connexion_c/valider");
	//-- Gestion des erreurs
	echo validation_errors('<div class="erreur">', '</div>').br();
	if (isset($erreurCombinaison) && $erreurCombinaison)
		echo '<div class="erreur">Erreur dans la combinaison Identifiant / Mot de passe.</div>'.br();
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
	echo form_checkbox('avoirRemplacant', 'avoirRemplacant', FALSE);
	echo form_dropdown('remplacants', $dataForm['remplacants'], '-1').br();
		//-- Motifs, Bilan
	echo form_label('MOTIF<span class="champsRequis">*</span> :', 'motifs');
	echo form_dropdown('motifs', $dataForm['motifs'], '-1').br();
	echo form_label('BILAN<span class="champsRequis"</span> :', 'bilan');
	echo form_textarea($dataForm['bilan']);
		//-- Boutons
	echo form_reset('reset', 'Annuler');
	echo form_submit($dataForm['submit']);
	form_close();
?>