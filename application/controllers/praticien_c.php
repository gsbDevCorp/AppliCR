<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Praticien_c extends MY_Controller{
	
	
	public function __construct(){
		parent::__construct();
		$this->verifier_session();
		
	}
	
	public function index(){
		$data['afficherPraticien'] = false;
		$this->generer_affichage_praticien($data);
	}
	
	public function afficher(){
		$data['afficherPraticien'] = true;
		$data['praticien'] = $this->praticien_m->getInfosPraticien($this->input->post('praticien'));
		$this->generer_affichage_praticien($data);
	
	}
	private function generer_affichage_praticien($data) {
		$data['praticiens'] = $this->praticien_m->getListePraticiens();
		$data['title'] = 'Praticiens';
		$data['content'] = 'pages/praticien_v';
		$this->generer_affichage($data);
	}
	
}


/* End of file EtatFrais.php */
/* Location: ./application/controllers/Particien_c.php */