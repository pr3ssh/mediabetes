<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Recetas_model extends CI_Model 
{
	var $receta_img_path;
	var $receta_img_path_thumb;
		
	public function Recetas_model()
	{
		parent::__construct();
		
		$this->load->helper('string');
		$this->receta_img_path = realpath(APPPATH . '../uploads');
	}
		
	public function eliminar_receta()
	{
		$this->db->where('id', $this->uri->segment(4));
		$this->db->delete('recetas');
	}
	
	public function actualizar_receta($receta_img_path_thumb)
	{
		$nueva_receta_insert_data = array (
			'titulo' => $this->input->post('titulo'),
       		'receta' => $this->input->post('receta'),
       		'categoria' => $this->input->post('categoria'),
       		'imagen' => $receta_img_path_thumb
		);
		$this->db->where('id', $this->uri->segment(3));
		$this->db->update('recetas', $nueva_receta_insert_data);
	}
	
	public function editar_receta()
	{
		$this->db->where('id', $this->uri->segment(3));
		$query = $this->db->get('recetas');
		return $query->result();
	}	
	
	public function get_num_total()
	{
		$this->db->like('userid', $this->session->userdata('id'));
		$this->db->from('recetas');
		return $this->db->count_all_results();
	}

	public function get_total_recetas_limited_by($limit, $offset)
	{
		$this->db->order_by('id', 'asc');
		$this->db->limit($limit, $offset);
		$this->db->where('userid', $this->session->userdata('id'));
		$query = $this->db->get('recetas');
		return $query->result();
	}
	
	function create_receta($receta_img_path_thumb)
	{
		$new_receta_insert_data = array(
			'userid' => $this->session->userdata('id'),
			'titulo' => $this->input->post('titulo'),
			'receta' => $this->input->post('receta'),
       		'categoria' => $this->input->post('categoria'),
       		'imagen' => $receta_img_path_thumb
		);
		
		$insert = $this->db->insert('recetas', $new_receta_insert_data);
		return $insert;
	}
	
	public function do_upload($receta_img_path_thumb) 
	{				
		//$receta_img_path_thumb = strtolower(random_string('alnum', 16));
		$data['receta_img'] = $receta_img_path_thumb;
		$config = array(
			'allowed_types' => 'jpg',
			'upload_path' => $this->receta_img_path,
			'max_size' => 2000,
			'file_name' => $receta_img_path_thumb
		);
		
		$this->load->library('upload', $config);
		$check_file_upload = $this->upload->do_upload();
		$image_data = $this->upload->data();
		
		$config = array(
			'source_image' => $image_data['full_path'],
			'new_image' => $this->receta_img_path . '/recetas',
			'maintain_ration' => true,
			'width' => 150,
			'height' => 100
		);
		
		$this->load->library('image_lib', $config);
		$this->image_lib->resize();
		
	}
	
	function get_receta_img()
	{
		return $this->$receta_img_path_thumb;
	}

	
}
