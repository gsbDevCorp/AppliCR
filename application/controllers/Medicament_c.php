<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Medicament_c extends MY_Controller{
	
	
	public function __construct(){
		parent::__construct();
		$this->verifier_session();
		
	}
	
	public function index(){
		$data['title'] = 'Consulter les médicaments';
		$data['content'] = 'pages/medicament_v';
		$this->generer_affichage($data);
	
	}
	
	public function afficher(){
		
		
	
	}
	
}


/* End of file EtatFrais.php */
/* Location: ./application/controllers/Medicament_c.php */
