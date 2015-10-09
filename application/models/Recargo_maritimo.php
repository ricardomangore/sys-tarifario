<?php
if(!defined('BASEPATH'))
	exit('No direct script access allowed');

class Recargo_Maritimo extends CI_Model{
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	
	/**
	 * set_recargo_maritimo
	 * 
	 * Inserta un nuevo registro recargo en las tablas recargo y  recargo_maritimo
	 * 
	 * @param $recargo array	Arreglo con valores para cada uno de los campos recargo
	 * 							'idnaviera'		    Identificador de la naviera que ejerce el recargo
	 * 							'clave'				Clave alfanumerica del recargo
	 * 							'descripcion'		Descripción del recargo
	 * 							'costo'				Costo del recargo
	 */
	public function set_recargo_maritimo( $recargo ){
		$data = array(
			'clave' 	  => $recargo['clave'],
			'descripcion' => $recargo['descripcion'],
			'costo'		  => (float)$recargo['costo']
		);
		$this->db->trans_start();
			$this->db->insert('recargo', $data );
			$recargo_maritimo = array(
				'idnaviera'	=> $recargo['idnaviera'],
				'idrecargo'		=> $this->db->insert_id()
			);
			$this->db->insert('recargo_maritimo', $recargo_maritimo);
		$this->db->trans_complete();
		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			throw new Exception('Error',1080);
		}else{
			$this->db->trans_commit();
			return TRUE;
		}
	}
	
	/*
	 * get_recargos_maritimos()
	 * 
	 * Regresa una lista de recargos aéreos
	 * 
	 */
	public function get_recargos_maritimos( $param = null){
		if(isset($param))
			extract($param);
		$this->db->select('*');
		$this->db->from('recargo_maritimo');
		$this->db->join('naviera','idnaviera','left');
		$this->db->join('recargo','idrecargo','left');
		if(isset($offset))
			$this->db->limit($value,$offset);
		if(isset($orderby))
			$this->db->order_by($orderby,$direction);
		$query = $this->db->get();
		$result = $query->result_array();
		if(empty($result)){
			throw new Exception('Error', 1081);
		}else{
			return $result;
		}
	}
	
	/**
	 * get_recargo_maritimo_by_id()
	 * 
	 * Retorna el un registro de un recargo maritimo dado un ID de la tabla recargo_maritimo
	 * 
	 * @param	INT		Identificador del recargo maritimo
	 */
	public function get_recargo_maritimo_by_id($id_recargo_maritimo){
		$this->db->select('*');
		$this->db->from('recargo_maritimo');
		$this->db->join('recargo','recargo.idrecargo = recargo_maritimo.idrecargo','left');
		$this->db->join('naviera', 'naviera.idnaviera = recargo_maritimo.idnaviera', 'left');
		$this->db->where('recargo_maritimo.idrecargo_maritimo = ' . $id_recargo_maritimo);
		$query = $this->db->get();
		if(empty($query->result_array()))
			throw new Exception('Error', 1082);
		else	
			return $query->result_array();
	}
	
	/**
	 * update_recargo_maritimo
	 * 
	 * Actualiza un registro de recargo maritimo y de la tabla recargo
	 * 
	 * @param array		params    Arreglo que contienen lo snuevo svalores de los campos a actulizar 
	 */
	public function update_recargo_maritimo($recargo_maritimo = null){
		extract($recargo_maritimo);
		$this->db->trans_start();
			$this->db->set('idnaviera', $idnaviera);
			$this->db->where('idrecargo_maritimo', $idrecargo_maritimo);
			$this->db->update('recargo_maritimo');
					
			$this->db->select('*');
			$this->db->from('recargo_maritimo');
			$this->db->where('idrecargo_maritimo', $idrecargo_maritimo);
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
			throw new Exception('Error', 1083);
		}else{
			$this->db->trans_commit();
			return TRUE;
		}	
	}
	
	/**
	 * delete_recargo_maritimo
	 * 
	 * Elimina un registro de la tabla recargo_maritimo y el registro relacionado con este en la tabla recargo
	 * 
	 * @param	int		idrecargo_maritimo		Llave única del registro que sera eliminado
	 */
	 function delete_recargo_maritimo($recargo_maritimo = null){
	 	extract($recargo_maritimo);
		$this->db->select('*');
		$this->db->from('rel_flete_maritimo_recargo_maritimo');
		$this->db->where('idrecargo_maritimo', $idrecargo_maritimo);
		$query_rel = $this->db->get();
		if(empty($query_rel->result_array())){
			$this->db->trans_start();
				$this->db->select('*');
				$this->db->from('recargo_maritimo');
				$this->db->where('idrecargo_maritimo',$idrecargo_maritimo);
				$query = $this->db->get();
				$idrecargos = $query->result_array();
				
				$this->db->where('idrecargo_maritimo',$idrecargo_maritimo);
				$this->db->delete('recargo_maritimo');			
				
				foreach($idrecargos as $idrecargo ){
					$this->db->where('idrecargo', $idrecargo['idrecargo']);
					$this->db->delete('recargo');
				}
				
			$this->db->trans_complete();
			if($this->db->trans_status() === FALSE){
				$this->db->trans_rollback();
				throw new Exception('Error',1084);	
			}else{
				$this->db->trans_commit();
				return TRUE;
			}
		}else{
			throw new Exception('Error',1999);
		}
	 }
}
