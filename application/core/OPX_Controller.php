<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . 'third_party/opusx/bussines/OPX_Aerolinea.php';
require APPPATH . 'third_party/opusx/bussines/OPX_Aeropuerto.php';
require APPPATH . 'third_party/opusx/bussines/OPX_Carga_Aerea.php';
require APPPATH . 'third_party/opusx/bussines/OPX_Flete_Aereo.php';
require APPPATH . 'third_party/opusx/bussines/OPX_Flete_Maritimo.php';
require APPPATH . 'third_party/opusx/bussines/OPX_Naviera.php';
require APPPATH . 'third_party/opusx/bussines/OPX_Puerto.php';
require APPPATH . 'third_party/opusx/bussines/OPX_Recargo.php';
require APPPATH . 'third_party/opusx/bussines/OPX_Region.php';
require APPPATH . 'third_party/opusx/system/OPX_Auth.php';


class OPX_Controller extends CI_Controller{

	public function __construct(){
		parent::__construct();	
		$this->load->helper('url');	
		$this->load->library('session');
		$this->load->helper('security');
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<p class="text-danger text-left">','<p>');
		$this->config->load('opusx');
		$this->load->database();
		//Cargamos el archivo de lenguaje
		$this->lang->load('message','spanish');
		$this->opx_auth = new OPX_Auth();
	}

}