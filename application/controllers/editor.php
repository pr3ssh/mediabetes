<?php

class Editor extends CI_Controller {
	
    // constructor
    public function Editor()
    {
        parent::__construct();
        $this->is_logged_in();
        $this->load->model('Editor_model');
    }

    public function index()
    {
        $this->manage();
    }
    
    /**
     * Gestiona medidas
     * @access public
     */
    public function manage()
    {
    	$start_row = $this->uri->segment(3);
    	$per_page = 3;
    	
    	if (trim($start_row) == 0)
    	{
    		$start_row = 0;
    	}
		if (trim($start_row) == 'id')  //he tenido que a–adir este id, porque coincidia igual que la id del row, entonces ahora el id del row est‡ en cuarta posici—n en uri en vez de la tercera posici—n
    	{
    		$start_row = 0;
    	}
    	
    	
    	$this->load->library('pagination');
    	$config['base_url'] = base_url() . 'index.php/editor/manage';
		$config['total_rows'] = $this->Editor_model->get_num_total();
		$config['per_page'] = $per_page;
		$this->pagination->initialize($config);
		
		$data['main_content'] = 'editor/editor_manage';
		$data['editores'] = $this->Editor_model->get_total_editores_limited_by($per_page, $start_row);
		$data['pagination'] = $this->pagination->create_links();
		$data['homecurrent'] = '';		
		$data['manage_editor'] = 'current';
		$data['add_editor'] = '';
		$this->load->view('includes/template_medida',$data);
    }
    
    /**
     * Edita un editor
     * @access public
     */
    public function editar_editor()
    {
    	
		$data = array();
		
		$query = $this->Editor_model->editar_editor();
		
		if($query)
		{
			$data['records'] = $query;			
		}
		
		$data['main_content'] = 'editor/editor_edit';
		$data['homecurrent'] = '';		
		$data['manage_editor'] = 'current';
		$data['add_editor'] = '';
		$this->load->view('includes/template_medida',$data);
    }
    
    /**
     * Actualiza un editor
     * @access public
     */
    public function update_editor()
    {
    	$this->load->library('form_validation');
        $this->form_validation->set_rules('first_name', 'Nombre', 'required|trim|xss_clean');
        $this->form_validation->set_rules('last_name', 'Apellido', 'required|trim|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|xss_clean|valid_email');
		
		if ($this->form_validation->run() == FALSE)
        {
        	//$this->load->view('medida/medida_add');
			$data['main_content'] = 'editor/editor_edit';
			$data['homecurrent'] = '';		
			$data['manage_editor'] = 'current';
			$data['add_editor'] = '';
			$this->load->view('includes/template_medida',$data);
        }
        else
        {
        	$this->Editor_model->actualizar_editor();
			$data['main_content'] = 'editor/editor_update_success';
			$data['homecurrent'] = '';		
			$data['manage_editor'] = 'current';
			$data['add_editor'] = '';
			$this->load->view('includes/template_medida',$data);
        }
    }    
    
    /**
     * Elimina un editor
     * @access public
     */
    public function delete_editor()
    {
        $this->Editor_model->eliminar_editor();
		redirect('editor/manage');
    }
    
    /**
     * Añade un nuevo editor
     * @access public
     */
    public function add()
    {
    	$data = array();
		$data['homecurrent'] = '';
		$data['add_editor'] = 'current';
		$data['manage_editor'] = '';
		$data['main_content'] = 'editor/editor_add';
		
		$this->load->view('includes/template_medida',$data);
    }    
    
    /**
     * Crea un editor
     * @access public
     */
    public function save()
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
			$this->add();
		}
		else
		{
			if($query = $this->Editor_model->create_editor())
			{
				$data['main_content'] = 'editor/editor_add_successful';				
				$data['homecurrent'] = '';
				$data['add_editor'] = 'current';
				$data['manage_editor'] = '';
				$this->load->view('includes/template_medida',$data);
			}
			else
			{
				$this->add();
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