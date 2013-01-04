<?php

class Medida extends CI_Controller {
	
    // constructor
    public function Medida()
    {
        parent::__construct();
        $this->is_logged_in();
        $this->load->model('Medida_model');
        $this->load->model('Tipomedida_model');
    }

    public function index()
    {
        $this->add();
    }
    
    /**
     * Gestiona medidas
     * @access public
     */
    public function manage()
    {
    	$start_row = $this->uri->segment(3);
    	//echo $start_row;
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
    	$config['base_url'] = base_url() . 'index.php/medida/manage';
		$config['total_rows'] = $this->Medida_model->get_num_total();
		$config['per_page'] = $per_page;
		$this->pagination->initialize($config);
		
		$data['main_content'] = 'medida/medida_manage_old';
		$data['medidas'] = $this->Medida_model->get_total_medidas_limited_by($per_page, $start_row);
		$data['pagination'] = $this->pagination->create_links();
		$data['homecurrent'] = '';
		$data['add_medida'] = '';
		$data['last_medida'] = '';
		$data['manage_medida'] = 'current';
		$data['make_informe'] = '';
		$data['setup_user'] = '';
		$this->load->view('includes/template_medida',$data);
    }
    
    /**
     * Gestiona medidas
     * @access public
     */
    public function manage_per_day()
    {
    	if ($this->input->post('fecha') == null)
    	{
    		$date = date('Y-m-d');
    	} else {
    		$date = $this->input->post('fecha');
    	}
		
		$data['main_content'] = 'medida/medida_manage';
		$data['medidas'] = $this->Medida_model->get_medidas_by_date($date);
		$data['fecha'] = $date;
		$data['homecurrent'] = '';
		$data['add_medida'] = '';
		$data['last_medida'] = '';
		$data['manage_medida'] = 'current';
		$data['make_informe'] = '';
		$data['setup_user'] = '';
		$this->load->view('includes/template_medida',$data);
    }

    /**
     * A–ñade una nueva medida
     * @access public
     */
    public function add()
    {
    	$data = array();
    	$data['tipos'] = $this->Tipomedida_model->get_tipos_medida();
		$data['homecurrent'] = '';
		$data['add_medida'] = 'current';
		$data['last_medida'] = '';
		$data['manage_medida'] = '';
		$data['make_informe'] = '';
		$data['setup_user'] = '';    	
		$data['main_content'] = 'medida/medida_add';
		
		$this->load->view('includes/template_medida',$data);
    }
    
    /**
     * Elimina una medida
     * @access public
     */
    public function delete()
    {
    	$idmedida = $this->uri->segment(4);
    	$user = $this->Medida_model->get_user_from_medida($idmedida);
    	if (!isset($user[0])) {
    		//No existe la medida a la que se quiere acceder...
    		//Do nothing
    	}
    	else {
    		if($user[0]->userid != $this->session->userdata('id')) {
    			//Do nothing
    		}
    		else {
    			$this->Medida_model->eliminar_medida($idmedida);
				redirect('medida/manage_per_day');
    		}
    	}
    }

    /**
     * Edita una medida
     * @access public
     */
    public function editar_medida()
    {
    	$idmedida = $this->uri->segment(3);
    	$user = $this->Medida_model->get_user_from_medida($idmedida);
    	if (!isset($user[0])) {
    		//No existe la medida a la que se quiere acceder...
    		$data['main_content'] = 'medida/medida_deny';
			$data['homecurrent'] = '';
			$data['add_medida'] = '';
			$data['last_medida'] = '';
			$data['manage_medida'] = 'current';
			$data['make_informe'] = '';
			$data['setup_user'] = ''; 
			$this->load->view('includes/template_medida',$data);
    	}
    	else {
	    	if($user[0]->userid != $this->session->userdata('id')) {
	    		$data['main_content'] = 'medida/medida_deny';
				$data['homecurrent'] = '';
				$data['add_medida'] = '';
				$data['last_medida'] = '';
				$data['manage_medida'] = 'current';
				$data['make_informe'] = '';
				$data['setup_user'] = ''; 
				$this->load->view('includes/template_medida',$data);
	    	}
	    	else {
	    		$data = array();
				$query = $this->Medida_model->editar_medida($idmedida);
				if($query)
				{
					$data['records'] = $query;			
				}
		    	$data['tipos'] = $this->Tipomedida_model->get_tipos_medida();
				$data['main_content'] = 'medida/medida_edit';
				$data['homecurrent'] = '';
				$data['add_medida'] = '';
				$data['last_medida'] = '';
				$data['manage_medida'] = 'current';
				$data['make_informe'] = '';
				$data['setup_user'] = ''; 
				$this->load->view('includes/template_medida',$data);
	    	}
    	}
    }
	
