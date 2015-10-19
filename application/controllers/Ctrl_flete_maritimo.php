<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class CTRL_Flete_Maritimo extends OPX_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->model('flete_maritimo');
		$this->load->model('recargo_maritimo');
		$this->load->model('puerto');
		$this->load->model('naviera');
		$this->load->model('region');
		$this->load->model('contenedor');
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
			'item_menu_fletes_maritimos' => 'active',
			'item_menu_fletes_aereos' => '',
			'item_menu_catalogos' => '',
		);
		$data_header['menu'] = $this->load->view('system/menu',NULL,TRUE);
		$data['header']   = $this->load->view('system/header',$data_header,TRUE);	
		$data_dashboard['sidebar'] = $this->load->view('system/sidebar',$data_sidebar,TRUE);		
		$data_dashboard['icon_title'] = 'ship';
		$data_dashboard['header_dashboard'] = 'Flete Marítimo';
		//Obtiene desde la base de datos los renglones para crear la tabla de fletes
		try{
			$data_flete_maritimo_form['rows'] = $this->flete_maritimo->get_fletes_maritimos(); 
		}catch(Exception $e){
			$data_fletes_aereos_form['rows'] = NULL;
		}
		//Se obtienen los valores para las listas desplegables
		try{
			$data_flete_maritimo_form['contenedores'] = $this->contenedor->get_contenedores();
		}catch(Exception $e){
			$data_flete_maritimo_form['contenedores'] = NULL;
		}
		try{
			$data_flete_maritimo_form['recargos'] = $this->recargo_maritimo->get_recargos_maritimos();
		}catch(Exception $e){
			$data_flete_maritimo_form['recargos'] = NULL;
		}
		try{
			$data_flete_maritimo_form['puertos'] = $this->puerto->get_puertos();
		}catch(Exception $e){
			$data_flete_maritimo_form['puertos'] = NULL;
		}
		try{
			$data_flete_maritimo_form['navieras'] = $this->naviera->get_navieras();
		}catch(Exception $e){
			$data_flete_maritimo_form['navieras'] = NULL;
		}
		try{
			$data_flete_maritimo_form['regiones'] = $this->region->get_regiones();	
		}catch(exception $e){
			$data_flete_maritimo_form['regiones'] = NULL;
		}
		//Bloque para procesar los datos enviados desde el formulario		
		$pol = xss_clean($this->input->post('pol'));
		$pod = xss_clean($this->input->post('pod'));
		$idnaviera = xss_clean($this->input->post('idnaviera'));
		$idregion = xss_clean($this->input->post('idregion'));
		$vigencia = xss_clean($this->input->post('vigencia'));
		$precio = xss_clean($this->input->post('precio'));
		$profit = xss_clean($this->input->post('profit'));
		$tt = xss_clean($this->input->post('tt'));
		$minimo = xss_clean($this->input->post('minimo'));
		$recargos = $this->input->post('idrecargos[]');
		$chkbox_via = xss_clean($this->input->post('chkbox_via'));
		var_dump($chkbox_via);
		if($chkbox_via == 'directo')
			$has_vias = FALSE;
		else
			$has_vias = TRUE;
		$vias = $this->input->post('idvias[]');	
		$tipo_aux = xss_clean($this->input->post('tipo'));
		if($tipo_aux == 'importacion')
			$tipo_tarifa = 2;
		elseif($tipo_aux == 'exportacion')
			$tipo_tarifa = 1;
		$chkbox_carga = xss_clean($this->input->post('chkbox_carga'));
		if($chkbox_carga == 'contenedor')
			$tipo_carga = 1; //para carga contenerizada
		elseif($chkbox_carga == 'consolidada')
			$tipo_carga = 2; //carga sonsolidada
		$idcontenedor_aux = xss_clean($this->input->post('idcontenedor'));
		if(isset($tipo_carga))
			if($tipo_carga == 1){
				$aux = explode("_", $idcontenedor_aux);
				$idcontenedor = $aux[0];
				$idcarga = $aux[1];
			}else{
				$idcontenedor = NULL;
				$idcarga = NULL;
			}
		else{
			$idcontenedor = NULL;
			$idcarga = NULL;
		}
						
		//se efectuan las valkidaciones de los campos
		$this->form_validation->set_message('required','{field} es requerido');
		if($this->form_validation->run() === FALSE){
			$data_dashboard['content_dashboard'] = $this->load->view('flete_maritimo/add_form',$data_flete_maritimo_form,TRUE); 	
			$data['content'] = $this->load->view('system/dashboard',$data_dashboard,TRUE);
			$this->load->view('system/layout',$data);			
		}else{
			$flete_maritimo = array(
				'pol' => $pol,
				'pod' => $pod,
				'idnaviera' => $idnaviera,
				'idregion' => $idregion,
				'vigencia' => $vigencia,
				'precio' => $precio,
				'profit' => $profit,
				'tt' => $tt,
				'minimo' => $minimo,
				'recargos' => $recargos,
				'has_vias' => $has_vias,
				'vias' => $vias,
				'tipo_tarifa' => $tipo_tarifa,
				'tipo_carga' => $tipo_carga,
				'idcontenedor' => $idcontenedor,
				'idcarga' => $idcarga
			);
			try{
				$this->flete_maritimo->set_flete_maritimo($flete_maritimo);
			}catch(Exception $e){
				
			}
			//Obtiene desde la base de datos los renglones para crear la tabla de fletes
			try{
				$data_flete_maritimo_form['rows'] = $this->flete_maritimo->get_fletes_maritimos(); 
			}catch(Exception $e){
				$data_fletes_aereos_form['rows'] = NULL;
			}			
			$data_dashboard['content_dashboard'] = $this->load->view('flete_maritimo/add_form',$data_flete_maritimo_form,TRUE); 	
			$data['content'] = $this->load->view('system/dashboard',$data_dashboard,TRUE);
			$this->load->view('system/layout',$data);
		}	 	

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
	 * call_back_aerolinea
	 */
	 
	public function idnaviera_check($str){
		if($str == 'none'){
			$this->form_validation->set_message('idnaviera_check', 'Seleccione una naviera');
			return FALSE;
		}else{
			return TRUE;			
		}
	}	
	
	/**
	 * call_back_idregion
	 */
	 
	public function idregion_check($str){
		if($str == 'none'){
			$this->form_validation->set_message('idregion_check', 'Seleccione una región');
			return FALSE;
		}else{
			return TRUE;			
		}
	}
	
	/**
	 * call_back_aol
	 */
	 
	public function pol_check($str){
		if($str == 'none'){
			$this->form_validation->set_message('pol_check', 'Seleccione un Puerto de Carga');
			return FALSE;
		}else{
			return TRUE;			
		}
	}
	
	
	/**
	 * call_back_aod
	 */
	 
	public function pod_check($str){
		if($str == 'none'){
			$this->form_validation->set_message('pod_check', 'Seleccione un Puerto de Descarga');
			return FALSE;
		}else{
			return TRUE;			
		}
	}	
		
}
