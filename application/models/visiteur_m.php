<?php

/**
 * Classe d'accès aux données des visiteurs
 */
class Visiteur_m extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	/**
	 * Vérification des identifiants de connexion du visiteur
	 * 
	 * @param String $vis_matricule
	 * @param date $vis_dateEmbauche
	 * @return boolean
	 */
	public function connexion($vis_nom, $vis_dateEmbauche) {
		$this->db->where('vis_nom', $vis_nom);
		$this->db->where('vis_dateembauche', $vis_dateEmbauche);
		$query = $this->db->get('visiteur');
		//Compte le nombre de ligne r�cup�r�s par la BDD
		if ($query->num_rows() > 0)
			return false;
		return true;
	}
	
	/**
	 * Retourne un visiteur à partir de son matricule
	 */
	public function getVisiteur($vis_nom) {
		$this->db->where('vis_nom', $vis_nom);
		return $this->db->get('visiteur');
	}
}