    /**
     * Actualiza una medida
     * @access public
     */
    public function update_medida()
    {
    	$this->load->library('form_validation');
        $this->form_validation->set_rules('valor', 'Valor', 'required|trim|max_length[3]|numeric|xss_clean|callback_positivo');
        $this->form_validation->set_rules('fecha', 'Fecha', 'required|trim|xss_clean|callback_no_es_futuro');
        $this->form_validation->set_rules('hora', 'Hora', 'required|trim|xss_clean');
        $this->form_validation->set_rules('observaciones', 'Observaciones', 'trim|max_length[100]|xss_clean');
		
		if ($this->form_validation->run() == FALSE)
        {
        	//$this->load->view('medida/medida_add');
			$data['main_content'] = 'medida/medida_edit';
			$data['homecurrent'] = '';
			$data['add_medida'] = '';
			$data['last_medida'] = '';
			$data['manage_medida'] = 'current';
			$data['make_informe'] = '';
			$data['setup_user'] = ''; 
			$this->load->view('includes/template_medida',$data);
        }
        else
        {
        	$this->Medida_model->actualizar_medida();
        	//$this->load->view('medida/medida_success');
			$data['main_content'] = 'medida/medida_update_success';
			$data['homecurrent'] = '';
			$data['add_medida'] = '';
			$data['last_medida'] = '';
			$data['manage_medida'] = 'current';
			$data['make_informe'] = '';
			$data['setup_user'] = ''; 
			$this->load->view('includes/template_medida',$data);
        }
    }    


    /**
     * Guarda una medida
     * @access public
     */
    public function save()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('valor', 'Valor', 'required|trim|max_length[3]|numeric|xss_clean|callback_positivo');
        $this->form_validation->set_rules('fecha', 'Fecha', 'required|trim|xss_clean|callback_no_es_futuro');
        $this->form_validation->set_rules('hora', 'Hora', 'required|trim|xss_clean');
        $this->form_validation->set_rules('observaciones', 'Observaciones', 'trim|max_length[100]|xss_clean');
        if ($this->form_validation->run() == FALSE)
        {
			$data['tipos'] = $this->Tipomedida_model->get_tipos_medida();
			$data['main_content'] = 'medida/medida_add';
			$data['homecurrent'] = '';
			$data['add_medida'] = 'current';
			$data['last_medida'] = '';
			$data['manage_medida'] = '';
			$data['make_informe'] = '';
			$data['setup_user'] = ''; 
			$this->load->view('includes/template_medida',$data);
        }
        else
        {
        	//Comprueba si la medida ya existe
        	if ($this->Medida_model->existe_medida()) {
        		$data['main_content'] = 'medida/medida_repeat';
				$data['homecurrent'] = '';
				$data['add_medida'] = 'current';
				$data['last_medida'] = '';
				$data['manage_medida'] = '';
				$data['make_informe'] = '';
				$data['setup_user'] = ''; 
				$this->load->view('includes/template_medida',$data);	
        	}
        	else {
        		$this->Medida_model->insertar_medida();
				$data['tipos'] = $this->Tipomedida_model->get_tipos_medida();
				$data['main_content'] = 'medida/medida_success';
				$data['homecurrent'] = '';
				$data['add_medida'] = 'current';
				$data['last_medida'] = '';
				$data['manage_medida'] = '';
				$data['make_informe'] = '';
				$data['setup_user'] = ''; 
				$this->load->view('includes/template_medida',$data);
        	}
        }
    }
	
	/**
     * Comprueba que una medida es positiva
     * @access private
     */
	function positivo($valor) {
		if($valor<0)
		{
			$this->form_validation->set_message('positivo','El valor debe ser positivo');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	/**
     * Comprueba que el día no es futuro
     * @access private
     */
	function no_es_futuro($fecha) {
		date_default_timezone_set('Europe/Madrid');
		if($fecha>date('Y-m-d'))
		{
			$this->form_validation->set_message('no_es_futuro','La fecha no puede ser futura');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
    
    function ultima_medida()
	{
		$data = array();
		$query = $this->Medida_model->get_last_medida_by_user($this->session->userdata('id'));
		
		if($query)
		{
			$data['records'] = $query;
		}
		
		$data['main_content'] = 'medida/ultima_medida';
		$data['homecurrent'] = '';
		$data['add_medida'] = '';
		$data['last_medida'] = 'current';
		$data['manage_medida'] = '';
		$data['make_informe'] = '';
		$data['setup_user'] = ''; 
		$this->load->view('includes/template_medida',$data);
		
	}
	
	
	function medida_check($str)
	{
		if($this->Medida_model->existe_medida($str))
		{
			$this->form_validation->set_message('medida_check','Ya existe una medida para esos valores.');
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
