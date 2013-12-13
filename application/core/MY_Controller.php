<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
	function __construct() {
		parent::__construct();
		
		//On verifie si l'utilisateur est connecté
		if(!$this->session->userdata('')) //à modifier
			redirect("connexion_c",'refresh');
	}
	
	//On genere l'affichage
	function generer_affichage($data) {
		$this->load->view('templates/mainTemplate_v',$data);
	}
}
/* End of file MY_Controller.php */
/* Location : ./application/core/MY_Controller.php */