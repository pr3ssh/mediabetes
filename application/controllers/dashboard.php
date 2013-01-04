<?php

class Dashboard extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->is_logged_in();
	}

	function index()
	{
		
	}
	
	function is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');
		
		if(!isset($is_logged_in) || $is_logged_in != true )
		{
			/*$data['main_content'] = 'private_zone';
			$this->load->view('includes/template',$data);
			
			die();*/
			
			$this->session->set_flashdata('error_msg','You must be logged in to access restricted area');
	       	redirect('login/index');

		}
	}
}
