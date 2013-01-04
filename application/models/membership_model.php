<?php

class Membership_model extends CI_Model {
	
	function validate()
	{
		$this->db->where('username',$this->input->post('username'));
		$this->db->where('password',md5($this->input->post('password')));
		$query = $this->db->get('usuarios');
		
		if($query->num_rows == 1)
		{
			return true;
		}
	}
	
	function create_member()
	{
		$new_member_insert_data = array(
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			'email_address' => $this->input->post('email_address'),
			'username' => $this->input->post('username'),
			'password' => md5($this->input->post('password')),
			'role' => 3
		);
		
		$insert = $this->db->insert('usuarios', $new_member_insert_data);
		return $insert;
	}
	
	function get_id()
	{
		$this->db->where('username',$this->input->post('username'));
		$query = $this->db->get('usuarios');
		
		foreach ($query->result() as $row)
		{
		   $id = $row->id;
		}
		return $id;
	}
	
	function get_role()
	{
		$this->db->where('username',$this->input->post('username'));
		$query = $this->db->get('usuarios');
		
		foreach ($query->result() as $row)
		{
		   $role = $row->role;
		}
		return $role;
	}
	
	function existe_usuario($str)
	{
		$this->db->where('username',$str);
		$query = $this->db->get('usuarios');
		
		if($query->num_rows == 1)
		{
			return true;
		}
			
	}
}