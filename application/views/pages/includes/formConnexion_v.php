<?php

//----- Définition des attributs

	$dataForm['identifiant'] = array(
			'name' => 'identifiant',
			'id' => 'identifiant',
			'value' => set_value('identifiant')
	);
	$dataForm['mdp'] = array(
			'name' => 'mdp',
			'id' => 'mdp'
	);
	$dataForm['submit'] = array(
			'name' => 'sendForm',
			'id' => 'sendForm',
			'value' => 'Connexion'
	);

//----- Affichage du formulaire

	echo form_open("connexion_c/valider");
	//-- Gestion des erreurs
	echo validation_errors('<div class="erreur">', '</div>').br();
	if (isset($erreurCombinaison) && $erreurCombinaison)
		echo '<div class="erreur">Erreur dans la combinaison Identifiant / Mot de passe.</div>'.br();
	//-- Formulaire
	echo form_label('Identifiant :','identifiant').br();
	echo form_input($dataForm['identifiant']).br();
	echo form_label('Mot de passe :','mdp').br();
	echo form_password($dataForm['mdp']).br();
	echo form_submit($dataForm['submit']);
	form_close();
?>