<?php 
	foreach ($praticien->result_array() as $item) {
?>
		<ul>
			<li><span class="titre">NOM : </span><span class="valeur_detail"><?php echo $item['pra_nom']; ?></span></li>
			<li><span class="titre">PRENOM : </span><span class="valeur_detail"><?php echo $item['pra_prenom']; ?></span></li>
			<li><span class="titre">ADRESSE : </span><span class="valeur_detail"><?php echo $item['pra_adresse']; ?></span></li>
			<li><span class="titre">CP : </span><span class="valeur_detail"><?php echo $item['pra_cp']; ?></span></li>
			<li><span class="titre">VILLE : </span><span class="valeur_detail"><?php echo $item['pra_ville']; ?></span></li>
			<li><span class="titre">COEFF : </span><span class="valeur_detail"><?php echo $item['pra_coefnotoriete']; ?></span></li>
			<li><span class="titre">CODE : </span><span class="valeur_detail"><?php echo $item['typ_code']; ?></span></li>
		</ul>
		<div class="butsPassage">
<?php 
	}
	$this->load->view('pages/includes/formPassagePraticien_v');
?>
		</div>