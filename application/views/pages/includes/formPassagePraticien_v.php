<?php

//Définition des attributs
	
	$dataForm['precedent'] = array(
			'name' => 'sendForm',
			'id' => 'sendForm',
			'value' => '<',
			'disabled' => 'disabled'
	);
	$dataForm['suivant'] = array(
			'name' => 'sendForm',
			'id' => 'sendForm',
			'value' => '>',
			'disabled' => 'disabled'
	);

//Affichage du formulaire

	echo form_open("Praticien_c/afficher");
	//Formulaire
	echo form_submit($dataForm['precedent']);
	echo form_submit($dataForm['suivant']);
	form_close();
?>