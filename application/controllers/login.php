<?php

class Login extends CI_Controller {
	
	function index()
	{
		
		$is_logged_in = $this->session->userdata('is_logged_in');
		if($is_logged_in == true )
		{
	        redirect('site/members_area');

		}else
		{
			$data['main_content'] = 'login_form';
			$this->load->view('includes/template',$data);
			
		}
	}
	
	function validate_credentials()
	{
		$this->load->model('membership_model');
		$query = $this->membership_model->validate();
		
		if($query)
		{
			$data = array(
				'id' => $this->membership_model->get_id(),
				'username' => $this->input->post('username'),				
				'role' => $this->membership_model->get_role(),
				'is_logged_in' => true
			);
			
			$this->session->set_userdata($data);
			redirect('site/members_area');
		}
		else
		{
			$this->index();
		}
	}
	
	function signup()
	{
		$data['main_content'] = 'signup_form';
		$this->load->view('includes/template',$data);
	}
	
	function create_member()
	{
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('first_name', 'Nombre', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Apellido', 'trim|required');
		$this->form_validation->set_rules('email_address', 'Email', 'trim|required|valid_email');
		
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]|callback_username_check');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
		$this->form_validation->set_rules('password2', 'Confirmar Password', 'trim|required|matches[password]');
		
		if($this->form_validation->run() == FALSE)
		{
			$this->signup();
		}
		else
		{
			$this->load->model('membership_model');
			if($query = $this->membership_model->create_member())
			{
				$data['main_content'] = 'signup_successful';
				$this->load->view('includes/template',$data);
			}
			else
			{
				$this->signup();
			}
		}
	}
	
	function username_check($str)
	{
		$this->load->model('membership_model');		
		if($this->membership_model->existe_usuario($str))
		{
			$this->form_validation->set_message('username_check','Nombre de usuario no disponible');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	function private_zone()
	{
		$data['main_content'] = 'private_zone';
		$this->load->view('includes/template',$data);
	}
	
	function logout()
	  {
	      $this->session->unset_userdata('username');
	      $this->session->unset_userdata('is_logged_in');
	      $this->session->sess_destroy();     
	      redirect('/');
	  }
}
