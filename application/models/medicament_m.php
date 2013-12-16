<?php

/**
 * Classe d'accès aux médicaments.
 */
class Medicament_m extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
	
	/**
	 * Renvoie les identifiants des médicaments présentés lors d'une visite
	 * 
	 * @param int $rap_num
	 */
	public function getMedPresentes($rap_num) {
		$this->db->where('rap_num', $rap_num);
		return $this->db->get('presenter'); 
	}
}