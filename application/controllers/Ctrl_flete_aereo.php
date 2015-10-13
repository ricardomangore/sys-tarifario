<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class CTRL_Flete_Aereo extends OPX_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->model('flete_aereo');
		$this->load->model('recargo_aereo');
		$this->load->model('aeropuerto');
		$this->load->model('aerolinea');
		$this->load->model('region');
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
			'item_menu_fletes_aereos' => 'active',
			'item_menu_catalogos' => '',
		);
		$data_header['menu'] = $this->load->view('system/menu',NULL,TRUE);
		$data['header']   = $this->load->view('system/header',$data_header,TRUE);	
		$data_dashboard['sidebar'] = $this->load->view('system/sidebar',$data_sidebar,TRUE);		
		$data_dashboard['icon_title'] = 'plane';
		$data_dashboard['header_dashboard'] = 'Flete Aéreo';
		//Obtiene los valores de la tabla
		try{
			$data_flete_aereo_form['rows'] = $this->flete_aereo->get_fletes_aereos(); 
		}catch(Exception $e){
			$data_flete_aereo_form['rows'] = NULL;
		}
		//Se obtienen los valores para las listas desplegables
		try{
			$data_flete_aereo_form['recargos'] = $this->recargo_aereo->get_recargos_aereos();
		}catch(Exception $e){
			$data_flete_aereo_form['recargos'] = NULL;
		}
		try{
			$data_flete_aereo_form['aeropuertos'] = $this->aeropuerto->get_aeropuertos();
		}catch(Exception $e){
			$data_flete_aereo_form['aeropuertos'] = NULL;
		}
		try{
			$data_flete_aereo_form['aerolineas'] = $this->aerolinea->get_aerolineas();
		}catch(Exception $e){
			$data_flete_aereo_form['aerolineas'] = NULL;
		}
		try{
			$data_flete_aereo_form['regiones'] = $this->region->get_regiones();	
		}catch(exception $e){
			$data_flete_aereo_form['regiones'] = NULL;
		}	
		//Se optienen y limpian los valores enviados desde el formulario
		
		$chkbox_via = xss_clean($this->input->post('chkbox_via'));
		if($chkbox_via == 'directo')
			$via_bool = FALSE;
		else
			$via_bool = TRUE;
		$idvias = xss_clean($this->input->post('idvias[]'));
		$idrecargos = $this->input->post('idrecargos[]');
		$aol = xss_clean($this->input->post('aol'));
		$aod = xss_clean($this->input->post('aod'));
		$idregion = xss_clean($this->input->post('idregion'));
		$idaerolinea = xss_clean($this->input->post('idaerolinea'));
		$vigencia = xss_clean($this->input->post('vigencia'));
		$minimo = xss_clean($this->input->post('minimo'));
		$normal = xss_clean($this->input->post('normal'));
		$profit_base = xss_clean($this->input->post('profit_base'));
		$precio1 = xss_clean($this->input->post('precio1'));
		$precio2 = xss_clean($this->input->post('precio2'));
		$precio3 = xss_clean($this->input->post('precio3'));
		$precio4 = xss_clean($this->input->post('precio4'));
		$precio5 = xss_clean($this->input->post('precio5'));
		$profit45 = xss_clean($this->input->post('profit45'));
		$profit100 = xss_clean($this->input->post('profit100'));
		$profit300 = xss_clean($this->input->post('profit300'));
		$profit500 = xss_clean($this->input->post('profit500'));
		$profit1000 = xss_clean($this->input->post('profit1000'));		
		$precios = array();
		if(isset($precio1))
			array_push($precios,array(
				'min' => 45,
				'max' => 99,
				'precio' => $precio1,
				'profit' => $profit45,
			));
		if(isset($precio2))
			array_push($precios,array(
				'min' => 100,
				'max' => 299,
				'precio' => $precio2,
				'profit' => $profit100
			));
		if(isset($precio3))
			array_push($precios,array(
				'min' => 300,
				'max' => 499,
				'precio' => $precio3,
				'profit' => $profit300
			));
		if(isset($precio4))
			array_push($precios,array(
				'min' => 500,
				'max' => 999,
				'precio' => $precio4,
				'profit' => $profit100
			));
		if(isset($precio5))
			array_push($precios,array(
				'min' => 1000,
				'max' => 1000000,
				'precio' => $precio5,
				'profit' => $profit1000
			));											
		if(empty($idrecargos))
			$has_recargos = FALSE;
		else	
			$has_recargos = TRUE;
		//Se validan los valores
		/*if($via_bool)
			$this->form_validation->set_rules('idvias','Via','callback_via_check'); */ 
		$this->form_validation->set_message('required', 'Indique un valor para {field}');
		if($this->form_validation->run() === FALSE){//Los valores no pasaron el test de validación
			$data_dashboard['content_dashboard'] = $this->load->view('flete_aereo/add_form',$data_flete_aereo_form,TRUE);
		}else{//Los valores aprobaron el test de validación
			$flete_aereo = array(
				'aol' => $aol,
				'aod' => $aod,
				'idregion' => $idregion,
				'idaerolinea' => $idaerolinea,
				'vigencia' => $vigencia,
				'minimo' => $minimo,
				'normal' => $normal,
				'profit' => $profit_base,
				'has_via' => $via_bool,
				'vias' => $idvias,
				'intervalos' => $precios,
				'has_recargos' => $has_recargos,
				'recargos' => $idrecargos
			);
			try{
				$this->flete_aereo->set_flete_aereo($flete_aereo);
			}catch(Exception $e){
				echo $e->getCode();
			}
		}	
		try{
			$data_flete_aereo_form['rows'] = $this->flete_aereo->get_fletes_aereos(); 
		}catch(Exception $e){
			$data_flete_aereo_form['rows'] = NULL;
		}			
		$data_dashboard['content_dashboard'] = $this->load->view('flete_aereo/add_form',$data_flete_aereo_form,TRUE); 	
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
			'item_menu_fletes_aereos' => 'active',
			'item_menu_catalogos' => '',
		);
		$data_header['menu'] = $this->load->view('system/menu',NULL,TRUE);
		$data['header']   = $this->load->view('system/header',$data_header,TRUE);	
		$data_dashboard['sidebar'] = $this->load->view('system/sidebar',$data_sidebar,TRUE);		
		$data_dashboard['icon_title'] = 'plane';
		$data_dashboard['header_dashboard'] = 'Flete Aéreo';
		//Obtienen los datos del registro solicitado
		try{
			$result = $this->flete_aereo->get_flete_aereo_by_id($idrecargo_aereo);
			$data_flete_aereo_form['idregion'] = $result['flete_aereo'][0]['idregion'];
			$data_flete_aereo_form['idaerolinea'] = $result['flete_aereo'][0]['idaerolinea'];
			$data_flete_aereo_form['aol'] = $result['aol'][0]['idaeropuerto'];
			$data_flete_aereo_form['aod'] = $result['aod'][0]['idaeropuerto'];
			$data_flete_aereo_form['has_via'] = $result['flete_aereo'][0]['via'];
			$data_flete_aereo_form['via'] = $result['via'];
			$data_flete_aereo_form['recargos'] = $result['recargos'];
			$data_flete_aereo_form['vigencia'] = $result['flete_aereo'][0]['vigencia'];
			$data_flete_aereo_form['minimo'] = $result['flete_aereo'][0]['minimo'];
			$data_flete_aereo_form['normal'] = $result['flete_aereo'][0]['normal'];
			$data_flete_aereo_form['profit_base'] = $result['flete_aereo'][0]['profit'];
       		$data_flete_aereo_form['precio1'] = $result['precios'][0]['precio'];
			$data_flete_aereo_form['profit45'] = $result['precios'][0]['profit'];
			$data_flete_aereo_form['precio2'] = $result['precios'][1]['precio'];
			$data_flete_aereo_form['profit100'] = $result['precios'][1]['profit'];
			$data_flete_aereo_form['precio3'] = $result['precios'][2]['precio'];
			$data_flete_aereo_form['profit300'] = $result['precios'][2]['profit'];
			$data_flete_aereo_form['precio5'] = $result['precios'][3]['precio'];
			$data_flete_aereo_form['profit500'] = $result['precios'][3]['profit'];
			$data_flete_aereo_form['precio4'] = $result['precios'][4]['precio'];
			$data_flete_aereo_form['profit1000'] = $result['precios'][4]['profit'];
		}catch(Exception $e){
			$data_flete_aereo_form['rows'] = NULL;
		}
		//Obtiene los valores de la tabla
		try{
			$data_flete_aereo_form['rows'] = $this->flete_aereo->get_fletes_aereos(); 
		}catch(Exception $e){
			$data_flete_aereo_form['rows'] = NULL;
		}
		//Se obtienen los valores para las listas desplegables
		try{
			$data_flete_aereo_form['recargos'] = $this->recargo_aereo->get_recargos_aereos();
		}catch(Exception $e){
			$data_flete_aereo_form['recargos'] = NULL;
		}
		try{
			$data_flete_aereo_form['aeropuertos'] = $this->aeropuerto->get_aeropuertos();
		}catch(Exception $e){
			$data_flete_aereo_form['aeropuertos'] = NULL;
		}
		try{
			$data_flete_aereo_form['aerolineas'] = $this->aerolinea->get_aerolineas();
		}catch(Exception $e){
			$data_flete_aereo_form['aerolineas'] = NULL;
		}
		try{
			$data_flete_aereo_form['regiones'] = $this->region->get_regiones();	
		}catch(exception $e){
			$data_flete_aereo_form['regiones'] = NULL;
		}	
		//Se optienen y limpian los valores enviados desde el formulario
		
		$chkbox_via = xss_clean($this->input->post('chkbox_via'));
		if($chkbox_via == 'directo')
			$via_bool = FALSE;
		else
			$via_bool = TRUE;
		$idvias = xss_clean($this->input->post('idvias[]'));
		$idrecargos = $this->input->post('idrecargos[]');
		$aol = xss_clean($this->input->post('aol'));
		$aod = xss_clean($this->input->post('aod'));
		$idregion = xss_clean($this->input->post('idregion'));
		$idaerolinea = xss_clean($this->input->post('idaerolinea'));
		$vigencia = xss_clean($this->input->post('vigencia'));
		$minimo = xss_clean($this->input->post('minimo'));
		$normal = xss_clean($this->input->post('normal'));
		$profit_base = xss_clean($this->input->post('profit_base'));
		$precio1 = xss_clean($this->input->post('precio1'));
		$precio2 = xss_clean($this->input->post('precio2'));
		$precio3 = xss_clean($this->input->post('precio3'));
		$precio4 = xss_clean($this->input->post('precio4'));
		$precio5 = xss_clean($this->input->post('precio5'));
		$profit45 = xss_clean($this->input->post('profit45'));
		$profit100 = xss_clean($this->input->post('profit100'));
		$profit300 = xss_clean($this->input->post('profit300'));
		$profit500 = xss_clean($this->input->post('profit500'));
		$profit1000 = xss_clean($this->input->post('profit1000'));		
		$precios = array();
		if(isset($precio1))
			array_push($precios,array(
				'min' => 45,
				'max' => 99,
				'precio' => $precio1,
				'profit' => $profit45,
			));
		if(isset($precio2))
			array_push($precios,array(
				'min' => 100,
				'max' => 299,
				'precio' => $precio2,
				'profit' => $profit100
			));
		if(isset($precio3))
			array_push($precios,array(
				'min' => 300,
				'max' => 499,
				'precio' => $precio3,
				'profit' => $profit300
			));
		if(isset($precio4))
			array_push($precios,array(
				'min' => 500,
				'max' => 999,
				'precio' => $precio4,
				'profit' => $profit100
			));
		if(isset($precio5))
			array_push($precios,array(
				'min' => 1000,
				'max' => 1000000,
				'precio' => $precio5,
				'profit' => $profit1000
			));											
		if(empty($idrecargos))
			$has_recargos = FALSE;
		else	
			$has_recargos = TRUE;
		//Se validan los valores
		/*if($via_bool)
			$this->form_validation->set_rules('idvias','Via','callback_via_check'); */ 
		$this->form_validation->set_message('required', 'Indique un valor para {field}');
		if($this->form_validation->run() === FALSE){//Los valores no pasaron el test de validación
			$data_dashboard['content_dashboard'] = $this->load->view('flete_aereo/edit_form',$data_flete_aereo_form,TRUE);
		}else{//Los valores aprobaron el test de validación
			$flete_aereo = array(
				'aol' => $aol,
				'aod' => $aod,
				'idregion' => $idregion,
				'idaerolinea' => $idaerolinea,
				'vigencia' => $vigencia,
				'minimo' => $minimo,
				'normal' => $normal,
				'profit' => $profit_base,
				'has_via' => $via_bool,
				'vias' => $idvias,
				'intervalos' => $precios,
				'has_recargos' => $has_recargos,
				'recargos' => $idrecargos
			);
			try{
				$this->flete_aereo->set_flete_aereo($flete_aereo);
			}catch(Exception $e){
				echo $e->getCode();
			}
		}	
		try{
			$data_flete_aereo_form['rows'] = $this->flete_aereo->get_fletes_aereos(); 
		}catch(Exception $e){
			$data_flete_aereo_form['rows'] = NULL;
		}			
		$data_dashboard['content_dashboard'] = $this->load->view('flete_aereo/edit_form',$data_flete_aereo_form,TRUE); 	
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
	 
	public function idaerolinea_check($str){
		if($str == 'none'){
			$this->form_validation->set_message('idaerolinea_check', 'Seleccione una aerolínea');
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
	 
	public function aol_check($str){
		if($str == 'none'){
			$this->form_validation->set_message('aol_check', 'Seleccione un Aéropuerto de Origen');
			return FALSE;
		}else{
			return TRUE;			
		}
	}
	
	
	/**
	 * call_back_aod
	 */
	 
	public function aod_check($str){
		if($str == 'none'){
			$this->form_validation->set_message('aod_check', 'Seleccione un Aéropuerto de Destino');
			return FALSE;
		}else{
			return TRUE;			
		}
	}
	
	/**
	 * callback_via
	 */	
	public function via_check($param){
		if(isset($param)){
			return TRUE;
		}else{
			$this->form_validation->set_message('via_check','Seleccione una escala');
			return FALSE;
		}
	}
		
}
