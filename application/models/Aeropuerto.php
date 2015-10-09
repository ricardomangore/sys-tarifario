<?php
if(!defined('BASEPATH'))
	exit('No direct script access allowed');

class Aeropuerto extends CI_Model{
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->helper('security');
	}	
	
	
	/**
	 * set_aeropuerto()
	 * 
	 * Inserta el registro de un aeropuerto en la tabla aeropuerto
	 * 
	 * @param	array	$data	Arreglo asociativo con pares de campo-valor
	 * 							'aeropuerto'
	 */
	public function set_aeropuerto( $data){
		if(!$this->db->insert('aeropuerto', $data)){//Si no pudo efectuar la inserción
			throw new Exception('Error',1050);		
		}
	}
	
	/**
	 * get_aeropuerto_by_id()
	 * 
	 * Retorna el registro de la tabla aeropuerto buscandolo por idaeropuerto
	 * 
	 * @param	int		$idaerolinea		Identificador de usuario en la tabla de
	 */
	public function get_aeropuerto_by_id($idaeropuerto){
		$query = $this->db->select('aeropuerto,ciudad,pais,code')
						  ->where('idaeropuerto',$idaeropuerto)
						  ->get('aeropuerto');
		$result = $query->result_array();
		if(empty($query->result_array())){
			throw new Exception('Error', 1051);
		}
		else
			return $query->result_array();
	}
	
	
	/**
	 * get_aeropuertos()
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
	public function get_aeropuertos($param = null){
		if(isset($param))
			extract($param);
		$this->db->select('idaeropuerto,aeropuerto,ciudad,code,pais');
		$this->db->from('aeropuerto');
		if(isset($offset))
			$this->db->limit($value,$offset);
		if(isset($orderby))
			$this->db->order_by($orderby,$direction);
		$query = $this->db->get();
		$result = $query->result_array();
		if(empty($result)){
			throw new Exception('Error', 1052);
		}else{
			return $result;
		}
		
	}
	
	/**
	 * update_aeropuerto()
	 * 
	 * Actualiza los datos de un usuario
	 * 
	 * @param	array	$aeropuerto	Arreglo con los datos a actualizar de una aeropuerto
	 */
	public function update_aeropuerto( $aeropuerto = null){
		if(isset($aeropuerto)){
			extract($aeropuerto);
			$data = array();
			$this->db->where('idaeropuerto', $idaeropuerto);
			if(isset($aeropuerto))
				$data['aeropuerto'] = $aeropuerto;
			if(isset($code))
				$data['code'] = $code;
			if(isset($ciudad))
				$data['ciudad'] = $ciudad;
			if(isset($pais))
				$data['pais'] = $pais;
			$result = $this->db->update('aeropuerto', $data);
			if(!$result){
				throw new Exception('Error', 1053);
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
	public function delete_aeropuerto($aeropuerto = null){
		if(isset($aeropuerto)){
			extract($aeropuerto);
			$this->db->where('idaeropuerto',$idaeropuerto);
			$this->db->delete('aeropuerto');
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
