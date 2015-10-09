<?php if(!defined('BASEPATH'))	exit('No direct script access allowed');
	
class CTRL_Contenedor extends OPX_Controller{
	
	public function __construct(){
		parent::__construct();
		if(!$this->opx_auth->is_authenticated())
			redirect('login');
		$this->load->model('contenedor');
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
		$data_dashboard['icon_title'] = 'cude';
		$data_dashboard['header_dashboard'] = 'Contenedores';
		//Obtiene los valores de la tabla
		try{
			$data_contenedor_form['rows'] = $this->contenedor->get_contenedores(); 
		}catch(Exception $e){
			$data_contenedor_form['rows'] = NULL;
		}				
		//Se optienen y limpian los valores enviados desde el formulario
		$pies = xss_clean($this->input->post('pies'));
		$tipo = xss_clean($this->input->post('tipo'));
		$tare = xss_clean($this->input->post('tare'));
		$peso = xss_clean($this->input->post('peso'));
		$volumen = xss_clean($this->input->post('volumen'));
		$inside_width = xss_clean($this->input->post('inside_width'));
		$inside_height = xss_clean($this->input->post('inside_height'));
		$inside_lenght = xss_clean($this->input->post('inside_lenght'));
		$door_width = xss_clean($this->input->post('door_width'));
		$door_height = xss_clean($this->input->post('door_height'));
		//Se validan los valores
		$this->form_validation->set_rules('pies', 'pies', 'required', array('required' => $this->lang->line('error_required_pies')));
		$this->form_validation->set_rules('peso', 'Peso', 'required', array('required' => $this->lang->line('error_required_peso')));
		$this->form_validation->set_rules('volumen', 'Volumen', 'required', array('required' => $this->lang->line('error_required_volumen')));
		$this->form_validation->set_rules('tare', 'Tare', 'required', array('required' => $this->lang->line('error_required_tare')));
		$this->form_validation->set_rules('tipo', 'Tipo', 'required', array('required' => $this->lang->line('error_required_tipo')));
		if($this->form_validation->run() == FALSE){//Los valores no pasaron el test de validación
			$data_dashboard['content_dashboard'] = $this->load->view('contenedor/add_form',$data_contenedor_form,TRUE);
		}else{//Los valores aprobaron el test de validación
			$this->contenedor->set_contenedor(array(
													'pies' => $pies,
													'tipo' => $tipo,
													'tare' => $tare,
													'peso' => $peso,
													'volumen' => $volumen,
													'inside_width' => $inside_width,
													'inside_height' => $inside_height,
													'inside_lenght' => $inside_lenght,
													'door_width' => $door_width,
													'door_height' => $door_height
													));
		}	
		try{
			$data_contenedor_form['rows'] = $this->contenedor->get_contenedores(); 
		}catch(Exception $e){
			$data_contenedor_form['rows'] = NULL;
		}			
		$data_dashboard['content_dashboard'] = $this->load->view('contenedor/add_form',$data_contenedor_form,TRUE); 	
		$data['content'] = $this->load->view('system/dashboard',$data_dashboard,TRUE);
		$this->load->view('system/layout',$data);
	}
	
	/**
	 * Controlador para editar un registro de Aeropuerto
	 */
	public function edit($idaeropuerto = 0){
		$data_sidebar = array(
			'item_menu_dashboard' => '',
			'item_menu_fletes_maritimos' => '',
			'item_menu_fletes_aereos' => '',
			'item_menu_catalogos' => 'active',
		);
		$data_header['menu'] = $this->load->view('system/menu',NULL,TRUE);
		$data['header']   = $this->load->view('system/header',$data_header,TRUE);	
		$data_dashboard['sidebar'] = $this->load->view('system/sidebar',$data_sidebar,TRUE);		
		$data_dashboard['icon_title'] = 'road';
		$data_dashboard['header_dashboard'] = 'Aeropuerto';
		//Obtienen los datos de la región por ID
		try{
			$result = $this->aeropuerto->get_aeropuerto_by_id($idaeropuerto);
			$data_aeropuerto_form['idaeropuerto'] = $idaeropuerto;
			$data_aeropuerto_form['aeropuerto'] = $result[0]['aeropuerto'];
			$data_aeropuerto_form['code'] = $result[0]['code'];
			$data_aeropuerto_form['pais'] = $result[0]['pais'];
			$data_aeropuerto_form['ciudad'] = $result[0]['ciudad'];
			$data_aeropuerto_form['rows'] = $this->aeropuerto->get_aeropuertos(); 
		}catch(Exception $e){
			$data_aeropuerto_form['rows'] = NULL;
		}
		//Obtiene los valores de la tabla
		try{
			$data_aeropuerto_form['rows'] = $this->aeropuerto->get_aeropuertos(); 
		}catch(Exception $e){
			$data_aeropuerto_form['rows'] = NULL;
		}				
		//Se optienen y limpian los valores enviados desde el formulario
		$aeropuerto = xss_clean($this->input->post('aeropuerto'));
		$pais = xss_clean($this->input->post('pais'));
		$code = strtoupper(xss_clean($this->input->post('code')));
		$ciudad = xss_clean($this->input->post('ciudad'));
		$idaeropuerto = xss_clean($this->input->post('idaeropuerto'));
		//Se validan los valores
		$this->form_validation->set_rules('aeropuerto', 'Aeropuerto', 'required', array('required' => $this->lang->line('error_required_aeropuerto')));
		$this->form_validation->set_rules('code', 'Code', 'required', array('required' => $this->lang->line('error_required_code')));
		if($this->form_validation->run() == FALSE){//Los valores no pasaron el test de validación
			$data_dashboard['content_dashboard'] = $this->load->view('aeropuerto/edit_form',$data_aeropuerto_form,TRUE);
		}else{//Los valores aprobaron el test de validación
			$this->aeropuerto->update_aeropuerto(array(
									'aeropuerto' => $aeropuerto, 
									'idaeropuerto' => $idaeropuerto,
									'code' => $code,
									'pais' => $pais,
									'ciudad' => $ciudad
								));
		}	
		try{
			$data_aeropuerto_form['rows'] = $this->aeropuerto->get_aeropuertos(); 
		}catch(Exception $e){
			$data_aeropuertos_form['rows'] = NULL;
		}			
		$data_dashboard['content_dashboard'] = $this->load->view('aeropuerto/edit_form',$data_aeropuerto_form,TRUE); 	
		$data['content'] = $this->load->view('system/dashboard',$data_dashboard,TRUE);
		$this->load->view('system/layout',$data);
	}

