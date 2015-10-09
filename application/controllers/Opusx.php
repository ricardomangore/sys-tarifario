<?php
if(!defined('BASEPATH'))
	exit('No direct script access allowed');

class Opusx extends OPX_Controller{
	
	
	public function __construct(){
		parent::__construct();
	}
	
	public function index(){
		log_message('info','xxxxxxxxxxx');
		if(!$this->opx_auth->is_authenticated())
			$this->login();
	}
	
	/**
	 * login()
	 */
	public function login(){
		$data['header']   = $this->load->view('system/header',NULL,TRUE);
		//Obtener y limpiar los datos
		$username = xss_clean($this->input->post('username'));
		$password = do_hash(xss_clean($this->input->post('password')), 'md5');
		//Validar los datos obtenidos
		$this->form_validation->set_rules('username', 'User Name', 'required', array('required' => $this->lang->line('error_required_username')));
		$this->form_validation->set_rules('password', 'Password', 'required', array('required' => $this->lang->line('error_required_password')));
		if($this->form_validation->run() == FALSE){
			//Se despliega el login con mensajes de error
			$data['content'] = $this->load->view('system/login',NULL,TRUE);
		}else{
			try{
				//Se validan las credenciales de acceso				
				$this->opx_auth->auth_user($username, $password);
				//Se redirecciona al controlador del dashboard
				redirect('dashboard');
			}catch(Exception $e){
				$data_login['error_login_message'] = $this->lang->line('error_login_message'); 
				$data['content'] = $this->load->view('system/login',$data_login,TRUE);
			}
		}
		$data['footer'] = $this->load->view('system/footer',NULL,TRUE);
		$this->load->view('system/layout',$data);
	}
	
	public function logout(){
		$this->opx_auth->logout();
			redirect('login');
	}
	
}
