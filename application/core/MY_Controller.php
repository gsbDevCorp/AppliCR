<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
	function __construct() {
		parent::__construct();
	}
	
	/**
	 * Vérification de la présence de donnée de session
	 * @return boolean
	 */
	private function est_connecte() {
		if($this->session->userdata('vis_matricule')) 
			return true;
		return false;
	}
	
	/**
	 * Redirection si pas de session
	 */
	function verifier_session() {
		if(!$this->est_connecte())
			redirect('connexion_c','refresh');
	}
	
	/**
	 * Empeche le retour à l'écran de connexion pour un visiteur déjà connecté
	 */
	function bloqueRetour() {
		if($this->est_connecte())
			redirect('rapport_visite_c', 'refresh');
	}
	
	/**
	 * Gestion de l'affichage
	 * @param array $data
	 */
	function generer_affichage($data) {
		$data['menu'] = false;
		if($this->est_connecte())
			$data['menu'] = true;
		$this->load->view('templates/mainTemplate_v',$data);
	}
}

/* End of file MY_Controller.php */
/* Location : ./application/core/MY_Controller.php */