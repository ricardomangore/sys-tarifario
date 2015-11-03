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
	),
	'ctrl_flete_aereo/edit' => array(
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
	),
	'ctrl_flete_maritimo/add' => array(
	        array(
				'field' => 'pol',
				'label' => 'Puerto de Carga',
				'rules' => 'callback_pol_check'
			),
	        array(
				'field' => 'pod',
				'label' => 'Puerto de Descarga',
				'rules' => 'callback_pod_check'
			),
			array(
				'field' => 'idnaviera',
				'label' => 'Naviera',
				'rules' => 'callback_idnaviera_check'
			),
	        array(
				'field' => 'idregion',
				'label' => 'Región',
				'rules' => 'callback_idregion_check'
			),
	        array(
				'field' => 'vigencia',
				'label' => 'Vigencia',
				'rules' => 'trim|required'
			),				
	        array(
	            'field' => 'precio',
	            'label' => 'Precio',
	            'rules' => 'trim|required'
	        ),
	        array(
				'field' => 'profit',
				'label' => 'Profit',
				'rules' => 'trim|required'
			)	        
	),
	
	'ctrl_region/add' => array(
		array(
			'field' => 'region',
			'label' => 'Región',
			'rules' => 'required|min_length[3]|max_length[20]|is_unique[region.region]'
		)
	),
	'ctrl_region/edit' => array(
		array(
			'field' => 'region',
			'label' => 'Región',
			'rules' => 'required|min_length[3]|max_length[20]'
		)
	),
	'ctrl_contenedor/add' => array(
		array(
			'field' => 'pies',
			'label' => 'Pies',
			'rules' => 'required|numeric'
		),
		array(
			'field' => 'peso',
			'label' => 'Max Play Load',
			'rules' => 'required|numeric'
		),
		array(
			'field' => 'volumen',
			'label' => 'Volumen',
			'rules' => 'required|numeric'
		),
		array(
			'field' => 'tipo',
			'label' => 'Tipo',
			'rules' => 'required|max_length[20]'
		),
		array(
			'field' => 'tare',
			'label' => 'Tare',
			'rules' => 'required|numeric'
		)				
	),	
	'ctrl_recargo_maritimo/add' => array(
		array(
			'field' => 'clave',
			'label' => 'Clave',
			'rules' => 'trim|required'
		),
		array(
			'field' => 'descripcion',
			'label' => 'Descripción',
			'rules' => 'trim'
		),
		array(
			'field' => 'costo',
			'label' => 'Costo',
			'rules' => 'trim|required|numeric'
		),
		array(
			'field' => 'idnaviera',
			'label' => 'Naviera',
			'rules' => 'callback_naviera_check'
		)				
	),
	'ctrl_recargo_maritimo/edit' => array(
		array(
			'field' => 'clave',
			'label' => 'Clave',
			'rules' => 'trim|required'
		),
		array(
			'field' => 'descripcion',
			'label' => 'Descripción',
			'rules' => 'trim'
		),
		array(
			'field' => 'costo',
			'label' => 'Costo',
			'rules' => 'trim|required|numeric'
		),
		array(
			'field' => 'idnaviera',
			'label' => 'Naviera',
			'rules' => 'callback_naviera_check'
		)				
	)/*,
	'ctrl_add_flete_maritimo/validate' => array(
		array(
			'field' => 'precio',
			'label' => 'Precio',
			'rules' => 'trim|required|numeric'
		),
		array(
			'field' => 'pol',
			'label' => 'POL',
			'rules' => 'callback_pol_check'
		),
		array(
			'field' => 'pod',
			'label' => 'POLD',
			'rules' => 'callback_pod_check'
		),
		array(
			'field' => 'idnaviera',
			'label' => 'Naviera',
			'rules' => 'callback_idnaviera_check'
		),
		array(
			'field' => 'idregion',
			'label' => 'Región',
			'rules' => 'callback_idregion_check'
		)			
	)*/	
);