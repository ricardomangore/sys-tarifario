<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Flete_Maritimo extends CI_Model{
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	
	/**
	 * set_flete_maritimo
	 * 
	 * Inserta un nuevo registro en las tablas de flete_marítimo
	 * 
	 * @param $recargo array	Arreglo con valores para cada uno de los campos de flete_marítimo
	 * 							'vias' array()		Arreglo con la lista de identificadores de Puertos en los que se efectuara transbordo
	 * 							'recargos' array()  Arreglo con los identificadores de recargos asignados al flete
	 * 							'idcarga'			Identificador único de la carga
	 * 							'tipo'              Entero que indica el tipo de carga 1-Consolidad, 2-Contenerizada
	 * 							'precio'			Precio
	 * 							'tt'				Tiempo de transito
	 * 							'vigencia'			Fecha hasta la cual es valida la tarifa
	 * 							'pol'		        Puerto de carga
	 *                          'pod'  				Puerto de descarga
	 * 							'vigencia'			Fecha de la vigencia de la tarifa
	 * 							'idnaviera'	        Identificador único de la naviera
	 * 							'idregion' 			Identificador único de la región
	 */
	public function set_flete_maritimo( $data ){
		extract($data);
		$this->db->trans_start();
			$flete_maritimo = array(
				'via' => $has_vias,
				'pol' => $pol,
				'pod' => $pod,
				'idregion' => $idregion,
				'idnaviera' => $idnaviera,
				'vigencia'=> $vigencia,
				'tt' => $tt,
				'precio' => $precio
			);
			$this->db->insert('flete_maritimo', $flete_maritimo );
			$idflete_maritimo = $this->db->insert_id();
			var_dump($vias);
			if($has_vias)
				foreach($vias as $via){
					$this->db->insert('via1', array(
						'idfletemaritimo' => $idflete_maritimo,
						'idpuerto'  => $via
					));
				}
			if($has_recargos)
				foreach($recargos as $recargo){
					$this->db->insert('rel_flete_maritimo_recargo_maritimo', array(
						'idflete_maritimo' => $idflete_maritimo,
						'idrecargo_maritmo' => $recargo
					));
				}
			if(isset($idcarga)){
				$this->db->insert('rel_flete_maritimo_carga',array(
					'idcarga' => $idcarga,
					'idflete_maritimo' => $idflete_maritimo,
					'tipo' => $tipo
				));				
			}else{
				$this->db->insert('carga',array(
					'peso' => $peso,
					'volumen' => $volumen
				));
				$idcarga_aux = $this->db->insert_id();
				$this->db->insert('rel_flete_maritimo_carga',array(
					'idcarga' => $idcarga_aux,
					'idflete_maritimo' => $idflete_maritimo,
					'tipo' => $tipo
				));				
			}

		$this->db->trans_complete();
		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			throw new Exception('Error',2020);
		}else{
			$this->db->trans_commit();
			return TRUE;
		}
	}
	
	/*
	 * get_fletes_maritimos()
	 * 
	 * Regresa una lista de fletes maritimos
	 * 
	 */
	public function get_fletes_maritimos( $param = null){
		$this->db->trans_start();
			if(isset($param))
				extract($param);
			$this->db->select('*');
			$this->db->from('flete_maritimo');
			$this->db->join('region','flete_maritimo.idregion = region.idregion','left');
			$this->db->join('naviera','flete_maritimo.idnaviera = naviera.idnaviera', 'left');
			if(isset($offset))
				$this->db->limit($value,$offset);
			if(isset($orderby))
				$this->db->order_by($orderby,$direction);
			$query = $this->db->get();
			$flete_maritimo_array = $query->result_array();
			
			$flete_maritimo_result = array();
			foreach($flete_maritimo_array as $flete_maritimo_row){

				$this->db->select('locode,puerto');
				$this->db->from('puerto');
				$this->db->where('idpuerto', $flete_maritimo_row['pol']);
				$query_pol = $this->db->get();
				$query_pol->result_array();

				$this->db->select('locode,puerto');
				$this->db->from('puerto');
				$this->db->where('idpuerto', $flete_maritimo_row['pod']);
				$query_pod = $this->db->get();
				$query_pod->result_array();		
				
				$this->db->select('locode,puerto');
				$this->db->from('via1');
				$this->db->join('puerto','via1.idpuerto = puerto.idpuerto','left');
				$this->db->where('idfletemaritimo', $flete_maritimo_row['idflete_maritimo']);
				$query_via = $this->db->get();
				$query_via->result_array();	
				
				$this->db->select('idrel_flete_maritimo_recargo_maritimo,idflete_maritimo, naviera,clave,descripcion,costo');
				$this->db->from('rel_flete_maritimo_recargo_maritimo');
				$this->db->join('recargo_maritimo','rel_flete_maritimo_recargo_maritimo.idrecargo_maritmo = recargo_maritimo.idrecargo_maritimo','left');
				$this->db->join('naviera','recargo_maritimo.idnaviera = naviera.idnaviera','left');
				$this->db->join('recargo','recargo_maritimo.idrecargo = recargo.idrecargo','left');
				$this->db->where('idflete_maritimo', $flete_maritimo_row['idflete_maritimo']);					
				$query_recargos = $this->db->get();
				$data = array(
					'flete_maritimo' => $flete_maritimo_row,
					'pol'	=> $query_pol->result_array()[0],
					'pod'	=> $query_pod->result_array()[0],
					'via'   => $query_via->result_array(),
					'recargos' => $query_recargos->result_array()
				);
				array_push($flete_maritimo_result,$data);
			}
		$this->db->trans_complete();
		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			throw new Exception('Error', 1061);
		}else{
			$this->db->trans_commit();
			return $flete_maritimo_result;
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
		$this->db->trans_start();
			$this->db->select('*');
			$this->db->from('recargo_aereo');
			$this->db->where('idrecargo_aereo', $idrecargo_aereo);
			$query = $this->db->get();
			$result = $query->result_array();

			$this->db->where('idrecargo_aereo',$idrecargo_aereo);
			$this->db->delete('recargo_aereo');			
			
			$this->db->where('idrecargo', $result[0]['idrecargo']);
			$this->db->delete('recargo');
			
		$this->db->trans_complete();
		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			throw new Exception('Error',1054);	
		}else{
			$this->db->trans_commit();
			return TRUE;
		}
	 }
}
