<?php

class Site extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->is_logged_in();
	}

	function members_area()
	{	
		$data = array();
		
		$this->load->library('simplepie');
		
		$this->simplepie->set_feed_url('http://www.fedesp.es/portal/1/rss.aspx?idportal=1'); /*RSS para el DASHBOARD */
		$this->simplepie->set_cache_location(APPPATH.'cache/rss');
		$this->simplepie->init();
		$this->simplepie->handle_content_type();
		$data['res_feed'] = $this->simplepie->get_items(0,5);


		
		//ultima medida
		$this->load->model('Medida_model');
		
		//Obtenemos la fecha de la última medida
		$query_fecha = $this->Medida_model->get_last_date_added_by_user($this->session->userdata('id'));
		
		if($query_fecha)
		{
			$medida_fecha['medida'] = $query_fecha;
		
		
		//Obtenemos todas las medidas de la última fecha añadida
		foreach($medida_fecha['medida'] as $fecha) {
				$data['medida_dia'] = $this->Medida_model->get_medidas_by_date($fecha->fecha);
			}
		
		}
		$query = $this->Medida_model->get_last_medida_by_user($this->session->userdata('id'));
		
		if($query)
		{
			$data['medida'] = $query;
		}
		else {
			$data['medida'] = '';
		}
		
		$dia_max=0;
		$dia_min=10000;
		$dia_media=0;
		$dia_suma = 0;
		$ctd_medidas_tomadas = 0;
		for($i=1;$i<8;$i++) {
				$dia[$i]=0;
		}
		
		if($query_fecha){
		foreach($data['medida_dia'] as $m_dia) {
				if($m_dia->valor != NULL) {
					$ctd_medidas_tomadas++;
					$dia[$m_dia->tipo] = $m_dia->valor;
					if ( $m_dia->valor > $dia_max ) $dia_max = $m_dia->valor;
					if ( $m_dia->valor < $dia_min ) $dia_min = $m_dia->valor;
					$dia_suma = $dia_suma + $m_dia->valor;
				}
		}
		}
		
		if ($ctd_medidas_tomadas > 0) $dia_media = round($dia_suma / $ctd_medidas_tomadas);
		
		$data['dia_max'] = $dia_max;
		$data['dia_min'] = $dia_min;
		$data['dia_media'] = $dia_media;
		
		//nombre de usuario
		$this->load->model('configuracion_model');
		$query = $this->configuracion_model->get_info_user();
		
		if($query)
		{
			$data['records'] = $query;
		}
		
		$data['main_content'] = 'dashboard';
		$data['homecurrent'] = 'current';
		$data['add_medida'] = '';
		$data['last_medida'] = '';
		$data['manage_medida'] = '';
		$data['make_informe'] = '';
		$data['setup_user'] = '';
		$data['manage_editor'] = '';
		$data['add_editor'] = '';
		$data['manage_receta'] = '';
		$data['add_receta'] = '';
		$this->load->view('includes/template_medida_dashboard',$data);
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