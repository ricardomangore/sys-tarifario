<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class CTRL_Recargo_Maritimo extends OPX_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->model('recargo_maritimo');
		$this->load->model('naviera');
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
		$data_dashboard['header_dashboard'] = 'Recargo Marítimo';
		//Obtiene los valores de la tabla
		try{
			$data_recargo_maritimo_form['rows'] = $this->recargo_maritimo->get_recargos_maritimos(); 
		}catch(Exception $e){
			$data_recargos_maritimos_form['rows'] = NULL;
		}				
		//Se optienen y limpian los valores enviados desde el formulario
		$clave = xss_clean($this->input->post('clave'));
		$descripcion = xss_clean($this->input->post('descripcion'));
		$costo = xss_clean($this->input->post('costo'));
		$idnaviera = xss_clean($this->input->post('idnaviera'));
		//Se validan los valores
		try{
			$data_recargo_maritimo_form['navieras'] = $this->naviera->get_navieras();
		}catch(Exception $e){
			$data_recargo_maritimo_form['navieras'] = NULL;
		}
		if($this->form_validation->run() == FALSE){//Los valores no pasaron el test de validación
			$data_dashboard['content_dashboard'] = $this->load->view('recargo_maritimo/add_form',$data_recargo_maritimo_form,TRUE);
		}else{//Los valores aprobaron el test de validación
			$this->recargo_maritimo->set_recargo_maritimo(array(
													'clave' => $clave,
													'descripcion' => $descripcion,
													'costo' => $costo,
													'idnaviera' => $idnaviera
													));				
			$data_recargo_maritimo_form['message'] = "<i class='fa fa-check'></i> El recargo fue agregado exitosamente"; 
		}	
		try{
			$data_recargo_maritimo_form['rows'] = $this->recargo_maritimo->get_recargos_maritimos(); 
		}catch(Exception $e){
			$data_recargo_maritimo_form['rows'] = NULL;
		}			
		$data_dashboard['content_dashboard'] = $this->load->view('recargo_maritimo/add_form',$data_recargo_maritimo_form,TRUE); 	
		$data['content'] = $this->load->view('system/dashboard',$data_dashboard,TRUE);
		$this->load->view('system/layout',$data);
	}
	
	/**
	 * Controlador para editar un registro de Recargo Marítimo
	 */
	public function edit($idrecargo_maritimo = 0){
		$data_sidebar = array(
			'item_menu_dashboard' => '',
			'item_menu_fletes_maritimos' => '',
			'item_menu_fletes_aereos' => '',
			'item_menu_catalogos' => 'active',
		);
		$data_header['menu'] = $this->load->view('system/menu',NULL,TRUE);
		$data['header'] = $this->load->view('system/header',$data_header,TRUE);	
		$data_dashboard['sidebar'] = $this->load->view('system/sidebar',$data_sidebar,TRUE);		
		$data_dashboard['icon_title'] = 'calculator';
		$data_dashboard['header_dashboard'] = 'Recargo Marítimo';
		//Obtiene los valores de la tabla
		try{
			$data_recargo_maritimo_form['rows'] = $this->recargo_maritimo->get_recargos_maritimos(); 
		}catch(Exception $e){
			$data_recargo_maritimo_form['rows'] = NULL;
		}						
		//Se optienen y limpian los valores enviados desde el formulario
		$clave_post = xss_clean($this->input->post('clave'));
		$costo_post = xss_clean($this->input->post('costo'));
		$descripcion_post = xss_clean($this->input->post('descripcion'));
		$idnaviera_post = xss_clean($this->input->post('idnaviera'));
		$idrecargo_maritimo_post = xss_clean($this->input->post('idrecargo_maritimo'));
		if($this->form_validation->run() == FALSE){//Los valores no pasaron el test de validación
			//Obtienen los datos de los recargos
			try{
				$result = $this->recargo_maritimo->get_recargo_maritimo_by_id($idrecargo_maritimo);
				$data_recargo_maritimo_form['idrecargo_maritimo'] = $idrecargo_maritimo;
				$data_recargo_maritimo_form['clave'] = $result[0]['clave'];
				$data_recargo_maritimo_form['costo'] = $result[0]['costo'];
				$data_recargo_maritimo_form['descripcion'] = $result[0]['descripcion'];
				$data_recargo_maritimo_form['idnaviera'] = $result[0]['idnaviera'];
			}catch(Exception $e){
				$data_recargo_maritimo_form['idrecargo_maritimo'] = '';
				$data_recargo_maritimo_form['clave'] = '';
				$data_recargo_maritimo_form['costo'] = '';
				$data_recargo_maritimo_form['descripcion'] = '';
				$data_recargo_maritimo_form['idnaviera'] = '';
			}				
		}else{//Los valores aprobaron el test de validación
			$this->recargo_maritimo->update_recargo_maritimo(array(
									'idrecargo_maritimo' => $idrecargo_maritimo_post,
									'idnaviera' => $idnaviera_post,
									'clave' => $clave_post, 
									'descripcion' => $descripcion_post,
									'costo' => $costo_post
								));
			$data_recargo_maritimo_form['message'] = "<i class='fa fa-check'></i> El recargo fue modificado exitosamente";
			$data_recargo_maritimo_form['idrecargo_maritimo'] = $idrecargo_maritimo_post;
			$data_recargo_maritimo_form['clave'] = $clave_post;
			$data_recargo_maritimo_form['costo'] = $costo_post;
			$data_recargo_maritimo_form['descripcion'] = $descripcion_post;
			$data_recargo_maritimo_form['idnaviera'] = $idnaviera_post;		
			try{
				$data_recargo_maritimo_form['rows'] = $this->recargo_maritimo->get_recargos_maritimos(); 
			}catch(Exception $e){
				$data_recargo_maritimo_form['rows'] = NULL;
			}				 								
		}		
	
		$data_recargo_maritimo_form['navieras'] = $this->naviera->get_navieras();
		$data_dashboard['content_dashboard'] = $this->load->view('recargo_maritimo/edit_form',$data_recargo_maritimo_form,TRUE); 	
		$data['content'] = $this->load->view('system/dashboard',$data_dashboard,TRUE);
		$this->load->view('system/layout',$data);
	}

	/**
	 * Controlador para eliminar un registro de Aeropuerto
	 */
	 public function delete($idrecargo_maritimo = 0){
		$data_sidebar = array(
			'item_menu_dashboard' => '',
			'item_menu_fletes_maritimos' => '',
			'item_menu_fletes_maritimos' => '',
			'item_menu_catalogos' => 'active',
		);
		$data_header['menu'] = $this->load->view('system/menu',NULL,TRUE);
		$data['header']   = $this->load->view('system/header',$data_header,TRUE);	
		$data_dashboard['sidebar'] = $this->load->view('system/sidebar',$data_sidebar,TRUE);		
		$data_dashboard['icon_title'] = 'calculator';
		$data_dashboard['header_dashboard'] = 'Recargo Marítimo';
		//Obtienen los datos de los recargos
		try{
			$result = $this->recargo_maritimo->get_recargo_maritimo_by_id($idrecargo_maritimo);
			$data_recargo_maritimo_form['idrecargo_maritimo'] = $idrecargo_maritimo;
			$data_recargo_maritimo_form['clave'] = $result[0]['clave'];
			$data_recargo_maritimo_form['costo'] = $result[0]['costo'];
			$data_recargo_maritimo_form['descripcion'] = $result[0]['descripcion'];
			$data_recargo_maritimo_form['idnaviera'] = $result[0]['idnaviera'];
			$data_recargo_maritimo_form['rows'] = $this->recargo_maritimo->get_recargos_maritimos(); 
		}catch(Exception $e){
			$data_recargo_maritimo_form['rows'] = NULL;
		}
		//Obtiene los valores de la tabla
		try{
			$data_recargo_maritimo_form['rows'] = $this->recargo_maritimo->get_recargos_maritimos(); 
		}catch(Exception $e){
			$data_recargo_maritimo_form['rows'] = NULL;
		}				
		//Se optienen y limpian los valores enviados desde el formulario
		$clave = xss_clean($this->input->post('clave'));
		$costo = xss_clean($this->input->post('costo'));
		$descripcion = xss_clean($this->input->post('descripcion'));
		$idnaviera = xss_clean($this->input->post('idnaviera'));
		$idrecargo_maritimo = xss_clean($this->input->post('idrecargo_maritimo'));
		//Se validan los valores
		$this->form_validation->set_rules('clave', 'Clave', 'required', array('required' => $this->lang->line('error_required_clave')));
		$this->form_validation->set_rules('costo', 'Costo', 'required', array('required' => $this->lang->line('error_required_costo')));
		$this->form_validation->set_rules('idnaviera', 'ID Aerolínea', 'callback_naviera_check');
		if($this->form_validation->run() == FALSE){//Los valores no pasaron el test de validación
			$data_dashboard['content_dashboard'] = $this->load->view('recargo_maritimo/delete_form',$data_recargo_maritimo_form,TRUE);
		}else{//Los valores aprobaron el test de validación
			try{
				$this->recargo_maritimo->delete_recargo_maritimo(array(
										'idrecargo_maritimo' => $idrecargo_maritimo,
										'idnaviera' => $idnaviera,
										'clave' => $clave, 
										'descripcion' => $descripcion,
										'costo' => $costo
									));
			}catch(Exception $e){
				var_dump($e->getCode());
				if($e->getCode() == 1999)
					$data_recargo_maritimo_form['message'] = $this->lang->line('error_foreingkey_recargo_maritimo'); 
			}
		}	
		try{
			$data_recargo_maritimo_form['rows'] = $this->recargo_maritimo->get_recargos_maritimos();
		}catch(Exception $e){
			$data_recargo_maritimo_form['rows'] = NULL;
		}			
		$data_recargo_maritimo_form['navieras'] = $this->naviera->get_navieras();
		$data_dashboard['content_dashboard'] = $this->load->view('recargo_maritimo/delete_form',$data_recargo_maritimo_form,TRUE); 	
		$data['content'] = $this->load->view('system/dashboard',$data_dashboard,TRUE);
		$this->load->view('system/layout',$data); 	
	 }

	/**
	 * call_back_naviera
	 */
	 
	public function naviera_check($str){
		if($str == 'none'){
			$this->form_validation->set_message('naviera_check', 'Seleccione una naviera');
			return FALSE;
		}else{
			return TRUE;			
		}
	}	
}
