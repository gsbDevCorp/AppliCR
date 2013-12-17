<div id="bloc_praticien" class="contenu">
	<h1> Praticiens </h1>
	<?php 
		$this->load->view('pages/includes/formRecherchePraticien_v').br();
		
		if (isset($afficherPraticien) && $afficherPraticien)
			$this->load->view('pages/includes/affichagePraticien_v');
	?>
</div>