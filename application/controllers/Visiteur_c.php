<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Visiteur_c extends MY_Controller {
	
	
	public function __construct(){
		parent::__construct();
		$this->verifier_session();
	}
	
	/**
	 * Affichage du formulaire de recherche de visiteurs.
	 */
	public function index(){
		$data['afficherVisiteur'] = false;
		$this->generer_affichage_visiteur($data);
	}
	
	/**
	 * Affiche le visiteur sélectionné.
	 */
	public function afficher() {
		$data['afficherVisiteur'] = true;
		$data['visiteur'] = $this->Visiteur_m->getVisiteur($this->input->post('visiteur'));
		$this->generer_affichage_visiteur($data);
	}
	
	/**
	 * Fonction d'affichage, charge la liste des visiteurs en plus.
	 */
	private function generer_affichage_visiteur($data) {
		$data['visiteurs'] = $this->Visiteur_m->getListeVisiteurs();
		$data['title'] = 'Visiteurs';
		$data['content'] = 'pages/visiteur_v';
		$this->generer_affichage($data);
	}
}


/* End of file Visiteur_c.php */
/* Location: ./application/controllers/Visiteur_c.php */