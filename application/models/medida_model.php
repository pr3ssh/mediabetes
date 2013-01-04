<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Medida_model extends CI_Model 
{
		
	public function Medida_model()
	{
		parent::__construct();
	}
	
	public function insertar_medida()
	{
		$nueva_medida_insert_data = array (
			'userid' => $this->session->userdata('id'),
			'valor' => $this->input->post('valor'),
       		'fecha' => $this->input->post('fecha'),
       		'hora' => $this->input->post('hora'),
        	'tipo' => $this->input->post('tipo'),
        	'observaciones' => $this->input->post('observaciones')
		);
		$this->db->insert('medidas', $nueva_medida_insert_data);
	}
	
	public function eliminar_medida($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('medidas');
	}
	
	public function actualizar_medida()
	{
		$nueva_medida_insert_data = array (
			'valor' => $this->input->post('valor'),
       		'fecha' => $this->input->post('fecha'),
       		'hora' => $this->input->post('hora'),
        	'tipo' => $this->input->post('tipo'),
        	'observaciones' => $this->input->post('observaciones')
		);
		$this->db->where('id', $this->uri->segment(3));
		$this->db->update('medidas', $nueva_medida_insert_data);
	}
	
	public function editar_medida($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('medidas');
		return $query->result();
	}	
	
	public function get_num_total()
	{
		$this->db->like('userid', $this->session->userdata('id'));
		$this->db->from('medidas');
		return $this->db->count_all_results();
	}
	
	public function get_total_medidas()
	{
		$this->db->order_by('fecha', 'asc');
		$this->db->order_by('tipo', 'asc');
		$this->db->where('userid', $this->session->userdata('id'));
		$query = $this->db->get('medidas');
		return $query->result();
	}

	public function get_total_medidas_limited_by($limit, $offset)
	{
		$this->db->order_by('fecha', 'asc');
		$this->db->order_by('tipo', 'asc');
		$this->db->limit($limit, $offset);
		$this->db->where('userid', $this->session->userdata('id'));
		$query = $this->db->get('medidas');
		return $query->result();
	}
	
	function get_last_medida_by_user($user)
	{
		$id = $user;
		$this->db->where('userid', $id);
		$this->db->order_by('fecha','desc');
		$this->db->order_by('tipo', 'desc');
		$this->db->limit(1);
		$query = $this->db->get('medidas');
		return $query->result();
	}
	
	function get_last_date_added_by_user($user)
	{
		$id = $user;
		$this->db->where('userid', $id);
		$this->db->order_by('fecha','desc');
		$this->db->order_by('tipo', 'desc');
		$this->db->limit(1);
		$this->db->select('fecha');
		$query = $this->db->get('medidas');
		return $query->result();
	}
	
	function get_medidas_by_date($date)
	{
		$id = $this->session->userdata('id');
		$this->db->where('userid', $id);
		$this->db->where('fecha', $date);
		$this->db->order_by('tipo', 'asc');
		$query = $this->db->get('medidas');
		return $query->result();
	}
	
	function get_medidas_between_dates($date_ini, $date_end)
	{
		$id = $this->session->userdata('id');
		$this->db->where('userid', $id);
		$this->db->where('fecha >=', $date_ini);
		$this->db->where('fecha <=', $date_end);
		$this->db->order_by('fecha', 'asc');
		$query = $this->db->get('medidas');
		return $query->result();
	}
	
	function get_count_medidas_between_dates($date_ini, $date_end)
	{
		$id = $this->session->userdata('id');
		$this->db->select('fecha, count(id) total');
		$this->db->where('userid', $id);
		$this->db->where('fecha >=', $date_ini);
		$this->db->where('fecha <=', $date_end);
		$this->db->group_by('fecha');
		$query = $this->db->get('medidas');
		return $query->result();
	}
	
	function get_user_from_medida($id)
	{
		$this->db->select('userid');
		$this->db->where('id', $id);
		$query = $this->db->get('medidas');
		return $query->result();
	}
	
	function existe_medida()
	{
		$id = $this->session->userdata('id');
		$this->db->where('userid', $id);
		$this->db->where('fecha =', $this->input->post('fecha'));
		$this->db->where('tipo =', $this->input->post('tipo'));
		$query = $this->db->get('medidas');
		if($query->num_rows == 1)
		{
			return true;
		}
		else {
			return false;
		}
	}
	
}