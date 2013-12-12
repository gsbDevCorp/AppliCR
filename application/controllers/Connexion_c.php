<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Connexion_c extends MY_Controller {
	
	
	public function __construct(){
		parent::__construct();
	}
	
	public function index(){
		$data['content'] = 'pages/connexion_v';
		$this->generer_affichage($data);
	}
	
}


/* End of file Connexion_c.php */
/* Location: ./application/controllers/Connexion_c.php */
