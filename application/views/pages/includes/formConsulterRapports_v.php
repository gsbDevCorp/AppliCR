<?php

//----- Définition des attributs

	$dataForm['dateDebut'] = array(
			'name' => 'dateDebut',
			'id' => 'dateDebut',
			'placeholder' => 'jj-mm-aaaa',
			'value' => set_value('dateDebut')
	);
	$dataForm['dateFin'] = array(
			'name' => 'dateFin',
			'id' => 'dateFin',
			'placeholder' => 'jj-mm-aaaa',
			'value' => set_value('dateFin')
	);
	$dataForm['submit'] = array(
			'name' => 'sendForm',
			'id' => 'sendForm',
			'value' => 'OK'
	);

//----- Affichage du formulaire

	echo form_open("rapport_visite_c/rechercher");
	//-- Gestion des erreurs
	if (isset($erreurDate) && $erreurDate)
		echo '<div class="erreur">Erreur dans le format des dates.</div>'.br();
	//-- Formulaire
	echo form_label('DU : ','dateDebut');
	echo form_input($dataForm['dateDebut']);
	echo form_label('AU : ','dateFin');
	echo form_input($dataForm['dateFin']);
	echo form_submit($dataForm['submit']);
	form_close();
?>