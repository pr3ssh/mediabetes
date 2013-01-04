<?php

class Configuracion extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->is_logged_in();
	}
	
	function index()
	{
		$data = array();
		$this->load->model('configuracion_model');
		$query = $this->configuracion_model->get_info_user();
		
		if($query)
		{
			$data['records'] = $query;
		}
		$data['main_content'] = 'usuario/configuracion';
		$data['homecurrent'] = '';
		$data['add_medida'] = '';
		$data['last_medida'] = '';
		$data['manage_medida'] = '';
		$data['setup_user'] = 'current';
		$data['make_informe'] = '';
		$this->load->view('includes/template_medida',$data);
	}
	
	function update_member()
	{
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('first_name', 'Nombre', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Apellido', 'trim|required');
		$this->form_validation->set_rules('email_address', 'Email', 'trim|required|valid_email');
		
		//$this->form_validation->set_rules('email_medico', 'Email Medico', 'trim|valid_email');
		$this->form_validation->set_rules('debut_diabetico', 'Debut Diabetico', 'trim');
		//$this->form_validation->set_rules('tipo_insulina', 'Tipo Insulina', 'trim');
		$this->form_validation->set_rules('ciudad', 'Ciudad', 'trim');
		$this->form_validation->set_rules('provincia', 'Provincia', 'trim');
		
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
		$this->form_validation->set_rules('password2', 'Confirmar Password', 'trim|required|matches[password]');
		
		if($this->form_validation->run() == FALSE)
		{
			$this->index();
		}
		else
		{
			$this->load->model('configuracion_model');
			if($query = $this->configuracion_model->update_member())
			{				
				$data['main_content'] = 'usuario/configuracion_update';
				$data['homecurrent'] = '';
				$data['add_medida'] = '';
				$data['last_medida'] = '';
				$data['manage_medida'] = '';
				$data['setup_user'] = 'current';
				$data['make_informe'] = '';
				$this->load->view('includes/template_medida',$data);
			}
			else
			{				
				$data['main_content'] = 'usuario/configuracion_update';
				$data['homecurrent'] = '';
				$data['add_medida'] = '';
				$data['last_medida'] = '';
				$data['manage_medida'] = '';
				$data['setup_user'] = 'current';
				$data['make_informe'] = '';
				$this->load->view('includes/template_medida',$data);
			}
		}

	}
	
	function is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');
		
		if(!isset($is_logged_in) || $is_logged_in != true )
		{			
			$this->session->set_flashdata('error_msg','You must be logged in to access restricted area');
	       	redirect('login/index');

		}
	}

}