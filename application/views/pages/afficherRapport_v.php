<div id="afficher_rapport" class="contenu">
	<?php 
		foreach($rapports->result_array() as $rapport) {
			foreach($this->Praticien_m->getInfosPraticien($rapport['pra_num'])->result_array() as $praticien) {
	?>
		<h1>Compte-rendu numéro <?php echo $rapport['rap_num']; ?> : visite du <?php echo dateToAppliCR($rapport['rap_datevisite']); ?></h1>
		<?php echo anchor('rapport_visite_c', '<= Retour vers la liste').br(); ?>
		
		<span class="titre">NUMERO : </span><span class="valeur_detail"><?php echo $rapport['rap_num']; ?></span><br/>
		<span class="titre">DATE DU RAPPORT : </span><span class="valeur_detail"><?php echo  dateToAppliCR($rapport['rap_date']); ?></span><br/>
		<span class="titre">DATE DE VISITE : </span><span class="valeur_detail"><?php echo dateToAppliCR($rapport['rap_datevisite']); ?></span><br/>
		<span class="titre">PRATICIEN : </span><span class="valeur_detail"><?php echo $praticien['pra_nom'].' '.$praticien['pra_prenom']; ?></span><br/>
		<span class="titre">COEFF. CONFIANCE : </span><span class="valeur_detail"><?php echo $rapport['rap_coefconfiance']; ?></span><br/>
		<span class="titre">REMPLACANT : </span><span class="valeur_detail"></span><br/>
		<span class="titre">MOTIF : </span>
		<?php if(!empty($rapport['autre_motif'])) {?>
				<span class="valeur_detail"><?php echo $rapport['autre_motif']; ?></span><br/>
		<?php }else{ ?>
				<span class="valeur_detail"><?php echo $rapport['mo_code']; ?></span><br/>
		<?php }?>
		<span class="titre">BILAN : </span><span class="valeur_detail"><?php echo $rapport['rap_bilan']; ?></span><br/>
		<span class="titre">Eléments présentés :</span><span class="valeur_detail"></span><br/>
		<span class="titre">Echantillons :</span><span class="valeur_detail"></span><br/>

	<?php 
			}
		}
	?>
</div>