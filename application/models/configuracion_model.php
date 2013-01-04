<?php

class Configuracion_model extends CI_Model {
	
	function get_info_user()
	{
		$id=$this->session->userdata('id');
		$this->db->where('id', $id);
		$query = $this->db->get('usuarios');
		return $query->result();
	}
	
	function get_first_name_user()
	{
		$id=$this->session->userdata('id');
		$this->db->where('id', $id);
		$query = $this->db->select('first_name');
		$query = $this->db->get('usuarios');
		return $query->result();
	}
	
	function update_member()
	{
		$data = array(
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			'email_address' => $this->input->post('email_address'),
			//'email_medico' => $this->input->post('email_medico'),
			'debut_diabetico' => $this->input->post('debut_diabetico'),
			//'tipo_insulina' => $this->input->post('tipo_insulina'),
			'ciudad' => $this->input->post('ciudad'),
			'provincia' => $this->input->post('provincia'),
			'username' => $this->input->post('username'),
			'password' => md5($this->input->post('password'))
		);
		$this->db->where('id', $this->session->userdata('id'));
		$this->db->update('usuarios', $data);
	}
	
}