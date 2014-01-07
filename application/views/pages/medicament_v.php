<div id="bloc_medicament" class="contenu">
	<h1> Médicaments </h1>
<?php 
		$this->load->view('pages/includes/formRechercheMedicament_v').br();
		
		if (isset($afficherMedicament) && $afficherMedicament)
			$this->load->view('pages/includes/affichageMedicament_v');
	?>

</div>
