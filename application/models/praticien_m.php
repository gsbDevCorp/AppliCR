<?php

/**
 * Classe d'accès aux informations des praticiens.
 */
class Praticien_m extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	/**
	 * Renvoie toutes les informations d'un praticien donné par son numéro.
	 * 
	 * @param int pra_num
	 */
	public function getInfosPraticien($pra_num) {
		$this->db->where('pra_num', $pra_num);
		return $this->db->get('praticien');
	}
}