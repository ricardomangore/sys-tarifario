<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class CTRL_Recargo_Aereo extends OPX_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->model('recargo_aereo');
		$this->load->model('aerolinea');
		if(!$this->opx_auth->is_authenticated())
			redirect('login');
	}
	
	public function index(){
		/*if(!$this->opx_auth->is_authenticated())
			redirect('login');
		else*/
			$this->add();
			//echo "asdfasdf";		
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
		$data_dashboard['icon_title'] = 'calculator';
		$data_dashboard['header_dashboard'] = 'Recargo Aéreo';
		//Obtiene los valores de la tabla
		try{
			$data_recargo_aereo_form['rows'] = $this->recargo_aereo->get_recargos_aereos(); 
		}catch(Exception $e){
			$data_recargos_aereos_form['rows'] = NULL;
		}				
		//Se optienen y limpian los valores enviados desde el formulario
		$clave = xss_clean($this->input->post('clave'));
		$descripcion = xss_clean($this->input->post('descripcion'));
		$costo = xss_clean($this->input->post('costo'));
		$idaerolinea = xss_clean($this->input->post('idaerolinea'));
		//Se validan los valores
		try{
			$data_recargo_aereo_form['aerolineas'] = $this->aerolinea->get_aerolineas();
		}catch(Exception $e){
			$data_recargo_aereo_form['aerolineas'] = NULL;
		}
		$this->form_validation->set_rules('clave', 'Clave', 'required', array('required' => $this->lang->line('error_required_clave')));
		$this->form_validation->set_rules('costo', 'Costo', 'required', array('required' => $this->lang->line('error_required_costo')));
		$this->form_validation->set_rules('idaerolinea', 'ID Aerolínea', 'callback_aerolinea_check');
		if($this->form_validation->run() == FALSE){//Los valores no pasaron el test de validación
			$data_dashboard['content_dashboard'] = $this->load->view('recargo_aereo/add_form',$data_recargo_aereo_form,TRUE);
		}else{//Los valores aprobaron el test de validación
			$this->recargo_aereo->set_recargo_aereo(array(
													'clave' => $clave,
													'descripcion' => $descripcion,
													'costo' => $costo,
													'idaerolinea' => $idaerolinea
													));
		}	
		try{
			$data_recargo_aereo_form['rows'] = $this->recargo_aereo->get_recargos_aereos(); 
		}catch(Exception $e){
			$data_recargo_aereo_form['rows'] = NULL;
		}			
		$data_dashboard['content_dashboard'] = $this->load->view('recargo_aereo/add_form',$data_recargo_aereo_form,TRUE); 	
		$data['content'] = $this->load->view('system/dashboard',$data_dashboard,TRUE);
		$this->load->view('system/layout',$data);
	}
	
	/**
	 * Controlador para editar un registro de Aeropuerto
	 */
	public function edit($idrecargo_aereo = 0){
		$data_sidebar = array(
			'item_menu_dashboard' => '',
			'item_menu_fletes_maritimos' => '',
			'item_menu_fletes_aereos' => '',
			'item_menu_catalogos' => 'active',
		);
		$data_header['menu'] = $this->load->view('system/menu',NULL,TRUE);
		$data['header']   = $this->load->view('system/header',$data_header,TRUE);	
		$data_dashboard['sidebar'] = $this->load->view('system/sidebar',$data_sidebar,TRUE);		
		$data_dashboard['icon_title'] = 'calculator';
		$data_dashboard['header_dashboard'] = 'Recargo Aéreo';
		//Obtienen los datos de los recargos
		try{
			$result = $this->recargo_aereo->get_recargo_aereo_by_id($idrecargo_aereo);
			$data_recargo_aereo_form['idrecargo_aereo'] = $idrecargo_aereo;
			$data_recargo_aereo_form['clave'] = $result[0]['clave'];
			$data_recargo_aereo_form['costo'] = $result[0]['costo'];
			$data_recargo_aereo_form['descripcion'] = $result[0]['descripcion'];
			$data_recargo_aereo_form['idaerolinea'] = $result[0]['idaerolinea'];
			$data_recargo_aereo_form['rows'] = $this->recargo_aereo->get_recargos_aereos(); 
		}catch(Exception $e){
			$data_recargo_aereo_form['rows'] = NULL;
		}
		//Obtiene los valores de la tabla
		try{
			$data_recargo_aereo_form['rows'] = $this->recargo_aereo->get_recargos_aereos(); 
		}catch(Exception $e){
			$data_recargo_aereo_form['rows'] = NULL;
		}				
		//Se optienen y limpian los valores enviados desde el formulario
		$clave = xss_clean($this->input->post('clave'));
		$costo = xss_clean($this->input->post('costo'));
		$descripcion = xss_clean($this->input->post('descripcion'));
		$idaerolinea = xss_clean($this->input->post('idaerolinea'));
		$idrecargo_aereo = xss_clean($this->input->post('idrecargo_aereo'));
		//Se validan los valores
		$this->form_validation->set_rules('clave', 'Clave', 'required', array('required' => $this->lang->line('error_required_clave')));
		$this->form_validation->set_rules('costo', 'Costo', 'required', array('required' => $this->lang->line('error_required_costo')));
		$this->form_validation->set_rules('idaerolinea', 'ID Aerolínea', 'callback_aerolinea_check');
		if($this->form_validation->run() == FALSE){//Los valores no pasaron el test de validación
			$data_dashboard['content_dashboard'] = $this->load->view('recargo_aereo/edit_form',$data_recargo_aereo_form,TRUE);
		}else{//Los valores aprobaron el test de validación
			$this->recargo_aereo->update_recargo_aereo(array(
									'idrecargo_aereo' => $idrecargo_aereo,
									'idaerolinea' => $idaerolinea,
									'clave' => $clave, 
									'descripcion' => $descripcion,
									'costo' => $costo
								));
		}	
		try{
			$data_recargo_aereo_form['rows'] = $this->recargo_aereo->get_recargos_aereos(); 
		}catch(Exception $e){
			$data_recargo_aereo_form['rows'] = NULL;
		}			
		$data_recargo_aereo_form['aerolineas'] = $this->aerolinea->get_aerolineas();
		$data_dashboard['content_dashboard'] = $this->load->view('recargo_aereo/edit_form',$data_recargo_aereo_form,TRUE); 	
		$data['content'] = $this->load->view('system/dashboard',$data_dashboard,TRUE);
		$this->load->view('system/layout',$data);
	}

	/**
	 * Controlador para eliminar un registro de Aeropuerto
	 */
	 public function delete($idrecargo_aereo = 0){
		$data_sidebar = array(
			'item_menu_dashboard' => '',
			'item_menu_fletes_maritimos' => '',
			'item_menu_fletes_aereos' => '',
			'item_menu_catalogos' => 'active',
		);
		$data_header['menu'] = $this->load->view('system/menu',NULL,TRUE);
		$data['header']   = $this->load->view('system/header',$data_header,TRUE);	
		$data_dashboard['sidebar'] = $this->load->view('system/sidebar',$data_sidebar,TRUE);		
		$data_dashboard['icon_title'] = 'calculator';
		$data_dashboard['header_dashboard'] = 'Recargo Aéreo';
		//Obtienen los datos de los recargos
		try{
			$result = $this->recargo_aereo->get_recargo_aereo_by_id($idrecargo_aereo);
			$data_recargo_aereo_form['idrecargo_aereo'] = $idrecargo_aereo;
			$data_recargo_aereo_form['clave'] = $result[0]['clave'];
			$data_recargo_aereo_form['costo'] = $result[0]['costo'];
			$data_recargo_aereo_form['descripcion'] = $result[0]['descripcion'];
			$data_recargo_aereo_form['idaerolinea'] = $result[0]['idaerolinea'];
			$data_recargo_aereo_form['rows'] = $this->recargo_aereo->get_recargos_aereos(); 
		}catch(Exception $e){
			$data_recargo_aereo_form['rows'] = NULL;
		}
		//Obtiene los valores de la tabla
		try{
			$data_recargo_aereo_form['rows'] = $this->recargo_aereo->get_recargos_aereos(); 
		}catch(Exception $e){
			$data_recargo_aereo_form['rows'] = NULL;
		}				
		//Se optienen y limpian los valores enviados desde el formulario
		$clave = xss_clean($this->input->post('clave'));
		$costo = xss_clean($this->input->post('costo'));
		$descripcion = xss_clean($this->input->post('descripcion'));
		$idaerolinea = xss_clean($this->input->post('idaerolinea'));
		$idrecargo_aereo = xss_clean($this->input->post('idrecargo_aereo'));
		//Se validan los valores
		$this->form_validation->set_rules('clave', 'Clave', 'required', array('required' => $this->lang->line('error_required_clave')));
		$this->form_validation->set_rules('costo', 'Costo', 'required', array('required' => $this->lang->line('error_required_costo')));
		$this->form_validation->set_rules('idaerolinea', 'ID Aerolínea', 'callback_aerolinea_check');
		if($this->form_validation->run() == FALSE){//Los valores no pasaron el test de validación
			$data_dashboard['content_dashboard'] = $this->load->view('recargo_aereo/delete_form',$data_recargo_aereo_form,TRUE);
		}else{//Los valores aprobaron el test de validación
			try{
				$this->recargo_aereo->delete_recargo_aereo(array(
										'idrecargo_aereo' => $idrecargo_aereo,
										'idaerolinea' => $idaerolinea,
										'clave' => $clave, 
										'descripcion' => $descripcion,
										'costo' => $costo
									));
			}catch(Exception $e){
				var_dump($e->getCode());
				if($e->getCode() == 1999)
					$data_recargo_aereo_form['message'] = $this->lang->line('error_foreingkey_recargo_aereo'); 
			}
		}	
		try{
			$data_recargo_aereo_form['rows'] = $this->recargo_aereo->get_recargos_aereos(); 
		}catch(Exception $e){
			$data_recargo_aereo_form['rows'] = NULL;
		}			
		$data_recargo_aereo_form['aerolineas'] = $this->aerolinea->get_aerolineas();
		$data_dashboard['content_dashboard'] = $this->load->view('recargo_aereo/delete_form',$data_recargo_aereo_form,TRUE); 	
		$data['content'] = $this->load->view('system/dashboard',$data_dashboard,TRUE);
		$this->load->view('system/layout',$data); 	
	 }

	/**
	 * call_back_aerolinea
	 */
	 
	public function aerolinea_check($str){
		if($str == 'none'){
			$this->form_validation->set_message('aerolinea_check', 'Seleccione una aerolínea');
			return FALSE;
		}else{
			return TRUE;			
		}
	}	
}
