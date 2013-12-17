<div id="visiteur" class="contenu">
	<h1>Visiteurs</h1>
	<?php 
		$this->load->view('pages/includes/formRechercheVisiteur_v').br();
		
		if (isset($afficherVisiteur) && $afficherVisiteur)
			$this->load->view('pages/includes/affichageVisiteur_v');
	?>
</div>