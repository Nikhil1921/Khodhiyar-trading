<?php defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'home';
$route['404_override'] = 'home/error_404';
$route['translate_uri_dashes'] = FALSE;

$route[ADMIN.'/forgot-password'] = ADMIN.'/login/forgot_password';
$route[ADMIN.'/checkOtp'] = ADMIN.'/login/checkOtp';
$route[ADMIN.'/changePassword'] = ADMIN.'/login/changePassword';
$route[ADMIN.'/vendor']['post'] = ADMIN.'/vendor/get';
$route[ADMIN.'/product']['post'] = ADMIN.'/product/get';
$route[ADMIN.'/inventory']['post'] = ADMIN.'/inventory/get';
$route[ADMIN.'/users']['post'] = ADMIN.'/users/get';