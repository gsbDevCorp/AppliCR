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
		$data['rapports'] = $this->rapport_visite_m->getRapportsVisiteur($this->session->userdata('vis_matricule'));
		$this->generer_affichage($data);
	}
	
	/**
	 * Formulaire de création d'un nouveau rapport de visite.
	 */
	public function nouveau() {
		//-- Génération des listes
		$data['praticiens'] = $this->praticien_m->getListePraticiens();
		$data['motifs'] = $this->rapport_visite_m->getListeMotifs();
		$data['medicaments'] = $this->medicament_m->getListeMedicaments();

		//-- Génération de l'affichage
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
			$data['rapports'] = $this->rapport_visite_m->getRapportsVisiteur($this->session->userdata('vis_matricule'));
		}
		else {
			//-- Gestion de la complétion partielle du formulaire.
			if ($this->form_validation->run() == FALSE)
				$data['rapports'] = $this->rapport_visite_m->getRapportsVisiteur($this->session->userdata('vis_matricule'));
			else
				$data['rapports'] = $this->rapport_visite_m->getRapportsLimites($this->session->userdata('vis_matricule'), $dateDebut, $dateFin);
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
		$data['rapports'] = $this->rapport_visite_m->getRapportByCode($this->session->userdata('vis_matricule'), $this->uri->segment(3));
		
		//-- Récupération des informations du praticien titulaire.
		foreach ($data['rapports']->result_array() as $rapport) {
			$data['praticiens'] = $this->praticien_m->getInfosPraticien($rapport['pra_num']);
		}
		
		//-- Récupérations des informations du remplacant.
		foreach($data['praticiens']->result_array() as $praticien) {
			$data['remplacants'] = $this->praticien_m->getInfosRemplacant($rapport['rap_num']);
		}
		if($data['remplacants']->num_rows() > 0) {
			foreach($data['remplacants']->result_array() as $remplacant) {
				$data['remplacant'] = $this->praticien_m->getInfosPraticien($remplacant['pra_num']);
			}
			$data['remplacants'] = true;
		}
		else 
			$data['remplacants'] = false;
		
		//-- Récupération des médicaments présentés lors de la visite.
		$data['elemPresentes'] = $this->medicament_m->getMedPresentes($rapport['rap_num']);
		///-- Récupération des échantillons distribués lors de la visite.
		$data['echantillons'] = $this->rapport_visite_m->getEchantillonsOfferts($rapport['rap_num']);
		
		//-- Génération de l'affichage.
		$data['title'] = ' Rapport de visite n°'.$this->uri->segment(3);
		$data['content'] = 'pages/afficherRapport_v';
		$this->generer_affichage($data);
	}
	
	/**
	 * Traitement des informations envoyées et enregistrement d'un nouveau rapport de visite
	 */
	public function enregistrer() {
	
		$data['traitement'] = false;
		
		$this->form_validation->set_rules('dateVisite', 'Date de visite', 'required|callback_dateVisite_check');
		$this->form_validation->set_rules('praticiens', 'Praticien', 'required|callback_praticien_check');
		$this->form_validation->set_rules('coefConfiance', 'Coeff. Confiance', 'numeric');
		$this->form_validation->set_rules('remplacants', 'Remplaçant', 'callback_remplacant_check');
		$this->form_validation->set_rules('motifs', 'Motif', 'callback_motif_check');
		$this->form_validation->set_rules('bilan', 'Bilan', 'required');
		
		$this->form_validation->set_message('required', 'Le champ "%s" doit être renseigné.');
		$this->form_validation->set_message('numeric', 'Le champ "%s" doit être composé uniquement de caractères numériques.');
		
		if($this->form_validation->run() == FALSE) {
			
			//-- Génération des listes
			$data['praticiens'] = $this->praticien_m->getListePraticiens();
			$data['motifs'] = $this->rapport_visite_m->getListeMotifs();
			$data['medicaments'] = $this->medicament_m->getListeMedicaments();
			
			//-- Génération de l'affichage
			$data['title'] = 'Nouveau rapport de visite';
			$data['content'] = 'pages/nouveauRapport_v';
			$this->generer_affichage($data);
		}
		else {
			
			//-- Enregistrement des données
				
			$vis_matricule = $this->session->userdata('vis_matricule');
			$rap_date = date('Y-m-d');
			$rap_bilan = $this->input->post('bilan');
			$rap_coefconfiance = $this->input->post('coefConfiance');
			$rap_datevisite = dateToEN($this->input->post('dateVisite'));
			$autre_motif = $this->input->post('autreMotif');
			$pra_num = $this->input->post('praticiens');
			$mo_code = $this->input->post('motifs');
			$med_depotlegal = $this->input->post('produit');
				
			$listeEnregistrement = array(
					'vis_matricule' => $vis_matricule,
					'rap_date' => $rap_date,
					'rap_bilan' => $rap_bilan,
					'rap_coefconfiance' => $rap_coefconfiance,
					'rap_datevisite' => $rap_datevisite,
					'autre_motif' => $autre_motif,
					'pra_num' => $pra_num,
					'mo_code' => $mo_code,
					'med_depotlegal' => $med_depotlegal
			);
				
			try {
				$this->rapport_visite_m->enregistrerRapport($listeEnregistrement);
			}
			catch(Exception $e) {
				echo $e;
			}
			
			$data['traitement'] = true;
			
			//-- Génération des listes
			$data['praticiens'] = $this->praticien_m->getListePraticiens();
			$data['motifs'] = $this->rapport_visite_m->getListeMotifs();
			$data['medicaments'] = $this->medicament_m->getListeMedicaments();
				
			//-- Génération de l'affichage
			$data['title'] = 'Nouveau rapport de visite';
			$data['content'] = 'pages/nouveauRapport_v';
			$this->generer_affichage($data);
		}
	}
	
	/**
	 * Fonction de vérification de la date de visite renseignée
	 * Appelée en callback sur les form_validation
	 * 
	 * @param $date
	 * @return boolean
	 */
	public function dateVisite_check($date) {
		$dateRapport = new DateTime(date('Y-m-d'));
		$dateVisite = new DateTime(dateToEN($date));
		$interval = $dateRapport->diff($dateVisite);
		$interval = $interval->format('%d');
		if($interval > 0) {
			$this->form_validation->set_message('dateVisite_check', 'Le champ "%s" est invalide (ne peut pas être dans le futur)');
			return false;
		}
		else 
			return true;
	}
	
	/**
	 * Fonction de vérification du praticien renseigné
	 * Appelée en callback sur les form_validation
	 *
	 * @param $praticien
	 * @return boolean
	 */
	public function praticien_check($praticien) {
		if($praticien == -1) {
			$this->form_validation->set_message('praticien_check', 'Le champ "%s" est invalide');
			return false;
		}
		else
			return true;
	}
	
	/**
	 * Fonction de vérification du remplaçant renseigné
	 * Appelée en callback sur les form_validation
	 *
	 * @param $remplacant
	 * @return boolean
	 */
	public function remplacant_check($remplacant) {
		if($remplacant == -1) {
			$this->form_validation->set_message('remplacant_check', 'Le champ "%s" est invalide');
			return false;
		}
		else
			return true;
	}
	
	/**
	 * Fonction de vérification du motif renseigné
	 * Appelée en callback sur les form_validation
	 *
	 * @param $motif
	 * @return boolean
	 */
	public function motif_check($motif) {
		if($motif == -1) {
			$this->form_validation->set_message('motif_check', 'Le champ "%s" est obligatoire');
			return false;
		}
		elseif($motif == 5) {
			if($this->input->post('autreMotif') == '') {
				$this->form_validation->set_message('motif_check', 'Vous devez préciser un nouveau %s');
				return false;
			}
		}
		else
			return true;
	}
}


/* End of file Rapport_Visite_c.php */
/* Location: ./application/controllers/Rapport_Visite_c.php */
