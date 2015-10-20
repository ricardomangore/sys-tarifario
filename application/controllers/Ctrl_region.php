<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
	
class CTRL_Region extends OPX_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->model('region');
	}
	
	public function index(){
		if(!$this->opx_auth->is_authenticated())
			redirect('login');
		else
			$this->add();		
	}
	
	/**
	 * Controlador para agregar un registro de Región
	 */
	public function add(){
		$data_sidebar = array(
			'item_menu_dashboard' => '',
			'item_menu_fletes_maritimos' => '',
			'item_menu_fletes_aereos' => '',
			'item_menu_catalogos' => 'active',
		);
		$data_header['menu'] = $this->load->view('system/menu',NULL,TRUE);
		$data['header']   = $this->load->view('system/header',$data_header,TRUE);	
		$data_dashboard['sidebar'] = $this->load->view('system/sidebar',$data_sidebar,TRUE);		
		$data_dashboard['icon_title'] = 'map';
		$data_dashboard['header_dashboard'] = 'Regiones';
		
				
		//Se optienen y limpian los valores enviados desde el formulario
		$region = xss_clean($this->input->post('region'));
		if($this->form_validation->run() == FALSE){//Los valores no pasaron el test de validación
			try{
				$data_region_form['rows'] = $this->region->get_regiones(); 
			}catch(Exception $e){
				$data_region_form['rows'] = NULL;
			}			
			$data_dashboard['content_dashboard'] = $this->load->view('region/add_form',$data_region_form,TRUE); 	
			$data['content'] = $this->load->view('system/dashboard',$data_dashboard,TRUE);
			$this->load->view('system/layout',$data);
		}else{//Los valores aprobaron el test de validación
			$this->region->set_region(array('region' => $region));
			try{
				$data_region_form['rows'] = $this->region->get_regiones(); 
			}catch(Exception $e){
				$data_region_form['rows'] = NULL;
			}
			$data_region_form['message'] = "<i class='fa fa-check'></i> La región fue agregada exitosamente";			
			$data_dashboard['content_dashboard'] = $this->load->view('region/add_form',$data_region_form,TRUE); 	
			$data['content'] = $this->load->view('system/dashboard',$data_dashboard,TRUE);
			$this->load->view('system/layout',$data);			
		}	
	}
	
	/**
	 * Controlador para editar un registro de Región
	 */
	public function edit($idregion = 0){	
		$data_sidebar = array(
			'item_menu_dashboard' => '',
			'item_menu_fletes_maritimos' => '',
			'item_menu_fletes_aereos' => '',
			'item_menu_catalogos' => 'active',
		);
		$data_header['menu'] = $this->load->view('system/menu',NULL,TRUE);
		$data['header']   = $this->load->view('system/header',$data_header,TRUE);	
		$data_dashboard['sidebar'] = $this->load->view('system/sidebar',$data_sidebar,TRUE);		
		$data_dashboard['icon_title'] = 'map';
		$data_dashboard['header_dashboard'] = 'Regiones';
		try{
			$data_region_form['rows'] = $this->region->get_regiones();
		}catch(Exception $e){
			$data_region_form['rows'] = NULL;
		}
		//Se optienen y limpian los valores enviados desde el formulario
		$region_post = xss_clean($this->input->post('region'));
		$idregion_post = xss_clean($this->input->post('idregion'));
		if($this->form_validation->run() == FALSE){//Los valores no pasaron el test de validación
			try{
				$result = $this->region->get_region_by_id($idregion);
				$data_region_form['idregion'] = $idregion;
				$data_region_form['region'] = $result[0]['region']; 
			}catch(Exception $e){
				$data_region_form['idregion'] = NULL;
				$data_region_form['region'] = NULL;
			}				
		}else{//Los valores aprobaron el test de validación
			$this->region->update_region(array('region' => $region_post, 'idregion' => $idregion_post));		
			$data_region_form['idregion'] = $idregion_post;
			$data_region_form['region'] = $region_post; 
			$data_region_form['message'] = "<i class='fa fa-check'></i> La región fue modificada";
			try{
				$data_region_form['rows'] = $this->region->get_regiones();
			}catch(Exception $e){
				$data_region_form['rows'] = NULL;
			}						
		}	
		$data_dashboard['content_dashboard'] = $this->load->view('region/edit_form',$data_region_form,TRUE); 	
		$data['content'] = $this->load->view('system/dashboard',$data_dashboard,TRUE);
		$this->load->view('system/layout',$data);		
	}

	/**
	 * Controlador para eliminar un registro de Región
	 */
	 public function delete($idregion = 0){
		$data_sidebar = array(
			'item_menu_dashboard' => '',
			'item_menu_fletes_maritimos' => '',
			'item_menu_fletes_aereos' => '',
			'item_menu_catalogos' => 'active',
		);
		$data_header['menu'] = $this->load->view('system/menu',NULL,TRUE);
		$data['header']   = $this->load->view('system/header',$data_header,TRUE);	
		$data_dashboard['sidebar'] = $this->load->view('system/sidebar',$data_sidebar,TRUE);		
		$data_dashboard['icon_title'] = 'map';
		$data_dashboard['header_dashboard'] = 'Regiones';
		//Obtienen los datos de la región por ID
		try{
			$result = $this->region->get_region_by_id($idregion);
			$data_region_form['idregion'] = $idregion;
			$data_region_form['region'] = $result[0]['region'];
			$data_region_form['rows'] = $this->region->get_regiones(); 
		}catch(Exception $e){
			$data_region_form['rows'] = NULL;
		}
		//Obtiene los valores de la tabla
		try{
			$data_region_form['rows'] = $this->region->get_regiones(); 
		}catch(Exception $e){
			$data_region_form['rows'] = NULL;
		}
		if($idregion > 0)
			$data_region_form['message'] = "<i class='fa fa-warning'></i> Esta a punto de eliminar una región";				
		//Se optienen y limpian los valores enviados desde el formulario
		$region = xss_clean($this->input->post('region'));
		$idregion = xss_clean($this->input->post('idregion'));
		//Se validan los valores
		$this->form_validation->set_rules('region', 'Region', 'required', array('required' => $this->lang->line('error_required_region')));
		if($this->form_validation->run() == FALSE){//Los valores no pasaron el test de validación
			$data_dashboard['content_dashboard'] = $this->load->view('region/delete_form',$data_region_form,TRUE);
		}else{//Los valores aprobaron el test de validación
			$this->region->delete_region(array('region' => $region,'idregion' => $idregion));
			$data_region_form['message'] = "<i class='fa fa-check'></i> La región fue eliminada";
		}	
		try{
			$data_region_form['rows'] = $this->region->get_regiones(); 
		}catch(Exception $e){
			$data_region_form['rows'] = NULL;
		}			
		$data_dashboard['content_dashboard'] = $this->load->view('region/delete_form',$data_region_form,TRUE); 	
		$data['content'] = $this->load->view('system/dashboard',$data_dashboard,TRUE);
		$this->load->view('system/layout',$data);	 	
	 }
}
