<?php
if(!defined('BASEPATH'))
	exit('No direct script access allowed');

class Region extends CI_Model{
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->helper('security');
	}	
	
	
	/**
	 * set_region()
	 * 
	 * Inserta el registro de una region en la tabla naviera
	 * 
	 * @param	array	$data	Arreglo asociativo con pares de campo-valor
	 * 							'region'
	 */
	public function set_region( $data){
		if(!$this->db->insert('region', $data)){//Si no pudo efectuar la inserción
			throw new Exception('Error',1030);		
		}
	}
	
	/**
	 * get_region_by_id()
	 * 
	 * Retorna el registro de la tabla naviera buscandolo por idregion
	 * 
	 * @param	int		$idregion		Identificador de usuaario en la tabla de
	 */
	public function get_region_by_id($idregion){
		$query = $this->db->select('region')
						  ->where('idregion',$idregion)
						  ->get('region');
		$result = $query->result_array();
		if(empty($result)){
			throw new Exception('Error', 1031);
		}
		else
			return $query->result_array();
	}
	
	
	/**
	 * get_region()
	 * 
	 * Regresa una lista de usuarios delimitada en orden u longitud por los parametros
	 * 
	 * @param	array	$param  Arreglo asociativo con valores para los parametros de busqueda
	 * 							'offset'	desplazamiento de la busqueda
	 * 							'value'		número de registros devueltos en la busqueda
	 * 							'orderby'	campo sobre el cual ordenar
	 * 							'direction'	Tipo de order 'ASC' o 'DESC'
	 * 
	 */
	public function get_regiones($param = null){
		if(isset($param))
			extract($param);
		$this->db->select('idregion,region');
		$this->db->from('region');
		if(isset($offset))
			$this->db->limit($value,$offset);
		if(isset($orderby))
			$this->db->order_by($orderby,$direction);
		$query = $this->db->get();
		$result = $query->result_array();
		if(empty($result)){
			throw new Exception('Error', 1032);
		}else{
			return $result;
		}
		
	}
	
	/**
	 * update_naviera()
	 * 
	 * Actualiza los datos de un usuario
	 * 
	 * @param	array	$user	Arreglo con los datos a actualizar de un usuario
	 */
	public function update_region( $region = null){
		if(isset($region)){
			extract($region);
			$data = array();
			$this->db->where('idregion', $idregion);
			if(isset($region))
				$data['region'] = $region;
			/*if(isset($name))
				$data['name'] = $name;
			if(isset($last_name)) 
				$data['last_name']= $last_name;
			if(isset($mail))
				$data['mail'] = $mail;
			if(isset($password))
				$data['password'] = $password;*/
			$result = $this->db->update('region', $data);
			if(!$result){
				throw new Exception('Error', 1033);
			}
		}else{
			throw new Exception('Error', 6001);
		}
	} 
	
	/**
	 * delete_region()
	 * 
	 * 
	 */
	public function delete_region($region = null){
		if(isset($region)){
			extract($region);
			$this->db->where('idregion',$idregion);
			$this->db->delete('region');
			$affected_rows = $this->db->affected_rows();
			if($affected_rows == 0)
				throw new Exception('Error', 1034);
		}else{
			throw new Exception('Error', 6001);
		}	
	}	
}
