<?php
if(!defined('BASEPATH')) 	exit('No direct script access allowed');

class Flete_Aereo extends CI_Model{
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	
	/**
	 * set_flete_aere
	 * 
	 * Inserta un nuevo registro en las tablas de flete_aereo y  recargo_aereo
	 * 
	 * @param $recargo array	Arreglo con valores para cada uno de los campos de flete_aereo
	 * 							'vias' array()		Arreglo con la lista de identificadores de Aeropuertos en oso que se efectuara transbordo
	 * 							'aol'				Identificador del Aeropuerto de carga
	 * 							'aod'				Identificador del Aeropuerto de descarga
	 * 							'idregion'			Identificador de la región
	 * 							'idaerolinea'		Identificador de la aerollínea
	 * 							'vigencia'			Fecha de la vigencia de la tarifa
	 * 							'minimo'			Valor mínimo para la tafira
	 * 							'normal'			Indicador
	 * 							'precios' array()	Arreglo con la lsita de precion por rango ofrececidos por la aerolínea
	 */
	public function set_flete_aereo( $data ){
		extract($data);
		$this->db->trans_start();

			$flete_aereo = array(
				'via' => $has_via,
				'aol' => $aol,
				'aod' => $aod,
				'idregion' => $idregion,
				'idaerolinea' => $idaerolinea,
				'vigencia'=> $vigencia,
				'minimo' => $minimo,
				'normal' => $normal,
			);
			$this->db->insert('flete_aereo', $flete_aereo );
			$idflete_aereo = $this->db->insert_id();
			foreach($intervalos as $intervalo){
				$this->db->insert('intervalo', array(
					'idflete_aereo' => $idflete_aereo,
					'precio' => $intervalo['precio'],
					'min'	 => $intervalo['min'],
					'max'    => $intervalo['max']
				));
			}
			if($has_via)
				foreach($vias as $via){
					$this->db->insert('via2', array(
						'idflete_aereo' => $idflete_aereo,
						'idaeropuerto'  => $via
					));
				}
			if($has_recargos)
				foreach($recargos as $recargo){
					$this->db->insert('rel_flete_aereo_recargo_aereo', array(
						'idflete_aereo' => $idflete_aereo,
						'idrecargo_aereo' => $recargo
					));
				}
			

		$this->db->trans_complete();
		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			throw new Exception('Error',1060);
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
	public function get_fletes_aereos( $param = null){
		$this->db->trans_start();
			if(isset($param))
				extract($param);
			$this->db->select('idflete_aereo,via,aol,aod,region.idregion,region.region, aerolinea.idaerolinea, aerolinea.aerolinea, vigencia,minimo,normal');
			$this->db->from('flete_aereo');
			$this->db->join('region','flete_aereo.idregion = region.idregion','left');
			$this->db->join('aerolinea','flete_aereo.idaerolinea = aerolinea.idaerolinea', 'left');
			if(isset($offset))
				$this->db->limit($value,$offset);
			if(isset($orderby))
				$this->db->order_by($orderby,$direction);
			$query = $this->db->get();
			$flete_aereo_array = $query->result_array();
			
			$flete_aereo_result = array();
			foreach($flete_aereo_array as $flete_aereo_row){

				$this->db->select('code,pais,ciudad,aeropuerto');
				$this->db->from('aeropuerto');
				$this->db->where('idaeropuerto', $flete_aereo_row['aol']);
				$query_aol = $this->db->get();
				$query_aol->result_array();

				$this->db->select('code,pais,ciudad,aeropuerto');
				$this->db->from('aeropuerto');
				$this->db->where('idaeropuerto', $flete_aereo_row['aod']);
				$query_aod = $this->db->get();
				$query_aod->result_array();		
				
				$this->db->select('code,pais,ciudad,aeropuerto');
				$this->db->from('via2');
				$this->db->join('aeropuerto','via2.idaeropuerto = aeropuerto.idaeropuerto','left');
				$this->db->where('idflete_aereo', $flete_aereo_row['idflete_aereo']);
				$query_via = $this->db->get();
				$query_via->result_array();	
				
				$this->db->select('min,max,precio');
				$this->db->from('intervalo');
				$this->db->where('idflete_aereo', $flete_aereo_row['idflete_aereo']);	
				$query_precios = $this->db->get();
				
				$this->db->select('idrel_flete_aereo_recargo_aereo,idflete_aereo, aerolinea,clave,descripcion,costo');
				$this->db->from('rel_flete_aereo_recargo_aereo');
				$this->db->join('recargo_aereo','rel_flete_aereo_recargo_aereo.idrecargo_aereo = recargo_aereo.idrecargo_aereo','left');
				$this->db->join('aerolinea','recargo_aereo.idaerolinea = aerolinea.idaerolinea','left');
				$this->db->join('recargo','recargo_aereo.idrecargo = recargo.idrecargo','left');
				$this->db->where('idflete_aereo', $flete_aereo_row['idflete_aereo']);					
				$query_recargos = $this->db->get();
				$data = array(
					'flete_aereo' => $flete_aereo_row,
					'aol'	=> $query_aol->result_array()[0],
					'aod'	=> $query_aod->result_array()[0],
					'via'   => $query_via->result_array(),
					'precios' => $query_precios->result_array(),
					'recargos' => $query_recargos->result_array()
				);
				array_push($flete_aereo_result,$data);
			}
		$this->db->trans_complete();
		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			throw new Exception('Error', 1061);
		}else{
			$this->db->trans_commit();
			return $flete_aereo_result;
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