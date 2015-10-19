<?php
if(!defined('BASEPATH')) 	exit('No direct script access allowed');

class Test_flete_aereo extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->model('flete_aereo');
		$this->load->model('region');
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
	
	public function test_is_equal_region(){
		$result = $this->region->is_equal('region 02');
		var_dump($result);
	}
	
}