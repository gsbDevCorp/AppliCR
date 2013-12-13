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
	 */
	public function getRapportByCode($vis_matricule, $rap_num) {
		$this->db->where('vis_matricule', $vis_matricule);
		$this->db->where('rap_num', $rap_num);
		return $this->db->get('rapport_visite');
	}
}