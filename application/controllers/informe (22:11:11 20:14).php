<?php

require_once(APPPATH.'/libraries/excel.php');
require_once(APPPATH.'/libraries/excel-ext.php');

class Informe extends CI_Controller {
	
    // constructor
    public function informe()
    {
        parent::__construct();
        $this->is_logged_in();
        $this->load->model('Medida_model');
    }

    public function index()
    {
        $this->make();
    }
    
    /**
     * Crear un informe de medidas
     * @access public
     */
    public function make()
    {
			
    	if (($this->input->post('fecha_inicio') == null) && ($this->input->post('fecha_fin') == null)) {
    		$date_ini = date('Y-m-d');
    		$date_end = date('Y-m-d');
    	}
    	elseif (($this->input->post('fecha_inicio') != null) && ($this->input->post('fecha_fin') == null)) {
    		$date_ini = $this->input->post('fecha_inicio');
    		$date_end = date('Y-m-d');
    	}
    	elseif (($this->input->post('fecha_inicio') == null) && ($this->input->post('fecha_fin') != null)) {
    		$date_ini = date('Y-m-d');
    		$date_end = $this->input->post('fecha_fin');
    	}
    	else {
    		$date_ini = $this->input->post('fecha_inicio');
    		$date_end = $this->input->post('fecha_fin');
    		
    		$medidas = $this->Medida_model->get_medidas_between_dates($date_ini,$date_end);
			foreach ($medidas as $medida) {
				$observa = strip_tags($medida->observaciones);
				if ( $medida->tipo == 0) $nombre_tipo='Antes del desayuno';
				else if ( $medida->tipo == 1) $nombre_tipo='Despues del desayuno';
				else if ( $medida->tipo == 2) $nombre_tipo='Antes del almuerzo';
				else if ( $medida->tipo == 3) $nombre_tipo='Despues del almuerzo';
				else if ( $medida->tipo == 4) $nombre_tipo='Antes de la cena';
				else if ( $medida->tipo == 5) $nombre_tipo='Despues de la cena';
				else if ( $medida->tipo == 6) $nombre_tipo='Madrugada';
				$datos_medida[] = array('valor' => $medida->valor,'fecha' => $medida->fecha,'hora' => $medida->hora,'tipo' => $nombre_tipo,'observaciones' => $observa);
				//echo $medida->valor.' '.$medida->fecha.' '.$medida->hora.' '.$medida->tipo.' '.$medida->observaciones;
			}
			
		//	$data2[0] = '1';
		//	$data2[1] = '2';
			// Generamos el Excel 
	  		//$aux2="informe-medidas.xls";
      	//	createExcel($aux2, $data2);
			
			$this->load->model('configuracion_model');
			$query = $this->configuracion_model->get_info_user();
			
			if($query)
			{
				$data['usuario'] = $query;
			}
			foreach($data['usuario'] as $usuario) {
				$nombre = $usuario->first_name;
				$apellido = $usuario->last_name;
				$email = $usuario->email_address;
			}
			
			date_default_timezone_set('Europe/Madrid');
			
            $this->load->library('cezpdf');
            $this->load->helper('pdf_helper');
            prep_pdf();
			$this->cezpdf->addLink('http://www.mediabetes.es/',450,800,550,820);
			$this->cezpdf->addJpegFromFile("images/mediabetes-interior.jpg",450,800,100);
            $this->cezpdf->ezText('<b>Informe para el usuario:</b> '.$nombre.' '.$apellido);
			$this->cezpdf->ezText('<b>Email del usuario:</b> '.$email);
            $this->cezpdf->ezText('<b>Fecha y hora de impresion:</b> '.date('d-m-Y').', '.date('H:i').' hrs.');
            $this->cezpdf->ezText('');
   
            $col_names = array(
                'valor' => 'Valor',
                'fecha' => 'Fecha',
                'hora' => 'Hora',
                'tipo' => 'Momento',
                'observaciones' => 'Observaciones'
            );
   
            $this->cezpdf->ezTable($datos_medida, $col_names, 'Informe de medidas de azucar en sangre', array('width'=>550));
           
            $this->cezpdf->ezStream(array('Content-Disposition'=>'informe.pdf'));

    		
    	}
		
		$data['main_content'] = 'informes/informe_make';
		//$data['medidas'] = $this->Medida_model->get_medidas_between_dates($date_ini,$date_end);
		

      	
		$data['fecha_inicio'] = $date_ini;
		$data['fecha_fin'] = $date_end;
		$data['homecurrent'] = '';
		$data['add_medida'] = '';
		$data['last_medida'] = '';
		$data['manage_medida'] = '';
		$data['make_informe'] = 'current';
		$data['setup_user'] = '';
		$this->load->view('includes/template_medida',$data);
    }

    
   
   
   
   function is_logged_in()
   {
   		$is_logged_in = $this->session->userdata('is_logged_in');
       
        if(!isset($is_logged_in) || $is_logged_in != true )
        {           
            $this->session->set_flashdata('error_msg','You must be logged in to access restricted area');
               redirect('login/private_zone');
        }
    }
    
}
