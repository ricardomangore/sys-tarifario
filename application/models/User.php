<?php
if(!defined('BASEPATH'))exit('No direct script access allowed');

class User extends CI_Model{
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->helper('security');
	}	
	
	
	/**
	 * set_user()
	 * 
	 * Inserta el registro de un usuario en la tabla user
	 * 
	 * @param	array	$data	Arreglo asociativo con pares de campo-valor
	 * 							'user'
	 * 							'password'
	 * 							'name'
	 * 							'last_name'
	 * 							'mail'
	 */
	public function set_user( $data){
		if(!$this->db->insert('opx_user', $data)){//Si no pudo efectuar la inserción
			throw new Exception('Error',1001);		
		}
	}
	
	/**
	 * get_user_by_id()
	 * 
	 * Retorna el registro de la tabla opx_user buscandolo por iduser
	 * 
	 * @param	int		$iduser		Identificador de usuaario en la tabla de
	 */
	public function get_user_by_id($iduser){
		$query = $this->db->select('user,name,last_name,mail')
						  ->where('id_user',$iduser)
						  ->get('opx_user');
		$result = $query->result_array();
		if(empty($query->result_array())){
			throw new Exception('Error', 1002);
		}
		else
			return $query->result_array();
	}
	
	/**
	 * user_auth()
	 * 
	 * Determina con base en el nombre de usuario y password si el usuario esta registrado
	 * 
	 * @param	array	$user	Arreglo asociativo con las credenciales del usuario
	 */
	 public function user_auth( $user = null ){
	 	if(isset($user)){
		 	extract($user);
			$this->db->select('id_user,user,name,last_name,mail');
			$this->db->from('opx_user');
			$this->db->where('user',$user);
			$this->db->where('password',$password);
			$query = $this->db->get();
			if(empty($query->result_array()))
				throw new Exception('Error', 1003);
			else
				return $query->result_array();
		}else{
			throw new Exception('Error', 6001);
		}
	 }
	
	/**
	 * get_users()
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
	public function get_users($param = null){
		if(isset($param))
			extract($param);
		$this->db->select('id_user,user,name,last_name,mail');
		$this->db->from('opx_user');
		if(isset($offset))
			$this->db->limit($value,$offset);
		if(isset($orderby))
			$this->db->order_by($orderby,$direction);
		$query = $this->db->get();
		$result = $query->result_array();
		if(empty($result)){
			throw new Exception('Error', 1004);
		}else{
			return $result;
		}
		
	}
	
	/**
	 * update_user()
	 * 
	 * Actualiza los datos de un usuario
	 * 
	 * @param	array	$user	Arreglo con los datos a actualizar de un usuario
	 */
	public function update_user_profile( $user = null){
		if(isset($user)){
			extract($user);
			$data = array();
			$this->db->where('id_user', $id_user);
			if(isset($user))
				$data['user'] = $user;
			if(isset($name))
				$data['name'] = $name;
			if(isset($last_name)) 
				$data['last_name']= $last_name;
			if(isset($mail))
				$data['mail'] = $mail;
			if(isset($password))
				$data['password'] = $password;
			$result = $this->db->update('opx_user', $data);
			if(!$result){
				throw new Exception('Error', 1005);
			}
		}else{
			throw new Exception('Error', 6001);
		}
	} 
	
	/**
	 * delete_user()
	 * 
	 * 
	 */
	public function delete_user($user = null){
		if(isset($user)){
			extract($user);
			$this->db->where('id_user',$id_user);
			$this->db->delete('opx_user');
			$affected_rows = $this->db->affected_rows();
			if($affected_rows == 0)
				throw new Exception('Error', 1006);
		}else{
			throw new Exception('Error', 6001);
		}	
	}
}//Termina la clase de modelo User
