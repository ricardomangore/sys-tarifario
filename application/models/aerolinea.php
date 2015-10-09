<?php
if(!defined('BASEPATH'))
	exit('No direct script access allowed');

class Aerolinea extends CI_Model{
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->helper('security');
	}	
	
	
	/**
	 * set_aerolinea()
	 * 
	 * Inserta el registro de una region en la tabla aerolinea
	 * 
	 * @param	array	$data	Arreglo asociativo con pares de campo-valor
	 * 							'aerolinea'
	 */
	public function set_aerolinea( $data){
		if(!$this->db->insert('aerolinea', $data)){//Si no pudo efectuar la inserción
			throw new Exception('Error',1040);		
		}
	}
	
	/**
	 * get_aerolinea_by_id()
	 * 
	 * Retorna el registro de la tabla aerolinea buscandolo por idaerolinea
	 * 
	 * @param	int		$idaerolinea		Identificador de usuaario en la tabla de
	 */
	public function get_aerolinea_by_id($idaerolinea){
		$query = $this->db->select('aerolinea')
						  ->where('idaerolinea',$idaerolinea)
						  ->get('aerolinea');
		$result = $query->result_array();
		if(empty($query->result_array())){
			throw new Exception('Error', 1041);
		}
		else
			return $query->result_array();
	}
	
	
	/**
	 * get_aerolineas()
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
	public function get_aerolineas($param = null){
		if(isset($param))
			extract($param);
		$this->db->select('idaerolinea,aerolinea');
		$this->db->from('aerolinea');
		if(isset($offset))
			$this->db->limit($value,$offset);
		if(isset($orderby))
			$this->db->order_by($orderby,$direction);
		$query = $this->db->get();
		$result = $query->result_array();
		if(empty($result)){
			throw new Exception('Error', 1042);
		}else{
			return $result;
		}	
	}
	
	/**
	 * update_aerolinea()
	 * 
	 * Actualiza los datos de un usuario
	 * 
	 * @param	array	$aerolinea	Arreglo con los datos a actualizar de una aerolinea
	 */
	public function update_aerolinea( $aerolinea = null){
		if(isset($aerolinea)){
			extract($aerolinea);
			$data = array();
			$this->db->where('idaerolinea', $idaerolinea);
			if(isset($aerolinea))
				$data['aerolinea'] = $aerolinea;
			/*if(isset($name))
				$data['name'] = $name;
			if(isset($last_name)) 
				$data['last_name']= $last_name;
			if(isset($mail))
				$data['mail'] = $mail;
			if(isset($password))
				$data['password'] = $password;*/
			$result = $this->db->update('aerolinea', $data);
			if(!$result){
				throw new Exception('Error', 1043);
			}
		}else{
			throw new Exception('Error', 6001);
		}
	} 
	
	/**
	 * delete_aerolinea()
	 * 
	 * 
	 */
	public function delete_aerolinea($aerolinea = null){
		log_message('info','borrando aerolinea');
		if(isset($aerolinea)){
			extract($aerolinea);
			$this->db->where('idaerolinea',$idaerolinea);
			$this->db->delete('aerolinea');
			$error = $this->db->error();
			if(isset($error)){
				if($error['code'] == 1451)
					throw new Exception('Error',1999);
			}
		}else{
			throw new Exception('Error', 6001);
		}	
	}
}