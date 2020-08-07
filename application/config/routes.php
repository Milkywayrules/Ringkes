<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller']      = 'home';
$route['tralala/(:any)']          = 'pages/view_qrcode/$1';
$route['mail']                    = 'mail';
$route['report']                  = 'report';

// auth
$route['admin/login']             = 'auth/login/admin';
$route['login']                   = 'auth/login';
$route['logout']                  = 'auth/logout';
$route['register']                = 'auth/register';
$route['resetpassword']           = 'auth/reset';
$route['resetpassword/(:any)']    = 'auth/reset/$1';

// user
// $route['u/manage/url/(:any)']     = 'manage/view_url/$1';
$route['u/manage/(:any)']         = 'manage/$1';
$route['u/(:any)']                = 'panel/$1';

// admin
// $route['admin/profile']           = 'admin/home/profile';
// $route['admin/inbox']             = 'admin/home/inbox';
// $route['admin/settings']          = 'admin/home/settings';
// $route['admin/dashboard']         = 'admin/home';
// $route['admin/(:any)']            = 'admin/panel/$1';
// $route['admin']                   = 'admin/home';

//
//
$route['admin/settings']          = 'admin/settings';
$route['admin/settings/(:any)']   = 'admin/settings/$1';
$route['admin/(:any)']            = 'admin/main/$1';
//
//

$route['(:any)']                  = 'short/cek/$1';
$route['404_override']            = '';
$route['translate_uri_dashes']    = TRUE;
