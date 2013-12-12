<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Rapport_Visite_c extends MY_Controller {
	
	
	public function __construct(){
		parent::__construct();
	}
	
	/**
	 * Affichage de la page de consultation des rapports de visite.
	 */
	public function index(){
		$data['title'] = 'Consulter les rapports de visite';
		$data['content'] = 'pages/consulterRapports_v';
		$this->generer_affichage($data);
	}
}


/* End of file Rapport_Visite_c.php */
/* Location: ./application/controllers/Rapport_Visite_c.php */
