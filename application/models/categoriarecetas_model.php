<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categoriarecetas_model extends CI_Model 
{
		
	public function Categoriarecetas_model()
	{
		parent::__construct();
	}	
	
	public function get_categorias()
	{
		$query = $this->db->get('categorias_receta');
		return $query->result();
	}
	
}
