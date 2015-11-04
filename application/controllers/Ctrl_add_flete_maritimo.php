<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class CTRL_Add_Flete_Maritimo extends OPX_Controller{
	
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
		$data_dashboard['content_dashboard'] = $this->load->view('flete_maritimo/add_form',$data_flete_maritimo_form,TRUE); 	
		$data['content'] = $this->load->view('system/dashboard',$data_dashboard,TRUE);
		$this->load->view('system/layout',$data);				
	}


	public function validate(){
		//Bloque para procesar los datos enviados desde el formulario		
		$pol = xss_clean($this->input->post('pol'));
		$pod = xss_clean($this->input->post('pod'));
		$idnaviera = xss_clean($this->input->post('idnaviera'));
		$idrecargos = $this->input->post('idrecargos[]');
		$idregion = xss_clean($this->input->post('idregion'));
		$chkbox_via = $this->input->post('chkbox_via');
		$idvias = $this->input->post('idvias[]');
		$tipo_flete = xss_clean($this->input->post('tipo'));
		$tipo_carga = xss_clean($this->input->post('chkbox_carga'));
		$idcontenedor = xss_clean($this->input->post('idcontenedor'));
		$minimo = xss_clean($this->input->post('minimo'));
		$vigencia = xss_clean($this->input->post('vigencia'));
		$tt = xss_clean($this->input->post('tt'));
		$precio = xss_clean($this->input->post('precio'));
		$profit = xss_clean($this->input->post('profit'));
		
		
		//Si no se seleccionaron recargos idrecargos = NULL
		if(!isset($idrecargos))
			$has_recargos = FALSE;
		else
			$has_recargos = TRUE;
		//Se procede a efectuar la consistencia para las demas variables
		
		if($tipo_flete == 'exportacion')
			$tipo_flete = 1;
		elseif($tipo_flete == 'importacion')
			$tipo_flete = 2;
		
		if($idcontenedor != 'none'){
			$aux = explode("_", $idcontenedor);
			$idcontenedor = $aux[0];
			$idcarga = $aux[1];
		}elseif($idcontenedor == 'none'){
			$idcontenedor = NULL;
			$idcarga = NULL;
		}
		
		//Reglas de validación dinámicas
		if($tipo_carga == 'contenedor'){
			$minimo = 0;
			$this->form_validation->set_rules('idcontenedor','Contenedor','callback_idcontenedor_check');
		}
		elseif($tipo_carga == 'consolidado'){
			$idcontenedor = NULL;
			$this->form_validation->set_rules('minimo','Mínimo','trim|required');
		}
		if($chkbox_via == 'escalas'){
			$has_vias = TRUE;
			$this->form_validation->set_rules('idvias[]','Escalas','callback_idvias_check');
		}
		else{
			$has_vias = FALSE;
			$idvias = NULL;
		}		
		//Reglas de validación estáticas
		$this->form_validation->set_rules('pol','POL','callback_pol_check');
		$this->form_validation->set_rules('pod','POLD','callback_pod_check');
		$this->form_validation->set_rules('idnaviera','Naviera','callback_idnaviera_check');
		$this->form_validation->set_rules('idregion','Región','callback_idregion_check');
		$this->form_validation->set_rules('precio','Precio','trim|required|numeric');
		
		
		
		if($this->form_validation->run() === FALSE){
			$this->index();
		}else{
			//Inserta el nuevo flete
			$flete_maritimo = array(
				'precio' => $precio,
				'tt' => $tt,
				'has_vias' => $has_vias,
				'has_recargos' => $has_recargos,
				'idnaviera' => $idnaviera,
				'idregion' => $idregion,
				'pol' => $pol,
				'pod' => $pod,
				'vigencia' => $vigencia,
				'tipo_flete' => $tipo_flete,
				'tipo_carga' => $tipo_carga,
				'minimo' => $minimo,
				'profit' => $profit,
				'recargos' => $idrecargos,
				'vias' => $idvias,
				'idcarga' => $idcarga,
				'idcontenedor' => $idcontenedor
				
			);
			try{
				$this->flete_maritimo->set_flete_maritimo($flete_maritimo);
				$this->success();
			}catch(Exception $e){
				echo $e->getMessage();
			}
		}
	}
	
	public function success(){
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
		$data_flete_maritimo_form['message'] = 'El flete se agrego exitosamente';
		$data_dashboard['content_dashboard'] = $this->load->view('flete_maritimo/add_form',$data_flete_maritimo_form,TRUE); 	
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
	 * call_back_pod
	 */
	public function pod_check($str){
		if($str == 'none'){
			$this->form_validation->set_message('pod_check', 'Seleccione un Puerto de Descarga');
			return FALSE;
		}else{
			return TRUE;			
		}
	}

	/**
	 * call_back_idcontenedor
	 */
	public function idcontenedor_check($str){
		if($str == 'none'){
			$this->form_validation->set_message('idcontenedor_check', 'Seleccione un Contenedor de Descarga');
			return FALSE;
		}else{
			return TRUE;			
		}
	}
	
	
	/**
	 * call_back_idvias
	 */
	public function idvias_check($str){
		if($str == 'none' || $str == NULL){
			$this->form_validation->set_message('idvias_check', 'Seleccione una o más escalas');
			return FALSE;
		}else{
			return TRUE;			
		}
	}			
}