<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Rapport_Visite_c extends MY_Controller {
	
	
	public function __construct(){
		parent::__construct();
		$this->verifier_session();
	}
	
	/**
	 * Affichage de la page de consultation des rapports de visite.
	 */
	public function index(){
		$data['title'] = 'Consulter les rapports de visite';
		$data['content'] = 'pages/consulterRapports_v';
		$data['rapports'] = $this->Rapport_Visite_m->getRapportsVisiteur($this->session->userdata('vis_matricule'));
		$this->generer_affichage($data);
	}
	
	/**
	 * Création d'un nouveau rapport de visite.
	 */
	public function nouveau() {
		$data['title'] = 'Nouveau rapport de visite';
		$data['content'] = 'pages/nouveauRapport_v';
		$this->generer_affichage($data);
	}
	
	/**
	 * Recherche des rapports de visites enregistrés entre deux dates.
	 */
	public function rechercher() {
		//-- Attributs.
		$dateDebut = dateToEN($this->input->post('dateDebut'));
		$dateFin = dateToEN($this->input->post('dateFin'));
		//-- Vérification de la complétion
		$this->form_validation->set_rules('dateDebut', 'Date début', 'required');
		$this->form_validation->set_rules('dateFin', 'Date fin', 'required');
		
		//-- Vérification du format des dates.
		if (!verifierFormatDate($dateDebut) || !verifierFormatDate($dateFin) || strtotime($dateDebut) > strtotime($dateFin)) {
			$data['erreurDate'] = true;
			$data['rapports'] = $this->Rapport_Visite_m->getRapportsVisiteur($this->session->userdata('vis_matricule'));
		}
		else {
			//-- Gestion de la complétion partielle du formulaire.
			if ($this->form_validation->run() == FALSE)
				$data['rapports'] = $this->Rapport_Visite_m->getRapportsVisiteur($this->session->userdata('vis_matricule'));
			else
				$data['rapports'] = $this->Rapport_Visite_m->getRapportsLimites($this->session->userdata('vis_matricule'), $dateDebut, $dateFin);
		}
		
		//-- Génération de l'affichage.
		$data['title'] = 'Consulter les rapports de visite';
		$data['content'] = 'pages/consulterRapports_v';
		$this->generer_affichage($data);
	}
	
	/**
	 * Affichage du rapport de visite sélectionné par l'utilisateur.
	 */
	public function afficher() {
		//-- Récupération des informations du rapport.
		$data['rapports'] = $this->Rapport_Visite_m->getRapportByCode($this->session->userdata('vis_matricule'), $this->uri->segment(3));
		
		//-- Récupération des informations du praticien titulaire.
		foreach ($data['rapports']->result_array() as $rapport) {
			$data['praticiens'] = $this->Praticien_m->getInfosPraticien($rapport['pra_num']);
		}
		
		//-- Récupérations des informations du remplacant.
		foreach($data['praticiens']->result_array() as $praticien) {
			$data['remplacants'] = $this->Praticien_m->getInfosRemplacant($rapport['rap_num']);
		}
		if($data['remplacants']->num_rows() > 0) {
			foreach($data['remplacants']->result_array() as $remplacant) {
				$data['remplacant'] = $this->Praticien_m->getInfosPraticien($remplacant['pra_num']);
			}
			$data['remplacants'] = true;
		}
		else 
			$data['remplacants'] = false;
		
		//-- Récupération des médicaments présentés lors de la visite.
		$data['elemPresentes'] = $this->Medicament_m->getMedPresentes($rapport['rap_num']);
		///-- Récupération des échantillons distribués lors de la visite.
		$data['echantillons'] = $this->Rapport_Visite_m->getEchantillonsOfferts($rapport['rap_num']);
		
		//-- Génération de l'affichage.
		$data['title'] = ' Rapport de visite n°'.$this->uri->segment(3);
		$data['content'] = 'pages/afficherRapport_v';
		$this->generer_affichage($data);
	}
}


/* End of file Rapport_Visite_c.php */
/* Location: ./application/controllers/Rapport_Visite_c.php */