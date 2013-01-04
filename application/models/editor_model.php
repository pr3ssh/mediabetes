<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Editor_model extends CI_Model 
{
		
	public function Editor_model()
	{
		parent::__construct();
	}
		
	public function eliminar_editor()
	{
		$this->db->where('id', $this->uri->segment(4));
		$this->db->delete('usuarios');
	}
	
	public function actualizar_editor()
	{
		$nuevo_editor_insert_data = array (
			'first_name' => $this->input->post('first_name'),
       		'last_name' => $this->input->post('last_name'),
       		'email_address' => $this->input->post('email')
		);
		$this->db->where('id', $this->uri->segment(3));
		$this->db->update('usuarios', $nuevo_editor_insert_data);
	}
	
	public function editar_editor()
	{
		$this->db->where('id', $this->uri->segment(3));
		$query = $this->db->get('usuarios');
		return $query->result();
	}	
	
	public function get_num_total()
	{
		$this->db->like('role', '2');
		$this->db->from('usuarios');
		return $this->db->count_all_results();
	}

	public function get_total_editores_limited_by($limit, $offset)
	{
		$this->db->order_by('id', 'asc');
		$this->db->limit($limit, $offset);
		$this->db->where('role', '2');
		$query = $this->db->get('usuarios');
		return $query->result();
	}
	
	function create_editor()
	{
		$new_member_insert_data = array(
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			'email_address' => $this->input->post('email_address'),
			'username' => $this->input->post('username'),
			'password' => md5($this->input->post('password')),
			'role' => 2
		);
		
		$insert = $this->db->insert('usuarios', $new_member_insert_data);
		return $insert;
	}
	
}
