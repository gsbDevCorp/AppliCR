<div id="afficher_rapport" class="contenu">
	<?php 
		foreach($rapports->result_array() as $rapport) {
			foreach($praticiens->result_array() as $praticien) {
	?>
		<h1>Compte-rendu numéro <?php echo $rapport['rap_num']; ?> : visite du <?php echo dateToAppliCR($rapport['rap_datevisite']); ?></h1>
		<?php echo anchor('rapport_visite_c', '<= Retour vers la liste').br(); ?>
		
		<ul>
			<li><span class="titre">NUMERO : </span><span class="valeur_detail"><?php echo $rapport['rap_num']; ?></span></li>
			<li><span class="titre">DATE DU RAPPORT : </span><span class="valeur_detail"><?php echo  dateToAppliCR($rapport['rap_date']); ?></span></li>
			<li><span class="titre">DATE DE VISITE : </span><span class="valeur_detail"><?php echo dateToAppliCR($rapport['rap_datevisite']); ?></span></li>
			<li><span class="titre">PRATICIEN : </span><span class="valeur_detail"><?php echo $praticien['pra_nom'].' '.$praticien['pra_prenom']; ?></span></li>
			<li><span class="titre">COEFF. CONFIANCE : </span><span class="valeur_detail"><?php echo $rapport['rap_coefconfiance']; ?></span></li>
			<?php 
				if($remplacants) { 
					foreach($remplacant->result_array() as $remplacant) {
			?>
						<li><span class="titre">REMPLACANT : </span><span class="valeur_detail"><?php echo $remplacant['pra_nom'].' '.$remplacant['pra_prenom']; ?></span></li>
			<?php 
					}
				} 
			?>
			<li>
				<span class="titre">MOTIF : </span>
				<?php if(!empty($rapport['autre_motif'])) { ?>
						<span class="valeur_detail"><?php echo $rapport['autre_motif']; ?></span>
				<?php 
						}
						else { 
							foreach($this->rapport_visite_m->getMotifRapport($rapport['mo_code'])->result_array() as $motif) {
				?>
						<span class="valeur_detail"><?php echo $motif['mo_libelle']; ?></span>
				<?php 
						}
							}
				?>
			</li>
			<?php if($rapport['rap_bilan'] != null) { ?>
			<li><span class="titre">BILAN : </span><span class="valeur_detail"><?php echo $rapport['rap_bilan']; ?></span></li>
			<?php
				} 
				if($elemPresentes->num_rows() > 0) {
			?>
			<li><span class="titre">Eléments présentés :</span>
				<ul class="valeur_detail">
					<?php 
					foreach($elemPresentes->result_array() as $element) {
						foreach($this->medicament_m->getInfosMedicament($element['med_depotlegal'])->result_array() as $medicament) {
					?>
							<li><?php echo $medicament['med_nomcommercial']; ?></li>
					<?php 
						}
					}
					?>
				</ul>
			</li>
			<?php
				}
				if($echantillons->num_rows() > 0) {
			?>
			<li><span class="titre">Echantillons :</span>
				<ul class="valeur_detail">
					<?php 
					foreach($echantillons->result_array() as $element) {
						foreach($this->medicament_m->getInfosMedicament($element['med_depotlegal'])->result_array() as $medicament) {
					?>
							<li><?php echo $medicament['med_nomcommercial'].' x'.$element['off_qte']; ?></li>
					<?php 
						}
					}
					?>
				</ul>
			</li>
			<?php }?>
		</ul>
	<?php 
			}
		}
	?>
</div>
