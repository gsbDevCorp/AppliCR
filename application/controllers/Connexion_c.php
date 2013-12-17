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
			$data['erreurCombinaison'] = $this->Visiteur_m->connexion($this->input->post('identifiant'),dateToEN($this->input->post('mdp')));
			
			if (!$data['erreurCombinaison']) {
				//-- Création de la session et redirection
				$visiteur = $this->Visiteur_m->getVisiteurByNom($this->input->post('identifiant'));
				foreach($visiteur->result_array() as $dataVisiteur) {
					$session = array(
						'vis_matricule' => $dataVisiteur['vis_matricule'],
						'vis_nom' => $dataVisiteur['vis_nom'],
						'vis_prenom' => $dataVisiteur['vis_prenom']	
					);
				}
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
