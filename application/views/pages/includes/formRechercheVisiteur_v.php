<?php

//----- Définition des attributs
	
	$dataForm['visiteurs'] = array(
			'-1' => 'Choisir un visiteur'
	);
	foreach($visiteurs->result_array() as $visiteur) {
		$dataForm['visiteurs'] += array(
				$visiteur['vis_matricule'] => $visiteur['vis_nom']
		);
	}
	$dataForm['submit'] = array(
			'name' => 'sendForm',
			'id' => 'sendForm',
			'value' => 'OK'
	);

//----- Affichage du formulaire

	echo form_open("visiteur_c/afficher");
	//-- Formulaire
	echo form_dropdown('visiteur', $dataForm['visiteurs'], '-1');
	echo form_submit($dataForm['submit']);
	form_close();
?>