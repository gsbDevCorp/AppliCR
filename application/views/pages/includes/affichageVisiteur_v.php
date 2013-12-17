<?php 
	foreach ($visiteur->result_array() as $item) {
?>
		<ul>
			<li><span class="titre">NOM : </span><span class="valeur_detail"><?php echo $item['vis_nom']; ?></span></li>
			<li><span class="titre">PRENOM : </span><span class="valeur_detail"><?php echo $item['vis_prenom']; ?></span></li>
			<li><span class="titre">ADRESSE : </span><span class="valeur_detail"><?php echo $item['vis_adresse']; ?></span></li>
			<li><span class="titre">CP : </span><span class="valeur_detail"><?php echo $item['vis_cp']; ?></span></li>
			<li><span class="titre">VILLE : </span><span class="valeur_detail"><?php echo $item['vis_ville']; ?></span></li>
		</ul>
		<div class="butsPassage">
<?php 
	}
	$this->load->view('pages/includes/formPassageVisiteur_v');
?>
		</div>