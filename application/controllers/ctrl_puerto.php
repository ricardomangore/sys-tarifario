<?php
if(!defined('BASEPATH'))
	exit('No direct script access allowed');
	
class CTRL_Puerto extends OPX_Controller{
	
	public function __construct(){
		parent::__construct();
		if(!$this->opx_auth->is_authenticated())
			redirect('login');
		$this->load->model('puerto');
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
		$data_dashboard['icon_title'] = 'anchor';
		$data_dashboard['header_dashboard'] = 'Puertos';
		//Obtiene los valores de la tabla
		try{
			$data_puerto_form['rows'] = $this->puerto->get_puertos(); 
		}catch(Exception $e){
			$data_puerto_form['rows'] = NULL;
		}				
		//Se optienen y limpian los valores enviados desde el formulario
		$puerto = xss_clean($this->input->post('puerto'));
		$locode = xss_clean($this->input->post('locode'));
		//Se validan los valores
		$this->form_validation->set_rules('puerto', 'Puerto', 'required', array('required' => $this->lang->line('error_required_puerto')));
		if($this->form_validation->run() == FALSE){//Los valores no pasaron el test de validación
			$data_dashboard['content_dashboard'] = $this->load->view('puerto/add_form',$data_puerto_form,TRUE);
		}else{//Los valores aprobaron el test de validación
			$this->puerto->set_puerto(array(
											'puerto' => $puerto,
											'locode' => $locode
											));
		}	
		try{
			$data_puerto_form['rows'] = $this->puerto->get_puertos(); 
		}catch(Exception $e){
			$data_puerto_form['rows'] = NULL;
		}			
		$data_dashboard['content_dashboard'] = $this->load->view('puerto/add_form',$data_puerto_form,TRUE); 	
		$data['content'] = $this->load->view('system/dashboard',$data_dashboard,TRUE);
		$this->load->view('system/layout',$data);
	}
	
	/**
	 * Controlador para editar un registro de Aeropuerto
	 */
	public function edit($idpuerto = 0){
		$data_sidebar = array(
			'item_menu_dashboard' => '',
			'item_menu_fletes_maritimos' => '',
			'item_menu_fletes_aereos' => '',
			'item_menu_catalogos' => 'active',
		);
		$data_header['menu'] = $this->load->view('system/menu',NULL,TRUE);
		$data['header']   = $this->load->view('system/header',$data_header,TRUE);	
		$data_dashboard['sidebar'] = $this->load->view('system/sidebar',$data_sidebar,TRUE);		
		$data_dashboard['icon_title'] = 'anchor';
		$data_dashboard['header_dashboard'] = 'Puertos';
		//Obtienen los datos del puerto por ID
		try{
			$result = $this->puerto->get_puerto_by_id($idpuerto);
			$data_puerto_form['idpuerto'] = $idpuerto;
			$data_puerto_form['puerto'] = $result[0]['puerto'];
			$data_puerto_form['locode'] = $result[0]['locode'];
		}catch(Exception $e){
			$data_puerto_form['rows'] = NULL;
		}
		//Obtiene los valores de la tabla
		try{
			$data_puerto_form['rows'] = $this->puerto->get_puertos(); 
		}catch(Exception $e){
			$data_puerto_form['rows'] = NULL;
		}				
		//Se optienen y limpian los valores enviados desde el formulario
		$puerto = xss_clean($this->input->post('puerto'));
		$idpuerto = xss_clean($this->input->post('idpuerto'));
		$locode = strtoupper(xss_clean($this->input->post('locode')));
		//Se validan los valores
		$this->form_validation->set_rules('puerto', 'Puerto', 'required', array('required' => $this->lang->line('error_required_puerto')));
		if($this->form_validation->run() == FALSE){//Los valores no pasaron el test de validación
			$data_dashboard['content_dashboard'] = $this->load->view('puerto/edit_form',$data_puerto_form,TRUE);
		}else{//Los valores aprobaron el test de validación
			$this->puerto->update_puerto(array(
									'puerto' => $puerto, 
									'idpuerto' => $idpuerto,
									'locode' => $locode
								));
		}	
		try{
			$data_puerto_form['rows'] = $this->puerto->get_puertos(); 
		}catch(Exception $e){
			$data_puertos_form['rows'] = NULL;
		}			
		$data_dashboard['content_dashboard'] = $this->load->view('puerto/edit_form',$data_puerto_form,TRUE); 	
		$data['content'] = $this->load->view('system/dashboard',$data_dashboard,TRUE);
		$this->load->view('system/layout',$data);
	}

	/**
	 * Controlador para eliminar un registro de Puerto
	 */
	 public function delete($idpuerto = 0){
		$data_sidebar = array(
			'item_menu_dashboard' => '',
			'item_menu_fletes_maritimos' => '',
			'item_menu_fletes_aereos' => '',
			'item_menu_catalogos' => 'active',
		);
		$data_header['menu'] = $this->load->view('system/menu',NULL,TRUE);
		$data['header']   = $this->load->view('system/header',$data_header,TRUE);	
		$data_dashboard['sidebar'] = $this->load->view('system/sidebar',$data_sidebar,TRUE);		
		$data_dashboard['icon_title'] = 'anchor';
		$data_dashboard['header_dashboard'] = 'Puertos';
		//Obtienen los datos de la aerolinea por ID
		try{
			$result = $this->puerto->get_puerto_by_id($idpuerto);
			$data_puerto_form['idpuerto'] = $idpuerto;
			$data_puerto_form['puerto'] = $result[0]['puerto'];
			$data_puerto_form['locode'] = $result[0]['locode'];
		}catch(Exception $e){
			$data_puerto_form['rows'] = NULL;
		}
		//Obtiene los valores de la tabla
		try{
			$data_puerto_form['rows'] = $this->puerto->get_puertos(); 
		}catch(Exception $e){
			$data_puerto_form['rows'] = NULL;
		}				
		//Se optienen y limpian los valores enviados desde el formulario
		$puerto = xss_clean($this->input->post('puerto'));
		$idpuerto = xss_clean($this->input->post('idpuerto'));
		$locode = strtoupper(xss_clean($this->input->post('locode')));
		//Se validan los valores
		$this->form_validation->set_rules('puerto', 'Puerto', 'required', array('required' => $this->lang->line('error_required_puerto')));
		if($this->form_validation->run() == FALSE){//Los valores no pasaron el test de validación
			$data_dashboard['content_dashboard'] = $this->load->view('puerto/delete_form',$data_puerto_form,TRUE);
		}else{//Los valores aprobaron el test de validación
			try{
				$this->puerto->delete_puerto(array('puerto' => $puerto, 'idpuerto' => $idpuerto));
			}catch(Exception $e){
				if($e->getCode() == 1999)
					$data_puerto_form['message'] = $this->lang->line('error_foreingkey_puerto'); 
			}
		}	
		try{
			$data_puerto_form['rows'] = $this->puerto->get_puertos(); 
		}catch(Exception $e){
			$data_puerto_form['rows'] = NULL;
		}			
		$data_dashboard['content_dashboard'] = $this->load->view('puerto/delete_form',$data_puerto_form,TRUE); 	
		$data['content'] = $this->load->view('system/dashboard',$data_dashboard,TRUE);
		$this->load->view('system/layout',$data);	 	
	 }
}