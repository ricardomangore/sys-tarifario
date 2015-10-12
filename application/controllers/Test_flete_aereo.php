<?php
if(!defined('BASEPATH')) 	exit('No direct script access allowed');

class Test_flete_aereo extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->model('flete_aereo');
	}
	
	public function index(){
		echo "test flete_aereo";
	}
	
	
	public function test_get_flete_aereo_by_id($id){
		try{
			$result = $this->flete_aereo->get_flete_aereo_by_id($id);
			var_dump($result);
		}catch(Exception $e){
			echo "Error: " . $e->getCode();
		}	
	}
	
}