<?php

/**
 * Classe d'accès aux rapports de visite.
 */
class Rapport_Visite_m extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	/**
	 * Renvoie tous les rapports de visite saisis par le visiteur.
	 * 
	 * @param String $vis_matricule
	 * @return liste des rapports de visite
	 */
	public function getRapportsVisiteur($vis_matricule) {
		$this->db->where('vis_matricule', $vis_matricule);
		$this->db->order_by('rap_datevisite','desc');
		return $this->db->get('rapport_visite');
	}
	
	/**
	 * Renvoie tous les rapports de visite compris entre les deux dates saisies par le visiteur
	 * 
	 * @param String $vis_matricule
	 * @param date $dateDebut
	 * @param date $dateFin
	 * @return liste des rapports de visite
	 */
	public function getRapportsLimites($vis_matricule, $dateDebut, $dateFin) {
		$this->db->where('vis_matricule', $vis_matricule);
		$this->db->where("rap_datevisite BETWEEN '".$dateDebut."' and '".$dateFin."'"); 
		$this->db->order_by('rap_datevisite','desc');
		return $this->db->get('rapport_visite');
	}
	
	/**
	 * Renvoie le rapport de visite demandé par le visiteur
	 * 
	 * @param String $vis_matricule
	 * @param int $rap_num
	 * @return rapport de visite
	 */
	public function getRapportByCode($vis_matricule, $rap_num) {
		$this->db->where('vis_matricule', $vis_matricule);
		$this->db->where('rap_num', $rap_num);
		return $this->db->get('rapport_visite');
	}
	
	/**
	 * Renvoie les identifiants des échantillons de médicaments offerts lors de la visite
	 * 
	 * @param int $rap_num
	 * @return liste d'identifiants des échantillons
	 */
	public function getEchantillonsOfferts($rap_num) {
		$this->db->where('rap_num', $rap_num);
		return $this->db->get('offrir');
	}
	
	/**
	 * Renvoie le motif du rapport de visite
	 * 
	 * @param int $mo_code
	 * @return String
	 */
	public function getMotifRapport($mo_code) {
		$this->db->where('mo_code', $mo_code);
		return $this->db->get('motif');
	}
	
	/**
	 * Renvoie la liste de tous les motifs connus
	 * 
	 * @return liste des motifs connus
	 */
	public function getListeMotifs() {
		return $this->db->get('motif');
	}
	
	/**
	 * Enregistre un nouveau rapport de visite
	 * 
	 * @param liste des attributs à insérer
	 */
	public function enregistrerRapport($listeAttributs) {
		$this->db->insert('rapport_visite', $listeAttributs);
	}
}