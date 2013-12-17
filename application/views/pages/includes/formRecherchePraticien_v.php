<?php

//Définition des attributs
	
	$dataForm['praticien'] = array(
			'-1' => 'Choisir un praticien'
	);
	foreach($praticiens->result_array() as $praticien) {
		$dataForm['praticien'] += array(
				$praticien['pra_num'] => $praticien['pra_nom']
		);
	}
	$dataForm['submit'] = array(
			'name' => 'sendForm',
			'id' => 'sendForm',
			'value' => 'OK'
	);

//Affichage du formulaire

	echo form_open("Praticien_c/afficher");
	//Formulaire
	echo form_dropdown('praticien', $dataForm['praticien'], '-1');
	echo form_submit($dataForm['submit']);
	form_close();
?>