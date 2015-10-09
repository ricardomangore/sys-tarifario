<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class CTRL_Naviera extends OPX_Controller{
	
	public function __construct(){
		parent::__construct();
		if(!$this->opx_auth->is_authenticated())
			redirect('login');
		$this->load->model('naviera');
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
		$data_dashboard['icon_title'] = 'ship';
		$data_dashboard['header_dashboard'] = 'Navieras';
		//Obtiene los valores de la tabla
		try{
			$data_naviera_form['rows'] = $this->naviera->get_navieras(); 
		}catch(Exception $e){
			$data_naviera_form['rows'] = NULL;
		}				
		//Se optienen y limpian los valores enviados desde el formulario
		$naviera = xss_clean($this->input->post('naviera'));
		//Se validan los valores
		$this->form_validation->set_rules('naviera', 'Naviera', 'required', array('required' => $this->lang->line('error_required_naviera')));
		if($this->form_validation->run() == FALSE){//Los valores no pasaron el test de validación
			$data_dashboard['content_dashboard'] = $this->load->view('naviera/add_form',$data_naviera_form,TRUE);
		}else{//Los valores aprobaron el test de validación
			$this->naviera->set_naviera(array('naviera' => $naviera));
		}	
		try{
			$data_naviera_form['rows'] = $this->naviera->get_navieras(); 
		}catch(Exception $e){
			$data_naviera_form['rows'] = NULL;
		}			
		$data_dashboard['content_dashboard'] = $this->load->view('naviera/add_form',$data_naviera_form,TRUE); 	
		$data['content'] = $this->load->view('system/dashboard',$data_dashboard,TRUE);
		$this->load->view('system/layout',$data);
	}
	
	/**
	 * Controlador para editar un registro de Aerolínea
	 */
	public function edit($idnaviera = 0){
		$data_sidebar = array(
			'item_menu_dashboard' => '',
			'item_menu_fletes_maritimos' => '',
			'item_menu_fletes_aereos' => '',
			'item_menu_catalogos' => 'active',
		);
		$data_header['menu'] = $this->load->view('system/menu',NULL,TRUE);
		$data['header']   = $this->load->view('system/header',$data_header,TRUE);	
		$data_dashboard['sidebar'] = $this->load->view('system/sidebar',$data_sidebar,TRUE);		
		$data_dashboard['icon_title'] = 'ship';
		$data_dashboard['header_dashboard'] = 'Navieras';
		//Obtienen los datos de la región por ID
		try{
			$result = $this->naviera->get_naviera_by_id($idnaviera);
			$data_naviera_form['idnaviera'] = $idnaviera;
			$data_naviera_form['naviera'] = $result[0]['naviera'];
			$data_naviera_form['rows'] = $this->naviera->get_navieras(); 
		}catch(Exception $e){
			$data_naviera_form['rows'] = NULL;
		}
		//Obtiene los valores de la tabla
		try{
			$data_naviera_form['rows'] = $this->naviera->get_navieras(); 
		}catch(Exception $e){
			$data_naviera_form['rows'] = NULL;
		}				
		//Se optienen y limpian los valores enviados desde el formulario
		$naviera = xss_clean($this->input->post('naviera'));
		$idnaviera = xss_clean($this->input->post('idnaviera'));
		//Se validan los valores
		$this->form_validation->set_rules('naviera', 'Naviera', 'required', array('required' => $this->lang->line('error_required_naviera')));
		if($this->form_validation->run() == FALSE){//Los valores no pasaron el test de validación
			$data_dashboard['content_dashboard'] = $this->load->view('naviera/edit_form',$data_naviera_form,TRUE);
		}else{//Los valores aprobaron el test de validación
			$this->naviera->update_naviera(array('naviera' => $naviera, 'idnaviera' => $idnaviera));
		}	
		try{
			$data_naviera_form['rows'] = $this->naviera->get_navieras(); 
		}catch(Exception $e){
			$data_navieras_form['rows'] = NULL;
		}			
		$data_dashboard['content_dashboard'] = $this->load->view('naviera/edit_form',$data_naviera_form,TRUE); 	
		$data['content'] = $this->load->view('system/dashboard',$data_dashboard,TRUE);
		$this->load->view('system/layout',$data);
	}

	/**
	 * Controlador para eliminar un registro de naviera
	 */
	 public function delete($idnaviera = 0){
		$data_sidebar = array(
			'item_menu_dashboard' => '',
			'item_menu_fletes_maritimos' => '',
			'item_menu_fletes_aereos' => '',
			'item_menu_catalogos' => 'active',
		);
		$data_header['menu'] = $this->load->view('system/menu',NULL,TRUE);
		$data['header']   = $this->load->view('system/header',$data_header,TRUE);	
		$data_dashboard['sidebar'] = $this->load->view('system/sidebar',$data_sidebar,TRUE);		
		$data_dashboard['icon_title'] = 'ship';
		$data_dashboard['header_dashboard'] = 'Naviera';
		//Obtienen los datos de la naviera por ID
		try{
			$result = $this->naviera->get_naviera_by_id($idnaviera);
			$data_naviera_form['idnaviera'] = $idnaviera;
			$data_naviera_form['naviera'] = $result[0]['naviera'];
			$data_naviera_form['rows'] = $this->naviera->get_navieras(); 
		}catch(Exception $e){
			$data_naviera_form['rows'] = NULL;
		}
		//Obtiene los valores de la tabla
		try{
			$data_naviera_form['rows'] = $this->naviera->get_navieras(); 
		}catch(Exception $e){
			$data_naviera_form['rows'] = NULL;
		}				
		//Se optienen y limpian los valores enviados desde el formulario
		$naviera = xss_clean($this->input->post('naviera'));
		$idnaviera = xss_clean($this->input->post('idnaviera'));
		//Se validan los valores
		$this->form_validation->set_rules('naviera', 'NAviera', 'required', array('required' => $this->lang->line('error_required_naviera')));
		if($this->form_validation->run() == FALSE){//Los valores no pasaron el test de validación
			$data_dashboard['content_dashboard'] = $this->load->view('naviera/delete_form',$data_naviera_form,TRUE);
		}else{//Los valores aprobaron el test de validación
			try{
				$this->naviera->delete_naviera(array('naviera' => $naviera, 'idnaviera' => $idnaviera));
			}catch(Exception $e){
				if($e->getCode() == 1999)
					$data_naviera_form['message'] = $this->lang->line('error_foreingkey_naviera'); 
			}
		}	
		try{
			$data_naviera_form['rows'] = $this->naviera->get_navieras(); 
		}catch(Exception $e){
			$data_naviera_form['rows'] = NULL;
		}			
		$data_dashboard['content_dashboard'] = $this->load->view('naviera/delete_form',$data_naviera_form,TRUE); 	
		$data['content'] = $this->load->view('system/dashboard',$data_dashboard,TRUE);
		$this->load->view('system/layout',$data);	 	
	 }
}
