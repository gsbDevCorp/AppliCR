<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Connexion_c extends MY_Controller {
	
	
	public function __construct(){
		parent::__construct();
	}
	
	/**
	 * Affichage de la page de connexion.
	 */
	public function index(){
		
		$data['title'] = 'Connexion';
		$data['content'] = 'pages/connexion_v';
		$this->generer_affichage($data);
	}
	
	/**
	 * Gestion des tentatives de connexion.
	 */
	public function valider() {
		
		//-- Vérification des champs
		$this->form_validation->set_rules('identifiant', 'Identifiant', 'required');
		$this->form_validation->set_rules('mdp', 'Mot de passe', 'required');
		$this->form_validation->set_message('required', 'Le champ "%s" doit être renseigné.');
		
		if ($this->form_validation->run() == FALSE) {
			//-- Affichage des erreurs
			$data['title'] = 'Connexion';
			$data['content'] = 'pages/connexion_v';
			$this->generer_affichage($data);
		}
		else {
			//-- Vérification des informations
			/*
			 * Création de la BDD à faire.
			 */
			$data['erreurCombinaison'] = true;//fonctionModele($this->input->post('identifiant'),$this->input->post('mdp'));
			
			if (!$data['erreurCombinaison']) {
				//-- Création de la session et redirection
				$session = array(
					'vis_matricule' => 'MATRICULE',
					'vis_nom' => 'NOM',
					'vis_prenom' => 'PRENOM'
				);
				$this->session->set_userdata($session);
				redirect('rapport_visite_c', 'refresh');
			}
			else {
				//-- Affichage des erreurs
				$data['title'] = 'Connexion';
				$data['content'] = 'pages/connexion_v';
				$this->generer_affichage($data);
			}
		}
	}
	
	/**
	 * Suppression des données de session de l'utilisateur
	 */
	public function deconnexion() {
		$this->session->sess_destroy();
		redirect(connexion_c);
	}
}


/* End of file Connexion_c.php */
/* Location: ./application/controllers/Connexion_c.php */
