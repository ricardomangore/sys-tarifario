<?php
if(!defined('BASEPATH'))exit('No direct script access allowed');

class CTRL_Aerolinea extends OPX_Controller{
	
	public function __construct(){
		parent::__construct();
		if(!$this->opx_auth->is_authenticated())
			redirect('login');
		$this->load->model('aerolinea');
	}
	
	public function index(){
		/*if(!$this->opx_auth->is_authenticated())
			redirect('login');
		else*/
			$this->add();		
	}
	
	/**
	 * Controlador para agregar un registro de Aerolínea
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
		$data_dashboard['icon_title'] = 'plane';
		$data_dashboard['header_dashboard'] = 'Aerolíneas';
		//Obtiene los valores de la tabla
		try{
			$data_aerolinea_form['rows'] = $this->aerolinea->get_aerolineas(); 
		}catch(Exception $e){
			$data_aerolinea_form['rows'] = NULL;
		}				
		//Se optienen y limpian los valores enviados desde el formulario
		$aerolinea = xss_clean($this->input->post('aerolinea'));
		//Se validan los valores
		$this->form_validation->set_rules('aerolinea', 'Aerolínea', 'required', array('required' => $this->lang->line('error_required_aerolinea')));
		if($this->form_validation->run() == FALSE){//Los valores no pasaron el test de validación
			$data_dashboard['content_dashboard'] = $this->load->view('aerolinea/add_form',$data_aerolinea_form,TRUE);
		}else{//Los valores aprobaron el test de validación
			$this->aerolinea->set_aerolinea(array('aerolinea' => $aerolinea));
		}	
		try{
			$data_aerolinea_form['rows'] = $this->aerolinea->get_aerolineas(); 
		}catch(Exception $e){
			$data_aerolinea_form['rows'] = NULL;
		}			
		$data_dashboard['content_dashboard'] = $this->load->view('aerolinea/add_form',$data_aerolinea_form,TRUE); 	
		$data['content'] = $this->load->view('system/dashboard',$data_dashboard,TRUE);
		$this->load->view('system/layout',$data);
	}
	
	/**
	 * Controlador para editar un registro de Aerolínea
	 */
	public function edit($idaerolinea = 0){
		$data_sidebar = array(
			'item_menu_dashboard' => '',
			'item_menu_fletes_maritimos' => '',
			'item_menu_fletes_aereos' => '',
			'item_menu_catalogos' => 'active',
		);
		$data_header['menu'] = $this->load->view('system/menu',NULL,TRUE);
		$data['header']   = $this->load->view('system/header',$data_header,TRUE);	
		$data_dashboard['sidebar'] = $this->load->view('system/sidebar',$data_sidebar,TRUE);		
		$data_dashboard['icon_title'] = 'plane';
		$data_dashboard['header_dashboard'] = 'Aerolíneas';
		//Obtienen los datos de la región por ID
		try{
			$result = $this->aerolinea->get_aerolinea_by_id($idaerolinea);
			$data_aerolinea_form['idaerolinea'] = $idaerolinea;
			$data_aerolinea_form['aerolinea'] = $result[0]['aerolinea'];
			$data_aerolinea_form['rows'] = $this->aerolinea->get_aerolineas(); 
		}catch(Exception $e){
			$data_aerolinea_form['rows'] = NULL;
		}
		//Obtiene los valores de la tabla
		try{
			$data_aerolinea_form['rows'] = $this->aerolinea->get_aerolineas(); 
		}catch(Exception $e){
			$data_aerolinea_form['rows'] = NULL;
		}				
		//Se optienen y limpian los valores enviados desde el formulario
		$aerolinea = xss_clean($this->input->post('aerolinea'));
		$idaerolinea = xss_clean($this->input->post('idaerolinea'));
		//Se validan los valores
		$this->form_validation->set_rules('aerolinea', 'Aerolínea', 'required', array('required' => $this->lang->line('error_required_aerolinea')));
		if($this->form_validation->run() == FALSE){//Los valores no pasaron el test de validación
			$data_dashboard['content_dashboard'] = $this->load->view('aerolinea/edit_form',$data_aerolinea_form,TRUE);
		}else{//Los valores aprobaron el test de validación
			$this->aerolinea->update_aerolinea(array('aerolinea' => $aerolinea, 'idaerolinea' => $idaerolinea));
		}	
		try{
			$data_aerolinea_form['rows'] = $this->aerolinea->get_aerolineas(); 
		}catch(Exception $e){
			$data_aerolineas_form['rows'] = NULL;
		}			
		$data_dashboard['content_dashboard'] = $this->load->view('aerolinea/edit_form',$data_aerolinea_form,TRUE); 	
		$data['content'] = $this->load->view('system/dashboard',$data_dashboard,TRUE);
		$this->load->view('system/layout',$data);
	}

