<?php
if(!defined('BASEPATH'))
	exit('No direct script access allowed');

class Recargo_Aereo extends CI_Model{
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	
	/**
	 * set_recargo_aereo
	 * 
	 * Inserta un nuevo registro recargo en las tablas recargo y  recargo_aereo
	 * 
	 * @param $recargo array	Arreglo con valores para cada uno de los campos recargo
	 * 							'idaerolinea'		Identificador de la aerolinea que ejerce el recargo
	 * 							'clave'				Clave alfanumerica del recargo
	 * 							'descripcion'		Descripción del recargo
	 * 							'costo'				Costo del recargo
	 */
	public function set_recargo_aereo( $recargo ){
		$data = array(
			'clave' 	  => $recargo['clave'],
			'descripcion' => $recargo['descripcion'],
			'costo'		  => (float)$recargo['costo']
		);
		$this->db->trans_start();
			$this->db->insert('recargo', $data );
			$recargo_aereo = array(
				'idaerolinea'	=> $recargo['idaerolinea'],
				'idrecargo'		=> $this->db->insert_id()
			);
			$this->db->insert('recargo_aereo', $recargo_aereo);
		$this->db->trans_complete();
		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			throw new Exception('Error',1050);
		}else{
			$this->db->trans_commit();
			return TRUE;
		}
	}
	
	/*
	 * get_recargos_aereos()
	 * 
	 * Regresa una lista de recargos aéreos
	 * 
	 */
	public function get_recargos_aereos( $param = null){
		if(isset($param))
			extract($param);
		$this->db->select('*');
		$this->db->from('recargo_aereo');
		$this->db->join('aerolinea','idaerolinea','left');
		$this->db->join('recargo','idrecargo','left');
		if(isset($offset))
			$this->db->limit($value,$offset);
		if(isset($orderby))
			$this->db->order_by($orderby,$direction);
		$query = $this->db->get();
		$result = $query->result_array();
		if(empty($result)){
			throw new Exception('Error', 1051);
		}else{
			return $result;
		}
	}
	
	/**
	 * get_recargo_aereo_by_id()
	 * 
	 * Retorna el un registro de un recargo aereo dado un ID de la tabla recargo_aereo
	 * 
	 * @param	INT		Identificador del recargo aereo
	 */
	public function get_recargo_aereo_by_id($id_recargo_aereo){
		$this->db->select('*');
		$this->db->from('recargo_aereo');
		$this->db->join('recargo','recargo.idrecargo = recargo_aereo.idrecargo','left');
		$this->db->join('aerolinea', 'aerolinea.idaerolinea = recargo_aereo.idaerolinea', 'left');
		$this->db->where('recargo_aereo.idrecargo_aereo = ' . $id_recargo_aereo);
		$query = $this->db->get();
		if(empty($query->result_array()))
			throw new Exception('Error', 1052);
		else	
			return $query->result_array();
	}
	
	/**
	 * update_recargo_aereo
	 * 
	 * Actualiza un registro de recargo aereo y de la tabla recargo
	 * 
	 * @param array		params    Arreglo que contienen lo snuevo svalores de los campos a actulizar 
	 */
	public function update_recargo_aereo($recargo_aereo = null){
		extract($recargo_aereo);
		$this->db->trans_start();
			$this->db->set('idaerolinea', $idaerolinea);
			$this->db->where('idrecargo_aereo', $idrecargo_aereo);
			$this->db->update('recargo_aereo');
					
			$this->db->select('*');
			$this->db->from('recargo_aereo');
			$this->db->where('idrecargo_aereo', $idrecargo_aereo);
			$query = $this->db->get();
			$result = $query->result_array();	

			$this->db->set('clave',$clave);
			$this->db->set('descripcion',$descripcion);
			$this->db->set('costo',$costo);
			$this->db->where('idrecargo', $result[0]['idrecargo']);
			$this->db->update('recargo');
		$this->db->trans_complete();
		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			throw new Exception('Error', 1053);
		}else{
			$this->db->trans_commit();
			return TRUE;
		}	
	}
	
	/**
	 * delete_recargo_aereo
	 * 
	 * Elimina un registro de la tabla recargo_aereo y el registro relacionado con este en la tabla recargo
	 * 
	 * @param	int		idrecargo_aereo		Llave única del registro que sera eliminado
	 */
	 function delete_recargo_aereo($recargo_aereo = null){
	 	extract($recargo_aereo);
		$this->db->select('*');
		$this->db->from('rel_flete_aereo_recargo_aereo');
		$this->db->where('idrecargo_aereo', $idrecargo_aereo);
		$query_rel = $this->db->get();
		if(empty($query_rel->result_array())){
			$this->db->trans_start();
				$this->db->select('*');
				$this->db->from('recargo_aereo');
				$this->db->where('idrecargo_aereo',$idrecargo_aereo);
				$query = $this->db->get();
				$idrecargos = $query->result_array();
				
				$this->db->where('idrecargo_aereo',$idrecargo_aereo);
				$this->db->delete('recargo_aereo');			
				
				foreach($idrecargos as $idrecargo ){
					$this->db->where('idrecargo', $idrecargo['idrecargo']);
					$this->db->delete('recargo');
				}
				
			$this->db->trans_complete();
			if($this->db->trans_status() === FALSE){
				$this->db->trans_rollback();
				throw new Exception('Error',1054);	
			}else{
				$this->db->trans_commit();
				return TRUE;
			}
		}else{
			throw new Exception('Error',1999);
		}
	 }
}
