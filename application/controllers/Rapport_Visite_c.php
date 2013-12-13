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
		//-- Attributs
		$dateDebut = dateToEN($this->input->post('dateDebut'));
		$dateFin = dateToEN($this->input->post('dateFin'));
		//-- Vérification du format des dates.
		if (!verifierFormatDate($dateDebut) || !verifierFormatDate($dateFin)) {
			$data['erreurDate'] = true;
			$data['rapports'] = $this->Rapport_Visite_m->getRapportsVisiteur($this->session->userdata('vis_matricule'));
		}
		else
			$data['rapports'] = $this->Rapport_Visite_m->getRapportsLimites($this->session->userdata('vis_matricule'), $dateDebut, $dateFin);
		
		//-- Génération de l'affichage.
		$data['title'] = 'Consulter les rapports de visite';
		$data['content'] = 'pages/consulterRapports_v';
		$this->generer_affichage($data);
	}
	
	public function afficher() {
		$data['rapports'] = $this->Rapport_Visite_m->getRapportByCode($this->session->userdata('vis_matricule'), $this->uri->segment(3));
		$data['title'] = ' Rapport de visite n°';
		$data['content'] = 'pages/afficherRapport_v';
		$this->generer_affichage($data);
	}
}


/* End of file Rapport_Visite_c.php */
/* Location: ./application/controllers/Rapport_Visite_c.php */
