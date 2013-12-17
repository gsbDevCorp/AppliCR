<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Medicament_c extends MY_Controller{
	
	
	public function __construct(){
		parent::__construct();
		$this->verifier_session();
		
	}
	
	public function index(){
// 		$data['title'] = 'Consulter les médicaments';
// 		$data['content'] = 'pages/medicament_v';
// 		$this->generer_affichage($data);
		$data['afficherMedicament'] = false;
		$this->generer_affichage_medicament($data);
	
	}
	
	public function afficher(){
		$data['afficherPraticien'] = true;
		$data['medicament'] = $this->Medicament_m->getInfosMedicament($this->input->post('medicament'));
		$this->generer_affichage_medicament($data);
	
	}
	private function generer_affichage_medicament($data) {
		$data['medicaments'] = $this->Medicament_m->getListeMedicaments();
		$data['title'] = 'Medicaments';
		$data['content'] = 'pages/medicament_v';
		$this->generer_affichage($data);
	}
	
}


/* End of file EtatFrais.php */
/* Location: ./application/controllers/Medicament_c.php */
