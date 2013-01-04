<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tipomedida_model extends CI_Model 
{
		
	public function Tipomedida_model()
	{
		parent::__construct();
	}	
	
	public function get_tipos_medida()
	{
		$query = $this->db->get('tipos_medida');
		return $query->result();
	}
	
}
