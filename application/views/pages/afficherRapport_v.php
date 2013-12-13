<div id="afficher_rapport" class="contenu">
	<?php 
		foreach($rapports->result_array() as $rapport) {
	?>
		<h1>Compte-rendu numéro <?php echo $rapport['rap_num']; ?> : visite du <?php echo dateToAppliCR($rapport['rap_datevisite']); ?></h1>
		<?php echo anchor('rapport_visite_c', '<= Retour vers la liste').br(); ?>
		
		<span class="titre">NUMERO : </span><span class="valeur_detail"><?php echo $rapport['rap_num']; ?></span><br/>
		<span class="titre">DATE DU RAPPORT : </span><span class="valeur_detail"><?php echo  dateToAppliCR($rapport['rap_date']); ?></span><br/>
		<span class="titre">DATE DE VISITE : </span><span class="valeur_detail"><?php echo dateToAppliCR($rapport['rap_datevisite']); ?></span><br/>
		<span class="titre">PRATICIEN : </span><span class="valeur_detail"><?php echo $rapport['pra_num']; ?></span><br/>
		<span class="titre">COEFF. CONFIANCE : </span><span class="valeur_detail"><?php echo $rapport['rap_coefconfiance']; ?></span><br/>
		<span class="titre">REMPLACANT : </span><span class="valeur_detail"></span><br/>
		<span class="titre">MOTIF : </span><span class="valeur_detail"><?php echo $rapport['mo_code']; ?></span><br/>
		<span class="titre">BILAN : </span><span class="valeur_detail"><?php echo $rapport['rap_bilan']; ?></span><br/>
		<span class="titre">Eléments présentés :</span><span class="valeur_detail"><?php echo $rapport['rap_num']; ?></span><br/>
		<span class="titre">Echantillons :</span><span class="valeur_detail"></span><br/>

	<?php 
		}
	?>
</div>