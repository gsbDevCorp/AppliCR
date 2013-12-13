<div id="consulter_rapport" class="contenu">
	<h1>Vos rapports de visite</h1>
	<?php $this->load->view('pages/includes/formConsulterRapports_v').br(); ?>
	<h3>Résultats trouvés :</h3>
	<table id="resultats_rapports">
		<?php 
			foreach($rapports->result_array() as $rapport) {
				echo '<tr>';
					echo '<td class="lien_rapport">'.anchor('rapport_visite_c/afficher/'.$rapport['rap_num'],'Consulter').'</td>';
					echo '<td class="infos_rapport">Compte-rendu numéro '.$rapport['rap_num'].' : visite du '.dateToAppliCR($rapport['rap_datevisite']).'</td>';
				echo '</tr>';
			}
		?>
	</table>
</div>