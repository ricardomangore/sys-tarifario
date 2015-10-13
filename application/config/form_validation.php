<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
	
$config = array(
	'ctrl_flete_aereo/add' => array(
        array(
			'field' => 'idregion',
			'label' => 'Región',
			'rules' => 'callback_idregion_check'
		),
        array(
			'field' => 'idaerolinea',
			'label' => 'Aerolínea',
			'rules' => 'callback_idaerolinea_check'
		),
		array(
			'field' => 'aol',
			'label' => 'Origen',
			'rules' => 'callback_aol_check'
		),
        array(
			'field' => 'aod',
			'label' => 'Destino',
			'rules' => 'callback_aod_check'
		),
        array(
			'field' => 'vigencia',
			'label' => 'Vigencia',
			'rules' => 'trim|required'
		),				
        array(
            'field' => 'minimo',
            'label' => 'Mínimo',
            'rules' => 'trim|required'
        ),
        array(
			'field' => 'normal',
			'label' => 'Normal',
			'rules' => 'trim|required'
		),
        array(
			'field' => 'profit_base',
			'label' => 'Profit Base',
			'rules' => 'trim|required'
		)		        
	)
);