<?php 
	foreach ($medicament->result_array() as $item) {
?>
		<ul>
			<li><span class="titre">DEPOT LEGAL : </span><span class="valeur_detail"><?php echo $item['med_depotlegal']; ?></span></li>
			<li><span class="titre">NOM COMMERCIAL : </span><span class="valeur_detail"><?php echo $item['med_nomcommercial']; ?></span></li>
			<li><span class="titre">FAMILLE : </span><span class="valeur_detail"><?php echo $item['fam_code']; ?></span></li>
			<li><span class="titre">COMPOSITION : </span><span class="valeur_detail"><?php echo $item['med_composition']; ?></span></li>
			<li><span class="titre">EFFETS : </span><span class="valeur_detail"><?php echo $item['med_effets']; ?></span></li>
			<li><span class="titre">CONTRE INDIC. : </span><span class="valeur_detail"><?php echo $item['med_contreindic']; ?></span></li>
			<li><span class="titre">PRIX ECHANTILLON : </span><span class="valeur_detail"><?php echo $item['med_prixechantillon']; ?></span></li>
		</ul>
		<div class="butsPassage">
<?php 
	}
	
?>
		</div>