<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'opusx';
//$route['default_controller'] = 'welcome';
$route['login'] = 'opusx/login';
$route['logout'] = 'opusx/logout';
$route['dashboard'] = 'ctrl_dashboard/index';
$route['fletes_maritimos'] = 'ctrl_flete_maritimo/index';
$route['addflete_maritimo'] = 'ctrl_flete_maritimo/add';
$route['editflete_maritimo/(:num)'] = 'ctrl_flete_maritimo/edit/$1';
$route['deleteflete_maritimo/(:num)'] = 'ctrl_flete_maritimo/delete/$1';
$route['fletes_aereos'] = 'ctrl_flete_aereo/index';
$route['addflete_aereo'] = 'ctrl_flete_aereo/add';
$route['editflete_aereo/(:num)'] = 'ctrl_flete_aereo/edit/$1';
$route['deleteflete_aereo/(:num)'] = 'ctrl_flete_aereo/delete/$1';
$route['navieras'] = 'ctrl_naviera/index';
$route['addnaviera'] = 'ctrl_naviera/add';
$route['editnaviera/(:num)'] = 'ctrl_naviera/edit/$1';
$route['deletenaviera/(:num)'] = 'ctrl_naviera/delete/$1';
$route['puertos'] = 'ctrl_puerto/index';
$route['addpuerto'] = 'ctrl_puerto/add';
$route['editpuerto/(:num)'] = 'ctrl_puerto/edit/$1';
$route['deletepuerto/(:num)'] = 'ctrl_puerto/delete/$1';
$route['aerolineas'] = 'ctrl_aerolinea/index';
$route['aeropuertos'] = 'ctrl_aeropuerto/index';
$route['contenedores'] = 'ctrl_contenedor/index';
$route['addcontenedor'] = 'ctrl_contenedor/add';
$route['editcontenedor/(:num)'] = 'ctrl_contenedor/edit/$1';
$route['deletecontenedor/(:num)'] = 'ctrl_contenedor/delete/$1';
$route['carga_consolidada'] = 'ctrl_carga_consolidada/index';
$route['recargos_aereos'] = 'ctrl_recargo_aereo/index';
$route['addrecargo_aereo'] = 'ctrl_recargo_aereo/add';
$route['editrecargo_aereo/(:num)'] = 'ctrl_recargo_aereo/edit/$1';
$route['deleterecargo_aereo/(:num)'] = 'ctrl_recargo_aereo/delete/$1';
$route['recargos_maritimo'] = 'ctrl_recargo_maritimo/index';
$route['addrecargo_maritimo'] = 'ctrl_recargo_maritimo/add';
$route['editrecargo_maritimo/(:num)'] = 'ctrl_recargo_maritimo/edit/$1';
$route['deleterecargo_maritimo/(:num)'] = 'ctrl_recargo_maritimo/delete/$1';
$route['regiones'] = 'ctrl_region/index';
$route['addregion'] = 'ctrl_region/add';
$route['editregion/(:num)'] = 'ctrl_region/edit/$1';
$route['deleteregion/(:num)'] = 'ctrl_region/delete/$1';
$route['addaerolinea'] = 'ctrl_aerolinea/add';
$route['editaerolinea/(:num)'] = 'ctrl_aerolinea/edit/$1';
$route['deleteaerolinea/(:num)'] = 'ctrl_aerolinea/delete/$1';
$route['addaeropuerto'] = 'ctrl_aeropuerto/add';
$route['editaeropuerto/(:num)'] = 'ctrl_aeropuerto/edit/$1';
$route['deleteaeropuerto/(:num)'] = 'ctrl_aeropuerto/delete/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

