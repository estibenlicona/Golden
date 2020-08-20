<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['404_override'] = '';
$route['default_controller'] = 'jugador';
$route['translate_uri_dashes'] = FALSE;
$route['api'] = 'Rest_server';
$route['team'] = 'team';
$route['formatear'] = 'format';
$route['sincronizador/start'] = 'sincronizador/start';
$route['formatear/actualizar'] = 'format/updatestast';
$route['jugadores'] = 'jugador';
$route['jugadores/psd/:num'] = 'jugador/psd';
$route['jugadores/sofifa/:num'] = 'jugador/sofifa';
$route['jugadores/create'] = 'jugador/create';
$route['sincronizador/update/(:num)'] = function ($id){return "sincronizador/update/{$id}";};
$route['sincronizador/create/(:num)'] = function ($id){return "sincronizador/create/{$id}";};
$route['login/start'] = 'login/start';
$route['jugadores/sincronizar'] = 'jugador/sincronizar';