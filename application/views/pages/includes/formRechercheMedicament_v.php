<?php

//Définition des attributs
	
	$dataForm['medicament'] = array(
			'-1' => 'Choisir un medicament'
	);
	foreach($medicaments->result_array() as $medicament) {
		$dataForm['medicament'] += array(
				$medicament['med_depotlegal'] => $medicament['med_nomcommercial']
		);
	}
	$dataForm['submit'] = array(
			'name' => 'sendForm',
			'id' => 'sendForm',
			'value' => 'OK'
	);

//Affichage du formulaire

	echo form_open("Medicament_c/afficher");
	//Formulaire
	echo form_dropdown('medicament', $dataForm['medicament'], '-1');
	echo form_submit($dataForm['submit']);
	form_close();
	
?>