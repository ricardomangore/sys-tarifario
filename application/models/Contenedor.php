<?php
if(!defined('BASEPATH'))
	exit('No direct script access allowed');

class Contenedor extends CI_Model{
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->helper('security');
	}	
	
	
	/**
	 * set_contenedor()
	 * 
	 * Inserta el registro de un contenedor en la tabla contenedor
	 * 
	 * @param	array	$data	Arreglo asociativo con pares de campo-valor
	 * 							'contenedor'
	 */
	public function set_contenedor( $data){
		extract($data);
		$this->db->trans_start();
			$this->db->insert('carga',array(
				'peso' => $peso,
				'volumen' => $volumen
			));
			$idcarga = $this->db->insert_id();
			if(!$this->db->insert('contenedor', array(
				'idcarga' => $idcarga,
				'pies'	=> $pies,
				'tipo' => $tipo,
				'inside_width' => $inside_width,
				'inside_lenght' => $inside_lenght,
				'inside_height' => $inside_height,
				'door_width' => $door_width,
				'door_height' => $door_height,
				'tare' => $tare 			
			))){//Si no pudo efectuar la inserción	
				throw new Exception('Error',1090);	
			}
		$this->db->trans_complete();
		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			throw new Exception('Error',1090);
		}else{
			$this->db->trans_commit();
		}
	}
	
	/**
	 * get_contenedor_by_id()
	 * 
	 * Retorna el registro de la tabla contenedor buscandolo por idcontenedor
	 * 
	 * @param	int		$idcontenedor		Identificador de contenedor en la tabla de contenedor
	 */
	public function get_contenedor_by_id($idcontenedor){
		var_dump($idcontenedor);
		$this->db->select('idcontenedor,carga.idcarga,pies,tipo,inside_width,inside_height,inside_lenght,door_height,door_width,tare,carga.peso,carga.volumen');
		$this->db->from('contenedor');
		$this->db->join('carga','contenedor.idcarga = carga.idcarga','left');
		$this->db->where('idcontenedor',(int)$idcontenedor);
		$query = $this->db->get();
		$result = $query->result_array();
		if(empty($result)){
			throw new Exception('Error', 1091);
		}
		else
			return $result;
	}
	
	
	/**
	 * get_contenedors()
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
	public function get_contenedores($param = null){
		if(isset($param))
			extract($param);
		$this->db->select('idcontenedor,carga.idcarga,pies,tipo,inside_width,inside_height,inside_lenght,door_height,door_width,tare,carga.peso,carga.volumen');
		$this->db->from('contenedor');
		$this->db->join('carga','contenedor.idcarga = carga.idcarga','left');
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
	 * update_contenedor()
	 * 
	 * Actualiza los datos de un usuario
	 * 
	 * @param	array	$contenedor	Arreglo con los datos a actualizar de una contenedor
	 */
	public function update_contenedor( $contenedor = null){
		extract($contenedor);
		$this->db->trans_start();
			$data_carga = array(
				'peso' => isset($peso)? $peso : NULL,
				'volumen' => isset($volumen)? $volumen: NULL
			);
			$data_contenedor = array(
				'pies' => isset($pies)? $pies: NULL,
				'tipo' => isset($tipo)? $tipo: NULL,
				'tare' => isset($tare)? $tare: NULL,
				'inside_lenght' => isset($inside_lenght)? $inside_lenght: NULL,
				'inside_width' => isset($inside_width)? $inside_width: NULL,
				'inside_height' => isset($inside_height)? $inside_height: NULL,
				'door_height' => isset($door_height)? $door_height: NULL,
				'door_width' => isset($door_width)? $door_width: NULL,
			);
		
			if(isset($data_carga)){
				$this->db->select('idcarga');
				$this->db->from('contenedor');
				$this->db->where('idcontenedor', $idcontenedor);
				$query_contenedor = $this->db->get();
				$result_contenedor = $query_contenedor->result_array();
				$this->db->where('idcarga',$result_contenedor[0]['idcarga']);
				$this->db->update('carga',$data_carga);			
			}
			
			$this->db->where('idcontenedor',$idcontenedor);
			$this->db->update('contenedor', $data_contenedor);
		$this->db->trans_complete();
		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			throw new Exception('Error', 1093);
		}else{
			$this->db->trans_commit();
		}
	} 
	
	/**
	 * delete_aerolinea()
	 * 
	 * 
	 */
	public function delete_contenedor($idcontenedor = null){
		$this->db->trans_start();
				$this->db->select('idcarga');
				$this->db->from('contenedor');
				$this->db->where('idcontenedor', $idcontenedor);
				$query_contenedor = $this->db->get();
				$result_contenedor = $query_contenedor->result_array();
				$idcarga = $result_contenedor[0]['idcarga'];
				
				$this->db->where('idcontenedor', $idcontenedor);
				$this->db->delete('contenedor');
				$this->db->where('idcarga', $idcarga);
				$this->db->delete('carga');
				$error = $this->db->error();
		$this->db->trans_complete();
		if($this->db->trans_status() === FALSE){
			if($error['code'] == 1451)
				throw new Exception('Error',1999);
			else
				throw new Exception('Error', 1094);
		}	
	}
}
