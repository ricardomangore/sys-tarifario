<?php
if(!defined('BASEPATH'))
	exit('No direct script access allowed');

class Carga_Aerea extends CI_Model{
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	/**
	 * set_carga_aerea()
	 * 
	 * Inserta un registro de carga_aerea en la base de datos
	 * 
	 * Lanza una exepxión si ocurre un error
	 */
	public function set_carga_aerea( $carga_aerea ){	
		if(! $this->db->insert('carga2', $carga_aerea )){//Si la inserción regresa FALSE el método lanza una exepción
			$error = $this->db->error();
			log_message('error','Carga_Aerea.set_carga_aerea: '. $error['message']);
			throw new Exception('Model Error',1001);
		}
	}
	
	/**
	 * get_cargas_aereas()
	 * 
	 * Obtienen un alista de tosos los registros almacenados en la entidad carga_aerea
	 */
	public function get_cargas_aereas(){
		$this->db->select('*');
		$this->db->from('carga2');
		$query = $this->db->get();
		$result = $query->result_array();		
		if(empty($result)){//Si el arreglo esta vacio el usuario NO existe
			log_message('error', 'Carga_Aerea.get_cargas_aerea'. $error['message']);
			throw new Exception('Model Error', 1002);
		}
		else
			return $result; 
	}
	
}