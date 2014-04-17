<?php 
	if($menu) {
?>
	<div id="navigation">
		<div id="visiteur_connecte">
			Connecté en tant que : <br/>
			<?php 
				echo $this->session->userdata('vis_nom') . ' ' . $this->session->userdata('vis_prenom').br();
			?>
			<?php echo anchor('connexion_c/deconnexion', 'Déconnexion'); ?>
		</div>
		<h2>Outils</h2>
		<ul>
			<li>Comptes-Rendus
				<ul>
					<li><?php echo anchor('rapport_visite_c/nouveau', 'Nouveau'); ?></li>
					<li><?php echo anchor('rapport_visite_c', 'Consulter'); ?></li>
				</ul>
			</li>
			<li>Consulter
				<ul>
					<li><?php echo anchor('medicament_c', 'Médicaments'); ?></li>
					<li><?php echo anchor('praticien_c', 'Praticiens'); ?></li>
					<li><?php echo anchor('visiteur_c', 'Autres visiteurs'); ?></li>
				</ul>
			</li>
		</ul>
	</div>
<?php 
	}
?>