	/**
	 * Controlador para eliminar un registro de Aeropuerto
	 */
	 public function delete($idaeropuerto = 0){
		$data_sidebar = array(
			'item_menu_dashboard' => '',
			'item_menu_fletes_maritimos' => '',
			'item_menu_fletes_aereos' => '',
			'item_menu_catalogos' => 'active',
		);
		$data_header['menu'] = $this->load->view('system/menu',NULL,TRUE);
		$data['header']   = $this->load->view('system/header',$data_header,TRUE);	
		$data_dashboard['sidebar'] = $this->load->view('system/sidebar',$data_sidebar,TRUE);		
		$data_dashboard['icon_title'] = 'road';
		$data_dashboard['header_dashboard'] = 'Aeropuerto';
		//Obtienen los datos de la aerolinea por ID
		try{
			$result = $this->aeropuerto->get_aeropuerto_by_id($idaeropuerto);
			$data_aeropuerto_form['idaeropuerto'] = $idaeropuerto;
			$data_aeropuerto_form['aeropuerto'] = $result[0]['aeropuerto'];
			$data_aeropuerto_form['code'] = $result[0]['code'];
			$data_aeropuerto_form['pais'] = $result[0]['pais'];
			$data_aeropuerto_form['ciudad'] = $result[0]['ciudad'];
			$data_aeropuerto_form['rows'] = $this->aeropuerto->get_aeropuertos();  
		}catch(Exception $e){
			$data_aeropuerto_form['rows'] = NULL;
		}
		//Obtiene los valores de la tabla
		try{
			$data_aeropuerto_form['rows'] = $this->aeropuerto->get_aeropuertos(); 
		}catch(Exception $e){
			$data_aeropuerto_form['rows'] = NULL;
		}				
		//Se optienen y limpian los valores enviados desde el formulario
		$aeropuerto = xss_clean($this->input->post('aeropuerto'));
		$idaeropuerto = xss_clean($this->input->post('idaeropuerto'));
		//Se validan los valores
		$this->form_validation->set_rules('aeropuerto', 'Aeropuerto', 'required', array('required' => $this->lang->line('error_required_aeropuerto')));
		if($this->form_validation->run() == FALSE){//Los valores no pasaron el test de validación
			$data_dashboard['content_dashboard'] = $this->load->view('aeropuerto/delete_form',$data_aeropuerto_form,TRUE);
		}else{//Los valores aprobaron el test de validación
			try{
				$this->aeropuerto->delete_aeropuerto(array('aeropuerto' => $aeropuerto, 'idaeropuerto' => $idaeropuerto));
			}catch(Exception $e){
				if($e->getCode() == 1999)
					$data_aeropuerto_form['message'] = $this->lang->line('error_foreingkey_aeropuerto'); 
			}
		}	
		try{
			$data_aeropuerto_form['rows'] = $this->aeropuerto->get_aeropuertos(); 
		}catch(Exception $e){
			$data_aeropuerto_form['rows'] = NULL;
		}			
		$data_dashboard['content_dashboard'] = $this->load->view('aeropuerto/delete_form',$data_aeropuerto_form,TRUE); 	
		$data['content'] = $this->load->view('system/dashboard',$data_dashboard,TRUE);
		$this->load->view('system/layout',$data);	 	
	 }
}
