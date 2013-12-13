<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Medicament_c extends MY_Controller{
	
	
	public function __construct(){
		parent::__construct();
		$this->verifier_session();
		
	}
	
	public function index(){
		//Initialisation des variables
		$idVisiteur = $this->session->userdata('vis_matricule');
		+
		//Appel de l'initialisation de la vue
		$this->initVue($idVisiteur);
		
		$this->generer_affichage($data);
	}
	
	public function afficher(){
		$data['content'] = 'Medicament_c.php';
		$this->generer_affichage($data);
		
	
	}
	
}


/* End of file EtatFrais.php */
/* Location: ./application/controllers/Medicament_c.php */
