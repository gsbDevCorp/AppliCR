<?php

//----- Définition des attributs

	$dataForm['dateDebut'] = array(
			'name' => 'dateDebut',
			'id' => 'dateDebut',
			'placeholder' => 'jj/mm/aaa',
			'value' => set_value('dateDebut')
	);
	$dataForm['dateFin'] = array(
			'name' => 'mdp',
			'id' => 'mdp',
			'value' => set_value('dateDebut')
	);
	$dataForm['submit'] = array(
			'name' => 'sendForm',
			'id' => 'sendForm',
			'value' => 'OK'
	);

//----- Affichage du formulaire

	echo form_open("connexion_c/valider");
	//-- Gestion des erreurs
	echo validation_errors('<div class="erreur">', '</div>').br();
	if (isset($erreurCombinaison) && $erreurCombinaison)
		echo '<div class="erreur">Erreur dans la combinaison Identifiant / Mot de passe.</div>'.br();
	//-- Formulaire
	echo form_label('DU :','dateDebut');
	echo form_input($dataForm['dateDebut']);
	echo form_label('AU :','dateFin');
	echo form_input($dataForm['dateFin']);
	echo form_submit($dataForm['submit']);
	form_close();
?>