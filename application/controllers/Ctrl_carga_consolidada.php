<?php
if(!defined('BASEPATH'))exit('No direct script access allowed');

class CTRL_Carga_Consolidada extends OPX_Controller{
	
	public function __construct(){
		parent::__construct();
		if(!$this->opx_auth->is_authenticated())
			redirect('login');
	}
	
	public function index(){
		$data_sidebar = array(
			'item_menu_dashboard' => '',
			'item_menu_fletes_maritimos' => '',
			'item_menu_fletes_aereos' => '',
			'item_menu_catalogos' => 'active',
		);
		$data_dashboard['icon_title'] = 'cubes';
		$data_dashboard['header_dashboard'] = 'Carga Consolidada';
		
		$data_header['menu'] = $this->load->view('system/menu',NULL,TRUE);
		$data['header']   = $this->load->view('system/header',$data_header,TRUE);
		$data_dashboard['sidebar'] = $this->load->view('system/sidebar',$data_sidebar,TRUE);
		$data_dashboard['content_dashboard'] = 'Regiones'; 
		$data['content'] = $this->load->view('system/dashboard',$data_dashboard,TRUE);
		$this->load->view('system/layout',$data);
	}
		
}
