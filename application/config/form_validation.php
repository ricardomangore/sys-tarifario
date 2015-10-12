<?php
	if(!defined('BASEPATH')) exit('No direct script access allowed');
	
$config = array(
	'ctrl_flete_aereo/add' => array(
		array(
			'idaerolinea',
			'IDAerolinea',
			'callback_idaerolinea_check'
		),
		array(
			'minimo',
			'Mínimo',
			'required'
		)
	)
);