<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Puerto extends CI_Model{
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->helper('security');
	}	
	
	
	/**
	 * set_puerto()
	 * 
	 * Inserta el registro de un puerto en la tabla puerto
	 * 
	 * @param	array	$data	Arreglo asociativo con pares de campo-valor
	 * 							'puerto'
	 */
	public function set_puerto( $data){
		if(!$this->db->insert('puerto', $data)){//Si no pudo efectuar la inserción
			throw new Exception('Error',1060);		
		}
	}
	
	/**
	 * get_puerto_by_id()
	 * 
	 * Retorna el registro de la tabla puerto buscandolo por idpuerto
	 * 
	 * @param	int		$idpuerto		Identificador de puerto en la tabla de puerto
	 */
	public function get_puerto_by_id($idpuerto){
		$query = $this->db->select('locode,puerto')
						  ->where('idpuerto',$idpuerto)
						  ->get('puerto');
		$result = $query->result_array();
		if(empty($result)){
			throw new Exception('Error', 1061);
		}
		else
			return $query->result_array();
	}
	
	
	/**
	 * get_puertos()
	 * 
	 * Regresa una lista de puertos delimitada en orden u longitud por los parametros
	 * 
	 * @param	array	$param  Arreglo asociativo con valores para los parametros de busqueda
	 * 							'offset'	desplazamiento de la busqueda
	 * 							'value'		número de registros devueltos en la busqueda
	 * 							'orderby'	campo sobre el cual ordenar
	 * 							'direction'	Tipo de order 'ASC' o 'DESC'
	 * 
	 */
	public function get_puertos($param = null){
		if(isset($param))
			extract($param);
		$this->db->select('idpuerto,locode,puerto');
		$this->db->from('puerto');
		if(isset($offset))
			$this->db->limit($value,$offset);
		if(isset($orderby))
			$this->db->order_by($orderby,$direction);
		$query = $this->db->get();
		$result = $query->result_array();
		if(empty($result)){
			throw new Exception('Error', 1062);
		}else{
			return $result;
		}
		
	}
	
	/**
	 * update_puerto()
	 * 
	 * Actualiza los datos de un puerto
	 * 
	 * @param	array	$puerto	Arreglo con los datos a actualizar de una puerto
	 */
	public function update_puerto( $puerto = null){
		if(isset($puerto)){
			extract($puerto);
			$data = array();
			$this->db->where('idpuerto', $idpuerto);
			if(isset($puerto))
				$data['puerto'] = $puerto;
			if(isset($locode))
				$data['locode'] = $locode;
			$result = $this->db->update('puerto', $data);
			if(!$result){
				throw new Exception('Error', 1063);
			}
		}else{
			throw new Exception('Error', 6001);
		}
	} 
	
	/**
	 * delete_puerto()
	 * 
	 * 
	 */
	public function delete_puerto($puerto = null){
		if(isset($puerto)){
			extract($puerto);
			$this->db->where('idpuerto',$idpuerto);
			$this->db->delete('puerto');
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
