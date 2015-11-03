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
		
	}
}