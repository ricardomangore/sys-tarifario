<?php
	if(!defined('BASEPATH'))
		exit('No direct script access allowed');
	
$config['opusX_version'] = '0.1';
	
$CI = & get_instance();	

define('_CSS_PATH', $CI->config->base_url() . 'assets/css');
define('_JS_PATH', $CI->config->base_url() . 'assets/js');
define('_MEDIA_PATH', $CI->config->base_url() . 'assets/media');
define('_FILES_PATH', $CI->config->base_url() . 'assets/files');