	/**
	 * Controlador para eliminar un registro de Aerolinea
	 */
	 public function delete($idaerolinea = 0){
		$data_sidebar = array(
			'item_menu_dashboard' => '',
			'item_menu_fletes_maritimos' => '',
			'item_menu_fletes_aereos' => '',
			'item_menu_catalogos' => 'active',
		);
		$data_header['menu'] = $this->load->view('system/menu',NULL,TRUE);
		$data['header']   = $this->load->view('system/header',$data_header,TRUE);	
		$data_dashboard['sidebar'] = $this->load->view('system/sidebar',$data_sidebar,TRUE);		
		$data_dashboard['icon_title'] = 'plane';
		$data_dashboard['header_dashboard'] = 'Aerolíneas';
		//Obtienen los datos de la aerolinea por ID
		try{
			$result = $this->aerolinea->get_aerolinea_by_id($idaerolinea);
			$data_aerolinea_form['idaerolinea'] = $idaerolinea;
			$data_aerolinea_form['aerolinea'] = $result[0]['aerolinea'];
			$data_aerolinea_form['rows'] = $this->aerolinea->get_aerolineas(); 
		}catch(Exception $e){
			$data_aerolinea_form['rows'] = NULL;
		}
		//Obtiene los valores de la tabla
		try{
			$data_aerolinea_form['rows'] = $this->aerolinea->get_aerolineas(); 
		}catch(Exception $e){
			$data_aerolinea_form['rows'] = NULL;
		}				
		//Se optienen y limpian los valores enviados desde el formulario
		$aerolinea = xss_clean($this->input->post('aerolinea'));
		$idaerolinea = xss_clean($this->input->post('idaerolinea'));
		//Se validan los valores
		$this->form_validation->set_rules('aerolinea', 'Aerolínea', 'required', array('required' => $this->lang->line('error_required_aerolinea')));
		if($this->form_validation->run() == FALSE){//Los valores no pasaron el test de validación
			$data_dashboard['content_dashboard'] = $this->load->view('aerolinea/delete_form',$data_aerolinea_form,TRUE);
		}else{//Los valores aprobaron el test de validación
			try{
				$this->aerolinea->delete_aerolinea(array('aerolinea' => $aerolinea, 'idaerolinea' => $idaerolinea));
			}catch(Exception $e){
				if($e->getCode() == 1999)
					$data_aerolinea_form['message'] = $this->lang->line('error_foreingkey_aerolinea'); 
			}
		}	
		try{
			$data_aerolinea_form['rows'] = $this->aerolinea->get_aerolineas(); 
		}catch(Exception $e){
			$data_aerolinea_form['rows'] = NULL;
		}			
		$data_dashboard['content_dashboard'] = $this->load->view('aerolinea/delete_form',$data_aerolinea_form,TRUE); 	
		$data['content'] = $this->load->view('system/dashboard',$data_dashboard,TRUE);
		$this->load->view('system/layout',$data);	 	
	 }	
}