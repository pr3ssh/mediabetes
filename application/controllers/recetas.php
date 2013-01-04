<?php

class Recetas extends CI_Controller {
	
    // constructor
    public function Recetas()
    {
        parent::__construct();
        $this->is_logged_in();
        $this->load->model('Recetas_model');
        $this->load->model('Categoriarecetas_model');
    }

    public function index()
    {
        $this->manage();
    }
    
    /**
     * Gestiona recetas
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
    	$config['base_url'] = base_url() . 'index.php/recetas/manage';
		$config['total_rows'] = $this->Recetas_model->get_num_total();
		$config['per_page'] = $per_page;
		$this->pagination->initialize($config);
		
		$data['main_content'] = 'recetas/recetas_manage';
		$data['recetas'] = $this->Recetas_model->get_total_recetas_limited_by($per_page, $start_row);
		$data['pagination'] = $this->pagination->create_links();
		$data['homecurrent'] = '';		
		$data['manage_receta'] = 'current';
		$data['add_receta'] = '';
		$this->load->view('includes/template_medida',$data);
    }
    
    /**
     * Edita una receta
     * @access public
     */
    public function editar_receta()
    {
    	
		$data = array();
		
		$query = $this->Recetas_model->editar_receta();
		
		if($query)
		{
			$data['records'] = $query;			
		}
		
		$data['cat_recetas'] = $this->Categoriarecetas_model->get_categorias();
		$data['main_content'] = 'recetas/recetas_edit';
		$data['homecurrent'] = '';		
		$data['manage_receta'] = 'current';
		$data['add_receta'] = '';
		$this->load->view('includes/template_medida',$data);
    }
    
    /**
     * Actualiza una receta
     * @access public
     */
    public function update_receta()
    {
    	$this->load->library('form_validation');
        $this->form_validation->set_rules('titulo', 'Titulo', 'required|trim|xss_clean');
        $this->form_validation->set_rules('receta', 'Receta', 'required|trim|xss_clean');
		
		if ($this->form_validation->run() == FALSE)
        {        	
			$data['main_content'] = 'recetas/recetas_edit';
			$data['homecurrent'] = '';		
			$data['manage_receta'] = 'current';
			$data['add_receta'] = '';
			$this->load->view('includes/template_medida',$data);
        }
        else
        {
        	$receta_img_path_thumb = strtolower(random_string('alnum', 16));
			$this->Recetas_model->do_upload($receta_img_path_thumb);
			if($this->upload->display_errors() != '') {
				$receta_img_path_thumb=0;
			}
        	$this->Recetas_model->actualizar_receta($receta_img_path_thumb);
			$data['main_content'] = 'recetas/recetas_update_success';
			$data['homecurrent'] = '';		
			$data['manage_receta'] = 'current';
			$data['add_receta'] = '';
			$this->load->view('includes/template_medida',$data);
        }
    }    
    
    /**
     * Elimina una receta
     * @access public
     */
    public function delete_receta()
    {
        $this->Recetas_model->eliminar_receta();
		redirect('recetas/manage');
    }
    
    /**
     * Añade una nueva receta
     * @access public
     */
    public function add()
    {
    	$data = array();    	
    	$data['cat_recetas'] = $this->Categoriarecetas_model->get_categorias();
		$data['homecurrent'] = '';		
		$data['manage_receta'] = '';
		$data['add_receta'] = 'current';
		$data['main_content'] = 'recetas/recetas_add';
		
		$this->load->view('includes/template_medida',$data);
    }    
    
    /**
     * Crea una receta
     * @access public
     */
    public function save()
    {    	
        $this->load->library('form_validation');
		
		$this->form_validation->set_rules('titulo', 'Titulo', 'trim|required');
		$this->form_validation->set_rules('receta', 'Receta', 'trim|required');
		
		if($this->form_validation->run() == FALSE)
		{
			$this->add();
		}
		else
		{			
			$receta_img_path_thumb = strtolower(random_string('alnum', 16));
			$this->Recetas_model->do_upload($receta_img_path_thumb);
			if($this->upload->display_errors() != '') {
				$receta_img_path_thumb=0;
			}
			
			if($query = $this->Recetas_model->create_receta($receta_img_path_thumb))
			{				
				$data['cat_recetas'] = $this->Categoriarecetas_model->get_categorias();
				$data['main_content'] = 'recetas/recetas_add_successful';				
				$data['homecurrent'] = '';		
				$data['manage_receta'] = '';
				$data['add_receta'] = 'current';
				$this->load->view('includes/template_medida',$data);
			}
			else
			{
				$this->add();
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