<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Praticien_c extends MY_Controller{
	
	
	public function __construct(){
		parent::__construct();
		$this->verifier_session();
		
	}
	
	public function index(){
		//Initialisation des variables
		$idPraticien = $this->session->userdata('pra_num');
		
		//Appel de l'initialisation de la vue
		$this->initVue($idPraticien);
		
		$this->generer_affichage($data);
	}
	
	public function afficher(){
		
	
	}
	
}


/* End of file EtatFrais.php */
/* Location: ./application/controllers/Medicament_c.php */